<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Penyewaan #{{ $rental->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('logo/alas.png') }}" rel="icon">
    <style>
        /* A4 Page Setup */
        @page {
            size: A4;
            margin: 10mm;
            font-size: 15px;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            font-size: 15px; 
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
        
        .nota-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 30px;
            max-width: 210mm;
            min-height: 270mm;
            margin: 30px auto;
            position: relative;
            overflow: hidden;
        }
        
        /* Watermark Logo */
        .watermark {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.15;
            z-index: 1;
            width: 500px;
            height: 500px;
            background-image: url('/logo/alas.png');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            pointer-events: none;
        }
        
        /* Content should be above watermark */
        .content {
            position: relative;
            z-index: 2;
        }
        
        .logo-center {
            text-align: center;
            margin: -5px 0;
        }
        
        .logo-center img {
            max-height: 100px;
        }
        
        .header {
            border-bottom: 2px solid #000000;
            padding-bottom: 5px;
            margin-bottom: 10px;
            margin-top: -10px;
        }
        
        .footer {
            border-top: 4px solid #000000;
            padding-top: 5px;
            margin-top: 5px;
            font-size: 0.9em;
            color: #666;
        }
        
        .table-items {
            width: 100%;
            background-color: rgba(255, 255, 255, 0.089);
            border-collapse: collapse;
        }
        
        .table-items th {
            background-color: #f8f9fa23;
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table-items td {
            background-color: #f8f9fa23;
            border: 1px solid #ddd;
            padding: 8px;
        }
        
        .text-right {
            text-align: right;
        }
        
        .status-badge {
            font-size: 0.9em;
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        /* Info boxes with increased opacity as requested */
        .info-box {
            background-color: rgba(255, 255, 255, 0.082);
            padding: 5px;
            border-radius: 4px;
            margin-bottom: -5px;
        }
        
        /* Photo positioning */
        .renter-photo {
            text-align: right;
            margin-top: -110px;
        }
        
        .renter-photo img {
            border: 3px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            max-width: 120px;
            height: auto;
        }
        
        /* Signature styling - MODIFIED: Clean signature boxes */
        .signature-section {
            margin-top: 30px;
        }
        
        .signature-box {
            text-align: center;
            padding: 15px;
            background: rgba(248, 249, 250, 0.3);
            border-radius: 8px;
            margin-bottom: 20px;
            min-height: 180px;
        }
        
        .signature-img {
            max-width: 150px;
            max-height: 80px;
            height: auto;
            margin: 10px 0;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        
        .signature-line {
            border-bottom: 1px solid #000;
            width: 150px;
            margin: 15px auto 10px auto;
        }

        .signature-name {
            font-weight: bold;
            margin-top: 8px;
        }

        /* Print-specific styles */
        @media print {
            body {
                background-color: white !important;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                font-size: 12pt;
                line-height: 1.3;
            }
            
            .nota-container {
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 !important;
                max-width: none !important;
                width: 100% !important;
                min-height: auto !important;
                border-radius: 0 !important;
                line-height: 1.3;
                background-color: white !important;
            }
            
            .watermark {
                opacity: 0.08 !important;
                top: 40%;
            }
            
            .no-print {
                display: none !important;
            }
            
            /* Ensure proper spacing in print */
            .info-box {
                background-color: rgba(255, 255, 255, 0.055) !important;
                padding: 10px 5px !important;
                margin-bottom: 5px !important;
                border-radius: 4px !important;
            }
            
            /* Fix table printing */
            .table-items {
                width: 100% !important;
                border-collapse: collapse !important;
            }
            
            .table-items th, 
            .table-items td {
                padding: 10px 8px !important;
                border: 1px solid #333 !important;
                background-color: rgba(248, 249, 250, 0.2) !important;
                font-size: 11pt !important;
            }
            
            /* Prevent page breaks inside important elements */
            .header, 
            .footer,
            .table-items,
            .signature-section {
                page-break-inside: avoid !important;
            }
            
            /* Enhanced signature section for print */
            .signature-section {
                margin-top: 40px !important;
                page-break-inside: avoid !important;
            }
            
            .signature-box {
                background: rgba(248, 249, 250, 0.15) !important;
                /* border: 1px solid #ddd !important; */
                border-radius: 6px !important;
                padding: 20px 10px !important;
                margin-bottom: 0 !important;
                min-height: 160px !important;
                display: inline-block !important;
                width: 45% !important;
                vertical-align: top !important;
            }
            
            .signature-section .row {
                display: flex !important;
                justify-content: space-between !important;
                align-items: flex-start !important;
            }
            
            .signature-section .col-md-6 {
                width: 48% !important;
                float: none !important;
                padding: 0 5px !important;
            }
            
            .signature-img {
                max-width: 120px !important;
                max-height: 60px !important;
                margin: 8px auto !important;
            }
            
            .signature-line {
                margin: 20px auto 8px auto !important;
                width: 120px !important;
                border-bottom: 1px solid #000 !important;
            }
            
            .signature-name {
                font-size: 10pt !important;
                margin-top: 5px !important;
            }
            
            /* Keep renter info and photo together */
            .renter-info-container {
                display: flex !important;
                justify-content: space-between !important;
                page-break-inside: avoid !important;
            }
            
            .renter-photo {
                margin-top: 0 !important;
                align-self: flex-start !important;
            }
            
            .renter-photo img {
                border: 2px solid #ccc !important;
                max-width: 100px !important;
            }
            
            /* Keep header sections together */
            .header-row {
                display: flex !important;
                justify-content: space-between !important;
                page-break-inside: avoid !important;
            }
            
            .header-section {
                width: 48% !important;
            }
            
            /* Logo and title */
            .logo-center img {
                max-height: 80px !important;
            }
            
            .logo-center h2 {
                font-size: 16pt !important;
                margin-top: 5px !important;
            }
        }
        
        @media screen and (max-width: 768px) {
            .nota-container {
                margin: 10px;
                padding: 20px;
            }
            
            .watermark {
                width: 300px;
                height: 300px;
            }
            
            /* Mobile responsive adjustments */
            .signature-section .row {
                /* flex-direction: column; */
                margin-top: 20px;
                display: flex;
                flex-wrap: nowrap;
            }
            
            .signature-section .col-md-6 {
                width: 50%;
                margin-bottom: 20px;
            }
            
            .signature-box {
                margin-bottom: 15px;
                min-height: 160px;
            }
            
            .signature-line {
                width: 120px;
            }
            
            .renter-info-container {
                flex-direction: column;
            }
            
            .renter-photo {
                text-align: right;
                /* margin-top: 15px; */
            }
            .header-section {
                width: 48% !important;
            }
            
        }
    </style>
</head>
<body>
    <div class="container nota-container">
        <!-- Watermark Logo -->
        <div class="watermark"></div>
        
        <!-- All content wrapped in content div -->
        <div class="content">
            <!-- Logo di Tengah -->
            <div class="logo-center">
                <img src="{{ asset('logo/alas.png') }}" alt="Logo Perusahaan">
                <h2 class="mt-2">Nota Penyewaan Barang</h2>
            </div>

            <!-- Header Nota -->
            <div class="header info-box">
                <div class="row header-row">
                    <div class="col-md-6 header-section">
                        <h4>Informasi Penyewaan</h4>
                        <p><strong>No. Nota:</strong> #{{ $rental->id }}</p>
                        <p><strong>Tanggal:</strong> {{ $rental->created_at ? \Carbon\Carbon::parse($rental->created_at)->format('d/m/Y') : '' }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge 
                                @if($rental->status == 'approved') bg-success
                                @elseif($rental->status == 'rejected') bg-danger
                                @elseif($rental->status == 'completed') bg-info
                                @else bg-warning text-dark
                                @endif">
                                {{ strtoupper($rental->status) }}
                            </span>
                        </p>
                    </div>
                    @php
                        $start = \Carbon\Carbon::parse($rental->start_date);
                        $end = \Carbon\Carbon::parse($rental->end_date);
                    @endphp

                    <div class="col-md-6 header-section text-end">
                        <h4>Periode Sewa</h4>
                        <p><strong>Mulai:</strong> {{ $start->format('d/m/Y') }}</p>
                        <p><strong>Selesai:</strong> {{ $end->format('d/m/Y') }}</p>
                        <p><strong>Durasi:</strong> {{ $start->diffInDays($end) + 1 }} Hari</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Penyewa -->
            <div class="mb-1 info-box renter-info-container">
                <div>
                    <h4>Informasi Penyewa</h4>
                    <p><strong>Nama:</strong> {{ $rental->renter_name }}</p>
                    <p><strong>No. HP:</strong> {{ $rental->renter_phone }}</p>
                </div>
                @if($rental->renter_photo_path)
                <div class="renter-photo">
                    <p><strong>Foto Penyewa:</strong></p>
                    <img src="{{ asset($rental->renter_photo_path) }}" class="img-thumbnail">
                </div>
                @endif
            </div>

            <!-- Daftar Barang -->
            <div class="info-box">
                <h4>Barang Disewa</h4>
                <table class="table table-bordered table-items">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rental->rentalItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Catatan dan Tanda Tangan -->
            <div class="footer info-box">
                <!-- Catatan -->
                <div class="row">
                    <div class="col-12">
                        <h5>Catatan:</h5>
                        <p>{{ $rental->notes ?? 'Barang dalam kondisi baik saat diserahkan. Mohon untuk menjaga barang dengan baik dan mengembalikan tepat waktu.' }}</p>
                    </div>
                </div>
                
                <!-- Tanda Tangan - ENHANCED: Clean boxes with better styling -->
                <div class="signature-section">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="signature-box">
                                <p><strong>Penyewa</strong></p>
                                @if($rental->ttd_peminjam)
                                    <img src="{{ asset($rental->ttd_peminjam) }}" alt="Tanda Tangan Peminjam" class="signature-img">
                                @endif
                                <div class="signature-line"></div>
                                <p class="signature-name">{{ $rental->renter_name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="signature-box">
                                <p><strong>Ketua Umum</strong></p>
                                <img src="{{ asset('tanda_tangan/ketum.png') }}" alt="Tanda Tangan Penyewa" class="signature-img">
                                <div class="signature-line"></div>
                                <p class="signature-name">Jonathan Naufal Farrel (Rangas)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Aksi -->
           <div class="mt-4 no-print">
                <a href="{{ route('rentals.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                {{-- Kondisi jika status pending --}}
                @if ($rental->status === 'pending')
                    @if (
                        auth()->user()->role === 'admin' ||
                        (auth()->user()->role === 'member' && in_array(auth()->user()->subdep, ['perkap', 'oprasinal']))
                    )
                        <form action="{{ route('rentals.approve', $rental->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Approve
                            </button>
                        </form>
                    @endif
                @else
                    {{-- Jika sudah approved maka tombol cetak & download tampil --}}
                    <button onclick="window.print()" class="btn btn-primary">
                        <i class="fas fa-print"></i> Cetak Nota
                    </button>

                    {{-- <a href="{{ route('rentals.download', $rental->id) }}" class="btn btn-info">
                        <i class="fas fa-download"></i> Download PDF
                    </a> --}}
                @endif
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>

