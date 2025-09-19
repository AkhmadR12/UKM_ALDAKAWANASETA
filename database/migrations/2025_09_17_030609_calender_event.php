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
        Schema::create('event_calender', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('tgl_mulai');
            $table->date('tgl_akhir')->nullable();
            $table->time('waktu_mulai');
            $table->time('waktu_akhir');
            $table->string('deskripsi');
            $table->string('warna')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_calender');
    }
};
