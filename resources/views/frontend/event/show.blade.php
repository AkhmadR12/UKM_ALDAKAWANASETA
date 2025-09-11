<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @include('frontend.layout.css')
    <style>
        .container {
            margin-top: 80px;
            margin-bottom: 30px;
        }
        .event-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
             margin: 50px 0 30px 0; /* Atas: 50px, Bawah: 30px */
             
            
        }

        .image-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .image-wrapper img {
            width: 100%;
            height: 230px;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }

        .image-wrapper:hover img {
            transform: scale(1.05);
        }

        .caption-overlay {
            position: absolute;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            width: 100%;
            padding: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
            font-size: 14px;
        }

        .image-wrapper:hover .caption-overlay {
            opacity: 1;
        }
    </style>
    
</head>

<body>
    @include('frontend.layout.header')
    <main class="main">
        <div class="container">
            <h1 class="text-center mb-5">{{ $event->judul }}</h1>
            <h1 class="text-2xl font-bold mb-4"></h1>
            <p class="mb-6 text-gray-700">{{ $event->deskripsi }}</p>

            <div class="event-gallery">
                @foreach ($event->images as $image)
                    <div class="image-wrapper">
                        <img src="{{ asset( $image->image) }}" alt="Event Image">
                        @if($image->caption)
                            <div class="caption-overlay text-center">
                                {{ $image->caption }}
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

    </main>     

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
</body>

</html>