<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\MagazineClick;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MagazineClickExport;
use App\Models\Magazine;
use PDF;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::latest()->get();
        return view('admin.magazines.index', compact('magazines'));
    }

    public function create()
    {
        return view('admin.magazines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf_file' => [
                'required',
                'mimes:pdf',
                'max:100000',
                function ($attribute, $value, $fail) {
                    // Cek isi PDF
                    $content = file_get_contents($value->getRealPath());
                    if (strpos($content, '%PDF-') !== 0) {
                        $fail('File bukan PDF valid');
                    }
                },
            ],
        ]);

        Log::info("Starting PDF upload process");

        try {
            Log::info("PDF file details: " . $request->file('pdf_file')->getClientOriginalName());
            $magazine = Magazine::processPdf($request->file('pdf_file'), $request->all());

            Log::info("Magazine created successfully: " . $magazine->id);

            return redirect()->route('magazine.index', $magazine->id)
                ->with('success', 'Majalah berhasil diupload!');
        } catch (\Exception $e) {
            Log::error("PDF processing error: " . $e->getMessage());
            Log::error($e->getTraceAsString());

            return back()->withInput()
                ->withErrors(['pdf_file' => 'Gagal memproses PDF: ' . $e->getMessage()]);
        }
    }


    public function show(Magazine $magazine)
    {

        return view('admin.magazines.show_majalah', compact('magazine'));
    }
    // public function test_magazine_creation()
    // {
    //     Storage::fake('public');

    //     $file = UploadedFile::fake()->create('magazine.pdf', 1024);

    //     $response = $this->post(route('magazines.store'), [
    //         'title' => 'Test Megazine',
    //         'description' => 'Test Description',
    //         'pdf_file' => $file
    //     ]);

    //     $response->assertRedirect();
    //     $this->assertDatabaseHas('magazines', ['title' => 'Test Megazine']);
    //     Storage::disk('public')->assertExists(Megazine::first()->cover_image);
    // }
    // MagazineController.php

    public function edit(Magazine $magazine)
    {
        return view('admin.magazines.edit', compact('magazine'));
    }

    public function update(Request $request, Magazine $magazine)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'pdf_file' => 'nullable|mimes:pdf|max:50000' // 50MB
        ]);

        $data = $request->only(['title', 'description']);

        if ($request->hasFile('pdf_file')) {
            // Hapus file lama
            Storage::delete([$magazine->pdf_path, $magazine->cover_image]);
            Storage::delete($magazine->pages);

            // Proses file baru
            $magazine = Magazine::processPdf($request->file('pdf_file'), $request->all());
            $magazine->save();
        } else {
            $magazine->update($data);
        }

        return redirect()->route('magazines.show', $magazine->id)
            ->with('success', 'Majalah berhasil diperbarui');
    }

    public function data_index()
    {
        $magazines = Magazine::latest()->get();
        return view('admin.magazines.data_index', compact('magazines'));
    }
    public function toggleStatus($id)
    {
        $magazines = Magazine::findOrFail($id);
        $magazines->status = $magazines->status === 'aktif' ? 'nonaktif' : 'aktif';
        $magazines->save();

        return response()->json([
            'success' => true,
            'status' => $magazines->status,
        ]);
    }

    // public function chart()
    // {

    //     $now = Carbon::now();

    //     // Harian per majalah
    //     $daily = MagazineClick::select(
    //         'magazine_id',
    //         DB::raw('DATE(clicked_at) as date'),
    //         DB::raw('count(*) as total')
    //     )
    //         ->where('clicked_at', '>=', Carbon::now()->subDays(6))
    //         ->groupBy('magazine_id', 'date')
    //         ->with('magazine:id,title')
    //         ->orderBy('date')
    //         ->get()
    //         ->groupBy('magazine_id');

    //     // Mingguan
    //     $weekly = MagazineClick::select(
    //         'magazine_id',
    //         DB::raw('YEARWEEK(clicked_at, 1) as week'),
    //         DB::raw('count(*) as total')
    //     )
    //         ->where('clicked_at', '>=', Carbon::now()->subWeeks(4))
    //         ->groupBy('magazine_id', 'week')
    //         ->with('magazine:id,title')
    //         ->orderBy('week')
    //         ->get()
    //         ->groupBy('magazine_id');

    //     // Bulanan
    //     $monthly = MagazineClick::select(
    //         'magazine_id',
    //         DB::raw('DATE_FORMAT(clicked_at, "%Y-%m") as month'),
    //         DB::raw('count(*) as total')
    //     )
    //         ->where('clicked_at', '>=', Carbon::now()->subMonths(11))
    //         ->groupBy('magazine_id', 'month')
    //         ->with('magazine:id,title')
    //         ->orderBy('month')
    //         ->get()
    //         ->groupBy('magazine_id');

    //     // Tahunan
    //     $yearly = MagazineClick::select(
    //         'magazine_id',
    //         DB::raw('YEAR(clicked_at) as year'),
    //         DB::raw('count(*) as total')
    //     )
    //         ->where('clicked_at', '>=', Carbon::now()->subYears(4))
    //         ->groupBy('magazine_id', 'year')
    //         ->with('magazine:id,title')
    //         ->orderBy('year')
    //         ->get()
    //         ->groupBy('magazine_id');

    //     return view('admin.magazines.report', compact('daily', 'weekly', 'monthly', 'yearly'));
    // }
    public function chart(Request $request)
    {
        $now = Carbon::now();

        $request->validate([
            'magazine_id' => 'nullable|exists:magazines,id',
            'date_range' => 'nullable|in:default,custom',
            'start_date' => 'nullable|required_if:date_range,custom|date',
            'end_date' => 'nullable|required_if:date_range,custom|date|after_or_equal:start_date'
        ]);
        // Get filter parameters
        $magazineId = $request->get('magazine_id');
        $dateRange = $request->get('date_range', 'default');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        // Base query
        $baseQuery = MagazineClick::query();

        if ($magazineId) {
            $baseQuery->where('magazine_id', $magazineId);
        }

        // Daily data
        $dailyQuery = clone $baseQuery;
        $dailyPeriod = $dateRange === 'custom' && $startDate && $endDate
            ? [Carbon::parse($startDate), Carbon::parse($endDate)]
            : [$now->copy()->subDays(6), $now];

        $daily = $dailyQuery->select(
            'magazine_id',
            DB::raw('DATE(clicked_at) as date'),
            DB::raw('count(*) as total')
        )
            ->whereBetween('clicked_at', $dailyPeriod)
            ->groupBy('magazine_id', 'date')
            ->with('magazine:id,title,description')
            ->orderBy('date')
            ->get()
            ->groupBy('magazine_id');

        // Weekly data
        $weeklyQuery = clone $baseQuery;
        $weeklyPeriod = $dateRange === 'custom' && $startDate && $endDate
            ? [Carbon::parse($startDate), Carbon::parse($endDate)]
            : [$now->copy()->subWeeks(4), $now];

        $weekly = $weeklyQuery->select(
            'magazine_id',
            DB::raw('YEARWEEK(clicked_at, 1) as week'),
            DB::raw('count(*) as total')
        )
            ->whereBetween('clicked_at', $weeklyPeriod)
            ->groupBy('magazine_id', 'week')
            ->with('magazine:id,title,description')
            ->orderBy('week')
            ->get()
            ->groupBy('magazine_id');

        // Monthly data
        $monthlyQuery = clone $baseQuery;
        $monthlyPeriod = $dateRange === 'custom' && $startDate && $endDate
            ? [Carbon::parse($startDate), Carbon::parse($endDate)]
            : [$now->copy()->subMonths(11), $now];

        $monthly = $monthlyQuery->select(
            'magazine_id',
            DB::raw('DATE_FORMAT(clicked_at, "%Y-%m") as month'),
            DB::raw('count(*) as total')
        )
            ->whereBetween('clicked_at', $monthlyPeriod)
            ->groupBy('magazine_id', 'month')
            ->with('magazine:id,title,description')
            ->orderBy('month')
            ->get()
            ->groupBy('magazine_id');

        // Yearly data
        $yearlyQuery = clone $baseQuery;
        $yearlyPeriod = $dateRange === 'custom' && $startDate && $endDate
            ? [Carbon::parse($startDate), Carbon::parse($endDate)]
            : [$now->copy()->subYears(4), $now];

        $yearly = $yearlyQuery->select(
            'magazine_id',
            DB::raw('YEAR(clicked_at) as year'),
            DB::raw('count(*) as total')
        )
            ->whereBetween('clicked_at', $yearlyPeriod)
            ->groupBy('magazine_id', 'year')
            ->with('magazine:id,title,description')
            ->orderBy('year')
            ->get()
            ->groupBy('magazine_id');

        // Get all magazines for filter dropdown
        $magazines = Magazine::select('id', 'title')
            ->orderBy('title')
            ->get();

        // Calculate summary statistics with null checks
        $totalClicksQuery = clone $baseQuery;
        $totalClicks = $totalClicksQuery->count();

        $totalMagazinesQuery = $magazineId
            ? $baseQuery->where('magazine_id', $magazineId)
            : clone $baseQuery;
        $totalMagazines = $totalMagazinesQuery->distinct('magazine_id')->count('magazine_id');

        $todayClicksQuery = $magazineId
            ? MagazineClick::where('magazine_id', $magazineId)
            : MagazineClick::query();
        $todayClicks = $todayClicksQuery->whereDate('clicked_at', $now->toDateString())->count();

        // Calculate average clicks per day correctly with null checks
        $dailyCounts = MagazineClick::select(
            DB::raw('DATE(clicked_at) as date'),
            DB::raw('count(*) as click_count')
        )
            ->where('clicked_at', '>=', $now->copy()->subDays(30))
            ->groupBy('date')
            ->get()
            ->pluck('click_count')
            ->toArray();

        $avgClicksPerDay = count($dailyCounts) > 0 ? array_sum($dailyCounts) / count($dailyCounts) : 0;

        $summary = [
            'total_clicks' => $totalClicks,
            'total_magazines' => $totalMagazines,
            'today_clicks' => $todayClicks,
            'avg_clicks_per_day' => round($avgClicksPerDay, 2),
        ];

        // Ensure all data variables are arrays to prevent count() errors
        $daily = $daily ?? collect();
        $weekly = $weekly ?? collect();
        $monthly = $monthly ?? collect();
        $yearly = $yearly ?? collect();

        return view('admin.magazines.report', compact(
            'daily',
            'weekly',
            'monthly',
            'yearly',
            'magazines',
            'summary',
            'magazineId',
            'dateRange',
            'startDate',
            'endDate'
        ));
    }

    public function export(Request $request)
    {
        try {
            $data = $this->prepareReportData($request);
            $fileName = 'magazine_clicks_' . date('Y-m-d_His') . '.xlsx';
            return Excel::download(new MagazineClickExport, $fileName);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error exporting data: ' . $e->getMessage());
        }
    }
    public function getTopMagazines(Request $request)
    {
        $period = $request->get('period', 'daily'); // daily, weekly, monthly, yearly
        $limit = $request->get('limit', 10);

        $query = MagazineClick::select(
            'magazine_id',
            DB::raw('count(*) as total_clicks')
        )
            ->with('magazine:id,title,description');

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

        $topMagazines = $query->groupBy('magazine_id')
            ->orderBy('total_clicks', 'desc')
            ->limit($limit)
            ->get();

        return response()->json($topMagazines);
    }

    public function getClickTrends(Request $request)
    {
        $magazineId = $request->get('magazine_id');
        $period = $request->get('period', 'daily');
        $days = $request->get('days', 30);

        $query = MagazineClick::query();

        if ($magazineId) {
            $query->where('magazine_id', $magazineId);
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

    public function getMagazineComparison(Request $request)
    {
        $magazineIds = $request->get('magazine_ids', []);
        $period = $request->get('period', 'monthly');

        if (empty($magazineIds)) {
            return response()->json(['error' => 'No magazines selected'], 400);
        }

        $results = [];

        foreach ($magazineIds as $magazineId) {
            $query = MagazineClick::where('magazine_id', $magazineId);

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

            $magazine = \App\Models\Magazine::find($magazineId);

            $results[] = [
                'magazine_id' => $magazineId,
                'magazine_title' => $magazine->title ?? 'Unknown',
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
        $pdf->loadView('admin.magazines.report-pdf', $data);

        return $pdf->download('magazine_report_' . date('Y-m-d') . '.pdf');
    }

    private function prepareReportData(Request $request)
    {
        $now = Carbon::now();

        // Get filter parameters
        $magazineId = $request->get('magazine_id');
        $dateRange = $request->get('date_range', 'default');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        // Base query
        $baseQuery = MagazineClick::query();

        if ($magazineId) {
            $baseQuery->where('magazine_id', $magazineId);
        }

        // Set date range based on filter
        if ($dateRange === 'custom' && $startDate && $endDate) {
            $baseQuery->whereBetween('clicked_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }

        // Get all click data with magazine information
        $clickData = $baseQuery->with('magazine:id,title,description')
            ->orderBy('clicked_at', 'desc')
            ->get();

        return [
            'clicks' => $clickData,
            'total_clicks' => $clickData->count(),
            'date_range' => $dateRange,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'magazine_id' => $magazineId
        ];
    }
    // public function export()
    // {
    //     return Excel::download(new MagazineClickExport, 'magazine_clicks.xlsx');
    // }
}
