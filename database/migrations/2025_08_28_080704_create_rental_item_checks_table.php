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
        Schema::create('rental_item_checks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_id')->constrained()->onDelete('cascade');
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->boolean('is_returned')->default(false);
            $table->foreignId('checked_by')->constrained('users')->onDelete('cascade');
            $table->timestamp('checked_at');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['rental_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_item_checks');
    }
};
