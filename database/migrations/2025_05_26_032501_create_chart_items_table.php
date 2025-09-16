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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2); // Snapshot of product price
            $table->json('options')->nullable(); // For product variations
            $table->text('notes')->nullable(); // Special instructions
            $table->boolean('is_selected')->default(true); // For checkout selection
            $table->timestamps();

            $table->unique(['cart_id', 'product_id']); // Prevent duplicate products
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chart_items');
    }
};
