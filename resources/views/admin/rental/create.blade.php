<html>

<head>
    <title>POTÃ³</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
    
    @include('admin.css')
    <link rel="icon" href="../assets/img/logo/fav.ico" type="image/x-icon" />

    <style>
        /* Signature Pad Styles */
        .signature-pad {
            border: 2px solid #ddd;
            border-radius: 8px;
            margin: 10px 0;
            background: #fff;
        }
        
        .signature-canvas {
            width: 100%;
            height: 200px;
            border-radius: 6px;
            cursor: crosshair;
            display: block;
        }
        
        .signature-controls {
            padding: 10px;
            background: #f8f9fa;
            border-top: 1px solid #ddd;
            border-radius: 0 0 6px 6px;
        }
        
        /* File Preview Styles */
        .image-preview {
            max-width: 100%;
            margin-top: 10px;
            display: none;
        }
        
        .image-preview img {
            width: 100%;
            max-width: 300px;
            height: auto;
            border: 2px solid #ddd;
            border-radius: 8px;
        }
        
        .pdf-preview {
            padding: 20px;
            background: #f8f9fa;
            border: 2px solid #ddd;
            border-radius: 8px;
            text-align: center;
            max-width: 300px;
        }
        
        .required-star {
            color: red;
        }
        
        .signature-status {
            margin-top: 10px;
        }
        
        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .file-input-wrapper {
            position: relative;
        }
        
        .remove-file-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            z-index: 10;
            background: rgba(220, 53, 69, 0.8);
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            cursor: pointer;
        }
        
        .remove-file-btn:hover {
            background: rgba(220, 53, 69, 1);
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('admin.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="green2">
                        <img src="{{ asset('storage/logo/Logo.png') }}" style="width: 100%;">
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar -->
                <x-app-layout>
                </x-app-layout> <!-- End Navbar -->
            </div>
            
            <!-- body -->
            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Form Penyewaan</h3>
                        <ul class="breadcrumbs mb-3">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="icon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Rentals</a>
                            </li>
                            <li class="separator">
                                <i class="icon-arrow-right"></i>
                            </li>
                            <li class="nav-item">
                                <a href="#">Create</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Create New Rental</h4>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('rentals.store') }}" method="POST" enctype="multipart/form-data" id="rentalForm">
                                    @csrf
                                    
                                    <!-- Basic Information -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Penyewa <span class="required-star">*</span></label>
                                                <input type="text" name="renter_name" class="form-control" 
                                                       placeholder="Masukkan nama penyewa" value="{{ old('renter_name') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Telepon <span class="required-star">*</span></label>
                                                <input type="tel" name="renter_phone" class="form-control" 
                                                       placeholder="Masukkan nomor telepon" value="{{ old('renter_phone') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Date Range -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Mulai <span class="required-star">*</span></label>
                                                <input type="date" name="start_date" class="form-control" 
                                                       value="{{ old('start_date') }}" min="{{ date('Y-m-d') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Selesai <span class="required-star">*</span></label>
                                                <input type="date" name="end_date" class="form-control" 
                                                       value="{{ old('end_date') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Items Selection -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Items <span class="required-star">*</span></label>
                                                <div id="items-container">
                                                    <div class="item-group row mb-2">
                                                        <div class="col-md-6">
                                                            <select name="items[0][id]" class="form-control">
                                                                <option value="">Pilih Item</option>
                                                                @foreach ($items as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }} (stok: {{ $item->quantity }})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="number" name="items[0][quantity]" class="form-control" placeholder="Jumlah" min="1">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <button type="button" class="btn btn-danger remove-item">-</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-success mt-2" id="add-item">
                                                    <i class="fa fa-plus"></i> Add Item
                                                </button>

                                                
                                                <!-- Total Price Display -->
                                                <div id="total-price-display" class="alert alert-info mt-3" style="display: none;">
                                                    <strong>Total Harga: Rp <span id="total-amount">0</span></strong>
                                                    <small class="d-block">Durasi: <span id="duration-days">0</span> hari</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Signature and File Uploads -->
                                    <div class="row">
                                        <!-- Signature Pad -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="signature-label">
                                                    Tanda Tangan Peminjam <span class="required-star">*</span>
                                                </label>
                                                <div class="signature-pad">
                                                    <canvas id="signature-canvas" class="signature-canvas"></canvas>
                                                    <div class="signature-controls">
                                                        <button type="button" class="btn btn-sm btn-secondary" id="clear-signature">
                                                            <i class="fas fa-eraser"></i> Hapus
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-info ml-1" id="save-signature">
                                                            <i class="fas fa-save"></i> Simpan
                                                        </button>
                                                        <div class="mt-2">
                                                            <small class="text-muted">Coretkan tanda tangan pada area di atas</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="ttd_peminjam" id="ttd_peminjam">
                                                <div id="signature-status" class="signature-status"></div>
                                            </div>
                                        </div>
                                        
                                        <!-- Photo Upload -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    Foto Penyewa <span class="required-star">*</span>
                                                </label>
                                                <input type="file" 
                                                       name="renter_photo" 
                                                       class="form-control-file renter-photo" 
                                                       accept="image/*" 
                                                       required>
                                                <div class="image-preview renter-photo-preview">
                                                    <div class="file-input-wrapper">
                                                        <img src="" alt="Preview Foto Penyewa">
                                                        <button type="button" class="remove-file-btn" data-target="renter-photo">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <div class="mt-2">
                                                        <small class="text-muted">Preview Foto Penyewa</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Document Upload -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>
                                                    Dokumen (KTP/SIM) <span class="required-star">*</span>
                                                </label>
                                                <input type="file" 
                                                       name="document" 
                                                       class="form-control-file document" 
                                                       accept="image/*,.pdf" 
                                                       required>
                                                <div class="image-preview document-preview">
                                                    <div class="file-input-wrapper">
                                                        <img src="" alt="Preview Dokumen">
                                                        <div class="pdf-preview">
                                                            <i class="fas fa-file-pdf fa-3x text-danger mb-2"></i>
                                                            <p class="mb-0">File PDF berhasil dipilih</p>
                                                            <small class="file-name"></small>
                                                        </div>
                                                        <button type="button" class="remove-file-btn" data-target="document">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <div class="mt-2">
                                                        <small class="text-muted">Preview Dokumen</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Buttons -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success btn-lg">
                                                <i class="fas fa-save"></i> Simpan Penyewaan
                                            </button>
                                            <a href="{{ route('rentals.index') }}" class="btn btn-danger btn-lg ml-2">
                                                <i class="fa fa-backward"></i> Batal
                                            </a>
                                            <button type="reset" class="btn btn-secondary btn-lg ml-2">
                                                <i class="fas fa-redo"></i> Reset Form
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.js')
    
    <script>
        $(document).ready(function() {
            let itemIndex = 1;
            
            // Get items data from Laravel
            const availableItems = @json($items ?? []);
            
            // Initialize Signature Pad
            const canvas = document.getElementById('signature-canvas');
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 0)',
                velocityFilterWeight: 0.7,
                minWidth: 0.5,
                maxWidth: 2.5,
                throttle: 16,
                minPointDistance: 3,
            });

            // Resize canvas
            function resizeCanvas() {
                const ratio = Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext('2d').scale(ratio, ratio);
                signaturePad.clear();
            }

            // Initialize canvas size
            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();

            // Clear signature
            $('#clear-signature').on('click', function() {
                signaturePad.clear();
                $('#ttd_peminjam').val('');
                $('#signature-status').html('');
            });

            // Save signature
            $('#save-signature').on('click', function() {
                if (signaturePad.isEmpty()) {
                    $('#signature-status').html('<small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Silakan buat tanda tangan terlebih dahulu!</small>');
                    return;
                }

                const dataURL = signaturePad.toDataURL();
                $('#ttd_peminjam').val(dataURL);
                $('#signature-status').html('<small class="text-success"><i class="fas fa-check"></i> Tanda tangan tersimpan</small>');
            });

            // Function untuk generate options HTML
            function generateItemOptions() {
                let options = '<option value="">Pilih Item</option>';
                availableItems.forEach(item => {
                    if (item.quantity > 0) {
                        options += `<option value="${item.id}" data-price="${item.daily_price}" data-stock="${item.quantity}">
                            ${item.name} - Rp ${item.daily_price.toLocaleString()}/hari (Stok: ${item.quantity})
                        </option>`;
                    }
                });
                return options;
            }

            // Function untuk calculate total price
            function calculateTotalPrice() {
                const startDate = $('input[name="start_date"]').val();
                const endDate = $('input[name="end_date"]').val();
                
                if (!startDate || !endDate) {
                    $('#total-price-display').hide();
                    return;
                }
                
                const start = new Date(startDate);
                const end = new Date(endDate);
                const days = Math.ceil((end - start) / (1000 * 60 * 60 * 24)) + 1;
                
                let totalPrice = 0;
                let hasItems = false;
                
                $('.item-row').each(function() {
                    const itemId = $(this).find('select[name*="[id]"]').val();
                    const quantity = parseInt($(this).find('input[name*="[quantity]"]').val()) || 0;
                    const dailyPrice = parseInt($(this).find('select[name*="[id]"] option:selected').data('price')) || 0;
                    
                    if (itemId && quantity > 0) {
                        hasItems = true;
                        const subtotal = dailyPrice * quantity * days;
                        totalPrice += subtotal;
                    }
                });
                
                if (hasItems && days > 0) {
                    $('#total-price-display').show();
                    $('#total-amount').text(totalPrice.toLocaleString());
                    $('#duration-days').text(days);
                } else {
                    $('#total-price-display').hide();
                }
            }
            $('#add-item').on('click', function() {
                let newItem = `
                    <div class="item-group row mb-2">
                        <div class="col-md-6">
                            <select name="items[${itemIndex}][id]" class="form-control">
                                <option value="">Pilih Item</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} (stok: {{ $item->quantity }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="items[${itemIndex}][quantity]" class="form-control" placeholder="Jumlah" min="1">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-item">-</button>
                        </div>
                    </div>
                `;
                $('#items-container').append(newItem);
                itemIndex++;
            });

            $(document).on('click', '.remove-item', function() {
                $(this).closest('.item-group').remove();
            });

            // File preview function
            function previewFile(input, previewSelector) {
                const file = input.files[0];
                const $preview = $(previewSelector);
                
                if (file) {
                    const fileType = file.type;
                    const fileName = file.name;
                    
                    if (fileType.startsWith('image/')) {
                        // Image preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            $preview.find('img').attr('src', e.target.result).show();
                            $preview.find('.pdf-preview').hide();
                            $preview.show();
                        };
                        reader.readAsDataURL(file);
                    } else if (fileType === 'application/pdf') {
                        // PDF preview
                        $preview.find('img').hide();
                        $preview.find('.pdf-preview').show();
                        $preview.find('.file-name').text(fileName);
                        $preview.show();
                    }
                } else {
                    $preview.hide();
                }
            }

            // File input change handlers
            $('input[name="renter_photo"]').on('change', function() {
                previewFile(this, '.renter-photo-preview');
            });

            $('input[name="document"]').on('change', function() {
                previewFile(this, '.document-preview');
            });

            // Remove file handlers
            $(document).on('click', '.remove-file-btn', function() {
                const target = $(this).data('target');
                
                if (target === 'renter-photo') {
                    $('input[name="renter_photo"]').val('');
                    $('.renter-photo-preview').hide();
                } else if (target === 'document') {
                    $('input[name="document"]').val('');
                    $('.document-preview').hide();
                }
            });

            // Remove item functionality
            $(document).on('click', '.remove-item', function() {
                if ($('.item-row').length > 1) {
                    $(this).closest('.item-row').remove();
                    calculateTotalPrice();
                } else {
                    alert('Minimal harus ada 1 item!');
                }
            });

            // Date validation
            $('input[name="start_date"]').on('change', function() {
                const startDate = $(this).val();
                $('input[name="end_date"]').attr('min', startDate);
                calculateTotalPrice();
            });

            // Form reset handler
            $('button[type="reset"]').on('click', function() {
                signaturePad.clear();
                $('#ttd_peminjam').val('');
                $('#signature-status').html('');
                $('.image-preview').hide();
                $('#total-price-display').hide();
            });

            // Form submission validation
            $('#rentalForm').on('submit', function(e) {
                // Validate items and stock
                let hasError = false;
                let errorMessages = [];
                
                $('.item-row').each(function() {
                    const $row = $(this);
                    const itemSelect = $row.find('select[name*="[id]"]');
                    const quantityInput = $row.find('input[name*="[quantity]"]');
                    
                    const itemId = itemSelect.val();
                    const quantity = parseInt(quantityInput.val()) || 0;
                    const maxStock = parseInt(itemSelect.find('option:selected').data('stock')) || 0;
                    const itemName = itemSelect.find('option:selected').text().split(' - ')[0];
                    
                    if (itemId && quantity > maxStock) {
                        hasError = true;
                        errorMessages.push(`${itemName}: Quantity melebihi stok tersedia (${maxStock})`);
                    }
                });
                
                if (hasError) {
                    e.preventDefault();
                    alert('Error:\n' + errorMessages.join('\n'));
                    return false;
                }

                // Validate signature
                if (signaturePad.isEmpty() && !$('#ttd_peminjam').val()) {
                    e.preventDefault();
                    alert('Silakan buat tanda tangan terlebih dahulu!');
                    $('#signature-status').html('<small class="text-danger"><i class="fas fa-exclamation-triangle"></i> Tanda tangan diperlukan!</small>');
                    return false;
                }
                
                // Auto-save signature if not already saved
                if (!signaturePad.isEmpty() && !$('#ttd_peminjam').val()) {
                    const dataURL = signaturePad.toDataURL();
                    $('#ttd_peminjam').val(dataURL);
                }
                
                return true;
            });

            // Initialize calculations on page load
            calculateTotalPrice();
            
            // Trigger item info display for pre-selected items (from old input)
            $('.item-select').trigger('change');
        });
    </script>
</body>
</html>