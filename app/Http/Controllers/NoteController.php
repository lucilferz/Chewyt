<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Category;
use App\Models\SearchHistory; // Pastikan model ini ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; // Library PDF

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $query = Note::where('user_id', Auth::id())->with('category');

        // 1. Filter Pencarian (Keyword)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });

            // Simpan History Pencarian
            SearchHistory::create([
                'user_id' => Auth::id(),
                'keyword' => $search
            ]);
        }

        // 2. Filter Kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 3. Filter Rentang Tanggal (Date Range)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $notes = $query->latest()->get();
        $categories = Category::where('user_id', Auth::id())->orWhereNull('user_id')->get();

        return view('notes.index', compact('notes', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->orWhereNull('user_id')->get();
        return view('notes.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'content' => 'required',
            'file' => 'nullable|image|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('notes_files', 'public');
        }

        Note::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'content' => $request->content,
            'file_path' => $filePath,
        ]);

        return redirect()->route('notes.index')->with('success', 'Catatan berhasil disimpan!');
    }

    public function show($id)
    {
        $note = Note::where('user_id', Auth::id())->findOrFail($id);
        return view('notes.show', compact('note'));
    }

    public function destroy($id)
    {
        $note = Note::where('user_id', Auth::id())->findOrFail($id);
        $note->delete(); // Masuk ke Sampah (Soft Delete)
        return redirect()->route('notes.index')->with('success', 'Catatan dipindahkan ke sampah.');
    }

    // --- FITUR TAMBAHAN ---

    // 1. Halaman Sampah (Backup)
    public function trash()
    {
        $notes = Note::onlyTrashed()->where('user_id', Auth::id())->get();
        return view('notes.trash', compact('notes'));
    }

    // 2. Restore Catatan
    public function restore($id)
    {
        $note = Note::onlyTrashed()->where('user_id', Auth::id())->findOrFail($id);
        $note->restore();
        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dikembalikan!');
    }

    // 3. Hapus Permanen
    public function forceDelete($id)
    {
        $note = Note::onlyTrashed()->where('user_id', Auth::id())->findOrFail($id);
        if($note->file_path) {
            Storage::disk('public')->delete($note->file_path);
        }
        $note->forceDelete();
        return redirect()->back()->with('success', 'Catatan dihapus permanen.');
    }

    // 4. Export PDF
    public function exportPdf()
    {
        $notes = Note::where('user_id', Auth::id())->get();
        $pdf = Pdf::loadView('notes.pdf', compact('notes'));
        return $pdf->download('catatan-chewytpad.pdf');
    }
}