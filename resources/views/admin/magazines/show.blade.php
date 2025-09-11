<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <link rel="icon" href="../assets/img/logo/fav.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- <style>
        /* Flipbook Container # */
        #flipbook-container {
            margin: 20px auto;
            text-align: center;
        }
        
        /* Preview Style #*/
        .preview-pages {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .preview-page {
            width: 150px;
            height: 200px;
            overflow: hidden;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.3s;
        }
        
        .preview-page:hover {
            transform: scale(1.05);
        }
        
        .preview-page img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Flipbook Viewer Style */
        #flipbook-viewer {
            width: 900px;
            height: 600px;
            margin: 0 auto;
            position: relative;
            background: #fafafa;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        /* Page Style */
        .page {
            background-color: white;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .hard {
            background-color: #f5f5f5;
            box-shadow: inset 0 0 30px rgba(0,0,0,0.1);
            border: 1px solid #ddd;
        }
        .page img {
             max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
        }
        
        /* Modal Style */
        .modal-fullscreen {
            max-width: 95%;
        }
        
        .modal-fullscreen .modal-body {
            padding: 0;
            background: #333;
        }
        
        /* Navigation Controls */
        .flipbook-controls {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background: rgba(0,0,0,0.7);
            padding: 10px 20px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .flipbook-controls button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .flipbook-controls button:hover {
            color:#0056b3;
            transform: scale(1.2);
        }
        
        .flipbook-controls .page-indicator {
            color: white;
            font-size: 16px;
            min-width: 100px;
            text-align: center;
            margin: 0 15px;
        }
        .flipbook-controls button.disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        /* Loading Animation */
        .loader {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 100;
        }
        
        /* Book Cover Effect */
        .book-cover {
            width: 300px;
            height: 400px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            cursor: pointer;
            transition: transform 0.3s ease;
            background-image: url("{{ asset($magazine->cover_image) }}");
            background-size: cover;
            background-position: center;
            color: #fff;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
        }
        .book-cover:hover {
            transform: scale(1.05);
        }
        .book-cover-inner {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transition: all 1s ease;
        }
        
        .book-cover:hover .book-cover-inner {
            transform: rotateY(20deg);
        }
        
        .book-cover-front, .book-cover-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 5px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        .book-cover-front {
            background: linear-gradient(45deg, #4e73df, #224abe);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            transform: translateZ(20px);
        }
        
        .book-cover-back {
            background: #f8f9fc;
            transform: rotateY(180deg) translateZ(20px);
        }
        
        .book-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .click-to-open {
            font-size: 14px;
            opacity: 0.8;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
         /* Error Message */
        .error-message {
            color: white;
            text-align: center;
            padding: 20px;
            display: none;
        }
        .book-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px 0;
        }
        @media (max-width: 768px) {
            #flipbook-viewer {
                width: 100% !important;
                height: auto !important;
            }
            
            .flipbook-controls {
                flex-wrap: wrap;
            }
        }
    </style> --}}
    {{-- <style>
                
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
    
        /* Flipbook Area */
        .flipbook,
        #flipbook-viewer {
            width: 1000px;
            height: 600px;
            margin: 0 auto;
            background: #fafafa;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .flipbook .hard,
        .hard {
            background-image: url("{{ asset($magazine->cover_image) }}");
            /* background: #c0392b !important; cover pertama */
            color: #fff;
            font-weight: bold;
            border: none;
            box-shadow: inset 0 0 30px rgba(0,0,0,0.1);
        }

        .flipbook .hard small {
            font-style: italic;
            font-weight: lighter;
            opacity: 0.7;
            font-size: 14px;
        }

        .flipbook .page,
        .page {
            background: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 10px;
            border: 1px solid rgba(0, 0, 0, 0.11);
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            overflow: hidden;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }

        .page img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            margin: auto;
        }

        .flipbook .page small {
            font-size: 14px;
            margin-bottom: 10px;
        }

        /* Preview Panel */
        .preview-pages {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .preview-page {
            width: 150px;
            height: 200px;
            overflow: hidden;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.3s;
        }

        .preview-page:hover {
            transform: scale(1.05);
        }

        .preview-page img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Modal */
        .modal-fullscreen {
            max-width: 95%;
        }

        .modal-fullscreen .modal-body {
            padding: 0;
            background: #333;
        }

        /* Controls */
        .flipbook-controls {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            background: rgba(0,0,0,0.7);
            padding: 10px 20px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .flipbook-controls button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s;
        }

        .flipbook-controls button:hover {
            background-color: #0056b3;
            transform: scale(1.2);
        }

        .flipbook-controls .page-indicator {
            color: white;
            font-size: 16px;
            min-width: 100px;
            text-align: center;
            margin: 0 15px;
        }

        .flipbook-controls button.disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Loader */
        .loader {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 100;
        }

        /* Book Cover */
        .book-cover {
            width: 300px;
            height: 400px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 20px;
            cursor: pointer;
            transition: transform 0.3s ease;
            background-size: cover;
            background-position: center;
            color: #fff;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
            background-image: url("{{ asset($magazine->cover_image) }}");

        }

        .book-cover:hover {
            transform: scale(1.05);
        }

        .book-cover-inner {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            transition: all 1s ease;
        }

        .book-cover:hover .book-cover-inner {
            transform: rotateY(20deg);
        }

        .book-cover-front,
        .book-cover-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 5px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .book-cover-front {
            background: linear-gradient(45deg, #4e73df, #224abe);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            transform: translateZ(20px);
        }

        .book-cover-back {
            background: #f8f9fc;
            transform: rotateY(180deg) translateZ(20px);
        }

        .book-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .click-to-open {
            font-size: 14px;
            opacity: 0.8;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Error Message */
        .error-message {
            color: white;
            text-align: center;
            padding: 20px;
            display: none;
        }

        /* Layout Container */
        .book-container,
        #flipbook-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px auto;
        }
        #flipbook-viewer {
            width: 900px;
            height: 600px;
            margin: 0 auto;
            position: relative;
            background: #fafafa;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
                
        /* Responsive */
        @media (max-width: 768px) {
            #flipbook-viewer,
            .flipbook {
                width: 100% !important;
                height: auto !important;
            }

            .flipbook-controls {
                flex-wrap: wrap;
            }

            .book-cover {
                width: 90%;
                height: auto;
            }
        }
 

    </style> --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
            
            /* Base Styles */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
            }

            /* Additional styles for 3D flipbook */
            .flipbook-3d-container {
                margin: 0 auto;
                perspective: 2000px;
            }

            .flipbook-3d {
                width: 100%;
                height: 100%;
                position: relative;
                transform-style: preserve-3d;
                transition: transform 1s;
            }

            .page-3d {
                position: absolute;
                width: 50%;
                height: 100%;
                background: white;
                background-size: cover;
                background-position: center;
                box-shadow: 0 0 10px rgba(0,0,0,0.3);
                transform-origin: left center;
                backface-visibility: hidden;
            }

            .page-3d.cover-front {
                width: 100%;
                background-color: #c0392b;
                color: white;
                display: flex;
                justify-content: center;
                align-items: center;
                font-weight: bold;
                font-size: 24px;
            }

            .page-3d.cover-back {
                width: 100%;
                right: 0;
                left: auto;
                transform-origin: right center;
            }

            /* Fullscreen mode adjustments */
            #magazineViewer.fullscreen-mode .modal-dialog {
                max-width: 100%;
                height: 100vh;
                margin: 0;
                padding: 0;
            }

            #magazineViewer.fullscreen-mode .modal-content {
                height: 100vh;
                border-radius: 0;
            }

            #magazineViewer.fullscreen-mode .flipbook-3d-container {
                width: 90% !important;
                height: 80vh !important;
                max-width: none;
            }


            /* Flipbook Container */
            #flipbook-container {
                margin: 20px auto;
                text-align: center;
            }

            /* Flipbook Main Styles */
            /* .flipbook, #flipbook-viewer {
                width: 1000px;
                height: 600px;
                margin: 0 auto;
                position: relative;
                background: #fafafa;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            } */
            #flipbook-viewer {
                    margin: 0 auto;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    width: 100%;
                    max-width: 100%; /* mencegah overflow horizontal */
                    overflow: hidden;
            }

                /* Ukuran flipbook responsif dan proporsional */
            .flipbook {
                width: 100%;
                height: 600px;
                max-width: 900px;
                /* height: auto; */
                aspect-ratio: 4 / 3; /* rasio halaman majalah */
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
                margin: auto;
            }
            .flipbook img {
                width: 100%;
                height: auto;
                object-fit: contain;
            }
            /* Page Styles */
            .flipbook .page, .page {
                background: white;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 10px;
                border: 1px solid rgba(0, 0, 0, 0.11);
                box-shadow: 0 0 15px rgba(0,0,0,0.1);
                overflow: hidden;
            }

            /* Hard Cover Styles */
            /* .flipbook .hard, .hard { */
            .flipbook .hard, .hard {
                background: #c0392b !important;
                color: #fff;
                font-weight: bold;
                border: none;
                box-shadow: inset 0 0 30px rgba(0,0,0,0.1);
            }

            .flipbook .hard small, .hard small {
                font-style: italic;
                font-weight: lighter;
                opacity: 0.7;
                font-size: 14px;
            }

            /* Page Content Styles */
            .page img {
                width: 70%;
                max-width: 100%;
                max-height: 100%;
                height: auto;
                object-fit: contain;
                margin: auto;
            }

            .flipbook .page small, .page small {
                font-size: 14px;
                margin-bottom: 10px;
            }

            /* Preview Pages Styles */
            .preview-pages {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
                margin-bottom: 20px;
            }

            .preview-page {
                width: 150px;
                height: 200px;
                overflow: hidden;
                border: 1px solid #ddd;
                box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                cursor: pointer;
                transition: transform 0.3s;
            }

            .preview-page:hover {
                transform: scale(1.05);
            }

            .preview-page img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            /* Modal Styles */
            .modal-fullscreen {
                max-width: 100%;
            }
            .modal-xl {
                max-width: 100%;
                height: 100vh;
                margin: 0;
                padding: 0;
            }
            .modal-content {
                height: 100vh;
                border-radius: 0;
                display: flex;
                flex-direction: column;
            }

            .modal-body {
                flex: 1;
                overflow-y: auto;
                padding: 1.5rem;
                background: #333;
            }
            .modal-fullscreen .modal-body {
                /* padding: 0; */
                padding: 1.5rem;
                background: #333;
            }

            /* Navigation Controls */
            .flipbook-controls {
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                z-index: 1000;
                background: rgba(0,0,0,0.7);
                padding: 10px 20px;
                border-radius: 30px;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 15px;
                margin-top: 20px;
            
            }

            .flipbook-controls button {
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                cursor: pointer;
                transition: background-color 0.3s ease;
                /* transition: all 0.3s; */
                padding: 8px 12px;
            }

            .flipbook-controls button:hover {
                background-color: #0056b3;
                transform: scale(1.2);
            }

            .flipbook-controls .page-indicator {
                color: white;
                font-size: 16px;
                min-width: 100px;
                text-align: center;
                margin: 0 15px;
            }

            .flipbook-controls button.disabled {
                background-color: #ccc;
                cursor: not-allowed;
            }

            /* Loading Animation */
            .loader {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                z-index: 100;
            }

            /* Book Cover Effect */
            .book-container {
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 30px 0;
            }

            .book-cover {
                width: 300px;
                height: 400px;
                background-color: #f8f9fa;
                border: 1px solid #ddd;
                border-radius: 5px;
                box-shadow: 0 10px 20px rgba(0,0,0,0.2);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                text-align: center;
                padding: 20px;
                cursor: pointer;
                transition: transform 0.3s ease;
                background-size: cover;
                background-position: center;
                color: #fff;
                text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
                background-image: url("{{ asset($magazine->cover_image) }}");

            }

            .book-cover:hover {
                transform: scale(1.05);
            }

            .book-cover-inner {
                width: 100%;
                height: 100%;
                position: relative;
                transform-style: preserve-3d;
                transition: all 1s ease;
            }

            .book-cover:hover .book-cover-inner {
                transform: rotateY(20deg);
            }

            .book-cover-front, .book-cover-back {
                position: absolute;
                width: 100%;
                height: 100%;
                backface-visibility: hidden;
                border-radius: 5px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            }

            .book-cover-front {
                background: linear-gradient(45deg, #4e73df, #224abe);
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                color: white;
                transform: translateZ(20px);
            }

            .book-cover-back {
                background: #f8f9fc;
                transform: rotateY(180deg) translateZ(20px);
            }

            .book-title {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 10px;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            }

            .click-to-open {
                font-size: 14px;
                opacity: 0.8;
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }

            /* Error Message */
            .error-message {
                color: white;
                text-align: center;
                padding: 20px;
                display: none;
            }

            /* Responsive Styles */
            @media (max-width: 768px) {
                .flipbook, #flipbook-viewer {
                    width: 100% !important;
                    height: auto !important;
                }
                
                .flipbook-controls {
                    flex-wrap: wrap;
                }
            }
    </style>
    {{-- @vite(['resources/css/style_majalah.css']) --}}
      
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="green2">
                        {{-- <a href="index.html" class="logo">
                            <img src="admin/assets/img/logo/logo-ligh.svg" alt="navbar brand" class="navbar-brand"
                                height="20" />
                        </a> --}}
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar -->
                <x-app-layout>
                </x-app-layout>
                {{-- @include('admin.navbar') --}}
                <!-- End Navbar -->
            </div>
            <!-- body -->
            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Berkas</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('magazine.index') }}">Majalah</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $magazine->title }}</li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h1>{{ $magazine->title }}</h1>
                            
                            <div class="book-container">
                                <div class="book-cover open-magazine">
                                    <div class="book-title">{{ $magazine->title }}</div>
                                    <div>Klik untuk Membaca</div>
                                </div>
                            </div>
                            
                            <!-- Detail majalah -->
                            <div class="row mt-4">
                                <div class="col-md-8 offset-md-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5>Informasi Majalah</h5>
                                            <p><strong>Judul:</strong> {{ $magazine->title }}</p>
                                            <p><strong>Deskripsi:</strong> {{ $magazine->description ?? 'Tidak ada deskripsi' }}</p>
                                            <p><strong>Jumlah Halaman:</strong> {{ count($magazine->pages) }}</p>
                                            <p><strong>Tanggal Publikasi:</strong> {{ $magazine->published_at ? $magazine->published_at->format('d F Y') : 'Belum dipublikasikan' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 

                <!-- Modal/Popup Viewer -->
                <div class="modal fade" id="magazineViewer" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $magazine->title }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="loader">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                                <div class="error-message">
                                    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                                    <h4>Gagal memuat halaman</h4>
                                    <p>Silakan coba lagi atau periksa koneksi internet Anda</p>
                                </div>
                                <div id="flipbook-viewer" class="flipbook">
                                    <div class="hard">{{ $magazine->title }}</div>
                                    <div class="hard"></div>
                                    @foreach($magazine->pages as $page)
                                        <div>
                                            <img src="{{ asset( $page) }}" alt="Halaman Majalah" class="img-fluid" />
                                        </div>
                                    @endforeach
                                    <div class="hard"></div>
                                    <div class="hard">Terima Kasih</div>
                                </div>

                                <div class="flipbook-controls">
                                    <button id="first-page"><i class="fas fa-fast-backward"></i></button>
                                    <button id="prev-page"><i class="fas fa-chevron-left"></i></button>
                                    <span class="page-indicator">Halaman <span id="current-page">1</span> dari {{ count($magazine->pages) }}</span>
                                    <button id="next-page"><i class="fas fa-chevron-right"></i></button>
                                    <button id="last-page"><i class="fas fa-fast-forward"></i></button>
                                    <button id="fullscreen-toggle" class="ms-3"><i class="fas fa-expand"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
        </div>
            @include('admin.footer')
        </div>
        <!-- End Custom template -->
        {{-- @include('admin.custume') --}}
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    @include('admin.js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/turn.js@4/turn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
    @vite([
        'resources/js/jquery_majalah.js',
        'resources/js/turn_majalah.js',
        // 'resources/js/magazine_viewer.js'
    ])

    
    {{-- <script src="https://cdn.jsdelivr.net/npm/turn.js@4/turn.min.js"></script> --}}
    {{-- <script>
        $(document).ready(function () {
            const pages = @json($magazine->pages).sort((a, b) => {
                const numA = parseInt(a.match(/page_(\d+)\./)[1]);
                const numB = parseInt(b.match(/page_(\d+)\./)[1]);
                return numA - numB;
            });
            let flipbook;
            let imagesLoaded = 0;
            
            // Open modal when button clicked
            $('.open-magazine').on('click', function() {
                $('#magazineViewer').modal('show');
            });
            
            // Initialize flipbook when modal is shown
            $('#magazineViewer').on('shown.bs.modal', function () {
                initializeFlipbook();
            });
            
            function initializeFlipbook() {
                const $viewer = $('#flipbook-viewer');
                const $loader = $('.loader');
                const $errorMessage = $('.error-message');
                
                $viewer.html(''); // Clear previous content
                $loader.show();
                $errorMessage.hide();
                
                // Preload all images first
                const imagePromises = [];
                
                pages.forEach((page, index) => {
                    const img = new Image();
                    const promise = new Promise((resolve, reject) => {
                        img.onload = resolve;
                        img.onerror = reject;
                        img.src = '{{ asset('') }}' + page;
                    });
                    imagePromises.push(promise);
                    
                    // Create page element
                    const pageNumber = index + 1;
                    const pageDiv = $('<div>', {
                        class: 'page',
                        'data-page': pageNumber
                    });
                    
                    // Add image to page
                    $(img).appendTo(pageDiv);
                    
                    // Add page to viewer
                    $viewer.append(pageDiv);
                });
                
                // When all images are loaded, initialize turn.js
                Promise.all(imagePromises)
                    .then(() => {
                        $loader.hide();
                        
                        // Initialize turn.js
                        $viewer.turn({
                            width: 800,
                            height: 500,
                            autoCenter: true,
                            display: 'single', // Tampilkan satu halaman sekaligus
                            acceleration: true,
                            gradients: true,
                            elevation: 50,
                            when: {
                                turning: function(e, page) {
                                    $('#current-page').text(page);
                                },
                                turned: function(e, page) {
                                    // Update active page
                                    $('.page').removeClass('active');
                                    $(`.page[data-page="${page}"]`).addClass('active');
                                }
                            }
                        });
                        
                        flipbook = $viewer;
                        
                        // Add swipe support for mobile
                        const hammer = new Hammer($viewer[0]);
                        hammer.on('swipeleft', function() {
                            $viewer.turn('next');
                        });
                        
                        hammer.on('swiperight', function() {
                            $viewer.turn('previous');
                        });
                        
                        // Keyboard navigation
                        $(document).on('keydown.flipbook', function(e) {
                            if ($('#magazineViewer').is(':visible')) {
                                if (e.keyCode === 37) { // Left arrow
                                    $viewer.turn('previous');
                                } else if (e.keyCode === 39) { // Right arrow
                                    $viewer.turn('next');
                                }
                            }
                        });
                    })
                    .catch((error) => {
                        console.error('Error loading images:', error);
                        $loader.hide();
                        $errorMessage.show();
                    });
            }
            
            // Navigation controls
            $('#first-page').on('click', function() {
                if (flipbook) flipbook.turn('page', 1);
            });
            
            $('#prev-page').on('click', function() {
                if (flipbook) flipbook.turn('previous');
            });
            
            $('#next-page').on('click', function() {
                if (flipbook) flipbook.turn('next');
            });
            
            $('#last-page').on('click', function() {
                if (flipbook) flipbook.turn('page', pages.length);
            });
            
            // Clean up when modal is closed
            $('#magazineViewer').on('hidden.bs.modal', function () {
                if (flipbook) {
                    flipbook.turn('destroy');
                    flipbook = null;
                }
                $(document).off('keydown.flipbook');
            });
        });
    </script> --}}

    {{-- <script>
        $(document).ready(function () {
            // Urutkan halaman secara numerik
            const pages = @json($magazine->pages).sort((a, b) => {
                const numA = parseInt(a.match(/page_(\d+)\./)[1]);
                const numB = parseInt(b.match(/page_(\d+)\./)[1]);
                return numA - numB;
            });
            
            let flipbook;
            
            // Buka modal saat cover diklik
            $('.open-magazine').on('click', function() {
                $('#magazineViewer').modal('show');
            });
            
            // Inisialisasi flipbook saat modal terbuka
            $('#magazineViewer').on('shown.bs.modal', function () {
                initializeFlipbook();
            });
            
            function initializeFlipbook() {
                const $viewer = $('#flipbook-viewer');
                const $loader = $('.loader');
                
                $viewer.html(''); // Bersihkan konten sebelumnya
                $loader.show();
                
                // Tambahkan cover depan (halaman kosong di sebelah kiri)
                $viewer.append('<div class="hard"></div>');
                
                // Buat halaman-halaman
                pages.forEach((page, index) => {
                    const pageNumber = index + 1;
                    const pageDiv = $(`
                        <div class="page">
                            <img src="{{ asset('') }}${page}" 
                                alt="Halaman ${pageNumber}" 
                                style="width:100%;height:100%;object-fit:contain;">
                        </div>
                    `);
                    $viewer.append(pageDiv);
                });
                
                // Tambahkan cover belakang (halaman kosong di sebelah kanan)
                $viewer.append('<div class="hard"></div>');
                
                // Inisialisasi turn.js setelah gambar dimuat
                const images = $viewer.find('img');
                let loaded = 0;
                
                images.on('load', function() {
                    loaded++;
                    if (loaded === images.length) {
                        $loader.hide();
                        
                        // Inisialisasi flipbook
                        $viewer.turn({
                            width: 900,
                            height: 600,
                            autoCenter: true,
                            display: 'double', // Tampilkan 2 halaman
                            acceleration: true,
                            gradients: true,
                            elevation: 50,
                            duration: 1000,
                            when: {
                                turning: function(e, page) {
                                    // Perbaiki nomor halaman (skip cover kosong)
                                    const actualPage = page <= 1 ? 1 : page - 1;
                                    $('#current-page').text(actualPage);
                                },
                                turned: function(e, page) {
                                    // Nonaktifkan tombol navigasi sesuai halaman
                                    $('#first-page').toggleClass('disabled', page <= 2);
                                    $('#prev-page').toggleClass('disabled', page <= 2);
                                    $('#next-page').toggleClass('disabled', page >= $viewer.turn('pages'));
                                    $('#last-page').toggleClass('disabled', page >= $viewer.turn('pages'));
                                }
                            }
                        });
                        
                        flipbook = $viewer;
                        
                        // Tambahkan swipe untuk mobile
                        const hammer = new Hammer($viewer[0]);
                        hammer.on('swipeleft', function() {
                            $viewer.turn('next');
                        });
                        
                        hammer.on('swiperight', function() {
                            $viewer.turn('previous');
                        });
                        
                        // Navigasi keyboard
                        $(document).on('keydown.flipbook', function(e) {
                            if ($('#magazineViewer').is(':visible')) {
                                if (e.keyCode === 37) { // Panah kiri
                                    $viewer.turn('previous');
                                } else if (e.keyCode === 39) { // Panah kanan
                                    $viewer.turn('next');
                                }
                            }
                        });
                    }
                }).on('error', function() {
                    // Tangani error loading gambar
                    $(this).closest('.page').html(`
                        <div style="display:flex;justify-content:center;align-items:center;height:100%;">
                            <div class="text-center">
                                <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                                <h4>Gagal memuat halaman</h4>
                            </div>
                        </div>
                    `);
                    loaded++; // Tetap hitung sebagai loaded untuk memungkinkan inisialisasi
                });
            }
            
            // Kontrol navigasi
            $('#first-page').on('click', function() {
                if (!$(this).hasClass('disabled') && flipbook) {
                    flipbook.turn('page', 2); // Lewati cover kosong
                }
            });
            
            $('#prev-page').on('click', function() {
                if (!$(this).hasClass('disabled') && flipbook) {
                    flipbook.turn('previous');
                }
            });
            
            $('#next-page').on('click', function() {
                if (!$(this).hasClass('disabled') && flipbook) {
                    flipbook.turn('next');
                }
            });
            
            $('#last-page').on('click', function() {
                if (!$(this).hasClass('disabled') && flipbook) {
                    flipbook.turn('page', flipbook.turn('pages'));
                }
            });
            
            // Bersihkan saat modal ditutup
            $('#magazineViewer').on('hidden.bs.modal', function () {
                if (flipbook) {
                    flipbook.turn('destroy');
                    flipbook = null;
                }
                $(document).off('keydown.flipbook');
            });
        });
    </script> --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    
            const flipbook = $(".flipbook");

            if (flipbook.length) {
                flipbook.turn({
                    width: 800,
                    height: 600,
                    autoCenter: true
                });

                // Kontrol tombol
                $("#next-page").click(() => flipbook.turn("next"));
                $("#prev-page").click(() => flipbook.turn("previous"));
                $("#first-page").click(() => flipbook.turn("page", 1));
                $("#last-page").click(() => flipbook.turn("page", flipbook.turn("pages")));

                // Indikator halaman
                flipbook.bind("turned", function (event, page) {
                    $("#current-page").text(page);
                });

                // Fullscreen toggle
                $("#fullscreen-toggle").click(() => {
                    const elem = flipbook[0 ];
                    if (!document.fullscreenElement) {
                        elem.requestFullscreen().catch(err => {
                            alert(`Error attempting to enable full-screen mode: ${err.message}`);
                        });
                    } else {
                        document.exitFullscreen();
                    }
                });

                // Sembunyikan loader, tampilkan flipbook
                $(".loader").hide();
                $("#flipbook-viewer").show();
            } else {
                $(".loader").hide();
                $(".error-message").show();
            }
        });

         $(document).ready(function () {
            $('#flipbook-viewer').turn({
                width: 800,
                height: 600,
                autoCenter: true
            });
        });
        $(document).ready(function () {
            let flipbook;
            let isFullscreen = false;
            
            // Urutkan halaman secara numerik
            const pages = @json($magazine->pages).sort((a, b) => {
                // Ekstrak nomor halaman dari nama file (misalnya "page_01.jpg" -> 1)
                const numA = parseInt(a.match(/page_(\d+)\./)[1]);
                const numB = parseInt(b.match(/page_(\d+)\./)[1]);
                return numA - numB;
            });
            
            
            // Buka modal saat cover diklik
            $('.open-magazine').on('click', function() {
                $('#magazineViewer').modal('show');
            });
            
            // Inisialisasi flipbook saat modal terbuka
            $('#magazineViewer').on('shown.bs.modal', function () {
                initializeFlipbook();
            });
            
            function initialize3DFlipbook() {
                    const $viewer = $('#flipbook-viewer');
                    const $loader = $('.loader');
                    const $errorMessage = $('.error-message');
                    
                    $viewer.html(''); // Clear previous content
                    $loader.show();
                    $errorMessage.hide();

                    // Calculate dimensions based on modal size
                    const modalContentWidth = $('.modal-content').width();
                    const modalContentHeight = $('.modal-content').height();
                    const flipbookWidth = Math.min(900, modalContentWidth * 0.9);
                    const flipbookHeight = Math.min(600, modalContentHeight * 0.8);

                    // Create 3D container
                    $viewer.html(`
                        <div class="flipbook-3d-container" 
                            style="width: ${flipbookWidth}px; height: ${flipbookHeight}px; 
                                    perspective: 2000px; margin: 0 auto;">
                            <div class="flipbook-3d" style="width: 100%; height: 100%; 
                                    position: relative; transform-style: preserve-3d;">
                                <!-- Pages will be inserted here -->
                            </div>
                        </div>
                    `);

                    const $flipbook3D = $viewer.find('.flipbook-3d');

                    // Add front cover
                    $flipbook3D.append(`
                        <div class="page-3d cover-front" 
                            style="background-image: url('{{ asset($magazine->cover_image) }}');
                                    transform: rotateY(0deg); z-index: ${pages.length + 2};">
                        </div>
                    `);

                    // Add pages (starting from page 2)
                    for (let i = 1; i < pages.length; i++) {
                        $flipbook3D.append(`
                            <div class="page-3d" data-page="${i}"
                                style="background-image: url('${pages[i]}');
                                        transform: rotateY(180deg) translateZ(${(i * 2) + 1}px);
                                        z-index: ${pages.length - i + 1};">
                            </div>
                        `);
                    }

                    // Add back cover
                    $flipbook3D.append(`
                        <div class="page-3d cover-back" 
                            style="background-image: url('${pages[pages.length - 1]}');
                                    transform: rotateY(180deg) translateZ(1px); z-index: 1;">
                        </div>
                    `);

                    // Set initial state to show cover
                    $flipbook3D.css('transform', 'rotateY(0deg)');
                    $loader.hide();

                    // Initialize page counter (starting from page 2)
                    let currentPage = 1;
                    updatePageIndicator();

                    // Navigation controls
                    $('#first-page').click(function() {
                        flipToPage(1);
                    });
                    
                    $('#prev-page').click(function() {
                        if (currentPage > 1) {
                            flipToPage(currentPage - 1);
                        }
                    });
                    
                    $('#next-page').click(function() {
                        if (currentPage < pages.length) {
                            flipToPage(currentPage + 1);
                        }
                    });
                    
                    $('#last-page').click(function() {
                        flipToPage(pages.length);
                    });

                    function flipToPage(pageNum) {
                        currentPage = pageNum;
                        updatePageIndicator();
                        
                        // Calculate rotation angle (each page turn is 180 degrees)
                        const angle = (pageNum - 1) * 180;
                        $flipbook3D.css('transform', `rotateY(${angle}deg)`);
                        
                        // Update button states
                        updateButtonStates();
                    }

                    function updatePageIndicator() {
                        $('#current-page').text(currentPage);
                    }

                    function updateButtonStates() {
                        $('#first-page, #prev-page').toggleClass('disabled', currentPage === 1);
                        $('#next-page, #last-page').toggleClass('disabled', currentPage === pages.length);
                    }

                    // Fullscreen toggle
                    $('#fullscreen-toggle').click(function() {
                        const $modal = $('#magazineViewer');
                        const $icon = $(this).find('i');
                        
                        if ($modal.hasClass('fullscreen-mode')) {
                            $modal.removeClass('fullscreen-mode');
                            $icon.removeClass('fa-compress').addClass('fa-expand');
                            isFullscreen = false;
                        } else {
                            $modal.addClass('fullscreen-mode');
                            $icon.removeClass('fa-expand').addClass('fa-compress');
                            isFullscreen = true;
                        }
                        
                        // Resize flipbook after transition
                        setTimeout(() => {
                            const newWidth = Math.min(900, $('.modal-content').width() * 0.9);
                            const newHeight = Math.min(600, $('.modal-content').height() * 0.8);
                            $('.flipbook-3d-container').css({
                                width: newWidth + 'px',
                                height: newHeight + 'px'
                            });
                        }, 300);
                    });
                    // Initialize button states
                    updateButtonStates();

                    // Handle window resize
                    $(window).on('resize.flipbook', function() {
                        const newWidth = Math.min(900, $('.modal-content').width() * 0.9);
                        const newHeight = Math.min(600, $('.modal-content').height() * 0.8);
                        $('.flipbook-3d-container').css({
                            width: newWidth + 'px',
                            height: newHeight + 'px'
                        });
                    });
                }
                // Clean up when modal is closed
                $('#magazineViewer').on('hidden.bs.modal', function () {
                    $(document).off('keydown.flipbook');
                    $(window).off('resize.flipbook');
                });

                // Keyboard navigation
                $(document).on('keydown.flipbook', function(e) {
                    if ($('#magazineViewer').is(':visible')) {
                        if (e.keyCode === 37) { // Left arrow
                            $('#prev-page').click();
                        } else if (e.keyCode === 39) { // Right arrow
                            $('#next-page').click();
                        }
                    }
                });
             



            function initializeFlipbook() {
                const $viewer = $('#flipbook-viewer');
                const $loader = $('.loader');
                const $errorMessage = $('.error-message');
                
                $viewer.html(''); // Bersihkan konten sebelumnya
                $loader.show();
                $errorMessage.hide();
                
                // Tambahkan cover depan (halaman kosong di sebelah kiri)
                $viewer.append('<div class="hard cover-front"><div class="cover-content" style="background-image: url(' + "{{ asset($magazine->cover_image) }}" + ');"></div></div>');
                
                // Tambahkan halaman pertama (halaman kosong)
                $viewer.append('<div class="hard p1"></div>');
                
                // Buat halaman-halaman
                pages.forEach((page, index) => {
                    const pageNumber = index + 1;
                    const pageDiv = $(`
                        <div class="page p${pageNumber + 1}">
                            <img src="{{ asset('') }}${page}" 
                                alt="Halaman ${pageNumber}" 
                                style="width:100%;height:100%;object-fit:contain;">
                        </div>
                    `);
                    $viewer.append(pageDiv);
                });
                
                // Tambahkan halaman terakhir (halaman kosong)
                $viewer.append('<div class="hard p' + (pages.length + 2) + '"></div>');
                
                // Tambahkan cover belakang (halaman kosong di sebelah kanan)
                $viewer.append('<div class="hard cover-back"></div>');
                
                // Inisialisasi turn.js setelah gambar dimuat
                const images = $viewer.find('img');
                let loaded = 0;
                let hasError = false;
                
                if (images.length === 0) {
                    // Tidak ada gambar untuk dimuat
                    initTurnJS();
                } else {
                    images.on('load', function() {
                        loaded++;
                        if (loaded === images.length) {
                            initTurnJS();
                        }
                    }).on('error', function() {
                        // Tangani error loading gambar
                        hasError = true;
                        $(this).closest('.page').html(`
                            <div style="display:flex;justify-content:center;align-items:center;height:100%;">
                                <div class="text-center">
                                    <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                                    <h4>Gagal memuat halaman</h4>
                                </div>
                            </div>
                        `);
                        loaded++; // Tetap hitung sebagai loaded untuk memungkinkan inisialisasi
                        
                        if (loaded === images.length) {
                            initTurnJS();
                        }
                    });
                    
                    // Batasi waktu loading
                    setTimeout(function() {
                        if (loaded < images.length) {
                            // Jika ada gambar yang belum dimuat setelah batas waktu
                            initTurnJS();
                        }
                    }, 10000); // 10 detik timeout
                }
                
                function initTurnJS() {
                    $loader.hide();
                    
                    if (hasError && loaded === 0) {
                        $errorMessage.show();
                        return;
                    }
                    
                    // Dapatkan dimensi untuk flipbook
                    const viewportWidth = $('.modal-body').width() * 0.9;
                    const viewportHeight = $(window).height() * 0.6;
                    
                    // Inisialisasi flipbook
                    $viewer.turn({
                        width: viewportWidth,
                        height: viewportHeight,
                        autoCenter: true,
                        display: 'double', // Tampilkan 2 halaman
                        acceleration: true,
                        gradients: true,
                        elevation: 50,
                        duration: 1000,
                        when: {
                            turning: function(e, page) {
                                // Perbaiki nomor halaman (skip cover kosong)
                                const actualPage = page <= 2 ? 1 : page - 2;
                                $('#current-page').text(actualPage);
                            },
                            turned: function(e, page) {
                                // Nonaktifkan tombol navigasi sesuai halaman
                                $('#first-page').toggleClass('disabled', page <= 2);
                                $('#prev-page').toggleClass('disabled', page <= 2);
                                $('#next-page').toggleClass('disabled', page >= $viewer.turn('pages'));
                                $('#last-page').toggleClass('disabled', page >= $viewer.turn('pages'));
                            }
                        }
                    });
                    
                    flipbook = $viewer;
                    
                    // Tambahkan swipe untuk mobile
                    const hammer = new Hammer($viewer[0]);
                    hammer.on('swipeleft', function() {
                        $viewer.turn('next');
                    });
                    
                    hammer.on('swiperight', function() {
                        $viewer.turn('previous');
                    });
                    
                    // Navigasi keyboard
                    $(document).on('keydown.flipbook', function(e) {
                        if ($('#magazineViewer').is(':visible')) {
                            if (e.keyCode === 37) { // Panah kiri
                                $viewer.turn('previous');
                            } else if (e.keyCode === 39) { // Panah kanan
                                $viewer.turn('next');
                            }
                        }
                    });
                    
                    // Resize handler untuk responsif
                    $(window).on('resize.flipbook', function() {
                        if (!flipbook) return;
                        
                        const viewportWidth = $('.modal-body').width() * 0.9;
                        const viewportHeight = $(window).height() * (isFullscreen ? 0.8 : 0.6);
                        
                        flipbook.turn('size', viewportWidth, viewportHeight);
                        flipbook.turn('resize');
                    });
                }
            }
            
            // Kontrol navigasi
            $('#first-page').on('click', function() {
                if (!$(this).hasClass('disabled') && flipbook) {
                    flipbook.turn('page', 1);
                }
            });
            
            $('#prev-page').on('click', function() {
                if (!$(this).hasClass('disabled') && flipbook) {
                    flipbook.turn('previous');
                }
            });
            
            $('#next-page').on('click', function() {
                if (!$(this).hasClass('disabled') && flipbook) {
                    flipbook.turn('next');
                }
            });
            
            $('#last-page').on('click', function() {
                if (!$(this).hasClass('disabled') && flipbook) {
                    flipbook.turn('page', flipbook.turn('pages'));
                }
            });
            
            // Toggle fullscreen
            $('#fullscreen-toggle').on('click', function() {
                const $modalDialog = $('.modal-dialog');
                const $icon = $(this).find('i');
                
                if ($modalDialog.hasClass('modal-fullscreen')) {
                    $modalDialog.removeClass('modal-fullscreen');
                    $icon.removeClass('fa-compress').addClass('fa-expand');
                    isFullscreen = false;
                } else {
                    $modalDialog.addClass('modal-fullscreen');
                    $icon.removeClass('fa-expand').addClass('fa-compress');
                    isFullscreen = true;
                }
                
                // Resize flipbook setelah transisi modal selesai
                setTimeout(function() {
                    $(window).trigger('resize.flipbook');
                }, 300);
            });
            
            // Bersihkan saat modal ditutup
            $('#magazineViewer').on('hidden.bs.modal', function () {
                if (flipbook) {
                    flipbook.turn('destroy');
                    flipbook = null;
                }
                $(document).off('keydown.flipbook');
                $(window).off('resize.flipbook');
            });
        });
    </script>
    {{-- <script>
       
    </script> --}}
</body>

</html>
                