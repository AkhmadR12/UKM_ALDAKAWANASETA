<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Bundle JS (sudah termasuk Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    @include('frontend.layout.css')
    <style>
        .locked-page {
            display: flex !important;
            justify-content: center !important;
            align-items: center !important;
            flex-direction: column !important;
            background: #f8f9fa !important;
            border: 2px dashed #6c757d !important;
            text-align: center !important;
            padding: 20px !important;
            min-height: 400px !important;
        }

        .locked-page i.fas.fa-lock {
            font-size: 48px;
            color: #6c757d;
            margin-bottom: 20px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .locked-page h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #495057;
        }

        .locked-page p {
            font-size: 16px;
            margin-bottom: 20px;
            color: #6c757d;
            max-width: 300px;
        }

        .locked-page a {
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
            margin: 5px;
        }

        .locked-page a:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .locked-page a[href*="login"] {
            background: #28a745;
            color: #fff;
        }

        .locked-page a[href*="login"]:hover {
            background: #218838;
        }

        .locked-page a[href*="register-payment"] {
            background: #007bff;
            color: #fff;
        }

        .locked-page a[href*="register-payment"]:hover {
            background: #0056b3;
        }

        /* Responsive design untuk halaman terkunci */
        @media (max-width: 768px) {
            .locked-page {
                padding: 15px !important;
                min-height: 300px !important;
            }
            
            .locked-page i.fas.fa-lock {
                font-size: 36px;
                margin-bottom: 15px;
            }
            
            .locked-page h3 {
                font-size: 20px;
            }
            
            .locked-page p {
                font-size: 14px;
            }
            
            .locked-page a {
                padding: 10px 20px;
                font-size: 14px;
            }
        }
        .item-type-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 2;
        }

        .badge-product {
            background: #28a745;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-photo {
            background: #007bff;
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
         body.modal-open {
            overflow: hidden;
        }

        .nav-item {
            position: relative;
        }
        .badge {
            font-size: 0.7rem;
        }
    </style>

</head>
<body>

   

    <!-- Navbar & Hero End -->

    <!-- Modal Search Start -->
    @include('frontend.layout.header')
    <!-- Modal Search End -->
    <main class="main">
    
    <br>
    <br>
    <br>
  
    <div class="cards-container">
        <div class="container section-title" data-aos="fade-up" style="text-align: center">
        <p>MAJALAH</p>
        <h2></h2>
        </div>
        {{-- <h1 class="text-center mb-3">Majalah</h1> --}}

        <div class="cards-list @if(count($megazines) > 8) limited @endif">
            @foreach ($megazines as $item)
                @if($loop->index < 8)
                    <div class="card">
                        {{-- <a href="#modal-{{ $item->id }}" class="open-magazine-btn"> --}}
                        <a href="{{ route('majalah.track-click', ['id' => $item->id, 'source' => 'majalah']) }}" class="open-magazine-btn">
                        {{-- <a href="{{ route('majalah.show', $item->id) }}" class="open-magazine-btn"> --}}
                        {{-- <a href="{{ route('majalah.show', $item->id) }}" class="btn btn-primary w-100"> --}}
                            <div class="card_image">
                                 <img src="{{  ($item->cover_image) }}" alt="{{ $item->title }}" style=" object-fit: cover;">
                            </div>
                        </a>
                        {{-- <a href="{{ route('majalah.show', $item->id) }}" class="btn btn-primary w-100">
                            <i class="fas fa-book-open me-1"></i> Baca Majalah
                        </a> --}}
                    </div>
                @endif
            @endforeach
        </div>

        @if(count($megazines) > 8)
            <div class="view-more">
                <a href="{{ route('majalah.index') }}">Lihat Semua Majalah</a>
            </div>
        @endif
         
    </div>

    @foreach ($megazines as $item)
        @if($loop->index < 8)
            <div id="modal-{{ $item->id }}" class="modal">
                    <div class="flipbook-container">
                        <div class="magazine" id="magazine-{{ $item->id }}">
                            <div class="hard">
                               <img src="{{  ($item->cover_image) }}" alt="{{ $item->title }}" style="width: %; height: 100%; object-fit: cover;">
                            </div>
                            
                            @php
                                $pages = $item->pages;
                                usort($pages, function($a, $b) {
                                    preg_match('/page_(\d+)\.jpg/', $a, $matchesA);
                                    preg_match('/page_(\d+)\.jpg/', $b, $matchesB);
                                    $pageNumA = isset($matchesA[1]) ? (int)$matchesA[1] : 0;
                                    $pageNumB = isset($matchesB[1]) ? (int)$matchesB[1] : 0;
                                    return $pageNumA - $pageNumB;
                                });
                                
                                $startIndex = 0;
                                if (count($pages) > 0 && strpos($pages[0], 'page_1.jpg') !== false) {
                                    $startIndex = 1;
                                }
                            @endphp
                            
                            {{-- @for ($i = $startIndex; $i < count($pages); $i++)
                                <div class="page" style="margin: 0; padding: 0;">
                                    <img src="{{  ($pages[$i]) }}" class="magazine-page-image" alt="Halaman {{ $i+1 }}" style="margin: 0; padding: 0;">
                                    <div class="page-number">Halaman {{ $i+1 }}</div>
                                </div>
                            @endfor --}}
                            @for ($i = $startIndex; $i < count($pages); $i++)
                                <div class="page" style="margin: 0; padding: 0;">
                                    <img src="{{ $pages[$i] }}" class="magazine-page-image" alt="Halaman {{ $i+1 }}" style="margin: 0; padding: 0;">
                                    <div class="page-number">Halaman {{ $i+1 }}</div>
                                </div>
                            @endfor

                            @if($item->is_locked)
                                <div class="page locked-page" style="margin: 0; padding: 0; background: white; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                                    <div style="position: relative; width: 100%; height: 100%;">
                                        <!-- Efek blur overlay -->
                                        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); backdrop-filter: blur(5px); z-index: 1;"></div>
                                        
                                        <!-- Konten pesan -->
                                        <div style="position: relative; z-index: 2; padding: 20px; max-width: 80%;">
                                            <h3 style="color: #333; margin-bottom: 20px;">Untuk membaca lebih lengkap</h3>
                                            <p style="color: #555; margin-bottom: 30px;">Silahkan daftar sebagai member premium untuk mengakses semua {{ $item->total_pages }} halaman konten eksklusif.</p>
                                            
                                            @if(Auth::check())
                                                <a href="{{ route('member.register-payment') }}" class="btn btn-primary" style="padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
                                                    Upgrade ke Member Premium
                                                </a>
                                            @else
                                                <a href="{{ route('member.register-payment') }}" class="btn btn-primary" style="padding: 10px 20px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
                                                    Daftar Member
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="hard">
                                <div class="back-cover-content">
                                    <p>{{ date('Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="magazine-controls">
                        <button class="prev-btn" title="Halaman Sebelumnya"><i class="fas fa-chevron-left"></i></button>
                        <button class="next-btn" title="Halaman Berikutnya"><i class="fas fa-chevron-right"></i></button>
                        <button class="zoom-in-btn" title="Perbesar"><i class="fas fa-search-plus"></i></button>
                        <button class="zoom-out-btn" title="Perkecil"><i class="fas fa-search-minus"></i></button>
                        <button class="fullscreen-btn" title="Layar Penuh"><i class="fas fa-expand"></i></button>
                    </div>
                    <a href="#" class="modal__close">&times;</a>
            </div>
        @endif
    @endforeach

    </main>
    @include('frontend.layout.footer')
    <!-- Footer End -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.1/turn.min.js"></script> --}}
    {{-- @include('frontend.layout.js') --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
                
                $(document).ready(function() {
                    $('#flipbook').turn({
                        width: 800,
                        height: 600,
                        autoCenter: true
                    });
                });
                // === MODAL CONTROL ===
                const modal = $('#magazineModal');
                const btn = $('#open-magazine-btn');
                const span = $('.close-btn');

                btn.on('click', function () {
                    modal.fadeIn();
                });

                span.on('click', function () {
                    modal.fadeOut();
                });

                $(window).on('click', function (event) {
                    if ($(event.target).is(modal)) {
                        modal.fadeOut();
                    }
                });

                // === FLIPBOOK CONTROL ===
            

    
                // Inisialisasi untuk setiap modal
                $('.modal').each(function() {
                    const modal = $(this);
                    const modalId = modal.attr('id');
                    const magazineId = '#magazine-' + modalId.split('-')[1];
                    
                    // Inisialisasi flipbook saat modal dibuka
                    $('a[href="#' + modalId + '"]').on('click', function() {
                        // Tunggu hingga modal benar-benar terbuka
                        setTimeout(function() {
                            initFlipbook(magazineId);
                        }, 300);
                    });
                    
                    // Tutup modal
                    modal.find('.modal__close').on('click', function() {
                        modal.fadeOut();
                        // Destroy flipbook untuk menghemat memori
                        $(magazineId).turn('destroy');
                    });
                });
                
                // Fungsi inisialisasi flipbook
                function initFlipbook(magazineId) {
                    let zoomLevel = 1;
                    const zoomStep = 0.1;
                    const minZoom = 0.5;
                    const maxZoom = 1.5;
                    let isFullscreen = false;
                    
                    // Inisialisasi turn.js
                    $(magazineId).turn({
                        width: 1200,
                        height: 720,
                        autoCenter: true,
                        gradients: true,
                        acceleration: true,
                        elevation: 50,
                        display: getDisplayMode(),
                        duration: 1000,
                        page: 1,
                        when: {
                            turning: function(e, page, view) {
                                if (page == 1) {
                                    $(this).turn('peel', 'br');
                                }
                            },
                            turned: function(e, page, view) {
                                setTimeout(adjustImageSizes, 100);
                            }
                        }
                    });
                    
                    // Kontrol navigasi
                    $(magazineId).closest('.modal').find('.prev-btn').click(function() {
                        $(magazineId).turn('previous');
                    });
                    
                    $(magazineId).closest('.modal').find('.next-btn').click(function() {
                        $(magazineId).turn('next');
                    });
                    
                    // Zoom kontrol
                    $(magazineId).closest('.modal').find('.zoom-in-btn').click(function() {
                        if (zoomLevel < maxZoom) {
                            zoomLevel += zoomStep;
                            updateZoom();
                        }
                    });
                    
                    $(magazineId).closest('.modal').find('.zoom-out-btn').click(function() {
                        if (zoomLevel > minZoom) {
                            zoomLevel -= zoomStep;
                            updateZoom();
                        }
                    });
                    
                    // Fullscreen kontrol
                    $(magazineId).closest('.modal').find('.fullscreen-btn').click(toggleFullscreen);
                    
                    // Fungsi pembantu
                    function getDisplayMode() {
                        return window.innerWidth < 768 ? 'single' : 'double';
                    }
                    
                    function updateZoom() {
                        $(magazineId).css({
                            transform: `scale(${zoomLevel})`,
                            transformOrigin: 'center center'
                        });
                    }
                    
                    function toggleFullscreen() {
                        const elem = document.documentElement;
                        
                        if (!isFullscreen) {
                            if (elem.requestFullscreen) elem.requestFullscreen();
                            else if (elem.webkitRequestFullscreen) elem.webkitRequestFullscreen();
                            else if (elem.msRequestFullscreen) elem.msRequestFullscreen();
                            
                            isFullscreen = true;
                            $(magazineId).closest('.modal').find('.fullscreen-btn i')
                                .removeClass('fa-expand').addClass('fa-compress');
                        } else {
                            if (document.exitFullscreen) document.exitFullscreen();
                            else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
                            else if (document.msExitFullscreen) document.msExitFullscreen();
                            
                            isFullscreen = false;
                            $(magazineId).closest('.modal').find('.fullscreen-btn i')
                                .removeClass('fa-compress').addClass('fa-expand');
                        }
                    }
                    
                    function adjustImageSizes() {
                        $(magazineId).find('.magazine-page-image').each(function() {
                            const page = $(this).closest('.page, .hard');
                            const pageWidth = page.width();
                            const pageHeight = page.height();
                            const imgRatio = this.naturalWidth / this.naturalHeight;
                            const pageRatio = pageWidth / pageHeight;
                            
                            if (window.innerWidth < 768) {
                                $(this).css({
                                    'width': '85%',
                                    'height': 'auto',
                                    'max-height': '80%',
                                    'margin': '0 auto'
                                });
                            } else {
                                if (imgRatio > pageRatio) {
                                    $(this).css({
                                        'width': '100%',
                                        'height': 'auto',
                                        'max-height': '100%'
                                    });
                                } else {
                                    $(this).css({
                                        'width': 'auto',
                                        'height': '100%',
                                        'max-width': '100%'
                                    });
                                }
                            }
                        });
                    }
                    
                    // Handle resize
                    $(window).on('resize', function() {
                        const currentPage = $(magazineId).turn('page');
                        const displayMode = getDisplayMode();
                        
                        $(magazineId).turn('size', calculateFlipbookSize().width, calculateFlipbookSize().height)
                            .turn('display', displayMode)
                            .turn('page', currentPage);
                            
                        zoomLevel = 1;
                        updateZoom();
                        
                        setTimeout(adjustImageSizes, 100);
                    });
                    
                    function calculateFlipbookSize() {
                        const width = $(window).width();
                        let flipbookWidth, flipbookHeight;
                        
                        if (width <= 576) {
                            flipbookWidth = width * 0.9;
                            flipbookHeight = flipbookWidth * 1.3;
                        } else if (width <= 768) {
                            flipbookWidth = 500;
                            flipbookHeight = 350;
                        } else if (width <= 992) {
                            flipbookWidth = 700;
                            flipbookHeight = 400;
                        } else if (width <= 1280) {
                            flipbookWidth = 900;
                            flipbookHeight = 510;
                        } else {
                            flipbookWidth = 1000;
                            flipbookHeight = 600;
                        }
                        
                        return { width: flipbookWidth, height: flipbookHeight };
                    }
                    
                    // Keyboard navigation
                    $(document).keydown(function(e) {
                        if ($('.modal:visible').length > 0) {
                            switch (e.keyCode) {
                                case 37: // left arrow
                                    $(magazineId).turn('previous');
                                    e.preventDefault();
                                    break;
                                case 39: // right arrow
                                    $(magazineId).turn('next');
                                    e.preventDefault();
                                    break;
                                case 27: // ESC
                                    $('.modal:visible').fadeOut();
                                    $(magazineId).turn('destroy');
                                    break;
                            }
                        }
                    });
                    
                    // Initial adjustment
                    setTimeout(function() {
                        adjustImageSizes();
                        $(magazineId).turn('size', calculateFlipbookSize().width, calculateFlipbookSize().height);
                    }, 500);
                }
            });

           
        
    </script> --}}
    @include('frontend.layout.js')
    {{-- @vite(['resources/js/app.js']) --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(function () {
                function closePopup() {
                    document.getElementById('popupOverlay').classList.remove('show');
                    sessionStorage.setItem('popupShown', 'true');
                }       

                // ebook
                let initializedFlipbooks = {};
                 function destroyFlipbook(magazineId) {
                    if ($(magazineId).data('turnInit')) {
                        try {
                            $(magazineId).turn('destroy');
                        } catch (e) {
                            console.log('Error destroying flipbook:', e);
                        }
                        $(magazineId).removeData('turnInit');
                        $(magazineId).removeAttr('style');
                        $(magazineId).find('.page').removeAttr('style');
                        
                        // Reset initializedFlipbooks
                        delete initializedFlipbooks[magazineId];
                    }
                }

                $(document).ready(function() {
                    $('#flipbook').turn({
                        width: 800,
                        height: 600,
                        autoCenter: true
                    });
                });
                // === MODAL CONTROL ===
                const modal = $('#magazineModal');
                const btn = $('#open-magazine-btn');
                const span = $('.close-btn');
                btn.on('click', function () {
                    modal.fadeIn();
                });
                span.on('click', function () {
                    modal.fadeOut();
                });
                $(window).on('click', function (event) {
                    if ($(event.target).is(modal)) {
                        modal.fadeOut();
                    }
                });
                // === FLIPBOOK CONTROL ===
                // Inisialisasi untuk setiap modal
                $('.modal').each(function() {
                    const modal = $(this);
                    const modalId = modal.attr('id');
                    const magazineId = '#magazine-' + modalId.split('-')[1];
                    
                    // Inisialisasi flipbook saat modal dibuka
                    $('a[href="#' + modalId + '"]').on('click', function() {
                        // Tunggu hingga modal benar-benar terbuka
                        setTimeout(function() {
                            initFlipbook(magazineId);
                        }, 300);
                    });
                    
                    // Tutup modal
                    modal.find('.modal__close').on('click', function() {
                        modal.fadeOut();
                        // Destroy flipbook untuk menghemat memori
                        // $(magazineId).turn('destroy');
                    });
                });               
                // Fungsi inisialisasi flipbook
                function initFlipbook(magazineId) {
                    let zoomLevel = 1;
                    const zoomStep = 0.1;
                    const minZoom = 0.5;
                    const maxZoom = 1.5;
                    let isFullscreen = false;
                    
                    // Inisialisasi turn.js
                    $(magazineId).turn({
                        width: 1200,
                        height: 720,
                        autoCenter: true,
                        gradients: true,
                        acceleration: true,
                        elevation: 50,
                        display: getDisplayMode(),
                        duration: 1000,
                        page: 1,
                        when: {
                            turning: function(e, page, view) {
                                if (page == 1) {
                                    $(this).turn('peel', 'br');
                                }
                            },
                            turned: function(e, page, view) {
                                setTimeout(adjustImageSizes, 100);
                            }
                        }
                    });
                    
                    // Kontrol navigasi
                    $(magazineId).closest('.modal').find('.prev-btn').click(function() {
                        $(magazineId).turn('previous');
                    });
                    
                    $(magazineId).closest('.modal').find('.next-btn').click(function() {
                        $(magazineId).turn('next');
                    });
                    
                    // Zoom kontrol
                    $(magazineId).closest('.modal').find('.zoom-in-btn').click(function() {
                        if (zoomLevel < maxZoom) {
                            zoomLevel += zoomStep;
                            updateZoom();
                        }
                    });
                    
                    $(magazineId).closest('.modal').find('.zoom-out-btn').click(function() {
                        if (zoomLevel > minZoom) {
                            zoomLevel -= zoomStep;
                            updateZoom();
                        }
                    });
                    
                    // Fullscreen kontrol
                    $(magazineId).closest('.modal').find('.fullscreen-btn').click(toggleFullscreen);
                    
                    // Fungsi pembantu
                    function getDisplayMode() {
                        return window.innerWidth < 768 ? 'single' : 'double';
                    }
                    
                    function updateZoom() {
                        $(magazineId).css({
                            transform: `scale(${zoomLevel})`,
                            transformOrigin: 'center center'
                        });
                    }
                    
                    function toggleFullscreen() {
                        const elem = document.documentElement;
                        
                        if (!isFullscreen) {
                            if (elem.requestFullscreen) elem.requestFullscreen();
                            else if (elem.webkitRequestFullscreen) elem.webkitRequestFullscreen();
                            else if (elem.msRequestFullscreen) elem.msRequestFullscreen();
                            
                            isFullscreen = true;
                            $(magazineId).closest('.modal').find('.fullscreen-btn i')
                                .removeClass('fa-expand').addClass('fa-compress');
                        } else {
                            if (document.exitFullscreen) document.exitFullscreen();
                            else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
                            else if (document.msExitFullscreen) document.msExitFullscreen();
                            
                            isFullscreen = false;
                            $(magazineId).closest('.modal').find('.fullscreen-btn i')
                                .removeClass('fa-compress').addClass('fa-expand');
                        }
                    }
                    
                    // function adjustImageSizes() {
                    //     $(magazineId).find('.magazine-page-image').each(function() {
                    //         const page = $(this).closest('.page, .hard');
                    //         const pageWidth = page.width();
                    //         const pageHeight = page.height();
                    //         const imgRatio = this.naturalWidth / this.naturalHeight;
                    //         const pageRatio = pageWidth / pageHeight;
                            
                    //         if (window.innerWidth < 768) {
                    //             $(this).css({
                    //                 'width': '85%',
                    //                 'height': 'auto',
                    //                 'max-height': '80%',
                    //                 'margin': '0 auto'
                    //             });
                    //         } else {
                    //             if (imgRatio > pageRatio) {
                    //                 $(this).css({
                    //                     'width': '100%',
                    //                     'height': 'auto',
                    //                     'max-height': '100%'
                    //                 });
                    //             } else {
                    //                 $(this).css({
                    //                     'width': 'auto',
                    //                     'height': '100%',
                    //                     'max-width': '100%'
                    //                 });
                    //             }
                    //         }
                    //     });
                    // }
                    function adjustImageSizes() {
                        $(magazineId).find('.magazine-page-image').each(function() {
                            const page = $(this).closest('.page, .hard');
                            const pageWidth = page.width();
                            const pageHeight = page.height();
                            const imgRatio = this.naturalWidth / this.naturalHeight;
                            const pageRatio = pageWidth / pageHeight;
                            
                            if (window.innerWidth < 768) {
                                $(this).css({
                                    'width': '100%', /* Ubah dari 85% ke 100% */
                                    'height': '100%', /* Ubah dari auto ke 100% */
                                    'max-height': '100%', /* Ubah dari 80% ke 100% */
                                    'margin': '0', /* Ubah dari '0 auto' ke '0' */
                                    'object-fit': 'cover'
                                });
                            } else {
                                $(this).css({
                                    'width': '100%',
                                    'height': '100%',
                                    'object-fit': 'cover',
                                    'margin': '0',
                                    'padding': '0'
                                });
                            }
                        });
                    }
                    
                    // Handle resize
                    $(window).on('resize', function() {
                        const currentPage = $(magazineId).turn('page');
                        const displayMode = getDisplayMode();
                        
                        $(magazineId).turn('size', calculateFlipbookSize().width, calculateFlipbookSize().height)
                            .turn('display', displayMode)
                            .turn('page', currentPage);
                            
                        zoomLevel = 1;
                        updateZoom();
                        
                        setTimeout(adjustImageSizes, 100);
                    });
                    
                    function calculateFlipbookSize() {
                        const width = $(window).width();
                        let flipbookWidth, flipbookHeight;
                        
                        if (width <= 576) {
                            flipbookWidth = width * 0.9;
                            flipbookHeight = flipbookWidth * 1.3;
                        } else if (width <= 768) {
                            flipbookWidth = 500;
                            flipbookHeight = 350;
                        } else if (width <= 992) {
                            flipbookWidth = 700;
                            flipbookHeight = 400;
                        } else if (width <= 1280) {
                            flipbookWidth = 900;
                            flipbookHeight = 510;
                        } else {
                            flipbookWidth = 1000;
                            flipbookHeight = 600;
                        }
                        
                        return { width: flipbookWidth, height: flipbookHeight };
                    }
                    
                    // Keyboard navigation
                    $(document).keydown(function(e) {
                        if ($('.modal:visible').length > 0) {
                            switch (e.keyCode) {
                                case 37: // left arrow
                                    $(magazineId).turn('previous');
                                    e.preventDefault();
                                    break;
                                case 39: // right arrow
                                    $(magazineId).turn('next');
                                    e.preventDefault();
                                    break;
                                case 27: // ESC
                                    $('.modal:visible').fadeOut();
                                    $(magazineId).turn('destroy');
                                    break;
                            }
                        }
                    });
                    
                    // Initial adjustment
                    setTimeout(function() {
                        adjustImageSizes();
                        $(magazineId).turn('size', calculateFlipbookSize().width, calculateFlipbookSize().height);
                    }, 500);
                }  
            });
        });
    </script> --}}
    {{-- @viteReactRefresh --}}
    
   
</body>

</html>