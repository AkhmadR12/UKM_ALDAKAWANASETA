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
                        <h3 class="fw-bold mb-3">Detail</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="{{ url('/redirect') }}">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/data-pencarian') }}">Tables</a>
                            </li>

                        </ul>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <h4 class="card-title">Detail</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                         <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p><strong>Status:</strong> {{ $formInput->status }}</p>
                                                        <p><strong>Nama :</strong> {{ $formInput->nama }}</p>
                                                        <p><strong>Organisasi:</strong> {{ $formInput->organisasi }}
                                                        </p>
                                                        <p><strong>Jabatan:</strong> {{ $formInput->jabatan }}</p>
                                                        <p><strong>Jenis Anggota:</strong> {{ $formInput->jenis_anggota }}</p>
                                                        <p><strong>Alamat:</strong> {{ $formInput->nomor_anggota }}</p>
                                                        <p><strong>KOTA:</strong> {{ $formInput->kota }}</p>
                                                        
                                                        <p><strong>Bukti Transfer:</strong>
                                                            <img src="{{ asset( $formInput->bukti_tf) }}"
                                                                alt="" width="90%">
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><strong>Nomor Telp:</strong> {{ $formInput->nomor_telp }}</p>
                                                        <p><strong>Email:</strong> {{ $formInput->email }}</p>
                                                        <p><strong>Usaha:</strong>
                                                            {{ $formInput->usaha }}</p>
                                                        <p><strong>Jenis Kelamin:</strong>
                                                            {{ $formInput->jenis_kelamin }}</p>
                                                        <p><strong>Tempat, Tanggal Lahir:</strong> {{ $formInput->ttl }}</p>
                                                        <p><strong>Pekerjaan:</strong> {{ $formInput->pekerjaan }}</p>
                                                        
                                                    </div>
                                                </div>
                                                @if($formInput->status == 'INPG')
                                                    <div class="row mb-4">
                                                        <!-- Finalisasi -->
                                                        <div class="col-md-6">
                                                            <form action="{{ route('form-input.update-status', $formInput->id) }}" method="POST" class="border p-3 rounded shadow-sm">
                                                                @csrf
                                                                <div class="form-check mb-2">
                                                                    <input type="checkbox" class="form-check-input" id="finalApproveCheck" name="final_approve" required>
                                                                    <label class="form-check-label" for="finalApproveCheck">&nbsp;&nbsp;&nbsp; Final Approval</label>
                                                                </div>
                                                                <button type="submit" class="btn btn-success w-100">
                                                                    <i class="fas fa-check-circle"></i> Finalisasi (CLSD)
                                                                </button>
                                                            </form>
                                                        </div>

                                                        <!-- Tolak -->
                                                        <div class="col-md-6">
                                                            <form action="{{ route('form-input.update-status', $formInput->id) }}" method="POST" class="border p-3 rounded shadow-sm">
                                                                @csrf
                                                                <input type="hidden" name="reject" value="1">
                                                                <p>Jika ingin menolak permintaan ini, klik tombol di bawah.</p>
                                                                <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Yakin ingin menolak permintaan ini?')">
                                                                    <i class="fas fa-times-circle"></i> Tolak (BATAL)
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif                                                           
                                            </div>
                                        </div>
                                        <a href="{{ url('/form_inputs') }}" class="btn btn-danger">
                                            <span class="btn-label">
                                                <i class="fa fa-backward"></i>
                                            </span>
                                            Kembali
                                        </a>
                                    </div>
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

</body>

</html>