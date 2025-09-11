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
                        <h3 class="fw-bold mb-3">Pop UP</h3>
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
                                    <h5>Tambah Berita</h5>
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
                                    <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        {{-- <div class="mb-3">
                                            <label for="name" class="form-label">Nama</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div> --}}

                                        <div class="mb-3">
                                            <label for="title" class="form-label">Judul</label>
                                            <input type="text" name="title" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="cover" class="form-label">Cover (dengan watermark)</label>
                                            <input type="file" name="cover" class="form-control" accept="image/*" required>
                                        </div>

                                        <hr>

                                        <h5>Gambar High Resolution</h5>
                                        <div class="mb-3">
                                            <label for="image_highres" class="form-label">File Gambar Highres</label>
                                            <input type="file" name="image_highres" class="form-control" accept="image/*" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga_image_highres" class="form-label">Harga Highres</label>
                                            <input type="number" name="harga_image_highres" class="form-control" required>
                                        </div>

                                        <hr>

                                        <h5>Gambar Low Resolution</h5>
                                        <div class="mb-3">
                                            <label for="image_lowres" class="form-label">File Gambar Lowres</label>
                                            <input type="file" name="image_lowres" class="form-control" accept="image/*" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga_image_lowres" class="form-label">Harga Lowres</label>
                                            <input type="number" name="harga_image_lowres" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Simpan Foto</button>
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