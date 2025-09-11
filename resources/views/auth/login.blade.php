 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])  
    @include('frontend.layout.css')
    <style>
         
        .auth-container {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: 
                /* linear-gradient(135deg, rgba(99, 102, 241, 0.9) 0%, rgba(139, 92, 246, 0.9) 50%, rgba(217, 70, 239, 0.9) 100%), */
                url('{{ asset('logo/pemandangan.jpg') }}');
            background-blend-mode: overlay;
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Efek parallax */
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .auth-container *{
            box-sizing: border-box;
        }
        .auth-container *::before,
        .auth-container *::after {
            content: '';
            position: absolute;
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.15;
            z-index: 0;
            pointer-events: none;
        }
        /* Lensa kamera besar */
        .auth-container::before {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="45" fill="none" stroke="white" stroke-width="2"/><circle cx="50" cy="50" r="35" fill="none" stroke="white" stroke-width="1"/><circle cx="50" cy="50" r="15" fill="white"/></svg>');
            width: 300px;
            height: 300px;
            top: -50px;
            right: -50px;
            animation: float 25s linear infinite;
        }

        /* Elemen kamera kecil */
        .auth-container::after {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><rect x="20" y="30" width="60" height="40" fill="none" stroke="white" stroke-width="2"/><circle cx="50" cy="40" r="15" fill="none" stroke="white" stroke-width="2"/><rect x="35" y="65" width="30" height="5" fill="white"/></svg>');
            width: 150px;
            height: 150px;
            bottom: -30px;
            left: -30px;
            animation: float 20s linear infinite reverse;
        }

        /* Tambahan elemen floating */
        .camera-element {
            position: absolute;
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 1;/* Transparan agar tidak mengganggu form */
            z-index: 0; /* Di belakang form */
            pointer-events: none; /* Tidak mengganggu interaksi pengguna */
            animation: float 30s linear infinite;
        }

        .camera-element.tripod {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M50,10 L50,90 M30,50 L70,50 M40,30 L60,30" stroke="white" stroke-width="2" fill="none"/></svg>');
            width: 100px;
            height: 100px;
            top: 20%;
            left: 10%;
        }

        .camera-element.watermark {
            background-image: url('logo/watermark.png');
            /* background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M50,10 L50,30 M50,70 L50,90 M10,50 L30,50 M70,50 L90,50 M20,20 L40,40 M60,60 L80,80 M20,80 L40,60 M60,40 L80,20" stroke="white" stroke-width="1.5" fill="none"/><circle cx="50" cy="50" r="15" fill="none" stroke="white" stroke-width="1"/></svg>'); */
            width: 120px;
            height: 120px;
            top: 15%;
            right: 15%;
            animation-duration: 10s;
        }
        .camera-element.aperture {
            /* background-image: url('logo/watermark.png'); */
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><path d="M50,10 L50,30 M50,70 L50,90 M10,50 L30,50 M70,50 L90,50 M20,20 L40,40 M60,60 L80,80 M20,80 L40,60 M60,40 L80,20" stroke="white" stroke-width="1.5" fill="none"/><circle cx="50" cy="50" r="15" fill="none" stroke="white" stroke-width="1"/></svg>');
            width: 120px;
            height: 120px;
            bottom: 15%;
            right: 15%;
            animation-duration: 35s;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            25% {
                transform: translate(30px, 30px) rotate(15deg);
            }
            150% {
                transform: translate(0, 20px) rotate(0deg);
            }
            75% {
                transform: translate(-30px, 30px) rotate(-5deg);
            }
            100% {
                transform: translate(0, 0) rotate(0deg);
            }
        }

        .form-wrapper {
            position: relative;
            width: 520px;
            height: auto;
            min-height: 840px;
            perspective: 1000px;
            margin-top: 60px;
            margin-bottom: 30px;
            z-index: 1;
        }

        .form-container {
            position: relative;
            width: 100%;
            height: auto;
            min-height: 680px;
            transform-style: preserve-3d;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-container.flipped {
            transform: rotateY(180deg);
        }

        .form-side {
            position: absolute;
            width: 100%;
            height: auto;
            min-height: 680px;
            backface-visibility: hidden;
            background: rgba(255, 255, 255, 0.98);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 24px;
            padding: 32px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .signup-form {
            transform: rotateY(180deg);
        }

        .login-form {
            transform: rotateY(0deg);
        }

        .form-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .form-title {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 8px 0;
            background: linear-gradient(135deg, #0097d5, #02648b);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-subtitle {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: #6366f1;
            background: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.15);
        }

        .form-input::placeholder {
            color: #a0aec0;
        }

        .password-group {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 67%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #a0aec0;
            cursor: pointer;
            padding: 4px;
            transition: color 0.2s;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .password-icon {
            width: 20px;
            height: 20px;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-checkbox {
            width: 16px;
            height: 16px;
            accent-color: #667eea;
        }

        .forgot-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #764ba2;
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #0097d5, #99cf13);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(247, 99, 99, 0.411);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .form-divider {
            text-align: center;
            margin: 16px 0;
            position: relative;
            color: #94a3b8;
            font-size: 14px;
        }

        .form-divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
            z-index: 1;
        }

        .form-divider span {
            background: rgba(255, 255, 255, 0.95);
            padding: 0 16px;
            position: relative;
            z-index: 2;
        }

        .social-login {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
        }

        .social-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.8);
            color: #475569;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            border-color: #6366f1;
            background: rgba(255, 255, 255, 1);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .social-icon {
            width: 20px;
            height: 20px;
        }

        .form-switch {
            text-align: center;
            margin-top: 16px;
        }

        .switch-text {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .switch-link {
            color: #0097d5;
            font-weight: 600;
            cursor: pointer;
            transition: color 0.2s;
        }

        .switch-link:hover {
            color: #02374d;
        }

        .form-row {
            display: flex;
            gap: 12px;
        }

        .form-row .form-group {
            flex: 1;
        }

        .terms-text {
            color: #64748b;
            font-size: 12px;
            line-height: 1.4;
            margin-top: 8px;
            margin-bottom: 16px;
        }

        .terms-link {
            color: #0097d5;
            text-decoration: none;
        }

        .terms-link:hover {
            text-decoration: underline;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-side {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .auth-container {
                min-height: 100vh;
                padding: 10px;
            }
            
            .form-wrapper {
                width: 100%;
                max-width: 400px;
                margin-top: 30px;
                margin-bottom: 40px;
            }
            
            .form-side {
                padding: 24px;
                min-height: 600px;
            }
            
            .social-login {
                flex-direction: column;
            }
            
            .form-title {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .form-side {
                padding: 20px;
                border-radius: 16px;
            }
            
            .form-input {
                padding: 12px 16px;
            }
            
            .submit-btn {
                padding: 14px;
            }
        }
    </style>
</head>
<body>
    @include('frontend.layout.header')
    
    <div class="auth-container">
        <div class="form-wrapper">
            <div class="form-container" id="formContainer">
                <!-- Login Form (sekarang di depan) -->
                <div class="form-side login-form">
                    <div class="form-header">
                        <h1 class="form-title">Welcome Back</h1>
                        <p class="form-subtitle">Sign in to your account</p>
                    </div>

                    {{-- <div class="social-login">
                        <a href="{{ url('/auth/google') }}" class="social-btn">
                            <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            Google
                        </a>
                        <a href="{{ url('/auth/facebook') }}" class="social-btn">
                            <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/>
                            </svg>
                            Facebook
                        </a>
                    </div> --}}

                    {{-- <div class="form-divider">
                        <span>or sign in with email</span>
                    </div> --}}
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input id="login_email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-input" placeholder="Fotograferindonesia@gmail.com" required>
                            @error('email')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group password-group">
                            <label class="form-label">Password</label>
                            <input id="login_password" type="password" name="password" class="form-input" placeholder="Enter your password" required>
                            <button type="button" class="password-toggle">
                                <svg class="password-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                            @error('password')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-options">
                            <div class="checkbox-group">
                                <input type="checkbox" class="form-checkbox" id="remember">
                                <label for="remember" class="form-label">Remember me</label>
                            </div>
                            {{-- <a href="#" class="forgot-link">Forgot password?</a> --}}
                        </div>

                        <button type="submit" class="submit-btn">Sign In</button>
                    </form>
                    <div class="form-switch">
                        <p class="switch-text">
                            Don't have an account? 
                            <span class="switch-link" onclick="flipForm()">Create one</span>
                        </p>
                    </div>
                </div>

                <!-- Signup Form (sekarang di belakang) -->
                <div class="form-side signup-form">
                    <div class="form-header">
                        <h1 class="form-title">Create Account</h1>
                        <p class="form-subtitle">Join us and start your journey</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Name Address</label>
                            <input id="name" type="name" class="form-input" placeholder="Andi" name="name" value="{{ old('name') }}" required autofocus required>
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-input" placeholder="Fotograferindonesia@gmail.com" name="email" value="{{ old('email') }}"required>
                            @error('email')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group password-group">
                            <label class="form-label">Password</label>
                            <input id="password" type="password" class="form-input" name="password" placeholder="Enter your password" required>
                            <button type="button" class="password-toggle">
                                <svg class="password-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                            @error('password')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group password-group">
                            <label class="form-label">Confirm Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-input" placeholder="Enter your password" required>
                            <button type="button" class="password-toggle">
                                <svg class="password-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </button>
                            @error('password_confirmation')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-options">
                            <div class="checkbox-group">
                                <input type="checkbox" class="form-checkbox" id="terms" required>
                                <label for="terms" class="form-label">I agree to the terms</label>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn">Create Account</button>

                        <p class="terms-text">
                            By creating an account, you agree to our 
                            <a href="#" class="terms-link">Terms of Service</a> and 
                            <a href="#" class="terms-link">Privacy Policy</a>
                        </p>
                    </form>

                    <div class="form-switch">
                        <p class="switch-text">
                            Already have an account? 
                            <span class="switch-link" onclick="flipForm()">Sign in</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
     

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tambahkan elemen-elemen fotografi secara dinamis
            const authContainer = document.querySelector('.auth-container');
            
            // Tripod
            const tripod = document.createElement('div');
            tripod.className = 'camera-element tripod';
            authContainer.appendChild(tripod);
            
            // Aperture
            const aperture = document.createElement('div');
            aperture.className = 'camera-element aperture';
            authContainer.appendChild(aperture);
            // Aperture
            const watermark = document.createElement('div');
            watermark.className = 'camera-element watermark';
            authContainer.appendChild(watermark);
            
            // Anda bisa menambahkan lebih banyak elemen di sini
        });
        function flipForm() {
            const container = document.getElementById('formContainer');
            container.classList.toggle('flipped');
        }

        // Toggle password visibility
        document.addEventListener('click', function(e) {
            if (e.target.closest('.password-toggle')) {
                const toggle = e.target.closest('.password-toggle');
                const input = toggle.previousElementSibling;
                const icon = toggle.querySelector('.password-icon');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
                } else {
                    input.type = 'password';
                    icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
                }
            }
        });

        // Add focus effects to inputs
        document.addEventListener('focus', function(e) {
            if (e.target.classList.contains('form-input')) {
                e.target.parentElement.classList.add('focused');
            }
        }, true);

        document.addEventListener('blur', function(e) {
            if (e.target.classList.contains('form-input')) {
                e.target.parentElement.classList.remove('focused');
            }
        }, true);
    </script>
</body>
</html>