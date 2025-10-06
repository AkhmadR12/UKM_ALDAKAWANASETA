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
    public function edit($id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('admin.carousel.edit', compact('carousel'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'status' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $carousel = Carousel::findOrFail($id);
        $data = $request->all();

        // Handle gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($carousel->gambar && file_exists(public_path($carousel->gambar))) {
                unlink(public_path($carousel->gambar));
            }

            // Simpan gambar baru
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/carousel'), $imageName);
            $data['gambar'] = 'images/carousel/' . $imageName;
        }

        $carousel->update($data);

        return redirect()->route('carousel.index')->with('success', 'Carousel berhasil diperbarui.');
    }
    public function destroy($id)
    {
        $carousel = Carousel::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($carousel->gambar && file_exists(public_path($carousel->gambar))) {
            unlink(public_path($carousel->gambar));
        }

        $carousel->delete();

        return redirect()->route('carousel.index')->with('success', 'Carousel berhasil dihapus.');
    }
}
