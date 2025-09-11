    <!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.css')
 
    <style>
        .cart-container {
            margin-top: 40px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 100%;
            margin-left: auto;
            margin-right: auto;
            padding: 60px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .cart-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .cart-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        .cart-table thead {
            background-color: #f8f9fa;
        }
        
        .cart-table th {
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: #555;
            border-bottom: 2px solid #eee;
        }
        
        .cart-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }
        
        .cart-table tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        .cart-total {
            text-align: right;
            font-size: 18px;
            padding: 15px 0;
            border-top: 2px solid #eee;
            margin-top: 20px;
        }
        
        .cart-total strong {
            color: #e53935;
        }
        
        .cart-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        
        .btn-continue {
            background-color: #f8f9fa;
            color: #333;
            border: 1px solid #ddd;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-continue:hover {
            background-color: #e9ecef;
        }
        
        .btn-checkout {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-checkout:hover {
            background-color: #218838;
        }
        
        .btn-checkout:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
        }
        
        .product-name {
            font-weight: 500;
            color: #333;
        }
        
        .product-price, .product-subtotal {
            color: #333;
            font-weight: 500;
        }
        
        .product-quantity {
            color: #666;
        }
        
        @media (max-width: 768px) {
            .cart-table {
                display: block;
                overflow-x: auto;
            }
            
            .cart-actions {
                flex-direction: column;
                gap: 10px;
            }
            
            .btn-continue, .btn-checkout {
                width: 100%;
            }
        }
    </style>

</head>

<body>

   

    <!-- Navbar & Hero End -->

    <!-- Modal Search Start -->
    @include('frontend.layout.header')
    <!-- Modal Search End -->
    <main class="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Pembayaran Berhasil</div>

                        <div class="card-body text-center">
                            <div class="alert alert-success">
                                <h4 class="alert-heading">Terima kasih atas pembelian Anda!</h4>
                                <p>Pembayaran Anda telah berhasil diterima dan sedang diproses.</p>
                            </div>
                            
                            <h4>Detail Pesanan</h4>
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->product->name }}</td>
                                        <td>{{ $transaction->quantity }}</td>
                                        <td>Rp{{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                        <td><span class="badge badge-warning">{{ ucfirst($transaction->status) }}</span></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total Pembayaran</th>
                                        <th colspan="2">Rp{{ number_format($total, 0, ',', '.') }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                            
                            <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Beranda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>     

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
</body>

</html>