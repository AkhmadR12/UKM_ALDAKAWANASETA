<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbookPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'ebook_id',
        'page_number',
        'title',
        'content',
        'image',
        'media_type'
    ];

    public function ebook()
    {
        return $this->belongsTo(Ebook::class);
    }
}
