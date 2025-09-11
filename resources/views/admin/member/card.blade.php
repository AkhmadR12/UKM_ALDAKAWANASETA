 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member ID Card</title>
    <style>
       body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        }

        .card-container {
        position: relative;
        width: 270px;
        height: 480px;
        perspective: 1000px;
        cursor: pointer;
        }

        .card-face {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 24px;
        background: #03a9f4;
        color: white;
        backface-visibility: hidden;
        transition: transform 0.8s ease;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        box-sizing: border-box;
        }

        .front {
        z-index: 2;
        transform: rotateY(0deg);
        padding-top: 30px;
        }

        .back {
        transform: rotateY(180deg);
        background: #03a9f4;
        color: white;
        padding: 40px 20px;
        justify-content: center;
        }

        .card-container.flipped .front {
        transform: rotateY(-180deg);
        }

        .card-container.flipped .back {
        transform: rotateY(0deg);
        }

        /* Segitiga atas */
        .card-face.front::before {
        content: "";
        position: absolute;
        top: 0;
        width: 100%;
        height: 140px;
        background: linear-gradient(to bottom, #0288d1 60%, transparent 100%);
        border-top-left-radius: 24px;
        border-top-right-radius: 24px;
        }

        .logo {
        position: relative;
        z-index: 1;
        width: 90px;
        margin-bottom: 20px;
        }

        /* Posisi foto lebih ke bawah */
        .diamond-frame {
        width: 120px;
        height: 120px;
        transform: rotate(45deg);
        overflow: hidden;
        border-radius: 20px;
        border: 4px solid #fff;
        margin-top: 60px; /* turun ke tengah */
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        }

        .profile-img {
        width: 140%;
        height: 140%;
        object-fit: cover;
        transform: rotate(-45deg);
        }

        /* Nama dan kota */
        .nama {
        font-size: 1.4em;
        font-weight: bold;
        margin-bottom: 4px;
        z-index: 1;
        }

        .kota {
        font-size: 0.95em;
        opacity: 0.95;
        margin-bottom: 20px;
        z-index: 1;
        }

        /* Nomor anggota lebih menonjol */
        .nomor {
        font-size: 1.3em;
        font-weight: 800;
        background: white;
        color: #0288d1;
        padding: 8px 14px;
        border-radius: 12px;
        margin-bottom: 20px;
        z-index: 1;
        }

        /* Footer */
        .footer {
        width: 100%;
        background-color: white;
        color: #444;
        font-size: 0.8em;
        padding: 10px 0;
        position: absolute;
        bottom: 0;
        border-bottom-left-radius: 24px;
        border-bottom-right-radius: 24px;
        }

        /* Layer belakang konten */
        .back {
        transform: rotateY(180deg);
        background: #f4b400; /* warna kuning emas yang lebih akurat */
        color: #111;
        padding: 0;
        justify-content: start;
        align-items: center;
        position: relative;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        }

        .back::before {
        content: "";
        position: absolute;
        top: 0;
        width: 100%;
        height: 100px;
        background: linear-gradient(to bottom, #03a9f4 60%, transparent 100%);
        border-top-left-radius: 24px;
        border-top-right-radius: 24px;
        }

        .qr-wrapper {
        margin-top: 60px;
        position: relative;
        width: 140px;
        height: 140px;
        }

        .qr-wrapper img.qr {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background: white;
        padding: 10px;
        border-radius: 16px;
        }

        .back-content {
        margin-top: 20px;
        text-align: center;
        font-size: 0.9em;
        line-height: 1.5em;
        color: #222;
        padding: 0 20px;
        max-width: 90%;
        flex-grow: 1;
        }

        .back-content b {
        color: #000;
        }

        .sponsor-logo {
        width: 100px;
        margin-bottom: 20px;
        }

    </style>
</head>
<body>
    <div class="card-container" id="card">
        <!-- LAYER DEPAN -->
        <div class="card-face front">
          <img src="{{ asset('member_photos/logo.png')}}" alt="Logo Instansi" class="logo" />
    
            <div class="diamond-frame">
                @if($member->photo)
                    <img class="profile-img" src="{{ asset($member->photo) }}" alt="Member Photo">
                @else
                    <div class="profile-img" style="background-color: #ddd; display: flex; align-items: center; justify-content: center;">
                        No Photo
                    </div>
                @endif
            </div>
            <div class="nama">{{ strtoupper($member->name) }}</div>
            <div class="kota">{{ $member->kota->name ?? '-' }}</div>
            <div class="nomor"> {{ $member->id_member }}</div>
            <br>
            {{-- <p><strong>Email:</strong> {{ $member->email ?? 'N/A' }}</p>
                <p><strong>Join Date:</strong> {{ date('d M Y', strtotime($member->tanggal_bergabung)) }}</p> --}}
            <div class="footer">asosiasi.fotografiindonesia.com</div>
        </div>

            <!-- Back Side -->
        <div class="card-face back">
            <div class="mt-4">
                @if($member->barcode_path && file_exists(public_path($member->barcode_path)))
                    <img src="{{ asset($member->barcode_path) }}" 
                         alt="Barcode" 
                         class="img-fluid" 
                         style="width:75%;">
                @else
                    <div class="alert alert-warning">Barcode tidak tersedia</div>
                @endif
                <p class="text-center">{{ $member->id_member }}</p>
            </div>
            <div class="back-content" style="font-size:11px">
            <p>Kartu ini milik<br><b>Asosiasi Fotografi Indonesia (AFI)</b><br>
            apabila menemukan harap menghubungi:</p>
            <p><b>Sekretariat AFI</b><br>
            Ruko Taman Niaga Blok G/7<br>
            Jl. RM Hadisoebeno Sosrowardodjo<br>
            Bukit Semarang Baru Mijen<br>
            Semarang 50212</p>
            <p>0811-2606-900<br>
            asosiasi@fotografiindonesia.com</p>
        </div>
        <img src="{{ asset('member_photos/mandiri.avif')}}" alt="Mandiri Logo" class="sponsor-logo" style="width:50%;"/>
        <br>
            {{-- <p>{{ strtoupper($member->name) }}</p>
            <p><strong>ID:</strong> {{ $member->id_member }}</p> --}}
        </div>
    </div>
        
        {{-- <button class="flip-btn" onclick="document.getElementById('card').classList.toggle('flipped')">
            FLIP CARD
        </button> --}}
     

    <script>
        // Optional: Auto-flip after 5 seconds
        document.getElementById("card").addEventListener("click", function () {
        this.classList.toggle("flipped");
        });

    </script>
</body>
</html>