<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @include('frontend.layout.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
 

        .card:hover .overlay {
            opacity: 1;
        }
 
        .event-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin: 50px 0 30px 0;
        }

        .image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transition: all 0.4s ease;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .image-wrapper:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        }

        .image-wrapper img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
            transition: all 0.4s ease;
            border-radius: 15px;
        }

        .image-wrapper:hover img {
            transform: scale(1.08);
            filter: brightness(0.7);
        }

        .caption-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: #fff;
            padding: 30px 20px 20px;
            opacity: 0;
            transform: translateY(100%);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            border-radius: 0 0 15px 15px;
            text-align: center;
        }

        .image-wrapper:hover .caption-overlay {
            opacity: 1;
            transform: translateY(0);
        }

        .contributor-name {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #ffffff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            letter-spacing: 0.5px;
        }

        .social-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .social-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 25px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
        }

        .social-btn:hover {
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .instagram-btn {
            background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        }

        .instagram-btn:hover {
            background: linear-gradient(45deg, #e6683c, #dc2743, #cc2366, #bc1888, #f09433);
        }

        .facebook-btn {
            background: linear-gradient(45deg, #3b5998, #4267B2, #1877F2);
        }

        .facebook-btn:hover {
            background: linear-gradient(45deg, #4267B2, #1877F2, #3b5998);
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
             color: #000 !important;
            text-align: center;
            margin-top: -50px;       /* atau bisa -10px jika ingin lebih naik */
            margin-bottom: -10px;
            position: relative;
                 
        }
        .main h2 {
            color: #000000 !important;
        }



        .page-title::after {
            content: '';
            position: absolute;
            bottom: 70px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            .social-buttons {
                flex-direction: column;
                gap: 8px;
            }
            
            .social-btn {
                width: 100%;
                justify-content: center;
            }
            
            .contributor-name {
                font-size: 16px;
            }
        }
    </style>
    
</head>

<body>
    @include('frontend.layout.header')
    <main class="main">
         
        <div class="container">
             
             <h1 class="page-title">Data Kontributor</h1>


            <div class="row">
                @foreach($redakturs as $redaktur)
                <div class="col-md-3 mb-4">
                   
                    <div class="image-wrapper">
                        <img src="{{ asset($redaktur->image) }}" class="card-img-top" alt="{{ $redaktur->name }}">
                        <div class="caption-overlay">
                            <div class="contributor-name">{{ $redaktur->name }}</div>
                            
                            <div class="social-buttons">
                                @if($redaktur->instagram)
                                    @php
                                        $igUsername = rtrim(str_replace('https://www.instagram.com/', '', $redaktur->instagram), '/');
                                    @endphp
                                    <a href="{{ $redaktur->instagram }}" class="social-btn instagram-btn" target="_blank">
                                        <i class="fab fa-instagram"></i>
                                        {{ $igUsername }}
                                    </a>
                                @endif
                                
                                @if($redaktur->facebook)
                                    @php
                                        $fbUsername = rtrim(str_replace('https://www.facebook.com/', '', $redaktur->facebook), '/');
                                    @endphp
                                    <a href="{{ $redaktur->facebook }}" class="social-btn facebook-btn" target="_blank">
                                        <i class="fab fa-facebook-f"></i>
                                        {{ $fbUsername }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </div>

    </main>     

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>