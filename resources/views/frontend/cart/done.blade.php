<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.css')
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .order-card.completed {
            border-left: 4px solid #28a745;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        
        .order-card.completed:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .order-header {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }
        
        .order-code-status {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 5px;
        }
        .order-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 600;
        }
        
        .order-badge.completed {
            background-color: #d4edda;
            color: #155724;
        }
        
        .order-date {
            color: #6c757d;
            font-size: 0.9em;
        }
        .order-summary {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .delivery-info {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }
        
        .delivery-info h5 {
            margin-top: 0;
            color: #343a40;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .delivery-details {
            white-space: pre-line;
            line-height: 1.6;
        }
        
        .order-details-toggle {
            margin-bottom: 15px;
        }
        .toggle-icon {
            transition: transform 0.3s ease;
        }
        .order-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-reorder {
            background-color: #e2e3e5;
            color: #383d41;
            border: 1px solid #d6d8db;
        }
        
        .btn-reorder:hover {
            background-color: #d6d8db;
        }
        
        .btn-download-invoice {
            background-color: #17a2b8;
            color: white;
            border: 1px solid #17a2b8;
        }
        
        .btn-download-invoice:hover {
            background-color: #138496;
            color: white;
        }
        .table-responsive {
            overflow-x: auto;
        }
        
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        
        .order-table th, 
        .order-table td {
            padding: 12px 8px;
            border: 1px solid #dee2e6;
            vertical-align: middle;
        }
        
        .order-table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        
        .product-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .product-image-small {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .product-text {
            display: flex;
            flex-direction: column;
        }
        
        .product-name {
            font-weight: 500;
        }

        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-top: 20px;
        }
        
        .empty-icon {
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
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
        }
        
        .btn-primary:hover {
            background-color: #0069d9;
            color: white;
        }
        .toggle-details-btn[aria-expanded="true"] .toggle-icon {
            transform: rotate(180deg);
        }
        
        .toggle-details-btn {
            background: none;
            border: none;
            color: #007bff;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 0;
            font-weight: 500;
        }
        
        .toggle-details-btn:hover {
            color: #0056b3;
            text-decoration: underline;
        }
        .summary-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #495057;
        }
        
        .summary-item i {
            color: #6c757d;
        }
        .cart-status-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 20px;
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
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .btn-continue, .btn-checkout {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-continue {
            background-color: #f8f9fa;
            color: #333;
            border: 1px solid #ddd;
        }
        
        .btn-continue:hover {
            background-color: #e9ecef;
            border-color: #ccc;
        }
        
        .btn-continue i {
            font-size: 14px;
        }
        
        .checkout-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-checkout {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
            position: relative;
        }
        
        .btn-checkout:hover {
            background-color: #218838;
        }
        
        .btn-checkout:disabled {
            background-color: #cccccc;
            cursor: not-allowed;
            opacity: 0.7;
        }
        .badge {
            background-color: rgba(0,0,0,0.2);
            border-radius: 10px;
            padding: 2px 8px;
            font-size: 12px;
            margin-left: 5px;
        }
        
        .dropdown-options {
            position: relative;
            display: inline-block;
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
        .btn-options {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            color: #333;
            width: 40px;
            height: 40px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-options:hover {
            background-color: #e9ecef;
        }
        
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: white;
            min-width: 200px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 6px;
            z-index: 100;
            padding: 5px 0;
            margin-top: 5px;
        }
        
        .dropdown-item {
            width: 100%;
            text-align: left;
            padding: 8px 15px;
            background: none;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #333;
            cursor: pointer;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        
        .dropdown-item i {
            width: 18px;
            text-align: center;
        }
        
        .dropdown-options:hover .dropdown-menu {
            display: block;
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
                width: 50%;
                 flex-grow: 1;

            }
            .checkout-group {
                width: 100%;
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
            
            <h2 class="cart-title">Riwayat Pesanan Selesai</h2>

            @if(count($completedOrders) > 0)
                @foreach($completedOrders as $order)
                    <div class="order-card completed">
                        <div class="order-header">
                            <div class="order-code-status">
                                <h4>Kode Transaksi: {{ $order['transaction_code'] }}</h4>
                                <span class="order-badge completed">
                                    <i class="fas fa-check-circle"></i> Selesai
                                </span>
                            </div>
                            <p class="order-date">Selesai pada: {{ $order['completed_at']->format('d M Y H:i') }}</p>
                        </div>
                        
                        <div class="order-summary">
                            <div class="summary-item">
                                <i class="fas fa-box-open"></i>
                                <span>{{ $order['total_qty'] }} Produk</span>
                            </div>
                            <div class="summary-item">
                                <i class="fas fa-money-bill-wave"></i>
                                <span>Total: Rp{{ number_format($order['total_amount'], 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        @if(isset($order['delivery_info']) && $order['delivery_info'])
                            <div class="delivery-info">
                                <h5><i class="fas fa-truck"></i> Informasi Pengiriman</h5>
                                <div class="delivery-details">
                                    {!! nl2br(e($order['delivery_info'])) !!}
                                </div>
                            </div>
                        @endif
                        
                        <div class="order-details-toggle">
                            <button class="toggle-details-btn" onclick="toggleOrderDetails('details-{{ $loop->index }}')">
                                <i class="fas fa-list"></i> Lihat Detail Pesanan
                                <i class="fas fa-chevron-down toggle-icon"></i>
                            </button>
                        </div>
                        
                        <div class="order-details" id="details-{{ $loop->index }}" style="display: none;">
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
                                                    <div class="product-info">
                                                        @if($item->product->image)
                                                            <img src="{{ asset($item->product->image) }}" 
                                                                alt="{{ $item->product->name }}" 
                                                                class="product-image-small">
                                                        @endif
                                                        <div class="product-text">
                                                            <span class="product-name">{{ $item->product->name }}</span>
                                                            @if($item->product->sku)
                                                                <small class="text-muted">SKU: {{ $item->product->sku }}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                                                <td class="text-center">{{ $item->qty }}</td>
                                                <td class="text-center">Rp{{ number_format($item->amount, 0, ',', '.') }}</td>
                                            </tr>
                                             @php
                                                $reviewed = $item->product->reviews->isNotEmpty();
                                            @endphp

                                            @if(!$reviewed)
                                            <form action="{{ route('review.submit') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item->product->id }}">

                                                <label>Rating:</label>
                                                <select name="rating" required>
                                                    <option value="">Pilih rating</option>
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <option value="{{ $i }}">{{ $i }} bintang</option>
                                                    @endfor
                                                </select>

                                                <label>Ulasan:</label>
                                                <textarea name="content" required></textarea>

                                                <button type="submit">Kirim Ulasan</button>
                                            </form>
                                            @else
                                                <p><strong>✅ Anda sudah memberi ulasan untuk produk ini.</strong></p>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            
                            <div class="order-actions">
                                <button class="btn btn-reorder" onclick="reorder('{{ $order['transaction_code'] }}')">
                                    <i class="fas fa-redo"></i> Pesan Lagi
                                </button>
                                <a href="{{ route('invoice.download', $order['transaction_code']) }}" class="btn btn-download-invoice">
                                    <i class="fas fa-file-invoice"></i> Unduh Invoice
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <h3>Belum Ada Pesanan Selesai</h3>
                    <p>Anda belum memiliki pesanan yang sudah selesai. Pesanan yang sudah selesai akan muncul di sini.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-bag"></i> Mulai Belanja
                    </a>
                </div>
            @endif
        </div>
    </main>   

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.1/turn.min.js"></script>
    <script>
        function toggleOrderDetails(id) {
            const element = document.getElementById(id);
            const button = element.previousElementSibling.querySelector('.toggle-details-btn');
            
            if (element.style.display === 'none') {
                element.style.display = 'block';
                button.setAttribute('aria-expanded', 'true');
            } else {
                element.style.display = 'none';
                button.setAttribute('aria-expanded', 'false');
            }
        }
        
        function reorder(transactionCode) {
            // Implementasi fungsi pesan lagi
            alert('Fitur pesan lagi untuk transaksi ' + transactionCode + ' akan diimplementasi');
            // Anda bisa menambahkan AJAX atau redirect ke halaman tertentu
        }
    </script>
</body>

</html>