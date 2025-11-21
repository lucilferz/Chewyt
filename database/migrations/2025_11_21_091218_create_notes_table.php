<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            // Relasi (Wajib punya user dan kategori)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            
            $table->string('title');
            $table->longText('content');
            $table->string('file_path')->nullable(); // Untuk upload gambar/file
            $table->boolean('is_pinned')->default(false);
            
            $table->timestamps();
            $table->softDeletes(); // INI PENTING: Fitur Backup/Restore (Tong Sampah)
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
