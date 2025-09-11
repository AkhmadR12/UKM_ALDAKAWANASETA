<?php

namespace App\Http\Controllers;

use App\Models\KabupatenKota;
use App\Models\Subdep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Homecontroller extends Controller
{
    function logout()
    {
        Auth::logout();
        return redirect('');
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            // Admin bisa lihat semua user
            $users = \App\Models\User::orderBy('name')->paginate(10);
        } else {
            // Member hanya bisa lihat dirinya sendiri
            $users = \App\Models\User::where('id', $user->id)->paginate(10);
        }

        return view('admin.user.index', compact('users'));
    }

    public function edit(User $user)
    {
        $subdeps = Subdep::all();
        $cities = KabupatenKota::all(); // Asumsikan model untuk kota adalah City
        return view('admin.user.edit', compact('user', 'subdeps', 'cities'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,user',
            'subdep_id' => 'nullable|exists:subdeps,id',
            'contact' => 'nullable|string|max:20',
            'ttl' => 'nullable|date',
            'kelamin' => 'nullable|in:L,P',
            'kota_id' => 'nullable|exists:kabupaten_kotas,id',
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        $data = $request->only(['name', 'role', 'subdep_id', 'contact', 'ttl', 'kelamin', 'kota_id']);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && file_exists(public_path('avatars/' . $user->photo))) {
                unlink(public_path('avatars/' . $user->photo));
            }

            $file = $request->file('photo');

            // Create filename based on user name
            $cleanName = Str::slug($request->name);
            $extension = $file->getClientOriginalExtension();
            $filename = $cleanName . '_' . time() . '.' . $extension;

            // Create avatars directory if it doesn't exist
            $avatarsPath = public_path('avatars');
            if (!file_exists($avatarsPath)) {
                mkdir($avatarsPath, 0755, true);
            }

            // Move file to avatars directory
            $file->move($avatarsPath, $filename);

            // If using Intervention Image for resizing (optional)
            try {
                $imagePath = $avatarsPath . '/' . $filename;
                $image = Image::make($imagePath);
                $image->fit(300, 300, function ($constraint) {
                    $constraint->upsize();
                })->save();
            } catch (\Exception $e) {
                // Continue without resizing if Intervention Image is not available
            }

            $data['photo'] = $filename;
        }

        // Handle password update
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Update user data
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }
    public function destroy(User $user)
    {
        // Delete photo if exists
        if ($user->photo && file_exists(public_path('avatars/' . $user->photo))) {
            unlink(public_path('avatars/' . $user->photo));
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
