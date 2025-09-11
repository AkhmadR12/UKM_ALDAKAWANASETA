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
                            <h3 class="fw-bold mb-3">Categori Barang</h3>
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
                                            <h4 class="card-title">Detail Peminjaman</h4>
                                            
                                            {{-- @endif --}}
                                        </div>
                                    </div>                
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                    
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p><strong>Peminjam:</strong> {{ $rental->renter_name }}</p>
                                                <p><strong>Telepon:</strong> {{ $rental->renter_phone }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Tanggal Mulai:</strong> {{ $rental->start_date->format('d/m/Y') }}</p>
                                                <p><strong>Tanggal Selesai:</strong> {{ $rental->end_date->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                        

                                    <form action="{{ route('rentals.check.store', $rental) }}" method="POST">
                                        @csrf
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Daftar Barang</h4>
                                            </div>
                                            <div class="card-body">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Barang</th>
                                                            <th>Jumlah Dipinjam</th>
                                                            <th>Sudah Dicek</th>
                                                            <th>Jumlah Dicek</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($rental->rentalItems as $rentalItem)
                                                        <tr>
                                                            <td>{{ $rentalItem->item->name }}</td>
                                                            <td>{{ $rentalItem->quantity }}</td>
                                                            <td>{{ $checkedItems[$rentalItem->item_id] ?? 0 }}</td>
                                                            <td>
                                                                <input type="number" 
                                                                    name="items[{{ $rentalItem->item_id }}][quantity]" 
                                                                    class="form-control" 
                                                                    min="0" 
                                                                    max="{{ $rentalItem->quantity - ($checkedItems[$rentalItem->item_id] ?? 0) }}"
                                                                    value="0">
                                                                <input type="hidden" name="items[{{ $rentalItem->item_id }}][id]" value="{{ $rentalItem->item_id }}">
                                                            </td>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox" 
                                                                        name="items[{{ $rentalItem->item_id }}][is_returned]" 
                                                                        value="1" 
                                                                        class="form-check-input" 
                                                                        id="returned-{{ $rentalItem->item_id }}">
                                                                    <label class="form-check-label" for="returned-{{ $rentalItem->item_id }}">
                                                                        Sudah Dikembalikan
                                                                    </label>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <div class="form-group">
                                                    <label for="notes">Catatan</label>
                                                    <textarea name="notes" id="notes" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary">Simpan Pengecekan</button>
                                                <a href="{{ route('rentals.index', $rental) }}" class="btn btn-secondary">Kembali</a>
                                            </div>
                                        </div>
                                    </form>


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