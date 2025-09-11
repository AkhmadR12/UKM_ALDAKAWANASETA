<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Masa Keanggotaan</title>
    @include('admin.css')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .header {
            background: #1e293b;
            color: #ffffff;
            text-align: center;
            padding: 20px;
            font-size: 20px;
            font-weight: bold;
        }
        .content {
            padding: 20px;
            color: #333333;
            line-height: 1.6;
        }
        .content p {
            margin: 10px 0;
        }
        .btn {
            display: inline-block;
            background: #2563eb;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            margin-top: 15px;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            background: #f1f1f1;
            color: #666666;
            font-size: 12px;
            padding: 15px;
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
                    <div class="logo-header" data-background-color="blue2">
                        {{-- <a href="index.html" class="logo">
                            <img src="admin/assets/img/logo/logo-ligh.svg" alt="navbar brand" class="navbar-brand"
                                height="20" />
                        </a> --}}
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
                </x-app-layout>
                {{-- @include('admin.navbar') --}}
                <!-- End Navbar -->
            </div>
            <!-- body -->
            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Berkas</h3>
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
                                <a href="#">Tables</a>
                            </li>

                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Pemberitahuan Masa Keanggotaan</h4> 
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="header">
                                        Fotografer Indonesia
                                    </div>
                                    <div class="content">
                                        <p>Halo, <strong>{{ $member->name }}</strong>,</p>
                                        <p>Masa keanggotaan Anda akan berakhir pada <strong>{{ $member->tanggal_berakhir->format('d-m-Y') }}</strong>.</p>
                                        <p>Segera perpanjang keanggotaan Anda agar tetap aktif dan menikmati semua layanan kami.</p>

                                        <a href="{{ url('/perpanjang/'.$member->id_member) }}" class="btn">Perpanjang Sekarang</a>

                                        <p>Terima kasih telah menjadi bagian dari komunitas kami.</p>
                                    </div>
                                    <div class="footer">
                                        &copy; {{ date('Y') }} Fotografer Indonesia. All Rights Reserved.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @include('admin.footer')
        </div>
    </div>
    @include('admin.js')
</body>
</html>
