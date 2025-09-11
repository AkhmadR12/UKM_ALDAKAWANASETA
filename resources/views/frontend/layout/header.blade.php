
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">ALDAKAWANASETA</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
            <li>
                <a href="{{ route('home') }}"
                   class="nav-item nav-link {{ request()->routeIs('ho') ? 'active' : '' }}">Home</a>
            </li>
            <li>
                <a href="{{ url('/form') }}"
                   class="nav-item nav-link {{ request()->is('form') ? 'active' : '' }}">form</a>
            </li>
            <li>
                <a href="{{ url('/kontak') }}"
                   class="nav-item nav-link {{ request()->is('kontak') ? 'active' : '' }}">Kontak</a>
            </li>
            <li>
                <a href="{{ url('/buku-tamu') }}"
                   class="nav-item nav-link {{ request()->is('bukutamu') ? 'active' : '' }}">Buku Tamu</a>
            </li>
            {{-- <li>
                <a href="{{ url('/majalah') }}"
                   class="nav-item nav-link {{ request()->is('majalah') ? 'active' : '' }}">Majalah</a>
            </li> --}}
            {{-- <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle {{ request()->is('majalah*') ? 'active' : '' }}" data-bs-toggle="dropdown" role="button" aria-expanded="false">
                    Majalah
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ url('/majalah') }}">Edisi Terbaru</a></li>
                    <li><a class="dropdown-item" href="{{ url('/kontributor') }}">Kontribusi</a></li>
                    <li><a class="dropdown-item" href="{{ url('/redakt') }}">Redakturs</a></li>
                </ul>
            </li> --}}
             

            {{-- <li>
                <a href="{{ url('/acara') }}"
                   class="nav-item nav-link {{ request()->is('acara') ? 'active' : '' }}">Event</a>
            </li> --}}
            @auth
                @if(in_array(Auth::user()->role, ['UMUM']))
                    <li>
                        <a href="{{ url('/profile') }}"
                          class="nav-item nav-link {{ request()->is('profile') ? 'active' : '' }}">
                          Profile
                        </a>
                    </li>
                @endif
            @endauth
            @auth
                @if(in_array(Auth::user()->role, ['admin', 'karyawan', 'member']))
                    <li>
                        <a href="{{ url('/dashboard') }}"
                          class="nav-item nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                          Dashboard
                        </a>
                    </li>
                @endif
            @endauth

            @php
                $cartCount = 0;
                if (Auth::check()) {
                    $cartCount = Auth::user()->carts()->count();
                }
            @endphp

            

            <li>
                @auth
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit"
                                class="btn btn-danger btn-sm rounded-circle"
                                title="Logout"
                                style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="btn btn-primary btn-sm rounded-circle"
                       title="Login"
                       style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user"></i>
                    </a>
                @endauth
            </li>
            {{-- <li>
                <a href="{{ url('/kontak') }}"
                   class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Contact Us</a>
            </li> --}}
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
    

 
    </div>
</header>
<!-- HEADER ATAS -->
{{-- <header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

    <a href="index.html" class="logo d-flex align-items-center me-auto">
      <h1 class="sitename">PhotorapIndo</h1>
    </a>

    <nav id="navmenu" class="navmenu d-none d-xl-block">
      <ul class="d-flex gap-3 align-items-center mb-0">
        <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('ho') ? 'active' : '' }}">Home</a></li>
        <li><a href="{{ url('/form') }}" class="nav-link {{ request()->is('form') ? 'active' : '' }}">Form</a></li>
        <li><a href="{{ url('/kontak') }}" class="nav-link {{ request()->is('kontak') ? 'active' : '' }}">Kontak</a></li>
        <li><a href="{{ url('/pertanyaan') }}" class="nav-link {{ request()->is('pertanyaan') ? 'active' : '' }}">Pertanyaan</a></li>
        <li>
          @auth
          <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm rounded-circle" style="width: 40px; height: 40px;">
              <i class="fas fa-sign-out-alt"></i>
            </button>
          </form>
          @else
          <a href="{{ route('login') }}" class="btn btn-primary btn-sm rounded-circle" style="width: 40px; height: 40px;">
            <i class="fas fa-user"></i>
          </a>
          @endauth
        </li>
        <li>
          <a href="{{ url('/kontak') }}" class="btn btn-primary rounded-pill py-2 px-4">Contact Us</a>
        </li>
      </ul>
    </nav>

  </div>
</header> --}}

<!-- MENU BAWAH RESPONSIVE -->
{{-- <nav class="mobile-bottom-nav d-xl-none">
  <a href="{{ route('home') }}" class="nav-icon {{ request()->routeIs('ho') ? 'active' : '' }}">
    <i class="fas fa-home"></i><span>Home</span>
  </a>
  <a href="{{ url('/Majalah') }}" class="nav-icon {{ request()->is('Majalah') ? 'active' : '' }}">
    <i class="fas fa-book"></i><span>Majalah</span>
  </a>
  <a href="{{ url('/kontak') }}" class="nav-icon {{ request()->is('kontak') ? 'active' : '' }}">
    <i class="fas fa-phone"></i><span>Kontak</span>
  </a>
  <a href="{{ url('/pertanyaan') }}" class="nav-icon {{ request()->is('pertanyaan') ? 'active' : '' }}">
    <i class="fas fa-question"></i><span>FAQ</span>
  </a>
</nav> --}}
<!-- MENU BAWAH RESPONSIVE -->
<nav class="mobile-bottom-nav d-xl-none">
  <a href="{{ url('/acara') }}" class="nav-icon {{ request()->routeIs('acara') ? 'active' : '' }}">
    {{-- <i class="fas fa-home"></i> --}}<i class="fab fa-wpforms"></i>
    <span>Event</span>
  </a>
  
  <a href="{{ url('/majalah') }}" class="nav-icon {{ request()->is('Majalah') ? 'active' : '' }}">
    <i class="fas fa-book"></i>
    <span>Majalah</span>
  </a>
  
  <!-- Tombol Logo Tengah -->
  <a href="{{ route('home') }}" class="nav-icon center-logo">
    <div class="logo-circle">
      <img src="{{ asset('/logo/FI_APP.PNG') }}" alt="Logo"><br>
       
    </div>
    <span style="margin-top: -30%">Home</span>
  </a>
  
  <a href="{{ url('/kontak') }}" class="nav-icon {{ request()->is('kontak') ? 'active' : '' }}">
    <i class="fas fa-phone"></i>
    <span>Kontak</span>
  </a>
  
  <a href="{{ url('/pertanyaan') }}" class="nav-icon {{ request()->is('pertanyaan') ? 'active' : '' }}">
    <i class="fas fa-question"></i>
    <span>FAQ</span>
  </a>
</nav>