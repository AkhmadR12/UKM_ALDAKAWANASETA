    {{-- <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Photograp Indonesia</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    
    <!-- Favicons -->
    <link href="home/assets/img/favicon.png" rel="icon">
    <link href="home/assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="home/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="home/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="home/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="home/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="home/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Main CSS File -->
    <link href="home/assets/css/main.css" rel="stylesheet">
    <!-- Tambahkan di <head> jika belum ada -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" /> --}}
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>ALDAKAWANASETA</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- @include('frontend.layout.css') --}}
    {{-- <link href="admin/assets/img/logo/fav.ico" rel="icon"> --}}
     <link href="{{ asset('logo/alas.png') }}" rel="icon">
    <link href="{{ asset('home/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
 <!-- Vendor CSS Files -->
    <link href="{{ asset('home/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/css/main.css') }}" rel="stylesheet">    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" /> --}}

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS Bundle (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


<style>
    .locked-page {
        background: linear-gradient(rgba(255,255,255,0.9), rgba(255,255,255,0.9)), 
                    url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none" stroke="%23ccc" stroke-width="2"/></svg>');
        background-size: 20px 20px;
    }
    
    .locked-page .lock-icon {
        font-size: 3rem;
        color: #ccc;
        margin-bottom: 1rem;
    }

    .locked-page .btn-primary {
        transition: all 0.3s ease;
    }

    .locked-page .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .nav-item.dropdown:hover .dropdown-menu {
        display: block;
    }

    .mobile-bottom-nav {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: white;
        box-shadow: 0 -1px 5px rgba(0,0,0,0.1);
        display: flex;
        justify-content: space-around;
        align-items: center;
        height: 60px;
        z-index: 1000;
        border-top: 1px solid #ddd;
    }

    .mobile-bottom-nav .nav-icon {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-size: 14px;
        text-decoration: none;
        color: #333;
        flex: 1;
        padding: 8px 0;
    }

    .mobile-bottom-nav .nav-icon i {
        font-size: 18px;
        margin-bottom: 2px;
    }

    .mobile-bottom-nav .nav-icon.active {
        color: #0d6efd; /* Bootstrap primary */
    }
    /* Style khusus untuk tombol logo tengah */
    .mobile-bottom-nav .nav-icon.center-logo {
        position: relative;
        flex: 1;
    }

    .mobile-bottom-nav .nav-icon.center-logo .logo-circle {
        width: 50px;
        height: 50px;
        background: #0d6efd;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        top: -32px;
        margin: 0 auto;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .mobile-bottom-nav .nav-icon.center-logo .logo-circle img {
        width: 60px;
        height: 60px;
        object-fit: contain;
    }

    .mobile-bottom-nav .nav-icon.center-logo span {
        margin-top: -5px;
        font-size: 12px;
        color: #333;
    }
    .portfolio-thumb {
        width: 100%;
        height: 250px;
        object-fit: cover;
        object-position: center;
        border-radius: 8px;
    }
    .carousel-half {
        height: 60vh; /* default: layar penuh di mobile */
        object-fit: cover;
    }
    
    .cards-container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
        /* .cards-list {
            z-index: 0;
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }

        .card {
            margin: 10px 0;
            width: calc(25% - 90px);  
            height: 280px;
            border-radius: 20px;
            box-shadow: 5px 5px 20px 5px rgba(0,0,0,0.2), -5px -5px 20px 5px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: 0.3s;
            overflow: hidden;
        } */
    .cards-list {
        z-index: 0;
        width: 100%;
        display: grid;
        justify-content: center;
        gap: 20px;
        grid-template-columns: repeat(4, 1fr);  
        flex-wrap: wrap;
    }
    .card {
        width: 100%;
        height: 340px;
        border-radius: 20px;
        box-shadow: 5px 5px 20px 5px rgba(0,0,0,0.2), -5px -5px 20px 5px rgba(0,0,0,0.2);
        cursor: pointer;
        transition: 0.3s;
        overflow: hidden;
        position: relative;
    }
    .card .card_image {
        width: 100%;
        height: 100%;
        border-radius: 20px;
    }
    .card .card_image img {
        width: 100%;
        height: 100%;
        border-radius: 20px;
        object-fit: cover;
    }
    .card .card_title {
        text-align: center;
        border-radius: 0 0 20px 20px;
        font-family: sans-serif;
        font-weight: bold;
        font-size: 18px;
        margin-top: -60px;
        height: 40px;
        background-color: rgba(0, 0, 0, 0.5); 
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }
    .card:hover {
        transform: scale(0.9, 0.9);
        box-shadow: 5px 5px 30px 15px rgba(0,0,0,0.25), 
            -5px -5px 30px 15px rgba(0,0,0,0.22);
    }
    .view-more {
        text-align: center;
        margin-top: 20px;
    }
    .view-more a {
        display: inline-block;
        padding: 12px 24px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s;
    }
    .view-more a:hover {
        background-color: #0056b3;
    }
    .title-white {
        color: white;
    }
    .title-black {
        color: black;
    }

        

        
        
        
        
        /* .card {
        margin: 30px auto;
        width: 300px;
        height: 300px;
        border-radius: 40px;
        background-image: url('https://i.redd.it/b3esnz5ra34y.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        background-repeat: no-repeat;
        box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22);
        transition: 0.4s;
        } */
       
        /* If you like this, be sure to ❤️ it. */
    .wrapper {
    height: 100%;
     display: flex;
    align-items: center;
    justify-content: center;
      
    }
    .wrapper a {
    display: inline-block;
    text-decoration: none;
    border-radius: 1px;
    text-transform: uppercase;
    color: #ffffff;
    font-family: 'Roboto', sans-serif;
    }
    /* .modal {
        visibility: hidden;
        opacity: 0;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.8);
        transition: all 0.3s ease;
        z-index: 9999;
    } */
     .modal {
        visibility: hidden;
        opacity: 0;
        position: fixed;
        top: 0; 
        left: 0; 
        right: 0; 
        bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.9);
        transition: all 0.3s ease;
        z-index: 9999;
        padding: 0 !important; /* Pastikan tidak ada padding */
        margin: 0 !important; /* Pastikan tidak ada margin */
    }
    .modal:target {
        visibility: visible;
        opacity: 1;
    }
    .modal__content {
        position: relative;
        width: 90%;
        height: 100%;
        background: #fff;
        padding: 0 !important; /* Hilangkan padding */
        overflow: hidden; /* Ganti dari auto ke hidden */
        border-radius: 0; /* Hilangkan border radius jika perlu */
    }
    .modal__footer {
    text-align: right;
    a {
        color: #585858;
    }
    i {
        color: #d02d2c;
    }
    }
    
    .modal__close {
        position: absolute;
        top: 50px;
        right: 50px;
        font-size: 30px;
        text-decoration: none;
        color: #ff0000;
        font-weight: bold;
        z-index: 10000;
    }
    .modal.active {
        display: flex !important;
        justify-content: center;
        align-items: center;
    }
    .flipbook-container {
        margin-top: 25px; /* disesuaikan dengan tinggi header */
        margin-left: auto;
        margin-right: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 110vh;
        width: 90vw;
        position: relative;
        /* max-width: 90%;
        max-height: 90%; */

        /* margin: 0 !important;  
        padding: 0 !important;  */
    }
    .flipbook {
        width: 1200px;
        height: 720px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        /* box-shadow: none !important;  
        margin: 0 !important;
        padding: 0 !important; */
    }
    .flipbook .hard {
        background: #c03a2b23 !important;
        color: #fff;
        font-weight: bold;
        border: none;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        font-size: 24px;
        /* margin: 0 !important;
        padding: 0 !important;
        overflow: hidden !important; */
    }
    .flipbook .hard small {
        font-style: italic;
        font-weight: lighter;
        opacity: 0.7;
        font-size: 14px;
        margin-top: 10px;
    }
    /* .flipbook .page {
        background: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
         overflow: hidden;
        position: relative;
    } */
    .flipbook .page {
        background: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 0; /* Ubah dari 10px ke 0 */
        overflow: hidden;
        position: relative;
        padding: 0; /* Tambahkan ini */
        margin: 0; /* Tambahkan ini */
    }
    .page img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        margin: 0;
        padding: 0;
        
        background: rgba(255, 255, 255, 0.267);
        /* display: block; */
        /* object-fit: contain !important;  
        margin: 0 !important;
        padding: 0 !important;
        display: block;
        background: white; */
    }
    .magazine-page-image {
        width: 100% !important;
        height: 100% !important;
        max-width: 100% !important;
        max-height: 100% !important;
        /* object-fit: contain !important; */
        object-fit: cover !important;
        /* display: block; */
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
        flex-wrap: wrap; 
        gap: 10px;
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
    
    /* Responsive styles */
    @media (max-width: 1280px) {
        .flipbook {
            margin-top: 0px;
            width: 900px;
            height: 510px;
        }
        .cards-container {
            max-width: 1000px;
            padding: 15px;
        }
    }
    
    @media (max-width: 992px) {
        .flipbook {
            margin-top: 0px;
            width: 700px;
            height: 400px;
        }
        /* .card {
            width: calc(33.333% - 20px);  
        } */
        .cards-list {
            grid-template-columns: repeat(3, 1fr); /* 3 kolom di tablet besar */
            gap: 15px;
        }
        .card {
            height: 220px;
        }
    }
     
    @media (max-width: 768px) {
         .carousel-half {
            height: 40vh; /* setengah layar di desktop */
        }
        .flipbook {
            margin-top: 0px;
            width: 500px;
            height: 300px;
        }
        
        .magazine-controls {
            padding: 5px 15px;
            flex-direction: row;
            justify-content: center;
        }
        .magazine-controls button {
            width: 30px;
            height: 30px;
            font-size: 14px;
        }
        .card {
            height: 200px;
        }
        
        .cards-container {
            padding: 15px 10px;
        }
    }
    
    @media (max-width: 576px) {
        .flipbook {
            margin-top: 0px;
            width: 90vw;
            height: 60vw;
        }
         .magazine-controls {
            padding: 5px 10px;
            gap: 8px;
        }
        .magazine-controls button {
            width: 28px;
            height: 28px;
            font-size: 13px;
        }
        .cards-list {
            grid-template-columns: repeat(2, 1fr); /* Tetap 2 kolom */
            gap: 12px;
        }
        
        .card {
            height: 200px;
        }
        
        .card .card_title {
            font-size: 14px;
            height: 35px;
            margin-top: -45px;
        }
    }
    
    @media all and (max-width: 500px) {
        .card-list {
            /* On small screens, we are no longer using row direction but column */
            flex-direction: column;
        }
        .card {
            flex: 0 0 100%; /* 1 kartu dalam 1 baris */
        }
    }
</style>
