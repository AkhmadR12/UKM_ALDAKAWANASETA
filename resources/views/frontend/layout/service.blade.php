<!-- Services Section -->
<section id="services" class="services section">

    <div class="container section-title" data-aos="fade-up" style="text-align: center">
      <p>DEVISI</p>
      <h2></h2>
    </div>
    <!-- Section Title -->
    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-5">
        
        @foreach($services as $service)
          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="service-item">
              
              <div class="img position-relative">
                @if (is_array($service->image) && count($service->image) > 1)
                  <!-- Bootstrap Carousel -->
                  <div id="carousel-{{ $loop->iteration }}" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      @foreach ($service->image as $idx => $img)
                        @if (!empty($img))
                          <div class="carousel-item {{ $idx == 0 ? 'active' : '' }}">
                            <img src="{{ asset($img) }}" class="d-block w-100" style="height: 250px; object-fit: cover;" alt="Service Image">
                          </div>
                        @endif
                      @endforeach
                    </div>

                    @if(count($service->image) > 1)
                      <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $loop->iteration }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $loop->iteration }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    @endif
                  </div>


                @elseif (is_array($service->image) && !empty($service->image[0]))
                  <img src="{{ asset($service->image[0]) }}" class="img-fluid" style="width: 100%; height: 300px; object-fit: cover;" alt="{{ $service->nama }}">

                @elseif (is_string($service->image) && !empty($service->image))
                  <img src="{{ asset($service->image) }}" class="img-fluid" style="width: 100%; height: 300px; object-fit: cover;" alt="{{ $service->nama }}">

                @else
                  <img src="{{ asset('default-image.jpg') }}" class="img-fluid" style="width: 100%; height: 300px; object-fit: cover;" alt="Default Image">
                @endif
            </div>


              <div class="details position-relative " style="margin-top: -35px;">
                <div class="icon">
                  <i class="{{ $service->icon }}"></i>
                </div>
                <a href="#" class="stretched-link">
                  <h3>{{ $service->nama }}</h3>
                </a>
                <p>{{ \Illuminate\Support\Str::words(strip_tags($service->deskripsi), 35, '...') }}</p>
              </div>

            </div>
          </div>
        @endforeach

        <!-- End Service Item -->

        {{-- <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
          <div class="service-item">
            <div class="img">
              <img src="home/assets/img/services-2.jpg" class="img-fluid" alt="">
            </div>
            <div class="details position-relative">
              <div class="icon">
                <i class="bi bi-broadcast"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Eosle Commodi</h3>
              </a>
              <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
            </div>
          </div>
        </div><!-- End Service Item -->

        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
          <div class="service-item">
            <div class="img">
              <img src="home/assets/img/services-3.jpg" class="img-fluid" alt="">
            </div>
            <div class="details position-relative">
              <div class="icon">
                <i class="bi bi-easel"></i>
              </div>
              <a href="service-details.html" class="stretched-link">
                <h3>Ledo Markt</h3>
              </a>
              <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
            </div>
          </div>
        </div><!-- End Service Item --> --}}

      </div>

    </div>

  </section><!-- /Services Section -->