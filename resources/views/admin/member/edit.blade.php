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
                        <h3 class="fw-bold mb-3">Member</h3>
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
                        
                        <form action="{{ route('members.update', $member->id_member) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                        
                            <input type="hidden" name="id_member" value="{{ $member->id_member }}">
                        
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $member->name) }}" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $member->phone) }}" required>
                            </div>
                        
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $member->email) }}">
                            </div>
                        
                            <div class="form-group">
                                <label for="kota_id">Kota</label>
                                <select class="form-control" id="kota_id" name="kota_id" required>
                                    @foreach($kabupatenKotas as $kota)
                                        <option value="{{ $kota->id }}" {{ $member->kota_id == $kota->id ? 'selected' : '' }}>
                                            {{ $kota->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                @if($member->photo)
                                    <div class="mb-2" id="current-photo">
                                        <img src="{{ asset($member->photo) }}" alt="Current Photo" width="100"><br>
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('remove-photo').value = '1'; document.getElementById('current-photo').style.display = 'none';">
                                            Remove Photo
                                        </a>
                                    </div>
                                    <input type="hidden" name="remove_photo" id="remove-photo" value="0">
                                @endif
                                <input type="file" class="form-control-file" id="photo" name="photo">
                                <small class="form-text text-muted">
                                    Upload foto baru (max 2MB, format: jpeg,png,jpg,gif)
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="barcode_path">Upload Barcode (PNG/JPG)</label>
                                <input type="file" name="barcode_path" class="form-control-file" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="tanggal_bergabung">Tanggal Bergabung</label>
                                <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung"
                                       value="{{ old('tanggal_bergabung', $member->tanggal_bergabung->format('Y-m-d')) }}" required>
                            </div>
                            <a href="{{ url('/members') }}" class="btn btn-danger">
                                <span class="btn-label">
                                    <i class="fa fa-backward"></i>
                                </span>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                        
                    </div>

                </div>
                @include('admin.js')
            </div>
        </div>
    </div>
</body>

</html>
