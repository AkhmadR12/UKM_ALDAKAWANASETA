<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->get();
        return view('admin.photos.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.photos.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            // 'name' => 'required|string',
            'title' => 'required|string',
            'cover' => 'required|image',
            'image_highres' => 'required|image',
            'harga_image_highres' => 'required|numeric',
            'image_lowres' => 'required|image',
            'harga_image_lowres' => 'required|numeric',
            'deskripsi' => 'nullable|string',
        ]);

        $user = Auth::user();

        // Upload dan watermark cover
        $cover = $request->file('cover');
        $coverPath = 'covers/' . uniqid() . '.' . $cover->getClientOriginalExtension();
        $coverImage = Image::make($cover);

        $watermarkPath = public_path('logo/watermark.png'); // ubah jika file .php
        if (file_exists($watermarkPath)) {
            $watermark = Image::make($watermarkPath)->opacity(500);
            $coverImage->insert($watermark, 'center');
        }

        Storage::disk('public')->put($coverPath, (string) $coverImage->encode());

        // Simpan image highres
        $highresPath = $request->file('image_highres')->store('highres', 'public');

        // Simpan image lowres
        $lowresPath = $request->file('image_lowres')->store('lowres', 'public');

        // Simpan ke DB
        $photo = Photo::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'title' => $request->title,
            'cover' => $coverPath,
            'image_highres' => $highresPath,
            'harga_image_highres' => $request->harga_image_highres,
            'image_lowres' => $lowresPath,
            'harga_image_lowres' => $request->harga_image_lowres,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json(['success' => true, 'data' => $photo]);
    }
    public function edit($id)
    {
        $photos = Photo::findOrFail($id);
        return view('admin.photos.edit', compact('photos'));
    }

    public function update(Request $request, $id)
    {
        $photos = Photo::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'type' => 'required|in:image,video',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:10240',
            'is_active' => 'nullable|boolean'
        ]);

        if ($request->is_active) {
            Photo::where('is_active', true)
                ->where('id', '!=', $photos->id)
                ->update(['is_active' => false]);
        }

        $path = $photos->file_path;

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($path && file_exists(public_path($path))) {
                unlink(public_path($path));
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('popups'), $filename);
            $path = 'popups/' . $filename;
        }

        $photos->update([
            'title' => $request->title,
            'type' => $request->type,
            'file_path' => $path,
            'is_active' => $request->is_active ?? false
        ]);

        return redirect()->route('admin.photos.index')->with('success', 'Photo berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $photos = Photo::findOrFail($id);
        Storage::disk('public')->delete($photos->file_path);
        $photos->delete();

        return redirect()->route('.photos.index')->with('success', 'Photo berhasil dihapus.');
    }
}
