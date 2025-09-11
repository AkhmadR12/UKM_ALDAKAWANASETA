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
                        <h3 class="fw-bold mb-3">Berita</h3>
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
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Edit Berita</h5>
                                </div>
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            <span>{{ session('success') }}</span>
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label for="judul" class="form-label">Judul Berita</label>
                                                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $berita->judul }}" required>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="deskripsi" class="form-label">Deskripsi Utama</label>
                                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ $berita->deskripsi }}</textarea>
                                                </div>
                                                
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="tanggal" class="form-label">Tanggal</label>
                                                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $berita->tanggal->format('Y-m-d') }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="jam" class="form-label">Jam</label>
                                                        <input type="time" class="form-control" id="jam" name="jam" value="{{ $berita->jam }}" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_terkini" name="is_terkini" value="1" {{ $berita->is_terkini ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_terkini">Berita Terkini</label>
                                                </div>
                                                
                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_update" name="is_update" value="1" {{ $berita->is_update ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="is_update">Berita Update</label>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="dokumentasi_link" class="form-label">Link Dokumentasi Instagram</label>
                                                    <input type="url" class="form-control" id="dokumentasi_link" name="dokumentasi_link" value="{{ $berita->dokumentasi_link }}">
                                                    <small class="text-muted">Contoh: https://www.instagram.com/username/</small>
                                                    @if($berita->dokumentasi_nama)
                                                        <div class="mt-1">Nama: {{ $berita->dokumentasi_nama }}</div>
                                                    @endif
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label for="editor_link" class="form-label">Link Editor Instagram</label>
                                                    <input type="url" class="form-control" id="editor_link" name="editor_link" value="{{ $berita->editor_link }}">
                                                    <small class="text-muted">Contoh: https://www.instagram.com/username/</small>
                                                    @if($berita->editor_nama)
                                                        <div class="mt-1">Nama: {{ $berita->editor_nama }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        
                                        <h4>Konten Tambahan</h4>
                                        
                                        @for($i = 1; $i <= 5; $i++)
                                        <div class="mb-4 p-3 border rounded">
                                            <h5>Bagian {{ $i }}</h5>
                                            
                                            @if($berita->{'gambar'.$i})
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $berita->{'gambar'.$i}) }}" alt="Gambar {{$i}}" class="img-thumbnail" style="max-height: 200px;">
                                                <div class="form-check mt-2">
                                                    <input class="form-check-input" type="checkbox" id="hapus_gambar{{$i}}" name="hapus_gambar{{$i}}" value="1">
                                                    <label class="form-check-label" for="hapus_gambar{{$i}}">Hapus gambar ini</label>
                                                </div>
                                            </div>
                                            @endif
                                            
                                            <div class="mb-3">
                                                <label for="gambar{{$i}}" class="form-label">Gambar {{$i}}</label>
                                                <input type="file" class="form-control" id="gambar{{$i}}" name="gambar{{$i}}">
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label for="deskripsi{{$i}}" class="form-label">Deskripsi {{$i}}</label>
                                                <textarea class="form-control" id="deskripsi{{$i}}" name="deskripsi{{$i}}" rows="3">{{ $berita->{'deskripsi'.$i} }}</textarea>
                                            </div>
                                        </div>
                                        @endfor
                                        
                                        <button type="submit" class="btn btn-primary">Update Berita</button>
                                        <a href="{{ route('berita.index') }}" class="btn btn-secondary">Batal</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin.js')
            </div>
        </div>
    </div>
</body>

</html>
