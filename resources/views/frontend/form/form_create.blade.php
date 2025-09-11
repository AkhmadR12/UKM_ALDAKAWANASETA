
<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .formbold-form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
            color: #07074d;
        }
        .formbold-form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            margin-bottom: 16px;
            font-size: 14px;
        }
        .formbold-btn {
            background-color: #6a64f1;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .radio-group {
            display: flex;
            gap: 16px;
            margin-bottom: 16px;
        }
        .radio-group input[type="radio"] {
            margin-right: 8px;
        }
        .radio-group {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
        .formbold-main-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 80px;
            min-height: 100vh;
        }
        .formbold-form-wrapper {
            margin: 0 auto;
            max-width: 850px;
            width: 100%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 5px; 
        }
        .formbold-event-wrapper span {
            font-weight: 500;
            font-size: 16px;
            line-height: 24px;
            letter-spacing: 2.5px;
            color: #6a64f1;
            display: inline-block;
            margin-bottom: 12px;
            margin-top: 20px;
        }
        .formbold-event-wrapper h3 {
            font-weight: 700;
            font-size: 28px;
            line-height: 34px;
            color: #07074d;
            width: 100%; /* Diubah dari 60% ke 100% */
            margin: 0 auto 15px; /* Ditambahkan margin auto untuk horizontal centering */
            max-width: 80%; 
        }
        .formbold-event-wrapper h4 {
            font-weight: 600;
            font-size: 20px;
            line-height: 24px;
            color: #07074d;
            width: 100%; /* Diubah dari 60% ke 100% */
            margin: 25px auto 15px; /* Ditambahkan margin auto untuk horizontal centering */
            max-width: 80%; /* Batasi lebar maksimum */
        }
        .formbold-event-wrapper p {
            font-size: 16px;
            line-height: 24px;
            color: #536387;
            max-width: 80%; /* Batasi lebar maksimum */
            margin-left: auto;
            margin-right: auto;
        }
        .formbold-event-details {
            background: #fafafa;
            border: 1px solid #dde3ec;
            border-radius: 5px;
            margin: 25px 0 30px;
            flex-direction: column;
            align-items: center; /* Pusatkan elemen child secara horizontal */
            width: 100%;
        }
        .formbold-event-details h5 {
            color: #07074d;
            font-weight: 600;
            font-size: 18px;
            line-height: 24px;
            padding: 15px 25px;
        }
        .formbold-event-details ul {
            border-top: 1px solid #edeef2;
            padding: 25px;
            margin: 0;
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            row-gap: 14px;
        }
        .formbold-event-details ul li {
            color: #536387;
            font-size: 16px;
            line-height: 24px;
            width: 50%;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .formbold-event-wrapper {
            margin-bottom: 20px;
            text-align: center; /* Pusatkan teks */
            width: 100%; /* Pastikan lebar penuh */
        }
        .formbold-form-title {
            color: #07074d;
            font-weight: 600;
            font-size: 28px;
            line-height: 35px;
            width: 60%;
            margin-bottom: 30px;
        }
        .formbold-input-flex {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }
        .formbold-input-flex > div {
            width: 50%;
            flex: 1;
        }
        .formbold-radio-label {
            display: inline-flex;
            align-items: center;
            margin-right: 15px;
            cursor: pointer;
        }
        .formbold-radio-label input {
            margin-right: 5px;
        }
        .formbold-form-input {
            text-align: left;
            width: 100%;
            padding: 13px 22px;
            border-radius: 5px;
            border: 1px solid #dde3ec;
            background: #ffffff;
            font-weight: 500;
            font-size: 16px;
            color: #536387;
            outline: none;
            resize: none;
        }
        .formbold-form-input:focus {
            border-color: #6a64f1;
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
        }
        .formbold-form-label {
            color: #536387;
            font-size: 14px;
            line-height: 24px;
            display: block;
            margin-bottom: 10px;
        }
        .formbold-policy {
            font-size: 14px;
            line-height: 24px;
            color: #536387;
            width: 70%;
            margin-top: 22px;
        }
        .formbold-policy a {
            color: #6a64f1;
        }
        .formbold-btn {
            text-align: center;
            width: 100%;
            font-size: 16px;
            border-radius: 5px;
            padding: 14px 25px;
            border: none;
            font-weight: 500;
            background-color: #6a64f1;
            color: white;
            cursor: pointer;
            margin-top: 25px;
        }
        .formbold-btn:hover {
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
        }
        .formbold-radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 16px;
        }
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #6a64f1;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-warning {
            color: #856404;
            background-color: #fff3cd;
            border-color: #ffeaa7;
        }
        .text-center {
            text-align: center;
        }
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .formbold-main-wrapper {
                padding: 40px 24px;
            }
            
            .formbold-form-wrapper {
                padding: 30px;
            }
        }

        @media (max-width: 768px) {
            input, select, textarea {
                font-size: 16px !important; /* Mencegah zoom di iOS */
            }
            .formbold-main-wrapper {
                padding: 32px 16px;
                align-items: flex-start; /* Untuk mobile lebih baik start dari atas */
            }
            
            .formbold-form-wrapper {
                padding: 24px;
                max-width: 100%; /* Lebar penuh */
                border-radius: 8px;
            }
            
            .formbold-event-wrapper span {
                margin-top: 10px;
                font-size: 14px;
            }
            
            .formbold-event-wrapper h3 {
                font-size: 24px;
                max-width: 100%;
            }
            
            .formbold-event-wrapper h4 {
                font-size: 18px;
                max-width: 100%;
            }
            
            .formbold-event-wrapper p {
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .formbold-main-wrapper {
                padding: 24px 12px;
            }
            
            .formbold-form-wrapper {
                padding: 20px 16px;
            }
            
            .formbold-event-wrapper span {
                font-size: 13px;
                letter-spacing: 1.5px;
            }
            
            .formbold-event-wrapper h3 {
                font-size: 20px;
                line-height: 28px;
            }
            
            .formbold-event-wrapper h4 {
                font-size: 16px;
                margin: 20px 0 12px;
            }
            
            .formbold-event-wrapper p {
                font-size: 14px;
                line-height: 22px;
            }
        }
    </style>
</head>

<body>
    @include('frontend.layout.header')
    
    <main class="main">
        <div class="formbold-main-wrapper">
            <div class="formbold-form-wrapper">
                @if (!$kategori || !$kategori->active_fields || empty($kategori->active_fields))
                    <div class="alert alert-warning text-center">
                        <h4>Form Tidak Tersedia</h4>
                        <p>Tidak ada form yang aktif untuk kategori ini saat ini. Silakan kembali nanti atau pilih kategori lain.</p>
                        <a href="{{ route('public.form-input.index') }}" class="formbold-btn" style="display: inline-block; text-decoration: none; margin-top: 15px;">
                            Kembali ke Daftar Kategori
                        </a>
                    </div>
                @else
                    <div class="formbold-event-wrapper">
                        <span>Form Inputan</span>
                        <h3>{{ $kategori->nama_kategori ?? 'FotoGrafer Indonesia' }}</h3>

                        @if($kategori->gambar)
                            <img src="{{ asset($kategori->gambar) }}" alt="Gambar Kategori" style="width: 100%; max-width: 490px; height: auto; border-radius: 5px;">
                        @else
                            <img src="{{ asset('default.jpg') }}" alt="Gambar Default" style="width: 100%; max-width: 490px; height: auto; border-radius: 5px;">
                        @endif

                        <h4>Deskripsi</h4>
                        <p>{{ $kategori->deskripsi ?? 'Deskripsi tidak tersedia' }}</p>
                        
                        @if($kategori->tanggal || $kategori->jam || $kategori->lokasi || $kategori->description)
                        <div class="formbold-event-details">
                            <h5>Detail Event</h5>
                            <ul>
                                @if($kategori->tanggal)
                                    <li>Tanggal: {{ $kategori->tanggal }}</li>
                                @endif
                                @if($kategori->jam)
                                    <li>Jam: {{ $kategori->jam }}</li>
                                @endif
                                @if($kategori->lokasi)
                                    <li>Lokasi: {{ $kategori->lokasi }}</li>
                                @endif
                                @if($kategori->description)
                                    <li>Keterangan: {{ $kategori->description }}</li>
                                @endif
                            </ul>
                        </div>
                        @endif
                    </div>

                    <form action="{{ route('public.form-input.store') }}" method="POST" enctype="multipart/form-data" id="dynamic-form">
                        @csrf
                        <h2 class="formbold-form-title">Form Pendaftaran</h2>
                        
                        <!-- Hidden kategori_id -->
                        <input type="hidden" name="kategori_id" value="{{ $kategori->id }}">

                        <!-- Dynamic Fields Container -->
                        <div id="dynamic-fields-container">
                            <div class="loading-spinner" style="margin: 20px auto;"></div>
                            <p style="text-align: center; color: #536387;">Memuat form...</p>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="formbold-btn" id="submit-btn" disabled>
                            <span class="loading-spinner" style="display: none; margin-right: 10px;"></span>
                            Submit Form
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </main>     
     
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kategoriId = {{ $kategori->id ?? 'null' }};
            const formContainer = document.getElementById('dynamic-fields-container');
            const submitBtn = document.getElementById('submit-btn');
            
            if (!kategoriId) {
                return;
            }
            
            // Ambil konfigurasi field saat halaman dimuat
            fetch(`/form/${kategoriId}/fields`)
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    
                    if (data.fields && Array.isArray(data.fields) && data.fields.length > 0) {
                        console.log('Fields found:', data.fields.length);
                        renderDynamicFields(data.fields);
                        submitBtn.disabled = false;
                    } else {
                        console.log('No fields found');
                        formContainer.innerHTML = `
                            <div class="alert alert-warning text-center">
                                <p>Tidak ada field yang aktif untuk kategori ini.</p>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    formContainer.innerHTML = `
                        <div class="alert alert-warning text-center">
                            <p>Terjadi kesalahan saat memuat form: ${error.message}</p>
                            <button onclick="location.reload()" class="btn btn-sm btn-primary mt-2">Refresh Halaman</button>
                        </div>
                    `;
                });
            
            function renderDynamicFields(fields) {
                let html = '';
                
                fields.forEach(field => {
                    // Validasi field properties
                    if (!field.name || !field.type || !field.label) {
                        console.warn('Field tidak lengkap:', field);
                        return;
                    }
                    
                    const requiredAttr = field.required ? 'required' : '';
                    const requiredLabel = field.required ? '*' : '';
                    const fieldLabel = field.label || field.name;
                    const placeholderText = fieldLabel ? fieldLabel.toLowerCase() : 'input';
                    
                    switch(field.type) {
                        case 'text':
                            html += `
                            <div class="form-group mb-3">
                                <label for="${field.name}" class="formbold-form-label">${fieldLabel}${requiredLabel}</label>
                                <input type="text" name="${field.name}" id="${field.name}" 
                                    class="formbold-form-input" ${requiredAttr}
                                    placeholder="Masukkan ${placeholderText}">
                            </div>`;
                            break;
                            
                        case 'email':
                            html += `
                            <div class="form-group mb-3">
                                <label for="${field.name}" class="formbold-form-label">${fieldLabel}${requiredLabel}</label>
                                <input type="email" name="${field.name}" id="${field.name}" 
                                    class="formbold-form-input" ${requiredAttr}
                                    placeholder="contoh@email.com">
                            </div>`;
                            break;
                            
                        case 'number':
                            html += `
                            <div class="form-group mb-3">
                                <label for="${field.name}" class="formbold-form-label">${fieldLabel}${requiredLabel}</label>
                                <input type="number" name="${field.name}" id="${field.name}" 
                                    class="formbold-form-input" ${requiredAttr}
                                    placeholder="Masukkan angka">
                            </div>`;
                            break;
                            
                        case 'textarea':
                            html += `
                            <div class="form-group mb-3">
                                <label for="${field.name}" class="formbold-form-label">${fieldLabel}${requiredLabel}</label>
                                <textarea name="${field.name}" id="${field.name}" 
                                    class="formbold-form-input" rows="4" ${requiredAttr}
                                    placeholder="Masukkan ${placeholderText}"></textarea>
                            </div>`;
                            break;
                            
                        case 'radio':
                            html += `
                            <div class="form-group mb-3">
                                <label class="formbold-form-label">${fieldLabel}${requiredLabel}</label>
                                <div class="formbold-radio-group">`;
                            
                            if (field.options && Array.isArray(field.options) && field.options.length > 0) {
                                field.options.forEach(option => {
                                    if (option.value && option.label) {
                                        html += `
                                        <label class="formbold-radio-label">
                                            <input type="radio" name="${field.name}" value="${option.value}" ${requiredAttr}>
                                            <span>${option.label}</span>
                                        </label>`;
                                    }
                                });
                            } else {
                                html += `<p class="text-muted">Tidak ada pilihan tersedia</p>`;
                            }
                            
                            html += `</div></div>`;
                            break;
                            
                        case 'select':
                            html += `
                            <div class="form-group mb-3">
                                <label for="${field.name}" class="formbold-form-label">${fieldLabel}${requiredLabel}</label>
                                <select name="${field.name}" id="${field.name}" class="formbold-form-input" ${requiredAttr}>
                                    <option value="">Pilih ${fieldLabel}</option>`;
                            
                            if (field.options && Array.isArray(field.options) && field.options.length > 0) {
                                field.options.forEach(option => {
                                    if (option.value && option.label) {
                                        html += `<option value="${option.value}">${option.label}</option>`;
                                    }
                                });
                            }
                            
                            html += `</select></div>`;
                            break;
                            
                        case 'file':
                            const acceptAttr = field.accept ? `accept="${field.accept}"` : '';
                            const fileDescription = field.description || `Upload file ${fieldLabel}`;
                            html += `
                            <div class="form-group mb-3">
                                <label for="${field.name}" class="formbold-form-label">${fieldLabel}${requiredLabel}</label>
                                <input type="file" name="${field.name}" id="${field.name}" 
                                    class="formbold-form-input" ${requiredAttr} ${acceptAttr}>
                                <small class="text-muted d-block mt-1">${fileDescription}</small>
                            </div>`;
                            break;
                            
                        case 'date':
                            html += `
                            <div class="form-group mb-3">
                                <label for="${field.name}" class="formbold-form-label">${fieldLabel}${requiredLabel}</label>
                                <input type="date" name="${field.name}" id="${field.name}" 
                                    class="formbold-form-input" ${requiredAttr}>
                            </div>`;
                            break;
                            
                        case 'time':
                            html += `
                            <div class="form-group mb-3">
                                <label for="${field.name}" class="formbold-form-label">${fieldLabel}${requiredLabel}</label>
                                <input type="time" name="${field.name}" id="${field.name}" 
                                    class="formbold-form-input" ${requiredAttr}>
                            </div>`;
                            break;
                            
                        default:
                            // Fallback ke text input
                            html += `
                            <div class="form-group mb-3">
                                <label for="${field.name}" class="formbold-form-label">${fieldLabel}${requiredLabel}</label>
                                <input type="text" name="${field.name}" id="${field.name}" 
                                    class="formbold-form-input" ${requiredAttr}
                                    placeholder="Masukkan ${placeholderText}">
                            </div>`;
                            break;
                    }
                });
                
                formContainer.innerHTML = html;
            }
            
            // Handle form submission
            document.getElementById('dynamic-form').addEventListener('submit', function(e) {
                const spinner = submitBtn.querySelector('.loading-spinner');
                spinner.style.display = 'inline-block';
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="loading-spinner" style="margin-right: 10px;"></span>Mengirim...';
            });
        });
    </script>

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')

</body>

</html>