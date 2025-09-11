<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriBarang extends Model
{
    use HasFactory;
    protected $table = 'categories_barang';
    protected $fillable = ['name', 'description'];

    // public function items()
    // {
    //     return $this->hasMany(Item::class);
    // }
    public function items()
    {
        return $this->hasMany(Item::class, 'category_id'); // foreign key sesuai tabel items
    }
}
