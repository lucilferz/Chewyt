<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // 1. TAMPILKAN DAFTAR KATEGORI
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())
                        ->orWhereNull('user_id')
                        ->get();

        return view('categories.index', compact('categories'));
    }

    // 2. TAMPILKAN FORM (Untuk jaga-jaga jika tombol dipanggil)
    public function create()
    {
        return view('categories.create');
    }

    // 3. SIMPAN KATEGORI BARU
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => \Str::slug($request->name),
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dibuat!');
    }

    // 4. HAPUS KATEGORI (INI YANG BARU KITA TAMBAH)
    public function destroy($id)
    {
        // Cari kategori berdasarkan ID
        $category = Category::findOrFail($id);

        // Cek Keamanan: Pastikan yang menghapus adalah pemiliknya
        if ($category->user_id != Auth::id()) {
            abort(403, 'Gak boleh hapus punya orang lain!');
        }

        // Lakukan penghapusan
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}