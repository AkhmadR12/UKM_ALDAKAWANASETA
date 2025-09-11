<html>

<head>
    <title>POTó</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
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
                        {{-- <a href="{{ url('/redirect') }}" class="logo"> --}}
                        <img src="{{ asset('storage/logo/Logo.png') }}" style="width: 100%;">
                        {{-- </a> --}}
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
                </x-app-layout> <!-- End Navbar -->
            </div>
            <!-- body -->
            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Portofolio</h3>
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
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Tambah</a>
                            </li>

                        </ul>
                    </div>
                    <div class="container">
                        <h1>Create New Member</h1>
                        
                       <form action="{{ route('portofolio.update', $portofolio->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama', $portofolio->nama ?? '') }}">
                            </div>

                            <div class="mb-3">
                                <label for="tipe_id">Tipe</label>
                                <select name="tipe_id" class="form-control">
                                    <option value="">-- Pilih Tipe --</option>
                                    @foreach($tipes as $tipe)
                                        <option value="{{ $tipe->id }}" {{ old('tipe_id', $portofolio->tipe_id ?? '') == $tipe->id ? 'selected' : '' }}>
                                            {{ $tipe->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                             @foreach (range(1, 4) as $i)
                                @php
                                    $descKey = $i == 1 ? 'deskripsi' : 'deskripsi' . $i;
                                    $imgKey = $i == 1 ? 'gambar' : 'gambar' . $i;
                                @endphp
                                <div class="mb-3">
                                    <label for="{{ $descKey }}">Deskripsi {{ $i }}</label>
                                    <textarea name="{{ $descKey }}" class="form-control">{{ old($descKey, $portofolio->$descKey) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="{{ $imgKey }}">Gambar {{ $i }}</label>
                                    <input type="file" name="{{ $imgKey }}" class="form-control">
                                    @if($portofolio->$imgKey)
                                        <img src="{{ asset('storage/' . $portofolio->$imgKey) }}" width="100" class="mt-2">
                                    @endif
                                </div>
                            @endforeach

                            <div class="mb-3">
                                <label for="status">Status</label>
                                <select name="status" class="form-control">
                                    <option value="aktif" {{ old('status', $portofolio->status ?? 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status', $portofolio->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Simpan</button>
                        </form>
                    </div>

                </div>
                @include('admin.js')
            </div>
        </div>
    </div>
</body>

</html>
