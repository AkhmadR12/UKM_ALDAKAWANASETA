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
        /* CSS untuk halaman terkunci */
        .btn-gradient {
            background: linear-gradient(135deg, #0097d5, #02648b);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: opacity 0.2s ease;
        }

        .btn-gradient:hover {
            opacity: 0.85;
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
        .bodya {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .containera {
            max-width: 1200px;
            width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
            margin-left: auto;
            margin-right: auto;
            box-sizing: border-box;
        }


        .pricing-containeara {
            max-width: 1200px;
            width: 100%;
        }

        .pricing-cardsa {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }

        .carda {
            background: rgba(202, 6, 6, 0.795);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
            color: #fff;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            min-height: 550px;
            display: flex;
            flex-direction: column;
        }

         .carda.carousel-carda{
            padding: 0 !important;
            border: none !important;
        }

        .carda::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(
                circle at top right,
                rgba(255, 255, 255, 0.1),
                transparent
            );
            pointer-events: none;
        }

        .carda:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .carda.featured {
            background: linear-gradient(
                135deg,
                rgba(29, 38, 113, 0.8) 0%,
                rgba(195, 55, 55, 0.8) 100%
            );
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .carda-icon {
            width: 48px;
            height: 48px;
            margin-bottom: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .carda:hover .carda-icon {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.05);
        }

        .carda-icon i {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .carda.featured .carda-icon {
            background: rgba(255, 255, 255, 0.15);
        }

        .carda.featured .carda-icon i {
            color: #fff;
        }

        .carda-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .carda-header .carda-icon {
            margin-bottom: 0;
        }

        h2 {
            font-size: 1.75rem;
            margin-bottom: 0.2rem;
            font-weight: 600;
            background: linear-gradient(to right, #fff, #ccc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .descriptiona {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 0.2rem;
            line-height: 1.6;
        }

        .pricea {
            margin-bottom: 0.2rem;
        }

        .amounta {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(to right, #fff, #ccc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .perioda {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .get-starteda {
            width: 100%;
            padding: 1rem;
            border: none;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-radius: 12px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            margin: 1rem 0 0.2rem;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
        }

        .get-starteda:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .featuresa {
            margin-top: auto;
        }

        .featuresa h3 {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 1rem;
            letter-spacing: 1px;
        }

        .featuresa ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .featuresa li {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .featuresa li::before {
            content: "✓";
            color: #4caf50;
            font-weight: bold;
        }

         .carousel-containera {
            height: 100%;
            width: 100%;
            position: relative;
            border-radius: 20px;
            overflow: hidden;
        }

        .carousel-slidesa {
            position: relative;
            height: 100%;
            width: 100%;
        }

        .carousel-slidea {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease;
        }

        .carousel-slidea.active {
            opacity: 1;
        }

        .carousel-slidea img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
        }

         .carousel-dotsa {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
            z-index: 10;
        }

        .dota {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dota.active {
            background: rgba(255, 255, 255, 0.9);
            transform: scale(1.2);
        }

         .enterprise-contenta {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            height: 100%;
            justify-content: center;
        }

        .circle-icon {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
        }

        .circle-icon:hover {
            transform: scale(1.1);
            background: rgba(255, 255, 255, 0.2) !important;
            border-color: rgba(255, 255, 255, 0.4);
        }

        .circle-icon i {
            font-size: 2rem;
            color: white;
        }

         .modala {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-contenta {
            background: rgba(202, 6, 6, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            max-width: 600px;
            width: 90%;
            color: white;
            animation: modalFadeIn 0.3s ease;
            position: relative;
        }

        .close-modaal {
            position: absolute;
            top: 1rem;
            right: 1.5rem;
            font-size: 1.5rem;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.8);
            transition: color 0.3s ease;
        }

        .close-modala:hover {
            color: white;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 1024px) {
            .pricing-cardsa {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .carda {
                max-width: 100%;
                padding: 2rem;
            }
            
            .carda.carousel-card {
                padding: 0 !important;
            }
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.6);
            display: none; /* default sembunyi */
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .popup-overlay.show {
            display: flex; /* muncul ketika ada class show */
        }

        /* Popup Content */
        .popup-content {
            position: relative;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            max-width: 90%;
            max-height: 90%;
            overflow: auto;
            transform: scale(0.7);
            transition: transform 0.3s ease;
            animation: fadeIn 0.3s ease;

        }

        .popup-overlay.show .popup-content {
            transform: scale(1);
        }
        .popup-content img {
            max-width: 100%;
            border-radius: 10px;
        }
        /* Close Button */
        .popup-close {
            position: absolute;
            top: 15px;
            right: 20px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            cursor: pointer;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            transition: background 0.3s ease;
        }

        .popup-close:hover {
            background: rgba(0, 0, 0, 0.9);
        }

        /* Popup Body */
        .popup-body {
            padding: 20px;
        }

        .popup-body img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .popup-body h3 {
            margin: 15px 0 10px;
            color: #333;
        }

        .popup-body p {
            color: #666;
            line-height: 1.6;
        }
        @keyframes fadeIn {
            from { transform: scale(0.9); opacity: 0; }
            to   { transform: scale(1); opacity: 1; }
        }
        /* Responsive */
        @media (max-width: 768px) {
            .popup-content {
                max-width: 95%;
                max-height: 95%;
                margin: 10px;
            }
            
            .popup-body {
                padding: 15px;
            }
        }
        
        /* Membuat body tidak bisa di-scroll ketika modal terbuka */
        body.modal-open {
            overflow: hidden;
        }

        .nav-item {
            position: relative;
        }
        .badge {
            font-size: 0.7rem;
        }

        .berita-catalog-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .berita-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .berita-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        .berita-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .berita-image-container {
            position: relative;
            overflow: hidden;
            height: 300px;
        }

        .berita-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .berita-image-container:hover .berita-img {
            transform: scale(1.05);
        }

        .berita-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .berita-card:hover .berita-actions {
            opacity: 1;
        }

        .btn-view-detail {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 50%;
            color: #333;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-view-detail:hover {
            background: #007bff;
            color: white;
            transform: scale(1.1);
        }

        .berita-info {
            padding: 20px;
        }

        .berita-title {
            margin: 0 0 10px 0;
            font-size: 1.25rem;
            font-weight: 600;
            line-height: 1.4;
        }

        .berita-title a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .berita-title a:hover {
            color: #007bff;
        }

        .berita-date {
            color: #666;
            font-size: 0.85rem;
            margin: 0 0 12px 0;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .berita-excerpt {
            color: #555;
            font-size: 0.9rem;
            line-height: 1.5;
            margin: 0 0 15px 0;
        }

        .btn-read-more {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-read-more:hover {
            background: linear-gradient(135deg, #0056b3, #004085);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
            color: white;
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .berita-grid {
                grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
                gap: 10px;
            }
            
            .berita-info {
                padding: 15px;
            }
            
            .berita-title {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .berita-catalog-container {
                padding: 15px;
            }
            
            .berita-grid {
                /* grid-template-columns: 1fr; */
                grid-template-columns: repeat(auto-fill, minmax(150px, 2fr));

                gap: 15px;
            }
        }
        .product-catalog-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            justify-items: center;
        }

        .product-card {
            width: 100%;
            max-width: 280px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: white;
            border: 1px solid #b9b9b9; 
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            border-color: #cccccc;
        }

        .product-image-container {
            position: relative;
            width: 100%;
            height: 100%;
            /* height: 340px; */
            overflow: hidden;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .product-card:hover .product-actions {
            opacity: 1;
        }

        .btn-add-to-cart, .btn-view-detail {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-add-to-cart {
            background-color: #4CAF50;
            color: white;
        }

        .btn-add-to-cart:hover {
            background-color: #3e8e41;
        }

        .btn-view-detail {
            background-color: #2196F3;
            color: white;
        }

        .btn-view-detail:hover {
            background-color: #0b7dda;
        }

        .product-info {
            padding: 15px;
        }

        .product-title {
            font-size: 1rem;
            margin: 0 0 8px 0;
            color: #333;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            font-size: 1.1rem;
            color: #e63946;
            font-weight: 700;
            margin: 0 0 12px 0;
        }

        .btn-buy-now {
            display: block;
            width: 100%;
            padding: 8px;
            background-color: #2a9d8f;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .btn-buy-now:hover {
            background-color: #21867a;
        }

        .btn-view-all {
            display: inline-block;
            padding: 12px 24px;
            background-color: #f4a261;
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(244, 162, 97, 0.3);
        }

        .btn-view-all:hover {
            background-color: #881b00;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(244, 162, 97, 0.4);
        }

        @media (max-width: 768px) {
            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 15px;
            }
            
            .product-image-container {
                height: 160px;
            }
        }

        @media (max-width: 480px) {
            .product-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>

</head>

<body>
 
    @include('frontend.layout.header')

    <!-- Popup Modal -->
    @if($popup)
        <div id="popupOverlay" class="popup-overlay">
            <div class="popup-content">
                {{-- <button --}}
                <button onclick="closePopup()" 
                        style="position:absolute; top:10px; right:10px; background:none; border:none; font-size:20px; cursor:pointer;">
                    &times;
                </button>

                <div class="popup-body">
                    @if($popup->file_path)
                        <img src="{{ asset( $popup->file_path) }}" alt="{{ $popup->title }}">
                    @endif
                    
                    @if($popup->title)
                        <h3>{{ $popup->title }}</h3>
                    @endif
                    
                    @if($popup->content)
                        <p>{!! $popup->content !!}</p>
                    @endif
                    
                    @if($popup->link)
                        <div style="margin-top: 15px;">
                            <a href="{{ $popup->link }}" class="btn btn-primary" target="_blank">
                                Selengkapnya
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
    
    <!-- Modal Search End -->
    <main class="main">
    <!-- feature Start -->
    @include('frontend.layout.section')
    <!-- feature End -->

    {{-- popup --}}
 
    @include('frontend.berita.berita')
 

    <!-- Fact Counter -->
    @include('frontend.layout.about')
    @include('frontend.layout.stats') 
    <!-- Fact Counter -->

    <!-- Service Start -->
     @include('frontend.layout.service')
    {{-- @include('frontend.layout.portofolio') --}}
    {{-- @include('frontend.layout.client') --}}
    {{-- @include('frontend.layout.testimoni') --}}
    @include('frontend.layout.contact')
    
    {{-- @include('frontend.member.member') --}}
    <br>
    <!-- Service End -->


    </main>     

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    
    
    <!-- jQuery dan Turn.js CDN -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.1/turn.min.js"></script> --}}
    @include('frontend.layout.js')
   

    {{-- @vite(['resources/js/app.js']) --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.0/turn.min.js"></script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            //  $(document).ready(function () {
                // function closePopup() {
                //     document.getElementById('popupOverlay').classList.remove('show');
                //     sessionStorage.setItem('popupShown', 'true');
                // }

                 
                    // Tampilkan popup jika belum pernah tampil di sesi ini
                @if($popup) 
                if (!sessionStorage.getItem('popupShown')) {
                    setTimeout(function () {
                        document.getElementById('popupOverlay').classList.add('show');
                        sessionStorage.setItem('popupShown', 'true'); // supaya popup hanya sekali muncul
                    }, 500);
                }
                @endif

                function closePopup() {
                    const overlay = document.getElementById('popupOverlay');
                    if (overlay) {
                        overlay.classList.remove('show');
                    }
                }

                // Tutup jika klik di luar konten popup
                const overlay = document.getElementById('popupOverlay');
                if (overlay) {
                    overlay.addEventListener('click', function (e) {
                        if (e.target === overlay) {
                            closePopup();
                        }
                    });
                }

                // Tutup jika tekan Escape
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') {
                        closePopup();
                    }
                });
               


            // carousel
            const slides = document.querySelectorAll('.carousel-slidea');
            const dots = document.querySelectorAll('.dota');
            let currentSlide = 0;
            
            function showSlide(n) {
                slides.forEach(slide => slide.classList.remove('active'));
                dots.forEach(dot => dot.classList.remove('active'));
                
                slides[n].classList.add('active');
                dots[n].classList.add('active');
            }
            
            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }
            
            // Auto-rotate every 3 seconds
            setInterval(nextSlide, 3000);
            
            // Click on dots
            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    currentSlide = index;
                    showSlide(currentSlide);
                });
            });
            
               // Modal functionality
            const modal = document.getElementById('enterpriseModal');
            const modalTriggers = document.querySelectorAll('[data-modal-target="#enterpriseModal"]');
            const closeBtn = document.querySelector('.close-modala');
            
            // Open modal
            modalTriggers.forEach(trigger => {
                trigger.addEventListener('click', (e) => {
                    e.preventDefault();
                    modal.style.display = 'flex';
                    document.body.style.overflow = 'hidden';
                });
            });
            
            // Close modal
            // closeBtn.addEventListener('click', () => {
            //     modal.style.display = 'none';
            //     document.body.style.overflow = 'auto';
            // });
            
            // Close modal when clicking outside
            window.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        });
 
    </script>
 
    {{-- @viteReactRefresh --}}
    {{-- @vite(['resources/js/app.js']) --}}
 
</body>

</html>
