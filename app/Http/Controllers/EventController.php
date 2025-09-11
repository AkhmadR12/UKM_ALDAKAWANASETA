<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('images')->latest()->get();
        return view('admin.events.index', compact('events'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.events.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'captions.*' => 'nullable|string|max:255',
        ]);

        $event = Event::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('events'), $filename); // langsung simpan ke public/events

                EventImage::create([
                    'event_id' => $event->id,
                    'image' => 'events/' . $filename,
                    'caption' => $request->captions[$key] ?? '',
                ]);
            }
        }

        return redirect()->route('events.index')->with('success', 'Event berhasil ditambahkan');
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
        $events = Event::findOrFail($id);
        return view('admin.events.edit', compact('events'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'captions.*' => 'nullable|string|max:255',
            'delete_images.*' => 'nullable|integer|exists:event_images,id',
        ]);

        $event->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        // Hapus gambar jika dipilih
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imgId) {
                $img = EventImage::find($imgId);
                if ($img) {
                    $path = public_path($img->image);
                    if (file_exists($path)) {
                        unlink($path); // hapus dari folder public/events
                    }
                    $img->delete();
                }
            }
        }

        // Upload gambar baru jika ada
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('events'), $filename);

                EventImage::create([
                    'event_id' => $event->id,
                    'image' => 'events/' . $filename,
                    'caption' => $request->captions[$key] ?? '',
                ]);
            }
        }

        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $events = Event::findOrFail($id);
        Storage::disk('public')->delete($events->file_path);
        $events->delete();

        return redirect()->route('events.index')->with('success', 'Popup berhasil dihapus.');
    }
    public function indexFrontend()
    {
        $events = Event::with('images')->latest()->get();

        return view('frontend.event.event', compact('events'));
    }
    public function showFrontend($id)
    {
        $event = Event::with('images')->findOrFail($id);
        return view('frontend.event.show', compact('event'));
    }
}
