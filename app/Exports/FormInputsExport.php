<?php

namespace App\Exports;

use App\Models\FormInput;
use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FormInputsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle
{
    protected $filters;
    protected $forms;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
        $this->forms = $this->getFilteredForms();
    }

    protected function getFilteredForms()
    {
        $query = FormInput::with('kategori');

        // Apply filters
        if (!empty($this->filters['category'])) {
            $query->where('kategori_id', $this->filters['category']);
        }

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('organisasi', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nomor_telp', 'like', "%{$search}%");
            });
        }

        return $query->get();
    }

    public function collection()
    {
        return $this->forms;
    }

    public function headings(): array
    {
        $filterInfo = $this->getFilterInfo();

        return [
            ['LAPORAN DATA FORMULIR'], // Judul utama
            [$filterInfo], // Info filter
            [], // Baris kosong
            [ // Header kolom
                'No',
                'Nama Lengkap',
                'Kategori',
                'Organisasi',
                'Jabatan',
                'Jenis Anggota',
                'Nomor Anggota',
                'Alamat',
                'Kota',
                'Provinsi',
                'Nomor Telepon',
                'Email',
                'Jenis Usaha',
                'NIK',
                'Jenis Kelamin',
                'Tempat Tanggal Lahir',
                'Pekerjaan',
                'Jenis Foto',
                'Deskripsi',
                'Ukuran',
                'Status',
                'Validasi',
                'Validasi Bukti',
                'Portofolio',
                'Info Tambahan',
                'Tanggal Dibuat'
            ]
        ];
    }

    public function map($form): array
    {
        return [
            $form->id,
            $form->nama,
            $form->kategori->nama_kategori ?? 'Tidak ada kategori',
            $form->organisasi,
            $form->jabatan,
            $form->jenis_anggota,
            $form->nomor_anggota,
            $form->alamat,
            $form->kota,
            $form->provinsi,
            $form->nomor_telp,
            $form->email,
            $form->usaha,
            $form->nik,
            $this->getJenisKelaminText($form->jenis_kelamin),
            $form->ttl,
            $form->pekerjaan,
            $form->jenis_foto,
            $form->deskripsi,
            $form->ukuran,
            $this->getStatusText($form->status),
            $this->getValidasiText($form->validasi),
            $this->getValidasiText($form->validasi_bukti),
            $form->portofolio ? 'Ada' : 'Tidak Ada',
            $form->info,
            $form->created_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Style untuk judul utama
        $sheet->mergeCells('A1:Z1');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Style untuk info filter
        $sheet->mergeCells('A2:Z2');
        $sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'italic' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Style untuk header kolom
        $sheet->getStyle('A4:Z4')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFE6E6FA']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Style untuk data
        $sheet->getStyle('A5:Z' . (4 + $this->forms->count()))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        // Auto size semua kolom
        foreach (range('A', 'Z') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return [];
    }

    public function title(): string
    {
        return 'Data Formulir';
    }

    protected function getFilterInfo()
    {
        $filters = [];
        $kategoris = Kategori::all();

        if (!empty($this->filters['category'])) {
            $kategori = $kategoris->where('id', $this->filters['category'])->first();
            $filters[] = 'Kategori: ' . ($kategori->nama_kategori ?? 'Unknown');
        }

        if (!empty($this->filters['status'])) {
            $filters[] = 'Status: ' . $this->getStatusText($this->filters['status']);
        }

        if (!empty($this->filters['search'])) {
            $filters[] = 'Pencarian: "' . $this->filters['search'] . '"';
        }

        if (empty($filters)) {
            return 'Semua Data';
        }

        return 'Filter: ' . implode(' | ', $filters);
    }

    protected function getJenisKelaminText($jenisKelamin)
    {
        return match ($jenisKelamin) {
            'L' => 'Laki-laki',
            'P' => 'Perempuan',
            default => '-'
        };
    }

    protected function getStatusText($status)
    {
        return match ($status) {
            'OPEN' => 'Open',
            'INPG' => 'In Progress',
            'CLSD' => 'Closed',
            'BATAL' => 'Dibatalkan',
            default => $status
        };
    }

    protected function getValidasiText($validasi)
    {
        return $validasi == 'on' ? 'Valid' : 'Tidak Valid';
    }
}
