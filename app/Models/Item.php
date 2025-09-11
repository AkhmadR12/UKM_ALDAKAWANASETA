<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'quantity', 'image_path', 'description', 'daily_price', 'status'];

    public function category()
    {
        return $this->belongsTo(CategoriBarang::class);
    }

    public function rentalItems()
    {
        return $this->hasMany(RentalItem::class);
    }
}
