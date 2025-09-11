<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukutamu extends Model
{
    use HasFactory;
    protected $table = 'buku_tamu';

    protected $fillable = [
        'email',
        'nama',
        'nama_rimba',
        'organisasi',
        'angkatan',
        'keperluan',
        'keperluan_lainnya'
    ];

    protected $casts = [
        'angkatan' => 'integer'
    ];
}
