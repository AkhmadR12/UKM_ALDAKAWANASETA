<?php

namespace App\Http\Controllers;

use App\Models\CategoriBarang;
use Illuminate\Http\Request;

class CategoriesBarangContoller extends Controller
{
    public function index()
    {
        $categori_barangs = CategoriBarang::latest()->paginate(10);
        return view('admin.categori_barang.index', compact('categori_barangs'));
    }

    public function create()
    {
        return view('admin.categori_barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:50',
            'description' => 'nullable'
        ]);

        CategoriBarang::create($request->all());
        return redirect()->route('categories_barang.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Method edit, update, destroy juga diimplementasikan
    public function edit($id)
    {
        $categori_barang = CategoriBarang::findOrFail($id);
        return view('admin.categori_barang.edit', compact('categori_barang'));
    }
    public function update(Request $request, $id)
    {
        $categori_barang = CategoriBarang::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            
        ]);

        $categori_barang->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return redirect()->route('categories_barang.index')->with('success', 'categori_barang berhasil diperbarui');
    }
    public function destroy($id)
    {
        $categori_barang = CategoriBarang::findOrFail($id);
        $categori_barang->delete();

        return redirect()->route('categories_barang.index')->with('success', 'Popup berhasil dihapus.');
    }
}
