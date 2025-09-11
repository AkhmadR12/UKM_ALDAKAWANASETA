<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'photo_id',
        'transaction_code',
        'amount',
        'qty',
        'status',
        'proof_of_payment',
        'type'
    ];
    protected $casts = [
        'amount' => 'integer',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }
    // public function photo()
    // {
    //     return $this->belongsTo(Photo::class);
    // }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id');
    }


    // Helper method to check if this is a cart checkout
    public function isCartCheckout()
    {
        return $this->type === 'cart_checkout';
    }

    // Helper method to get all products (either single or multiple)
    public function getAllProducts()
    {
        if ($this->isCartCheckout()) {
            return $this->transactionItems()->with('product')->get();
        } else {
            return collect([$this->product]); // Return as collection for consistency
        }
    }
    public function getDisplayNameAttribute()
    {
        return optional($this->product)->name
            ?? optional($this->photo)->name
            ?? 'Produk Tidak Diketahui';
    }


    // public function orderItems()
    // {
    //     return $this->hasMany(OrderItem::class);
    // }
}
