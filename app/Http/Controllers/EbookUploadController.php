<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Str;

class EbookUploadController extends Controller
{
    public function create()
    {
        return view('admin.ebooks.upload', compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'pdf_file' => 'required|mimes:pdf|max:20480', // Max 20MB
        ]);

        // Simpan PDF
        $pdfFile = $request->file('pdf_file');
        $fileName = Str::slug($request->title) . '-' . time() . '.' . $pdfFile->getClientOriginalExtension();
        $pdfPath = $pdfFile->storeAs('ebooks/pdf', $fileName, 'public');

        // Simpan ke tabel ebooks
        $ebook = \App\Models\Ebook::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'cover_image' => null, // nanti isi dari halaman pertama
            'pdf_file' => $pdfPath,
            'category_id' => 1, // bisa diubah dinamis
            'author_id' => auth()->id(),
            'status' => 'draft'
        ]);

        // Convert PDF ke gambar per halaman
        $pdf = new Pdf(storage_path('app/public/' . $pdfPath));
        $totalPages = $pdf->getNumberOfPages();

        for ($page = 1; $page <= $totalPages; $page++) {
            $imageName = 'ebooks/pages/' . $ebook->id . '-page-' . $page . '.jpg';
            $pdf->setPage($page)->saveImage(storage_path('app/public/' . $imageName));

            \App\Models\EbookPage::create([
                'ebook_id' => $ebook->id,
                'page_number' => $page,
                'media_type' => 'image',
                'image' => $imageName,
            ]);

            // Simpan halaman pertama sebagai cover
            if ($page == 1) {
                $ebook->update(['cover_image' => $imageName]);
            }
        }

        return redirect()->back()->with('success', 'Ebook uploaded successfully!');
    }
}
