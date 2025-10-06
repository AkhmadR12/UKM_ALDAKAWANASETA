<?php

namespace App\Http\Controllers;

use App\Models\CategoriBarang;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::latest()->paginate(10);
        return view('admin.items.index', compact('items'));
    }
    public function create()
    {
        $categories = CategoriBarang::all();
        return view('admin.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories_barang,id',
            'name' => 'required|max:100',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('item-images'), $imageName);
            $imagePath = 'item-images/' . $imageName; // disimpan relatif dari public
        }

        Item::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'quantity' => $request->quantity,
            'daily_price' => $request->daily_price,
            'image_path' => $imagePath,
            'description' => $request->description
        ]);

        return redirect()->route('item.index')->with('success', 'Barang berhasil ditambahkan');
    }
    // EDIT METHOD
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = CategoriBarang::all();
        return view('admin.items.edit', compact('item', 'categories'));
    }

    // UPDATE METHOD
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories_barang,id',
            'name' => 'required|max:100',
            'quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable',
        ]);

        $item = Item::findOrFail($id);
        $data = $request->all();

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($item->image_path && file_exists(public_path($item->image_path))) {
                unlink(public_path($item->image_path));
            }

            // Save new image
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('item-images'), $imageName);
            $data['image_path'] = 'item-images/' . $imageName;
        } else {
            // Keep the old image if no new image uploaded
            unset($data['image_path']);
        }

        $item->update($data);

        return redirect()->route('item.index')->with('success', 'Barang berhasil diperbarui');
    }

    // DESTROY METHOD
    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        // Delete image if exists
        if ($item->image_path && file_exists(public_path($item->image_path))) {
            unlink(public_path($item->image_path));
        }

        $item->delete();

        return redirect()->route('item.index')->with('success', 'Barang berhasil dihapus');
    }
}
