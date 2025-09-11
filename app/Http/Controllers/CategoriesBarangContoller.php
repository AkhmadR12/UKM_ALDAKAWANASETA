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
}
