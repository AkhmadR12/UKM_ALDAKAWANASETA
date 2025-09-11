<!DOCTYPE html>
<html lang="en">

<head>
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
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">FAQ</h4>
                                        <a href="{{ route('form_inputs.create') }}" class="btn btn-primary btn-round ms-auto">
                                            <i class="fa fa-plus"></i>
                                            tambah
                                        </a>
                                        {{-- @endif --}}
                                    </div>
                                </div>                
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form method="GET" action="{{ route('form_inputs.create') }}">
                                    <select name="kategori_id" required>
                                        @foreach ($kategoris as $kategori)
                                            @if($kategori->status === 'aktif')
                                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <button type="submit">Lanjut</button>
                                </form>
                                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nomor</th>
                                                    <th>Nama</th>
                                                    <th>alamat</th>
                                                    <th>organisasi</th>
                                                    <th>email</th>
                                                    <th>Nomor handphone</th>
                                                    <th>Status</th>
                                                    <th style="min-width: 220px;">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($forms as $index => $form)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $form->nama }}</td>
                                                    <td>{{ $form->alamat }}</td>
                                                    <td>{{ $form->organisasi }}</td>
                                                    <td>{{ $form->email }}</td>
                                                    <td>{{ $form->nomor_telp }}</td>
                                                    <td>{{ $form->status }}</td>
                                                    {{--                                                
                                                    <td>
                                                        <img src="{{ asset($form->photo) }}" alt="Member Image" width="100">
                                                    </td>
                                                    <td>
                                                        <span class="badge 
                                                            @if($form->status == 'OPEN') badge-danger 
                                                            @elseif($member->status == 'INPG') badge-success 
                                                            @else badge-secondary @endif">
                                                            {{ $member->status }}
                                                        </span>
                                                    </td> --}}
                                                    <td>
                                                        <div class="d-flex flex-wrap" style="gap: 5px;">                                            
                                                             <a href="{{ route('form_inputs.show', $form->id) }}" 
                                                                class="btn btn-sm btn-info"
                                                                title="Lihat Detail">
                                                                    <i class="fas fa-eye"></i> Detail
                                                            </a>
                                                            <a href="{{ route('form_inputs.edit', $form->id) }}" 
                                                               class="btn btn-sm btn-warning"
                                                               title="Edit">
                                                               <i class="fas fa-edit"></i>
                                                               Edit
                                                            </a>                                                          
                                                            {{-- <a href="{{ route('form_inputs.edit', $form->id) }}" 
                                                               class="btn btn-sm btn-success"
                                                               title="Edit">
                                                               <i class="fas fa-edit"></i>
                                                               Disetujui
                                                            </a>                                                           --}}
                                                                                                                        
                                                           <form action="{{ route('form_inputs.destroy', $form->id) }}" 
                                                                  method="POST" 
                                                                  class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="btn btn-sm btn-danger"
                                                                        title="Delete"
                                                                        onclick="return confirm('Are you sure?')">
                                                                    <i class="fas fa-trash"></i>
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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

</body>

</html>