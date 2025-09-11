    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-brand p-0">
            <h1 class="text-dark" id="logo-text">
                {{-- <i class="fas fa-hand-holding-water me-3"></i> --}}
                POTó
                <div class="taglinea">Flowing with Purpose</div>

            </h1>
            <!-- <img src="home/img/logo.png" alt="Logo"> -->
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
            <a href="{{ url('/kontak') }}"
                class="btn btn-primary rounded-pill d-inline-flex flex-shrink-0 py-2 px-4">Contact Us</a>
        </div>
    </nav>

    <!-- Carousel Start -->
    {{-- <div class="carousel-header">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="home/img/carousel-1.jpg" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption-1">
                        <div class="carousel-caption-1-content" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4 fadeInLeft animated"
                                data-animation="fadeInLeft" data-delay="1s" style="animation-delay: 1s;"
                                style="letter-spacing: 3px;">Importance life</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4 fadeInLeft animated"
                                data-animation="fadeInLeft" data-delay="1.3s" style="animation-delay: 1.3s;">
                                Always Want Safe Water For Healthy Life</h1>
                            <p class="mb-5 fs-5 text-white fadeInLeft animated" data-animation="fadeInLeft"
                                data-delay="1.5s" style="animation-delay: 1.5s;">Lorem Ipsum is simply dummy text
                                of the printing and typesetting industry. Lorem Ipsum has been the industry's
                                standard dummy text ever since the 1500s,
                            </p>
                            <div class="carousel-caption-1-content-btn fadeInLeft animated" data-animation="fadeInLeft"
                                data-delay="1.7s" style="animation-delay: 1.7s;">
                                <a class="btn btn-primary rounded-pill flex-shrink-0 py-3 px-5 me-2"
                                    href="#">Order Now</a>
                                <a class="btn btn-secondary rounded-pill flex-shrink-0 py-3 px-5 ms-2"
                                    href="#">Free Estimate</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="home/img/carousel-2.jpg" class="img-fluid w-100" alt="Image">
                    <div class="carousel-caption-2">
                        <div class="carousel-caption-2-content" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase fw-bold mb-4 fadeInRight animated"
                                data-animation="fadeInRight" data-delay="1s" style="animation-delay: 1s;"
                                style="letter-spacing: 3px;">Importance life</h4>
                            <h1 class="display-2 text-capitalize text-white mb-4 fadeInRight animated"
                                data-animation="fadeInRight" data-delay="1.3s" style="animation-delay: 1.3s;">
                                Always Want Safe Water For Healthy Life</h1>
                            <p class="mb-5 fs-5 text-white fadeInRight animated" data-animation="fadeInRight"
                                data-delay="1.5s" style="animation-delay: 1.5s;">Lorem Ipsum is simply dummy text
                                of the printing and typesetting industry. Lorem Ipsum has been the industry's
                                standard dummy text ever since the 1500s,
                            </p>
                            <div class="carousel-caption-2-content-btn fadeInRight animated"
                                data-animation="fadeInRight" data-delay="1.7s" style="animation-delay: 1.7s;">
                                <a class="btn btn-primary rounded-pill flex-shrink-0 py-3 px-5 me-2"
                                    href="#">Order Now</a>
                                <a class="btn btn-secondary rounded-pill flex-shrink-0 py-3 px-5 ms-2"
                                    href="#">Free Estimate</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon btn btn-primary fadeInLeft animated" aria-hidden="true"
                    data-animation="fadeInLeft" data-delay="1.1s" style="animation-delay: 1.3s;"> <i
                        class="fa fa-angle-left fa-3x"></i></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon btn btn-primary fadeInRight animated" aria-hidden="true"
                    data-animation="fadeInLeft" data-delay="1.1s" style="animation-delay: 1.3s;"><i
                        class="fa fa-angle-right fa-3x"></i></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div> --}}


    <!-- Carousel End -->
