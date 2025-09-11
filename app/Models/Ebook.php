<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'cover_image', 'description', 'issue_number', 'volume',
        'category_id', 'published_at', 'status', 'author_id', 'pdf_file'
    ];

    public function pages()
    {
        return $this->hasMany(EbookPage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}

