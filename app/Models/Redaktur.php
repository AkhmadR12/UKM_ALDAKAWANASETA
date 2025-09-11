<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redaktur extends Model
{
    use HasFactory;
    protected $table = 'redaktur';
    protected $fillable = ['name', 'image', 'instagram', 'facebook'];

}
