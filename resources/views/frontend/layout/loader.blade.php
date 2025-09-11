<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotografer Indonesia Loader</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
        }

        .loader-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .camera-container {
            position: relative;
            width: 200px;
            height: 120px;
            margin-bottom: 30px;
        }

        /* Garis merah yang bergerak */
        .red-line {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, #ff0000, #ff4444);
            border-radius: 2px;
            animation: redLineMove 2s ease-in-out forwards;
            transform-origin: left;
        }

        /* Kamera FontAwesome Icon */
        .camera-icon {
            position: absolute;
            /* top: -10px; */
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            font-size: 4rem;
            color: #fff;
            animation: cameraAppear 1.5s ease-out 2s forwards;
            overflow: hidden;
            /* height: 40px;   */
            width: 80px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .camera-icon i {
            display: block;
            position: relative;
            top: -15px; /* Menggeser ikon ke atas untuk menampilkan setengah bagian */
            line-height: 1;
        }

        /* Typography */
        .typography {
            text-align: center;
            opacity: 0;
            animation: typographyAppear 1s ease-out 3.5s forwards;
        }

        .main-text {
            font-size: 2.5rem;
            font-weight: bold;
            color: #fff;
            letter-spacing: 3px;
            margin: 0;
            transform: translateY(20px);
            animation: textSlideUp 1s ease-out 3.5s forwards;
        }

        .sub-text {
            font-size: 1.2rem;
            color: #ccc;
            letter-spacing: 8px;
            margin: 5px 0 0 0;
            transform: translateY(20px);
            animation: textSlideUp 1s ease-out 4s forwards;
        }

        /* Animasi garis merah - tetap muncul setelah selesai */
        @keyframes redLineMove {
            0% {
                width: 0;
                left: 0;
            }
            100% {
                width: 100%;
                left: 0;
            }
        }

        /* Animasi kamera muncul */
        @keyframes cameraAppear {
            0% {
                opacity: 0;
                transform: translateX(-50%) scale(0.3) rotateY(-90deg);
            }
            30% {
                opacity: 0.3;
                transform: translateX(-50%) scale(0.7) rotateY(-45deg);
            }
            70% {
                opacity: 0.8;
                transform: translateX(-50%) scale(1.1) rotateY(15deg);
            }
            100% {
                opacity: 1;
                transform: translateX(-50%) scale(1) rotateY(0deg);
            }
        }

        /* Animasi typography muncul */
        @keyframes typographyAppear {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes textSlideUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animasi berulang setelah selesai */
        .loader-container.completed {
            animation: pulse 2s ease-in-out infinite 5s;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-text {
                font-size: 2rem;
                letter-spacing: 2px;
            }
            
            .sub-text {
                font-size: 1rem;
                letter-spacing: 4px;
            }
            
            .camera-icon {
                font-size: 3rem;
                height: 30px;
                width: 60px;
            }
            
            .camera-icon i {
                top: -12px;
            }
        }

        @media (max-width: 480px) {
            .main-text {
                font-size: 1.5rem;
                letter-spacing: 1px;
            }
            
            .sub-text {
                font-size: 0.8rem;
                letter-spacing: 2px;
            }
            
            .camera-icon {
                font-size: 2.5rem;
                height: 25px;
                width: 50px;
            }
            
            .camera-icon i {
                top: -10px;
            }
        }
    </style>
</head>
<body>
    <div class="loader-container" id="loaderContainer">
        <div class="camera-container">
            <!-- Garis merah bergerak -->
            <div class="red-line"></div>
            
            <!-- Kamera FontAwesome Icon -->
            <div class="camera-icon">
                <i class="fa-sharp fa-solid fa-camera"></i>
                {{-- <i class="fa-sharp fa-regular fa-camera"></i> --}}
            </div>
        </div>
        
        <!-- Typography -->
        <div class="typography">
            <h1 class="main-text">FOTOGRAFER</h1>
            <p class="sub-text">INDONESIA</p>
        </div>
    </div>

    <script>
        // Menambahkan class completed setelah animasi selesai
        setTimeout(() => {
            document.getElementById('loaderContainer').classList.add('completed');
        }, 5000);

        // Optional: Restart animasi setelah beberapa detik
        setTimeout(() => {
            location.reload();
        }, 10000);
    </script>
</body>
</html>