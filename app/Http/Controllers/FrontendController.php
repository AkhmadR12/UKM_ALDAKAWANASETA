<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Carousel;
use App\Models\Faq;
use App\Models\Magazine;
use App\Models\Megazine;
use App\Models\Photo;
use App\Models\Popup;
use App\Models\Portofolio;
use App\Models\Product;
use App\Models\Service;
use App\Models\Testimoni;
use App\Models\Tipe;
use App\Models\Transaction;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\MagazineClick;
use App\Models\ProductClick;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function home()
    {
        $tipes = Tipe::all();
        $portofolios = Portofolio::where('status', 'aktif')->latest()->get();
        $video = Video::where('status', 1)->first(); // Ambil satu video saja
        $faqs = Faq::where('status', 1)->get();
        $popup = Popup::where('is_active', true)
            ->latest('updated_at')
            ->first();
        $testimonis = Testimoni::latest()->get();
        $carousels = Carousel::where('status', 'aktif')
            ->orderByDesc('updated_at')
            ->take(3)
            ->get();

        // ==== PERUBAHAN DI SINI ====
        $megazines = Magazine::orderByDesc('updated_at')->take(8)->get();

        // Proses pembatasan halaman berdasarkan status login dan role
        foreach ($megazines as $megazine) {
            // Pastikan pages sudah berupa array
            $pages = is_array($megazine->pages) ? $megazine->pages : json_decode($megazine->pages, true);

            // Jika tidak ada pages, set ke array kosong
            if (!$pages) {
                $pages = [];
            }

            // Cek kondisi pembatasan halaman
            if (!Auth::check() || (Auth::check() && Auth::user()->role === 'UMUM')) {
                // Untuk user yang belum login atau role UMUM, batasi hanya 17 halaman
                if (count($pages) > 16) {
                    $megazine->pages = array_slice($pages, 0, 16);
                    $megazine->is_locked = true; // Tambahkan flag untuk halaman terkunci
                    $megazine->total_pages = count($pages); // Simpan total halaman asli
                } else {
                    $megazine->pages = $pages;
                    $megazine->is_locked = false;
                }
            } else {
                // Untuk user dengan role lain (member premium, admin, dll), tampilkan semua halaman
                $megazine->pages = $pages;
                $megazine->is_locked = false;
            }

            // Tambahkan informasi user untuk keperluan frontend
            $megazine->user_logged_in = Auth::check();
            $megazine->user_role = Auth::check() ? Auth::user()->role : null;
        }
        // ==== SAMPAI SINI ====

        // $products = Product::latest()->take(8)->get();
        $products = Product::with('images')->latest()->take(8)->get();
        // $photos = Photo::latest()->take(8)->get();
        $maxPrice = Product::max('price');
        $beritaTerkini = Berita::where('is_terkini', true)->latest()->take(5)->get();
        $beritaUpdate = Berita::where('is_update', true)->latest()->take(5)->get();
        $semuaBerita = Berita::latest()->paginate(10);
        $beritas = Berita::latest()->paginate(10);
        $services = Service::all();
        $items = collect();

        foreach ($products as $product) {
            $lowresPrice = $product->images->where('type', 'lowres')->first()->price ?? $product->price;
            $highresPrice = $product->images->where('type', 'highres')->first()->price ?? $product->price;

            $items->push((object)[
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'lowres_price' => $lowresPrice,
                'highres_price' => $highresPrice,
                'image' => $product->image,
                'type' => 'product',
                'item' => $product,
                'created_at' => $product->created_at
            ]);
        }

        // foreach ($photos as $photo) {
        //     $items->push((object)[
        //         'id' => $photo->id,
        //         'name' => $photo->name, // atau $photo->title
        //         'price' => $photo->harga_image_highres,
        //         'image' => $photo->cover,
        //         'type' => 'photo',
        //         'item' => $photo,
        //         'created_at' => $photo->created_at
        //     ]);
        // }

        // Urutkan berdasarkan tanggal terbaru dan ambil 8 item
        $catalogItems = $items->sortByDesc('created_at')->take(8);
        return view('frontend.home', compact(
            'catalogItems',
            'popup',
            'faqs',
            'video',
            'tipes',
            'portofolios',
            'testimonis',
            'carousels',
            'megazines',
            'products',
            // 'photos',
            'maxPrice',
            'beritaTerkini',
            'beritaUpdate',
            'semuaBerita',
            'beritas',
            'services'
        ));
    }
    public function productReport()
    {
        $data = ProductClick::select('product_id', DB::raw('count(*) as total'))
            ->groupBy('product_id')
            ->with('product')
            ->get();

        return view('admin.reports.product_clicks', compact('data'));
    }
    public function trackProductClick($id, Request $request)
    {
        $source = $request->query('source', 'home'); // default dari home

        ProductClick::create([
            'product_id' => $id,
            'source' => $source,
            'clicked_at' => Carbon::now(),
        ]);

        return redirect()->route('products.detail', $id);
    }
    public function trackMagazineClick($id, Request $request)
    {
        $source = $request->query('source', 'unknown');

        MagazineClick::create([
            'magazine_id' => $id,
            'source' => $source,
            'clicked_at' => Carbon::now(),
        ]);

        return redirect()->route('majalah.show', $id);
    }
    public function getActivePopup()
    {
        $popup = Popup::where('is_active', true)->first();
        return response()->json($popup);
    }
    // public function show_majalah($id)
    // {
    //     $magazine = Megazine::findOrFail($id);

    //     return view('frontend.majalah.show', compact('magazine'));
    // }
    public function show_majalah($id)
    {
        $magazine = Magazine::findOrFail($id);

        // Decode pages
        $pages = is_array($magazine->pages) ? $magazine->pages : json_decode($magazine->pages, true);
        $pages = $pages ?: [];

        $magazine->total_pages = count($pages); // Simpan total halaman

        // Default semua halaman
        $magazine->pages = $pages;
        $magazine->is_locked = false;

        // Tambahkan informasi user
        $user = Auth::user();
        $magazine->user_logged_in = Auth::check();
        $magazine->user_role = $user ? $user->role : null;

        // === Aturan Akses ===
        if ($magazine->aktif == 0) {
            if (!Auth::check() || $user->role === 'UMUM') {
                if (count($pages) > 16) {
                    $magazine->pages = array_slice($pages, 0, 16);
                    $magazine->is_locked = true;
                }
            }
        }

        return view('frontend.majalah.show', compact('magazine'));
    }

    // public function index_majalah()
    // {
    //     $megazines = Megazine::orderByDesc('updated_at')->paginate(12); // pagination
    //     foreach ($megazines as $megazine) {
    //         // Pastikan pages sudah berupa array
    //         $pages = is_array($megazine->pages) ? $megazine->pages : json_decode($megazine->pages, true);

    //         // Jika tidak ada pages, set ke array kosong
    //         if (!$pages) {
    //             $pages = [];
    //         }

    //         // Cek kondisi pembatasan halaman
    //         if (!Auth::check() || (Auth::check() && Auth::user()->role === 'UMUM')) {
    //             // Untuk user yang belum login atau role UMUM, batasi hanya 17 halaman
    //             if (count($pages) > 16) {
    //                 $megazine->pages = array_slice($pages, 0, 16);
    //                 $megazine->is_locked = true; // Tambahkan flag untuk halaman terkunci
    //                 $megazine->total_pages = count($pages); // Simpan total halaman asli
    //             } else {
    //                 $megazine->pages = $pages;
    //                 $megazine->is_locked = false;
    //             }
    //         } else {
    //             // Untuk user dengan role lain (member premium, admin, dll), tampilkan semua halaman
    //             $megazine->pages = $pages;
    //             $megazine->is_locked = false;
    //         }

    //         // Tambahkan informasi user untuk keperluan frontend
    //         $megazine->user_logged_in = Auth::check();
    //         $megazine->user_role = Auth::check() ? Auth::user()->role : null;
    //     }
    //     return view('frontend.majalah.index', compact('megazines'));
    // }
    public function index_majalah()
    {
        $megazines = Magazine::orderByDesc('updated_at')->paginate(12); // pagination

        foreach ($megazines as $megazine) {
            // Decode pages
            $pages = is_array($megazine->pages) ? $megazine->pages : json_decode($megazine->pages, true);
            $pages = $pages ?: [];

            $megazine->total_pages = count($pages); // simpan total halaman asli

            // Default semua halaman
            $megazine->pages = $pages;
            $megazine->is_locked = false;

            // Tambahkan informasi user
            $user = Auth::user();
            $megazine->user_logged_in = Auth::check();
            $megazine->user_role = $user ? $user->role : null;

            // === Aturan Akses ===
            if ($megazine->aktif == 0) {
                if (!Auth::check() || $user->role === 'UMUM') {
                    if (count($pages) > 16) {
                        $megazine->pages = array_slice($pages, 0, 16);
                        $megazine->is_locked = true;
                    }
                }
            }
        }

        return view('frontend.majalah.index', compact('megazines'));
    }


    public function showDetail($id)
    {
        $portofolio = Portofolio::findOrFail($id);
        return view('home.layouts.portofolio_detail', compact('portofolio'));
    }
    public function DetailBerita($id)
    {
        $berita = Berita::findOrFail($id);
        return view('frontend.berita.show', compact('berita'));
    }
    public function katalog()
    {
        $products = Product::latest()->get();
        return view('frontend.produk.index', compact('products'));
    }
    // public function produk($id)
    // {
    //     $user = auth()->user();
    //     $product = Product::findOrFail($id);
    //     return view('frontend.produk.show', compact('product', 'user'));
    // }
    // public function produk($id)
    // {
    //     $user = auth()->user();
    //     $product = Product::with(['reviews.user'])
    //         ->withCount(['reviews as average_rating' => function ($query) {
    //             $query->select(DB::raw('coalesce(avg(rating),0)'));
    //         }])
    //         ->findOrFail($id);

    //     // Hitung distribusi rating
    //     $ratingDistribution = [];
    //     for ($i = 1; $i <= 5; $i++) {
    //         $ratingDistribution[$i] = $product->reviews->where('rating', $i)->count();
    //     }

    //     $sudahBeli = false;
    //     $sudahDireview = false;

    //     if ($user) {
    //         $sudahBeli = Transaction::where('user_id', $user->id)
    //             ->where('product_id', $product->id)
    //             ->exists();

    //         $sudahDireview = $product->reviews->contains('user_id', $user->id);
    //     }

    //     return view('frontend.produk.show', compact(
    //         'product',
    //         'user',
    //         'sudahBeli',
    //         'sudahDireview',
    //         'ratingDistribution'
    //     ));
    // }
    public function produk($id)
    {
        $product = Product::with(['reviews.user', 'images'])->findOrFail($id);

        $lowres = $product->images->where('type', 'lowres')->first();
        $highres = $product->images->where('type', 'highres')->first();

        // return view('frontend.produk.show', compact('product', 'lowres', 'highres'));
        return view('frontend.produk.show', compact('product', 'lowres', 'highres'));
    }

    // public function produk($id)
    // {
    //     $user = auth()->user();
    //     $product = Photo::with(['reviews.user'])->findOrFail($id); // Ambil review + data user
    //     return view('frontend.produk.show', compact('product', 'user'));
    // }
    // public function photos($id)
    // {
    //     $user = auth()->user();
    //     $photos = Photo::findOrFail($id);
    //     return view('frontend.photos.show', compact('photos', 'user'));
    // }
    public function photos($id)
    {
        $user = auth()->user();
        $photos = Photo::with(['reviews.user'])->findOrFail($id); // Ambil review + data user
        return view('frontend.photos.show', compact('photos', 'user'));
    }

    // public function photo_store(Request $request)
    // {
    //     $request->validate([
    //         'photo_id' => 'required|exists:photos,id',
    //         'qty' => 'required|integer|min:1',
    //         'selected_price' => 'required|numeric',
    //         'selected_file' => 'required|string',
    //         'selected_type' => 'required|string',
    //     ]);

    //     // Ambil data foto
    //     $photo = Photo::findOrFail($request->photo_id);

    //     // Tentukan harga asli dari database berdasarkan resolusi
    //     $price = $request->selected_type === 'highres'
    //         ? $photo->harga_image_highres
    //         : $photo->harga_image_lowres;

    //     // Hitung amount berdasarkan harga asli
    //     $amount = $price * $request->qty;
    //     $transaksi = Transaction::create([
    //         'user_id' => auth()->id(),
    //         'photo_id' => $photo->id,
    //         'qty' => $request->qty,
    //         'amount' => $amount,
    //         'type' => $request->selected_type,
    //         'file' => $request->selected_file,
    //         'status' => 'pending',
    //         'transaction_code' => 'TRX-' . strtoupper(uniqid()),
    //     ]);

    //     return redirect()->route('checkoutphoto.form', $transaksi->id);
    // }
    public function product_store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'selected_price' => 'required|numeric',
            'selected_type' => 'required|string',
            'total_amount' => 'required|numeric',
        ]);

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'product_id' => $request->product_id,
            'qty' => $request->quantity,
            'amount' => $request->total_amount,
            'type' => $request->selected_type,
            'status' => 'pending',
            'transaction_code' => 'TRX-' . strtoupper(uniqid()),
        ]);

        return redirect()->route('checkoutproduct.form', $transaction->id);
    }

    // public function produk_store(Request $request)
    // {
    //     $request->validate([
    //         'product_id' => 'required|exists:products,id',
    //         'qty' => 'required|integer|min:1',
    //         // 'proof_of_payment' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);

    //     $product = Product::findOrFail($request->product_id);
    //     $amount = $product->price * $request->qty;

    //     $produk = Transaction::create([
    //         'user_id' => auth()->id(),
    //         'product_id' => $product->id,
    //         'qty' => $request->qty,
    //         'amount' => $amount,
    //         'status' => 'pending',
    //     ]);

    //     return redirect()->route('checkout.form', $produk->id);
    // }
    public function ho()
    {
        $video = Video::where('status', 1)->first(); // Ambil satu video saja
        $faqs = Faq::where('status', 1)->get();
        return view('frontend.home', compact('faqs', 'video'));
    }

    public function tentang()
    {
        return view('frontend.tentang'); // resources/views/frontend/tentang.blade.php
    }
    public function form()
    {
        return view('frontend.form');
    }


    public function kontak()
    {
        return view('frontend.contact'); // resources/views/frontend/kontak.blade.php
    }
    public function faq()
    {
        $faqs = Faq::where('status', 1)->get();
        return view('frontend.faq', compact('faqs')); // resources/views/frontend/kontak.blade.php
    }

    public function dashboard()
    {
        $video = Video::where('status', 1)->first(); // Ambil satu video saja
        return view('admin.home', compact('video')); // untuk pengguna biasa
    }
    public function berita()
    {
        $beritaTerkini = Berita::where('is_terkini', true)->latest()->take(5)->get();
        $beritaUpdate = Berita::where('is_update', true)->latest()->take(5)->get();
        $semuaBerita = Berita::latest()->paginate(10);

        return view('frontend.berita', compact('beritaTerkini', 'beritaUpdate', 'semuaBerita'));
    }
}
