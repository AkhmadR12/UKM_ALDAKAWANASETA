<!-- Berita Terkini -->
@if($beritaTerkini->count() > 0)
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
                    {{-- <a href="{{ route('detail.berita', $berita->id) }}" class="btn btn-primary">Baca Selengkapnya</a> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Berita Update -->
@if($beritaUpdate->count() > 0)
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
                    {{-- <a href="{{ route('detail.berita', $berita->id) }}" class="btn btn-primary">Baca Selengkapnya</a> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Semua Berita -->
<div class="semua-berita">
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
                    {{-- <a href="{{ route('detail.berita', $berita->id) }}" class="btn btn-primary">Baca Selengkapnya</a> --}}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    {{ $semuaBerita->links() }}
</div>