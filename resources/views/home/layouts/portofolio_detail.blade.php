<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.css')
</head>

<body>

   

    <!-- Navbar & Hero End -->

    <!-- Modal Search Start -->
    @include('frontend.layout.header')
    <!-- Modal Search End -->
    <main class="main">
    <!-- feature Start -->
    <div class="container py-5">
        <!-- Judul -->
        <h1 class="text-center mb-4">{{ $portofolio->judul }}</h1>
        
        <!-- Foto dan Deskripsi -->
        <div class="text-center mb-3">
            <span class="text-muted">Foto: {{ $portofolio->foto_oleh ?? 'DOSS' }}</span>
        </div>
        
        @if($portofolio->deskripsi_singkat)
        <div class="text-center mb-4">
            <p class="fw-bold">{{ $portofolio->deskripsi_singkat }}</p>
        </div>
        @endif
        
        <!-- Tanggal Publikasi -->
        <div class="text-center mb-4">
            <span class="text-muted">{{ \Carbon\Carbon::parse($portofolio->created_at)->isoFormat('dddd, DD MMM YYYY') }} | {{ \Carbon\Carbon::parse($portofolio->created_at)->format('H:i') }} WIB</span>
        </div>
        
        <!-- Label Berita Terkini/Terbaru -->
        <div class="d-flex justify-content-center gap-3 mb-4">
            @if($portofolio->is_terkini == 1)
                <span class="badge bg-primary">BERITA TERKINI</span>
            @endif
            @if($portofolio->is_terupdate == 1)
                <span class="badge bg-success">BERITA TERBARU</span>
            @endif
        </div>
        
        <!-- Gambar Utama -->
        @if ($portofolio->gambar)
            <div class="text-center mb-4">
                <img src="{{ asset($portofolio->gambar) }}" class="img-fluid rounded" alt="Gambar Utama">
            </div>
        @endif
        
        <!-- Deskripsi Utama -->
        @if ($portofolio->deskripsi)
            <div class="mb-4">
                <p class="text-justify">{!! nl2br(e($portofolio->deskripsi)) !!}</p>
            </div>
        @endif
        
        <!-- Gambar dan deskripsi tambahan -->
        @foreach (range(2, 4) as $i)
            @php
                $gambar = $portofolio["gambar$i"];
                $deskripsi = $portofolio["deskripsi$i"];
            @endphp
            @if ($gambar || $deskripsi)
                <div class="mb-4">
                    @if ($gambar)
                        <img src="{{ asset($gambar) }}" class="img-fluid rounded mb-2" alt="Gambar {{ $i }}">
                    @endif
                    @if ($deskripsi)
                        <p class="text-justify">{!! nl2br(e($deskripsi)) !!}</p>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
    <!-- Service End -->
</main>   

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
    
</body>

</html>
