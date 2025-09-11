<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagazineClick extends Model
{
    use HasFactory;
    public $timestamps = false; // karena pakai clicked_at saja

    protected $fillable = ['magazine_id', 'source', 'clicked_at'];

    protected $casts = [
        'clicked_at' => 'datetime',
    ];
    public function magazine()
    {
        return $this->belongsTo(Magazine::class);
    }
}
