<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Str;

class Magazine extends Model
{
    use HasFactory;
    protected $table = 'magazines';
    protected $fillable = ['title', 'description', 'cover_image', 'pdf_path', 'pages', 'aktif', 'created_at'];
    protected $casts = [
        'pages' => 'array',
        'aktif' => 'boolean',
        'created_at' => 'datetime',
    ];
    // public static function processPdf($pdfFile, $data)
    // {
    //     // Simpan PDF asli
    //     $pdfPath = $pdfFile->store('magazines/pdf');
    //     $pdfFullPath = storage_path('app/' . $pdfPath);

    //     // Buat direktori untuk gambar halaman
    //     $directory = 'pages/' . time();
    //     $outputDirectory = storage_path('app/magazines/' . $directory);

    //     // Gunakan disk 'magazines' yang sudah dikonfigurasi
    //     if (!Storage::disk('magazines')->makeDirectory($directory)) {
    //         throw new \Exception("Failed to create directory: " . $outputDirectory);
    //     }

    //     // Verifikasi directory writable
    //     if (!is_writable($outputDirectory)) {
    //         throw new \Exception("Directory is not writable: " . $outputDirectory);
    //     }

    //     // Konversi PDF ke gambar menggunakan Ghostscript
    //     $gsPath = 'D:\gs10.05.1\bin\gswin64c';
    //     $command = sprintf(
    //         '"%s" -dNOPAUSE -dBATCH -sDEVICE=jpeg -r150 -dJPEGQ=90 -sOutputFile="%s\\page_%%d.jpg" "%s"',
    //         $gsPath,
    //         $outputDirectory,
    //         $pdfFullPath
    //     );

    //     exec($command, $output, $returnCode);

    //     if ($returnCode !== 0) {
    //         throw new \Exception("Ghostscript failed with code $returnCode: " . implode("\n", $output));
    //     }

    //     // Dapatkan semua halaman yang dikonversi
    //     $pages = [];
    //     $files = Storage::disk('magazines')->files($directory);

    //     foreach ($files as $file) {
    //         if (strpos($file, 'page_') !== false) {
    //             $pages[] = 'magazines/' . $file;
    //         }
    //     }

    //     if (empty($pages)) {
    //         throw new \Exception("No pages were converted");
    //     }

    //     return self::create([
    //         'title' => $data['title'],
    //         'description' => $data['description'],
    //         'cover_image' => $pages[0],
    //         'pdf_path' => $pdfPath,
    //         'pages' => $pages
    //     ]);
    // }
    public static function processPdf($pdfFile, $data)
    {
        $timestamp = time();

        // 1. Simpan PDF asli ke public/magazines/pdf/
        $originalName = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
        $pdfFileName = $timestamp . '_' . Str::slug($originalName) . '.pdf';
        $pdfPath = 'magazines/pdf/' . $pdfFileName;
        $pdfFullPath = public_path($pdfPath);

        // Buat folder jika belum ada
        File::ensureDirectoryExists(dirname($pdfFullPath));

        // Simpan file ke public/
        file_put_contents($pdfFullPath, file_get_contents($pdfFile->getRealPath()));

        // 2. Buat direktori untuk gambar halaman di public/magazines/pages/[timestamp]/
        $pagesDirectory = 'magazines/pages/' . $timestamp;
        $pagesFullDirectory = public_path($pagesDirectory);
        File::ensureDirectoryExists($pagesFullDirectory);

        // 3. Konversi PDF ke gambar
        $gsPath = 'D:\gs10.05.1\bin\gswin64c'; // Sesuaikan jika perlu
        $command = sprintf(
            '"%s" -dNOPAUSE -dBATCH -sDEVICE=jpeg -r150 -dJPEGQ=90 -sOutputFile="%s/page_%%d.jpg" "%s"',
            $gsPath,
            $pagesFullDirectory,
            $pdfFullPath
        );

        exec($command, $output, $returnCode);

        if ($returnCode !== 0) {
            throw new \Exception("Ghostscript failed with code $returnCode: " . implode("\n", $output));
        }

        // 4. Ambil gambar yang dihasilkan
        $pages = [];
        $files = File::files($pagesFullDirectory);

        foreach ($files as $file) {
            if (preg_match('/page_(\d+)\.jpg$/', $file->getFilename())) {
                $pages[] = $pagesDirectory . '/' . $file->getFilename(); // path relatif dari public
            }
        }

        if (empty($pages)) {
            throw new \Exception("No pages were converted");
        }

        // Urutkan halaman
        usort($pages, function ($a, $b) {
            preg_match('/page_(\d+)\./', $a, $matchesA);
            preg_match('/page_(\d+)\./', $b, $matchesB);

            $numA = isset($matchesA[1]) ? (int)$matchesA[1] : 0;
            $numB = isset($matchesB[1]) ? (int)$matchesB[1] : 0;

            return $numA - $numB;
        });

        // 5. Simpan ke DB
        return self::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'cover_image' => $pages[0],
            'pdf_path' => $pdfPath,
            'pages' => $pages
        ]);
    }
    // Method untuk mendapatkan halaman yang sudah diurutkan
    public function getSortedPages()
    {
        $pages = $this->pages ?? [];

        // Urutkan halaman berdasarkan nomor halaman
        usort($pages, function ($a, $b) {
            preg_match('/page_(\d+)\./', $a, $matchesA);
            preg_match('/page_(\d+)\./', $b, $matchesB);

            $numA = isset($matchesA[1]) ? (int)$matchesA[1] : 0;
            $numB = isset($matchesB[1]) ? (int)$matchesB[1] : 0;

            return $numA - $numB;
        });

        return $pages;
    }
    public function getCoverImageUrlAttribute()
    {
        return url($this->cover_image); // dari public/
    }

    public function getPdfUrlAttribute()
    {
        return url($this->pdf_path); // dari public/
    }

    public function getPagesUrlsAttribute()
    {
        return array_map(function ($page) {
            return url($page); // dari public/
        }, $this->pages ?? []);
    }
    public function clicks()
    {
        return $this->hasMany(MagazineClick::class);
    }
    public function getTotalClicksAttribute()
    {
        return $this->clicks()->count();
    }

    public function getRecentClicksAttribute()
    {
        return $this->clicks()->where('clicked_at', '>=', now()->subDays(7))->count();
    }
}
