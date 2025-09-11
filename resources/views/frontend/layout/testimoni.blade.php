 <!-- Testimonials Section -->
<section id="testimonials" class="testimonials section" style="
    margin: 0;
    padding: 60px 0;
    background: 
        linear-gradient(135deg, rgba(99, 102, 241, 0.9) 0%, rgba(139, 92, 246, 0.9) 50%, rgba(217, 70, 239, 0.9) 100%),
        url('https://images.unsplash.com/photo-1516035069371-29a1b244cc32?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
    background-blend-mode: overlay;
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    position: relative;
    overflow: hidden;
">
 
    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="swiper init-swiper">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            }
          }
        </script>
        <div class="swiper-wrapper">
          @foreach($testimonis as $testimoni)
            <div class="swiper-slide">
              <div class="testimonial-item">
                <img src="{{ asset( $testimoni->gambar) }}" class="testimonial-img" alt="{{ $testimoni->nama }}">
                <h3>{{ $testimoni->nama }}</h3>
                <h4>{{ $testimoni->pekerjaan }}</h4>
                <div class="stars">
                  @for($i = 0; $i < $testimoni->rating; $i++)
                    <i class="bi bi-star-fill"></i>
                  @endfor
                </div>
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span style="color: #ffff">{{ $testimoni->deskripsi }}</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
              </div>
            </div>
          @endforeach
        </div>

          

         
        <div class="swiper-pagination"></div>
      </div>

    </div>

</section> 