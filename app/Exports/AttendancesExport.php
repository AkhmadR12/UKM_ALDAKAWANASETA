<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendancesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $attendances;

    public function __construct($attendances)
    {
        $this->attendances = $attendances;
    }

    public function collection()
    {
        return $this->attendances;
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Tanggal',
            'Jam',
            'Status',
            
        ];
    }

    public function map($attendance): array
    {
        static $i = 1;
        return [
            $i++,
            $attendance->user->name,
            $attendance->tanggal,
            $attendance->jam,
            $attendance->status,
        ];
    }
}
