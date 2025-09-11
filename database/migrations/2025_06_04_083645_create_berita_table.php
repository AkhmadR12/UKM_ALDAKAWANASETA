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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->boolean('is_terkini')->default(false);
            $table->boolean('is_update')->default(false);
            $table->text('deskripsi');
            
            // Gambar dan deskripsi
            $table->string('gambar1')->nullable();
            $table->text('deskripsi1')->nullable();
            $table->string('gambar2')->nullable();
            $table->text('deskripsi2')->nullable();
            $table->string('gambar3')->nullable();
            $table->text('deskripsi3')->nullable();
            $table->string('gambar4')->nullable();
            $table->text('deskripsi4')->nullable();
            $table->string('gambar5')->nullable();
            $table->text('deskripsi5')->nullable();
            
            $table->date('tanggal');
            $table->time('jam');
            $table->string('dokumentasi_link')->nullable();
            $table->string('dokumentasi_nama')->nullable();
            $table->string('editor_link')->nullable();
            $table->string('editor_nama')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
