<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">DATA BUKU TAMU</h2>
        
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('buku-tamu.create') }}" class="btn btn-primary">Tambah Tamu</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Nama Rimba</th>
                        <th>Organisasi</th>
                        <th>Angkatan</th>
                        <th>Keperluan</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataTamu as $key => $tamu)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $tamu->email }}</td>
                        <td>{{ $tamu->nama }}</td>
                        <td>{{ $tamu->nama_rimba ?? '-' }}</td>
                        <td>{{ $tamu->organisasi }}</td>
                        <td>{{ $tamu->angkatan }}</td>
                        <td>
                            @if($tamu->keperluan === 'lainnya')
                                {{ $tamu->keperluan_lainnya }}
                            @else
                                @php
                                    $keperluanOptions = [
                                        'bertamu' => 'Bertamu',
                                        'mengirim_surat_milad' => 'Mengirim Surat Milad',
                                        'mengirim_surat_peminjaman' => 'Mengirim Surat Peminjaman',
                                        'mengambil_alat' => 'Mengambil Alat',
                                        'mengembalikan_alat' => 'Mengembalikan Alat',
                                        'belajar' => 'Belajar'
                                    ];
                                @endphp
                                {{ $keperluanOptions[$tamu->keperluan] ?? $tamu->keperluan }}
                            @endif
                        </td>
                        <td>{{ $tamu->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data tamu</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>