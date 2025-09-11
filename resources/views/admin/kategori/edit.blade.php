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
    <style>
        /* Tambahkan di bagian head atau file CSS terpisah */
        .custom-checkbox .custom-control-label::before {
        border-radius: .25rem;
        }
        .custom-control-label {
            cursor: pointer;
        }
        .form-check {
            margin-bottom: 10px;
        }

        .form-check-label {
            margin-left: 5px;
            cursor: pointer;
        }

        /* Responsive grid */
        @media (max-width: 768px) {
            .col-md-4 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }

        @media (max-width: 576px) {
            .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
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
                        <h3 class="fw-bold mb-3">Kategori</h3>
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
                                    <form action="{{ route('kategoris.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="nama_kategori">Nama Kategori*</label>
                                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" 
                                                value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="status">Status*</label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="aktif" {{ $kategori->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="nonaktif" {{ $kategori->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="gambar">Gambar (Opsional)</label>
                                            <input type="file" class="form-control-file" id="gambar" name="gambar">
                                            @if($kategori->gambar)
                                                <div class="mt-2">
                                                    <img src="{{ asset($kategori->gambar) }}" alt="Gambar Kategori" style="max-width: 200px;">
                                                    <div class="form-check mt-2">
                                                        <input class="form-check-input" type="checkbox" id="hapus_gambar" name="hapus_gambar">
                                                        <label class="form-check-label" for="hapus_gambar">
                                                            Hapus gambar saat disimpan
                                                        </label>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" 
                                                value="{{ old('tanggal', $kategori->tanggal) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="lokasi">Lokasi</label>
                                            <input type="text" class="form-control" id="lokasi" name="lokasi" 
                                                value="{{ old('lokasi', $kategori->lokasi) }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="jam">Jam</label>
                                            <input type="text" class="form-control" id="jam" name="jam" 
                                                value="{{ old('jam', $kategori->jam) }}" placeholder="Misal: 08:00 - 10:00">
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Deskripsi</label>
                                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $kategori->description) }}</textarea>
                                        </div>

                                        <!-- Field untuk memilih active fields -->
                                        <div class="form-group">
                                            <label class="font-weight-bold">Pilih Field yang Aktif untuk Form Ini:</label>
                                            <div class="row">
                                                @foreach([
                                                    'nama', 'organisasi', 'jabatan', 'jenis_anggota', 'nomor_anggota',
                                                    'alamat', 'kota', 'provinsi', 'nomor_telp', 'email', 'usaha',
                                                    'bukti_tf', 'dokumen_pendukung', 'info', 'jenis_kelamin', 'ttl',
                                                    'pekerjaan', 'jenis_foto', 'deskripsi', 'ukuran', 'portofolio'
                                                ] as $field)
                                                    <div class="col-md-4 mb-2">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" 
                                                                name="active_fields[]" 
                                                                value="{{ $field }}" 
                                                                id="field_{{ $field }}"
                                                                {{ in_array($field, old('active_fields', $kategori->active_fields ?? [])) ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="field_{{ $field }}">
                                                                {{ ucwords(str_replace('_', ' ', $field)) }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-arrow-left"></i> Kembali
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Update
                                            </button>
                                        </div>
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