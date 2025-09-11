<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Photograp Indonesia</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- @include('frontend.layout.css') --}}
    {{-- <link href="admin/assets/img/logo/fav.ico" rel="icon"> --}}
     <link href="{{ asset('logo/FI_APP.ico') }}" rel="icon">
    <link href="{{ asset('home/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
 <!-- Vendor CSS Files -->
    <link href="{{ asset('home/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('home/assets/css/main.css') }}" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Bundle JS (sudah termasuk Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    {{-- @include('frontend.layout.css') --}}
   
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
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            box-shadow: 0 -1px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 60px;
            z-index: 1000;
            border-top: 1px solid #ddd;
        }

        .mobile-bottom-nav .nav-icon {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 14px;
            text-decoration: none;
            color: #333;
            }

            .mobile-bottom-nav .nav-icon i {
            font-size: 18px;
            }

            .mobile-bottom-nav .nav-icon.active {
            color: #0d6efd; /* Bootstrap primary */
        }
        .cards-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
         .cards-list {
            z-index: 0;
            width: 100%;
            display: grid;
            justify-content: center;
            gap: 20px;
            grid-template-columns: repeat(4, 1fr);  
            flex-wrap: wrap;
        }

        .card {
            width: 100%;
            height: 100%;
            border-radius: 20px;
            box-shadow: 5px 5px 20px 5px rgba(0,0,0,0.2), -5px -5px 20px 5px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: 0.3s;
            overflow: hidden;
            position: relative;
        }
        .card .card_image {
            width: 100%;
            height: 100%;
            border-radius: 20px;
        }

        .card .card_image img {
            width: 100%;
            height: 100%;
            border-radius: 20px;
            object-fit: cover;
        }

        .card .card_title {
            text-align: center;
            border-radius: 0 0 20px 20px;
            font-family: sans-serif;
            font-weight: bold;
            font-size: 18px;
            margin-top: -60px;
            height: 40px;
            background-color: rgba(0, 0, 0, 0.5); 
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .card:hover {
            transform: scale(0.9, 0.9);
            box-shadow: 5px 5px 30px 15px rgba(0,0,0,0.25), 
                -5px -5px 30px 15px rgba(0,0,0,0.22);
        }
        .btn-primary {
            background: #06C167;
            border-color: #06C167;
        }
        
        .btn-primary:hover {
            background: #059652;
            border-color: #059652;
        }
        
        .form-control:focus {
            border-color: #06C167;
            box-shadow: 0 0 0 0.2rem rgba(6, 193, 103, 0.25);
        }
        
        .edit-mode {
            display: none;
        }
        .profile-card {
            border: none;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 15px;
        }
        
        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
        }
        
        .list-group-item {
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .list-group-item:hover {
            background-color: #f8f9fa;
        }
         
        .list-group-item.active {
            background: #06C167 !important;
            border-color: #068648;
        }
        .bg-warning {
            background: #06C167 !important;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 4% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 70%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
            /*transform: translateY(-100%);*/
        }
        .close {
            float: right;
            text-align: right;
            font-size: 30px;
        }
        .modal-content h2 {
            text-align: center;
            margin-top: -35px;
        }
        .button_div {
            justify-content: center;
            text-align: center;
        }
        .button_div button {
            margin-right: 10px;
            background: #06C167;
            border: 1px solid #06C167;
            padding: 5px 15px;
            color: #FFFFFF;
            border-radius: 2px;
        }
        #addAddressForm input {
            padding: 5px;
        }
        .nice-select {
            padding: 0px !important;
            height: 38px !important;
            line-height: 38px !important;
        }
        
        .add_address_button {
            background: #06C167;
            border: 1px solid #06C167;
            padding: 5px 15px;
            color: #FFFFFF;
            border-radius: 2px;
        }
        .info-label {
            font-weight: 600;
            color: #495057;
            min-width: 120px;
        }
        
        .info-value {
            color: #212529;
            flex: 1;
            text-align: right;
        }
        
        .alert {
            border-radius: 10px;
        }
        .view-mode {
            display: block;
        }
        
        .profile-info-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .member-upgrade-card {
            border: 2px solid #06C167;
            border-radius: 15px;
            background: linear-gradient(135deg, #06C167 0%, #04A258 100%);
            color: white;
        }
        
        .member-form-card {
            border: 1px solid #dee2e6;
            border-radius: 15px;
        }
        
        .upload-area {
            border: 2px dashed #06C167;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }
        
        .upload-area:hover {
            background-color: #e9ecef;
            border-color: #04A258;
        }
        .upload-area.dragover {
            background-color: #e7f3ff;
            border-color: #06C167;
        }
        
        .file-input {
            display: none;
        }
        
        .current-data-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        
        .payment-method-card {
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .payment-method-card:hover {
            border-color: #06C167;
            background-color: #f8f9fa;
        }
        
        .payment-method-card.selected {
            border-color: #06C167;
            background-color: #e7f3ff;
        }
        
        .payment-method-card input[type="radio"] {
            display: none;
        }

        @media (max-width: 768px) {
            .main_flex_div {
                display: flex;
                flex-direction: column;
            }
            .inner_flex_div {
                min-width: 100% !important;
            }
            .modal-content {
                padding: 10px 0px !important;
                min-width: 95% !important;
                height: 700px;
                overflow: scroll;
            }
            .close {
                margin-right: 10px;
            }
            /* end common class */
            .top-status ul {
                list-style: none;
                display: flex;
                justify-content: space-around;
                justify-content: center;
                flex-wrap: wrap;
                padding: 0;
                margin: 0;
            }
            .top-status ul li {
                width: 120px;
                height: 120px;
                border-radius: 50%;
                background: #fff;
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;
                border: 8px solid #ddd;
                box-shadow: 1px 1px 10px 1px #ddd inset;
                margin: 10px 5px;
            }
            .top-status ul li.active {
                border-color: #06C167;
                box-shadow: 1px 1px 20px 1px #ffc107 inset;
            }
            /* end top status */

            ul.timeline {
                list-style-type: none;
                position: relative;
            }
            ul.timeline:before {
                content: ' ';
                background: #d4d9df;
                display: inline-block;
                position: absolute;
                left: 29px;
                width: 2px;
                height: 100%;
                z-index: 400;
            }
            ul.timeline > li {
                margin: 20px 0;
                padding-left: 30px;
            }
            ul.timeline > li:before {
                content: '\2713';
                background: #fff;
                display: inline-block;
                position: absolute;
                border-radius: 50%;
                border: 0;
                left: 5px;
                width: 50px;
                height: 50px;
                z-index: 400;
                text-align: center;
                line-height: 50px;
                color: #d4d9df;
                font-size: 24px;
                border: 2px solid var(--ogenix-primary);
            }
            ul.timeline > li.active:before {
                content: '\2713';
                background: #28a745;
                display: inline-block;
                position: absolute;
                border-radius: 50%;
                border: 0;
                left: 5px;
                width: 50px;
                height: 50px;
                z-index: 400;
                text-align: center;
                line-height: 50px;
                color: #fff;
                font-size: 30px;
                border: 2px solid var(--ogenix-primary);
            }
            .info-row {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .info-value {
                text-align: left;
                margin-top: 5px;
            }
        }
        /* end timeline */
    </style>
    
</head>

<body>
 
    @include('frontend.layout.header')
    
    <main class="main">
        <section class="my-5">
            <div class="container">
                <div class="main-body">
                    <div class="row">
                        <!-- Di bagian atas view -->
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <form id="avatarForm" action="{{ route('profile.update.avatar') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <input type="file" name="photo" id="avatarInput" class="d-none" accept="image/*" onchange="document.getElementById('avatarForm').submit();">

                                            <img 
                                                src="{{ $user->photo ? asset($user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=06C167&color=fff&size=120' }}"
                                                alt="Profile"
                                                class="rounded-circle profile-img mb-3"
                                                style="cursor: pointer; width: 120px; height: 120px; object-fit: cover;"
                                                onclick="document.getElementById('avatarInput').click();">
                                        </form>

                                        <h4>{{ $user->name }}</h4>
                                        <p class="text-secondary mb-1">{{ $user->contact ?? 'No contact info' }}</p>
                                        <p class="text-muted font-size-sm">{{ $user->kota->name ?? 'Location not set' }}</p>
                                    </div>

                                    <div class="list-group list-group-flush text-center mt-4">
                                        <a href="#" class="list-group-item list-group-item-action border-0 active" onclick="showProfileDetails()">
                                            Profile Informaton
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action border-0" onclick="showOrderDetails()">Member</a>
                                        
                                        
                                        <a href="#" class="list-group-item list-group-item-action border-0">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="col-lg-8">
                                {{-- member --}}
                                
                                <div  id="orderDetails" class="order_card">
                                    <form method="POST" action="{{ route('profile.upgrade-member') }}" enctype="multipart/form-data" id="memberUpgradeForm">
                                        @csrf
                                        <input type="hidden" name="kota_id" value="{{ $user->kota_id }}">
                                        <input type="hidden" name="tanggal_bergabung" value="{{ now()->format('Y-m-d') }}">

                                        <div class="card mt-4">
                                            <div class="card-body p-0 table-responsive">
                                                <h4 class="p-3 mb-0"><i class="fas fa-star me-2"></i>User</h4>
                                                <table class="table mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Email</th>
                                                            <th scope="col">City</th>
                                                            <th scope="col">Gender</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            
                                                            <th>
                                                                {{ $user->name }}
                                                            </th>
                                                            <td>{{ $user->email }}.</td>
                                                            <td>{{ $user->kota->name ?? 'Not selected' }}</td>
                                                            <td>{{ $user->kelamin ?? 'Not provided' }}</td>
                                                            <td><span class="badge bg-primary">{{ ucfirst($user->role) }}</span></td>
                                                        </tr>
                                                        @if ($user->role !== 'member')
                                                            <th colspan="3">
                                                                {{-- pilih metode pembayaran --}}
                                                                <div class="col-12 mb-4">
                                                                    <h6 class="mb-3">
                                                                        <i class="fas fa-credit-card me-2"></i>Select Payment Method
                                                                    </h6>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="payment-method-card" onclick="selectPaymentMethod('bank_transfer')">
                                                                                <input type="radio" name="payment_method" value="bank_transfer" id="bank_transfer">
                                                                                <div class="text-center">
                                                                                    <i class="fas fa-university fa-2x text-primary mb-2"></i>
                                                                                    <h6>Bank Transfer</h6>
                                                                                    <small class="text-muted">Transfer via ATM/Mobile Banking</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="payment-method-card" onclick="selectPaymentMethod('ewallet')">
                                                                                <input type="radio" name="payment_method" value="ewallet" id="ewallet">
                                                                                <div class="text-center">
                                                                                    <i class="fas fa-wallet fa-2x text-success mb-2"></i>
                                                                                    <h6>E-Wallet</h6>
                                                                                    <small class="text-muted">OVO, GoPay, DANA, dll</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="payment-method-card" onclick="selectPaymentMethod('cash')">
                                                                                <input type="radio" name="payment_method" value="cash" id="cash">
                                                                                <div class="text-center">
                                                                                    <i class="fas fa-money-bill-wave fa-2x text-warning mb-2"></i>
                                                                                    <h6>Cash</h6>
                                                                                    <small class="text-muted">Bayar tunai di lokasi</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Upload Bukti Transfer -->
                                                                <div class="col-12 mb-4">
                                                                    <h6 class="mb-3">
                                                                        <i class="fas fa-upload me-2"></i>Upload Payment Proof
                                                                        <span class="text-danger">*</span>
                                                                    </h6>
                                                                    <div class="upload-area" onclick="triggerFileInput()">
                                                                        <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                                                        <h6>Click to upload or drag and drop</h6>
                                                                        <p class="text-muted mb-0">PNG, JPG, JPEG (Max 2MB)</p>
                                                                        <input type="file" id="bukti_tf" name="bukti_tf" accept="image/*" class="file-input" onchange="handleFileSelect(event)" required>
                                                                    </div>
                                                                    <div id="file-preview" class="mt-3" style="display: none;">
                                                                        <div class="alert alert-success d-flex align-items-center">
                                                                            <i class="fas fa-check-circle me-2"></i>
                                                                            <span id="file-name"></span>
                                                                            <button type="button" class="btn-close ms-auto" onclick="removeFile()"></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- Member Benefits -->
                                                                <div class="col-12 mb-4">
                                                                    <h6 class="mb-3">
                                                                        <i class="fas fa-star me-2"></i>Member Benefits
                                                                    </h6>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <ul class="list-unstyled">
                                                                                <li><i class="fas fa-check text-success me-2"></i>Exclusive member discounts</li>
                                                                                <li><i class="fas fa-check text-success me-2"></i>Priority customer support</li>
                                                                                <li><i class="fas fa-check text-success me-2"></i>Access to member-only events</li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <ul class="list-unstyled">
                                                                                <li><i class="fas fa-check text-success me-2"></i>Monthly newsletters</li>
                                                                                <li><i class="fas fa-check text-success me-2"></i>Special member ID card</li>
                                                                                <li><i class="fas fa-check text-success me-2"></i>Loyalty points system</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- Terms and Conditions -->
                                                                <div class="col-12 mb-4">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                                                                        <label class="form-check-label" for="terms">
                                                                            I agree to the <a href="#" class="text-decoration-none">Terms and Conditions</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                
                                                                <!-- Submit Button -->
                                                                <div class="col-12">
                                                                    <button type="submit" class="btn btn-success btn-lg w-100">
                                                                        <i class="fas fa-star me-2"></i>Upgrade to Member
                                                                    </button>
                                                                </div> 
                                                            </th>
                                                        @else
                                                            <tr>
                                                                <td colspan="5" class="text-center text-danger fw-bold">
                                                                    ANDA TELAH MENJADI MEMBER. MOHON TUNGGU SEBELUM MEMBUKA DASHBOARD. SILAHKAN HUBUNGI ADMIN.
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div> 
                                    </form> 
                                </div>
                                {{-- profile --}}
                                <div id="profileDetails" class="card profile-card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <h5 class="mb-0">
                                                <i class="fas fa-user-edit me-2"></i>Profile Information
                                            </h5>
                                            <button type="button" class="btn btn-primary btn-sm" id="editBtn" onclick="toggleEditMode()">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </button>
                                        </div>
                                        
                                        <!-- View Mode -->
                                        <div id="viewMode" class="view-mode">
                                            <div class="profile-info-card">
                                                <div class="info-row">
                                                    <span class="info-label">Name:</span>
                                                    <span class="info-value">{{ $user->name }}</span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Email:</span>
                                                    <span class="info-value">{{ $user->email }}</span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Contact:</span>
                                                    <span class="info-value">{{ $user->contact ?? 'Not provided' }}</span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Date of Birth:</span>
                                                    <span class="info-value">{{ $user->ttl ?? 'Not provided' }}</span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Gender:</span>
                                                    <span class="info-value">{{ $user->kelamin ?? 'Not provided' }}</span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">City:</span>
                                                    <span class="info-value">{{ $user->kota->name ?? 'Not selected' }}</span>
                                                </div>
                                                <div class="info-row">
                                                    <span class="info-label">Role:</span>
                                                    <span class="info-value">
                                                        <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Edit Mode -->
                                        <div id="editMode" class="edit-mode">
                                            <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
                                                @csrf
                                                @method('PUT')
                                                
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                                        @error('name')
                                                            <div class="text-danger small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="col-md-6 mb-3">
                                                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                                        @error('email')
                                                            <div class="text-danger small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="col-md-6 mb-3">
                                                        <label for="contact" class="form-label">Contact</label>
                                                        <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact', $user->contact) }}">
                                                        @error('contact')
                                                            <div class="text-danger small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="col-md-6 mb-3">
                                                        <label for="ttl" class="form-label">Date of Birth</label>
                                                        <input type="date" class="form-control" id="ttl" name="ttl" value="{{ old('ttl', $user->ttl) }}">
                                                        @error('ttl')
                                                            <div class="text-danger small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="col-md-6 mb-3">
                                                        <label for="kelamin" class="form-label">Gender</label>
                                                        <select class="form-select" id="kelamin" name="kelamin">
                                                            <option value="">Select Gender</option>
                                                            <option value="male" {{ old('kelamin', $user->kelamin) == 'male' ? 'selected' : '' }}>Male</option>
                                                            <option value="female" {{ old('kelamin', $user->kelamin) == 'female' ? 'selected' : '' }}>Female</option>
                                                        </select>
                                                        @error('kelamin')
                                                            <div class="text-danger small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="col-md-6 mb-3">
                                                        <label for="kota_id" class="form-label">City</label>
                                                        <select class="form-select" id="kota_id" name="kota_id">
                                                            <option value="">Select City</option>
                                                            @foreach($cities as $city)
                                                                <option value="{{ $city->id }}" {{ old('kota_id', $user->kota_id) == $city->id ? 'selected' : '' }}>
                                                                    {{ $city->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        @error('kota_id')
                                                            <div class="text-danger small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="col-12 mb-3">
                                                        <label for="password" class="form-label">New Password (Leave empty if not changing)</label>
                                                        <input type="password" class="form-control" id="password" name="password">
                                                        @error('password')
                                                            <div class="text-danger small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="col-12 mb-3">
                                                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                                    </div>
                                                </div>
                                                
                                                <div class="d-flex gap-2">
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-save me-1"></i>Save Changes
                                                    </button>
                                                    <button type="button" class="btn btn-secondary" onclick="cancelEdit()">
                                                        <i class="fas fa-times me-1"></i>Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Edit Mode -->
                                {{-- <div id="editMode" class="edit-mode">
                                    
                                    <form id="profileForm" method="POST" action="{{ route('profile.update') }}">
                                        @csrf
                                        @method('PUT')
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                                @error('name')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                                @error('email')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-md-6 mb-3">
                                                <label for="contact" class="form-label">Contact</label>
                                                <input type="text" class="form-control" id="contact" name="contact" value="{{ old('contact', $user->contact) }}">
                                                @error('contact')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-md-6 mb-3">
                                                <label for="ttl" class="form-label">Date of Birth</label>
                                                <input type="date" class="form-control" id="ttl" name="ttl" value="{{ old('ttl', $user->ttl) }}">
                                                @error('ttl')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-md-6 mb-3">
                                                <label for="kelamin" class="form-label">Gender</label>
                                                <select class="form-select" id="kelamin" name="kelamin">
                                                    <option value="">Select Gender</option>
                                                    <option value="male" {{ old('kelamin', $user->kelamin) == 'male' ? 'selected' : '' }}>Male</option>
                                                    <option value="female" {{ old('kelamin', $user->kelamin) == 'female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                                @error('kelamin')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-md-6 mb-3">
                                                <label for="kota_id" class="form-label">City</label>
                                                <select class="form-select" id="kota_id" name="kota_id">
                                                    <option value="">Select City</option>
                                                    @foreach($cities as $city)
                                                        <option value="{{ $city->id }}" {{ old('kota_id', $user->kota_id) == $city->id ? 'selected' : '' }}>
                                                            {{ $city->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('kota_id')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-12 mb-3">
                                                <label for="password" class="form-label">New Password (Leave empty if not changing)</label>
                                                <input type="password" class="form-control" id="password" name="password">
                                                @error('password')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            
                                            <div class="col-12 mb-3">
                                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save me-1"></i>Save Changes
                                            </button>
                                            <button type="button" class="btn btn-secondary" onclick="cancelEdit()">
                                                <i class="fas fa-times me-1"></i>Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div> --}}
                            </div>
                    </div>
                </div>
            </div>
             
        </section>
    </main>
   
     <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
     
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
         <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
  
    <script>
          
        function showAddAddressModal() {
            const modal = document.getElementById('addAddressModal');
            modal.style.display = 'block';
            isFormVisible = true;
        }

        function closeAddAddressModal() {
            const modal = document.getElementById('addAddressModal');
            modal.style.display = 'none';
            isFormVisible = false;
        }
          
        function showProfileDetails() {
            hideAllSections();
            document.getElementById('profileDetails').style.display = 'block';
            setActiveLink(0);
        }
        function toggleEditMode() {
            const viewMode = document.getElementById('viewMode');
            const editMode = document.getElementById('editMode');
            const editBtn = document.getElementById('editBtn');
            
            if (viewMode.style.display !== 'none') {
                // Switch to edit mode
                viewMode.style.display = 'none';
                editMode.style.display = 'block';
                editBtn.style.display = 'none';
            }
        }
        
        function cancelEdit() {
            const viewMode = document.getElementById('viewMode');
            const editMode = document.getElementById('editMode');
            const editBtn = document.getElementById('editBtn');
            
            // Switch back to view mode
            viewMode.style.display = 'block';
            editMode.style.display = 'none';
            editBtn.style.display = 'inline-block';
            
            // Reset form
            document.getElementById('profileForm').reset();
        }

        function showOrderDetails() {
            hideAllSections();
            document.getElementById('orderDetails').style.display = 'block';
            setActiveLink(1);
        }

        

        function hideAllSections() {
            document.getElementById('orderDetails').style.display = 'none';
            document.getElementById('profileDetails').style.display = 'none';
        }

        function setActiveLink(index) {
            document.querySelector('.list-group-item.active').classList.remove('active');
            document.querySelectorAll('.list-group-item')[index].classList.add('active');
        }

        showProfileDetails();
        // Payment method selection
        // document.addEventListener('DOMContentLoaded', function() {
        function selectPaymentMethod(method) {
            // Remove selected class from all cards
            document.querySelectorAll('.payment-method-card').forEach(card => {
                card.classList.remove('selected');
            });
            
            // Add selected class to clicked card
            event.currentTarget.classList.add('selected');
            
            // Check the radio button
            document.getElementById(method).checked = true;
        }
        
        // File upload functions
        function triggerFileInput() {
            document.getElementById('bukti_tf').click();
        }
        
        function handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                // Validate file type
                if (!file.type.startsWith('image/')) {
                    alert('Please select an image file');
                    return;
                }
                
                // Validate file size (2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File size must be less than 2MB');
                    return;
                }
                
                // Show file preview
                document.getElementById('file-preview').style.display = 'block';
                document.getElementById('file-name').textContent = file.name;
            }
        }
        
        function removeFile() {
            document.getElementById('bukti_tf').value = '';
            document.getElementById('file-preview').style.display = 'none';
        }
        
        // Drag and drop functionality
        const uploadArea = document.querySelector('.upload-area');
        
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });
        
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });
        
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('bukti_tf').files = files;
                handleFileSelect({target: {files: files}});
            }
        });
        
        // Form submission
        document.getElementById('memberUpgradeForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate form
            const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
            const buktiTf = document.getElementById('bukti_tf').files[0];
            const terms = document.getElementById('terms').checked;
            
            if (!paymentMethod) {
                alert('Please select a payment method');
                return;
            }
            
            if (!buktiTf) {
                alert('Please upload payment proof');
                return;
            }
            
            if (!terms) {
                alert('Please agree to terms and conditions');
                return;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
            submitBtn.disabled = true;
            
            // Submit form
            this.submit();
        });
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            showMemberUpgrade(); // Show member upgrade by default
        });
        // });
    </script>

</body>

</html>