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
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('title');
            $table->string('cover');
            $table->string('image_highres');
            $table->decimal('harga_image_highres', 10, 2);
            $table->string('image_lowres');
            $table->decimal('harga_image_lowres', 10, 2);
            $table->string('type_highres')->default('highres');
            $table->string('type_lowres')->default('lowres');
            $table->text('deskripsi');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
