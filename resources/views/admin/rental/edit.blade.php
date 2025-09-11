<html>

<head>
    <title>Edit Penyewaan</title>
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
        
        .current-file {
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 1px solid #ddd;
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
                        <h3 class="fw-bold mb-3">Edit Penyewaan</h3>
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
                                <a href="#">Edit</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Rental #{{ $rental->id }}</h4>
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

                                <form action="{{ route('rentals.update', $rental->id) }}" method="POST" enctype="multipart/form-data" id="rentalForm">
                                    @csrf
                                    @method('PUT')
                                    
                                    <!-- Basic Information -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nama Penyewa <span class="required-star">*</span></label>
                                                <input type="text" name="renter_name" class="form-control" 
                                                       placeholder="Masukkan nama penyewa" value="{{ old('renter_name', $rental->renter_name) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Telepon <span class="required-star">*</span></label>
                                                <input type="tel" name="renter_phone" class="form-control" 
                                                       placeholder="Masukkan nomor telepon" value="{{ old('renter_phone', $rental->renter_phone) }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Date Range -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Mulai <span class="required-star">*</span></label>
                                                <input type="date" name="start_date" class="form-control" 
                                                       value="{{ old('start_date', $rental->start_date->format('Y-m-d')) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Selesai <span class="required-star">*</span></label>
                                                <input type="date" name="end_date" class="form-control" 
                                                       value="{{ old('end_date', $rental->end_date->format('Y-m-d')) }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Items Selection -->
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Items <span class="required-star">*</span></label>
                                                <div id="items-container">
                                                    @foreach(old('items', $rental->rentalItems) as $index => $item)
                                                        <div class="item-group row mb-2">
                                                            <div class="col-md-6">
                                                                <select name="items[{{ $index }}][id]" class="form-control">
                                                                    <option value="">Pilih Item</option>
                                                                    @foreach ($items as $itemOption)
                                                                        <option value="{{ $itemOption->id }}" 
                                                                            {{ (is_array($item) ? $item['id'] : $item->item_id) == $itemOption->id ? 'selected' : '' }}
                                                                            data-price="{{ $itemOption->daily_price }}" 
                                                                            data-stock="{{ $itemOption->quantity }}">
                                                                            {{ $itemOption->name }} (stok: {{ $itemOption->quantity }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <input type="number" name="items[{{ $index }}][quantity]" class="form-control" 
                                                                       placeholder="Jumlah" min="1" value="{{ is_array($item) ? $item['quantity'] : $item->quantity }}">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <button type="button" class="btn btn-danger remove-item">-</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                <button type="button" class="btn btn-success mt-2" id="add-item">
                                                    <i class="fa fa-plus"></i> Add Item
                                                </button>

                                                <!-- Total Price Display -->
                                                <div id="total-price-display" class="alert alert-info mt-3">
                                                    <strong>Total Harga: Rp {{ number_format($rental->total_price) }}</strong>
                                                    @php
                                                        $days = $rental->start_date->diffInDays($rental->end_date) + 1;
                                                    @endphp
                                                    <small class="d-block">Durasi: {{ $days }} hari</small>
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
                                                    Tanda Tangan Peminjam
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
                                                <input type="hidden" name="ttd_peminjam" id="ttd_peminjam" value="{{ old('ttd_peminjam') }}">
                                                <div id="signature-status" class="signature-status">
                                                    @if($rental->ttd_peminjam)
                                                        <small class="text-success"><i class="fas fa-check"></i> Tanda tangan sudah tersimpan</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Photo Upload -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Foto Penyewa</label>
                                                <input type="file" 
                                                       name="renter_photo" 
                                                       class="form-control-file renter-photo" 
                                                       accept="image/*">
                                                <div class="current-file mb-2">
                                                    <small>File saat ini:</small>
                                                    <div>
                                                        @if($rental->renter_photo_path)
                                                            <img src="{{ asset($rental->renter_photo_path) }}" alt="Foto Penyewa" style="max-width: 100px; max-height: 100px;">
                                                        @else
                                                            <span class="text-muted">Tidak ada file</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="image-preview renter-photo-preview" style="display: none;">
                                                    <div class="file-input-wrapper">
                                                        <img src="" alt="Preview Foto Penyewa">
                                                        <button type="button" class="remove-file-btn" data-target="renter-photo">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <div class="mt-2">
                                                        <small class="text-muted">Preview Foto Baru</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Document Upload -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Dokumen (KTP/SIM)</label>
                                                <input type="file" 
                                                       name="document" 
                                                       class="form-control-file document" 
                                                       accept="image/*,.pdf">
                                                <div class="current-file mb-2">
                                                    <small>File saat ini:</small>
                                                    <div>
                                                        @if($rental->document_path)
                                                            @if(pathinfo($rental->document_path, PATHINFO_EXTENSION) === 'pdf')
                                                                <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                                                <div>{{ basename($rental->document_path) }}</div>
                                                            @else
                                                                <img src="{{ asset($rental->document_path) }}" alt="Dokumen" style="max-width: 100px; max-height: 100px;">
                                                            @endif
                                                        @else
                                                            <span class="text-muted">Tidak ada file</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="image-preview document-preview" style="display: none;">
                                                    <div class="file-input-wrapper">
                                                        <img src="" alt="Preview Dokumen" style="display: none;">
                                                        <div class="pdf-preview" style="display: none;">
                                                            <i class="fas fa-file-pdf fa-3x text-danger mb-2"></i>
                                                            <p class="mb-0">File PDF berhasil dipilih</p>
                                                            <small class="file-name"></small>
                                                        </div>
                                                        <button type="button" class="remove-file-btn" data-target="document">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <div class="mt-2">
                                                        <small class="text-muted">Preview Dokumen Baru</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Buttons -->
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success btn-lg">
                                                <i class="fas fa-save"></i> Update Penyewaan
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
            let itemIndex = {{ count($rental->rentalItems) }};
            
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
                
                // Load existing signature if available
                @if($rental->ttd_peminjam)
                    const img = new Image();
                    img.onload = function() {
                        canvas.getContext('2d').drawImage(img, 0, 0, canvas.width, canvas.height);
                    };
                    img.src = '{{ $rental->ttd_peminjam }}';
                @endif
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

            // Add new item
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

            // Remove item
            $(document).on('click', '.remove-item', function() {
                if ($('.item-group').length > 1) {
                    $(this).closest('.item-group').remove();
                    calculateTotalPrice();
                } else {
                    alert('Minimal harus ada 1 item!');
                }
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

            // Form reset handler
            $('button[type="reset"]').on('click', function() {
                signaturePad.clear();
                $('#ttd_peminjam').val('');
                $('#signature-status').html('');
                $('.image-preview').hide();
                
                // Reload the page to reset everything properly
                setTimeout(function() {
                    location.reload();
                }, 100);
            });
        });
    </script>
</body>
</html>