<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portofolio extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'deskripsi',
        'gambar',
        'deskripsi2',
        'gambar2',
        'deskripsi3',
        'gambar3',
        'deskripsi4',
        'gambar4',
        'status',
        'tipe_id'
    ];

    public function tipe()
    {
        return $this->belongsTo(Tipe::class);
    }
}
