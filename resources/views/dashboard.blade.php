{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POTó Loader Animation</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
            opacity: 0;
            transition: opacity 1s ease;
        }

        .loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loader-container {
            position: relative;
            width: 300px;
            height: 200px;
            background-color: #fffefe;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .horizontal-line {
            position: absolute;
            height: 3px;
            background-color: black;
            transform: scaleX(0);
            width: 100%;
        }

        .top-line {
            top: 0;
            transform-origin: right;
            animation: slideFromRight 1.2s ease forwards;
        }

        .bottom-line {
            bottom: 40px;
            /* Memposisikan garis di atas area since 2023 */
            transform-origin: left;
            animation: slideFromLeft 1.2s ease forwards;
        }

        .content-area {
            position: relative;
            height: calc(100% - 40px);
            /* Menyesuaikan tinggi konten agar tidak tumpang tindih dengan since 2023 */
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .logo-container {
            position: relative;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .letter {
            opacity: 0;
            font-weight: bold;
            font-size: 40px;
            color: black;
        }

        .letter-p {
            animation: fadeInFromBottom 0.6s ease 1.2s forwards;
        }

        .letter-o {
            animation: drawCircle 0.8s ease 1.8s forwards;
        }

        .letter-t {
            animation: fadeInFromTop 0.6s ease 2.4s forwards;
        }

        .letter-o-accent {
            position: relative;
            animation: drawCircle 0.8s ease 3s forwards;
        }

        .accent {
            position: absolute;
            top: -3px;
            right: -3px;
            font-size: 12px;
            opacity: 0;
            animation: fadeIn 0.4s ease 3.6s forwards;
        }

        .tagline {
            font-size: 12px;
            margin-top: 5px;
            opacity: 0;
            transform: translateX(-50px);
            animation: slideInFromLeft 0.9s ease 3.8s forwards;
        }

        .bottom-content {
            position: absolute;
            bottom: 5px;
            width: 100%;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .year-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            opacity: 0;
            animation: fadeIn 0.6s ease 4.5s forwards;
        }

        .since {
            font-size: 10px;
        }

        .year {
            font-size: 12px;
        }

        @keyframes slideFromRight {
            0% {
                transform: scaleX(0);
            }

            100% {
                transform: scaleX(1);
            }
        }

        @keyframes slideFromLeft {
            0% {
                transform: scaleX(0);
            }

            100% {
                transform: scaleX(1);
            }
        }

        @keyframes fadeInFromBottom {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInFromTop {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes drawCircle {
            0% {
                opacity: 0;
                transform: scale(0);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes slideInFromLeft {
            0% {
                opacity: 0;
                transform: translateX(-50px);
            }

            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .hide-loader {
            opacity: 0;
            visibility: hidden;
        }

        .show-content {
            opacity: 1;
        }
    </style>
</head>

<body>
    <!-- Loader Animation -->
    <div class="loader-wrapper" id="loader">
        <div class="loader-container">
            <div class="horizontal-line top-line"></div>

            <div class="content-area">
                <div class="logo-container">
                    <span class="letter letter-p">P</span>
                    <span class="letter letter-o">O</span>
                    <span class="letter letter-t">T</span>
                    <div class="letter letter-o-accent">ó
                        <span class="accent">™</span>
                    </div>
                </div>

                <div class="tagline">Flowing with Purpose</div>
            </div>

            <div class="horizontal-line bottom-line"></div>

            <div class="bottom-content">
                <div class="year-container">
                    <span class="since">since</span>
                    <span class="year">2023</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content (yang akan muncul setelah animasi loader selesai) -->
    <div class="main-content" id="mainContent">
        <h1>Selamat Datang di Website POTó</h1>
        <!-- Konten website Anda akan di sini -->
    </div>

    <script>
        // Fungsi untuk menghilangkan loader dan menampilkan konten utama
        function hideLoader() {
            document.getElementById('loader').classList.add('hide-loader');
            document.getElementById('mainContent').classList.add('show-content');
        }

        // Menunggu semua animasi selesai (sekitar 5.3 detik) lalu menyembunyikan loader
        setTimeout(hideLoader, 5300);
    </script>
</body>

</html>
