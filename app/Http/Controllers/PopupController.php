<?php

namespace App\Http\Controllers;

use App\Models\Popup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopupController extends Controller
{
    public function getActivePopup()
    {
        $popup = Popup::where('is_active', true)->first();
        return response()->json($popup);
    }
    public function index()
    {
        $popups = Popup::latest()->get();
        return view('admin.popup.index', compact('popups'));
    }

    public function create()
    {
        return view('admin.popup.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required|in:image,video',
            'file' => 'required|file|mimes:jpg,jpeg,png,mp4',
            'is_active' => 'boolean'
        ]);

        if ($request->is_active) {
            Popup::where('is_active', true)->update(['is_active' => false]);
        }

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName(); // untuk menghindari nama ganda
        $file->move(public_path('popups'), $filename); // simpan ke public/popups

        $path = 'popups/' . $filename; // path relatif untuk disimpan di DB

        Popup::create([
            'title' => $request->title,
            'type' => $request->type,
            'file_path' => $path,
            'is_active' => $request->is_active ?? false
        ]);

        return back()->route('popup.index')->with('success', 'Popup uploaded successfully');
    }


    public function edit($id)
    {
        $popup = Popup::findOrFail($id);
        return view('admin.popup.edit', compact('popup'));
    }

    public function update(Request $request, $id)
    {
        $popup = Popup::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'type' => 'required|in:image,video',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,mp4|max:10240',
            'is_active' => 'nullable|boolean'
        ]);

        if ($request->is_active) {
            Popup::where('is_active', true)
                ->where('id', '!=', $popup->id)
                ->update(['is_active' => false]);
        }

        $path = $popup->file_path;

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

        $popup->update([
            'title' => $request->title,
            'type' => $request->type,
            'file_path' => $path,
            'is_active' => $request->is_active ?? false
        ]);

        return redirect()->route('admin.popup.index')->with('success', 'Popup berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $popup = Popup::findOrFail($id);
        Storage::disk('public')->delete($popup->file_path);
        $popup->delete();

        return redirect()->route('.popup.index')->with('success', 'Popup berhasil dihapus.');
    }
    public function toggle($id)
    {
        $popup = Popup::findOrFail($id);

        // Jika akan diaktifkan, nonaktifkan yang lain
        if (!$popup->is_active) {
            Popup::where('is_active', true)->update(['is_active' => false]);
        }

        $popup->is_active = !$popup->is_active;
        $popup->save();

        return redirect()->back()->with('success', 'Status popup berhasil diperbarui.');
    }
}
