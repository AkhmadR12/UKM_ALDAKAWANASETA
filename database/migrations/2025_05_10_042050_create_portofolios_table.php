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
        Schema::create('portofolios', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->text('deskripsi2')->nullable();
            $table->string('gambar2')->nullable();
            $table->text('deskripsi3')->nullable();
            $table->string('gambar3')->nullable();
            $table->text('deskripsi4')->nullable();
            $table->string('gambar4')->nullable();
            $table->unsignedBigInteger('tipe_id');
            $table->timestamps();

            $table->foreign('tipe_id')->references('id')->on('tipes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolios');
    }
};
