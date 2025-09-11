<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.css')
    <style>
        .berita-main-image img,
        .additional-image img {
            max-width: 70%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .additional-content {
            margin-top: 30px;
        }

        .berita-detail-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            background: #f8f9fa;
            min-height: 100vh;
        }

        .berita-header {
            position: relative;
            height: 60px;
            margin-bottom: 20px;
        }

        .berita-labels {
            position: absolute;
            top: 80px;
            right: 0;
            display: flex;
            gap: 10px;
            z-index: 10;
        }
        .berita-logos {
            position: absolute;
            top: 90px;
            left: 15px;
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .berita-logo {
            height: 60px; /* Sesuaikan dengan tinggi yang diinginkan */
            width: auto;
        }

        /* .label-ribbon {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 8px 12px;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            line-height: 1.2;
            position: relative;
            min-width: 70px;
            clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%);
        } */
         
        .label-ribbon {
            color: white;
            padding: 22px 16px;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            line-height: 1.2;
            position: relative;
            min-width: 90px;
            clip-path: polygon(0 0, 100% 0, 100% 75%, 50% 100%, 0 75%);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .label-terbaru {
            background: linear-gradient(to bottom, #007bff, #00c6ff);
        }

        .label-terkini {
            background: linear-gradient(to bottom, #00e3ff, #004f69);
        }
        /* .label-terkini {
            background: linear-gradient(135deg, #17a2b8, #138496);
        }

        .label-terbaru {
            background: linear-gradient(135deg, #007bff, #0056b3);
        } */

        .berita-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .berita-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            color: #333;
            margin-top: 60px;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .title-divider {
            width: 200px;
            height: 4px;
            margin: 0 auto 25px auto;
            background: linear-gradient(to right,
                #8AC4FB 4%,
                #0084FF 31%,
                #00488B 62%,
                #001499 100%);
            border-radius: 2px;
        }


        .berita-meta {
            text-align: center;
            margin-bottom: 15px;
        }

        .meta-item {
            display: inline-block;
            margin: 0 15px;
            font-size: 14px;
            color: #666;
        }

        .meta-label {
            font-weight: normal;
            color: #999;
        }

        .meta-value {
            color: #007bff;
            font-weight: 500;
            text-decoration: underline;
        }
        .meta-value a {
            color: #007bff;
            text-decoration: underline;
        }
        .meta-value a:hover {
            color: #0056b3;
        }

        .berita-datetime {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-bottom: 30px;
        }

        .berita-main-image {
            text-align: center;
            margin-bottom: 10px;
        }

        .main-image {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .berita-description-section {
            margin-top: 5px;
            max-width: 850px;
            margin-left: auto;
            margin-right: auto;
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            position: relative;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 150px;
            height: 2px;
            background: #333;
            margin: 10px auto 0;
        }

        .description-content {
            margin-bottom: 10px;
        }

        .description-content p {
            font-size: 16px;
            line-height: 1.8;
            color: #444;
            text-align: justify;
            margin-bottom: 10px;
            /* text-align: center; */
             
        }

        .additional-content {
            margin-bottom: 30px;
        }

        .additional-image {
            text-align: center;
            margin-bottom: 20px;
        }

        .content-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .additional-description p {
            font-size: 16px;
            line-height: 1.8;
            color: #444;
            text-align: justify;
            margin-bottom: 15px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .berita-detail-container {
                padding: 15px;
            }
            
            .berita-content {
                padding: 20px;
            }
            
            .berita-title {
                font-size: 1.8rem;
            }
            
            .label-ribbon {
                font-size: 9px;
                padding: 6px 10px;
                min-width: 60px;
            }
            
            .berita-labels {
                gap: 5px;
            }
            .berita-logo {
                height: 40px; /* Ukuran lebih kecil untuk mobile */
            }
            
            .meta-item {
                display: block;
                margin: 5px 0;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .berita-title {
                font-size: 1.5rem;
            }
            
            .title-divider {
                width: 150px;
            }
            
            .section-title::after {
                width: 100px;
            }
            .berita-logo {
                height: 30px;
            }
        }
    </style>
</head>

<body>

   

    <!-- Navbar & Hero End -->

    <!-- Modal Search Start -->
    @include('frontend.layout.header')
    <!-- Modal Search End -->
    <main class="main">
        <div class="berita-detail-container">
            <!-- Header dengan Label -->
            {{-- <div class="berita-header">
                <!-- Label Berita Terkini/Terbaru - Posisi di kanan atas -->
                <div class="berita-labels">
                    @if($berita->is_terkini == 1)
                        <div class="label-ribbon label-terbaru">
                            <span>BERITA<br>TERBARU</span>
                        </div>
                    @endif
                    @if($berita->is_update == 1)
                        <div class="label-ribbon label-terkini">
                            <span>BERITA<br>TERKINI</span>
                        </div>
                    @endif
                </div>
            </div> --}}
            <div class="berita-header">
                <!-- Logo di sebelah kiri -->
                <div class="berita-logos">
                    @if($berita->is_mata == 1)
                        <img src="{{ asset('logo/mata.png') }}" class="berita-logo" alt="Mata">
                    @endif
                    @if($berita->is_logo == 1)
                        <img src="{{ asset('logo/logo.png') }}" class="berita-logo" alt="Logo">
                    @endif
                </div>
                
                <!-- Label Berita Terkini/Terbaru - Posisi di kanan atas -->
                <div class="berita-labels">
                    @if($berita->is_terkini == 1)
                        <div class="label-ribbon label-terbaru">
                            <span>BERITA<br>TERBARU</span>
                        </div>
                    @endif
                    @if($berita->is_update == 1)
                        <div class="label-ribbon label-terkini">
                            <span>BERITA<br>TERKINI</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Konten Utama -->
            <div class="berita-content">
                <!-- Judul -->
                <h1 class="berita-title">{{ $berita->judul }}</h1>
                
                <!-- Divider -->
                <div class="title-divider"></div>
                
                <!-- Info Metadata -->
                <div class="berita-meta">
                    <div class="meta-item">
                        <span class="meta-label">Foto:</span>
                        <span class="meta-value">
                            @if($berita->editor_link)
                                <a href="{{ $berita->editor_link }}" target="_blank" rel="noopener noreferrer">
                                    {{ $berita->editor_nama ?? 'FOTO' }}
                                </a>
                            @else
                                {{ $berita->editor_nama ?? 'FOTO' }}
                            @endif
                        </span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">Deskripsi:</span>
                        <span class="meta-value">
                            @if($berita->dokumentasi_link)
                                <a href="{{ $berita->dokumentasi_link }}" target="_blank" rel="noopener noreferrer">
                                    {{ $berita->dokumentasi_nama ?? 'EDITOR' }}
                                </a>
                            @else
                                {{ $berita->dokumentasi_nama ?? 'EDITOR' }}
                            @endif
                        </span>
                    </div>
                </div>
                
                <!-- Tanggal dan Waktu -->
                <div class="berita-datetime">
                    @if($berita->tanggal && $berita->jam)
                        {{ \Carbon\Carbon::parse($berita->tanggal)->isoFormat('dddd, DD MMM YYYY') }} | {{ $berita->jam }} WIB
                    @else
                        {{ \Carbon\Carbon::parse($berita->created_at)->isoFormat('dddd, DD MMM YYYY') }} | {{ \Carbon\Carbon::parse($berita->created_at)->format('H:i') }} WIB
                    @endif
                </div>
                
                <!-- Gambar Utama -->
                @if ($berita->gambar1)
                    <div class="berita-main-image">
                        <img src="{{ asset($berita->gambar1) }}" class="main-image" alt="{{ $berita->judul }}">
                    </div>
                @endif

                <!-- Konten Deskripsi -->
                <div class="berita-description-section">
                    {{-- <h2 class="section-title">DESKRIPSI</h2> --}}

                    <!-- Deskripsi Utama -->
                    @if ($berita->deskripsi)
                        <div class="description-content">
                            <p class="text-center mb-3">{!! nl2br(e($berita->deskripsi)) !!}</p>
                        </div>
                    @endif

                    <!-- Gambar dan Deskripsi Tambahan -->
                    @foreach (range(2, 5) as $i)
                        @php
                            $gambar = $berita["gambar$i"];
                            $deskripsi = $berita["deskripsi$i"];
                        @endphp

                        @if ($gambar || $deskripsi)
                            <div class="additional-content">
                                @if ($gambar)
                                    <div class="additional-image">
                                        <img src="{{ asset($gambar) }}" class="content-image" alt="Gambar {{ $i }}">
                                    </div>
                                @endif

                                @if ($deskripsi)
                                    <div class="additional-description">
                                        <p>{!! nl2br(e($deskripsi)) !!}</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>

            </div>
        </div>
    </main>  

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
    
</body>

</html>
