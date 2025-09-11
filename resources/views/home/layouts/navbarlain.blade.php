<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-brand p-0">
            <h1 class="text-primary"><i class="fas fa-hand-holding-water me-3"></i>POTó</h1>
            <!-- <img src="img/logo.png" alt="Logo"> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('home') }}"
                    class="nav-item nav-link {{ request()->routeIs('ho') ? 'active' : '' }}">Home</a>
                <a href="{{ url('/tentang') }}"
                    class="nav-item nav-link {{ request()->is('tentang') ? 'active' : '' }}">Tentang</a>
                <a href="{{ url('/kontak') }}"
                    class="nav-item nav-link {{ request()->is('kontak') ? 'active' : '' }}">Kontak</a>
                <a href="{{ url('/pertanyaan') }}"
                    class="nav-item nav-link {{ request()->is('pertanyaan') ? 'active' : '' }}">Pertanyaan</a>
            </div>


            @auth
                <!-- Jika sudah login, tampilkan tombol logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="btn btn-danger btn-md-square d-flex flex-shrink-0 mb-3 mb-lg-0 rounded-circle me-3">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            @else
                <!-- Jika belum login, tampilkan tombol login -->
                <a href="{{ route('login') }}"
                    class="btn btn-primary btn-md-square d-flex flex-shrink-0 mb-3 mb-lg-0 rounded-circle me-3">
                    <i class="fas fa-user"></i>
                </a>
            @endauth
            <a href="" class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Order
                Now</a>
        </div>
    </nav>

    <!-- Header Start -->

    <!-- Header End -->
</div>
