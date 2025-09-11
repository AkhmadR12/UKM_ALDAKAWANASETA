<?php

namespace App\Http\Controllers;

// use App\Models\Attendance;

use Carbon\Carbon;
use App\Exports\AttendancesExport;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $user = Auth::user();
    //     $today = Carbon::now()->toDateString();

    //     // Cek apakah sudah absen hari ini
    //     $todayAttendance = Attendance::where('user_id', $user->id)
    //         ->where('tanggal', $today)
    //         ->first();

    //     // Query dasar untuk absensi
    //     $query = Attendance::with('user');

    //     // Jika bukan admin, filter hanya data user sendiri
    //     if ($user->role !== 'admin') {
    //         $query->where('user_id', $user->id);
    //     }

    //     // Urutkan dan paginate
    //     $attendances = $query->orderBy('tanggal', 'desc')
    //         ->orderBy('jam', 'desc')
    //         ->paginate(10);

    //     return view('admin.absen.index', compact('attendances', 'todayAttendance', 'user'));
    // }
    public function index(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::now()->toDateString();
        $now = Carbon::now(); // Tambahkan ini untuk dikirim ke view

        // Cek apakah sudah absen hari ini
        $todayAttendance = Attendance::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        // Query dasar untuk absensi
        $query = Attendance::with('user');

        // Jika bukan admin, filter hanya data user sendiri
        if ($user->role !== 'admin') {
            $query->where('user_id', $user->id);
        }

        // Filter berdasarkan tanggal jika ada
        if ($request->has('start_date') && $request->start_date != '') {
            $query->where('tanggal', '>=', $request->start_date);
        } else {
            // Default: 1 bulan terakhir
            $query->where('tanggal', '>=', Carbon::now()->subMonth()->toDateString());
        }

        if ($request->has('end_date') && $request->end_date != '') {
            $query->where('tanggal', '<=', $request->end_date);
        }

        // Urutkan dan paginate
        $attendances = $query->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->paginate(10);

        // Tambahkan parameter filter ke pagination links
        if ($request->has('start_date')) {
            $attendances->appends(['start_date' => $request->start_date]);
        }
        if ($request->has('end_date')) {
            $attendances->appends(['end_date' => $request->end_date]);
        }

        return view('admin.absen.index', [
            'attendances' => $attendances,
            'todayAttendance' => $todayAttendance,
            'user' => $user,
            'now' => $now, // Pastikan ini dikirim ke view
            'defaultStartDate' => Carbon::now()->subMonth()->format('Y-m-d'), // Tambahkan ini
            'defaultEndDate' => Carbon::now()->format('Y-m-d'), // Tambahkan ini
        ]);
    }

    public function destroyByDate(Request $request)
    {
        // Hanya admin yang bisa menghapus
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        $request->validate([
            'delete_start_date' => 'required|date',
            'delete_end_date' => 'required|date|after_or_equal:delete_start_date',
        ]);

        $startDate = $request->delete_start_date;
        $endDate = $request->delete_end_date;

        // Dapatkan data yang akan dihapus untuk menghapus file gambar juga
        $attendancesToDelete = Attendance::whereBetween('tanggal', [$startDate, $endDate])->get();

        foreach ($attendancesToDelete as $attendance) {
            // Hapus file gambar jika ada
            if ($attendance->foto) {
                $filePath = public_path('absen/' . $attendance->foto);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Hapus record dari database
            $attendance->delete();
        }

        return redirect()->route('absens.index')
            ->with('success', "Data absen dari $startDate sampai $endDate berhasil dihapus.");
    }

    public function export(Request $request)
    {
        // Hanya admin yang bisa export
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
        }

        $request->validate([
            'export_start_date' => 'required|date',
            'export_end_date' => 'required|date|after_or_equal:export_start_date',
        ]);

        $startDate = $request->export_start_date;
        $endDate = $request->export_end_date;

        $attendances = Attendance::with('user')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->get();

        // Generate Excel
        return Excel::download(new AttendancesExport($attendances), "data_absen_{$startDate}_to_{$endDate}.xlsx");
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.absen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // jika tidak bisa yang store di bawah menggunakan 
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    //     ]);

    //     $today = Carbon::now()->toDateString();

    //     // Cek apakah sudah absen hari ini
    //     $check = Attendance::where('user_id', Auth::id())
    //         ->where('tanggal', $today)
    //         ->first();

    //     if ($check) {
    //         return redirect()->back()->with('error', 'Anda sudah absen hari ini!');
    //     }

    //     // Proses upload gambar menggunakan Laravel Storage
    //     if ($request->hasFile('gambar')) {
    //         $image = $request->file('gambar');
    //         $filename = time() . '_' . Auth::id() . '.' . $image->getClientOriginalExtension();

    //         // Simpan gambar menggunakan Storage
    //         $path = $image->storeAs('absen', $filename, 'public');
    //     }

    //     // Gunakan lokasi dari request jika ada, jika tidak gunakan nilai default
    //     $latitude = $request->latitude ?? -7.0271433;
    //     $longitude = $request->longitude ?? 110.3313092;

    //     Attendance::create([
    //         'user_id'   => Auth::id(),
    //         'tanggal'   => $today,
    //         'jam'       => Carbon::now()->toTimeString(),
    //         'latitude'  => $latitude,
    //         'longitude' => $longitude,
    //         'gambar'    => $filename,
    //         'status'    => 'Hadir'
    //     ]);

    //     return redirect()->route('absen.index')->with('success', 'Absensi berhasil!');
    // }
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:6048'
        ]);

        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $jam = Carbon::now('Asia/Jakarta')->toTimeString();

        // Cek apakah sudah absen hari ini
        $check = Attendance::where('user_id', Auth::id())
            ->where('tanggal', $today)
            ->first();

        if ($check) {
            return redirect()->back()->with('error', 'Anda sudah absen hari ini!');
        }

        // Proses upload gambar
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = time() . '_' . Auth::id() . '.' . $image->getClientOriginalExtension();

            // Simpan gambar ke folder public/absen
            $path = public_path('absen/' . $filename);

            // Resize dan simpan gambar
            Image::make($image->getRealPath())
                ->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($path);
        }

        // Dapatkan lokasi jika tersedia, jika tidak gunakan nilai default

        Attendance::create([
            'user_id'   => Auth::id(),
            'tanggal'   => $today,
            'jam'       => $jam,
            'gambar'    => $filename,
            'status'    => 'Hadir'
        ]);

        return redirect()->route('absens.index')->with('success', 'Absensi berhasil!');
    }
    // Hitung jarak 2 titik koordinat (Haversine formula)
    private function distance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }

    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        $user = Auth::user();

        // Pastikan user hanya bisa melihat data miliknya sendiri kecuali admin
        if ($user->role !== 'admin' && $user->id !== $attendance->user_id) {
            abort(403, 'Unauthorized action.');
        }

        // Load user relationship dengan eager loading
        $attendance->load('user');

        return view('admin.absen.show', compact('attendance'));
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
