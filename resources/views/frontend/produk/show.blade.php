<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.css')
    <style>


        .product-tab-panel {
            display: none;
        }

        .product-tab-panel.tab-content-active {
            display: block;
        }

        /* Styling tambahan untuk tab content */
        .product-tab-panel {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
            margin-top: 10px;
        }

        .product-tab-panel h4 {
            margin-bottom: 15px;
            color: #333;
        }

        .product-tab-panel ul {
            list-style: none;
            padding-left: 0;
        }

        .product-tab-panel li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .product-tabs .tabs-header {
            list-style: none;
            display: flex;
            gap: 10px;
            cursor: pointer;
        }

        .tab-header-item.tab-active {
            border-bottom: 3px solid #007bff;
            color: #007bff;
            background-color: #f8f9ff;
        }
        .product-tabs .tabs-header li.active {
            font-weight: bold;
            border-bottom: 2px solid #000;
        }

        .product-tabs .tab-panel {
            display: none;
            margin-top: 10px;
        }

        .product-tabs .tab-panel.active {
            display: block;
        }

        /* Star rating */
        .tab-panel {
            display: none;
        }
        .tab-panel.active {
            display: block;
        }

        .star-rating {
            display: inline-block;
            direction: rtl;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
        }
        .star-rating input:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #ffc107;
        }
        .star-rating input:checked + label {
            color: #ffc107;
        }

        /* Progress bar untuk rating distribution */
        .progress {
            background-color: #f0f0f0;
            border-radius: 10px;
        }

        /* Review item */
        .review-item {
            transition: all 0.3s ease;
        }
        .review-item:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .rating-summary {
                margin-bottom: 20px;
            }
        }
        .pull-right{
        float:right;
        }
        .pull-left{
        float:left;
        }
        #fbcomment{
        background:#fff;
        border: 1px solid #dddfe2;
        border-radius: 3px;
        color: #4b4f56;
        padding:50px;
        }
        .header_comment{
            font-size: 14px;
            overflow: hidden;
            border-bottom: 1px solid #e9ebee;
            line-height: 25px;
            margin-bottom: 24px;
            padding: 10px 0;
        }
        .sort_title{
        color: #4b4f56;
        }
        .sort_by{
        background-color: #f5f6f7;
        color: #4b4f56;
        line-height: 22px;
        cursor: pointer;
        vertical-align: top;
        font-size: 12px;
        font-weight: bold;
        vertical-align: middle;
        padding: 4px;
        justify-content: center;
        border-radius: 2px;
        border: 1px solid #ccd0d5;
        }
        .count_comment{
        font-weight: 600;
        }
        .body_comment{
            padding: 0 8px;
            font-size: 14px;
            display: block;
            line-height: 25px;
            word-break: break-word;
        }
        .avatar_comment{
        display: block;
        }
        .avatar_comment img{
        height: 48px;
        width: 48px;
        }
        .box_comment{
            display: block;
            position: relative;
            line-height: 1.358;
            word-break: break-word;
            border: 1px solid #d3d6db;
            word-wrap: break-word;
            background: #fff;
            box-sizing: border-box;
            cursor: text;
            font-family: Helvetica, Arial, sans-serif;
            font-size: 16px;
            padding: 0;
        }
        .box_comment textarea{
            min-height: 40px;
            padding: 12px 8px;
            width: 100%;
            border: none;
            resize: none;
        }
        .box_comment textarea:focus{
        outline: none !important;
        }
        .box_comment .box_post{
            border-top: 1px solid #d3d6db;
            background: #f5f6f7;
            padding: 8px;
            display: block;
            overflow: hidden;
        }
        .box_comment label{
        display: inline-block;
        vertical-align: middle;
        font-size: 11px;
        color: #90949c;
        line-height: 22px;
        }
        .box_comment button{
        margin-left:8px;
        background-color: #4267b2;
        border: 1px solid #4267b2;
        color: #fff;
        text-decoration: none;
        line-height: 22px;
        border-radius: 2px;
        font-size: 14px;
        font-weight: bold;
        position: relative;
        text-align: center;
        }
        .box_comment button:hover{
        background-color: #29487d;
        border-color: #29487d;
        }
        .box_comment .cancel{
            margin-left:8px;
            background-color: #f5f6f7;
            color: #4b4f56;
            text-decoration: none;
            line-height: 22px;
            border-radius: 2px;
            font-size: 14px;
            font-weight: bold;
            position: relative;
            text-align: center;
        border-color: #ccd0d5;
        }
        .box_comment .cancel:hover{
            background-color: #d0d0d0;
            border-color: #ccd0d5;
        }
        .box_comment img{
        height:16px;
        width:16px;
        }
        .box_result{
        margin-top: 24px;
        }
        .box_result .result_comment h4{
        font-weight: 600;
        white-space: nowrap;
        color: #365899;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
        line-height: 1.358;
        margin:0;
        }
        .box_result .result_comment{
        display:block;
        overflow:hidden;
        padding: 0;
        }
        .child_replay{
            border-left: 1px dotted #d3d6db;
            margin-top: 12px;
            list-style: none;
            padding:0 0 0 8px
        }
        .reply_comment{
            margin:12px 0;
        }
        .box_result .result_comment p{
        margin: 4px 0;
        text-align:justify;
        }
        .box_result .result_comment .tools_comment{
        font-size: 12px;
        line-height: 1.358;
        }
        .box_result .result_comment .tools_comment a{
        color: #4267b2;
        cursor: pointer;
        text-decoration: none;
        }
        .box_result .result_comment .tools_comment span{
        color: #90949c;
        }
        .body_comment .show_more, .body_comment .show_less{
        background: #3578e5;
        border: none;
        box-sizing: border-box;
        color: #fff;
        font-size: 14px;
        margin-top: 24px;
        padding: 12px;
        text-shadow: none;
        width: 100%;
        font-weight:bold;
        position: relative;
        text-align: center;
        vertical-align: middle;
        border-radius: 2px;
        }
        .product-detail-container {
        max-width: 1200px;
        margin: 50px auto 0 auto;
        padding: 2rem 1rem;
        }

        .product-detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .product-gallery {
            position: relative;
        }

        .main-image {
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            height: 350px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f9f9f9;
        }

        .main-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .product-title {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: #333;
            font-weight: 600;
        }

        .price-section {
            margin: 1.5rem 0;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .current-price {
            font-size: 1.8rem;
            color: #e63946;
            font-weight: 700;
            display: block;
        }

        .original-price {
            font-size: 1.2rem;
            color: #999;
            text-decoration: line-through;
        }
        .product-detail {
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .product-title {
            font-size: 2rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .price-range {
            color: #7f8c8d;
            font-size: 1.1rem;
            margin-bottom: 20px;
            padding: 12px 16px;
            background: #ecf0f1;
            border-radius: 8px;
            border-left: 4px solid #3498db;
        }

        .discount-badge {
            background: #e63946;
            color: white;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .product-meta {
            margin: 1.5rem 0;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
        }

        .meta-item {
            display: flex;
            margin-bottom: 0.5rem;
        }

        .meta-item span:first-child {
            font-weight: 600;
            width: 100px;
            color: #666;
        }

        .product-description {
             
            margin-bottom: 30px;
            margin: 1.5rem 0;
            line-height: 1.6;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #27ae60;
        }
        .product-description h3 {
            color: #2c3e50;
            /* margin-bottom: 12px; */
            font-size: 1.3rem;
        }

        .product-description p {
            color: #5a6c7d;
            line-height: 1.7;
        }
        .purchase-section {
            background: #fff;
            border: 2px solid #ecf0f1;
            border-radius: 12px;
            padding: 25px;
            margin-top: 20px;
        }
        .quality-options {
            margin-bottom: 25px;
        }

        .quality-option {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 20px;
            border: 2px solid #ecf0f1;
            border-radius: 8px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fff;
        }

        .quality-option:hover {
            border-color: #3498db;
            background: #f8f9fa;
        }
        .quality-option.selected {
            border-color: #3498db;
            background: #e3f2fd;
        }

        .quality-option input[type="radio"] {
            margin-right: 12px;
            transform: scale(1.2);
        }

        .quality-label {
            flex-grow: 1;
            font-weight: 500;
            color: #2c3e50;
        }

        .quality-price {
            font-weight: bold;
            color: #e74c3c;
            font-size: 1.1rem;
        }

        .quantity-section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .purchase-form {
            margin-top: 2rem;
        }

        .quantity-selector {
            margin-bottom: 1.5rem;
        }

        .quantity-selector label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #555;
        }

        .qty-input {
            display: flex;
            align-items: center;
            width: fit-content;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
        }
        .quantity-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: #2c3e50;
        }

        .quantity-input {
            display: flex;
            align-items: center;
            gap: 12px;
            width: fit-content;
        }

        .qty-btn {
            width: 36px;
            height: 36px;
            border: 2px solid #bdc3c7;
            background: #fff;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .qty-btn:hover {
            border-color: #3498db;
            background: #f8f9fa;
        }
        .qty-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .qty-input input {
            width: 50px;
            height: 36px;
            text-align: center;
            border: 2px solid #bdc3c7;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 1.5rem;
        }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            min-height: 50px;
        }

        .btn-primary {
            background: #3498db;
            color: white;
            flex: 1;
            justify-content: center;
        }
        .btn-primary:hover:not(:disabled) {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .btn-primary:disabled {
            background: #bdc3c7;
            cursor: not-allowed;
            transform: none;
        }

        .btn-secondary {
            background: #fff;
            color: #e74c3c;
            border: 2px solid #e74c3c;
            min-width: 120px;
            justify-content: center;
        }

        .btn-secondary:hover {
            background: #e74c3c;
            color: white;
            transform: translateY(-2px);
        }

        .btn-secondary.active {
            background: #e74c3c;
            color: white;
        }

        .btn-checkout {
            flex: 1;
            padding: 12px;
            background-color: #2a9d8f;
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-checkout:hover {
            background-color: #21867a;
            transform: translateY(-2px);
        }

        .btn-wishlist {
            width: 50px;
            padding: 12px;
            background-color: #f5f5f5;
            color: #555;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-wishlist:hover {
            background-color: #eee;
            color: #e63946;
        }

        .guest-actions {
            margin-top: 2rem;
            text-align: center;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #bdc3c7;
        }

        .btn-login {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2a9d8f;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-login:hover {
            background-color: #21867a;
            transform: translateY(-2px);
        }

        .login-notice {
            color: #666;
            font-size: 0.9rem;
        }

        .product-tabs {
            margin: 1rem 0;
        }
        .price-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #f39c12;
        }
        .price-breakdown {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .total-price {
            font-weight: bold;
            color: #e74c3c;
            font-size: 1.2rem;
            border-top: 2px solid #ecf0f1;
            padding-top: 10px;
            margin-top: 10px;
        }

        .price-summary h4 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .tabs-header {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            border-bottom: 1px solid #eee;
        }

        .tabs-header li {
            padding: 12px 24px;
            cursor: pointer;
            font-weight: 600;
            color: #666;
            position: relative;
        }

        .tabs-header li.active {
            color: #2a9d8f;
        }

        .tabs-header li.active:after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #2a9d8f;
        }

        .tabs-content {
            padding: 1.5rem 0;
        }

        .tab-panel {
            display: none;
            line-height: 1.6;
             padding: 20px;
            border: 1px solid #ddd;
            border-top: none;

        }

        .tab-panel.active {
            display: block;
        }

        .related-products {
            margin-top: 3rem;
        }

        .related-products h2 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #eee;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .no-related {
            color: #666;
            text-align: center;
            grid-column: 1 / -1;
            padding: 2rem 0;
        }

        @media (max-width: 992px) {
            .product-detail-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .main-image {
                height: 350px;
            }
            
            .related-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .main-image {
                height: 300px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-wishlist {
                width: auto;
            }
            
            .related-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .product-detail {
                padding: 20px;
            }

            .product-title {
                font-size: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .main-image {
                height: 250px;
            }
            
            .product-title {
                font-size: 1.5rem;
            }
            
            .current-price {
                font-size: 1.5rem;
            }
            
            .tabs-header li {
                padding: 8px 12px;
                font-size: 0.9rem;
            }
            
            .related-grid {
                grid-template-columns: 1fr;
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
        <div class="product-detail-container">
            <div class="product-detail-grid">
                <!-- Product Image Gallery -->
                <div class="product-gallery">
                    <div class="main-image">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="active">
                    </div>
                </div>
                <!-- Product Info -->
                <div class="product-info">
                    <h1 class="product-title">{{ $product->name }}</h1>
                    @if($lowres && $highres)
                        <div class="price-range">
                            Harga: <strong>Rp {{ number_format($lowres->price, 0, ',', '.') }}</strong> – 
                            <strong>Rp {{ number_format($highres->price, 0, ',', '.') }}</strong>
                        </div>
                    @endif
                    <span class="current-price" id="current-price">Rp{{ number_format($lowres->price, 0, ',', '.') }}</span>
                     
                    @auth
                    <div class="purchase-section">
                        <h3 class="section-title">
                            <i class="fas fa-shopping-cart"></i>
                            Pilih Opsi Pembelian
                        </h3>
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="purchase-form" id="purchase-form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="selected_price" id="selected_price">
                            <input type="hidden" name="selected_type" id="selected_type">
                            <input type="hidden" name="total_amount" id="total_amount">
                            <div class="quality-options">
                                <div class="quality-option" data-quality="lowres">
                                    <input type="radio" id="lowres" name="quality" value="lowres" data-price="{{ $lowres->price }}">
                                    <label for="lowres" class="quality-label">
                                        <strong>{{ $product->name }}</strong>
                                        <br>
                                        <small>{{ $product->description }}</small>
                                    </label>
                                    
                                    <div class="quality-price">Rp {{ number_format($lowres->price, 0, ',', '.') }}</div>
                                </div>
                                <div class="quality-option" data-quality="highres">
                                    <input type="radio" id="highres" name="quality" value="highres" data-price="{{ $highres->price }}">
                                    <label for="highres" class="quality-label">
                                        <strong>{{ $product->name }}</strong>
                                        <br>
                                        <small>{{ $product->description }}</small>
                                    </label>
                                    <div class="quality-price">Rp {{ number_format($highres->price, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            
                            <div class="quantity-section">
                                <label class="quantity-label">Jumlah:</label>
                                <div class="quantity-input">
                                    <button type="button" class="qty-btn" id="decrease-qty">-</button>
                                    <input type="number" id="quantity" name="quantity"  min="1" value="1" readonly>
                                    <button type="button" class="qty-btn" id="increase-qty">+</button>
                                </div>
                            </div>
                            <div class="price-summary" id="price-summary" style="display: none;">
                                <h4>Ringkasan Harga</h4>
                                <div class="price-breakdown">
                                    <span>Harga Satuan:</span>
                                    <span id="unit-price">Rp0</span>
                                </div>
                                <div class="price-breakdown">
                                    <span>Jumlah:</span>
                                    <span id="quantity-display">1</span>
                                </div>
                                <div class="price-breakdown total-price">
                                    <span>Total:</span>
                                    <span id="total-price">Rp0</span>
                                </div>
                            </div>
                            <div class="action-buttons">
                                <button type="submit" class="btn-checkout" disabled>
                                    <i class="fas fa-shopping-bag"></i> Checkout Sekarang
                                </button>
                                {{-- Tombol wishlist (JANGAN DIJADIKAN SUBMIT DI SINI) --}}
                                <button type="button" class="btn btn-secondary" id="wishlist-btn"
                                    data-product-id="{{ $product->id }}">
                                    <i class="far fa-heart"></i> Wishlist
                                </button>
                                 
                            </div>
                        </form>
                        {{-- FORM WISHLIST KE CART (DILUAR FORM UTAMA) --}}
                        <form action="{{ route('cart.add') }}" method="POST" id="wishlist-to-cart-form" style="display: none;">
                            @csrf
                            <input type="hidden" name="product_id" id="wishlist-product-id"> <!-- ✅ -->
                            <input type="hidden" name="type" id="wishlist-type">
                            <input type="hidden" name="quantity" id="wishlist-quantity">
                        </form>
                         
                        @else
                        <div class="guest-actions">
                            <a href="{{ route('login') }}" class="btn-login">
                                <i class="fas fa-sign-in-alt"></i> Login untuk Checkout
                            </a>
                            <p class="login-notice">Login untuk menambahkan ke wishlist dan melihat promo khusus member</p>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- Product Tabs Section -->
            <div class="product-tabs">
                <ul class="tabs-header">
                    <li class="tab-header-item tab-active" data-tab="description">Deskripsi Lengkap</li> {{-- Ganti dari "active" ke "tab-active" --}}
                    <li class="tab-header-item" data-tab="specifications">Spesifikasi</li>
                    <li class="tab-header-item" data-tab="reviews">Ulasan ({{ $product->reviews_count ?? $product->reviews->count() }})</li>
                </ul>
                <div class="tabs-content">
                    <!-- Tab: Deskripsi -->
                    <div class="product-tab-panel tab-content-active" id="description">
                        <h3>Deskripsi Produk</h3>
                        <p>{{ $product->description }}</p>
                    </div>
                    <!-- Tab: Spesifikasi -->
                    <div class="product-tab-panel" id="specifications">
                        <h3>Spesifikasi Teknis</h3>
                        <table style="width: 100%; border-collapse: collapse;">
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 10px; font-weight: bold; width: 30%;">Dimensi</td>
                                <td style="padding: 10px;">20 x 15 x 5 cm</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 10px; font-weight: bold;">Berat</td>
                                <td style="padding: 10px;">500 gram</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 10px; font-weight: bold;">Material</td>
                                <td style="padding: 10px;">Plastik ABS berkualitas tinggi</td>
                            </tr>
                            <tr style="border-bottom: 1px solid #eee;">
                                <td style="padding: 10px; font-weight: bold;">Warna</td>
                                <td style="padding: 10px;">Hitam, Putih, Biru</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; font-weight: bold;">Garansi</td>
                                <td style="padding: 10px;">1 Tahun</td>
                            </tr>
                        </table>
                    </div>
                    <!-- Tab: Ulasan -->
                    <div class="product-tab-panel" id="reviews">
                        <div class="col-md-12" id="fbcomment">
                            <div class="header_comment">
                                <div class="row">
                                    <div class="col-md-6 text-left">
                                        <span class="count_comment">{{ $product->reviews->count() }} Ulasan</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <span class="sort_title">Sort by</span>
                                        <select class="sort_by">
                                            <option>Top</option>
                                            <option>Newest</option>
                                            <option>Oldest</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="body_comment">
                                @foreach($product->reviews as $review)
                                    <div class="row mb-3">
                                        <div class="avatar_comment col-md-1">
                                            <img src="{{ $review->user->photo ?? 'https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg' }}" alt="avatar" class="img-fluid rounded-circle"/>
                                        </div>
                                        <div class="result_comment col-md-11">
                                            <h4>{{ $review->user->name }}</h4>
                                            <div>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fa{{ $i <= $review->rating ? 's' : 'r' }} fa-star text-warning"></i>
                                                @endfor
                                            </div>
                                            <strong>{{ $review->title }}</strong>
                                            <p>{{ $review->content }}</p>
                                            <div class="tools_comment">
                                                <span>{{ $review->formatted_date }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if($product->reviews->isEmpty())
                                    <p class="text-muted">Belum ada ulasan untuk produk ini.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </main>     

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // ========== GLOBAL VARIABLES ==========
            let selectedQuality = null;
            let selectedPrice = 0;
            let isInWishlist = false;

            // ========== ELEMENT SELECTORS ==========
            const elements = {
                qualityOptions: document.querySelectorAll('.quality-option'),
                qualityRadios: document.querySelectorAll('input[name="quality"]'),
                quantityInput: document.getElementById('quantity'),
                decreaseBtn: document.getElementById('decrease-qty'),
                increaseBtn: document.getElementById('increase-qty'),
                addToCartBtn: document.getElementById('add-to-cart-btn'),
                wishlistBtn: document.getElementById('wishlist-btn'),
                currentPriceDisplay: document.getElementById('current-price'),
                priceSummary: document.getElementById('price-summary'),
                unitPriceDisplay: document.getElementById('unit-price'),
                quantityDisplay: document.getElementById('quantity-display'),
                totalPriceDisplay: document.getElementById('total-price'),
                checkoutBtn: document.querySelector('.btn-checkout'),
                selectedTypeInput: document.getElementById('selected_type'),
                selectedPriceInput: document.getElementById('selected_price'),
                totalAmountInput: document.getElementById('total_amount'),
                purchaseForm: document.getElementById('purchase-form'),
                wishlistForm: document.getElementById('wishlist-to-cart-form'),
                wishlistProductId: document.getElementById('wishlist-product-id'),
                wishlistType: document.getElementById('wishlist-type'),
                wishlistQuantity: document.getElementById('wishlist-quantity')
            };

            // ========== HELPER FUNCTIONS ==========
            function formatPrice(price) {
                return 'Rp' + parseInt(price).toLocaleString('id-ID');
            }

            function updateQuantityButtons() {
                const currentQty = parseInt(elements.quantityInput.value);
                if (elements.decreaseBtn) {
                    elements.decreaseBtn.disabled = currentQty <= 1;
                }
            }

            function updatePriceSummary() {
                const selectedRadio = document.querySelector('input[name="quality"]:checked');
                if (selectedRadio && elements.priceSummary) {
                    const price = parseInt(selectedRadio.dataset.price);
                    const quantity = parseInt(elements.quantityInput.value) || 1;
                    const total = price * quantity;
                    
                    selectedQuality = selectedRadio.value;
                    selectedPrice = price;
                    
                    // Update display elements
                    if (elements.currentPriceDisplay) elements.currentPriceDisplay.textContent = formatPrice(price);
                    if (elements.unitPriceDisplay) elements.unitPriceDisplay.textContent = formatPrice(price);
                    if (elements.quantityDisplay) elements.quantityDisplay.textContent = quantity;
                    if (elements.totalPriceDisplay) elements.totalPriceDisplay.textContent = formatPrice(total);
                    
                    // Update hidden inputs
                    if (elements.selectedPriceInput) elements.selectedPriceInput.value = price;
                    if (elements.selectedTypeInput) elements.selectedTypeInput.value = selectedQuality;
                    if (elements.totalAmountInput) elements.totalAmountInput.value = total;
                    
                    // Show price summary
                    elements.priceSummary.style.display = 'block';
                    
                    // Enable checkout button
                    if (elements.checkoutBtn) elements.checkoutBtn.disabled = false;
                    if (elements.addToCartBtn) elements.addToCartBtn.disabled = false;
                }
            }

            function validateSelection() {
                if (!selectedQuality || selectedPrice === 0) {
                    alert('Pilih resolusi terlebih dahulu.');
                    return false;
                }
                return true;
            }

            // ========== PRODUCT DETAIL FUNCTIONALITY ==========
            function initProductDetail() {
                // Initialize
                updateQuantityButtons();

                // Quality option selection
                elements.qualityOptions.forEach(option => {
                    option.addEventListener('click', function() {
                        // Remove previous selections
                        elements.qualityOptions.forEach(opt => opt.classList.remove('selected'));
                        
                        // Select current option
                        this.classList.add('selected');
                        const radio = this.querySelector('input[type="radio"]');
                        if (radio) {
                            radio.checked = true;
                            updatePriceSummary();
                        }
                    });
                });

                // Quality radio change
                elements.qualityRadios.forEach(radio => {
                    radio.addEventListener('change', function() {
                        if (this.checked) {
                            updatePriceSummary();
                        }
                    });
                });

                // Quantity controls
                if (elements.decreaseBtn) {
                    elements.decreaseBtn.addEventListener('click', function() {
                        let currentQty = parseInt(elements.quantityInput.value);
                        if (currentQty > 1) {
                            elements.quantityInput.value = currentQty - 1;
                            updateQuantityButtons();
                            updatePriceSummary();
                        }
                    });
                }

                if (elements.increaseBtn) {
                    elements.increaseBtn.addEventListener('click', function() {
                        let currentQty = parseInt(elements.quantityInput.value);
                        elements.quantityInput.value = currentQty + 1;
                        updateQuantityButtons();
                        updatePriceSummary();
                    });
                }

                // Quantity input change
                if (elements.quantityInput) {
                    elements.quantityInput.addEventListener('input', function() {
                        let value = parseInt(this.value);
                        if (isNaN(value) || value < 1) {
                            this.value = 1;
                        }
                        updateQuantityButtons();
                        updatePriceSummary();
                    });
                }

                // Wishlist button
                if (elements.wishlistBtn) {
                    elements.wishlistBtn.addEventListener('click', function() {
                        if (!validateSelection()) return;

                        const productId = this.dataset.productId;
                        const quantity = elements.quantityInput.value;

                        // Fill hidden form
                        if (elements.wishlistProductId) elements.wishlistProductId.value = productId;
                        if (elements.wishlistType) elements.wishlistType.value = selectedQuality;
                        if (elements.wishlistQuantity) elements.wishlistQuantity.value = quantity;

                        // Submit wishlist form
                        if (elements.wishlistForm) {
                            elements.wishlistForm.submit();
                        }
                    });
                }

                // Add to cart button
                if (elements.addToCartBtn) {
                    elements.addToCartBtn.addEventListener('click', function() {
                        if (!validateSelection()) return;

                        const productId = this.dataset.productId;
                        const quantity = parseInt(elements.quantityInput.value);

                        // Fill hidden form
                        if (elements.wishlistProductId) elements.wishlistProductId.value = productId;
                        if (elements.wishlistType) elements.wishlistType.value = selectedQuality;
                        if (elements.wishlistQuantity) elements.wishlistQuantity.value = quantity;

                        // Submit form
                        if (elements.wishlistForm) {
                            elements.wishlistForm.submit();
                        }
                    });
                }

                // Form validation
                if (elements.purchaseForm) {
                    elements.purchaseForm.addEventListener('submit', function(e) {
                        if (!validateSelection()) {
                            e.preventDefault();
                        }
                    });
                }
            }

            // ========== TABS FUNCTIONALITY ==========
            function initTabs() {
                const tabHeaders = document.querySelectorAll('.tabs-header li');
                const tabPanels = document.querySelectorAll('.tab-panel');
                
                if (tabHeaders.length === 0 || tabPanels.length === 0) {
                    console.warn('Tab elements not found');
                    return;
                }

                tabHeaders.forEach(header => {
                    header.addEventListener('click', function() {
                        const tabId = this.getAttribute('data-tab');
                        
                        // Remove active class from all headers
                        tabHeaders.forEach(h => h.classList.remove('active'));
                        
                        // Remove active class from all panels
                        tabPanels.forEach(p => p.classList.remove('active'));
                        
                        // Add active class to clicked header
                        this.classList.add('active');
                        
                        // Show corresponding panel
                        const targetPanel = document.getElementById(tabId);
                        if (targetPanel) {
                            targetPanel.classList.add('active');
                        } else {
                            console.error('Panel not found:', tabId);
                        }
                    });
                });
            }

            // ========== COMMENT FUNCTIONALITY ==========
            function initComments() {
                // Make functions globally accessible
                window.submit_comment = function() {
                    const comment = document.querySelector('.commentar')?.value;
                    if (!comment) return;

                    const el = document.createElement('li');
                    el.className = "box_result row";
                    el.innerHTML = `
                        <div class="avatar_comment col-md-1">
                            <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
                        </div>
                        <div class="result_comment col-md-11">
                            <h4>Anonymous</h4>
                            <p>${comment}</p>
                            <div class="tools_comment">
                                <a class="like" href="#">Like</a><span aria-hidden="true"> · </span>
                                <i class="fa fa-thumbs-o-up"></i> <span class="count">0</span>
                                <span aria-hidden="true"> · </span>
                                <a class="replay" href="#">Reply</a><span aria-hidden="true"> · </span>
                                <span>1m</span>
                            </div>
                            <ul class="child_replay"></ul>
                        </div>
                    `;
                    
                    const listComment = document.getElementById('list_comment');
                    if (listComment) {
                        listComment.prepend(el);
                    }
                    
                    const commentInput = document.querySelector('.commentar');
                    if (commentInput) {
                        commentInput.value = '';
                    }
                };

                window.submit_reply = function() {
                    const commentReplay = document.querySelector('.comment_replay')?.value;
                    if (!commentReplay) return;

                    const el = document.createElement('li');
                    el.className = "box_reply row";
                    el.innerHTML = `
                        <div class="avatar_comment col-md-1">
                            <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
                        </div>
                        <div class="result_comment col-md-11">
                            <h4>Anonymous</h4>
                            <p>${commentReplay}</p>
                            <div class="tools_comment">
                                <a class="like" href="#">Like</a><span aria-hidden="true"> · </span>
                                <i class="fa fa-thumbs-o-up"></i> <span class="count">0</span>
                                <span aria-hidden="true"> · </span>
                                <a class="replay" href="#">Reply</a><span aria-hidden="true"> · </span>
                                <span>1m</span>
                            </div>
                            <ul class="child_replay"></ul>
                        </div>
                    `;
                    
                    const currentElement = document.querySelector('.comment_replay')?.closest('li');
                    if (currentElement) {
                        const childReplay = currentElement.querySelector('.child_replay');
                        if (childReplay) {
                            childReplay.prepend(el);
                        }
                    }
                    
                    const commentInput = document.querySelector('.comment_replay');
                    if (commentInput) {
                        commentInput.value = '';
                    }
                    cancel_reply();
                };

                window.cancel_reply = function() {
                    const replyElements = document.querySelectorAll('.reply_comment');
                    replyElements.forEach(el => el.remove());
                };

                // Like functionality with event delegation
                const listComment = document.getElementById('list_comment');
                if (listComment) {
                    listComment.addEventListener('click', function(e) {
                        if (e.target.classList.contains('like')) {
                            e.preventDefault();
                            const likeBtn = e.target;
                            const toolsDiv = likeBtn.closest('.tools_comment');
                            const countSpan = toolsDiv.querySelector('.count');
                            
                            const currentText = likeBtn.textContent.trim();
                            const currentCount = parseInt(countSpan.textContent.trim());
                            
                            if (currentText === "Like") {
                                likeBtn.textContent = 'Unlike';
                                countSpan.textContent = currentCount + 1;
                            } else {
                                likeBtn.textContent = 'Like';
                                countSpan.textContent = currentCount - 1;
                            }
                        }
                        
                        if (e.target.classList.contains('replay')) {
                            e.preventDefault();
                            cancel_reply();
                            
                            const replyBtn = e.target;
                            const parentLi = replyBtn.closest('li');
                            const childReplay = parentLi.querySelector('.child_replay');
                            
                            const el = document.createElement('li');
                            el.className = "box_reply row";
                            el.innerHTML = `
                                <div class="col-md-12 reply_comment">
                                    <div class="row">
                                        <div class="avatar_comment col-md-1">
                                            <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>
                                        </div>
                                        <div class="box_comment col-md-10">
                                            <textarea class="comment_replay" placeholder="Add a comment..."></textarea>
                                            <div class="box_post">
                                                <div class="pull-right">
                                                    <span>
                                                        <img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar" />
                                                        <i class="fa fa-caret-down"></i>
                                                    </span>
                                                    <button class="cancel" onclick="cancel_reply()" type="button">Cancel</button>
                                                    <button onclick="submit_reply()" type="button" value="1">Reply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            
                            if (childReplay) {
                                childReplay.prepend(el);
                            }
                        }
                    });
                }
            }

            // ========== REVIEW FUNCTIONALITY ==========
            function initReviews() {
                // Filter berdasarkan rating
                const filterBtns = document.querySelectorAll('.filter-btn');
                filterBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const rating = this.dataset.rating;
                        
                        // Update active button
                        filterBtns.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        
                        // Filter reviews
                        const reviewItems = document.querySelectorAll('.review-item');
                        reviewItems.forEach(item => {
                            if (rating === '0' || item.dataset.rating === rating) {
                                item.style.display = 'block';
                            } else {
                                item.style.display = 'none';
                            }
                        });
                    });
                });
                
                // Sorting ulasan
                const sortOptions = document.querySelectorAll('.sort-option');
                sortOptions.forEach(option => {
                    option.addEventListener('click', function(e) {
                        e.preventDefault();
                        const sortBy = this.dataset.sort;
                        const reviewsContainer = document.querySelector('.reviews-list');
                        const reviews = Array.from(document.querySelectorAll('.review-item'));
                        
                        if (!reviewsContainer || reviews.length === 0) return;
                        
                        reviews.sort((a, b) => {
                            const aRating = parseInt(a.dataset.rating) || 0;
                            const bRating = parseInt(b.dataset.rating) || 0;
                            const aDateText = a.querySelector('small')?.textContent || '';
                            const bDateText = b.querySelector('small')?.textContent || '';
                            const aDate = new Date(aDateText);
                            const bDate = new Date(bDateText);
                            
                            switch(sortBy) {
                                case 'newest':
                                    return bDate - aDate;
                                case 'highest':
                                    return bRating - aRating;
                                case 'lowest':
                                    return aRating - bRating;
                                default:
                                    return 0;
                            }
                        });
                        
                        // Clear and re-append sorted reviews
                        reviewsContainer.innerHTML = '';
                        reviews.forEach(review => reviewsContainer.appendChild(review));
                    });
                });
            }
            
            // ===============================
            // PRODUCT TABS FUNCTIONS (FIXED)
            // ===============================
            const tabHeaders = document.querySelectorAll('.tab-header-item');
            const tabPanels = document.querySelectorAll('.product-tab-panel');
            
            tabHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    const targetTab = this.dataset.tab;
                    
                    // Remove active class from all headers and panels
                    tabHeaders.forEach(h => h.classList.remove('tab-active')); // Ganti dari 'active' ke 'tab-active'
                    tabPanels.forEach(p => p.classList.remove('tab-content-active')); // Ganti dari 'active' ke 'tab-content-active'
                    
                    // Add active class to clicked header
                    this.classList.add('tab-active'); // Ganti dari 'active' ke 'tab-active'
                    
                    // Add active class to corresponding panel
                    const targetPanel = document.getElementById(targetTab);
                    if (targetPanel) {
                        targetPanel.classList.add('tab-content-active'); // Ganti dari 'active' ke 'tab-content-active'
                    }
                });
            });
            // ===============================
            // COMMENT FUNCTIONS
            // ===============================
            
            // Make submit_comment global
            window.submit_comment = function() {
                var comment = document.querySelector('.commentar').value;
                if (!comment.trim()) return;
                
                var el = document.createElement('li');
                el.className = "box_result row";
                el.innerHTML =
                        '<div class="avatar_comment col-md-1">'+
                        '<img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>'+
                        '</div>'+
                        '<div class="result_comment col-md-11">'+
                        '<h4>Anonimous</h4>'+
                        '<p>'+ comment +'</p>'+
                        '<div class="tools_comment">'+
                        '<a class="like" href="#">Like</a><span aria-hidden="true"> · </span>'+
                        '<i class="fa fa-thumbs-o-up"></i> <span class="count">0</span>'+
                        '<span aria-hidden="true"> · </span>'+
                        '<a class="replay" href="#">Reply</a><span aria-hidden="true"> · </span>'+
                            '<span>1m</span>'+
                        '</div>'+
                        '<ul class="child_replay"></ul>'+
                        '</div>';
                
                var listComment = document.getElementById('list_comment');
                if (listComment) {
                    listComment.prepend(el);
                }
                document.querySelector('.commentar').value = '';
            };

            // Make submit_reply global
            window.submit_reply = function() {
                var commentReplay = document.querySelector('.comment_replay');
                if (!commentReplay) return;
                
                var comment = commentReplay.value;
                if (!comment.trim()) return;
                
                var el = document.createElement('li');
                el.className = "box_reply row";
                el.innerHTML =
                        '<div class="avatar_comment col-md-1">'+
                        '<img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>'+
                        '</div>'+
                        '<div class="result_comment col-md-11">'+
                        '<h4>Anonimous</h4>'+
                        '<p>'+ comment +'</p>'+
                        '<div class="tools_comment">'+
                        '<a class="like" href="#">Like</a><span aria-hidden="true"> · </span>'+
                        '<i class="fa fa-thumbs-o-up"></i> <span class="count">0</span>'+
                        '<span aria-hidden="true"> · </span>'+
                        '<a class="replay" href="#">Reply</a><span aria-hidden="true"> · </span>'+
                            '<span>1m</span>'+
                        '</div>'+
                        '<ul class="child_replay"></ul>'+
                        '</div>';
                
                var currentReply = document.querySelector('.reply_comment');
                if (currentReply) {
                    var parentComment = currentReply.closest('li');
                    var childReplay = parentComment.querySelector('.child_replay');
                    if (childReplay) {
                        childReplay.prepend(el);
                    }
                }
                commentReplay.value = '';
                cancel_reply();
            };

            // Make cancel_reply global
            window.cancel_reply = function() {
                var replyElements = document.querySelectorAll('.reply_comment');
                replyElements.forEach(el => el.remove());
            };

            // Event delegation for dynamic content
            document.addEventListener('click', function(e) {
                // Handle show more comments
                if (e.target.classList.contains('show_more')) {
                    e.target.style.display = 'none';
                    var showLess = document.querySelector('.show_less');
                    if (showLess) {
                        showLess.style.display = 'block';
                    }
                }

                // Handle like buttons
                if (e.target.classList.contains('like')) {
                    e.preventDefault();
                    var likeBtn = e.target;
                    var toolsComment = likeBtn.closest('.tools_comment');
                    var countSpan = toolsComment.querySelector('.count');
                    var currentCount = parseInt(countSpan.textContent);
                    
                    if (likeBtn.textContent.trim() === 'Like') {
                        likeBtn.textContent = 'Unlike';
                        countSpan.textContent = currentCount + 1;
                    } else {
                        likeBtn.textContent = 'Like';
                        countSpan.textContent = Math.max(0, currentCount - 1);
                    }
                }

                // Handle reply buttons
                if (e.target.classList.contains('replay')) {
                    e.preventDefault();
                    cancel_reply(); // Remove any existing reply forms
                    
                    var replyBtn = e.target;
                    var parentComment = replyBtn.closest('li');
                    var childReplay = parentComment.querySelector('.child_replay');
                    
                    if (childReplay) {
                        var replyForm = document.createElement('li');
                        replyForm.className = "box_reply row";
                        replyForm.innerHTML =
                            '<div class="col-md-12 reply_comment">'+
                                '<div class="row">'+
                                    '<div class="avatar_comment col-md-1">'+
                                    '<img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar"/>'+
                                    '</div>'+
                                    '<div class="box_comment col-md-10">'+
                                    '<textarea class="comment_replay" placeholder="Add a comment..."></textarea>'+
                                    '<div class="box_post">'+
                                        '<div class="pull-right">'+
                                        '<span>'+
                                            '<img src="https://static.xx.fbcdn.net/rsrc.php/v1/yi/r/odA9sNLrE86.jpg" alt="avatar" />'+
                                            '<i class="fa fa-caret-down"></i>'+
                                        '</span>'+
                                        '<button class="cancel" onclick="cancel_reply()" type="button">Cancel</button>'+
                                        '<button onclick="submit_reply()" type="button" value="1">Reply</button>'+
                                        '</div>'+
                                    '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                        childReplay.prepend(replyForm);
                    }
                }
            });


            // ========== INITIALIZATION ==========
            try {
                initProductDetail();
                console.log('✅ Product detail initialized');
            } catch (error) {
                console.error('❌ Error initializing product detail:', error);
            }

            try {
                initTabs();
                console.log('✅ Tabs initialized');
            } catch (error) {
                console.error('❌ Error initializing tabs:', error);
            }

            try {
                initComments();
                console.log('✅ Comments initialized');
            } catch (error) {
                console.error('❌ Error initializing comments:', error);
            }

            try {
                initReviews();
                console.log('✅ Reviews initialized');
            } catch (error) {
                console.error('❌ Error initializing reviews:', error);
            }

            console.log('🚀 All modules initialized successfully');
        });
    </script>
 
</body>

</html>