<!-- Portfolio Section -->
<section id="portfolio" class="portfolio section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up" style="text-align: center">
      <p>CHECK OUR PORTFOLIO</p>
      <h2></h2>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
        <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
            <li data-filter="*" class="filter-active">All</li>
            @foreach ($tipes as $tipe)
                <li data-filter=".filter-{{ Str::slug($tipe->nama) }}">{{ $tipe->nama }}</li>
            @endforeach
        </ul>

        {{-- <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-app">App</li>
          <li data-filter=".filter-product">Product</li>
          <li data-filter=".filter-branding">Branding</li>
          <li data-filter=".filter-books">Books</li>
        </ul><!-- End Portfolio Filters --> --}}

        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
          @foreach ($portofolios as $p)
                  <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-{{ Str::slug($p->tipe->nama ?? 'other') }}">
                      <div class="portfolio-content h-100">
                         <img src="{{ asset($p->gambar) }}" class="img-fluid portfolio-thumb" alt="{{ $p->nama }}">

                          <div class="portfolio-info">
                              <h4>{{ $p->nama }}</h4>
                              <p>{{ \Illuminate\Support\Str::limit($p->deskripsi, 100) }}</p>
                              <a href="{{ asset($p->gambar) }}" title="{{ $p->nama }}" data-gallery="portfolio-gallery" class="glightbox preview-link">
                                  <i class="bi bi-zoom-in"></i>
                              </a>
                              <a href="{{ route('portofolio.detail', $p->id) }}" title="More Details" class="details-link">
                                  <i class="bi bi-link-45deg"></i>
                              </a>
                          </div>
                      </div>
                  </div>
          @endforeach
           

        </div><!-- End Portfolio Container -->

      </div>

    </div>

  </section><!-- /Portfolio Section -->