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
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="card-title">{{ $user->role === 'admin' ? 'Daftar Absensi' : 'Riwayat Absensi Saya' }}</h4>
                                        @if(!$todayAttendance)
                                            <a href="{{ route('absens.create') }}" class="btn btn-primary">Absen Hari Ini</a>
                                        @else
                                            <div class="alert alert-info mb-0">
                                                Anda sudah absen hari ini pada pukul {{ $todayAttendance->jam }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                @if(session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <!-- Form Filter Tanggal -->
                                <div class="card-body border-bottom">
                                    <form method="GET" action="{{ route('absens.index') }}" class="row g-3">
                                        <div class="col-md-3">
                                            <label for="start_date" class="form-label">Dari Tanggal</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" 
                                                value="{{ request('start_date', $defaultStartDate ?? '') }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="end_date" class="form-label">Sampai Tanggal</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" 
                                                value="{{ request('end_date', $defaultEndDate ?? '') }}">
                                        </div>
                                        <div class="col-md-3 d-flex align-items-end">
                                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                                            <a href="{{ route('absens.index') }}" class="btn btn-secondary">Reset</a>
                                        </div>
                                    </form>

                                    <!-- Tombol Admin Only -->
                                    @if($user->role === 'admin')
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <div class="d-flex gap-2">
                                                <!-- Form Export -->
                                                <form method="POST" action="{{ route('absens.export') }}" class="d-flex gap-2">
                                                    @csrf
                                                    <input type="date" class="form-control" style="width: 150px;" 
                                                        name="export_start_date" required 
                                                        value="{{ request('start_date', $defaultStartDate ?? '') }}">
                                                    <input type="date" class="form-control" style="width: 150px;" 
                                                        name="export_end_date" required 
                                                        value="{{ request('end_date', $defaultEndDate ?? '') }}">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fas fa-file-excel"></i> Export Excel
                                                    </button>
                                                </form>

                                                <!-- Form Hapus -->
                                                <form method="POST" action="{{ route('absens.destroyByDate') }}" 
                                                    class="d-flex gap-2" 
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data dalam rentang tanggal ini? Tindakan ini tidak dapat dibatalkan.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="date" class="form-control" style="width: 150px;" 
                                                        name="delete_start_date" required 
                                                        value="{{ request('start_date', $defaultStartDate ?? '') }}">
                                                    <input type="date" class="form-control" style="width: 150px;" 
                                                        name="delete_end_date" required 
                                                        value="{{ request('end_date', $defaultEndDate ?? '') }}">
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i> Hapus Data
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    @if($user->role === 'admin')
                                                    <th>Nama</th>
                                                    @endif
                                                    <th>Tanggal</th>
                                                    <th>Jam</th>
                                                    <th>Status</th>
                                                     
                                                    @if($user->role === 'admin')
                                                    <th>Aksi</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($attendances as $index => $attendance)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    @if($user->role === 'admin')
                                                    <td>{{ $attendance->user->name }}</td>
                                                    @endif
                                                    <td>{{ $attendance->tanggal }}</td>
                                                    <td>{{ $attendance->jam }}</td>
                                                    <td>{{ $attendance->status }}</td>
                                                    
                                                    @if($user->role === 'admin')
                                                    <td>
                                                        <form action="{{ route('absens.destroy', $attendance->id) }}" method="POST" 
                                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                        <!-- Pagination -->
                                        <div class="d-flex justify-content-center mt-3">
                                            {{ $attendances->links() }}
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