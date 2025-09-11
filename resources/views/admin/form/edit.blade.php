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
                        <a href="{{ url('/redirect') }}" class="logo">
                            <img src="{{ asset('storage/logo/Logo.png') }}" style="width: 100%;">
                        </a>
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
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Tambah FAQ</h5>
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
                                    <form action="{{ route('form_inputs.update', $formInput->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label>Nama</label>
                                            <input type="text" name="nama" value="{{ $formInput->nama }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>Organisasi</label>
                                            <input type="text" name="organisasi" value="{{ $formInput->organisasi }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>Jabatan</label>
                                            <input type="text" name="jambatan" value="{{ $formInput->jambatan }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>Jenis Organisasi</label>
                                            <input type="text" name="jenis_organisasi" value="{{ $formInput->jenis_organisasi }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>Nomor Anggota</label>
                                            <input type="text" name="nomor_anggota" value="{{ $formInput->nomor_anggota }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>Alamat</label>
                                            <input type="text" name="alamat" value="{{ $formInput->alamat }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>Kota</label>
                                            <input type="text" name="kota" value="{{ $formInput->kota }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>Nomor Telp</label>
                                            <input type="text" name="nomor_telp" value="{{ $formInput->nomor_telp }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="text" name="email" value="{{ $formInput->email }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>Usaha</label>
                                            <input type="text" name="usaha" value="{{ $formInput->usaha }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>Jenis Kelamin</label>
                                            <input type="text" name="jenis_kelamin" value="{{ $formInput->jenis_kelamin }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>Tempat, Tanggal Lahir</label>
                                            <input type="text" name="ttl" value="{{ $formInput->ttl }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>pekerjaan</label>
                                            <input type="text" name="pekerjaan" value="{{ $formInput->pekerjaan }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>Jenis Fotografer</label>
                                            <input type="text" name="jenis_foto" value="{{ $formInput->jenis_foto }}"
                                                class="form-control" >
                                        </div>
                                        <div class="mb-3">
                                            <label>Ukuran Baju</label>
                                            <input type="text" name="ukuran" value="{{ $formInput->ukuran }}"
                                                class="form-control" >
                                        </div>
                                          <!-- File uploads -->
                                        <div class="form-group">
                                            <label for="bukti_tf">Bukti Transfer</label>
                                            <input type="file" class="form-control" id="bukti_tf" name="bukti_tf">
                                            @if($formInput->bukti_tf)
                                                <a href="{{ asset('storage/'.$formInput->bukti_tf) }}" target="_blank">Lihat file saat ini</a>
                                            @endif
                                        </div>
                                        
                                        <!-- Repeat for other file fields -->
                                        
                                        <!-- Approval checkbox -->
                                        {{-- @if($formInput->status === 'OPEN' || $formInput->status === 'INPG')
                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" id="approve" name="approve" value="1">
                                                <label class="form-check-label" for="approve">
                                                    @if($formInput->status === 'OPEN')
                                                        Setujui dan lanjutkan ke tahap INPG
                                                    @elseif($formInput->status === 'INPG')
                                                        Finalisasi dan ubah status ke CLSD
                                                    @endif
                                                </label>
                                            </div>
                                        @endif --}}
                                        @if($formInput->status === 'OPEN' || $formInput->status === 'INPG')
                                            <div class="form-check mb-3">
                                                <input type="checkbox" class="form-check-input" id="approve" name="approve" value="1">
                                                <label class="form-check-label" for="approve">
                                                    @if($formInput->status === 'OPEN')
                                                        Setujui dan lanjutkan ke tahap INPG
                                                    @endif
                                                </label>
                                            </div>
                                            
                                            @if($formInput->status === 'OPEN')
                                                <div class="form-check mb-3">
                                                    <input type="checkbox" class="form-check-input" id="reject" name="reject" value="1">
                                                    <label class="form-check-label" for="reject">
                                                        Tolak permintaan (BATAL)
                                                    </label>
                                                </div>
                                            @endif
                                        @endif
                                        {{-- <div class="mb-3">
                                            <label>Organisasi</label>
                                            <textarea name="answer" class="form-control" rows="4" required>{{ $form->answer }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="1" {{ $form->status ? 'selected' : '' }}>Aktif
                                                </option>
                                                <option value="0" {{ !$form->status ? 'selected' : '' }}>Nonaktif
                                                </option>
                                            </select>
                                        </div> --}}
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            {{-- <a href="{{ route('admin.form.index') }}" class="btn btn-secondary">Kembali</a> --}}
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
