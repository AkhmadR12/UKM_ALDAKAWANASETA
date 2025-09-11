<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    {{-- <link rel="icon" href="../assets/img/logo/fav.ico" type="image/x-icon" /> --}}
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
                    <div class="logo-header" data-background-color="blue2">
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
                            <h3 class="fw-bold mb-3">Cek Barang</h3>
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
                        <h2>Hasil Pengecekan Peminjaman</h2>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h4>Informasi Peminjaman</h4>
                                        <span class="badge badge-{{ $rental->status === 'approved' ? 'success' : ($rental->status === 'completed' ? 'info' : 'warning') }}">
                                            {{ strtoupper($rental->status) }}
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Peminjam:</strong> {{ $rental->renter_name }}</p>
                                                <p><strong>Telepon:</strong> {{ $rental->renter_phone }}</p>
                                                <p><strong>Dibuat oleh:</strong> {{ $rental->user->name }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Tanggal Mulai:</strong> {{ $rental->start_date->format('d/m/Y') }}</p>
                                                <p><strong>Tanggal Selesai:</strong> {{ $rental->end_date->format('d/m/Y') }}</p>
                                                {{-- <p><strong>Total Harga:</strong> Rp {{ number_format($rental->total_price, 0, ',', '.') }}</p> --}}
                                            </div>
                                        </div>
                                        
                                        @if($rental->status === 'approved')
                                        <div class="mt-3">
                                            <a href="{{ route('rentals.check.create', $rental) }}" class="btn btn-primary">
                                                Lakukan Pengecekan
                                            </a>
                                            <a href="{{ route('rentals.index', $rental) }}" class="btn btn-secondary">Kembali</a>

                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h4>Barang yang Dipinjam</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah Dipinjam</th>
                                                    <th>Jumlah Sudah Dikembalikan</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($rental->rentalItems as $item)
                                                @php
                                                    $returnedQty = $rental->checkItems
                                                        ->where('item_id', $item->item_id)
                                                        ->where('is_returned', true)
                                                        ->sum('quantity');
                                                    $allReturned = $returnedQty >= $item->quantity;
                                                @endphp
                                                <tr>
                                                    <td>{{ $item->item->name }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $returnedQty }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $allReturned ? 'success' : 'warning' }}">
                                                            {{ $allReturned ? 'Lengkap' : 'Belum Lengkap' }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                @if($rental->checkItems->count() > 0)
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Riwayat Pengecekan</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Barang</th>
                                                    <th>Jumlah</th>
                                                    <th>Status</th>
                                                    <th>Dicek oleh</th>
                                                    <th>Catatan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($rental->checkItems as $check)
                                                <tr>
                                                    <td>{{ $check->checked_at->format('d/m/Y H:i') }}</td>
                                                    <td>{{ $check->item->name }}</td>
                                                    <td>{{ $check->quantity }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $check->is_returned ? 'success' : 'warning' }}">
                                                            {{ $check->is_returned ? 'Dikembalikan' : 'Belum Dikembalikan' }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $check->checkedBy->name }}</td>
                                                    <td>{{ $check->notes ?? '-' }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @else
                                <div class="alert alert-info">
                                    Belum ada pengecekan untuk peminjaman ini.
                                </div>
                                @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @include('admin.footer')
        </div>
        <!-- End Custom template -->
        {{-- @include('admin.custume') --}}
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    @include('admin.js')
     

</body>

</html>