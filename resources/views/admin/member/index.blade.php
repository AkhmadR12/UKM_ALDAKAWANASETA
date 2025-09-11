<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <link rel="icon" href="../assets/img/logo/fav.ico" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <style>
        
        table th , table td{
            text-align: center;
        }

        table tr:nth-child(even){
            background-color: #e4e3e3
        }

        th {
        background: #333;
        color: #fff;
        }

        .pagination {
        margin: 0;
        }

        .pagination li:hover{
            cursor: pointer;
        }

        .header_wrap {
        padding:30px 0;
        }
        .num_rows {
        width: 20%;
        float:left;
        }
        .tb_search{
        width: 20%;
        float:right;
        }
        .pagination-container {
        width: 70%;
        float:left;
        }

        .rows_count {
        width: 20%;
        float:right;
        text-align:right;
        color: #999;
        }
    </style> --}}
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
                                        <h4 class="card-title">Member</h4>
                                        {{-- tambah untuk admin --}}
                                        @if(Auth::user()->role === 'admin')
                                            <a href="{{ route('members.create') }}" class="btn btn-primary btn-round ms-auto">
                                                <i class="fa fa-plus"></i>
                                                tambah
                                            </a>
                                        @endif
                                        {{-- perpanjangan member --}}
                                        @if(Auth::user()->role === 'member' && $warning)
                                            <button id="btn-perpanjangan" class="btn btn-warning mt-3 ms-auto">
                                                <i class="fas fa-redo"></i> Ajukan Perpanjangan Member
                                            </button>
                                        @endif
                                        {{-- email --}}
                                        @if(Auth::user()->role === 'admin')
                                            <form action="{{ route('members.sendEmailsByDate') }}" method="POST" class="d-flex align-items-center" style="gap: 10px;">
                                                @csrf
                                                <input type="date" name="tanggal" class="form-control" required>
                                                <button type="submit" class="btn btn-info">
                                                    <i class="fas fa-paper-plane"></i> Kirim Email Berdasarkan Tanggal
                                                </button>
                                            </form>
                                        @endif

                                         
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
                                                    <th>ID Member</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Foto</th>
                                                    <th>Status</th>
                                                    <th>Tanggal Bergabung</th>
                                                    <th>Tanggal Berakhir</th>
                                                    @if(Auth::user()->role === 'admin')
                                                    <th style="min-width: 220px;">Actions</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($members as $index => $member)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $member->id_member }}</td>
                                                    <td>{{ $member->name }}</td>
                                                    <td>{{ $member->phone }}</td>
                                                    <td>{{ $member->email }}</td>                                                   
                                                    <td>
                                                        <img src="{{ asset($member->photo) }}" alt="Member Image" width="100">
                                                    </td>
                                                     
                                                    <td>
                                                        <button class="btn btn-sm toggle-status-btn 
                                                            {{ $member->status === 'OPEN' ? 'btn-success' : 'btn-danger' }}" 
                                                            data-id_member="{{ $member->id_member }}" 
                                                            data-status="{{ $member->status }}">
                                                            {{ $member->status }}
                                                        </button>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($member->tanggal_bergabung)->format('d/m/Y') }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($member->tanggal_berakhir)->format('d/m/Y') }}</td>
                                                    @if(Auth::user()->role === 'admin')
                                                        <td>
                                                            <div class="d-flex flex-wrap" style="gap: 5px;">
                                                                <a href="{{ route('members.edit', $member->id_member) }}" 
                                                                class="btn btn-sm btn-warning"
                                                                title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                                Edit
                                                                </a>
                                                                
                                                                <a href="{{ route('members.card', $member->id_member) }}" 
                                                                class="btn btn-sm btn-success" 
                                                                target="_blank"
                                                                title="ID Card">
                                                                <i class="fas fa-id-card"></i>
                                                                Card
                                                                </a>
                                                                <a href="{{ route('members.sertifikat', $member->id_member) }}" 
                                                                class="btn btn-sm btn-info" 
                                                                target="_blank"
                                                                title="ID Card">
                                                                <i class="fas fa-id-card"></i>
                                                                sertifikat
                                                                </a>

                                                                @if($member->status_pembayaran === 'pending')
                                                                    <button class="btn btn-sm btn-primary approve-extension-btn"
                                                                            data-id_member="{{ $member->id_member }}">
                                                                        <i class="fas fa-check"></i> Approve Perpanjangan
                                                                    </button>
                                                                @endif
                                                                <a href="{{ route('members.sendEmail', $member->id_member) }}"
                                                                    class="btn btn-sm btn-primary"
                                                                    title="Kirim Email">
                                                                    <i class="fas fa-envelope"></i> Email
                                                                </a>

                                                                
                                                                <form action="{{ route('members.destroy', $member->id_member) }}" 
                                                                    method="POST" 
                                                                    class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" 
                                                                            class="btn btn-sm btn-danger"
                                                                            title="Delete"
                                                                            onclick="return confirm('Are you sure?')">
                                                                        <i class="fas fa-trash"></i>
                                                                        Hapus
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    @endif
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
        
        document.querySelectorAll('.approve-extension-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                let id_member = this.dataset.id_member;

                Swal.fire({
                    title: 'Approve Perpanjangan?',
                    text: "Masa aktif akan diperpanjang 1 tahun ke depan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Approve!',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/members/${id_member}/approve-extension`, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Berhasil!', data.message, 'success')
                                    .then(() => location.reload());
                            } else {
                                Swal.fire('Gagal!', data.message || 'Terjadi kesalahan.', 'error');
                            }
                        })
                        .catch(() => {
                            Swal.fire('Error!', 'Terjadi kesalahan server.', 'error');
                        });
                    }
                });
            });
        });
        $(document).ready(function() {
            $('.toggle-status-btn').on('click', function() {
                let button = $(this);
                let id_member = button.data('id_member');
                let currentStatus = button.data('status');

                $.ajax({
                    url: '/members/toggle-status/' + id_member,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update tombol dengan status baru
                            button.text(response.status);
                            button.data('status', response.status);

                            // Update kelas dan teks tombol
                            if (response.status === 'OPEN') {
                                button.removeClass('btn-danger').addClass('btn-success');
                            } else {
                                button.removeClass('btn-success').addClass('btn-danger');
                            }
                        }
                    },
                    error: function(xhr) {
                        alert('Gagal mengubah status');
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    @if(Auth::user()->role === 'member' && $warning)
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("btn-perpanjangan").addEventListener("click", function() {
            Swal.fire({
                title: 'Ajukan Perpanjangan Member',
                html: `
                    <form id="form-perpanjangan" enctype="multipart/form-data">
                        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                        <p><strong>Tanggal Berakhir:</strong> {{ $warning['tanggal_berakhir_display'] }}</p>
                        <div class="form-group mt-2">
                            <label>Upload Bukti Transfer</label>
                            <input type="file" name="bukti_tf" id="bukti_tf" class="form-control mt-1" accept="image/*" required>
                        </div>
                    </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Ajukan',
                confirmButtonColor: '#3085d6',
                cancelButtonText: 'Batal',
                preConfirm: () => {
                    let file = document.getElementById('bukti_tf').files[0];
                    if (!file) {
                        Swal.showValidationMessage('Bukti transfer wajib diupload');
                        return false;
                    }
                    return new Promise((resolve, reject) => {
                        let formData = new FormData();
                        formData.append('bukti_tf', file);
                        formData.append('_token', '{{ csrf_token() }}');

                        fetch("{{ route('members.extend') }}", {
                            method: "POST",
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                resolve(data);
                            } else {
                                Swal.showValidationMessage(data.message || 'Gagal mengajukan perpanjangan');
                            }
                        })
                        .catch(() => {
                            Swal.showValidationMessage('Terjadi kesalahan server');
                        });
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Berhasil!', 'Pengajuan perpanjangan telah dikirim dan status pending.', 'success');
                }
            });
        });
    </script>
    @endif

    {{-- @if($warning)
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let endDate = new Date("{{ $warning['tanggal_berakhir'] }}T23:59:59").getTime();

        let timer = setInterval(function() {
            let now = new Date().getTime();
            let distance = endDate - now;

            if (distance < 0) {
                clearInterval(timer);
                document.getElementById('countdown').innerHTML = "Berakhir!";
                return;
            }

            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById('countdown').innerHTML =
                days + "h " + hours + "j " + minutes + "m " + seconds + "d";
        }, 1000);

        Swal.fire({
            title: '⚠️ Masa Member Akan Berakhir!',
            html: `
                <p>Masa aktif Anda akan berakhir pada <strong>{{ $warning['tanggal_berakhir_display'] }}</strong>.</p>
                <p>Sisa waktu: <strong><span id="countdown"></span></strong></p>
            `,
            icon: 'warning',
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#3085d6',
            allowOutsideClick: false
        });
    });
    </script>
    @endif --}}
</body>

</html>