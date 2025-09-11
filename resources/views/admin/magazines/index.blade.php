<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    {{-- <link rel="icon" href="../assets/img/logo/fav.ico" type="image/x-icon" /> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/1.0.5/turn.min.js"></script>
    <style>
        .magazine-card {
            transition: transform 0.3s ease;
            height: 100%;
        }
        
        .magazine-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .magazine-cover {
            height: 250px;
            object-fit: cover;
        }
        
        .card-body {
            display: flex;
            flex-direction: column;
        }
        
        .card-text {
            flex-grow: 1;
            margin-bottom: 15px;
        }
        
        .magazine-info {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 10px;
        }
        
        /* Animasi */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translate3d(0, 30px, 0);
            }
            
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
        
        .animated {
            animation-duration: 0.6s;
            animation-fill-mode: both;
        }
        
        .fadeInUp {
            animation-name: fadeInUp;
        }
        
        /* Responsif */
        @media (max-width: 768px) {
            .magazine-cover {
                height: 200px;
            }
        }
    </style>
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
                    <div class="logo-header" data-background-color="blue">
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
                            <li class="nav-home">
                                <a href="#">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Tables</a>
                            </li>

                        </ul>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Majalah</h4>
                                        <a href="{{ route('magazine.create') }}" class="btn btn-primary btn-round ms-auto">
                                            <i class="fa fa-plus"></i>
                                            tambah
                                        </a>
                                        {{-- @endif --}}
                                    </div>
                                       <div class="row mb-4">
                                            <div class="col-md-8 col-lg-6">
                                                <form action="{{ route('magazine.index') }}" method="GET" class="d-flex">
                                                    <input type="text" name="search" class="form-control me-2" placeholder="Cari majalah..." value="{{ request('search') }}">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                </div>                
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                 @if($magazines->isEmpty())
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle me-2"></i> Belum ada majalah yang tersedia.
                                        </div>
                                    </div>
                                </div>
                                @endif
                                
                                <!-- Daftar majalah -->
                                <div class="row">
                                     
                                    @foreach($magazines as $index => $magazine)
                                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                                            <div class="card magazine-card animated fadeInUp" style="animation-delay: {{ $index * 0.1 }}s">
                                                <div class="position-relative">
                                                    <img src="{{ asset($magazine->cover_image) }}" class="card-img-top magazine-cover" alt="{{ $magazine->title }}">
                                                    @if($magazine->is_new)
                                                    <span class="position-absolute top-0 end-0 badge bg-success m-2">Baru</span>
                                                    @endif
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $magazine->title }}</h5>
                                                    <p class="card-text">{{ Str::limit($magazine->description ?? 'Tidak ada deskripsi', 80) }}</p>
                                                    
                                                    <div class="magazine-info">
                                                        <div><i class="fas fa-calendar-alt me-1"></i> {{ $magazine->published_at ? $magazine->published_at->format('d M Y') : 'Belum dipublikasikan' }}</div>
                                                        <div><i class="fas fa-file-alt me-1"></i> {{ count($magazine->pages) }} halaman</div>
                                                    </div>
                                                    
                                                    <a href="{{ route('magazine.show', $magazine->id) }}" class="btn btn-primary w-100">
                                                        <i class="fas fa-book-open me-1"></i> Baca Majalah
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                </div>
                                 {{-- <div class="row mt-4">
                                    <div class="col-12 d-flex justify-content-center">
                                        {{ $magazines->links() }}
                                    </div>
                                </div> --}}
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
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // Lazy load animation
            $(window).on('load', function() {
                $('.animated').each(function(i) {
                    const $this = $(this);
                    setTimeout(function() {
                        $this.addClass('fadeInUp');
                    }, i * 100);
                });
            });
        });
    </script>
</body>

</html>
                