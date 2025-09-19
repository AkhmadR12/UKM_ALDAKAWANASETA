<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvenCalender extends Model
{
    use HasFactory;
    protected $table = 'event_calender';
    protected $fillable = [
        'name',
        'tgl_mulai',
        'tgl_akhir',
        'waktu_mulai',
        'waktu_akhir',
        'deskripsi',
        'warna',

    ];
}
