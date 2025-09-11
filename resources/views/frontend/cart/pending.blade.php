<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Multiple Items</title>
    @include('frontend.layout.css')
    <style>
        /* Style untuk halaman pending */
        .order-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            padding: 20px;
            border-left: 4px solid #FFA500;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .order-status {
            padding: 8px 12px;
            border-radius: 4px;
            font-weight: bold;
            margin-bottom: 15px;
            display: inline-flex;
            align-items: center;
        }

        .order-status.pending {
            background-color: #FFF3CD;
            color: #856404;
        }

        .order-status i {
            margin-right: 8px;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .order-table th, .order-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        .order-table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 10px;
        }

        .payment-form-container {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .file-upload-wrapper {
            position: relative;
            margin-bottom: 15px;
        }

        .file-upload-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-upload-label {
            display: block;
            border: 2px dashed #ddd;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s;
        }

        .file-upload-label:hover {
            border-color: #4CAF50;
            background-color: rgba(76, 175, 80, 0.05);
        }

        .file-upload-content {
            pointer-events: none;
        }

        .file-upload-text {
            display: block;
            margin: 10px 0 5px;
            font-weight: 600;
            color: #333;
        }

        .file-upload-hint {
            color: #777;
            font-size: 0.9em;
        }

        .btn-submit-payment {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn-submit-payment:hover {
            background-color: #3e8e41;
        }

        .img-preview {
            max-width: 200px;
            max-height: 200px;
            border-radius: 4px;
            margin-top: 10px;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
        }

        .empty-state i {
            font-size: 60px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            color: #555;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #777;
            margin-bottom: 20px;
        }

        .cart-status-tabs {
            display: flex;
            gap: 1rem;
            /* margin-bottom: 2px; */
            padding: 80px 0 ;
        }

        .cart-status-tabs a {
            padding: 8px 16px;
            background-color: #eee;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .cart-status-tabs a:hover {
            background-color: #ddd;
        }

        .cart-status-tabs a.active {
            background-color: #007bff;
            color: white;
        }
        .payment-container {
            max-width: 1200px;
            margin: 100px auto 60px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 30px;
        }

        .payment-card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
            border: 1px solid #eaeaea;
        }

        .payment-title {
            color: #2c3e50;
            font-size: 1.5rem;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .payment-title i {
            color: #3498db;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #34495e;
            font-size: 0.95rem;
        }

         

        .file-preview {
            margin-top: 15px;
            display: none;
        }

        .file-preview img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 5px;
            border: 1px solid #eaeaea;
        }

        .btn-submit {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .btn-submit:active {
            transform: translateY(0);
        }
        .checkout-steps {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        
        .step {
            position: relative;
            padding: 0 30px;
            color: #95a5a6;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .step span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #ecf0f1;
            color: #95a5a6;
            margin-bottom: 8px;
            font-weight: bold;
        }
        
        .step.active {
            color: #3498db;
        }
        
        .step.active span {
            background: #3498db;
            color: white;
        }
        
        .step:not(:last-child):after {
            content: '';
            position: absolute;
            top: 15px;
            right: -15px;
            width: 30px;
            height: 2px;
            background: #ecf0f1;
        }

        @media (max-width: 768px) {
            .payment-card {
                padding: 20px;
            }
            
            .payment-title {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
       @include('frontend.layout.header')
        <main class="main">
            <div class="cart-container">
                <div class="cart-status-tabs">
                    <a href="{{ route('cart.index') }}" class="{{ request()->routeIs('cart.index') ? 'active' : '' }}">
                        Keranjang
                    </a>
                    <a href="{{ route('cart.pending') }}" class="{{ request()->routeIs('cart.pending') ? 'active' : '' }}">
                        Pending Pembayaran
                    </a>
                    <a href="{{ route('cart.process') }}" class="{{ request()->routeIs('cart.process') ? 'active' : '' }}">
                        Diproses
                    </a>
                    <a href="{{ route('cart.done') }}" class="{{ request()->routeIs('cart.done') ? 'active' : '' }}">
                        Selesai
                    </a>
                </div>
                
                <h2 class="cart-title">Menunggu Pembayaran</h2>

                @if(count($groupedOrders) > 0)
                    @foreach($groupedOrders as $order)
                        <div class="order-card">
                            <div class="order-header">
                                <h4>Kode Transaksi: {{ $order['transaction_code'] }}</h4>
                                <p class="order-date">{{ $order['updated_at']->format('d M Y H:i') }}</p>
                            </div>
                            
                            <div class="order-status pending">
                                <i class="fas fa-clock"></i> Menunggu Pembayaran
                            </div>
                            
                            <!-- Tampilkan foto produk jika ada -->
                            {{-- @if($order['photo'])
                            <div class="order-photo-section">
                                <h5>Foto Produk:</h5>
                                <div class="product-photo-container">
                                    <img src="{{ asset('storage/' . $order['photo']->path) }}" 
                                        alt="Foto Produk {{ $order['transaction_code'] }}" 
                                        class="product-photo">
                                </div>
                            </div>
                            @endif --}}
                            
                            <table class="order-table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order['items'] as $item)
                                        <tr>
                                            <td>
                                                <div class="product-info">
                                                    @if($item->product->image)
                                                        <img src="{{ asset($item->product->image) }}" 
                                                            alt="{{ $item->product->name }}" 
                                                            class="product-image">
                                                    @endif
                                                    <span>{{ $item->product->name }}</span>
                                                </div>
                                            </td>
                                            <td>Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>Rp{{ number_format($item->amount, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Total</strong></td>
                                        <td><strong>Rp{{ number_format($order['total_amount'], 0, ',', '.') }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                            
                            <!-- Form Upload Bukti Pembayaran per Transaksi -->
                            <div class="payment-form-container">
                                <form action="{{ route('cart.pending-store') }}" method="POST" enctype="multipart/form-data" class="payment-form">
                                    @csrf
                                    <input type="hidden" name="transaction_code" value="{{ $order['transaction_code'] }}">
                                    
                                    <!-- Tampilkan bukti pembayaran yang sudah diupload jika ada -->
                                    @if($order['items'][0]->proof_of_payment)
                                    <div class="existing-payment-proof mb-3">
                                        <h5>Bukti Pembayaran Terupload:</h5>
                                        <img src="{{ asset('storage/' . $order['items'][0]->proof_of_payment) }}" 
                                            alt="Bukti Pembayaran" 
                                            class="proof-image">
                                        <p class="text-muted small mt-1">Uploaded at: {{ $order['items'][0]->updated_at->format('d M Y H:i') }}</p>
                                    </div>
                                    @endif
                                    
                                    <div class="form-group">
                                        <label for="proof_of_payment_{{ $order['transaction_code'] }}" class="form-label">
                                            @if($order['items'][0]->proof_of_payment)
                                                Ganti Bukti Transfer
                                            @else
                                                Upload Bukti Transfer
                                            @endif
                                        </label>
                                        <div class="file-upload-wrapper">
                                            <input type="file" 
                                                name="proof_of_payment" 
                                                id="proof_of_payment_{{ $order['transaction_code'] }}" 
                                                @if(!$order['items'][0]->proof_of_payment) required @endif
                                                accept="image/*,.pdf"
                                                class="file-upload-input"
                                                onchange="previewImage(this, 'preview_{{ $order['transaction_code'] }}')">
                                            <label for="proof_of_payment_{{ $order['transaction_code'] }}" class="file-upload-label">
                                                <div class="file-upload-content">
                                                    <i class="fas fa-cloud-upload-alt"></i>
                                                    <span class="file-upload-text">
                                                        @if($order['items'][0]->proof_of_payment)
                                                            Pilih file baru untuk mengganti
                                                        @else
                                                            Pilih file bukti transfer
                                                        @endif
                                                    </span>
                                                    <span class="file-upload-hint">Format: JPG, PNG, PDF (Maks. 2MB)</span>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="image-preview mt-2" id="preview_{{ $order['transaction_code'] }}"></div>
                                    </div>
                                    
                                    <div class="form-actions">
                                        <button type="submit" class="btn-submit-payment">
                                            <i class="fas fa-paper-plane"></i> 
                                            @if($order['items'][0]->proof_of_payment)
                                                Perbarui Bukti Pembayaran
                                            @else
                                                Kirim Bukti Pembayaran
                                            @endif
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">
                        <i class="fas fa-shopping-cart"></i>
                        <h3>Tidak ada pesanan yang menunggu pembayaran</h3>
                        <p>Anda belum memiliki pesanan yang perlu dibayar hari ini.</p>
                        <a href="{{ route('home')  }}" class="btn-shop-now">Belanja Sekarang</a>
                    </div>
                @endif
            </div>
        </main>   

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
        <script>
            function previewImage(input, previewId) {
                const preview = document.getElementById(previewId);
                const file = input.files[0];
                
                if (file) {
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        preview.innerHTML = `
                            <img src="${e.target.result}" class="img-preview" alt="Preview Bukti Pembayaran">
                            <p class="file-name">${file.name}</p>
                        `;
                    }
                    
                    reader.readAsDataURL(file);
                }
            }
        </script>
    </body>
</html>