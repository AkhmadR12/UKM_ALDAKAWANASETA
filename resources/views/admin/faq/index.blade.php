{{-- @php
    use App\Models\User;
@endphp --}}
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

                                        {{-- @if (in_array($usertype, [User::ADMIN, User::CHECKER])) --}}
                                        <a href="{{ route('faq.create') }}" class="btn btn-primary btn-round ms-auto">
                                            <i class="fa fa-plus"></i>
                                            tambah
                                        </a>
                                        {{-- @endif --}}
                                    </div>
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table id="add-row" class="display table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Pertanyaan</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($faqs as $faq)
                                                    <tr>
                                                        <td>{{ $faq->question }}</td>
                                                        <td>{{ $faq->status ? 'Aktif' : 'Nonaktif' }}</td>
                                                        <td>
                                                            <a href="{{ route('faq.edit', $faq->id) }}"
                                                                class="btn btn-warning btn-sm">Edit</a>
                                                            <form action="{{ route('faq.destroy', $faq->id) }}"
                                                                method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Yakin hapus FAQ?')">Hapus</button>
                                                            </form>
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
            <!-- End body -->
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
