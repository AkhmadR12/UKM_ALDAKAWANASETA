<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalItem extends Model
{
    use HasFactory;
    protected $fillable = ['rental_id', 'item_id', 'quantity', 'daily_price', 'sub_total'];
    
    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
