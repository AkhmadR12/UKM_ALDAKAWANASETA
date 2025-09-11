 
{{-- <section id="hero" class="hero section dark-background">
    @foreach($carousels as $carousel)
        <img src="{{ asset($carousel->gambar) }}" alt="" data-aos="fade-in">

        <div class="container d-flex flex-column align-items-center">
          <h2 data-aos="fade-up" data-aos-delay="100">PLAN. LAUNCH. GROW.</h2>
          <p data-aos="fade-up" data-aos-delay="200">We are team of talented designers making websites with Bootstrap</p>
          <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
            <a href="#about" class="btn-get-started">Get Started</a>
            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
        </div>
    @endforeach
</section> --}}
<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    {{-- Carousel Indicators --}}
    <div class="carousel-indicators">
        @foreach($carousels as $key => $carousel)
            <button type="button"
                    data-bs-target="#carouselExampleDark"
                    data-bs-slide-to="{{ $key }}"
                    class="{{ $key == 0 ? 'active' : '' }}"
                    {{ $key == 0 ? 'aria-current=true' : '' }}
                    aria-label="Slide {{ $key + 1 }}"></button>
        @endforeach
    </div>

    {{-- Carousel Items --}}
    <div class="carousel-inner">
        @foreach($carousels as $key => $carousel)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" data-bs-interval="{{ $key == 0 ? 10000 : 5000 }}">
              <img src="{{ asset($carousel->gambar) }}" class="d-block w-100 carousel-half" alt="{{ $carousel->nama }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $carousel->nama }}</h5>
                    {{-- <p>{{ $carousel->deskripsi }}</p> --}}
                    {{-- <div class="d-flex mt-3">
                        <a href="#about" class="btn-get-started">Get Started</a>
                        <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center ms-3">
                            <i class="bi bi-play-circle"></i><span class="ms-1">Watch Video</span>
                        </a>
                    </div> --}}
                </div>
            </div>
        @endforeach
    </div>

    {{-- Carousel Controls --}}
    @if(count($carousels) > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    @endif
</div>
