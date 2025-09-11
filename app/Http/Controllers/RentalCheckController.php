<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\RentalItemCheck;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    public function createCheck(Rental $rental)
    {
        // Only allow checking for approved rentals
        if ($rental->status !== Rental::STATUS_APPROVED) {
            return redirect()->route('rentals.index')
                ->with('error', 'Hanya peminjaman dengan status approved yang dapat dicek.');
        }

        $rental->load('rentalItems.item');

        // Get already checked items
        $checkedItems = $rental->checkItems->groupBy('item_id')->map(function ($items) {
            return $items->sum('quantity');
        });

        return view('admin.rental.check', compact('rental', 'checkedItems'));
    }

    /**
     * Process the rental item check
     */
    public function storeCheck(Request $request, Rental $rental)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:items,id',
            'items.*.quantity' => 'required|integer|min:0',
            'items.*.is_returned' => 'sometimes|boolean',
            'notes' => 'nullable|string|max:500',
        ]);

        // Only allow checking for approved rentals
        if ($rental->status !== Rental::STATUS_APPROVED) {
            return redirect()->route('rentals.index')
                ->with('error', 'Hanya peminjaman dengan status approved yang dapat dicek.');
        }

        DB::transaction(function () use ($request, $rental) {
            foreach ($request->items as $itemData) {
                $itemId = $itemData['id'];
                $quantity = $itemData['quantity'];
                $isReturned = $itemData['is_returned'] ?? false;

                if ($quantity > 0) {
                    // Create check record
                    RentalItemCheck::create([
                        'rental_id' => $rental->id,
                        'item_id' => $itemId,
                        'quantity' => $quantity,
                        'is_returned' => $isReturned,
                        'checked_by' => auth()->id(),
                        'checked_at' => now(),
                        'notes' => $request->notes,
                    ]);

                    // If returned, update item stock
                    if ($isReturned) {
                        Item::where('id', $itemId)->increment('quantity', $quantity);
                    }
                }
            }

            // Update rental status based on returns
            $rental->updateStatusBasedOnReturns();
        });

        return redirect()->route('rentals.inspection.show', $rental->id)
            ->with('success', 'Pengecekan barang berhasil disimpan.');
    }
    public function showInspection(Rental $rental)
    {
        $rental->load([
            'rentalItems.item',
            'checkItems.item',
            'checkItems.checkedBy',
            'user'
        ]);

        return view('admin.rental.inspection', compact('rental'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Rental $rental)
    {
        $rental->load([
            'rentalItems.item',
            'checkItems.item',
            'checkItems.checkedBy',
            'user'
        ]);

        return view('admin.rental.show', compact('rental'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
