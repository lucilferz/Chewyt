<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes - ChewytPad
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// SMART REDIRECT: Kalau Admin login, langsung lempar ke Admin Panel
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Fitur Tambahan User
    Route::get('/notes/trash', [NoteController::class, 'trash'])->name('notes.trash');
    Route::put('/notes/{id}/restore', [NoteController::class, 'restore'])->name('notes.restore');
    Route::delete('/notes/{id}/force-delete', [NoteController::class, 'forceDelete'])->name('notes.force_delete');
    Route::get('/notes/export-pdf', [NoteController::class, 'exportPdf'])->name('notes.exportPdf');

    // CRUD Utama
    Route::resource('categories', CategoryController::class);
    Route::resource('notes', NoteController::class);

    // Admin Panel Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'index'])->name('users.index');
        Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
    });

});

require __DIR__.'/auth.php';