<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'nullable|date',
            'lokasi' => 'nullable|string|max:255',
            'jam' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'active_fields' => 'nullable|array',
            'active_fields.*' => 'string'
        ]);

        $data = $request->all();
        // Konversi active_fields ke array
        $data['active_fields'] = $request->active_fields ?: [];

        // Simpan gambar jika ada
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/kategori'), $imageName);
            $data['gambar'] = 'images/kategori/' . $imageName;
        }

        Kategori::create($data);

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan.');
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
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        $allFields = [
            'nama',
            'organisasi',
            'jabatan',
            'jenis_anggota',
            'nomor_anggota',
            'alamat',
            'kota',
            'provinsi',
            'nomor_telp',
            'email',
            'usaha',
            'bukti_tf',
            'dokumen_pendukung',
            'info',
            'jenis_kelamin',
            'ttl',
            'pekerjaan',
            'jenis_foto',
            'deskripsi',
            'ukuran',
            'portofolio'
        ];

        return view('kategoris.edit', compact('kategori', 'allFields'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal' => 'nullable|date',
            'lokasi' => 'nullable|string|max:255',
            'jam' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'active_fields' => 'nullable|array',
            'active_fields.*' => 'string'
        ]);

        $data = $request->all();
        $data['active_fields'] = $request->active_fields ?: [];

        // Update gambar jika ada
        // if ($request->hasFile('gambar')) {
        //     // Hapus gambar lama jika ada
        //     if ($kategori->gambar && file_exists(public_path($kategori->gambar))) {
        //         unlink(public_path($kategori->gambar));
        //     }

        //     $imageName = time() . '.' . $request->gambar->extension();
        //     $request->gambar->move(public_path('images/kategori'), $imageName);
        //     $data['gambar'] = 'images/kategori/' . $imageName;
        // }
        // Handle hapus gambar
        if ($request->has('hapus_gambar') && $kategori->gambar) {
            if (file_exists(public_path($kategori->gambar))) {
                unlink(public_path($kategori->gambar));
            }
            $data['gambar'] = null;
        }

        // Update gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($kategori->gambar && file_exists(public_path($kategori->gambar))) {
                unlink(public_path($kategori->gambar));
            }

            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/kategori'), $imageName);
            $data['gambar'] = 'images/kategori/' . $imageName;
        }

        $kategori->update($data);

        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function toggleStatus($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->status = $kategori->status === 'aktif' ? 'nonaktif' : 'aktif';
        $kategori->save();

        return response()->json([
            'success' => true,
            'status' => $kategori->status
        ]);
    }
}
