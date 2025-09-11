<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.css')
    <style>
        .image-option.image-active {
            border-color: #007bff;
            background-color: #f8f9ff;
            box-shadow: 0 2px 10px rgba(0, 123, 255, 0.2);
        }

        /* Perbaikan untuk Product Tabs */
        .tab-header-item.tab-active {
            border-bottom: 3px solid #007bff;
            color: #007bff;
            background-color: #f8f9ff;
        }

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
        }

        .original-price {
            font-size: 1.2rem;
            color: #999;
            text-decoration: line-through;
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
            margin: 1.5rem 0;
            line-height: 1.6;
        }

        .purchase-form {
            margin-top: 2rem;
        }

        /* Image Type Selector Styles */
        .image-type-selector {
            margin-bottom: 2rem;
        }

        .image-type-selector label {
            display: block;
            margin-bottom: 1rem;
            font-weight: 600;
            color: #555;
        }

        .image-options {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .image-option {
            position: relative;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fff;
        }

        .image-option:hover {
            border-color: #2a9d8f;
            background: #f8f9fa;
        }

        .image-option.selected {
            border-color: #2a9d8f;
            background: #e8f5f3;
        }

        .image-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            display: none;
        }

        .image-option-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .image-option-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .image-option-price {
            font-size: 1.2rem;
            color: #e63946;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .image-option-description {
            font-size: 0.9rem;
            color: #666;
            line-height: 1.4;
        }

        .quality-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .quality-badge.high {
            background: #d4edda;
            color: #155724;
        }

        .quality-badge.low {
            background: #fff3cd;
            color: #856404;
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

        .qty-btn {
            width: 36px;
            height: 36px;
            background: #f5f5f5;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover {
            background: #eee;
        }

        .qty-input input {
            width: 50px;
            height: 36px;
            text-align: center;
            border: none;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            font-size: 1rem;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 1.5rem;
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

        .btn-checkout:disabled {
            background-color: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .btn-wishlist {
            flex: 1;
            padding: 12px;
            background-color: #f5f5f5;
            color: #555;
            border: 1px solid #ddd;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-wishlist:hover {
            background-color: #eee;
            color: #e63946;
        }

        .guest-actions {
            margin-top: 2rem;
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
        }

        .login-notice {
            color: #666;
            font-size: 0.9rem;
        }

        .product-tabs {
            margin: 1rem 0;
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
            border: 2px solid transparent;
            padding: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            line-height: 1.6;
        }

        .tab-panel.active {
            display: block;
            border: 2px solid #007bff;
            background-color: #f8f9fa;
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

            .image-options {
                grid-template-columns: 1fr;
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

    @include('frontend.layout.header')
    <!-- Modal Search End -->
    <main class="main">
            <div class="product-detail-container">
                <div class="product-detail-grid">
                    <!-- Product Image Gallery -->
                    <div class="product-gallery">
                        <div class="main-image">
                            <img src="{{ asset($photos->cover) }}" alt="{{ $photos->name }}" class="active">
                        </div>
                        <!-- Jika ada thumbnail lainnya bisa ditambahkan di sini -->
                    </div>
                    <!-- Product Info -->
                    <div class="product-info">
                        <h1 class="product-title">{{ $photos->name }}</h1>
                        
                        <div class="price-section">
                            <span class="current-price" id="displayPrice">Rp{{ number_format($photos->harga_image_highres, 0, ',', '.') }}</span>
                        </div>

                        <div class="product-meta">
                        </div>

                        <div class="product-description">
                            <h3>Deskripsi Produk</h3>
                            <p>{{ $photos->title }}</p>
                        </div>

                        @auth
                         
                        {{-- <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data" class="purchase-form">
                            @csrf
                            <input type="hidden" name="photo_id" value="{{ $photos->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                            <!-- Image Type Selector -->
                            <div class="image-type-selector">
                                <label>Pilih Kualitas Gambar:</label>
                                <div class="image-options">
                                    <label class="image-option tab-panel active"> 
                                        <input type="radio" name="image_type" value="highres"
                                            data-price="{{ $photos->harga_image_highres }}"
                                            data-file="{{ $photos->image_highres }}"
                                            data-type-name="{{ $photos->type_highres }}"
                                            checked>
                                        <div class="image-option-content">
                                            <span class="quality-badge high">High Resolution</span>
                                            <div class="image-option-title">{{ $photos->type_highres ?? 'High Quality' }}</div>
                                            <div class="image-option-price">Rp{{ number_format($photos->harga_image_highres, 0, ',', '.') }}</div>
                                            <div class="image-option-description">Kualitas tinggi, cocok untuk cetak dan keperluan profesional</div>
                                        </div>
                                    </label>

                                    <label class="image-option tab-panel">  
                                        <input type="radio" name="image_type" value="lowres"
                                            data-price="{{ $photos->harga_image_lowres }}"
                                            data-file="{{ $photos->image_lowres }}"
                                            data-type-name="{{ $photos->type_lowres }}">
                                        <div class="image-option-content">
                                            <span class="quality-badge low">Low Resolution</span>
                                            <div class="image-option-title">{{ $photos->type_lowres ?? 'Standard Quality' }}</div>
                                            <div class="image-option-price">Rp{{ number_format($photos->harga_image_lowres, 0, ',', '.') }}</div>
                                            <div class="image-option-description">Kualitas standar, cocok untuk web dan media digital</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Hidden fields -->
                            <input type="hidden" name="selected_price" id="selectedPrice" value="{{ $photos->harga_image_highres }}">
                            <input type="hidden" name="selected_file" id="selectedFile" value="{{ $photos->image_highres }}">
                            <input type="hidden" name="selected_type" id="selectedType" value="{{ $photos->type_highres }}">

                            <!-- Price Display -->
                            

                            <!-- Quantity -->
                            <div class="quantity-selector">
                                <label for="qty">Jumlah:</label>
                                <div class="qty-input">
                                    <button type="button" class="qty-btn minus">-</button>
                                    <input type="number" id="qty" name="qty" min="1" value="1" required>
                                    <button type="button" class="qty-btn plus">+</button>
                                </div>
                            </div>

                            <!-- Total Harga -->
                            <div>Total Harga: <span id="totalHarga">Rp{{ number_format($photos->harga_image_highres, 0, ',', '.') }}</span></div>

                            <div class="action-buttons mt-3">
                                <button type="submit" class="btn-checkout" name="action" value="checkout">
                                    <i class="fas fa-shopping-bag"></i> Checkout Sekarang
                                </button>
                                <button type="submit" class="btn-wishlist" name="action" value="cart">
                                    <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                                </button>
                            </div>
                        </form> --}}
                        <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data" class="purchase-form">
                            @csrf
                            <input type="hidden" name="photo_id" value="{{ $photos->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                            <!-- Image Type Selector -->
                            <div class="image-type-selector">
                                <label>Pilih Kualitas Gambar:</label>
                                <div class="image-options">
                                    <label class="image-option image-active"> {{-- Ganti dari "tab-panel active" ke "image-active" --}}
                                        <input type="radio" name="image_type" value="highres"
                                            data-price="{{ $photos->harga_image_highres }}"
                                            data-file="{{ $photos->image_highres }}"
                                            data-type-name="{{ $photos->type_highres }}"
                                            checked>
                                        <div class="image-option-content">
                                            <span class="quality-badge high">High Resolution</span>
                                            <div class="image-option-title">{{ $photos->type_highres ?? 'High Quality' }}</div>
                                            <div class="image-option-price">Rp{{ number_format($photos->harga_image_highres, 0, ',', '.') }}</div>
                                            <div class="image-option-description">Kualitas tinggi, cocok untuk cetak dan keperluan profesional</div>
                                        </div>
                                    </label>

                                    <label class="image-option"> {{-- Hapus "tab-panel" --}}
                                        <input type="radio" name="image_type" value="lowres"
                                            data-price="{{ $photos->harga_image_lowres }}"
                                            data-file="{{ $photos->image_lowres }}"
                                            data-type-name="{{ $photos->type_lowres }}">
                                        <div class="image-option-content">
                                            <span class="quality-badge low">Low Resolution</span>
                                            <div class="image-option-title">{{ $photos->type_lowres ?? 'Standard Quality' }}</div>
                                            <div class="image-option-price">Rp{{ number_format($photos->harga_image_lowres, 0, ',', '.') }}</div>
                                            <div class="image-option-description">Kualitas standar, cocok untuk web dan media digital</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Hidden fields -->
                            <input type="hidden" name="selected_price" id="selectedPrice" value="{{ $photos->harga_image_highres }}">
                            <input type="hidden" name="selected_file" id="selectedFile" value="{{ $photos->image_highres }}">
                            <input type="hidden" name="selected_type" id="selectedType" value="{{ $photos->type_highres }}">

                            <!-- Quantity -->
                            <div class="quantity-selector">
                                <label for="qty">Jumlah:</label>
                                <div class="qty-input">
                                    <button type="button" class="qty-btn minus">-</button>
                                    <input type="number" id="qty" name="qty" min="1" value="1" required>
                                    <button type="button" class="qty-btn plus">+</button>
                                </div>
                            </div>

                            <!-- Total Harga -->
                            <div>Total Harga: <span id="totalHarga">Rp{{ number_format($photos->harga_image_highres, 0, ',', '.') }}</span></div>

                            <div class="action-buttons mt-3">
                                <button type="submit" class="btn-checkout" name="action" value="checkout">
                                    <i class="fas fa-shopping-bag"></i> Checkout Sekarang
                                </button>
                                <button type="submit" class="btn-wishlist" name="action" value="cart">
                                    <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                                </button>
                            </div>
                        </form>



                        @else
                        <div class="guest-actions">
                            <a href="{{ route('login') }}" class="btn-login">
                                <i class="fas fa-sign-in-alt"></i> Login untuk Checkout
                            </a>
                            <p class="login-notice">Login untuk menambahkan ke keranjang dan melihat promo khusus member</p>
                        </div>
                        @endauth
                    </div>
                </div>

                <!-- PRODUCT TABS SECTION (paste-2.txt) - FIXED -->
                <div class="product-tabs">
                    <ul class="tabs-header">
                        <li class="tab-header-item tab-active" data-tab="description">Deskripsi Lengkap</li> {{-- Ganti dari "active" ke "tab-active" --}}
                        <li class="tab-header-item" data-tab="specifications">Spesifikasi</li>
                        <li class="tab-header-item" data-tab="reviews">Ulasan (0)</li>
                    </ul>
                    <div class="tabs-content">
                        <div class="product-tab-panel tab-content-active" id="description"> {{-- Ganti dari "active" ke "tab-content-active" --}}
                            <p>{{ $photos->deskripsi }}</p>
                        </div>
                        <div class="product-tab-panel" id="specifications">
                            <div>
                                <h4>Spesifikasi File</h4>
                                <ul>
                                    <li><strong>High Resolution:</strong> {{ $photos->type_highres ?? 'Format tidak tersedia' }}</li>
                                    <li><strong>Low Resolution:</strong> {{ $photos->type_lowres ?? 'Format tidak tersedia' }}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-tab-panel" id="reviews">
                            <div class="col-md-12" id="fbcomment">
                                <div class="header_comment">
                                    <div class="row">
                                        <div class="col-md-6 text-left">
                                            <span class="count_comment">{{ $photos->reviews->count() }} Ulasan</span>
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
                                    {{-- Loop semua review --}}
                                    @foreach($photos->reviews as $review)
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

                                    @if($photos->reviews->isEmpty())
                                        <p class="text-muted">Belum ada ulasan untuk foto ini.</p>
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
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ===============================
            // IMAGE TYPE SELECTOR FUNCTIONS
            // ===============================
            const radios = document.querySelectorAll('input[name="image_type"]');
            const selectedPrice = document.getElementById("selectedPrice");
            const selectedFile = document.getElementById("selectedFile");
            const selectedType = document.getElementById("selectedType");
            const qtyInput = document.getElementById("qty");
            const totalHarga = document.getElementById("totalHarga");
            const displayPrice = document.getElementById("displayPrice");

            function updateHiddenFieldsAndTotal() {
                const selected = document.querySelector('input[name="image_type"]:checked');
                if (!selected) return;

                const price = parseInt(selected.dataset.price || 0);
                const qty = parseInt(qtyInput.value || 1);

                selectedPrice.value = selected.dataset.price;
                selectedFile.value = selected.dataset.file;
                selectedType.value = selected.dataset.typeName;

                // Update harga satuan (jika ada element displayPrice)
                if (displayPrice) {
                    displayPrice.textContent = "Rp" + price.toLocaleString('id-ID');
                }

                // Update total
                if (totalHarga) {
                    totalHarga.textContent = "Rp" + (price * qty).toLocaleString('id-ID');
                }
            }

            // Handle radio button changes for image type selector
            radios.forEach(radio => {
                radio.addEventListener("change", function () {
                    // Remove active class from all image option panels
                    document.querySelectorAll('.image-option.tab-panel').forEach(panel => {
                        panel.classList.remove('active');
                    });
                    // Add active class to selected image option panel
                    this.closest('.image-option.tab-panel').classList.add('active');
                    updateHiddenFieldsAndTotal();
                });
            });

            // Quantity controls
            const minusBtn = document.querySelector('.qty-btn.minus');
            const plusBtn = document.querySelector('.qty-btn.plus');
            
            if (minusBtn) {
                minusBtn.addEventListener('click', function() {
                    let qty = parseInt(qtyInput.value);
                    if (qty > 1) {
                        qtyInput.value = qty - 1;
                        updateHiddenFieldsAndTotal();
                    }
                });
            }

            if (plusBtn) {
                plusBtn.addEventListener('click', function() {
                    let qty = parseInt(qtyInput.value);
                    qtyInput.value = qty + 1;
                    updateHiddenFieldsAndTotal();
                });
            }

            if (qtyInput) {
                qtyInput.addEventListener("input", updateHiddenFieldsAndTotal);
            }

            // Initial setup
            updateHiddenFieldsAndTotal();

            // ===============================
            // PRODUCT TABS FUNCTIONS
            // ===============================
            const tabHeaders = document.querySelectorAll('.tab-header-item');
            const tabPanels = document.querySelectorAll('.product-tab-panel');
            
            tabHeaders.forEach(header => {
                header.addEventListener('click', function() {
                    const targetTab = this.dataset.tab;
                    
                    // Remove active class from all headers and panels
                    tabHeaders.forEach(h => h.classList.remove('active'));
                    tabPanels.forEach(p => p.classList.remove('active'));
                    
                    // Add active class to clicked header
                    this.classList.add('active');
                    
                    // Add active class to corresponding panel
                    const targetPanel = document.getElementById(targetTab);
                    if (targetPanel) {
                        targetPanel.classList.add('active');
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
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ===============================
            // IMAGE TYPE SELECTOR FUNCTIONS
            // ===============================
            const radios = document.querySelectorAll('input[name="image_type"]');
            const selectedPrice = document.getElementById("selectedPrice");
            const selectedFile = document.getElementById("selectedFile");
            const selectedType = document.getElementById("selectedType");
            const qtyInput = document.getElementById("qty");
            const totalHarga = document.getElementById("totalHarga");
            const displayPrice = document.getElementById("displayPrice");

            function updateHiddenFieldsAndTotal() {
                const selected = document.querySelector('input[name="image_type"]:checked');
                if (!selected) return;

                const price = parseInt(selected.dataset.price || 0);
                const qty = parseInt(qtyInput.value || 1);

                selectedPrice.value = selected.dataset.price;
                selectedFile.value = selected.dataset.file;
                selectedType.value = selected.dataset.typeName;

                // Update harga satuan (jika ada element displayPrice)
                if (displayPrice) {
                    displayPrice.textContent = "Rp" + price.toLocaleString('id-ID');
                }

                // Update total
                if (totalHarga) {
                    totalHarga.textContent = "Rp" + (price * qty).toLocaleString('id-ID');
                }
            }

            // Handle radio button changes for image type selector
            radios.forEach(radio => {
                radio.addEventListener("change", function () {
                    // Remove active class from all image option panels
                    document.querySelectorAll('.image-option').forEach(panel => {
                        panel.classList.remove('image-active'); // Ganti dari 'active' ke 'image-active'
                    });
                    // Add active class to selected image option panel
                    this.closest('.image-option').classList.add('image-active'); // Ganti dari 'active' ke 'image-active'
                    updateHiddenFieldsAndTotal();
                });
            });

            // Quantity controls
            const minusBtn = document.querySelector('.qty-btn.minus');
            const plusBtn = document.querySelector('.qty-btn.plus');
            
            if (minusBtn) {
                minusBtn.addEventListener('click', function() {
                    let qty = parseInt(qtyInput.value);
                    if (qty > 1) {
                        qtyInput.value = qty - 1;
                        updateHiddenFieldsAndTotal();
                    }
                });
            }

            if (plusBtn) {
                plusBtn.addEventListener('click', function() {
                    let qty = parseInt(qtyInput.value);
                    qtyInput.value = qty + 1;
                    updateHiddenFieldsAndTotal();
                });
            }

            if (qtyInput) {
                qtyInput.addEventListener("input", updateHiddenFieldsAndTotal);
            }

            // Initial setup
            updateHiddenFieldsAndTotal();

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
        });
    </script>
     


</body>

</html>