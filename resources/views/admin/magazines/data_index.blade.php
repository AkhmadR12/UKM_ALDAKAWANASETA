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
                                        <h4 class="card-title">Produk</h4>
                                        <a href="{{ route('magazine.create') }}" class="btn btn-primary btn-round ms-auto">
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
                                                    <th>Nomor</th>
                                                    <th>Nama </th>
                                                    <th>Gambar</th>
                                                    <th>Aktif</th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($magazines as $index => $magazine)
                                                     
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $magazine->title }}</td>
                                                        <td>
                                                        <img src="{{ asset($magazine->cover_image) }}" alt="magazine Image" width="100">
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-sm toggle-status-btn {{ $magazine->status === 'aktif' ? 'btn-success' : 'btn-danger' }}" 
                                                                data-id="{{ $magazine->id }}" 
                                                                data-status="{{ $magazine->status }}">
                                                                {{ ucfirst($magazine->status) }}
                                                            </button>
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
        <!-- End Custom template -->
        {{-- @include('admin.custume') --}}
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    @include('admin.js')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.toggle-status-btn').on('click', function() {
                let button = $(this);
                let id = button.data('id');

                $.ajax({
                    url: '/data_majalah/toggle-status/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update status di button
                            button.text(response.status.charAt(0).toUpperCase() + response.status.slice(1));
                            button.data('status', response.status);

                            // Opsional: beri warna berbeda
                            if(response.status === 'aktif') {
                                button.removeClass('btn-danger').addClass('btn-success');
                            } else {
                                button.removeClass('btn-success').addClass('btn-danger');
                            }
                        }
                    }
                });
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('.toggle-status-btn').on('click', function() {
                let button = $(this);
                let id = button.data('id');

                $.ajax({
                    url: '/data_majalah/toggle-status/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update status di button
                            button.text(response.aktif.charAt(0).toUpperCase() + response.aktif.slice(1));
                            button.data('aktif', response.aktif);

                            // Opsional: beri warna berbeda
                            if(response.aktif === 1) {
                                button.removeClass('btn-danger').addClass('btn-success');
                            } else {
                                button.removeClass('btn-success').addClass('btn-danger');
                            }
                        }
                    }
                });
            });
        });
    </script> --}}

</body>

</html>