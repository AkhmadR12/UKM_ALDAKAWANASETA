<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @include('frontend.layout.css')
    <style>
        .main {
            margin-top: 30px;
            padding: 0 20px;
        }

        .auth-container {
            max-width: 1200px;
            margin: 0 auto;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .form-wrapper {
            padding: 40px;
        }

        .form-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            align-items: start;
        }

        .form-left, .form-right {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e2e8f0;
        }

        .form-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-subtitle {
            font-size: 1.1rem;
            color: #64748b;
            font-weight: 500;
            background: linear-gradient(135deg, #f59e0b, #ef4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .form-section {
            margin-bottom: 32px;
            padding: 24px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }

        .form-section:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            margin: 0 0 20px 0;
            color: #1e293b;
            font-size: 1.3rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::before {
            content: '';
            width: 4px;
            height: 24px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 2px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            transform: translateY(-1px);
        }

        .payment-methods {
            margin-bottom: 32px;
            padding: 24px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.06);
        }
        
        .payment-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        
        .payment-method input[type="radio"] {
            display: none;
        }
        
        .method-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(5px);
            text-align: center;
        }

        .method-label:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .payment-method input[type="radio"]:checked + .method-label {
            border-color: #6366f1;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.2);
        }
        
        .method-icon {
            width: 48px;
            height: 48px;
            margin-bottom: 12px;
            border-radius: 8px;
            object-fit: contain;
        }

        .method-label span {
            font-weight: 600;
            color: #374151;
            font-size: 0.9rem;
        }
        
        .bank-details {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(147, 51, 234, 0.05));
            border: 2px solid rgba(59, 130, 246, 0.1);
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 32px;
            position: relative;
            overflow: hidden;
        }

        .bank-details::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6, #9333ea);
        }
        
        .bank-details h4 {
            margin: 0 0 20px 0;
            color: #1e293b;
            font-size: 1.2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bank-details h4::before {
            content: '🏦';
            font-size: 1.5rem;
        }
        
        .bank-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }

        .bank-info p {
            margin: 0;
            padding: 12px 16px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            border-left: 4px solid #3b82f6;
        }

        .bank-info strong {
            color: #1e293b;
            font-weight: 600;
        }
        
        .note {
            font-size: 0.9rem;
            color: #6b7280;
            margin: 0;
            padding: 16px;
            background: rgba(251, 191, 36, 0.1);
            border-radius: 10px;
            border-left: 4px solid #f59e0b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .note::before {
            content: '💡';
            font-size: 1.2rem;
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(99, 102, 241, 0.4);
            background: linear-gradient(135deg, #5856eb, #7c3aed);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 16px;
            border: 2px dashed #d1d5db;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
            color: #6b7280;
        }

        .file-input-label:hover {
            border-color: #6366f1;
            background: rgba(99, 102, 241, 0.05);
            color: #6366f1;
        }

        .file-input-label i {
            font-size: 1.2rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main {
                padding: 0 15px;
            }

            .form-wrapper {
                padding: 20px;
            }

            .form-title {
                font-size: 1.8rem;
            }

            .form-layout {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .payment-options {
                grid-template-columns: 1fr;
            }

            .bank-info {
                grid-template-columns: 1fr;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-section {
            animation: fadeInUp 0.6s ease forwards;
        }

        .form-section:nth-child(2) { animation-delay: 0.1s; }
        .form-section:nth-child(3) { animation-delay: 0.2s; }
        .form-section:nth-child(4) { animation-delay: 0.3s; }
    </style>
</head>

<body>
    @include('frontend.layout.header')
    <main class="main">
        <div class="auth-container">
            <div class="form-wrapper">
                <div class="form-header">
                    <h1 class="form-title">Member Registration & Payment</h1>
                    <p class="form-subtitle">Membership Fee: Rp {{ number_format($paymentAmount, 0, ',', '.') }}</p>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('member.process-register-payment') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-layout">
                        <!-- Left Side - Personal Information -->
                        <div class="form-left">
                            <div class="form-section">
                                <h3 class="section-title">Personal Information</h3>
                                
                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-input" value="{{ old('name') }}" placeholder="Enter your full name" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone" class="form-input" value="{{ old('phone') }}" placeholder="Enter your phone number" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="Enter your email address" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">City</label>
                                    <select name="kota_id" class="form-input form-select" required>
                                        <option value="">Select your city</option>
                                        @foreach($kabupatenKotas as $kota)
                                            <option value="{{ $kota->id }}">{{ $kota->name }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-input" placeholder="Create a password" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-input" placeholder="Confirm your password" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Join Date</label>
                                    <input type="date" name="tanggal_bergabung" class="form-input" value="{{ old('tanggal_bergabung', date('Y-m-d')) }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-label">Profile Photo</label>
                                    <div class="file-input-wrapper">
                                        <input type="file" name="photo" id="photo" accept="image/*" required>
                                        <label for="photo" class="file-input-label">
                                            <i class="fas fa-camera"></i>
                                            <span>Choose profile photo</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Payment Method & Proof -->
                        <div class="form-right">
                            <div class="payment-methods">
                                <h3 class="section-title">Select Payment Method</h3>
                                
                                <div class="payment-options">
                                    <div class="payment-method">
                                        <input type="radio" name="payment_method" id="bank-transfer" value="bank_transfer" checked>
                                        <label for="bank-transfer" class="method-label">
                                            <img src="{{ asset('images/bank.png') }}" alt="Bank Transfer" class="method-icon">
                                            <span>Bank Transfer</span>
                                        </label>
                                    </div>
                                    
                                    <div class="payment-method">
                                        <input type="radio" name="payment_method" id="gopay" value="gopay">
                                        <label for="gopay" class="method-label">
                                            <img src="{{ asset('images/gopay.png') }}" alt="Gopay" class="method-icon">
                                            <span>GoPay</span>
                                        </label>
                                    </div>
                                    
                                    <div class="payment-method">
                                        <input type="radio" name="payment_method" id="ovo" value="ovo">
                                        <label for="ovo" class="method-label">
                                            <img src="{{ asset('images/ovo.png') }}" alt="OVO" class="method-icon">
                                            <span>OVO</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="bank-details">
                                <h4>Bank Transfer Instructions</h4>
                                <div class="bank-info">
                                    <p><strong>Bank Name:</strong> BCA (Bank Central Asia)</p>
                                    <p><strong>Account Number:</strong> 1234567890</p>
                                    <p><strong>Account Name:</strong> Fotografer Indonesia</p>
                                    <p><strong>Amount:</strong> Rp {{ number_format($paymentAmount, 0, ',', '.') }}</p>
                                </div>
                                <p class="note">Please transfer the exact amount and upload your payment proof below.</p>
                            </div>

                            <div class="form-section">
                                <h3 class="section-title">Payment Proof</h3>
                                <div class="form-group">
                                    <label class="form-label">Upload Payment Proof</label>
                                    <div class="file-input-wrapper">
                                        <input type="file" name="payment_proof" id="payment_proof" accept="image/*,.pdf" required>
                                        <label for="payment_proof" class="file-input-label">
                                            <i class="fas fa-upload"></i>
                                            <span>Choose payment proof file (Image or PDF)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-check-circle" style="margin-right: 10px;"></i>
                        Complete Registration & Payment
                    </button>
                </form>
            </div>
        </div>
    </main>
    
    @include('frontend.layout.footer')
    
    <!-- jQuery dan Turn.js CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.1/turn.min.js"></script>
    
    @include('frontend.layout.js')

    <script>
        // File input preview
        document.getElementById('photo').addEventListener('change', function(e) {
            const label = e.target.nextElementSibling;
            const span = label.querySelector('span');
            if (e.target.files.length > 0) {
                span.textContent = e.target.files[0].name;
                label.style.borderColor = '#6366f1';
                label.style.color = '#6366f1';
            }
        });

        document.getElementById('payment_proof').addEventListener('change', function(e) {
            const label = e.target.nextElementSibling;
            const span = label.querySelector('span');
            if (e.target.files.length > 0) {
                span.textContent = e.target.files[0].name;
                label.style.borderColor = '#6366f1';
                label.style.color = '#6366f1';
            }
        });
    </script>
</body>
</html>

 