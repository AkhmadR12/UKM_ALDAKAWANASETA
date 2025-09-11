{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     @include('frontend.layout.css')

    <style>
        main{
            margin-top: 60px;
            margin-bottom: 20px;
        }
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background-color: rgb(180, 177, 177);
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 30px;
        }
        .form-title {
            color: #000000;
            margin-bottom: 30px;
            text-align: center;
        }
        .required-field::after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body>
    @include('frontend.layout.header')
    <!-- Modal Search End -->
    <main class="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-container">
                        <h2 class="form-title">FORM BUKU TAMU</h2>
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('bukutamu.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="email" class="form-label required-field">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="nama" class="form-label required-field">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                    id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="nama_rimba" class="form-label">Nama Rimba</label>
                                <input type="text" class="form-control @error('nama_rimba') is-invalid @enderror" 
                                    id="nama_rimba" name="nama_rimba" value="{{ old('nama_rimba') }}">
                                @error('nama_rimba')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="organisasi" class="form-label required-field">Organisasi</label>
                                <input type="text" class="form-control @error('organisasi') is-invalid @enderror" 
                                    id="organisasi" name="organisasi" value="{{ old('organisasi') }}" required>
                                @error('organisasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="angkatan" class="form-label required-field">Angkatan</label>
                                <input type="number" class="form-control @error('angkatan') is-invalid @enderror" 
                                    id="angkatan" name="angkatan" min="1900" max="{{ date('Y') }}" 
                                    value="{{ old('angkatan') }}" required>
                                @error('angkatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="keperluan" class="form-label required-field">Keperluan</label>
                                <select class="form-select @error('keperluan') is-invalid @enderror" 
                                        id="keperluan" name="keperluan" required>
                                    <option value="">-- Pilih Keperluan --</option>
                                    <option value="bertamu" {{ old('keperluan') == 'bertamu' ? 'selected' : '' }}>Bertamu</option>
                                    <option value="mengirim_surat_milad" {{ old('keperluan') == 'mengirim_surat_milad' ? 'selected' : '' }}>Mengirim Surat Milad</option>
                                    <option value="mengirim_surat_peminjaman" {{ old('keperluan') == 'mengirim_surat_peminjaman' ? 'selected' : '' }}>Mengirim Surat Peminjaman</option>
                                    <option value="mengambil_alat" {{ old('keperluan') == 'mengambil_alat' ? 'selected' : '' }}>Mengambil Alat</option>
                                    <option value="mengembalikan_alat" {{ old('keperluan') == 'mengembalikan_alat' ? 'selected' : '' }}>Mengembalikan Alat</option>
                                    <option value="belajar" {{ old('keperluan') == 'belajar' ? 'selected' : '' }}>Belajar</option>
                                    <option value="lainnya" {{ old('keperluan') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('keperluan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3" id="keperluan_lainnya_container" style="display: none;">
                                <label for="keperluan_lainnya" class="form-label">Keterangan Keperluan Lainnya</label>
                                <input type="text" class="form-control @error('keperluan_lainnya') is-invalid @enderror" 
                                    id="keperluan_lainnya" name="keperluan_lainnya" value="{{ old('keperluan_lainnya') }}">
                                @error('keperluan_lainnya')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                             </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const keperluanSelect = document.getElementById('keperluan');
            const lainnyaContainer = document.getElementById('keperluan_lainnya_container');
            
            function toggleLainnyaField() {
                if (keperluanSelect.value === 'lainnya') {
                    lainnyaContainer.style.display = 'block';
                } else {
                    lainnyaContainer.style.display = 'none';
                }
            }
            
            // Initial check
            toggleLainnyaField();
            
            // Add event listener
            keperluanSelect.addEventListener('change', toggleLainnyaField);
        });
    </script>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Buku Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     @include('frontend.layout.css')

    <style>
        main{
            margin-top: 60px;
            margin-bottom: 20px;
        }
        body {
            background-color: #f8f9fa;
        }
        .form-container {
            background-color: rgba(51, 51, 51, 0.205);
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 30px;
        }
        .form-title {
            color: #000000;
            margin-bottom: 30px;
            text-align: center;
        }
        .required-field::after {
            content: " *";
            color: red;
        }
    </style>
</head>
<body>
    @include('frontend.layout.header')
    <!-- Modal Search End -->
    <main class="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="form-container">
                        <h2 class="form-title">FORM BUKU TAMU</h2>
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('bukutamu.store') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="email" class="form-label required-field">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="nama" class="form-label required-field">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                                    id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="nama_rimba" class="form-label">Nama Rimba</label>
                                <input type="text" class="form-control @error('nama_rimba') is-invalid @enderror" 
                                    id="nama_rimba" name="nama_rimba" value="{{ old('nama_rimba') }}">
                                @error('nama_rimba')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="organisasi" class="form-label required-field">Organisasi</label>
                                <input type="text" class="form-control @error('organisasi') is-invalid @enderror" 
                                    id="organisasi" name="organisasi" value="{{ old('organisasi') }}" required>
                                @error('organisasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="angkatan" class="form-label required-field">Angkatan</label>
                                <input type="number" class="form-control @error('angkatan') is-invalid @enderror" 
                                    id="angkatan" name="angkatan" min="1900" max="{{ date('Y') }}" 
                                    value="{{ old('angkatan') }}" required>
                                @error('angkatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="keperluan" class="form-label required-field">Keperluan</label>
                                <select class="form-select @error('keperluan') is-invalid @enderror" 
                                        id="keperluan" name="keperluan" required>
                                    <option value="">-- Pilih Keperluan --</option>
                                    <option value="bertamu" {{ old('keperluan') == 'bertamu' ? 'selected' : '' }}>Bertamu</option>
                                    <option value="mengirim_surat_milad" {{ old('keperluan') == 'mengirim_surat_milad' ? 'selected' : '' }}>Mengirim Surat Milad</option>
                                    <option value="mengirim_surat_peminjaman" {{ old('keperluan') == 'mengirim_surat_peminjaman' ? 'selected' : '' }}>Mengirim Surat Peminjaman</option>
                                    <option value="mengambil_alat" {{ old('keperluan') == 'mengambil_alat' ? 'selected' : '' }}>Mengambil Alat</option>
                                    <option value="mengembalikan_alat" {{ old('keperluan') == 'mengembalikan_alat' ? 'selected' : '' }}>Mengembalikan Alat</option>
                                    <option value="belajar" {{ old('keperluan') == 'belajar' ? 'selected' : '' }}>Belajar</option>
                                    <option value="lainnya" {{ old('keperluan') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                                @error('keperluan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3" id="keperluan_lainnya_container" style="display: none;">
                                <label for="keperluan_lainnya" class="form-label required-field">Keterangan Keperluan Lainnya</label>
                                <input type="text" class="form-control @error('keperluan_lainnya') is-invalid @enderror" 
                                    id="keperluan_lainnya" name="keperluan_lainnya" value="{{ old('keperluan_lainnya') }}">
                                @error('keperluan_lainnya')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const keperluanSelect = document.getElementById('keperluan');
            const lainnyaContainer = document.getElementById('keperluan_lainnya_container');
            const lainnyaInput = document.getElementById('keperluan_lainnya');
            
            function toggleLainnyaField() {
                if (keperluanSelect.value === 'lainnya') {
                    lainnyaContainer.style.display = 'block';
                    lainnyaInput.setAttribute('required', 'required');
                } else {
                    lainnyaContainer.style.display = 'none';
                    lainnyaInput.removeAttribute('required');
                    lainnyaInput.value = ''; // Kosongkan field ketika tidak dipilih
                }
            }
            
            // Initial check berdasarkan nilai old (jika ada)
            toggleLainnyaField();
            
            // Add event listener
            keperluanSelect.addEventListener('change', toggleLainnyaField);
            
            // Juga panggil saat halaman dimuat untuk menangani kasus kembali setelah error
            if ('{{ old('keperluan') }}' === 'lainnya') {
                toggleLainnyaField();
            }
        });
    </script>
</body>
</html>