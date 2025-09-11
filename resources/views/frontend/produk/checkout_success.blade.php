{{-- <!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.css')
 

</head>

<body>

   

    <!-- Navbar & Hero End -->

    <!-- Modal Search Start -->
    @include('frontend.layout.header')
    <!-- Modal Search End -->
    <main class="main">
        <h2>Checkout Berhasil!</h2>

        <p>Produk: {{ $transaction->product->name }}</p>
        <p>Total Bayar: Rp{{ number_format($transaction->amount) }}</p>
        <p>Status: {{ $transaction->status }}</p>

        @if ($transaction->proof_of_payment)
            <p>Bukti Pembayaran:</p>
            <img src="{{ asset( $transaction->proof_of_payment) }}" width="200">
        @endif

        @if ($transaction->status == 'Proses')
            <p>Silakan tunggu konfirmasi admin.</p>
        @endif

         </main>     

     <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
</body>

</html> --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Berhasil - {{ $transaction->product->name }}</title>
    @include('frontend.layout.css')
    <style>
        /* Success Page Styles */
        .success-container {
            max-width: 1200px;
            margin: 100px auto 60px;
            padding: 0 15px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        
        .success-header {
            margin-bottom: 30px;
            text-align: center;
        }
        
        .success-header h2 {
            font-size: 28px;
            color: #27ae60;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .success-icon {
            font-size: 40px;
            color: #27ae60;
            margin-bottom: 20px;
        }
        
        .success-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin-bottom: 30px;
            text-align: center;
        }
        
        .order-details {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 20px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .detail-label {
            font-weight: 500;
            color: #555;
        }
        
        .detail-value {
            color: #2c3e50;
        }
        
        .total-value {
            font-weight: bold;
            color: #e74c3c;
            font-size: 18px;
        }
        
        .proof-container {
            margin-top: 30px;
            text-align: center;
        }
        
        .proof-image {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .status-message {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
            border-left: 4px solid #3498db;
        }
        
        .btn-back {
            display: inline-block;
            background: #3498db;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            margin-top: 20px;
        }
        
        .btn-back:hover {
            background: #2980b9;
        }
        
        @media (max-width: 576px) {
            .success-header h2 {
                font-size: 22px;
            }
            
            .detail-row {
                flex-direction: column;
                gap: 5px;
            }
            
            .order-details {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    @include('frontend.layout.header')
    
    <main class="main">
        <div class="success-container">
            <div class="success-header">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2><i class="fas fa-check"></i> Checkout Berhasil!</h2>
            </div>
            
            <div class="success-card">
                <p>Terima kasih telah melakukan pembelian. Pesanan Anda telah kami terima.</p>
                <a href="{{ route('home') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
            
            <div class="order-details">
                <h3 class="section-title"><i class="fas fa-receipt"></i> Detail Pesanan</h3>
                
                <div class="detail-row">
                    <span class="detail-label">Produk:</span>
                    <span class="detail-value">{{ $transaction->product->name }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Total Pembayaran:</span>
                    <span class="detail-value total-value">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value" style="color: 
                        @if($transaction->status == 'Proses') #3498db
                        @elseif($transaction->status == 'Sukses') #27ae60
                        @elseif($transaction->status == 'Gagal') #e74c3c
                        @else #2c3e50 @endif">
                        {{ $transaction->status }}
                    </span>
                </div>
            </div>
            
            @if ($transaction->proof_of_payment)
            <div class="proof-container">
                <h3 class="section-title"><i class="fas fa-file-image"></i> Bukti Pembayaran</h3>
                <img src="{{ asset($transaction->proof_of_payment) }}" alt="Bukti Pembayaran" class="proof-image">
            </div>
            @endif
            
            @if ($transaction->status == 'Proses')
            <div class="status-message">
                <p><i class="fas fa-info-circle"></i> Silakan tunggu konfirmasi admin. Kami akan memverifikasi pembayaran Anda.</p>
            </div>
            @endif
        </div>
    </main>
    
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
</body>
</html>