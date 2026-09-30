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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Untuk menyimpan judul post
            $table->text('content'); // Untuk menyimpan isi konten
            $table->string('image')->nullable(); // Bonus: Untuk upload gambar (boleh kosong)
            $table->softDeletes(); // Bonus: Untuk fitur soft delete (menghapus sementara)
            $table->timestamps(); // Untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};