<!DOCTYPE html>
<html lang="en">

<head>
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
                        <h3 class="fw-bold mb-3">Berkas</h3>
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
                                        <h4 class="card-title">Detail Absensi</h4>
                                        {{-- <a href="{{ route('berita.create') }}" class="btn btn-primary btn-round ms-auto">
                                            <i class="fa fa-plus"></i>
                                            tambah
                                        </a> --}}
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
                                                {{-- @if(Auth::user()->role === 'admin')
                                                @endif --}}
                                                 <p><strong>Nama:</strong> {{ $attendance->user?->name ?? 'User Tidak Ditemukan' }}</p>
                                                <p><strong>Tanggal:</strong> {{ $attendance->tanggal }}</p>
                                                <p><strong>Jam:</strong> {{ $attendance->jam }}</p>
                                                <p><strong>Status:</strong> {{ $attendance->status }}</p>
                                                <p><strong>Latitude:</strong> {{ $attendance->latitude }}</p>
                                                <p><strong>Longitude:</strong> {{ $attendance->longitude }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <p><strong>Foto:</strong></p>
                                                <img src="{{ asset('absen/' . $attendance->gambar) }}" alt="Foto Absen" class="img-fluid">
                                            </div>
                                        </div>
                                         
                                        <div class="mt-3">
                                            <a href="{{ route('absens.index') }}" class="btn btn-secondary">Kembali</a>
                                        </div>
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
</body>

</html>