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
                        <h3 class="fw-bold mb-3">Form</h3>
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
                        
                        <form action="{{ route('form_inputs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="kategori_id" value="{{ request('kategori_id') }}">
                        
                            <input type="text" name="nama" placeholder="Nama">
                            <input type="text" name="organisasi" placeholder="Organisasi">
                            <input type="text" name="jabatan" placeholder="Jabatan">
                        
                            <select name="jenis_kelamin">
                                <option value="">Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        
                            <select name="pekerjaan">
                                <option value="">Pilih</option>
                                <option value="Profesi">Profesi</option>
                                <option value="Hobi">Hobi</option>
                            </select>
                        
                            <select name="ukuran">
                                <option value="">Pilih</option>
                                @foreach (['S','M','L','XL','XXL','XXXL'] as $ukuran)
                                    <option value="{{ $ukuran }}">{{ $ukuran }}</option>
                                @endforeach
                            </select>
                        
                            <input type="file" name="bukti_tf">
                            <input type="file" name="dokumen_pendukung">
                            <input type="file" name="portofolio">
                        
                            <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
                            <a href="{{ url('/form_inputs') }}" class="btn btn-danger">
                                <span class="btn-label">
                                    <i class="fa fa-backward"></i>
                                </span>
                                Batal
                            </a>
                            <button type="submit">Simpan</button>
                        </form>
                        
                        
                    </div>

                </div>
                @include('admin.js')
            </div>
        </div>
    </div>
</body>

</html>
