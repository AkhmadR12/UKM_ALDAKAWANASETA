<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Card - {{ $member->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .card-container {
            perspective: 1000px;
            width: 400px;
        }
        
        .member-card {
            width: 100%;
            height: 250px;
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 25px;
            color: white;
            position: relative;
            overflow: hidden;
            transition: transform 0.5s;
            transform-style: preserve-3d;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .logo {
            font-weight: 700;
            font-size: 20px;
        }
        
        .member-status {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .member-photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 3px solid white;
            object-fit: cover;
            position: absolute;
            right: 25px;
            top: 70px;
        }
        
        .member-info {
            width: 60%;
        }
        
        .member-name {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .member-id {
            font-size: 14px;
            opacity: 0.8;
            margin-bottom: 15px;
        }
        
        .member-detail {
            font-size: 13px;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
        }
        
        .member-detail i {
            margin-right: 8px;
            font-size: 14px;
        }
        
        .card-footer {
            position: absolute;
            bottom: 20px;
            left: 25px;
            right: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
        }
        
        .join-date {
            opacity: 0.7;
        }
        
        .barcode {
            height: 30px;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 120px;
            font-weight: 800;
            opacity: 0.05;
            pointer-events: none;
            z-index: 1;
        }
        
        .status-open { background-color: #ff4757; }
        .status-inpg { background-color: #2ed573; }
        .status-other { background-color: #576574; }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="card-container">
        <div class="member-card">
            <div class="watermark">MEMBER</div>
            
            <div class="card-header">
                <div class="logo">COMPANY LOGO</div>
                <div class="member-status 
                    @if($member->status == 'OPEN') status-open
                    @elseif($member->status == 'INPG') status-inpg
                    @else status-other @endif">
                    {{ $member->status }}
                </div>
            </div>
            
            <img src="{{ asset($member->photo) }}" alt="Member Photo" class="member-photo">
            
            <div class="member-info">
                <div class="member-name">{{ $member->name }}</div>
                <div class="member-id">ID: {{ $member->id_member }}</div>
                
                <div class="member-detail">
                    <i class="fas fa-phone"></i>
                    <span>{{ $member->phone }}</span>
                </div>
                
                <div class="member-detail">
                    <i class="fas fa-envelope"></i>
                    <span>{{ $member->email }}</span>
                </div>
                
                <div class="member-detail">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $member->kota->name ?? 'N/A' }}</span>
                </div>
            </div>
            
            <div class="card-footer">
                <div class="join-date">
                    Bergabung: {{ $member->tanggal_bergabung->format('d M Y') }}
                </div>
                <img src="{{ asset($member->barcode_path) }}" alt="Barcode" class="barcode">
            </div>
        </div>
    </div>
</body>
</html>