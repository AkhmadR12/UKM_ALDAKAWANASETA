<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use App\Models\Tipe;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portofolios = Portofolio::with('tipe')->get();
        return view('admin.portofolio.index', compact('portofolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipes = Tipe::all();
        return view('admin.portofolio.create', compact('tipes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipe_id' => 'required|exists:tipes,id',
            'nama' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'deskripsi2' => 'nullable|string',
            'deskripsi3' => 'nullable|string',
            'deskripsi4' => 'nullable|string',
            'gambar' => 'nullable|image|max:2048',
            'gambar2' => 'nullable|image|max:2048',
            'gambar3' => 'nullable|image|max:2048',
            'gambar4' => 'nullable|image|max:2048',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $data = $request->all();

        // handle upload gambar
        foreach (['gambar', 'gambar2', 'gambar3', 'gambar4'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $file->getClientOriginalName(); // agar tidak bentrok
                $file->move(public_path('portofolio'), $filename); // simpan ke public/portofolio
                $data[$field] = 'portofolio/' . $filename; // simpan path relatifnya
            }
        }
        // Default status jika tidak diisi
        if (empty($data['status'])) {
            $data['status'] = 'aktif';
        }
        Portofolio::create($data);
        return redirect()->route('portofolio.index')->with('success', 'Portofolio berhasil ditambahkan.');
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
    public function edit(string $id)
    {
        $tipes = Tipe::all();
        return view('admin.portofolio.edit', compact('portofolio', 'tipes'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portofolio $portofolio)
    {
        $request->validate([
            'nama' => 'nullable|string|max:255',
            'tipe_id' => 'required|exists:tipes,id',
            'status' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'deskripsi2' => 'nullable|string',
            'deskripsi3' => 'nullable|string',
            'deskripsi4' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
            'gambar2' => 'nullable|image|mimes:jpg,jpeg,png',
            'gambar3' => 'nullable|image|mimes:jpg,jpeg,png',
            'gambar4' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $data = $request->all();

        // Upload baru jika ada
        foreach (['gambar', 'gambar2', 'gambar3', 'gambar4'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $file->getClientOriginalName(); // agar tidak bentrok
                $file->move(public_path('portofolio'), $filename); // simpan ke public/portofolio
                $data[$field] = 'portofolio/' . $filename; // simpan path relatifnya
            }
        }

        $portofolio->update($data);

        return redirect()->route('portofolio.index')->with('success', 'Portofolio berhasil diperbarui.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portofolio $portofolio)
    {
        $portofolio->delete();
        return back()->with('success', 'Deleted.');
    }
    public function toggleStatus($id)
    {
        $portofolio = Portofolio::findOrFail($id);
        $portofolio->status = $portofolio->status === 'aktif' ? 'nonaktif' : 'aktif';
        $portofolio->save();

        return response()->json([
            'success' => true,
            'status' => $portofolio->status,
        ]);
    }
}
