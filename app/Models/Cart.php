<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','type', 'item_id', 'item_type', 'product_id', 'photo_id', 'quantity', 'session_id', 'created_at', 'updated_at'];
    // Polymorphic relationship
    public function item()
    {
        return $this->morphTo();
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function items(): HasMany
    // {
    //     return $this->hasMany(CartItem::class);
    // }
    public function getTotalAttribute(): float
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
    }

    /**
     * Calculate the total quantity of items in the cart.
     */
    public function getTotalQuantityAttribute(): int
    {
        return $this->items->sum('quantity');
    }

    /**
     * Find a cart item by product ID.
     */
    public function findItemByProduct(int $productId): ?CartItem
    {
        return $this->items->firstWhere('product_id', $productId);
    }
}
