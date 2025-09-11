<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id', 'photo_id', 'content', 'rating', 'title'];

    // Validasi rating
    public static $rules = [
        'rating' => 'required|integer|between:1,5',
        'content' => 'required|string|min:10|max:500',
        'title' => 'required|string|max:100'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function photo()
    {
        return $this->belongsTo(Photo::class);
    }
    // Scope untuk rating tertentu
    public function scopeWithRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    // Format tanggal
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y');
    }
}
