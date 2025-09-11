<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'image','title'];

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function clicks()
    {
        return $this->hasMany(ProductClick::class);
    }
    public function getTotalClicksAttribute()
    {
        return $this->clicks()->count();
    }

    public function getRecentClicksAttribute()
    {
        return $this->clicks()->where('clicked_at', '>=', now()->subDays(7))->count();
    }
}
