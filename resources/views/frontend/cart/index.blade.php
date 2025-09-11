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
        .product-info {
            display: flex;
            align-items: center;
        }

        .item-details {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .cart-item-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }
        .item-type-badge {
            display: flex;
            align-items: center;
        }

        .badge-product {
            background: #28a745;
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-photo {
            background: #007bff;
            color: white;
            padding: 2px 6px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
        }
        .qty-btn {
            width: 30px;
            height: 30px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .qty-btn:hover {
            background: #f8f9fa;
        }

        .qty-display {
            min-width: 30px;
            text-align: center;
            font-weight: 500;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .item-text {
            display: flex;
            flex-direction: column;
            gap: 4px;
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

   

    <!-- Navbar & Hero End -->

    <!-- Modal Search Start -->
    @include('frontend.layout.header')
    <!-- Modal Search End -->
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


        <!-- Success/Error Messages -->
        {{-- @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(count($cartItems) > 0)
            <form id="cartForm" action="{{ route('checkout.multi-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th width="50px"><input type="checkbox" id="selectAll"></th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cartItems as $item)
                            @php 
                                $subtotal = $item->product->price * $item->quantity; 
                                $total += $subtotal; 
                            @endphp
                            <tr>
                                <td>
                                <input type="checkbox" name="cart_items[]" value="{{ $item->id }}" 
                                        class="cart-item-checkbox" data-price="{{ $subtotal }}">
                                </td>
                                <td class="product-name">{{ $item->product->name }}</td>
                                <td class="product-price">Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                                <td class="product-quantity">{{ $item->quantity }}</td>
                                <td class="product-subtotal">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="cart-total">
                    <strong>Total Terpilih: <span id="selectedTotal">Rp0</span></strong>
                </div>
                
                <div class="cart-actions">
                    <div class="checkout-group">
                        <!-- Tombol checkout non-aktif jika tidak ada item yang dipilih -->
                        <button type="submit" class="btn-checkout" disabled id="checkoutButton">
                            <i class="fas fa-shopping-cart"></i> Proses Checkout 
                            <span class="badge" id="selectedCount">0</span>
                        </button>
                        
                        <div class="dropdown-options">
                            <button type="button" class="btn-options" id="dropdownToggle">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button type="button" class="dropdown-item" id="selectAllItems">
                                    <i class="fas fa-check-square"></i> Pilih Semua
                                </button>
                                <button type="button" class="dropdown-item" id="clearSelection">
                                    <i class="far fa-square"></i> Hapus Pilihan
                                </button>
                                <button type="button" class="dropdown-item" id="removeSelected">
                                    <i class="fas fa-trash-alt"></i> Hapus Item Terpilih
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div style="text-align: center; padding: 40px 0;">
                <p style="font-size: 16px; color: #666;">Keranjang belanja Anda kosong</p>
                <button class="btn-continue" style="margin-top: 20px;" onclick="window.location.href='/'">Mulai Belanja</button>
            </div>
        @endif --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(count($cartItems) > 0)
            <form id="cartForm" action="{{ route('checkout.multi-store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th width="50px"><input type="checkbox" id="selectAll"></th>
                            <th>Item</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cartItems as $item)
                            @php 
                                $subtotal = $item->price * $item->quantity; 
                                $total += $subtotal; 
                            @endphp
                            <tr>
                                <td>
                                    <input type="checkbox" name="cart_items[]" value="{{ $item->cart_id }}"
                                    class="cart-item-checkbox"
                                    data-price="{{ $subtotal }}"
                                    data-type="{{ $item->type }}">

                                </td>
                                 
                                <td class="product-info">
                                    <div class="item-details">
                                        <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" 
                                            class="cart-item-image" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                        <div class="item-text">
                                            <div class="product-name">{{ $item->name }}</div>
                                            <div class="item-type-badge">
                                                @if($item->type == 'product')
                                                    <span class="badge-product">Produk</span>
                                                @else
                                                    <span class="badge-photo">Foto</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="product-price">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="product-quantity">
                                    <div class="quantity-controls">
                                        <button type="button" class="qty-btn minus" data-cart-id="{{ $item->id }}" data-type="{{ $item->type }}">-</button>
                                        <span class="qty-display">{{ $item->quantity }}</span>
                                        <button type="button" class="qty-btn plus" data-cart-id="{{ $item->id }}" data-type="{{ $item->type }}">+</button>
                                    </div>
                                </td>
                                <td class="product-subtotal">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="cart-total">
                    <strong>Total Terpilih: <span id="selectedTotal">Rp0</span></strong>
                </div>
                
                <div class="cart-actions">
                    <div class="checkout-group">
                        <button type="submit" class="btn-checkout" disabled id="checkoutButton">
                            <i class="fas fa-shopping-cart"></i> Proses Checkout 
                            <span class="badge" id="selectedCount">0</span>
                        </button>
                        
                        <div class="dropdown-options">
                            <button type="button" class="btn-options" id="dropdownToggle">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button type="button" class="dropdown-item" id="selectAllItems">
                                    <i class="fas fa-check-square"></i> Pilih Semua
                                </button>
                                <button type="button" class="dropdown-item" id="clearSelection">
                                    <i class="far fa-square"></i> Hapus Pilihan
                                </button>
                                <button type="button" class="dropdown-item" id="removeSelected">
                                    <i class="fas fa-trash-alt"></i> Hapus Item Terpilih
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @else
            <div style="text-align: center; padding: 40px 0;">
                <p style="font-size: 16px; color: #666;">Keranjang belanja Anda kosong</p>
                <button class="btn-continue" style="margin-top: 20px;" onclick="window.location.href='/'">Mulai Belanja</button>
            </div>
        @endif
    </div>

    </main>     

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.1/turn.min.js"></script>
      {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const itemCheckboxes = document.querySelectorAll('.cart-item-checkbox');
            const selectedTotalElement = document.getElementById('selectedTotal');
            const checkoutButton = document.querySelector('.btn-checkout');
            
            // Select all items
            selectAllCheckbox.addEventListener('change', function() {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                calculateSelectedTotal();
            });
            
            // Individual item selection
            itemCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    if (!this.checked) {
                        selectAllCheckbox.checked = false;
                    } else {
                        // Check if all items are selected
                        const allChecked = Array.from(itemCheckboxes).every(cb => cb.checked);
                        selectAllCheckbox.checked = allChecked;
                    }
                    calculateSelectedTotal();
                });
            });
            
            // Calculate total for selected items
            function calculateSelectedTotal() {
                let total = 0;
                const selectedItems = document.querySelectorAll('.cart-item-checkbox:checked');
                
                selectedItems.forEach(item => {
                    total += parseInt(item.dataset.price);
                });
                
                selectedTotalElement.textContent = 'Rp' + total.toLocaleString('id-ID');
                
                // Enable/disable checkout button
                checkoutButton.disabled = selectedItems.length === 0;
            }
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('selectAll');
            const itemCheckboxes = document.querySelectorAll('.cart-item-checkbox');
            const checkoutButton = document.getElementById('checkoutButton');
            const selectedTotalSpan = document.getElementById('selectedTotal');
            const selectedCountSpan = document.getElementById('selectedCount');
            const dropdownToggle = document.getElementById('dropdownToggle');
            const dropdownMenu = document.querySelector('.dropdown-menu');
            const selectAllItemsBtn = document.getElementById('selectAllItems');
            const clearSelectionBtn = document.getElementById('clearSelection');
            const removeSelectedBtn = document.getElementById('removeSelected');

            // Function to update total and checkout button
            function updateTotalAndButton() {
                let total = 0;
                let count = 0;
                
                itemCheckboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        total += parseFloat(checkbox.dataset.price);
                        count++;
                    }
                });
                
                selectedTotalSpan.textContent = 'Rp' + total.toLocaleString('id-ID');
                selectedCountSpan.textContent = count;
                
                // Enable/disable checkout button
                checkoutButton.disabled = count === 0;
                
                // Update select all checkbox state
                if (count === 0) {
                    selectAllCheckbox.indeterminate = false;
                    selectAllCheckbox.checked = false;
                } else if (count === itemCheckboxes.length) {
                    selectAllCheckbox.indeterminate = false;
                    selectAllCheckbox.checked = true;
                } else {
                    selectAllCheckbox.indeterminate = true;
                }
            }

            // Select all functionality
            if (selectAllCheckbox) {
                selectAllCheckbox.addEventListener('change', function() {
                    itemCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                    updateTotalAndButton();
                });
            }

            // Individual checkbox change
            itemCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTotalAndButton);
            });

            // Dropdown toggle
            if (dropdownToggle) {
                dropdownToggle.addEventListener('click', function(e) {
                    e.stopPropagation();
                    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
                });
            }

            // Close dropdown when clicking outside
            document.addEventListener('click', function() {
                if (dropdownMenu) {
                    dropdownMenu.style.display = 'none';
                }
            });

            // Select all items button
            if (selectAllItemsBtn) {
                selectAllItemsBtn.addEventListener('click', function() {
                    itemCheckboxes.forEach(checkbox => {
                        checkbox.checked = true;
                    });
                    updateTotalAndButton();
                    dropdownMenu.style.display = 'none';
                });
            }

            // Clear selection button
            if (clearSelectionBtn) {
                clearSelectionBtn.addEventListener('click', function() {
                    itemCheckboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    updateTotalAndButton();
                    dropdownMenu.style.display = 'none';
                });
            }

            // Remove selected items
            if (removeSelectedBtn) {
                removeSelectedBtn.addEventListener('click', function() {
                    const selectedItems = [];
                    itemCheckboxes.forEach(checkbox => {
                        if (checkbox.checked) {
                            selectedItems.push(checkbox.value);
                        }
                    });

                    if (selectedItems.length === 0) {
                        alert('Pilih item yang ingin dihapus terlebih dahulu.');
                        return;
                    }

                     
                    
                    dropdownMenu.style.display = 'none';
                });
            }

            // Form submission validation
            const cartForm = document.getElementById('cartForm');
            if (cartForm) {
                cartForm.addEventListener('submit', function(e) {
                    const checkedItems = document.querySelectorAll('.cart-item-checkbox:checked');
                    
                    if (checkedItems.length === 0) {
                        e.preventDefault();
                        alert('Pilih minimal satu item untuk checkout.');
                        return false;
                    }
                });
            }

            // Initialize on page load
            updateTotalAndButton();
        });
    </script>
</body>

</html>
