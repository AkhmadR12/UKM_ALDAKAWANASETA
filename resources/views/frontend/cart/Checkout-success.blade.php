<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Berhasil</title>
     @include('frontend.layout.css')
    <style>
        .success-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        
        .success-header {
            text-align: center;
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        
        .success-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        
        .transaction-details {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .detail-header {
            background: #f8f9fa;
            padding: 15px;
            font-weight: bold;
            border-bottom: 1px solid #e9ecef;
        }
        
        .detail-content {
            padding: 20px;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f1f1f1;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .items-list {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .item-row {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .item-row:last-child {
            border-bottom: none;
        }
        
        .item-info {
            flex: 1;
        }
        
        .item-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .item-details {
            color: #666;
            font-size: 14px;
        }
        
        .item-price {
            font-weight: bold;
            color: #007bff;
        }
        
        .total-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .btn-group {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        
        .btn {
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn:hover {
            opacity: 0.8;
        }
        
        .status-badge {
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .status-proses {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        
        @media (max-width: 768px) {
            .btn-group {
                flex-direction: column;
            }
            
            .detail-row {
                flex-direction: column;
                gap: 5px;
            }
            
            .item-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    @include('frontend.layout.header')
    <!-- Modal Search End -->
    <main class="main">
        <div class="success-container">
            <!-- Success Header -->
            <div class="success-header">
                <div class="success-icon">✅</div>
                <h1>Pembayaran Berhasil Dikirim!</h1>
                <p>Terima kasih atas pembelian Anda. Bukti pembayaran Anda sedang dalam proses verifikasi.</p>
            </div>

            <!-- Transaction Details -->
            <div class="transaction-details">
                <div class="detail-header">
                    Detail Transaksi
                </div>
                <div class="detail-content">
                    <div class="detail-row">
                        <span>Kode Transaksi:</span>
                        <strong>{{ $transaction->transaction_code }}</strong>
                    </div>
                    <div class="detail-row">
                        <span>Tanggal:</span>
                        <span>{{ $transaction->created_at->format('d F Y, H:i') }}</span>
                    </div>
                    <div class="detail-row">
                        <span>Status:</span>
                        <span class="status-badge status-proses">{{ ucfirst($transaction->status) }}</span>
                    </div>
                    <div class="detail-row">
                        <span>Pembeli:</span>
                        <span>{{ $user->name }}</span>
                    </div>
                </div>
            </div>

            <!-- Items Purchased -->
            @if($transaction->isCartCheckout())
            <div class="items-list">
                <div class="detail-header">
                    Item yang Dibeli ({{ $transaction->transactionItems->count() }} item)
                </div>
                @foreach($transaction->transactionItems as $item)
                    <div class="item-row">
                        <div class="item-info">
                            <div class="item-name">{{ $item->product->name }}</div>
                            <div class="item-details">
                                Harga: Rp{{ number_format($item->price, 0, ',', '.') }} × {{ $item->quantity }}
                            </div>
                        </div>
                        <div class="item-price">
                            Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                        </div>
                    </div>
                @endforeach
            </div>
            @else
            <div class="items-list">
                <div class="detail-header">
                    Produk yang Dibeli
                </div>
                <div class="item-row">
                    <div class="item-info">
                        <div class="item-name">{{ $transaction->product->name }}</div>
                    </div>
                    <div class="item-price">
                        Rp{{ number_format($transaction->amount, 0, ',', '.') }}
                    </div>
                </div>
            </div>
            @endif

            <!-- Total -->
            <div class="total-section">
                <h2>Total Pembayaran: <span style="color: #007bff;">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span></h2>
            </div>

            <!-- Information -->
            <div class="transaction-details">
                <div class="detail-header">
                    Informasi Penting
                </div>
                <div class="detail-content">
                    <ul style="margin: 0; padding-left: 20px;">
                        <li>Bukti pembayaran Anda sedang dalam proses verifikasi oleh admin</li>
                        <li>Anda akan menerima notifikasi email setelah pembayaran dikonfirmasi</li>
                        <li>Proses verifikasi biasanya memakan waktu 1-2 hari kerja</li>
                        <li>Simpan kode transaksi ini untuk referensi Anda</li>
                    </ul>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="btn-group">
                <a href="{{ route('cart.index') }}" class="btn btn-secondary">Kembali ke Keranjang</a>
                <a href="/" class="btn btn-primary">Lanjut Belanja</a>
            </div>
        </div>
    </main>     

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
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
            selectAllCheckbox.addEventListener('change', function() {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateTotalAndButton();
            });

            // Individual checkbox change
            itemCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTotalAndButton);
            });

            // Dropdown toggle
            dropdownToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function() {
                dropdownMenu.style.display = 'none';
            });

            // Select all items button
            selectAllItemsBtn.addEventListener('click', function() {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = true;
                });
                updateTotalAndButton();
                dropdownMenu.style.display = 'none';
            });

            // Clear selection button
            clearSelectionBtn.addEventListener('click', function() {
                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                updateTotalAndButton();
                dropdownMenu.style.display = 'none';
            });

            // Remove selected items
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

                if (confirm('Apakah Anda yakin ingin menghapus ' + selectedItems.length + ' item dari keranjang?')) {
                    // Create form to submit delete request
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '/cart/remove-multiple'; // You need to create this route
                    
                    // Add CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);
                    
                    // Add selected items
                    selectedItems.forEach(itemId => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'cart_items[]';
                        input.value = itemId;
                        form.appendChild(input);
                    });
                    
                    // Submit form
                    document.body.appendChild(form);
                    form.submit();
                }
                
                dropdownMenu.style.display = 'none';
            });

            // Form submission validation
            document.getElementById('cartForm').addEventListener('submit', function(e) {
                const checkedItems = document.querySelectorAll('.cart-item-checkbox:checked');
                
                if (checkedItems.length === 0) {
                    e.preventDefault();
                    alert('Pilih minimal satu item untuk checkout.');
                    return false;
                }
            });

            // Initialize on page load
            updateTotalAndButton();
        });
    </script>
</body>
</html>