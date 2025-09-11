<?php

namespace App\Exports;

use App\Models\MagazineClick;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB; 
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class MagazineClickExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Harian' => new DailyClickExport(),
            'Mingguan' => new WeeklyClickExport(),
            'Bulanan' => new MonthlyClickExport(),
            'Tahunan' => new YearlyClickExport(),
            'Ringkasan' => new SummaryClickExport(),
        ];
    }
}

class DailyClickExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return MagazineClick::select(
            'magazine_id',
            DB::raw('DATE(clicked_at) as date'),
            DB::raw('count(*) as total')
        )
            ->where('clicked_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('magazine_id', 'date')
            ->with('magazine:id,title,description')
            ->orderBy('date', 'desc')
            ->orderBy('total', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID Majalah',
            'Judul Majalah',
            'Deskripsi',
            'Tanggal',
            'Jumlah Klik',
            'Persentase (%)'
        ];
    }

    public function map($row): array
    {
        $totalClicks = $this->collection()->sum('total');
        $percentage = $totalClicks > 0 ? round(($row->total / $totalClicks) * 100, 2) : 0;

        return [
            $row->magazine_id,
            $row->magazine->title ?? 'N/A',
            $row->magazine->description ?? 'N/A',
            Carbon::parse($row->date)->format('d/m/Y'),
            $row->total,
            $percentage . '%'
        ];
    }

    public function title(): string
    {
        return 'Data Harian';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => '4472C4']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
            ],
            'A:F' => [
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER]
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 12,
            'B' => 30,
            'C' => 40,
            'D' => 15,
            'E' => 15,
            'F' => 15,
        ];
    }
}

class WeeklyClickExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return MagazineClick::select(
            'magazine_id',
            DB::raw('YEARWEEK(clicked_at, 1) as week'),
            DB::raw('count(*) as total')
        )
            ->where('clicked_at', '>=', Carbon::now()->subWeeks(4))
            ->groupBy('magazine_id', 'week')
            ->with('magazine:id,title,description')
            ->orderBy('week', 'desc')
            ->orderBy('total', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID Majalah',
            'Judul Majalah',
            'Deskripsi',
            'Minggu (YYYYWW)',
            'Periode Minggu',
            'Jumlah Klik',
            'Persentase (%)'
        ];
    }

    public function map($row): array
    {
        $totalClicks = $this->collection()->sum('total');
        $percentage = $totalClicks > 0 ? round(($row->total / $totalClicks) * 100, 2) : 0;
        
        $year = substr($row->week, 0, 4);
        $week = substr($row->week, 4, 2);
        $weekPeriod = "Minggu ke-{$week}, {$year}";

        return [
            $row->magazine_id,
            $row->magazine->title ?? 'N/A',
            $row->magazine->description ?? 'N/A',
            $row->week,
            $weekPeriod,
            $row->total,
            $percentage . '%'
        ];
    }

    public function title(): string
    {
        return 'Data Mingguan';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => '70AD47']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
            ],
            'A:G' => [
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER]
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 12,
            'B' => 30,
            'C' => 40,
            'D' => 15,
            'E' => 20,
            'F' => 15,
            'G' => 15,
        ];
    }
}

class MonthlyClickExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return MagazineClick::select(
            'magazine_id',
            DB::raw('DATE_FORMAT(clicked_at, "%Y-%m") as month'),
            DB::raw('count(*) as total')
        )
            ->where('clicked_at', '>=', Carbon::now()->subMonths(11))
            ->groupBy('magazine_id', 'month')
            ->with('magazine:id,title,description')
            ->orderBy('month', 'desc')
            ->orderBy('total', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID Majalah',
            'Judul Majalah',
            'Deskripsi',
            'Bulan (YYYY-MM)',
            'Nama Bulan',
            'Jumlah Klik',
            'Persentase (%)'
        ];
    }

    public function map($row): array
    {
        $totalClicks = $this->collection()->sum('total');
        $percentage = $totalClicks > 0 ? round(($row->total / $totalClicks) * 100, 2) : 0;
        
        $monthName = Carbon::createFromFormat('Y-m', $row->month)->format('F Y');

        return [
            $row->magazine_id,
            $row->magazine->title ?? 'N/A',
            $row->magazine->description ?? 'N/A',
            $row->month,
            $monthName,
            $row->total,
            $percentage . '%'
        ];
    }

    public function title(): string
    {
        return 'Data Bulanan';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'FFC000']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
            ],
            'A:G' => [
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER]
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 12,
            'B' => 30,
            'C' => 40,
            'D' => 15,
            'E' => 20,
            'F' => 15,
            'G' => 15,
        ];
    }
}

class YearlyClickExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return MagazineClick::select(
            'magazine_id',
            DB::raw('YEAR(clicked_at) as year'),
            DB::raw('count(*) as total')
        )
            ->where('clicked_at', '>=', Carbon::now()->subYears(4))
            ->groupBy('magazine_id', 'year')
            ->with('magazine:id,title,description')
            ->orderBy('year', 'desc')
            ->orderBy('total', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID Majalah',
            'Judul Majalah',
            'Deskripsi',
            'Tahun',
            'Jumlah Klik',
            'Persentase (%)'
        ];
    }

    public function map($row): array
    {
        $totalClicks = $this->collection()->sum('total');
        $percentage = $totalClicks > 0 ? round(($row->total / $totalClicks) * 100, 2) : 0;

        return [
            $row->magazine_id,
            $row->magazine->title ?? 'N/A',
            $row->magazine->description ?? 'N/A',
            $row->year,
            $row->total,
            $percentage . '%'
        ];
    }

    public function title(): string
    {
        return 'Data Tahunan';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => 'C5504B']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
            ],
            'A:F' => [
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER]
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 12,
            'B' => 30,
            'C' => 40,
            'D' => 15,
            'E' => 15,
            'F' => 15,
        ];
    }
}

class SummaryClickExport implements FromCollection, WithHeadings, WithMapping, WithTitle, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return MagazineClick::select(
            'magazine_id',
            DB::raw('count(*) as total_clicks'),
            DB::raw('MIN(clicked_at) as first_click'),
            DB::raw('MAX(clicked_at) as last_click'),
            DB::raw('COUNT(DISTINCT DATE(clicked_at)) as active_days')
        )
            ->groupBy('magazine_id')
            ->with('magazine:id,title,description,created_at')
            ->orderBy('total_clicks', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Ranking',
            'ID Majalah',
            'Judul Majalah',
            'Deskripsi',
            'Total Klik',
            'Persentase (%)',
            'Klik Pertama',
            'Klik Terakhir',
            'Hari Aktif',
            'Rata-rata Klik/Hari',
            'Status'
        ];
    }

    public function map($row): array
    {
        static $rank = 1;
        $totalClicks = $this->collection()->sum('total_clicks');
        $percentage = $totalClicks > 0 ? round(($row->total_clicks / $totalClicks) * 100, 2) : 0;
        $avgClicksPerDay = $row->active_days > 0 ? round($row->total_clicks / $row->active_days, 2) : 0;
        
        $lastClickDate = Carbon::parse($row->last_click);
        $daysSinceLastClick = $lastClickDate->diffInDays(Carbon::now());
        
        if ($daysSinceLastClick <= 1) {
            $status = 'Sangat Aktif';
        } elseif ($daysSinceLastClick <= 7) {
            $status = 'Aktif';
        } elseif ($daysSinceLastClick <= 30) {
            $status = 'Cukup Aktif';
        } else {
            $status = 'Kurang Aktif';
        }

        return [
            $rank++,
            $row->magazine_id,
            $row->magazine->title ?? 'N/A',
            $row->magazine->description ?? 'N/A',
            $row->total_clicks,
            $percentage . '%',
            Carbon::parse($row->first_click)->format('d/m/Y H:i'),
            Carbon::parse($row->last_click)->format('d/m/Y H:i'),
            $row->active_days,
            $avgClicksPerDay,
            $status
        ];
    }

    public function title(): string
    {
        return 'Ringkasan';
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'color' => ['rgb' => '7030A0']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
            ],
            'A:K' => [
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER]
            ],
            'K:K' => [
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 12,
            'C' => 30,
            'D' => 40,
            'E' => 12,
            'F' => 12,
            'G' => 18,
            'H' => 18,
            'I' => 12,
            'J' => 15,
            'K' => 15,
        ];
    }
}