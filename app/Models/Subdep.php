<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdep extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode';
    public $incrementing = false; 
    protected $keyType = 'string';
    protected $fillable = ['kode', 'name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
