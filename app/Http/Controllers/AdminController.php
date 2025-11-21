<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // 1. HALAMAN DASHBOARD ADMIN (Laporan)
    public function dashboard()
    {
        // Cek: Hanya Admin yang boleh masuk
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses Ditolak. Halaman ini khusus Admin.');
        }

        // Hitung Data untuk Laporan
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalNotes = Note::count();
        $totalCategories = Category::count();

        // Analisa: 5 Kategori Terpopuler
        $popularCategories = Category::withCount('notes')
                                 ->orderBy('notes_count', 'desc')
                                 ->take(5)
                                 ->get();

        // Ambil 5 User Terbaru
        $latestUsers = User::where('role', '!=', 'admin')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalNotes', 'totalCategories', 'popularCategories', 'latestUsers'));
    }

    // 2. HALAMAN KELOLA USER
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        // Ambil semua user KECUALI diri sendiri
        $users = User::where('id', '!=', Auth::id())->get();
        
        return view('admin.users.index', compact('users'));
    }

    // 3. HAPUS USER
    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        
        User::findOrFail($id)->delete();
        
        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }
}