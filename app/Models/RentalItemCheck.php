<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalItemCheck extends Model
{
    use HasFactory;
    protected $fillable = [
        'rental_id',
        'item_id',
        'quantity',
        'is_returned',
        'checked_by',
        'checked_at',
        'notes'
    ];

    protected $casts = [
        'checked_at' => 'datetime',
        'is_returned' => 'boolean'
    ];

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function checkedBy()
    {
        return $this->belongsTo(User::class, 'checked_by');
    }
}
