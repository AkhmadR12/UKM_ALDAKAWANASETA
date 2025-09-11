<?php

namespace App\Http\Controllers;

use App\Models\Redaktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RedakturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $redakturs = Redaktur::all();
        return view('admin.redaktur.index', compact('redakturs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.redaktur.create');
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
        $destinationPath = public_path('Redaktur');
        $file->move($destinationPath, $fileName);

        Redaktur::create([
            'name' => $request->name,
            'image' => 'Redaktur/' . $fileName, // path relatif
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
        ]);

        return redirect()->route('redakturs.index')->with('success', 'Data berhasil disimpan.');
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
    public function edit(Redaktur $redakturs)
    {
        return view('admin.redaktur.edit', compact('redakturs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Redaktur $redakturs)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            $oldPath = public_path($redakturs->image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Upload gambar baru dengan nama asli
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('redaktur');
            $file->move($destinationPath, $fileName);

            $redakturs->image = 'redaktur/' . $fileName;
        }

        $redakturs->update([
            'name' => $request->name,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
        ]);

        return redirect()->route('redaktur.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Redaktur $redakturs)
    {
        Storage::disk('public')->delete($redakturs->image);
        $redakturs->delete();

        return redirect()->route('redaktur.index')->with('success', 'Data berhasil dihapus.');
    }

    public function redaktur()
    {
        $redakturs = Redaktur::all();
        return view('frontend.majalah.redaktur', compact('redakturs'));
    }
}
