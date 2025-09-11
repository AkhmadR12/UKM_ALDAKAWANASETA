<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @include('frontend.layout.css')
    <style>
        .event-catalog-container {
            max-width: 1200px;
            margin: 50px auto 0 auto; 
            padding: 20px;
        }

        .event-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .event-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .event-image-container {
            position: relative;
            overflow: hidden;
            height: 300px;
        }

        .event-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .event-image-container:hover .event-img {
            transform: scale(1.05);
        }

        .event-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .event-card:hover .event-actions {
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

        .event-info {
            padding: 20px;
        }

        .event-title {
            margin: 0 0 10px 0;
            font-size: 1.25rem;
            font-weight: 600;
            line-height: 1.4;
        }

        .event-title a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .event-title a:hover {
            color: #007bff;
        }

        .event-date {
            color: #666;
            font-size: 0.85rem;
            margin: 0 0 12px 0;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .event-excerpt {
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

        /* Responsive */
        @media (max-width: 768px) {
            .event-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 20px;
            }

            .event-info {
                padding: 15px;
            }

            .event-title {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            .event-catalog-container {
                padding: 15px;
            }

            .event-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }
        }

        
    </style>

</head>

<body>
    @include('frontend.layout.header')
    <main class="main">
        <div class="event-catalog-container"> 
            <h1 class="text-center mb-5">Event Terkini</h1>

            <div class="event-grid">
                @foreach ($events as $event)
                    <div class="event-card">
                        <div class="event-image-container">
                            @if($event->images->first())
                                <a href="{{ route('acara.show', $event->id) }}">
                                    <img src="{{ asset($event->images->first()->image) }}" class="event-img" alt="{{ $event->judul }}">
                                </a>
                            @endif
                            <div class="event-actions">
                                <a href="{{ route('acara.show', $event->id) }}" class="btn-view-detail" title="Lihat Event">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        <div class="event-info">
                            <h3 class="event-title">
                                <a href="{{ route('acara.show', $event->id) }}">{{ $event->judul }}</a>
                            </h3>
                            <p class="event-excerpt">
                                {{ \Illuminate\Support\Str::words(strip_tags($event->deskripsi), 50, '...') }}
                            </p>
                            <a href="{{ route('acara.show', $event->id) }}" class="btn-read-more">Lihat Detail</a>
                        </div>
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