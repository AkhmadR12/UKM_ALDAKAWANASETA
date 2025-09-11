<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;

class CarouselController extends Controller
{
    public function index()
    {
        $carousels = Carousel::latest()->get();
        return view('admin.carousel.index', compact('carousels'));
    }
    public function toggleStatus($id)
    {
        $portofolio = Carousel::findOrFail($id);
        $portofolio->status = $portofolio->status === 'aktif' ? 'nonaktif' : 'aktif';
        $portofolio->save();

        return response()->json([
            'success' => true,
            'status' => $portofolio->status,
        ]);
    }
    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'status' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);
        $data = $request->all();

        // Simpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/carousel'), $imageName);
            $data['gambar'] = 'images/carousel/' . $imageName;
        }
        Carousel::create($data);
        // Carousel::create($request->all());

        return redirect()->route('carousel.index')->with('success', 'Carousel berhasil ditambahkan.');
    }
}
