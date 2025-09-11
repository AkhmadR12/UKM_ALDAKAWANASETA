<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;

class TestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonis = Testimoni::latest()->get();
        return view('admin.testimoni.index', compact('testimonis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimoni.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'status' => 'required|in:aktif,nonaktif',

            'bintang' => 'required|integer|min:1|max:5',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/testimoni'), $imageName);
            $data['gambar'] = 'images/testimoni/' . $imageName;
        }
        if (empty($data['status'])) {
            $data['status'] = 'aktif';
        }
        Testimoni::create($data);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimoni $testimoni)
    {
        return view('admin.testimoni.edit', compact('testimoni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'bintang' => 'required|integer|min:1|max:5',
            'gambar' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('testimoni', 'public');
        }

        $testimoni->update($data);

        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil diupdate.');
    }

    public function destroy(Testimoni $testimoni)
    {
        $testimoni->delete();
        return redirect()->route('testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }
     public function toggleStatus($id)
    {
        $portofolio = Testimoni::findOrFail($id);
        $portofolio->status = $portofolio->status === 'aktif' ? 'nonaktif' : 'aktif';
        $portofolio->save();

        return response()->json([
            'success' => true,
            'status' => $portofolio->status,
        ]);
    }
}
