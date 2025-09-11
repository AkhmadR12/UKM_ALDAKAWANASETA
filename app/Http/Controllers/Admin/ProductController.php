<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ProdukClickExport;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
 
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $products = Product::latest()->get();
    //     return view('admin.products.index', compact('products'));
    // }
    public function index()
    {
        $products = Product::with(['images' => function ($query) {
            $query->where('type', 'highres');
        }])->latest()->get();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'description' => 'nullable',
    //         'lowres_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    //         'lowres_price' => 'required|numeric',
    //         'highres_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    //         'highres_price' => 'required|numeric',
    //     ]);

    //     $product = Product::create([
    //         'name' => $request->name,
    //         'description' => $request->description,
    //         'price' => 0 // tidak digunakan, bisa dihapus jika tidak perlu
    //     ]);

    //     // Fungsi untuk simpan file dan buat record
    //     $saveImage = function ($file, $type, $price) use ($product) {
    //         $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
    //         $destination = public_path('products');
    //         $file->move($destination, $filename);

    //         $imagePath = 'products/' . $filename;

    //         $product->images()->create([
    //             'type' => $type,
    //             'image_path' => $imagePath,
    //             'price' => $price
    //         ]);
    //     };

    //     $saveImage($request->file('lowres_image'), 'lowres', $request->lowres_price);
    //     $saveImage($request->file('highres_image'), 'highres', $request->highres_price);

    //     return redirect()->route('product.index')->with('success', 'Produk berhasil disimpan dengan dua versi gambar.');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'lowres_image' => 'required|image|mimes:jpg,jpeg,png|max:10048',
            'lowres_price' => 'required|numeric',
            'highres_image' => 'required|image|mimes:jpg,jpeg,png|max:30048',
            'highres_price' => 'required|numeric',
        ]);

        // Simpan produk dulu (sementara kosongkan cover)
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => null,
            'price' => 0 // tidak digunakan
        ]);

        // ===== SIMPAN LOWRES ============
        $lowresFile = $request->file('lowres_image');
        $lowresName = Str::uuid() . '.' . $lowresFile->getClientOriginalExtension();
        $lowresPath = 'products/' . $lowresName;
        $lowresFile->move(public_path('products'), $lowresName);

        $product->images()->create([
            'type' => 'lowres',
            'image_path' => $lowresPath,
            'price' => $request->lowres_price
        ]);

        // ===== SIMPAN HIGHRES ============
        $highresFile = $request->file('highres_image');
        $highresName = Str::uuid() . '.' . $highresFile->getClientOriginalExtension();
        $highresPath = 'products/' . $highresName;
        $highresFile->move(public_path('products'), $highresName);

        $product->images()->create([
            'type' => 'highres',
            'image_path' => $highresPath,
            'price' => $request->highres_price
        ]);

        // ===== BUAT COVER DARI HIGHRES + WATERMARK ============
        $coverImage = Image::make(public_path($highresPath));
        $watermarkPath = public_path('logo/watermark.png');

        if (file_exists($watermarkPath)) {
            $watermark = Image::make($watermarkPath)
                ->resize($coverImage->width() * 0.6, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->opacity(50);

            $coverImage->insert($watermark, 'center');
        }

        $coverFilename = uniqid() . '.' . $highresFile->getClientOriginalExtension();
        $coverPath = public_path('covers/' . $coverFilename);
        $coverImage->save($coverPath);


        // ===== UPDATE COVER KE PRODUK ============
        $product->update([
            'image' => $coverFilename
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil disimpan dengan cover dari highres.');
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
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            $oldImagePath = public_path($product->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            // Simpan gambar baru
            $file = $request->file('image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('products');
            $file->move($destinationPath, $filename);

            // Set path gambar baru
            $product->image = 'products/' . $filename;
        }

        // Update data lainnya
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated');
    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted');
    }

    // public function chart(Request $request)
    // {
    //     $now = Carbon::now();

    //     $request->validate([
    //         'product_id' => 'nullable|exists:products,id',
    //         'date_range' => 'nullable|in:default,custom',
    //         'start_date' => 'nullable|required_if:date_range,custom|date',
    //         'end_date' => 'nullable|required_if:date_range,custom|date|after_or_equal:start_date'
    //     ]);
    //     // Get filter parameters
    //     $productId = $request->get('product_id');
    //     $dateRange = $request->get('date_range', 'default');
    //     $startDate = $request->get('start_date');
    //     $endDate = $request->get('end_date');

    //     // Base query
    //     $baseQuery = ProductClick::query();

    //     if ($productId) {
    //         $baseQuery->where('product_id', $productId);
    //     }

    //     // Daily data
    //     $dailyQuery = clone $baseQuery;
    //     $dailyPeriod = $dateRange === 'custom' && $startDate && $endDate
    //         ? [Carbon::parse($startDate), Carbon::parse($endDate)]
    //         : [$now->copy()->subDays(6), $now];

    //     $daily = $dailyQuery->select(
    //         'product_id',
    //         DB::raw('DATE(clicked_at) as date'),
    //         DB::raw('count(*) as total')
    //     )
    //         ->whereBetween('clicked_at', $dailyPeriod)
    //         ->groupBy('product_id', 'date')
    //         ->with('product:id,title,description')
    //         ->orderBy('date')
    //         ->get()
    //         ->groupBy('product_id');

    //     // Weekly data
    //     $weeklyQuery = clone $baseQuery;
    //     $weeklyPeriod = $dateRange === 'custom' && $startDate && $endDate
    //         ? [Carbon::parse($startDate), Carbon::parse($endDate)]
    //         : [$now->copy()->subWeeks(4), $now];

    //     $weekly = $weeklyQuery->select(
    //         'product_id',
    //         DB::raw('YEARWEEK(clicked_at, 1) as week'),
    //         DB::raw('count(*) as total')
    //     )
    //         ->whereBetween('clicked_at', $weeklyPeriod)
    //         ->groupBy('product_id', 'week')
    //         ->with('product:id,title,description')
    //         ->orderBy('week')
    //         ->get()
    //         ->groupBy('product_id');

    //     // Monthly data
    //     $monthlyQuery = clone $baseQuery;
    //     $monthlyPeriod = $dateRange === 'custom' && $startDate && $endDate
    //         ? [Carbon::parse($startDate), Carbon::parse($endDate)]
    //         : [$now->copy()->subMonths(11), $now];

    //     $monthly = $monthlyQuery->select(
    //         'product_id',
    //         DB::raw('DATE_FORMAT(clicked_at, "%Y-%m") as month'),
    //         DB::raw('count(*) as total')
    //     )
    //         ->whereBetween('clicked_at', $monthlyPeriod)
    //         ->groupBy('product_id', 'month')
    //         ->with('product:id,title,description')
    //         ->orderBy('month')
    //         ->get()
    //         ->groupBy('product_id');

    //     // Yearly data
    //     $yearlyQuery = clone $baseQuery;
    //     $yearlyPeriod = $dateRange === 'custom' && $startDate && $endDate
    //         ? [Carbon::parse($startDate), Carbon::parse($endDate)]
    //         : [$now->copy()->subYears(4), $now];

    //     $yearly = $yearlyQuery->select(
    //         'product_id',
    //         DB::raw('YEAR(clicked_at) as year'),
    //         DB::raw('count(*) as total')
    //     )
    //         ->whereBetween('clicked_at', $yearlyPeriod)
    //         ->groupBy('product_id', 'year')
    //         ->with('product:id,title,description')
    //         ->orderBy('year')
    //         ->get()
    //         ->groupBy('product_id');

    //     // Get all products for filter dropdown
    //     $products = Product::select('id', 'title')
    //         ->orderBy('title')
    //         ->get();

    //     // Calculate summary statistics with null checks
    //     $totalClicksQuery = clone $baseQuery;
    //     $totalClicks = $totalClicksQuery->count();

    //     $totalproductsQuery = $productId
    //         ? $baseQuery->where('product_id', $productId)
    //         : clone $baseQuery;
    //     $totalproducts = $totalproductsQuery->distinct('product_id')->count('product_id');

    //     $todayClicksQuery = $productId
    //         ? ProductClick::where('product_id', $productId)
    //         : ProductClick::query();
    //     $todayClicks = $todayClicksQuery->whereDate('clicked_at', $now->toDateString())->count();

    //     // Calculate average clicks per day correctly with null checks
    //     $dailyCounts = ProductClick::select(
    //         DB::raw('DATE(clicked_at) as date'),
    //         DB::raw('count(*) as click_count')
    //     )
    //         ->where('clicked_at', '>=', $now->copy()->subDays(30))
    //         ->groupBy('date')
    //         ->get()
    //         ->pluck('click_count')
    //         ->toArray();

    //     $avgClicksPerDay = count($dailyCounts) > 0 ? array_sum($dailyCounts) / count($dailyCounts) : 0;

    //     $summary = [
    //         'total_clicks' => $totalClicks,
    //         'total_products' => $totalproducts,
    //         'today_clicks' => $todayClicks,
    //         'avg_clicks_per_day' => round($avgClicksPerDay, 2),
    //     ];

    //     // Ensure all data variables are arrays to prevent count() errors
    //     $daily = $daily ?? collect();
    //     $weekly = $weekly ?? collect();
    //     $monthly = $monthly ?? collect();
    //     $yearly = $yearly ?? collect();

    //     return view('admin.products.report', compact(
    //         'daily',
    //         'weekly',
    //         'monthly',
    //         'yearly',
    //         'products',
    //         'summary',
    //         'productId',
    //         'dateRange',
    //         'startDate',
    //         'endDate'
    //     ));
    // }
    public function chart(Request $request)
    {
        $now = Carbon::now();

        $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'date_range' => 'nullable|in:default,custom',
            'start_date' => 'nullable|required_if:date_range,custom|date',
            'end_date' => 'nullable|required_if:date_range,custom|date|after_or_equal:start_date'
        ]);

        // Get filter parameters
        $productId = $request->get('product_id');
        $dateRange = $request->get('date_range', 'default');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        // Set default periods if not custom
        if ($dateRange !== 'custom' || !$startDate || !$endDate) {
            $startDate = $now->copy()->subDays(6)->format('Y-m-d');
            $endDate = $now->format('Y-m-d');
        }

        // Base query
        $baseQuery = ProductClick::query();

        if ($productId) {
            $baseQuery->where('product_id', $productId);
        }

        // Daily data - order by the actual clicked_at date
        $daily = $baseQuery->select(
            'product_id',
            DB::raw('DATE(clicked_at) as date'),
            DB::raw('count(*) as total')
        )
            ->whereBetween('clicked_at', [$startDate, $endDate])
            ->groupBy('product_id', DB::raw('DATE(clicked_at)'))
            ->with('product:id,description')
            ->orderBy(DB::raw('DATE(clicked_at)'))
            ->get()
            ->groupBy('product_id');

        // Weekly data - order by the week number
        $weekly = $baseQuery->select(
            'product_id',
            DB::raw('YEARWEEK(clicked_at, 1) as week'),
            DB::raw('count(*) as total')
        )
            ->whereBetween('clicked_at', [$startDate, $endDate])
            ->groupBy('product_id', DB::raw('YEARWEEK(clicked_at, 1)'))
            ->with('product:id,description')
            ->orderBy(DB::raw('YEARWEEK(clicked_at, 1)'))
            ->get()
            ->groupBy('product_id');

        // Monthly data - order by the month
        $monthly = $baseQuery->select(
            'product_id',
            DB::raw('DATE_FORMAT(clicked_at, "%Y-%m") as month'),
            DB::raw('count(*) as total')
        )
            ->whereBetween('clicked_at', [$startDate, $endDate])
            ->groupBy('product_id', DB::raw('DATE_FORMAT(clicked_at, "%Y-%m")'))
            ->with('product:id,description')
            ->orderBy(DB::raw('DATE_FORMAT(clicked_at, "%Y-%m")'))
            ->get()
            ->groupBy('product_id');

        // Yearly data - order by the year
        $yearly = $baseQuery->select(
            'product_id',
            DB::raw('YEAR(clicked_at) as year'),
            DB::raw('count(*) as total')
        )
            ->whereBetween('clicked_at', [$startDate, $endDate])
            ->groupBy('product_id', DB::raw('YEAR(clicked_at)'))
            ->with('product:id,description')
            ->orderBy(DB::raw('YEAR(clicked_at)'))
            ->get()
            ->groupBy('product_id');

        // Get all products for filter dropdown
        $products = Product::select('id', 'description')
            ->orderBy('description')
            ->get();

        // Calculate summary statistics
        $totalClicks = $baseQuery->count();
        $totalProducts = $productId ? 1 : $baseQuery->distinct('product_id')->count('product_id');

        $todayClicks = $baseQuery->whereDate('clicked_at', $now->toDateString())->count();

        // Calculate average clicks per day
        $dailyCounts = $baseQuery->select(
            DB::raw('DATE(clicked_at) as date'),
            DB::raw('count(*) as click_count')
        )
            ->whereBetween('clicked_at', [$now->copy()->subDays(30)->format('Y-m-d'), $endDate])
            ->groupBy(DB::raw('DATE(clicked_at)'))
            ->get()
            ->pluck('click_count')
            ->toArray();

        $avgClicksPerDay = count($dailyCounts) > 0 ? array_sum($dailyCounts) / count($dailyCounts) : 0;

        $summary = [
            'total_clicks' => $totalClicks,
            'total_products' => $totalProducts,
            'today_clicks' => $todayClicks,
            'avg_clicks_per_day' => round($avgClicksPerDay, 2),
        ];

        return view('admin.products.report', compact(
            'daily',
            'weekly',
            'monthly',
            'yearly',
            'products',
            'summary',
            'productId',
            'dateRange',
            'startDate',
            'endDate'
        ));
    }

    public function export(Request $request)
    {
        try {
            $data = $this->prepareReportData($request);
            $fileName = 'produk_clicks_' . date('Y-m-d_His') . '.xlsx';
            return Excel::download(new ProdukClickExport, $fileName);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error exporting data: ' . $e->getMessage());
        }
    }
    public function getTopproducts(Request $request)
    {
        $period = $request->get('period', 'daily'); // daily, weekly, monthly, yearly
        $limit = $request->get('limit', 10);

        $query = ProductClick::select(
            'product_id',
            DB::raw('count(*) as total_clicks')
        )
            ->with('product:id,title,description');

        switch ($period) {
            case 'daily':
                $query->whereDate('clicked_at', Carbon::today());
                break;
            case 'weekly':
                $query->whereBetween('clicked_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
                break;
            case 'monthly':
                $query->whereMonth('clicked_at', Carbon::now()->month)
                    ->whereYear('clicked_at', Carbon::now()->year);
                break;
            case 'yearly':
                $query->whereYear('clicked_at', Carbon::now()->year);
                break;
        }

        $topproducts = $query->groupBy('product_id')
            ->orderBy('total_clicks', 'desc')
            ->limit($limit)
            ->get();

        return response()->json($topproducts);
    }

    public function getClickTrends(Request $request)
    {
        $productId = $request->get('product_id');
        $period = $request->get('period', 'daily');
        $days = $request->get('days', 30);

        $query = ProductClick::query();

        if ($productId) {
            $query->where('product_id', $productId);
        }

        $dateFormat = match ($period) {
            'hourly' => '%Y-%m-%d %H:00:00',
            'daily' => '%Y-%m-%d',
            'weekly' => '%Y-%u',
            'monthly' => '%Y-%m',
            default => '%Y-%m-%d'
        };

        $trends = $query->select(
            DB::raw("DATE_FORMAT(clicked_at, '{$dateFormat}') as period"),
            DB::raw('count(*) as total')
        )
            ->where('clicked_at', '>=', Carbon::now()->subDays($days))
            ->groupBy('period')
            ->orderBy('period')
            ->get();

        return response()->json($trends);
    }

    public function getproductComparison(Request $request)
    {
        $productIds = $request->get('product_ids', []);
        $period = $request->get('period', 'monthly');

        if (empty($productIds)) {
            return response()->json(['error' => 'No products selected'], 400);
        }

        $results = [];

        foreach ($productIds as $productId) {
            $query = ProductClick::where('product_id', $productId);

            $data = match ($period) {
                'daily' => $query->select(
                    DB::raw('DATE(clicked_at) as period'),
                    DB::raw('count(*) as total')
                )
                    ->where('clicked_at', '>=', Carbon::now()->subDays(30))
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get(),

                'weekly' => $query->select(
                    DB::raw('YEARWEEK(clicked_at, 1) as period'),
                    DB::raw('count(*) as total')
                )
                    ->where('clicked_at', '>=', Carbon::now()->subWeeks(12))
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get(),

                'monthly' => $query->select(
                    DB::raw('DATE_FORMAT(clicked_at, "%Y-%m") as period'),
                    DB::raw('count(*) as total')
                )
                    ->where('clicked_at', '>=', Carbon::now()->subMonths(12))
                    ->groupBy('period')
                    ->orderBy('period')
                    ->get(),

                default => collect()
            };

            $product = \App\Models\product::find($productId);

            $results[] = [
                'product_id' => $productId,
                'product_title' => $product->title ?? 'Unknown',
                'data' => $data
            ];
        }

        return response()->json($results);
    }

    public function downloadPDF(Request $request)
    {
        // Implementation for PDF export
        // You can use libraries like DomPDF or TCPDF

        $data = $this->prepareReportData($request);

        $pdf = app('dompdf');
        $pdf->loadView('admin.products.report-pdf', $data);

        return $pdf->download('product_report_' . date('Y-m-d') . '.pdf');
    }

    private function prepareReportData(Request $request)
    {
        $now = Carbon::now();

        // Get filter parameters
        $productId = $request->get('product_id');
        $dateRange = $request->get('date_range', 'default');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        // Base query
        $baseQuery = ProductClick::query();

        if ($productId) {
            $baseQuery->where('product_id', $productId);
        }

        // Set date range based on filter
        if ($dateRange === 'custom' && $startDate && $endDate) {
            $baseQuery->whereBetween('clicked_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        // Get all click data with product information
        $clickData = $baseQuery->with('product:id,title,description')
            ->orderBy('clicked_at', 'desc')
            ->get();

        return [
            'clicks' => $clickData,
            'total_clicks' => $clickData->count(),
            'date_range' => $dateRange,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'product_id' => $productId
        ];
    }
}
