<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @include('frontend.layout.css')
    <style>
        .payment-methods {
            margin-bottom: 24px;
        }
        
        .payment-options {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }
        
        .payment-method input[type="radio"] {
            display: none;
        }
        
        .method-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 100px;
        }
        
        .payment-method input[type="radio"]:checked + .method-label {
            border-color: #6366f1;
            background-color: rgba(99, 102, 241, 0.05);
        }
        
        .method-icon {
            width: 40px;
            height: 40px;
            margin-bottom: 8px;
        }
        
        .bank-details {
            background: rgba(241, 245, 249, 0.5);
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 24px;
        }
        
        .bank-details h4 {
            margin-top: 0;
            color: #334155;
        }
        
        .bank-info {
            margin-bottom: 12px;
        }
        
        .note {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 0;
        }
    </style>
</head>

<body>
 
    @include('frontend.layout.header')
        <main class="main">
            <div class="auth-container">
                <div class="form-wrapper">
                    <div class="form-side">
                        <div class="form-header">
                            <h1 class="form-title">Complete Your Payment</h1>
                            <p class="form-subtitle">Membership Fee: Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                        </div>

                        <div class="payment-methods">
                            <h3 class="section-title">Select Payment Method</h3>
                            
                            <div class="payment-options">
                                <div class="payment-method">
                                    <input type="radio" name="payment_method" id="bank-transfer" value="bank_transfer" checked>
                                    <label for="bank-transfer" class="method-label">
                                        <img src="{{ asset('images/bank-transfer.png') }}" alt="Bank Transfer" class="method-icon">
                                        <span>Bank Transfer</span>
                                    </label>
                                </div>
                                
                                <div class="payment-method">
                                    <input type="radio" name="payment_method" id="gopay" value="gopay">
                                    <label for="gopay" class="method-label">
                                        <img src="{{ asset('images/gopay.png') }}" alt="Gopay" class="method-icon">
                                        <span>Gopay</span>
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
                                <p><strong>Amount:</strong> Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                            </div>
                            <p class="note">Please transfer the exact amount and upload your payment proof below.</p>
                        </div>

                        <form method="POST" action="{{ route('member.payment.process', $payment->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Upload Payment Proof</label>
                                <input type="file" name="payment_proof" class="form-input" accept="image/*,.pdf" required>
                            </div>

                            <button type="submit" class="submit-btn">Complete Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
 <!-- Footer Start -->
    @include('frontend.layout.footer')
    
    
    <!-- jQuery dan Turn.js CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.1/turn.min.js"></script>
    
    @include('frontend.layout.js')
</body>

</html>
