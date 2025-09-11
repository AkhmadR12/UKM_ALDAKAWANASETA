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
                                        <h4 class="card-title">Carausel</h4>
                                        <a href="{{ route('berita.create') }}" class="btn btn-primary btn-round ms-auto">
                                            <i class="fa fa-plus"></i>
                                            tambah
                                        </a>
                                        {{-- @endif --}}
                                    </div>
                                </div>                
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="card">
                                    <div class="card-header">
                                        <h1>{{ $berita->judul }}</h1>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                @if($berita->is_terkini)
                                                    <span class="badge bg-success">Berita Terkini</span>
                                                @endif
                                                @if($berita->is_update)
                                                    <span class="badge bg-primary">Berita Update</span>
                                                @endif
                                            </div>
                                            <div>
                                                <small class="text-muted">Dipublikasikan pada: {{ $berita->tanggal->format('d F Y') }} {{ $berita->jam }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                        <div class="mb-4">
                                            {!! nl2br(e($berita->deskripsi)) !!}
                                        </div>
                                        
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($berita->{'gambar'.$i} || $berita->{'deskripsi'.$i})
                                            <div class="mb-4 p-3 border rounded">
                                                @if($berita->{'gambar'.$i})
                                                    <img src="{{ asset('storage/' . $berita->{'gambar'.$i}) }}" alt="Gambar {{$i}}" class="img-fluid mb-3">
                                                @endif
                                                
                                                @if($berita->{'deskripsi'.$i})
                                                    <div>{!! nl2br(e($berita->{'deskripsi'.$i})) !!}</div>
                                                @endif
                                            </div>
                                            @endif
                                        @endfor
                                    </div>
                                    
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-between">
                                            @if($berita->dokumentasi_link)
                                            <div>
                                                Dokumentasi: 
                                                <a href="{{ $berita->dokumentasi_link }}" target="_blank">
                                                    {{ $berita->dokumentasi_nama ? '@'.$berita->dokumentasi_nama : 'Instagram' }}
                                                </a>
                                            </div>
                                            @endif
                                            
                                            @if($berita->editor_link)
                                            <div>
                                                Editor: 
                                                <a href="{{ $berita->editor_link }}" target="_blank">
                                                    {{ $berita->editor_nama ? '@'.$berita->editor_nama : 'Instagram' }}
                                                </a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <a href="{{ route('berita.index') }}" class="btn btn-secondary">Kembali ke Daftar Berita</a>
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