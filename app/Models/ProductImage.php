<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'type', 'image_path', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
