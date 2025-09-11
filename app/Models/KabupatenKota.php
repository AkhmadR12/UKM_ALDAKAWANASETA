<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabupatenKota extends Model
{
    use HasFactory;
    protected $table = 'kabupaten_kota';
    protected $keyType = 'string'; // karena PK adalah string
    public $incrementing = false;

    protected $fillable = ['id', 'name', 'provisi_id'];

    public function members()
    {
        return $this->hasMany(Member::class, 'kota_id');
    }
}
