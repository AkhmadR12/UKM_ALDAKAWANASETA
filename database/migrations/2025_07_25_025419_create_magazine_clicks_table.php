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
        Schema::create('magazine_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('magazine_id')->constrained('magazines')->onDelete('cascade');
            $table->string('source'); // contoh: "home", "majalah"
            $table->timestamp('clicked_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magazine_clicks');
    }
};
