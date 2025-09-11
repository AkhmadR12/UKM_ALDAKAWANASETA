 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Majalah</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    @include('frontend.layout.css')
    
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        
        .main {
            min-height: calc(100vh - 120px);
            padding: 60px 0 40px;
        }
        
        .section-title {
            margin-bottom: 30px;
            padding-top: 38px;
        }
        
        .section-title p {
            font-size: 1.2rem;
            color: var(--secondary-color);
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
        }
        
        .section-title h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 2px;
        }
        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1px;
        }
        
        .cards-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            background: white;
        }
        
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .card-img-top {
            height: 100%;
            object-fit: cover;
            width: 100%;
        }
        
        .card-body {
            padding: 10px;
        }
        
        .card-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 5px;
        }
        
        .card-text {
            color: #666;
            margin-bottom: 10px;
            flex-grow: 1;
        }
        
        .btn-primary {
            background-color: var(--secondary-color);
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .alert-warning {
            max-width: 800px;
            margin: 0 auto;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            background-color: #fff3cd;
            border-color: #ffeeba;
            color: #856404;
        }
        
        @media (max-width: 768px) {
            .section-title {
                margin-bottom: 30px;
            }
            
            .section-title p {
                font-size: 1rem;
            }
            
            .section-title h2 {
                font-size: 2rem;
            }
            
            .card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    @include('frontend.layout.header')
    
    <!-- Main Content -->
    <main class="main">
        <div class="cards-container">
            <div class="container section-title" data-aos="fade-up" style="text-align: center">
                <h1>FORMULIR MAJALAH</h1>
                <h2></h2>
                <p>Pilih kategori formulir yang tersedia</p>
            </div>
            

            @if($kategoris->isEmpty())
                <div class="alert alert-warning text-center">Belum ada kategori aktif saat ini.</div>
            @else
                <div class="row g-4">
                    @foreach($kategoris as $kategori)
                    <div class="col-lg-3 col-md-5">
                        <div class="card h-100">
                            @if($kategori->gambar)
                                <img src="{{ asset($kategori->gambar) }}" class="card-img-top" alt="{{ $kategori->nama_kategori }}">
                            @else
                                <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 100%;">
                                    <i class="fas fa-image fa-3x text-white"></i>
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $kategori->nama_kategori }}</h5>
                                <p class="card-text">{{ Str::limit($kategori->deskripsi, 100) }}</p>
                                <div class="mt-auto">
                                    <a href="{{ route('public.form-input.create', $kategori->id) }}" class="btn btn-primary w-100">
                                        <i class="fas fa-file-alt me-2"></i>Buka Form
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </main>
    
    <!-- Footer -->
    @include('frontend.layout.footer')
    
    <!-- JavaScript -->
    @include('frontend.layout.js')
    
    <!-- Bootstrap Bundle JS (includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>