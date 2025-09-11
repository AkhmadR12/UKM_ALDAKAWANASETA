<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title> --}}
    <!-- Meta tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>POTó</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('admin/assets/img/logo/fav1.ico') }}" type="image/x-icon" />
    {{-- <link rel="icon" href="{{ asset('admin/assets/img/logo/fav.ico') }}" type="image/x-icon" /> --}}
    <script src="{{ asset('admin/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('admin/assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-signature/1.2.1/jquery.signature.min.css">

    <!-- CSS Files -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <style>
        .navbar-header {
            background-color: #1269DB !important;
            /* background-color: #3697E1; */
            /* Dark green */
        }
         /* Warna untuk mobile (di bawah 992px) */
        @media (max-width: 991.98px) {
            .navbar-header {
                background-color: #1269DB !important;
            }
        }

        .navbar-header .nav-link,
        .navbar-header .profile-username,
        .navbar-header .dropdown-toggle,
        .navbar-header .avatar-img,
         {
            color: #f8f8f8 !important;
        }
        .navbar-header .fa-bell,
        .navbar-header .fa-search{
             color: #0c0c0c !important;
        }

        .navbar-header .dropdown-menu {
            background-color: #fafafa;
            /* Dark green dropdown menu */
        }

        .navbar-header .dropdown-menu .dropdown-item {
            color: #020202;
            /* White text in dropdown items */
        }

        .navbar-header .dropdown-menu .dropdown-item:hover {
            background-color: #1269DB;
            /* background-color: #3697E1; */
            /* Darker green on hover */
        }
    /* Notification Styles */
        .notification {
            position: absolute;
            top: -5px;
            right: -5px;
            padding: 3px 6px;
            border-radius: 50%;
            background: #ff4757;
            color: white;
            font-size: 10px;
        }

        /* Responsive Fixes */
        @media (max-width: 991.98px) {
            .navbar-header {
                padding: 0.5rem 1rem;
            }
            
            .navbar-nav.topbar-nav {
                flex-direction: row;
                align-items: center;
            }
            
            .nav-item.topbar-icon, 
            .nav-item.topbar-user {
                margin-left: 10px;
            }
            
            .dropdown-menu {
                position: absolute;
                right: 0;
                left: auto;
            }
            
            .profile-username span {
                display: none;
            }
            
            .profile-username .fw-bold {
                display: inline;
            }
        }

        /* Ensure notification icon is visible */
        .fa-bell {
            font-size: 1.25rem;
            position: relative;
        }
    </style>
    <!-- Fonts -->
    {{-- <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- Styles -->
    {{-- @livewireStyles --}}
</head>



<body>
     <div id="app">
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
            <div class="container-fluid">
                <nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
                </nav>

                <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                    <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-expanded="false" aria-haspopup="true">
                            <i class="fa fa-search"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-search animated fadeIn">
                            <form class="navbar-left navbar-form nav-search">
                                <div class="input-group">
                                    <input type="text" placeholder="Search ..." class="form-control" />
                                </div>
                            </form>
                        </ul>
                    </li>
                    {{-- <li class="nav-item topbar-icon dropdown hidden-caret">
                        <a class="nav-link dropdown-toggle" href="#" id="notifDropdown"
                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell" style="color: white;"></i>

                            @if($notificationCount > 0)
                                <span class="notification">{{ $notificationCount }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                            <li>
                                <div class="dropdown-title">
                                    You have {{ $notificationCount }} new notification{{ $notificationCount > 1 ? 's' : '' }}
                                </div>
                            </li>
                            <li>
                                <div class="notif-scroll scrollbar-outer">
                                    <div class="notif-center">
                                        @forelse ($notifications as $notif)
                                            <a href="#">
                                                <div class="notif-icon notif-primary">
                                                    <i class="fa fa-info-circle"></i>
                                                </div>
                                                <div class="notif-content">
                                                    <span class="block">
                                                        Transaksi #{{ $notif->id }} status: <strong>{{ ucfirst($notif->status) }}</strong>
                                                    </span>
                                                    <span class="time">{{ $notif->created_at->diffForHumans() }}</span>
                                                </div>
                                            </a>
                                        @empty
                                            <span class="dropdown-item text-muted">No notifications</span>
                                        @endforelse
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="see-all" href="{{ route('payments.index') }}">
                                    See all notifications <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                     <li class="nav-item topbar-icon dropdown hidden-caret">
                        <a class="nav-link dropdown-toggle" href="#" id="notifDropdown"
                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            @if($notificationCount > 0)
                                <span class="notification">{{ $notificationCount }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                            <li>
                                <div class="dropdown-title">
                                    You have {{ $notificationCount }} new notification{{ $notificationCount > 1 ? 's' : '' }}
                                </div>
                            </li>
                            <li>
                                <div class="notif-scroll scrollbar-outer">
                                    <div class="notif-center">
                                        @forelse ($notifications as $notif)
                                            <a href="{{ route('form_inputs.show', $notif->id) }}">
                                                <div class="notif-icon notif-{{ $notif->status === 'INPG' ? 'warning' : 'success' }}">
                                                    <i class="fa {{ $notif->status === 'INPG' ? 'fa-hourglass-half' : 'fa-check-circle' }}"></i>
                                                </div>
                                                <div class="notif-content">
                                                    <span class="block">
                                                        Form #{{ $notif->id }} - {{ $notif->nama }}
                                                        <br>
                                                        Status: <strong>{{ $notif->status }}</strong>
                                                    </span>
                                                    <span class="time">{{ $notif->created_at->diffForHumans() }}</span>
                                                </div>
                                            </a>
                                        @empty
                                            <span class="dropdown-item text-muted">No notifications</span>
                                        @endforelse
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="see-all" href="{{ route('form_inputs.index') }}">
                                    See all notifications <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item topbar-user dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                            aria-expanded="false">
                            <div class="avatar-sm">
                                @if (Auth::user()->profile_photo_path)
                                    <img src="{{ asset(Auth::user()->profile_photo_path) }}" alt="Profile Image"
                                        class="avatar-img rounded-circle" />
                                @else
                                    <img src="{{ asset('admin/assets/img/profile.jpg') }}" alt="Profile Image"
                                        class="avatar-img rounded-circle" />
                                @endif
                            </div>
                            <span class="profile-username">
                                <span class="op-7 d-none d-md-inline">Hi,</span>
                                <span class="fw-bold">{{ Auth::user()->name ?? 'Guest' }}</span>
                            </span>
                        </a>

                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg">
                                            @if (Auth::user()->profile_photo_path)
                                                <img src="{{ asset(Auth::user()->profile_photo_path) }}"
                                                    alt="Profile Image" class="avatar-img rounded-circle" />
                                            @else
                                                <img src="{{ asset('admin/assets/img/profile.jpg') }}"
                                                    alt="Profile Image" class="avatar-img rounded-circle" />
                                            @endif
                                        </div>
                                        <div class="u-text">
                                            <h4>{{ Auth::user()->name ?? 'Guest' }}</h4>
                                            <p class="text-muted">{{ Auth::user()->email ?? 'No Email' }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('/user') }}">My Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('/logout') }}">Logout</a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        @section('content')
        @endsection
        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        {{-- <main> --}}
        {{-- {{ $slot }} --}}
        {{-- <main class="py-4">
            @yield('content')
        </main> --}}
    </div>

    {{-- @stack('modals') --}}

    {{-- @livewireScripts --}}
</body>

</html>
