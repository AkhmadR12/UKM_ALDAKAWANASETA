<?php

namespace App\Http\Controllers;

use App\Models\partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = partner::all();
        return view('admin.partner.index', compact('partners'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partner.create');
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
        $destinationPath = public_path('partners');
        $file->move($destinationPath, $fileName);

        partner::create([
            'name' => $request->name,
            'image' => 'partners/' . $fileName, // path relatif
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
        ]);

        return redirect()->route('partner.index')->with('success', 'Data berhasil disimpan.');
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
    public function edit(partner $partners)
    {
        return view('admin.sosmed.edit', compact('partners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, partner $partners)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'instagram' => 'nullable|url',
            'facebook' => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama
            $oldPath = public_path($partners->image);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Upload gambar baru dengan nama asli
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $destinationPath = public_path('partners');
            $file->move($destinationPath, $fileName);

            $partners->image = 'partners/' . $fileName;
        }

        $partners->update([
            'name' => $request->name,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
        ]);

        return redirect()->route('partner.index')->with('success', 'Data berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(partner $partners)
    {
        Storage::disk('public')->delete($partners->image);
        $partners->delete();

        return redirect()->route('partner.index')->with('success', 'Data berhasil dihapus.');
    }

    public function ofcfotografer()
    {
        $partners = partner::all();
         return view('frontend.event.ofcfotografer', compact('partners'));
    }
}
