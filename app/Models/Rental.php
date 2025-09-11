<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'renter_name', 'renter_phone', 'renter_photo_path', 'document_path', 'start_date', 'end_date', 'total_price', 'status', 'notes', 'ttd_peminjam'];
    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_COMPLETED = 'completed';
    const STATUS_REJECTED = 'rejected';
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    public function rentalItems()
    {
        return $this->hasMany(RentalItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function checkItems()
    {
        return $this->hasMany(RentalItemCheck::class);
    }
    public function updateStatusBasedOnReturns()
    {
        if ($this->status === self::STATUS_APPROVED && $this->allItemsReturned()) {
            $this->status = self::STATUS_COMPLETED;
            $this->save();
        }

        return $this;
    }
    /**
     * Check if all items have been returned
     */
    public function allItemsReturned()
    {
        $totalItems = $this->rentalItems->sum('quantity');
        $returnedItems = $this->checkItems->where('is_returned', true)->sum('quantity');

        return $totalItems === $returnedItems;
    }

    public function items()
    {
        return $this->belongsToMany(Item::class, 'rental_items')
            ->withPivot('quantity', 'daily_price', 'sub_total');
    }
    // Dalam model Rental, tambahkan method ini:
    public function getReturnSummary()
    {
        $summary = [];

        foreach ($this->rentalItems as $rentalItem) {
            $returnedQty = $this->checkItems
                ->where('item_id', $rentalItem->item_id)
                ->where('is_returned', true)
                ->sum('quantity');

            $summary[] = [
                'item' => $rentalItem->item,
                'rented_quantity' => $rentalItem->quantity,
                'returned_quantity' => $returnedQty,
                'all_returned' => $returnedQty >= $rentalItem->quantity
            ];
        }

        return $summary;
    }
}
