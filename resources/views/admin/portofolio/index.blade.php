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
                                        <h4 class="card-title">FAQ</h4>
                                        <a href="{{ route('porto.create') }}" class="btn btn-primary btn-round ms-auto">
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
                                                    <th>Nama Kategori</th>
                                                    <th>Status</th>
                                                    <th>Gambar</th>
                                                    <th>tanggal</th>
                                                    {{-- <th>lokasi</th> --}}
                                                    {{-- <th>Phone</th> --}}
                                                    <th style="min-width: 220px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 @foreach($portofolios as $p)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $p->tipe->nama ?? '-' }}</td>

                                                        {{-- Tombol toggle status --}}
                                                        <td>
                                                            <button
                                                                class="btn btn-sm toggle-status-btn {{ $p->status === 'aktif' ? 'btn-success' : 'btn-danger' }}"
                                                                data-id="{{ $p->id }}"
                                                                data-status="{{ $p->status }}">
                                                                {{ ucfirst($p->status) }}
                                                            </button>
                                                        </td>

                                                        {{-- Gambar utama --}}
                                                        {{-- <td>
                                                            @if($p->gambar)
                                                                <img src="{{ asset($p->gambar) }}" width="100" alt="gambar">
                                                            @else
                                                                <span class="text-muted">-</span>
                                                            @endif
                                                        </td> --}}
                                                    <td>
                                                        <img src="{{ asset($p->gambar) }}" alt="Member Image" width="100">
                                                    </td> 
                                                        {{-- Placeholder untuk tanggal dan lokasi --}}
                                                        <td>{{ $p->created_at->format('d M Y') }}</td>
                                                        {{-- <td class="text-muted">-</td> --}}

                                                        <td>
                                                            <a href="{{ route('porto.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                                            <form action="{{ route('porto.destroy', $p->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button onclick="return confirm('Yakin ingin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
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
        <!-- End Custom template -->
        {{-- @include('admin.custume') --}}
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    @include('admin.js')
    <script>
        $(document).ready(function() {
            $('.toggle-status-btn').on('click', function() {
                let button = $(this);
                let id = button.data('id');

                $.ajax({
                    url: '/portofolio/toggle-status/' + id,
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

</body>

</html>