<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Multiple Items</title>
    @include('frontend.layout.css')
    <style>
        /* Tambahkan ke file CSS utama Anda */
        .product-image-small {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 4px;
            margin: 0 auto 5px auto;
            display: block;
        }
        .proof-image {
            width: 150px;
            height: auto;
            max-height: 200px;
            object-fit: contain;
            border: 1px solid #eee;
            border-radius: 4px;
            margin: 0 auto;
            display: block;
        }
        .proof-image-container {
            text-align: center;
            margin: 10px 0;
        }
        .order-table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px 0;
        }
        
        .order-table th, 
        .order-table td {
            padding: 12px 8px;
            vertical-align: middle;
            border: 1px solid #e9ecef;
            vertical-align: middle;
        }
        
        .order-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            text-align: center;
        }
        
        .order-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .order-table tfoot {
            border-top: 2px solid #eee;
        }
        .order-card {
            transition: all 0.3s ease;
        }

        .order-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .product-name {
            display: block;
            margin-top: 5px;
            font-size: 0.95em;
        }
        
        /* Tambahan untuk responsive table */
        .table-responsive {
            overflow-x: auto;
        }

        .btn-shop-now {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 15px;
            transition: background-color 0.3s;
        }

        .btn-shop-now:hover {
            background-color: #3e8e41;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .empty-state i {
            font-size: 60px;
            color: #6c757d;
            margin-bottom: 20px;
        }

        .empty-state h3 {
            color: #343a40;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 20px;
        }
        .order-card.processing {
            border-left: 4px solid #17A2B8;
        }
        
        .order-status.processing {
            background-color: #D1ECF1;
            color: #0C5460;
        }
        
        .proof-section {
            margin: 15px 0;
            padding: 15px;
            background: #F8F9FA;
            border-radius: 8px;
        }
        
        .proof-link {
            align-items: center;
            display: inline-block;
            margin-top: 8px;
            color: #17A2B8;
            font-size: 0.9em;
            text-decoration: none;
        }
        
        .proof-link i {
            margin-right: 8px;
        }
        
        .processing-info {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        
        .processing-step {
            display: flex;
            margin-bottom: 15px;
            position: relative;
            padding-left: 30px;
        }
        
        .processing-step:not(:last-child):after {
            content: '';
            position: absolute;
            left: 12px;
            top: 25px;
            height: 100%;
            width: 2px;
            background: #ddd;
        }
        
        .processing-step.active:not(:last-child):after {
            background: #17A2B8;
        }
        
        .step-icon {
            position: absolute;
            left: 0;
            top: 0;
            width: 24px;
            height: 24px;
            background: #fff;
            border-radius: 50%;
            z-index: 1;
        }
        
        .processing-step.active .step-icon i {
            color: #17A2B8;
        }
        
        .processing-step .step-icon i {
            color: #ddd;
        }
        
        .step-content h5 {
            margin: 0 0 5px 0;
            font-size: 16px;
        }
        
        .step-content p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }
        
        .fa-cog.fa-spin {
            margin-right: 8px;
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
        .product-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .proof-image:hover {
            opacity: 0.9;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transform: scale(1.02);
            transition: all 0.3s ease;
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
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            background-color: #f9fafb;
        }

        .file-upload-label:hover {
            border-color: #3498db;
            background-color: #f0f7ff;
        }

        .file-upload-content {
            pointer-events: none;
        }

        .file-upload-label i {
            font-size: 2.5rem;
            color: #3498db;
            margin-bottom: 10px;
        }

        .file-upload-text {
            display: block;
            font-size: 1rem;
            color: #374151;
            margin-bottom: 5px;
        }

        .file-upload-hint {
            font-size: 0.85rem;
            color: #6b7280;
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
        .text-center {
            text-align: center !important;
        }

        .text-right {
            text-align: right !important;
        }

        @media (max-width: 768px) {
            .payment-card {
                padding: 20px;
            }
            
            .payment-title {
                font-size: 1.3rem;
            }
            .order-table {
                font-size: 0.9em;
            }
            
            .order-table th, 
            .order-table td {
                padding: 8px 5px;
            }
            
            .product-image-small {
                width: 30px;
                height: 30px;
            }
        }
        @media (max-width: 576px) {
            .order-table {
                font-size: 0.85em;
            }
            
            .order-table td, .order-table th {
                padding: 0.5rem;
            }
            
            .product-image-small {
                width: 30px;
                height: 30px;
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
                
                <h2 class="cart-title">Pesanan Sedang Diproses</h2>

                @if(count($groupedOrders) > 0)
                    @foreach($groupedOrders as $order)
                        <div class="order-card processing">
                            <div class="order-header">
                                <h4>Kode Transaksi: {{ $order['transaction_code'] }}</h4>
                                <p class="order-date">{{ $order['updated_at']->format('d M Y H:i') }}</p>
                            </div>
                            
                            <div class="order-status processing">
                                <i class="fas fa-cog fa-spin"></i> Sedang Diproses Admin
                            </div>
                            
                            <!-- Tampilkan foto produk jika ada -->
                            {{-- @if($order['photo'])
                            <div class="order-photo-section"> --}}
                                {{-- <h5>Foto Produk:</h5>
                                <div class="product-photo-container">
                                    <img src="{{ asset( $order->product->image) }}
                                     
                                        alt="Foto Produk {{ $order['transaction_code'] }}" 
                                        class="product-photo">
                                </div> --}}
                            {{-- </div> --}}
                            {{-- @endif --}}
                            
                            @if($order['proof_of_payment'])
                                <div class="proof-section">
                                    <h5>Bukti Pembayaran:</h5>
                                    <div class="proof-image-container">
                                        <a href="{{ asset( $order['proof_of_payment']) }}" target="_blank">
                                            <img src="{{ asset( $order['proof_of_payment']) }}" 
                                                alt="Bukti Pembayaran" 
                                                class="proof-image">
                                        </a>
                                        <a href="{{ asset( $order['proof_of_payment']) }}" target="_blank" class="proof-link">
                                            <i class="fas fa-expand"></i> Lihat Full Size
                                        </a>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="table-responsive">
                                <table class="order-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Produk</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-center">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order['items'] as $item)
                                            <tr>
                                                <td>
                                                    <div class="product-info text-center">
                                                        @if ($item->product && $item->product->image)
                                                            <img src="{{ asset($item->product->image) }}" 
                                                                alt="{{ $item->product->name }}" 
                                                                class="product-image-small">
                                                            <span class="product-name">{{ $item->product->name }}</span>

                                                        {{-- @elseif ($item->photo && $item->photo->cover) --}}
                                                            {{-- <img src="{{ asset( $item->photo->cover) }}" 
                                                                alt="{{ $item->photo->title }}" 
                                                                class="product-image-small">
                                                            <span class="product-name">{{ $item->photo->title }}</span> --}}

                                                        {{-- @elseif ($item->photo)
                                                            <div class="no-image-placeholder">
                                                                <i class="fas fa-image"></i>
                                                            </div>
                                                            <span class="product-name">{{ $item->photo->title ?? 'Foto tidak tersedia' }}</span> --}}

                                                        @else
                                                            <div class="product-deleted">
                                                                <i class="fas fa-exclamation-triangle"></i> Produk atau foto tidak tersedia
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    @if ($item->product)
                                                        Rp{{ number_format($item->product->price, 0, ',', '.') }}
                                                    {{-- @elseif ($item->photo)
                                                        Rp{{ number_format($item->amount / max($item->qty, 1), 0, ',', '.') }} --}}
                                                    @else
                                                        Rp0
                                                    @endif

                                                </td>

                                                <td class="text-center">{{ $item->qty }}</td>

                                                <td class="text-center">
                                                    Rp{{ number_format($item->amount, 0, ',', '.') }}
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-right"><strong>Total</strong></td>
                                            <td class="text-center"><strong>Rp{{ number_format($order['total_amount'], 0, ',', '.') }}</strong></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            
                            <div class="processing-info">
                                <div class="processing-step active">
                                    <div class="step-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="step-content">
                                        <h5>Pembayaran Diterima</h5>
                                        <p>Pembayaran telah diverifikasi oleh sistem</p>
                                        <p class="step-time">{{ $order['updated_at']->format('d M Y H:i') }}</p>
                                    </div>
                                </div>
                                
                                <div class="processing-step {{ $order['has_deleted_product'] ? 'warning' : 'active' }}">
                                    <div class="step-icon">
                                        @if($order['has_deleted_product'])
                                            <i class="fas fa-exclamation-circle"></i>
                                        @else
                                            <i class="fas fa-check-circle"></i>
                                        @endif
                                    </div>
                                    <div class="step-content">
                                        <h5>Pesanan Diproses</h5>
                                        @if($order['has_deleted_product'])
                                            <p class="text-warning">Ada produk yang tidak tersedia. Silakan hubungi admin.</p>
                                        @else
                                            <p>Admin sedang memproses pesanan Anda</p>
                                        @endif
                                        <p class="step-time">Sedang diproses</p>
                                    </div>
                                </div>
                                
                                <div class="processing-step">
                                    <div class="step-icon">
                                        <i class="far fa-circle"></i>
                                    </div>
                                    <div class="step-content">
                                        <h5>Pesanan Dikirim</h5>
                                        <p>Pesanan akan dikirim setelah diproses</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-order">
                        <i class="fas fa-shopping-basket"></i>
                        <h4>Tidak ada pesanan yang sedang diproses</h4>
                        <p>Anda belum memiliki pesanan dengan status "Sedang Diproses"</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Katalog Produk
                        </a>
                    </div>
                @endif
            </div>
        </main>    

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')

    </body>
</html>