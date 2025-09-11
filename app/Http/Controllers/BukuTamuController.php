<?php

namespace App\Http\Controllers;

use App\Models\Bukutamu;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataTamu = BukuTamu::latest()->get();
        return view('admin.bukutamu.index', compact('dataTamu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('frontend.bukutamu.buku_tamu');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'nama' => 'required|string|max:255',
    //         'nama_rimba' => 'nullable|string|max:255',
    //         'organisasi' => 'required|string|max:255',
    //         'angkatan' => 'required|integer|min:1900|max:' . date('Y'),
    //         'keperluan' => 'required|string',
    //         'keperluan_lainnya' => 'required_if:keperluan,lainnya|string|max:255'
    //     ]);

    //     // Simpan data
    //     $bukuTamu = new Bukutamu();
    //     $bukuTamu->email = $request->email;
    //     $bukuTamu->nama = $request->nama;
    //     $bukuTamu->nama_rimba = $request->nama_rimba;
    //     $bukuTamu->organisasi = $request->organisasi;
    //     $bukuTamu->angkatan = $request->angkatan;
    //     $bukuTamu->keperluan = $request->keperluan;

    //     // Jika keperluan adalah lainnya, simpan keterangan
    //     if ($request->keperluan === 'lainnya') {
    //         $bukuTamu->keperluan_lainnya = $request->keperluan_lainnya;
    //     }

    //     $bukuTamu->save();

    //     // Redirect dengan pesan sukses
    //     return redirect()->route('bukutamu.create')
    //         ->with('success', 'Data buku tamu berhasil disimpan!');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'nama' => 'required|string|max:255',
            'nama_rimba' => 'nullable|string|max:255',
            'organisasi' => 'required|string|max:255',
            'angkatan' => 'required|integer|min:1900|max:' . date('Y'),
            'keperluan' => 'required|string|in:bertamu,mengirim_surat_milad,mengirim_surat_peminjaman,mengambil_alat,mengembalikan_alat,belajar,lainnya',
            'keperluan_lainnya' => 'required_if:keperluan,lainnya|nullable|string|max:255'
        ]);

        // Simpan data
        $bukuTamu = new Bukutamu();
        $bukuTamu->email = $request->email;
        $bukuTamu->nama = $request->nama;
        $bukuTamu->nama_rimba = $request->nama_rimba;
        $bukuTamu->organisasi = $request->organisasi;
        $bukuTamu->angkatan = $request->angkatan;
        $bukuTamu->keperluan = $request->keperluan;

        // Jika keperluan adalah lainnya, simpan keterangan
        if ($request->keperluan === 'lainnya') {
            $bukuTamu->keperluan_lainnya = $request->keperluan_lainnya;
        } else {
            $bukuTamu->keperluan_lainnya = null; // Pastikan null jika bukan lainnya
        }

        $bukuTamu->save();

        // Redirect dengan pesan sukses
        return redirect()->route('bukutamu.create')
            ->with('success', 'Data buku tamu berhasil disimpan!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
