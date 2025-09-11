<?php

namespace App\Http\Controllers;

use App\Models\EbookPage;
use Illuminate\Http\Request;

class EbookPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(EbookPage $page)
    {
        if (file_exists(storage_path('app/public/' . $page->image))) {
            unlink(storage_path('app/public/' . $page->image));
        }
        $page->delete();
        return back()->with('success', 'Page deleted.');
    }
}
