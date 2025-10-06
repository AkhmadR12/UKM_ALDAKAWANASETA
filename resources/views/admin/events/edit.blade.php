<html>

<head>
    <title>ASOSIASI FOTOGRAFI INDONESIA</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
    <link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">
    @include('admin.css')
    <link href="{{ asset('home/assets/img/favicon.png') }}" rel="icon">

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
                        <img src="{{ asset('storage/logo/Logo.png') }}" style="width: 100%;">
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
                        <h3 class="fw-bold mb-3">Event</h3>
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
                                <a href="#">Edit</a>
                            </li>

                        </ul>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Edit Event</h5>
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
                                    {{-- body form --}}
                                    <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label>Judul Event</label>
                                            <input type="text" name="judul" class="form-control" value="{{ old('judul', $event->judul) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label>Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control">{{ old('deskripsi', $event->deskripsi) }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Kategori</label>
                                            <select name="kategori_id" class="form-control" required>
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}" {{ $event->kategori_id == $kategori->id ? 'selected' : '' }}>
                                                        {{ $kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Tampilkan gambar yang sudah ada --}}
                                        {{-- <div class="mb-3">
                                            <label>Gambar Saat Ini</label>
                                            <div class="row">
                                                @foreach($event->images as $image)
                                                    <div class="col-md-3 mb-3 image-item">
                                                        <img src="{{ asset($image->image) }}" class="img-thumbnail" style="height: 150px; object-fit: cover;">
                                                        <div class="mt-2">
                                                            <input type="text" name="existing_captions[{{ $image->id }}]" 
                                                                   value="{{ $image->caption }}" 
                                                                   placeholder="Caption gambar" 
                                                                   class="form-control form-control-sm">
                                                        </div>
                                                        <div class="form-check mt-2">
                                                            <input class="form-check-input" type="checkbox" 
                                                                   name="delete_images[]" 
                                                                   value="{{ $image->id }}" 
                                                                   id="delete_image_{{ $image->id }}">
                                                            <label class="form-check-label text-danger" for="delete_image_{{ $image->id }}">
                                                                Hapus gambar
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label>Tambah Gambar Baru (maks. 20)</label>
                                            <div id="image-container">
                                                <div class="mb-2">
                                                    <input type="file" name="images[]" class="form-control">
                                                    <input type="text" name="captions[]" placeholder="Caption gambar" class="form-control mt-1">
                                                </div>
                                            </div>
                                            <button type="button" onclick="addImageInput()" class="btn btn-sm btn-secondary mt-2">Tambah Gambar</button>
                                        </div> --}}
                                        <div class="action-buttons">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ url('/event') }}" class="btn btn-danger">
                                            <i class="fas fa-times me-2"></i>
                                            Batal
                                        </a>
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
    <script>
        function addImageInput() {
            const container = document.getElementById('image-container');
            // Hitung gambar baru yang akan ditambah + gambar yang sudah ada
            const existingImages = {{ $event->images->count() }};
            if (container.children.length + existingImages >= 20) return alert("Maksimal 20 gambar");

            const div = document.createElement('div');
            div.classList.add('mb-2');
            div.innerHTML = `
                <input type="file" name="images[]" class="form-control">
                <input type="text" name="captions[]" placeholder="Caption gambar" class="form-control mt-1">
            `;
            container.appendChild(div);
        }
    </script>
</body>

</html>