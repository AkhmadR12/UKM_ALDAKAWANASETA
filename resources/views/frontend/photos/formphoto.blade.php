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
    <h1>Checkout Produk: {{ $photo->name }}</h1>
    <form action="{{ route('checkout.store', $transaction->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
         
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p>Harga: <strong>Rp{{ number_format($transaction->amount) }}</strong></p>
        <div>
            <label>Upload Bukti Pembayaran:</label>
            <input type="file" name="proof_of_payment" required>
        </div>
        <button type="submit">Kirim Pembayaran</button>
    </form>
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
    <title>Checkout - {{ $photo->name }}</title>
    @include('frontend.layout.css')
    <style>
        /* Base Styles */
        .checkout-container {
            max-width: 1200px;
            margin: 100px auto 60px; /* Tambah jarak dari atas */
            padding: 0 15px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        
        .checkout-header {
            margin-bottom: 30px;
            text-align: center;
        }
        
        .checkout-header h2 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
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
        
        .checkout-form {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
        }
        
        .checkout-card {
            flex: 1;
            min-width: 300px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        .checkout-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .checkout-table th {
            text-align: left;
            padding: 12px 15px;
            background-color: #f8f9fa;
            font-weight: 600;
            color: #555;
        }
        
        .checkout-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .product-col {
            width: 40%;
        }
        
        .price-col, .qty-col, .subtotal-col {
            width: 20%;
        }
        
        .product-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #eee;
        }
        
        .product-name {
            font-weight: 500;
        }
        
        .checkout-summary {
            width: 350px;
        }
        
        .summary-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 20px;
        }
        
        .summary-title {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 15px;
        }
        
        .summary-divider {
            height: 1px;
            background: #eee;
            margin: 15px 0;
        }
        
        .total-row {
            font-size: 16px;
            margin-top: 10px;
            color: #2c3e50;
        }
        
        .shipping-fee {
            color: #3498db;
        }
        
        .grand-total {
            color: #e74c3c;
            font-size: 18px;
        }
        
        .payment-methods {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            padding: 25px;
            margin-bottom: 20px;
        }
        
        .payment-options {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }
        
        .payment-option {
            flex: 1;
        }
        
        .payment-option input {
            display: none;
        }
        
        .payment-content {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .payment-option input:checked + .payment-content {
            border-color: #3498db;
            background-color: #f0f7ff;
        }
        
        .payment-content i {
            font-size: 24px;
            color: #3498db;
        }
        
        .btn-confirm {
            width: 100%;
            background: #27ae60;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-confirm:hover {
            background: #219653;
        }
        
        .file-input-container {
            margin: 20px 0;
        }
        
        .file-input-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #2c3e50;
        }
        
        .file-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background: #f9f9f9;
        }
        
        @media (max-width: 768px) {
            .checkout-form {
                flex-direction: column;
            }
            
            .checkout-summary {
                width: 100%;
            }
            
            .payment-options {
                flex-direction: column;
            }
        }
        
        @media (max-width: 576px) {
            .checkout-header h2 {
                font-size: 22px;
                flex-direction: column;
                gap: 5px;
                text-align: center;
            }

            .checkout-steps {
                flex-direction: column;
                align-items: center;
                gap: 10px;
            }

            .step {
                padding: 10px 0;
            }

            .checkout-form {
                gap: 15px;
            }

            .checkout-card {
                padding: 15px;
            }

            .summary-card,
            .payment-methods {
                padding: 15px;
            }

            .payment-content {
                padding: 10px;
            }

            .btn-confirm {
                padding: 12px;
                font-size: 14px;
            }

            .product-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .product-img {
                width: 100%;
                max-width: 100px;
                height: auto;
            }

            .checkout-table th,
            .checkout-table td {
                padding: 10px;
                font-size: 14px;
            }

            .summary-row {
                font-size: 14px;
            }

            .total-row {
                font-size: 15px;
            }

            .grand-total {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    @include('frontend.layout.header')
    <!-- Modal Search End -->
    <main class="main">
        <div class="checkout-container">
            <div class="checkout-header">
                <h2><i class="fas fa-shopping-cart"></i> Checkout Pesanan</h2>
                <div class="checkout-steps">
                    <div class="step active"><span>1</span> Keranjang</div>
                    <div class="step active"><span>2</span> Checkout dan Pembayaran</div>
                    <div class="step"><span>3</span> Selesai</div>
                </div>
            </div>

            <form action="{{ route('checkoutphoto.store', $transaction->id) }}" method="POST" enctype="multipart/form-data" class="checkout-form">
                @csrf
                
                <div class="checkout-card">
                    <h3 class="section-title"><i class="fas fa-box-open"></i> Detail Produk</h3>
                    
                    <div class="table-responsive">
                        <table class="checkout-table">
                            <thead>
                                <tr>
                                    <th class="product-col">Produk</th>
                                    <th class="price-col">Harga</th>
                                    <th class="qty-col">Jumlah</th>
                                    <th class="subtotal-col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="product-col">
                                        <div class="product-info">
                                            @if($photo->cover)
                                            <img src="{{ asset($photo->cover) }}" alt="{{ $photo->name }}" class="product-img">
                                            @endif
                                            <span class="product-name">{{ $photo->name }}</span>
                                            <span class="badge">{{ ucfirst($transaction->type) }}</span>
                                        </div>
                                    </td>
                                    <td class="price-col">Rp{{ number_format($transaction->amount / $transaction->qty, 0, ',', '.') }}</td>
                                    <td class="qty-col">{{ $transaction->qty }}</td>
                                    <td class="subtotal-col">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="file-input-container">
                        <label class="file-input-label"><i class="fas fa-file-upload"></i> Upload Bukti Pembayaran:</label>
                        <input type="file" name="proof_of_payment" class="file-input" required>
                    </div>
                </div>

                <div class="checkout-summary">
                    <div class="summary-card">
                        <h3 class="summary-title"><i class="fas fa-receipt"></i> Ringkasan Pesanan</h3>
                        
                        <div class="summary-row">
                            <span>Subtotal Produk</span>
                            <span>Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Ongkos Kirim</span>
                            <span class="shipping-fee">Termasuk</span>
                        </div>
                        
                        <div class="summary-divider"></div>
                        
                        <div class="summary-row total-row">
                            <strong>Total Pembayaran</strong>
                            <strong class="grand-total">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                    
                    <div class="payment-methods">
                        <h3 class="section-title"><i class="fas fa-credit-card"></i> Metode Pembayaran</h3>
                        <div class="payment-options">
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="bank_transfer" checked>
                                <div class="payment-content">
                                    <i class="fas fa-university"></i>
                                    <span>Transfer Bank</span>
                                </div>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="e-wallet">
                                <div class="payment-content">
                                    <i class="fas fa-wallet"></i>
                                    <span>E-Wallet</span>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-confirm">
                        <i class="fas fa-paper-plane"></i> Konfirmasi Pesanan
                    </button>
                </div>
            </form>
        </div>
    </main>     
    
    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
</body>
</html>