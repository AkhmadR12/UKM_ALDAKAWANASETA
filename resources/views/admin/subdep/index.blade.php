<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <link rel="icon" href="admin/assets/img/logo/fav.ico" type="image/x-icon" />

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
                        <a href="index.html" class="logo">
                            <img src="{{ asset('admin/assets/img/logo/Logo.png') }}" style="width: 50%;">
                        </a>
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
            <!-- Body -->
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
                                        <h4 class="card-title">SUBDEP</h4>

                                        {{-- @if (in_array($usertype, [User::ADMIN, User::CHECKER])) --}}
                                        <a href="{{ route('subdep.create') }}" class="btn btn-primary btn-round ms-auto">
                                            <i class="fa fa-plus"></i>
                                            tambah
                                        </a>
                                        {{-- @endif --}}
                                    </div>
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table id="add-row" class="display table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Nama</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach ($subdeps as $subdep)
                                                    <tr>
                                                        <td>{{ $subdep->kode }}</td>
                                                        <td>{{ $subdep->name }}</td>
                                                        <td>
                                                            <a href="{{ route('subdep.edit', $subdep) }}" class="btn btn-sm btn-warning">Edit</a>
                                                            <form action="{{ route('subdep.destroy', $subdep) }}" method="POST" class="d-inline"
                                                                onsubmit="return confirm('Yakin ingin hapus?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-sm btn-danger">Hapus</button>
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
            </div>
            <!-- End body -->
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
