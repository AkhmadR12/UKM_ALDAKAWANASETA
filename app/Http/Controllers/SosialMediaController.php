<?php

namespace App\Http\Controllers;

use App\Models\SosialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SosialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sosmeds = SosialMedia::all();
        return view('admin.sosmed.index', compact('sosmeds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sosmed.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
        ]);

        // ambil file dan nama asli
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();

        // simpan ke public/sosialmedia/ dengan nama asli
        $destinationPath = public_path('sosialmedia');
        $file->move($destinationPath, $fileName);

        SosialMedia::create([
            'name' => $request->name,
            'image' => 'sosialmedia/' . $fileName, // path relatif
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
        ]);

        return redirect()->route('sosmed.index')->with('success', 'Data berhasil disimpan.');
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
    public function edit(SosialMedia $sosialmedia)
    {
        return view('admin.sosmed.edit', compact('sosialmedia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SosialMedia $sosialmedia)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            $oldPath = public_path($sosialmedia->image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Upload gambar baru dengan nama asli
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('sosialmedia');
            $file->move($destinationPath, $fileName);

            $sosialmedia->image = 'sosialmedia/' . $fileName;
        }

        $sosialmedia->update([
            'name' => $request->name,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
        ]);

        return redirect()->route('sosmed.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SosialMedia $sosialmedia)
    {
        Storage::disk('public')->delete($sosialmedia->image);
        $sosialmedia->delete();

        return redirect()->route('sosmed.index')->with('success', 'Data berhasil dihapus.');
    }

    public function kontributor()
    {
        $sosmeds = SosialMedia::all();
         return view('frontend.majalah.kontributor', compact('sosmeds'));
    }
}
