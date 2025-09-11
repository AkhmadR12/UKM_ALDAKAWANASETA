<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <link rel="icon" href="../assets/img/logo/fav.ico" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .badge {
            padding: 0.35em 0.65em;
            font-size: 0.75em;
            font-weight: 700;
            letter-spacing: 0.05em;
            border-radius: 0.25rem;
        }
        
        .badge-warning {
            color: #000;
            background-color: #ffc107;
        }
        
        .badge-primary {
            color: #fff;
            background-color: #0d6efd;
        }
        
        .badge-success {
            color: #fff;
            background-color: #198754;
        }
        
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }
        
        .btn-sm i {
            margin-right: 3px;
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
                                        <h4 class="card-title">Carausel</h4>
                                        <a href="{{ route('payments.create') }}" class="btn btn-primary btn-round ms-auto">
                                            <i class="fa fa-plus"></i>
                                            tambah
                                        </a>
                                        {{-- @endif --}}
                                    </div>
                                </div>                
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="add-row" class="display table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nomor</th>
                                                    <th>Nama</th>
                                                    <th>Harga</th>
                                                    <th>Status</th>
                                                    <th>Gambar</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($payments as $index => $payment)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $payment->user->name ?? '-' }}</td>
                                                    <td>{{ format_rupiah($payment->amount) }}</td>
                                                    <td>
                                                        @if($payment->status === 'pending')
                                                            <span class="badge badge-warning">Menunggu</span>
                                                        @elseif($payment->status === 'proses') <!-- Perhatikan typo disini (proses/proses) -->
                                                            <span class="badge badge-primary">Proses</span>
                                                        @else
                                                            <span class="badge badge-success">Selesai</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($payment->proof_of_payment)
                                                            <img src="{{ asset($payment->proof_of_payment) }}" alt="Proof of Payment" width="100">
                                                        @endif                                                    
                                                    </td>
                                                    <td>
                                                        @if($payment->status === 'proses')
                                                            <form action="{{ route('payments.update-status', $payment->id) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    <i class="fas fa-check"></i> Tandai Selesai
                                                                </button>
                                                            </form>
                                                        @else
                                                            <button class="btn btn-sm 
                                                                @if($payment->status === 'pending') btn-warning
                                                                @elseif($payment->status === 'done') btn-success disabled
                                                                @endif">
                                                                @if($payment->status === 'pending')
                                                                    <i class="fas fa-clock"></i> Menunggu
                                                                @else
                                                                    <i class="fas fa-check-circle"></i> Selesai
                                                                @endif
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @include('admin.footer')
        </div>
        <!-- End Custom template -->
        {{-- @include('admin.custume') --}}
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    @include('admin.js')
    <script>
        $(document).ready(function() {
            $('.toggle-status-btn').on('click', function() {
                let button = $(this);
                let id = button.data('id');

                $.ajax({
                    url: '/carousel/toggle-status/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update status di button
                            button.text(response.status.charAt(0).toUpperCase() + response.status.slice(1));
                            button.data('status', response.status);

                            // Opsional: beri warna berbeda
                            if(response.status === 'aktif') {
                                button.removeClass('btn-danger').addClass('btn-success');
                            } else {
                                button.removeClass('btn-success').addClass('btn-danger');
                            }
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>