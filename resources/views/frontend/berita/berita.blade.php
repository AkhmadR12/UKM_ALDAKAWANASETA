<!-- Berita Terkini -->
{{-- @if($beritaTerkini->count() > 0)
<div class="berita-terkini mb-5">
    <h2 class="section-title">Berita Terkini</h2>
    <div class="row">
        @foreach($beritaTerkini as $berita)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($berita->gambar1)
                <img src="{{ asset($berita->gambar1) }}" class="card-img-top" alt="{{ $berita->judul }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $berita->judul }}</h5>
                    <p class="card-text">{{ Str::limit($berita->deskripsi, 100) }}</p>
                 </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif --}}

<!-- Berita Update -->
{{-- @if($beritaUpdate->count() > 0)
<div class="berita-update mb-5">
    <h2 class="section-title">Berita Update</h2>
    <div class="row">
        @foreach($beritaUpdate as $berita)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($berita->gambar1)
                <img src="{{ asset($berita->gambar1) }}" class="card-img-top" alt="{{ $berita->judul }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $berita->judul }}</h5>
                    <p class="card-text">{{ Str::limit($berita->deskripsi, 100) }}</p>
                 </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif --}}

<!-- Semua Berita -->
{{-- <div class="semua-berita">
    <h2 class="section-title">Semua Berita</h2>
    <div class="row">
        @foreach($semuaBerita as $berita)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($berita->gambar1)
                <img src="{{ asset($berita->gambar1) }}" class="card-img-top" alt="{{ $berita->judul }}">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $berita->judul }}</h5>
                    <p class="card-text">{{ Str::limit($berita->deskripsi, 100) }}</p>
                    <a href="{{ route('detail.berita', $berita->id) }}" class="btn btn-primary">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    {{ $semuaBerita->links() }}
</div> --}}
<div class="berita-catalog-container">
    <div class="container section-title" data-aos="fade-up" style="text-align: center">
        <p>BERITA</p>
        <h2></h2>
        </div>
    <div class="berita-grid">
        @foreach ($beritas as $berita)
        <div class="berita-card">
            <div class="berita-image-container">
                @if($berita->gambar1)
                <a href="{{ route('detail.berita', $berita->id) }}">
                    <img src="{{ asset($berita->gambar1) }}" class="berita-img" alt="{{ $berita->judul }}">
                </a>
                @endif
                <div class="berita-actions">
                    <a href="{{ route('detail.berita', $berita->id) }}" class="btn-view-detail" title="Baca Selengkapnya">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>
            {{-- <div class="berita-info">
                <h3 class="berita-title">
                    <a href="{{ route('detail.berita', $berita->id) }}">{{ $berita->judul }}</a>
                </h3>
                
                @if(isset($berita->tanggal))
                <p class="berita-date">
                    <i class="fas fa-calendar-alt"></i> 
                    {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}
                </p>
                @endif            
                
                <a href="{{ route('detail.berita', $berita->id) }}" class="btn-read-more">
                    <i class="fas fa-book-open"></i> Baca Selengkapnya
                </a>
            </div> --}}
        </div>
        @endforeach
    </div>
</div>