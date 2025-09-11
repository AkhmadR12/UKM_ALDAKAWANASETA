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
        Schema::create('form_inputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->string('nama')->nullable();#
            $table->string('organisasi')->nullable();#
            $table->string('jabatan')->nullable();#
            $table->string('jenis_anggota')->nullable();#
            $table->string('nomor_anggota')->nullable();
            $table->string('alamat')->nullable();#
            $table->string('kota')->nullable();#
            $table->string('provinsi')->nullable();#
            $table->string('nomor_telp')->nullable();#
            $table->string('email')->nullable();#
            $table->string('usaha')->nullable();#
            $table->string('bukti_tf')->nullable();#
            $table->string('dokumen_pendukung')->nullable();#
            $table->string('info')->nullable();#
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();#
            $table->string('ttl')->nullable();#
            $table->enum('pekerjaan', ['Profesi', 'Hobi'])->nullable();#
            $table->string('jenis_foto')->nullable();#
            $table->text('deskripsi')->nullable();
            $table->enum('ukuran', ['S', 'M', 'L', 'XL', 'XXL', 'XXXL'])->nullable();#
            $table->string('portofolio')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_inputs');
    }
};
