<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    {{-- <link rel="icon" href="admin/assets/img/logo/fav.ico" type="image/x-icon" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .form-input:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .upload-area {
            transition: all 0.3s ease;
        }
        .upload-area:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }
        .profile-avatar {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .section-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e7eb;
            background: #ffffff;
        }
        .section-card:hover {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: translateY(-2px);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }
        .btn-secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 87, 108, 0.4);
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="green2">
                        <a href="index.html" class="logo">
                            <img src="{{ asset('admin/assets/img/logo/Logo.png') }}" style="width: 50%;">
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
                </x-app-layout>
                {{-- @include('admin.navbar') --}}
                <!-- End Navbar -->
            </div>
            <!-- Body -->
            {{-- <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">User</h3>
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
                                    <h5>Edit user</h5>
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

                                     
                                    <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <!-- Kolom Kiri -->
                                            <div>
                                                <!-- Foto Profil -->
                                                <div class="mb-6">
                                                    <label class="block text-gray-700 font-medium mb-2">Foto Profil</label>
                                                    <div class="flex items-center space-x-4">
                                                        <div class="shrink-0">
                                                            @if($user->photo)
                                                                <img id="photoPreview" class="h-20 w-20 rounded-full object-cover border-2 border-gray-200" src="{{ asset('storage/' . $user->photo) }}" alt="Foto Profil">
                                                            @else
                                                                <div id="photoPreview" class="h-20 w-20 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                                    </svg>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="w-full">
                                                            <input type="file" name="photo" id="photoInput" class="hidden" accept="image/*">
                                                            <label for="photoInput" class="cursor-pointer bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                                Pilih Foto
                                                            </label>
                                                            <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG (Maks. 2MB)</p>
                                                            @error('photo')
                                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Informasi Dasar -->
                                                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Dasar</h3>
                                                    
                                                    <!-- Name -->
                                                    <div class="mb-4">
                                                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                        @error('name')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Email (disabled) -->
                                                    <div class="mb-4">
                                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 cursor-not-allowed" disabled>
                                                        @error('email')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Role (disabled) -->
                                                    <div class="mb-4">
                                                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                                        <select id="role" name="role" disabled
                                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        </select>
                                                        @error('role')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Subdep (disabled) -->
                                                    <div class="mb-4">
                                                        <label for="subdep_id" class="block text-sm font-medium text-gray-700">Sub Departemen</label>
                                                        <select id="subdep_id" name="subdep_id" disabled
                                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 bg-gray-100 cursor-not-allowed focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                            <option value="">-- Pilih Subdep --</option>
                                                            @foreach ($subdeps as $subdep)
                                                                <option value="{{ $subdep->id }}" {{ old('subdep_id', $user->subdep_id ?? '') == $subdep->id ? 'selected' : '' }}>
                                                                    {{ $subdep->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('subdep_id')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Kolom Kanan -->
                                            <div>
                                                <!-- Informasi Tambahan -->
                                                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 mb-6">
                                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Tambahan</h3>
                                                    
                                                    <!-- Contact -->
                                                    <div class="mb-4">
                                                        <label for="contact" class="block text-sm font-medium text-gray-700">Nomor Kontak</label>
                                                        <input type="text" id="contact" name="contact" value="{{ old('contact', $user->contact) }}"
                                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                        @error('contact')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Tanggal Lahir -->
                                                    <div class="mb-4">
                                                        <label for="ttl" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                                        <input type="date" id="ttl" name="ttl" value="{{ old('ttl', $user->ttl) }}"
                                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                        @error('ttl')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Jenis Kelamin -->
                                                    <div class="mb-4">
                                                        <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                                        <div class="mt-1 space-y-2">
                                                            <div class="flex items-center">
                                                                <input id="kelamin-l" name="kelamin" type="radio" value="L" {{ old('kelamin', $user->kelamin) == 'L' ? 'checked' : '' }}
                                                                    class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                                                <label for="kelamin-l" class="ml-2 block text-sm text-gray-700">Laki-laki</label>
                                                            </div>
                                                            <div class="flex items-center">
                                                                <input id="kelamin-p" name="kelamin" type="radio" value="P" {{ old('kelamin', $user->kelamin) == 'P' ? 'checked' : '' }}
                                                                    class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300">
                                                                <label for="kelamin-p" class="ml-2 block text-sm text-gray-700">Perempuan</label>
                                                            </div>
                                                        </div>
                                                        @error('kelamin')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Kota -->
                                                    <div class="mb-4">
                                                        <label for="kota_id" class="block text-sm font-medium text-gray-700">Kota</label>
                                                        <select id="kota_id" name="kota_id"
                                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                            <option value="">-- Pilih Kota --</option>
                                                            <!-- Daftar kota akan diisi di sini -->
                                                            @foreach($cities as $city)
                                                                <option value="{{ $city->id }}" {{ old('kota_id', $user->kota_id) == $city->id ? 'selected' : '' }}>
                                                                    {{ $city->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('kota_id')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <!-- Password -->
                                                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Ganti Password</h3>
                                                    <p class="text-sm text-gray-500 mb-4">Biarkan kosong jika tidak ingin mengubah password</p>
                                                    
                                                    <!-- New Password -->
                                                    <div class="mb-4">
                                                        <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                                                        <input type="password" id="password" name="password"
                                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                                        @error('password')
                                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                                        @enderror
                                                    </div>

                                                    <!-- Confirm Password -->
                                                    <div class="mb-4">
                                                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm-text-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Tombol Aksi -->
                                        <div class="mt-6 flex justify-end space-x-3">
                                            <a href="{{ url('/users') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                                </svg>
                                                Batal
                                            </a>
                                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                                </svg>
                                                Simpan Perubahan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- end Body -->
            <!-- Body -->
            <div class="min-h-screen py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <!-- Header Section -->
                    <div class="gradient-bg rounded-2xl p-8 mb-8 mt-14 text-white">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold mb-2">Edit Pengguna</h1>
                                <p class="text-blue-100">Perbarui informasi pengguna dengan mudah dan aman</p>
                                <nav class="flex mt-4" aria-label="Breadcrumb">
                                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                        <li class="inline-flex items-center">
                                            <a href="#" class="inline-flex items-center text-blue-100 hover:text-white">
                                                <i class="fas fa-home mr-2"></i>
                                                Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <div class="flex items-center">
                                                <i class="fas fa-chevron-right text-blue-200 mx-2"></i>
                                                <a href="{{ url('/users') }}" class="text-blue-100 hover:text-white">Users</a>
                                            </div>
                                        </li>
                                        <li aria-current="page">
                                            <div class="flex items-center">
                                                <i class="fas fa-chevron-right text-blue-200 mx-2"></i>
                                                <span class="text-white font-medium">Edit</span>
                                            </div>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="hidden md:block">
                                <i class="fas fa-user-edit text-6xl opacity-20"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Alert Messages -->
                    @if (session('success'))
                        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-check-circle text-green-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i class="fas fa-exclamation-triangle text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Terdapat beberapa error:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Form Section -->
                    <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                            
                            <!-- Profile Photo Section -->
                            <div class="lg:col-span-1">
                                <div class="section-card rounded-2xl p-6 text-center">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center justify-center">
                                        <i class="fas fa-camera mr-2 text-indigo-600"></i>
                                        Foto Profil
                                    </h3>
                                    
                                    <div class="upload-area relative mb-6">
                                        <div class="relative inline-block">
                                            @if($user->photo)
                                                <img id="photoPreview" 
                                                     class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg mx-auto" 
                                                     src="{{ asset('avatars/' . $user->photo) }}" 
                                                     alt="Foto Profil">
                                            @else
                                                <div id="photoPreview" 
                                                     class="profile-avatar w-32 h-32 rounded-full flex items-center justify-center text-white text-3xl font-bold mx-auto shadow-lg">
                                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                                </div>
                                            @endif
                                            <div class="absolute bottom-0 right-0 bg-indigo-600 rounded-full p-2 cursor-pointer hover:bg-indigo-700 transition-colors">
                                                <i class="fas fa-camera text-white"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="file" name="photo" id="photoInput" class="hidden" accept="image/*">
                                    <label for="photoInput" class="btn-primary cursor-pointer inline-flex items-center px-6 py-3 border border-transparent text-sm font-medium rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-upload mr-2"></i>
                                        Pilih Foto Baru
                                    </label>
                                    <p class="mt-2 text-xs text-gray-500">JPG, PNG hingga 2MB</p>
                                    
                                    @error('photo')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                    <!-- User Stats -->
                                    <div class="mt-8 grid grid-cols-2 gap-4 text-center">
                                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl p-4">
                                            <div class="text-2xl font-bold text-indigo-600">{{ $user->created_at->format('Y') }}</div>
                                            <div class="text-xs text-gray-600">Tahun Bergabung</div>
                                        </div>
                                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl p-4">
                                            <div class="text-2xl font-bold text-emerald-600">
                                                <i class="fas fa-{{ $user->role == 'admin' ? 'crown' : 'user' }}"></i>
                                            </div>
                                            <div class="text-xs text-gray-600 capitalize">{{ $user->role }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Fields -->
                            <div class="lg:col-span-2 space-y-6">
                                
                                <!-- Basic Information -->
                                <div class="section-card rounded-2xl p-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                        <i class="fas fa-user mr-3 text-indigo-600"></i>
                                        Informasi Dasar
                                    </h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Name -->
                                        <div class="col-span-2">
                                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-id-card mr-2 text-gray-400"></i>
                                                Nama Lengkap
                                            </label>
                                            <input type="text" id="name" name="name" 
                                                   value="{{ old('name', $user->name) }}"
                                                   class="form-input block w-full border-gray-300 rounded-xl shadow-sm py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                                   placeholder="Masukkan nama lengkap">
                                            @error('name')
                                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-envelope mr-2 text-gray-400"></i>
                                                Email
                                            </label>
                                            <input type="email" id="email" name="email" 
                                                   value="{{ old('email', $user->email) }}"
                                                   class="form-input block w-full border-gray-300 rounded-xl shadow-sm py-3 px-4 bg-gray-50 cursor-not-allowed" 
                                                   disabled>
                                            <p class="mt-1 text-xs text-gray-500">Email tidak dapat diubah</p>
                                        </div>

                                        @php
                                            $isAdmin = auth()->user()->role === 'admin';
                                        @endphp

                                        <!-- Role -->
                                        <div>
                                            <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-user-tag mr-2 text-gray-400"></i>
                                                Role
                                            </label>
                                            <select id="role" name="role" 
                                                    class="form-input block w-full border-gray-300 rounded-xl shadow-sm py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                                    {{ $isAdmin ? '' : 'disabled' }}>
                                                <option value="umum" {{ $user->role == 'umum' ? 'selected' : '' }}>Umum</option>
                                                <option value="member" {{ $user->role == 'member' ? 'selected' : '' }}>Member</option>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                            @unless($isAdmin)
                                                <!-- tetap kirim ke backend -->
                                                <input type="hidden" name="role" value="{{ $user->role }}">
                                            @endunless
                                            @error('role')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Subdep -->
                                        <div>
                                            <label for="subdep_id" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-building mr-2 text-gray-400"></i>
                                                Sub Departemen
                                            </label>
                                            <select id="subdep_kode" name="subdep_kode" 
                                                    class="form-input block w-full border-gray-300 rounded-xl shadow-sm py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                                    {{ $isAdmin ? '' : 'disabled' }}>
                                                <option value="">-- Pilih Sub Departemen --</option>
                                                @foreach ($subdeps as $subdep)
                                                    <option value="{{ $subdep->id }}" {{ old('subdep_kode', $user->subdep_kode ?? '') == $subdep->id ? 'selected' : '' }}>
                                                        {{ $subdep->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @unless($isAdmin)
                                                <input type="hidden" name="subdep_kode" value="{{ $user->subdep_kode }}">
                                            @endunless
                                            @error('subdep_kode')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <!-- Contact -->
                                        <div>
                                            <label for="contact" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-phone mr-2 text-gray-400"></i>
                                                Nomor Kontak
                                            </label>
                                            <input type="text" id="contact" name="contact" 
                                                   value="{{ old('contact', $user->contact) }}"
                                                   class="form-input block w-full border-gray-300 rounded-xl shadow-sm py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                                   placeholder="Contoh: 08123456789">
                                            @error('contact')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Information -->
                                <div class="section-card rounded-2xl p-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                        <i class="fas fa-info-circle mr-3 text-indigo-600"></i>
                                        Informasi Tambahan
                                    </h3>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Birth Date -->
                                        <div>
                                            <label for="ttl" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-birthday-cake mr-2 text-gray-400"></i>
                                                Tanggal Lahir
                                            </label>
                                            <input type="date" id="ttl" name="ttl" 
                                                   value="{{ old('ttl', $user->ttl) }}"
                                                   class="form-input block w-full border-gray-300 rounded-xl shadow-sm py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
                                            @error('ttl')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- City -->
                                        <div>
                                            <label for="kota_id" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                                                Kota
                                            </label>
                                            <select id="kota_id" name="kota_id" 
                                                    class="form-input block w-full border-gray-300 rounded-xl shadow-sm py-3 px-4 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
                                                <option value="">-- Pilih Kota --</option>
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}" {{ old('kota_id', $user->kota_id) == $city->id ? 'selected' : '' }}>
                                                        {{ $city->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kota_id')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Gender -->
                                        <div class="col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-4">
                                                <i class="fas fa-venus-mars mr-2 text-gray-400"></i>
                                                Jenis Kelamin
                                            </label>
                                            <div class="grid grid-cols-2 gap-4">
                                                <div class="relative">
                                                    <input id="kelamin-l" name="kelamin" type="radio" value="L" 
                                                           {{ old('kelamin', $user->kelamin) == 'L' ? 'checked' : '' }}
                                                           class="peer sr-only">
                                                    <label for="kelamin-l" class="flex items-center justify-center w-full p-4 text-gray-500 bg-white border-2 border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:border-blue-600 peer-checked:text-blue-600 peer-checked:bg-blue-50 transition-all duration-300">
                                                        <i class="fas fa-mars mr-2"></i>
                                                        Laki-laki
                                                    </label>
                                                </div>
                                                <div class="relative">
                                                    <input id="kelamin-p" name="kelamin" type="radio" value="P" 
                                                           {{ old('kelamin', $user->kelamin) == 'P' ? 'checked' : '' }}
                                                           class="peer sr-only">
                                                    <label for="kelamin-p" class="flex items-center justify-center w-full p-4 text-gray-500 bg-white border-2 border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 peer-checked:border-pink-600 peer-checked:text-pink-600 peer-checked:bg-pink-50 transition-all duration-300">
                                                        <i class="fas fa-venus mr-2"></i>
                                                        Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                            @error('kelamin')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Password Section -->
                                <div class="section-card rounded-2xl p-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                        <i class="fas fa-lock mr-3 text-indigo-600"></i>
                                        Ganti Password
                                    </h3>
                                    <p class="text-sm text-gray-500 mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Biarkan kosong jika tidak ingin mengubah password
                                    </p>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- New Password -->
                                        <div>
                                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-key mr-2 text-gray-400"></i>
                                                Password Baru
                                            </label>
                                            <div class="relative">
                                                <input type="password" id="password" name="password"
                                                       class="form-input block w-full border-gray-300 rounded-xl shadow-sm py-3 px-4 pr-12 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                                       placeholder="Minimal 8 karakter">
                                                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3" onclick="togglePassword('password')">
                                                    <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="password-icon"></i>
                                                </button>
                                            </div>
                                            @error('password')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Confirm Password -->
                                        <div>
                                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                                <i class="fas fa-check-double mr-2 text-gray-400"></i>
                                                Konfirmasi Password
                                            </label>
                                            <div class="relative">
                                                <input type="password" id="password_confirmation" name="password_confirmation"
                                                       class="form-input block w-full border-gray-300 rounded-xl shadow-sm py-3 px-4 pr-12 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300"
                                                       placeholder="Ulangi password baru">
                                                <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-3" onclick="togglePassword('password_confirmation')">
                                                    <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="password_confirmation-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6">
                                    <a href="{{ url('/user') }}" 
                                       class="btn-secondary inline-flex justify-center items-center px-8 py-3 border border-transparent text-sm font-medium rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                                        <i class="fas fa-arrow-left mr-2"></i>
                                        Kembali
                                    </a>
                                    <button type="submit" 
                                            class="btn-primary inline-flex justify-center items-center px-8 py-3 border border-transparent text-sm font-medium rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        <i class="fas fa-save mr-2"></i>
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end Body -->

            @include('admin.footer')
        </div>
    </div>
    <!--   Core JS Files   -->
    @include('admin.js')
    <script>
        // Photo Preview
        document.getElementById('photoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('photoPreview');
                    if (preview.tagName === 'IMG') {
                        preview.src = event.target.result;
                    } else {
                        // Replace div with img
                        const newPreview = document.createElement('img');
                        newPreview.id = 'photoPreview';
                        newPreview.className = 'w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg mx-auto';
                        newPreview.src = event.target.result;
                        preview.parentNode.replaceChild(newPreview, preview);
                    }
                }
                reader.readAsDataURL(file);
            }
        });

        // Toggle Password Visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Smooth scroll and form validation
        document.addEventListener('DOMContentLoaded', function() {
            // Add smooth transitions
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.classList.add('ring-2', 'ring-indigo-500');
                });
                
                input.addEventListener('blur', function() {
                    this.classList.remove('ring-2', 'ring-indigo-500');
                });
            });
        });
    </script>
</body>

</html>
