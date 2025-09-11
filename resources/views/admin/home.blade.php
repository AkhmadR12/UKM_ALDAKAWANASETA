<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- <link rel="icon" href="admin/assets/img/logo/fav.ico" type="image/x-icon" /> --}}

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
            {{-- @include('admin.body') --}}
            <!-- end Body -->

            @include('admin.footer')
        </div>
        <!-- End Custom template -->
        {{-- @include('admin.custume') --}}
        <!-- End Custom template -->
        <!-- Footer -->
        <!-- End footer -->


    </div>
    <!--   Core JS Files   -->
    @include('admin.js')
</body>

</html>
