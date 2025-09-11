<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('admin.berita.index', compact('beritas'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'is_terkini' => 'boolean',
            'is_update' => 'boolean',
            'is_mata' => 'boolean',
            'is_logo' => 'boolean',
            'sub_judul' => 'nullable',
            'deskripsi' => 'required',
            'gambar1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi1' => 'nullable',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi2' => 'nullable',
            'gambar3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi3' => 'nullable',
            'gambar4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi4' => 'nullable',
            'gambar5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi5' => 'nullable',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'dokumentasi_link' => 'nullable|url',
            'editor_link' => 'nullable|url',
        ]);

        // Handle file uploads
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('gambar' . $i)) {
                $file = $request->file('gambar' . $i);
                $filename = time() . "_gambar{$i}." . $file->getClientOriginalExtension();
                $file->move(public_path('berita-images'), $filename);
                $validated['gambar' . $i] = 'berita-images/' . $filename;
            }
        }

        // Simpan nama dari link Instagram
        if ($request->dokumentasi_link) {
            $validated['dokumentasi_nama'] = $this->extractInstagramUsername($request->dokumentasi_link);
        }

        if ($request->editor_link) {
            $validated['editor_nama'] = $this->extractInstagramUsername($request->editor_link);
        }

        Berita::create($validated);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Berita $berita)
    {
        return view('admin.berita.show', compact('berita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        return view('berita.edit', compact('berita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Berita $berita)
    {
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'is_terkini' => 'boolean',
            'is_update' => 'boolean',
            'is_mata' => 'boolean',
            'is_logo' => 'boolean',
            'sub_judul' => 'nullable',
            'deskripsi' => 'required',
            'gambar1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi1' => 'nullable',
            'gambar2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi2' => 'nullable',
            'gambar3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi3' => 'nullable',
            'gambar4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi4' => 'nullable',
            'gambar5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi5' => 'nullable',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'dokumentasi_link' => 'nullable|url',
            'editor_link' => 'nullable|url',
        ]);

        // Handle file uploads
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('gambar' . $i)) {
                // Hapus file lama jika ada
                if ($berita->{'gambar' . $i} && file_exists(public_path($berita->{'gambar' . $i}))) {
                    unlink(public_path($berita->{'gambar' . $i}));
                }

                $file = $request->file('gambar' . $i);
                $filename = time() . "_gambar{$i}." . $file->getClientOriginalExtension();
                $file->move(public_path('berita-images'), $filename);
                $validated['gambar' . $i] = 'berita-images/' . $filename;
            } else {
                $validated['gambar' . $i] = $berita->{'gambar' . $i}; // Tetap pakai yang lama
            }
        }

        // Update nama dari link Instagram
        $validated['dokumentasi_nama'] = $request->dokumentasi_link
            ? $this->extractInstagramUsername($request->dokumentasi_link)
            : null;

        $validated['editor_nama'] = $request->editor_link
            ? $this->extractInstagramUsername($request->editor_link)
            : null;

        $berita->update($validated);


        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        // Hapus gambar terkait
        for ($i = 1; $i <= 5; $i++) {
            if ($berita->{'gambar' . $i}) {
                Storage::disk('public')->delete($berita->{'gambar' . $i});
            }
        }

        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus');
    }

    // private function extractInstagramUsername($url)
    // {
    //     // Contoh: https://www.instagram.com/username/
    //     $parsed = parse_url($url);
    //     if (isset($parsed['path'])) {
    //         $path = trim($parsed['path'], '/');
    //         return $path;
    //     }
    //     return null;
    // }
    private function extractInstagramUsername($url)
    {
        // Contoh: https://www.instagram.com/username/
        $parsed = parse_url($url);

        if (!isset($parsed['host'])) {
            return null;
        }

        // Pastikan ini adalah link instagram
        if (!preg_match('/(?:instagram\.com|instagr\.am)$/', $parsed['host'])) {
            return null;
        }

        if (isset($parsed['path'])) {
            $path = trim($parsed['path'], '/');
            $parts = explode('/', $path);
            return $parts[0];
        }

        return null;
    }
}
