<?php

namespace App\Http\Controllers;

use App\Models\Subdep;
use Illuminate\Http\Request;

class SubdepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $subdeps = Subdep::all();
        return view('admin.subdep.index', compact('subdeps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('admin.subdep.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->validate([
            'kode' => 'required|unique:subdeps,kode',
            'name' => 'required'
        ]);

        Subdep::create($request->only(['kode', 'name']));

        return redirect()->route('subdep.index')->with('success', 'Subdep berhasil ditambahkan.');
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
     public function edit(Subdep $subdep)
    {
        return view('admin.subdep.edit', compact('subdep'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subdep $subdep)
    {
        $request->validate([
            'kode' => 'required|unique:subdeps,kode,' . $subdep->id,
            'name' => 'required'
        ]);

        $subdep->update($request->only(['kode', 'name']));

        return redirect()->route('subdep.index')->with('success', 'Subdep berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subdep $subdep)
    {
        $subdep->delete();

        return redirect()->route('subdep.index')->with('success', 'Subdep berhasil dihapus.');
    }
}
