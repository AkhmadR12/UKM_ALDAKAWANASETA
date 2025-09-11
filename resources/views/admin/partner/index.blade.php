<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
 </head>

<body>
    <div class="wrapper">
         @include('admin.sidebar')
 
        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
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
                 </div>
                 <x-app-layout>
                </x-app-layout>
                 
            </div>
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
                                        <h4 class="card-title">Partner</h4>
                                        <a href="{{ route('partner.create') }}" class="btn btn-primary btn-round ms-auto">
                                            <i class="fa fa-plus"></i>
                                            tambah
                                        </a>
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
                                                    <th>Foto</th>
                                                    <th>Nama</th>
                                                    <th>Instagram</th>
                                                    <th>Facebook</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($partners as $key => $partner)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>
                                                            <img src="{{ asset($partner->image) }}" alt="file_path" width="100">
                                                        </td> 
                                                        <td>{{ $partner->name }}</td>
                                                        <td>
                                                            @if($partner->instagram)
                                                                <a href="{{ $partner->instagram }}" target="_blank">Instagram</a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($partner->facebook)
                                                                <a href="{{ $partner->facebook }}" target="_blank">Facebook</a>
                                                            @endif
                                                        </td>
                                                        <td>
                                                             <a href="{{ route('partner.edit', $partner->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                            <form action="{{ route('partner.destroy', $partner->id) }}" method="POST" class="d-inline">
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