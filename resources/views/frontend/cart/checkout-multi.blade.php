<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Multiple Items</title>
    @include('frontend.layout.css')
    <style>
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

        @media (max-width: 768px) {
            .payment-card {
                padding: 20px;
            }
            
            .payment-title {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
       @include('frontend.layout.header')
    <!-- Modal Search End -->
    <main class="main">
        <div class="payment-container">
            <div class="payment-card">
                <h3 class="payment-title"><i class="fas fa-file-upload"></i> Upload Bukti Pembayaran</h3>
                <div class="checkout-header">
                    <h2><i class="fas fa-shopping-cart"></i> Checkout Pesanan</h2>
                    <div class="checkout-steps">
                        <div class="step active"><span>1</span> Keranjang</div>
                        <div class="step active"><span>2</span> Checkout</div>
                        <div class="step active"><span>3</span> Pembayaran</div>
                        <div class="step"><span>4</span> Selesai</div>
                    </div>
                </div>
                <form action="{{ route('transaction.store') }}" method="POST" enctype="multipart/form-data" class="payment-form">
                    @csrf
                    <input type="hidden" name="transaction_ids" value="{{ implode(',', $transactionIds) }}">

                    <div class="form-group">
                        <label for="proof_of_payment" class="form-label">Bukti Transfer</label>
                        <div class="file-upload-wrapper">
                            <input type="file" name="proof_of_payment" id="proof_of_payment" required accept="image/*,.pdf" class="file-upload-input">
                            <label for="proof_of_payment" class="file-upload-label">
                                <div class="file-upload-content">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span class="file-upload-text">Pilih file atau seret ke sini</span>
                                    <span class="file-upload-hint">Format: JPG, PNG (Maks. 2MB)</span>
                                </div>
                            </label>
                            <div class="file-preview" id="filePreview"></div>
                        </div>
                    </div>

                    <div class="form-submit">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane"></i> Selesaikan Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>     

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('proof_of_payment');
            const filePreview = document.getElementById('filePreview');
            
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) return;
                
                filePreview.innerHTML = '';
                filePreview.style.display = 'block';
                
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        filePreview.appendChild(img);
                        
                        const fileName = document.createElement('div');
                        fileName.textContent = file.name;
                        fileName.style.marginTop = '8px';
                        fileName.style.fontSize = '0.9rem';
                        fileName.style.color = '#555';
                        filePreview.appendChild(fileName);
                    }
                    reader.readAsDataURL(file);
                } else {
                    const fileInfo = document.createElement('div');
                    fileInfo.innerHTML = `
                        <i class="fas fa-file-alt" style="font-size: 3rem; color: #3498db;"></i>
                        <div style="margin-top: 8px; font-size: 0.9rem;">${file.name}</div>
                    `;
                    filePreview.appendChild(fileInfo);
                }
            });
            
            // Drag and drop functionality
            const uploadLabel = document.querySelector('.file-upload-label');
            
            uploadLabel.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadLabel.style.borderColor = '#3498db';
                uploadLabel.style.backgroundColor = '#f0f7ff';
            });
            
            uploadLabel.addEventListener('dragleave', () => {
                uploadLabel.style.borderColor = '#d1d5db';
                uploadLabel.style.backgroundColor = '#f9fafb';
            });
            
            uploadLabel.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadLabel.style.borderColor = '#d1d5db';
                uploadLabel.style.backgroundColor = '#f9fafb';
                
                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    const event = new Event('change');
                    fileInput.dispatchEvent(event);
                }
            });
        });
    </script>
</body>
</html>