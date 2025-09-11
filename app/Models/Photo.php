<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'title',
        'cover',
        'image_highres',
        'harga_image_highres',
        'image_lowres',
        'harga_image_lowres',
        'type_highres',
        'type_lowres',
        'deskripsi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
