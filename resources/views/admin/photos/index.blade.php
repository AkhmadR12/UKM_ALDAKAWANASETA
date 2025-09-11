<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <link rel="icon" href="../assets/img/logo/fav.ico" type="image/x-icon" />
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
                                        <h4 class="card-title">Berita</h4>
                                        <a href="{{ route('photo.create') }}" class="btn btn-primary btn-round ms-auto">
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
                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Judul</th>
                                                    <th>Tipe</th>
                                                    <th>file</th>
                                                    {{-- <th>Status</th> --}}
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($photos as $key => $photo)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $photo->name }}</td>
                                                        <td>{{ $photo->title }}</td>
                                                        <td>
                                                            <img src="{{ asset($photo->cover) }}" alt="file_path" width="100">
                                                        </td> 
                                                        {{-- <td>
                                                            @if(!$photo->is_active)
                                                                <form action="{{ route('admin.photo.toggle', $photo->id) }}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                                                        Non aktif
                                                                    </button>
                                                                </form>
                                                            @else
                                                                <form action="{{ route('admin.photo.toggle', $photo->id) }}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="bg-green-500 text-black px-3 py-1 rounded hover:bg-green-600">
                                                                        aktif
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td> --}}


                                                        <td>
                                                             <a href="{{ route('photo.edit', $photo->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                            <form action="{{ route('photo.destroy', $photo->id) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
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
</body>

</html>