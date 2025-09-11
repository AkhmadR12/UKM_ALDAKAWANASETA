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

                        </ul>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">User</h4>

                                        {{-- @if (in_array($usertype, [User::ADMIN, User::CHECKER])) --}}
                                        {{-- <a href="{{ route('users.edit') }}" class="btn btn-primary btn-round ms-auto">
                                            <i class="fa fa-plus"></i>
                                            tambah
                                        </a> --}}
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
                                                    <th class="px-4 py-2">#</th>
                                                    <th class="px-4 py-2">Name</th>
                                                    <th class="px-4 py-2">Email</th>
                                                    <th class="px-4 py-2">Role</th>
                                                    <th class="px-4 py-2 text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($users as $index => $user)
                                                    <tr class="border-b">
                                                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                                                        <td class="px-4 py-2">{{ $user->name }}</td>
                                                        <td class="px-4 py-2">{{ $user->email }}</td>
                                                        <td class="px-4 py-2 capitalize">{{ $user->role }}</td>
                                                        <td class="px-4 py-2 text-center space-x-2">
                                                            <a href="{{ route('users.edit', $user) }}"
                                                                class="btn btn-warning btn-sm">
                                                                Edit
                                                            </a>

                                                            <form action="{{ route('users.destroy', $user) }}"
                                                                method="POST"
                                                                onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                                                                class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm">
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center py-4">Tidak ada user
                                                            ditemukan.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- Pagination --}}
                                    <div class="mt-4">
                                        {{ $users->links() }}
                                    </div>
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
