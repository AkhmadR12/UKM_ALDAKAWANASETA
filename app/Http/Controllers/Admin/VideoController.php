<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::all();
        return view('admin.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|mimes:mp4,avi,mov,webm|max:204800', // Max 200MB
            'status' => 'required|boolean',
        ]);

        $filePath = $request->file('video')->store('videos', 'public');

        Video::create([
            'title' => $request->title,
            'file_path' => $filePath,
            'status' => $request->status,
        ]);

        return redirect()->route('video.index')->with('success', 'Video berhasil ditambahkan.');
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
    public function edit(Video $video)
    {
        return view('admin.video.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'nullable|mimes:mp4,avi,mov,webm|max:204800',
            'status' => 'required|boolean',
        ]);

        if ($request->hasFile('video')) {
            // Hapus file lama
            if (Storage::disk('public')->exists($video->file_path)) {
                Storage::disk('public')->delete($video->file_path);
            }

            $video->file_path = $request->file('video')->store('videos', 'public');
        }

        $video->title = $request->title;
        $video->status = $request->status;
        $video->save();

        return redirect()->route('video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        if (Storage::disk('public')->exists($video->file_path)) {
            Storage::disk('public')->delete($video->file_path);
        }

        $video->delete();

        return redirect()->route('video.index')->with('success', 'Video berhasil dihapus.');
    }
}
