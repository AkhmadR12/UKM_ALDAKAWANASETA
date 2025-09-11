<!-- Meta tags -->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>POTó</title>
<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
<link href="{{ asset('logo/alas.png') }}" rel="icon">
{{-- <link rel="icon" href="{{ asset('admin/assets/img/logo/fav.ico') }}" type="image/x-icon" /> --}}
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&display=swap" rel="stylesheet">
<style>
    /* resources/css/app.css */
    .form-control.is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + 0.75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(0.375em + 0.1875rem) center;
        background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
    }

    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }

    .is-invalid ~ .invalid-feedback {
        display: block;
    }
    /* Untuk jarak antar tombol */
    .d-flex.flex-wrap {
        margin: -3px;
    }
    .d-flex.flex-wrap > * {
        margin: 3px;
    }

    /* Untuk hover effect pada tombol */
    .btn-sm {
        transition: all 0.3s ease;
    }
    .btn-sm:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
</style>
<!-- Fonts and icons -->
<script src="{{ asset('admin/assets/js/plugin/webfont/webfont.min.js') }}"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["{{ asset('admin/assets/css/fonts.min.css') }}"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

<!-- CSS Files -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
{{-- <link rel="stylesheet" href="admin/assets/css/bootstrap.min.css" /> --}}
<link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/assets/css/plugins.min.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/assets/css/kaiadmin.min.css') }}" />

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />
