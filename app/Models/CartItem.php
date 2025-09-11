<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price', // Snapshot of product price at time of adding to cart
        'options', // JSON field for product variations/options
        'notes', // Any special instructions for this item
        'is_selected', // For checkout selection
    ];

    protected $casts = [
        'options' => 'array',
        'is_selected' => 'boolean',
        'price' => 'float',
    ];

    /**
     * Get the cart that owns the cart item.
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Get the product that owns the cart item.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Calculate the subtotal for this item.
     */
    public function getSubtotalAttribute(): float
    {
        return $this->quantity * $this->price;
    }

    /**
     * Increase the quantity of this item.
     */
    public function increaseQuantity(int $quantity = 1): void
    {
        $this->update(['quantity' => $this->quantity + $quantity]);
    }

    /**
     * Decrease the quantity of this item.
     */
    public function decreaseQuantity(int $quantity = 1): void
    {
        $newQuantity = max(1, $this->quantity - $quantity);
        $this->update(['quantity' => $newQuantity]);
    }

    /**
     * Toggle the selection status of this item.
     */
    public function toggleSelection(): void
    {
        $this->update(['is_selected' => !$this->is_selected]);
    }
}
