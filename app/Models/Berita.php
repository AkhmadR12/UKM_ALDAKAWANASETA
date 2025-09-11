<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'sub_judul',
        'is_terkini',
        'is_update',
        'deskripsi',
        'gambar1',
        'deskripsi1',
        'gambar2',
        'deskripsi2',
        'gambar3',
        'deskripsi3',
        'gambar4',
        'deskripsi4',
        'gambar5',
        'deskripsi5',
        'tanggal',
        'jam',
        'dokumentasi_link',
        'dokumentasi_nama',
        'is_mata',
        'is_logo',
        'editor_link',
        'editor_nama'
    ];

    protected $casts = [
        'is_terkini' => 'boolean',
        'is_update' => 'boolean',
        'is_mata' => 'boolean',
        'is_logo' => 'boolean',
        'tanggal' => 'date',
    ];
}
