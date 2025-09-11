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
        }
        
        .table-items th {
            background-color: #f8f9fa23;
        }
        .table-items td {
            background-color: #f8f9fa23;
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
        
        /* Signature styling - MODIFIED: Removed border and shadow */
        .signature-section {
            margin-top: 40px;
        }
        
        .signature-box {
            text-align: center;
            padding: 20px;
        }
        
        .signature-img {
            max-width: 200px;
            height: auto;
            border: none !important;
            box-shadow: none !important;
            background-color: transparent !important;
        }
        
        .signature-line {
            border-bottom: 1px solid #000;
            width: 200px;
            margin: 20px auto 10px auto;
        }

        /* Print-specific styles */
        @media print {
            body {
                background-color: white;
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                font-size: 12pt;
                line-height: 1.2;
            }
            
            .nota-container {
                box-shadow: none;
                padding: 0;
                margin: 0;
                max-width: none;
                width: 100%;
                min-height: auto;
                border-radius: 0;
                line-height: 1.2;
            }
            
            .watermark {
                opacity: 0.08;
                top: 40%;
            }
            
            .no-print {
                display: none !important;
            }
            
            /* Ensure proper spacing in print */
            .info-box {
                background-color: rgba(255, 255, 255, 0.055);
                padding: 10px 0;
                margin-bottom: 10px;
                margin-top: -15px;
            }
            
            /* Fix table printing */
            .table-items {
                width: 100%;
                border-collapse: collapse;
            }
            
            .table-items th, 
            .table-items td {
                padding: 8px;
                border: 1px solid #ddd;
                background-color: rgba(255, 255, 255, 0.082) !important;
            }
            
            /* Prevent page breaks inside important elements */
            .header, 
            .footer,
            .table-items {
                page-break-inside: avoid;
            }
            
            /* Modified signature section for print - side by side */
            .signature-section .row {
                display: flex;
                justify-content: space-between;
            }
            
            .signature-section .col-md-6 {
                width: 48%;
                float: none;
            }
            
            .signature-line {
                margin: 40px auto 10px auto;
            }
            
            /* Keep renter info and photo together */
            .renter-info-container {
                display: flex;
                justify-content: space-between;
                page-break-inside: avoid;
            }
            
            .renter-photo {
                margin-top: 0;
                align-self: flex-start;
            }
            
            /* Keep header sections together */
            .header-row {
                display: flex;
                justify-content: space-between;
                page-break-inside: avoid;
            }
            
            .header-section {
                width: 48%;
            }
            
            /* MODIFIED: Ensure signature images print without borders */
            .signature-img {
                border: none !important;
                box-shadow: none !important;
                background-color: transparent !important;
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
                flex-direction: column;
                margin-top: 20px;
            }
            
            .signature-section .col-md-6 {
                width: 100%;
                margin-bottom: 30px;
            }
            
            .signature-line {
                width: 150px;
                margin: 40px auto 10px auto;
            }
            
            .renter-info-container {
                flex-direction: column;
            }
            
            .renter-photo {
                text-align: left;
                margin-top: 15px;
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
            <div class="mb-3 info-box renter-info-container">
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
                            <th>Harga/Hari</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rental->rentalItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->item->name }}</td>
                            <td>Rp {{ number_format($item->daily_price, 0, ',', '.') }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">Total</th>
                            <th>Rp {{ number_format($rental->total_price, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
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
                
                <!-- Tanda Tangan - MODIFIED: Removed border and shadow -->
                <div class="signature-section">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="signature-box">
                                <p><strong>Penyewa</strong></p>
                                <img src="{{ asset($rental->ttd_peminjam) }}" alt="Tanda Tangan Peminjam" class="signature-img">
                                <div class="signature-line"></div>
                                <p>{{ $rental->renter_name }}</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="signature-box">
                                <p><strong>Hormat Kami</strong></p>
                                <img src="{{ asset('tanda_tangan/ketum.png') }}" alt="Tanda Tangan Penyewa" class="signature-img">
                                <div class="signature-line"></div>
                                <p>{{ auth()->user()->name }}</p>
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

                    <a href="{{ route('rentals.download', $rental->id) }}" class="btn btn-info">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                @endif
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>