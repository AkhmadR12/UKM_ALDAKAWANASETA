<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::paginate(10);
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'icon' => 'nullable|string|max:255',
            'image' => 'required|array|min:1|max:4', // Sesuaikan dengan name di form
            'image.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imagePaths = [];

        if ($request->hasFile('image')) { // Sesuaikan dengan name di form
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('services'), $imageName);
                $imagePaths[] = 'services/' . $imageName;
            }
        }

        // Sesuaikan dengan nama field di database
        $serviceData = [
            'nama' => $data['nama'],
            'deskripsi' => $data['deskripsi'],
            'icon' => $data['icon'],
            'image' => $imagePaths, // Field di database adalah 'image' bukan 'images'
        ];

        Service::create($serviceData);

        return redirect()->route('service.index')->with('success', 'Service berhasil ditambahkan');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::findOrFail($id); // ambil data berdasarkan id
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Service $service)
    // {
    //     $data = $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'deskripsi' => 'required',
    //         'icon' => 'nullable|string|max:255',
    //         'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    //     ]);

    //     if ($request->hasFile('image')) {
    //         // Hapus file lama jika ada
    //         if ($service->image && file_exists(public_path($service->image))) {
    //             unlink(public_path($service->image));
    //         }

    //         $image = $request->file('image');
    //         $imageName = time() . '_' . $image->getClientOriginalName();
    //         $image->move(public_path('services'), $imageName);
    //         $data['image'] = 'services/' . $imageName;
    //     }

    //     $service->update($data);

    //     return redirect()->route('service.index')->with('success', 'Service berhasil diupdate');
    // }
    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|array|max:4',
            'image.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048',
            'remove_images' => 'nullable|array',
        ]);

        $existingImages = $service->images ?? [];

        // 1. Hapus gambar yang dicentang
        if (!empty($data['remove_images'])) {
            foreach ($data['remove_images'] as $removeImage) {
                if (($key = array_search($removeImage, $existingImages)) !== false) {
                    unset($existingImages[$key]);
                    if (file_exists(public_path($removeImage))) {
                        unlink(public_path($removeImage));
                    }
                }
            }
        }

        // 2. Upload gambar baru
        if ($request->hasFile('image')) {
            $uploadedImages = [];
            foreach ($request->file('image') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('services'), $imageName);
                $uploadedImages[] = 'services/' . $imageName;
            }

            // Gabungkan yang lama + baru (max 4 total)
            $combinedImages = array_merge($existingImages, $uploadedImages);
            if (count($combinedImages) > 4) {
                return redirect()->back()->withErrors(['image' => 'Total gambar tidak boleh lebih dari 4.']);
            }

            $data['image'] = array_values($combinedImages); // reset index
        } else {
            // Kalau tidak upload baru, simpan hasil penghapusan lama
            $data['image'] = array_values($existingImages);
        }

        $service->update($data);

        return redirect()->route('service.index')->with('success', 'Service berhasil diupdate');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();
        return redirect()->route('service.index')->with('success', 'Service berhasil dihapus');
    }
}
