<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <link rel="icon" href="../assets/img/logo/fav.ico" type="image/x-icon" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/1.0.5/turn.min.js"></script>
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #4a76a8;
        color: white;
        font-weight: bold;
        border-radius: 10px 10px 0 0 !important;
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
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Edit Majalah: {{ $magazine->title }}</div>
                
                                <div class="card-body">
                                    <form action="{{ route('magazines.update', $magazine->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                
                                        <div class="form-group mb-3">
                                            <label for="title" class="form-label">Judul Majalah</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                                   id="title" name="title" value="{{ old('title', $magazine->title) }}" required>
                                            @error('title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="form-group mb-3">
                                            <label for="description" class="form-label">Deskripsi</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                                      id="description" name="description" rows="3">{{ old('description', $magazine->description) }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="form-group mb-3">
                                            <label for="pdf_file" class="form-label">File PDF Majalah (Biarkan kosong jika tidak ingin mengubah)</label>
                                            <input type="file" class="form-control @error('pdf_file') is-invalid @enderror" 
                                                   id="pdf_file" name="pdf_file" accept=".pdf">
                                            @error('pdf_file')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="text-muted">
                                                File saat ini: <a href="{{ asset('storage/'.$magazine->pdf_path) }}" target="_blank">{{ basename($magazine->pdf_path) }}</a>
                                            </small>
                                        </div>
                
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Cover Saat Ini</label>
                                                <div>
                                                    <img src="{{ asset('storage/'.$magazine->cover_image) }}" 
                                                         alt="Cover {{ $magazine->title }}" 
                                                         class="img-thumbnail" style="max-height: 200px;">
                                                </div>
                                            </div>
                                        </div>
                
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <a href="{{ route('magazines.index') }}" class="btn btn-secondary me-md-2">Kembali</a>
                                            <button type="submit" class="btn btn-primary">Update Majalah</button>
                                        </div>
                                    </form>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Validasi ukuran file sebelum upload
            document.getElementById('pdf_file').addEventListener('change', function(e) {
                if (this.files[0].size > 50 * 1024 * 1024) { // 50MB
                    alert('Ukuran file terlalu besar. Maksimal 50MB');
                    this.value = '';
                }
            });
        });
        </script>
</body>

</html>
                