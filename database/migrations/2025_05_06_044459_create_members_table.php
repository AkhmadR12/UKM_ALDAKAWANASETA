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
        Schema::create('members', function (Blueprint $table) {
            $table->string('id_member')->primary()->unique(); // contoh: AFI.1101.060525.0001
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('kota_id');
            $table->date('tanggal_bergabung');
            $table->timestamps();

            $table->foreign('kota_id')->references('id')->on('kabupaten_kota')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
