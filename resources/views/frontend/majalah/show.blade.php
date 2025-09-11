<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $magazine->title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @include('frontend.layout.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            background-color: #f8f9fa;
        }
        
        .cards-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
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
        /* .flipbook-container {
            margin-top: 25px;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 110vh;
            width: 90vw;
            position: relative;
             
        } */

        /* .flipbook {
            width: 1200px;
            height: 720px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
            
        } */

        /* .flipbook .hard {
            background: #c03a2b23 !important;
            color: #fff;
            font-weight: bold;
            border: none;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 24px;
        } */

        /* .flipbook .hard small {
            font-style: italic;
            font-weight: lighter;
            opacity: 0.7;
            font-size: 14px;
            margin-top: 10px;
        } */

        /* .flipbook .page {
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 0;
            overflow: hidden;
            position: relative;
        } */

        .page img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            margin: 0;
            padding: 0;
            background: white;
        }
        
        .magazine-page-image {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .page-number {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: rgba(255, 255, 255, 0.7);
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 12px;
            z-index: 10;
        }
        
        .flipbook .page small {
            font-size: 14px;
            margin-bottom: 10px;
        }

        .back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 999;
        }
        
        /* Magazine controls */
        .magazine-controls {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 100;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 30px;
            padding: 10px 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            display: flex;
            gap: 20px;
        }
        
        .magazine-controls button {
            background: #c0392b;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 18px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: all 0.2s;
        }
        
        .magazine-controls button:hover {
            background: #e74c3c;
            transform: scale(1.1);
        }
        
        .page.zoomed {
            cursor: grab;
        }
        
        .page.zoomed:active {
            cursor: grabbing;
        }

        /* Locked page styles */
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
        
        /* Responsive styles */
        @media (max-width: 1280px) {
            .flipbook {
                margin-top: 0px;
                width: 900px;
                height: 510px;
            }
        }
        
        @media (max-width: 992px) {
            .flipbook {
                margin-top: 0px;
                width: 700px;
                height: 400px;
            }
        }
        
        @media (max-width: 768px) {
            .flipbook {
                top: -25%;
                width: 600px;
                height: 300px;
                margin-bottom: -40%; 
            }
            
            .magazine-controls {
                top: 530px;
                width: 300px;
                height: 7%;
                padding: 5px 15px;
            }
            
            .magazine-controls button {
                width: 30px;
                height: 30px;
                font-size: 14px;
            }
        }
        
        @media (max-width: 576px) {
            .flipbook {
                margin-top: 0px;
                width: 90vw;
                height: 60vw;
            }
            
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
    </style>
</head>
<body>
    {{-- <div class="back-button">
        <a href="{{ route('majalah.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar Majalah
        </a>
    </div> --}}
    @include('frontend.layout.header')
    <!-- Modal Search End -->
    <main class="main">
        <div class="flipbook-container">
            <div class="flipbook" id="magazine">
                <!-- Hard Cover - Front -->
                <div class="hard" style=" justify-content: center; align-items: center;">
                    <img src="{{ asset($magazine->cover_image) }}" alt="{{ $magazine->title }}" style="width: 100%; height: 100%; object-fit: cover; ">
                </div>
                        
                <!-- Content Pages -->
                @php
                    // Get pages from the magazine model
                    $pages = $magazine->pages;
                    
                    // Sort pages naturally by page number
                    usort($pages, function($a, $b) {
                        // Extract page numbers from filenames
                        preg_match('/page_(\d+)\.jpg/', $a, $matchesA);
                        preg_match('/page_(\d+)\.jpg/', $b, $matchesB);
                        
                        $pageNumA = isset($matchesA[1]) ? (int)$matchesA[1] : 0;
                        $pageNumB = isset($matchesB[1]) ? (int)$matchesB[1] : 0;
                        
                        return $pageNumA - $pageNumB;
                    });
                    
                    // Skip page 1 if it's the same as cover image
                    $startIndex = 0;
                    if (count($pages) > 0 && strpos($pages[0], 'page_1.jpg') !== false) {
                        $startIndex = 1;
                    }
                @endphp
                
                @for ($i = $startIndex; $i < count($pages); $i++)
                    <div class="page" style="margin: 0; padding: 0;">
                        <img src="{{ asset($pages[$i]) }}" class="magazine-page-image" alt="Halaman {{ $i+1 }}">
                        <div class="page-number">Halaman {{ $i+1 }}</div>
                    </div>
                @endfor
                
                @if($magazine->is_locked)
                    <div class="page locked-page" style="margin: 0; padding: 0; background: white; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;">
                        <div style="position: relative; width: 100%; height: 100%;">
                            <!-- Efek blur overlay -->
                            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); backdrop-filter: blur(5px); z-index: 1;"></div>
                            
                            <!-- Konten pesan -->
                            <div style="position: relative; z-index: 2; padding: 20px; max-width: 80%;">
                                <h3 style="color: #333; margin-bottom: 20px;">Untuk membaca lebih lengkap</h3>
                                <p style="color: #555; margin-bottom: 30px;">Silahkan daftar sebagai member premium untuk mengakses semua {{ $magazine->total_pages }} halaman konten eksklusif.</p>
                                
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
                
                <!-- Inside Back Cover -->
                {{-- <div class="hard"></div> --}}
                
                <!-- Hard Cover - Back -->
                <div class="hard">
                    <div style="width: 100%; height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center;">
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
    </main>
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
    @vite(['resources/js/app.js'])
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $(document).ready(function () {
                // Initialize variables
                let zoomLevel = 1;
                const zoomStep = 0.1;
                const minZoom = 0.5;
                const maxZoom = 1.5;
                let isFullscreen = false;
                
                // Initialize turn.js
                $("#magazine").turn({
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
                
                // Button controls
                $('.prev-btn').click(function() {
                    $('#magazine').turn('previous');
                });
                
                $('.next-btn').click(function() {
                    $('#magazine').turn('next');
                });
                
                // Zoom controls
                $('.zoom-in-btn').click(function() {
                    if (zoomLevel < maxZoom) {
                        zoomLevel += zoomStep;
                        updateZoom();
                    }
                });
                
                $('.zoom-out-btn').click(function() {
                    if (zoomLevel > minZoom) {
                        zoomLevel -= zoomStep;
                        updateZoom();
                    }
                });
                
                // Fullscreen control
                $('.fullscreen-btn').click(toggleFullscreen);
                
                // Helper functions
                function getDisplayMode() {
                    return window.innerWidth < 768 ? 'single' : 'double';
                }
                
                function updateZoom() {
                    $('#magazine').css({
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
                        $('.fullscreen-btn i').removeClass('fa-expand').addClass('fa-compress');
                    } else {
                        if (document.exitFullscreen) document.exitFullscreen();
                        else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
                        else if (document.msExitFullscreen) document.msExitFullscreen();
                        
                        isFullscreen = false;
                        $('.fullscreen-btn i').removeClass('fa-compress').addClass('fa-expand');
                    }
                }
                
                function adjustImageSizes() {
                    $('.magazine-page-image').each(function() {
                        const page = $(this).closest('.page, .hard');
                        const pageWidth = page.width();
                        const pageHeight = page.height();
                        const imgRatio = this.naturalWidth / this.naturalHeight;
                        const pageRatio = pageWidth / pageHeight;
                        
                        if (window.innerWidth < 768) {
                            $(this).css({
                                'width': '100%',
                                'height': '100%',
                                'object-fit': 'cover',
                                'margin': '0',
                                'padding': '0'
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
                    const currentPage = $('#magazine').turn('page');
                    const displayMode = getDisplayMode();
                    
                    $('#magazine').turn('size', calculateFlipbookSize().width, calculateFlipbookSize().height)
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
                    switch (e.keyCode) {
                        case 37: // left arrow
                            $('#magazine').turn('previous');
                            e.preventDefault();
                            break;
                        case 39: // right arrow
                            $('#magazine').turn('next');
                            e.preventDefault();
                            break;
                        case 27: // ESC
                            if (isFullscreen) {
                                toggleFullscreen();
                            }
                            break;
                    }
                });
                
                // Initial adjustment
                setTimeout(function() {
                    adjustImageSizes();
                    $('#magazine').turn('size', calculateFlipbookSize().width, calculateFlipbookSize().height);
                }, 500);
            });
        });
    </script>
    </body>
</html>