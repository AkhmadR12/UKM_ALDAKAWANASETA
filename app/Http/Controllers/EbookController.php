<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Ebook;
use App\Models\EbookPage;
use App\Models\Category;
use Spatie\PdfToImage\Pdf;

class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ebooks = Ebook::with('category')->latest()->get();
        return view('admin.ebooks.index', compact('ebooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.ebooks.upload', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'pdf_file' => 'required|mimes:pdf|max:20480',
        ]);

        $pdfFile = $request->file('pdf_file');
        $fileName = Str::slug($request->title) . '-' . time() . '.' . $pdfFile->getClientOriginalExtension();
        $pdfPath = $pdfFile->storeAs('ebooks/pdf', $fileName, 'public');

        $ebook = Ebook::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'cover_image' => null,
            'pdf_file' => $pdfPath,
            'category_id' => $request->category_id,
            'author_id' => auth()->id(),
            'status' => 'draft'
        ]);

        $pdf = new Pdf(storage_path('app/public/' . $pdfPath));
        $totalPages = $pdf->getNumberOfPages();

        for ($page = 1; $page <= $totalPages; $page++) {
            $imageName = 'ebooks/pages/' . $ebook->id . '-page-' . $page . '.jpg';
            $pdf->setPage($page)->saveImage(storage_path('app/public/' . $imageName));

            EbookPage::create([
                'ebook_id' => $ebook->id,
                'page_number' => $page,
                'media_type' => 'image',
                'image' => $imageName,
            ]);

            if ($page == 1) {
                $ebook->update(['cover_image' => $imageName]);
            }
        }

        return redirect()->route('ebooks.index')->with('success', 'Ebook uploaded and converted successfully!');
    }

    /**
     * Display the specified resource.
     */
      public function show($slug)
    {
        $ebook = Ebook::where('slug', $slug)->with('pages')->firstOrFail();
        return view('admin.ebooks.show', compact('ebook'));
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
    public function destroy(string $id)
    {
        //
    }
}
