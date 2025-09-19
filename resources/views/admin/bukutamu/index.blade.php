<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('admin.css')
</head>
<body>
     <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="green2">
                        {{-- <a href="index.html" class="logo">
                            <img src="admin/assets/img/logo/logo-ligh.svg" alt="navbar brand" class="navbar-brand"
                                height="20" />
                        </a> --}}
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar -->
                <x-app-layout>
                </x-app-layout>
                {{-- @include('admin.navbar') --}}
                <!-- End Navbar -->
            </div>
            <!-- body -->
            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Buku Tamu</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Tables</a>
                            </li>

                        </ul>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Buku Tamu</h4>
                                        </div>
                                </div>                
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-hover">
                                            <thead>
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
                            </div>
                        </div>
                    </div>
                </div>
            @include('admin.footer')
        </div>
    </div>
    <!--   Core JS Files   -->
    @include('admin.js')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>