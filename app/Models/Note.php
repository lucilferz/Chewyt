<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Penting buat fitur Restore nanti

class Note extends Model
{
    use HasFactory, SoftDeletes;

    // Mengizinkan semua kolom diisi (kecuali id)
    protected $guarded = ['id'];

    // Relasi: Note dimiliki oleh User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Note punya satu Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}