<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <link rel="icon" href="../assets/img/logo/fav.ico" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        .card {
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: none;
            transition: var(--transition);
        }

        .card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            border-top-left-radius: var(--border-radius) !important;
            border-top-right-radius: var(--border-radius) !important;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 6px;
            padding: 0.5rem 1.5rem;
            transition: var(--transition);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .table-responsive {
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table thead th {
            background-color: #f7f9fc;
            border-top: none;
            font-weight: 600;
            color: #4a5568;
            padding: 1rem 0.75rem;
        }

        .table tbody td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
        }

        .table-hover tbody tr {
            transition: var(--transition);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        .badge {
            padding: 0.5rem 0.75rem;
            border-radius: 20px;
            font-weight: 500;
        }

        .badge-success {
            background-color: #48bb78;
        }
        .badge-primary {
            background-color: #487ebb;
        }

        .badge-warning {
            background-color: #ecc94b;
            color: var(--dark-color);
        }

        .badge-danger {
            background-color: #f56565;
        }

        .badge-secondary {
            background-color: #a0aec0;
        }

        .filter-section {
            background-color: white;
            border-radius: var(--border-radius);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--box-shadow);
        }

        .form-control, .form-select {
            border-radius: 6px;
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
            transition: var(--transition);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        }

        .action-buttons .btn {
            border-radius: 6px;
            padding: 0.375rem 0.75rem;
            transition: var(--transition);
        }

        .action-buttons .btn:hover {
            transform: translateY(-2px);
        }

        .page-inner {
            padding: 1rem;
        }

        .breadcrumbs {
            background-color: transparent;
            padding: 0;
        }

        .status-filter {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .status-filter-btn {
            border-radius: 20px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            transition: var(--transition);
        }

        .status-filter-btn.active, .status-filter-btn:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #a0aec0;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        /* Modern toggle switch */
        .toggle-filter {
            display: none;
        }

        .filter-label {
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            margin-bottom: 1rem;
            color: var(--primary-color);
            font-weight: 500;
        }

        .filter-label i {
            margin-right: 0.5rem;
            transition: var(--transition);
        }

        .toggle-filter:checked ~ .filter-content {
            display: block;
        }

        .toggle-filter:checked + .filter-label i {
            transform: rotate(90deg);
        }

        .filter-content {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Modern pagination */
        .pagination {
            margin-top: 1.5rem;
            justify-content: center;
        }

        .page-link {
            border-radius: 6px;
            margin: 0 0.25rem;
            border: 1px solid #e2e8f0;
            color: #4a5568;
            transition: var(--transition);
            padding: 0.5rem 0.75rem;
        }

        .page-link:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .pagination-info {
            text-align: center;
            margin-top: 1rem;
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .table-loading {
            text-align: center;
            padding: 2rem;
        }
        
        .table-loading .spinner-border {
            width: 3rem;
            height: 3rem;
        }
        
        /* Enhanced Modal styles */
        .status-modal {
            backdrop-filter: blur(5px);
        }
        
        .status-modal .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: modalSlideIn 0.3s ease-out;
        }
        
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        .status-modal .modal-header {
            border-bottom: none;
            padding: 2rem 2rem 0;
            text-align: center;
            position: relative;
        }
        
        .status-modal .modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }
        
        .status-modal .btn-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            opacity: 0.6;
            transition: all 0.3s ease;
        }
        
        .status-modal .btn-close:hover {
            opacity: 1;
            transform: rotate(90deg);
        }
        
        .status-modal .modal-body {
            padding: 1rem 2rem 2rem;
            text-align: center;
        }
        
        .status-modal .modal-footer {
            border-top: none;
            padding: 0 2rem 2rem;
            justify-content: center;
        }
        
        .status-success {
            color: #28a745;
        }
        
        .status-failed {
            color: #dc3545;
        }
        
        .modal-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: iconPulse 1s ease-in-out;
        }
        
        @keyframes iconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .modal-message {
            font-size: 1.1rem;
            line-height: 1.6;
            margin: 1rem 0;
        }
        
        .modal-message strong {
            font-size: 1.3rem;
            display: block;
            margin-bottom: 0.5rem;
        }
        
        /* Success modal styling */
        .status-modal.success .modal-content {
            border-top: 5px solid #28a745;
        }
        
        .status-modal.success .modal-title {
            color: #28a745;
        }
        
        /* Failed modal styling */
        .status-modal.failed .modal-content {
            border-top: 5px solid #dc3545;
        }
        
        .status-modal.failed .modal-title {
            color: #dc3545;
        }
        
        /* Button styling in modal */
        .status-modal .btn-primary {
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 10px;
            font-size: 1rem;
        }
        
        .status-modal.success .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }
        
        .status-modal.failed .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
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
            </div>
            <!-- body -->
            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Form</h3>
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
                                <a href="#">Tabel </a>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="card-title mb-0">Daftar Formulir</h4>
                                        @if(Auth::user()->role === 'admin')
                                            <button type="button" 
                                                    class="btn btn-success btn-sm"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#importModal">
                                                <i class="fas fa-file-upload"></i> Import Excel
                                            </button>
                                        @endif

                                    </div>
                                </div>
                                
                                @if(session('success'))
                                    <div class="alert alert-success mx-4 mt-4">
                                        <i class="fas fa-check-circle me-2"></i>
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                                @php
                                    use Illuminate\Support\Facades\Auth;
                                @endphp
                                
                                @if(Auth::user()->role === 'member')
                                <div class="alert alert-info mx-4 mt-4">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Anda hanya dapat melihat data formulir yang Anda buat.
                                </div>
                                @endif
                                
                                <div class="card-body">
                                    <!-- Filter Section -->
                                    <div class="filter-section">
                                        <input type="checkbox" id="toggleFilter" class="toggle-filter">
                                        <label for="toggleFilter" class="filter-label">
                                            <i class="fas fa-filter"></i> Filter Data
                                        </label>
                                        
                                        <div class="filter-content">
                                            <form id="filterForm" method="GET" action="{{ url()->current() }}">
                                                <div class="row mb-4">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Filter berdasarkan Kategori</label>
                                                        <select class="form-select" name="category" id="categoryFilter">
                                                            <option value="">Semua Kategori</option>
                                                            @foreach ($kategoris as $kategori)
                                                                <option value="{{ $kategori->id }}" 
                                                                    {{ request('category') == $kategori->id ? 'selected' : '' }}>
                                                                    {{ $kategori->nama_kategori }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Filter berdasarkan Status</label>
                                                        <select class="form-select" name="status" id="statusFilter">
                                                            <option value="">Semua Status</option>
                                                            <option value="OPEN" {{ request('status') == 'OPEN' ? 'selected' : '' }}>OPEN</option>
                                                            <option value="INPG" {{ request('status') == 'INPG' ? 'selected' : '' }}>INPG</option>
                                                            <option value="CLSD" {{ request('status') == 'CLSD' ? 'selected' : '' }}>CLOSED</option>
                                                            <option value="BATAL" {{ request('status') == 'BATAL' ? 'selected' : '' }}>BATAL</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Cari Data</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-search"></i>
                                                            </span>
                                                            <input type="text" name="search" id="searchInput" class="form-control" 
                                                                placeholder="Cari berdasarkan nama, organisasi, atau email..."
                                                                value="{{ request('search') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="d-flex gap-2">
                                                            <button type="submit" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-filter"></i> Terapkan Filter
                                                            </button>
                                                            <a href="{{ url()->current() }}" class="btn btn-secondary btn-sm">
                                                                <i class="fas fa-refresh"></i> Reset
                                                            </a>
                                                            <div class="action-buttons">
                                                                @if(Auth::user()->role === 'admin')
                                                                <button type="button" 
                                                                        class="btn btn-success btn-sm"
                                                                        title="Export Excel dengan Filter"
                                                                        onclick="exportWithFilters()">
                                                                    <i class="fas fa-file-excel"></i> Export Excel
                                                                </button>

                                                                @endif
                                                            </div>
                                                            @if(request()->hasAny(['category', 'status', 'search']))
                                                            <div class="alert alert-info py-2 px-3 mb-0 d-flex align-items-center">
                                                                <i class="fas fa-info-circle me-2"></i>
                                                                <small>Filter aktif. Export Excel akan mengikuti filter ini.</small>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <!-- Table -->
                                    <div class="table-responsive">
                                        <table id="formTable" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Nomor</th>
                                                    <th>Nama</th>
                                                    <th>Kategori</th>
                                                    <th>Organisasi</th>
                                                    <th>Email</th>
                                                    <th>Nomor Handphone</th>
                                                    <th>Status</th>
                                                    @if(Auth::user()->role === 'admin')
                                                    <th style="min-width: 220px;">Actions</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($forms as $index => $form)
                                                <tr data-category="{{ $form->kategori_id }}" data-status="{{ $form->status }}">
                                                    <td>{{ ($forms->currentPage() - 1) * $forms->perPage() + $index + 1 }}</td>
                                                    <td>{{ $form->nama }}</td>
                                                    <td>
                                                        @php
                                                            $kategoriName = $kategoris->where('id', $form->kategori_id)->first()->nama_kategori ?? 'Unknown';
                                                            $kategoriStatus = $kategoris->where('id', $form->kategori_id)->first()->status ?? 'non-aktif';
                                                        @endphp
                                                        <span class="badge bg-light text-dark">{{ $kategoriName }}</span>
                                                        @if($kategoriStatus === 'aktif')
                                                            <span class="badge badge-success">Aktif</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $form->organisasi }}</td>
                                                    <td>{{ $form->email }}</td>
                                                    <td>{{ $form->nomor_telp }}</td>
                                                    <td>
                                                        <span class="badge 
                                                            @if($form->status == 'OPEN') badge-success 
                                                            @elseif($form->status == 'INPG') badge-warning 
                                                            @elseif($form->status == 'CLSD') badge-primary
                                                            @elseif($form->status == 'BATAL') badge-danger
                                                            @else badge-secondary @endif">
                                                            {{ $form->status }}
                                                        </span>
                                                    </td>
                                                    @if(Auth::user()->role === 'admin') 
                                                    <td>
                                                        <div class="action-buttons d-flex flex-wrap" style="gap: 0.5rem;">
                                                            <a href="{{ route('form_inputs.show', $form->id) }}" 
                                                                class="btn btn-sm btn-info"
                                                                title="Lihat Detail">
                                                                <i class="fas fa-eye"></i> lihat
                                                            </a>
                                                            <a href="{{ route('form_inputs.edit', $form->id) }}" 
                                                               class="btn btn-sm btn-warning"
                                                               title="Edit">
                                                               <i class="fas fa-edit"></i> edit
                                                            </a>
                                                            <form action="{{ route('form_inputs.destroy', $form->id) }}" 
                                                                  method="POST" 
                                                                  class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" 
                                                                        class="btn btn-sm btn-danger"
                                                                        title="Delete"
                                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                    <i class="fas fa-trash"></i> hapus
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                        @if($forms->isEmpty())
                                        <div class="empty-state">
                                            <i class="fas fa-folder-open"></i>
                                            <h4>Belum ada data formulir</h4>
                                            <p>Mulai dengan menambahkan formulir baru</p>
                                        </div>
                                        @endif
                                        
                                        <!-- Pagination -->
                                        @if($forms->hasPages())
                                        <div class="d-flex justify-content-between align-items-center mt-4">
                                            <div class="pagination-info">
                                                Menampilkan {{ $forms->firstItem() }} - {{ $forms->lastItem() }} dari {{ $forms->total() }} hasil
                                            </div>
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination">
                                                    {{-- Previous Page Link --}}
                                                    @if ($forms->onFirstPage())
                                                        <li class="page-item disabled">
                                                            <span class="page-link">&laquo;</span>
                                                        </li>
                                                    @else
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $forms->previousPageUrl() }}" rel="prev">&laquo;</a>
                                                        </li>
                                                    @endif

                                                    {{-- Pagination Elements --}}
                                                    @foreach ($forms->getUrlRange(1, $forms->lastPage()) as $page => $url)
                                                        @if ($page == $forms->currentPage())
                                                            <li class="page-item active">
                                                                <span class="page-link">{{ $page }}</span>
                                                            </li>
                                                        @else
                                                            <li class="page-item">
                                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                                            </li>
                                                        @endif
                                                    @endforeach

                                                    {{-- Next Page Link --}}
                                                    @if ($forms->hasMorePages())
                                                        <li class="page-item">
                                                            <a class="page-link" href="{{ $forms->nextPageUrl() }}" rel="next">&raquo;</a>
                                                        </li>
                                                    @else
                                                        <li class="page-item disabled">
                                                            <span class="page-link">&raquo;</span>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </nav>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.footer')
        </div>
    </div>
    
    <!-- Enhanced Status Popup Modal -->
    <div class="modal fade status-modal" id="statusModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-icon">
                        <i id="modalIcon"></i>
                    </div>
                    <div class="modal-message" id="modalMessage"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Mengerti</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Import Excel -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('forminput.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="importModalLabel">Import Data Formulir</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="mb-3">
                <label for="file" class="form-label">Pilih File Excel</label>
                <input type="file" name="file" id="file" class="form-control" accept=".xls,.xlsx,.csv" required>
            </div>
            <p class="text-muted"><small>Pastikan file memiliki header kolom sesuai nama field di database.</small></p>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </div>
        </form>
    </div>
    </div>

    <!--   Core JS Files   -->
    @include('admin.js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
         function exportWithFilters() {
        // Ambil nilai filter dari form
            let category = document.getElementById('categoryFilter').value;
            let status = document.getElementById('statusFilter').value;
            let search = document.getElementById('searchInput').value;

            // Buat URL dengan query string
            let url = "{{ route('form-inputs.export') }}" 
                        + "?category=" + encodeURIComponent(category)
                        + "&status=" + encodeURIComponent(status)
                        + "&search=" + encodeURIComponent(search);

            // Redirect untuk download
            window.location.href = url;
        }
        document.addEventListener('DOMContentLoaded', function() {
             

            // Filter by category
            const categoryFilter = document.getElementById('categoryFilter');
            if (categoryFilter) {
                categoryFilter.addEventListener('change', function() {
                    const selectedCategory = this.value;
                    filterTable();
                });
            }
            
            // Filter by status
            const statusButtons = document.querySelectorAll('.status-filter-btn');
            statusButtons.forEach(button => {
                button.addEventListener('click', function() {
                    statusButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    filterTable();
                });
            });
            
            // Search functionality
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    filterTable();
                });
            }
            
            function filterTable() {
                const categoryValue = document.getElementById('categoryFilter').value;
                const statusValue = document.querySelector('.status-filter-btn.active').dataset.status;
                const searchValue = document.getElementById('searchInput').value.toLowerCase();
                
                const rows = document.querySelectorAll('#formTable tbody tr');
                
                rows.forEach(row => {
                    const categoryMatch = !categoryValue || row.getAttribute('data-category') === categoryValue;
                    const statusMatch = !statusValue || row.getAttribute('data-status') === statusValue;
                    const textMatch = !searchValue || 
                        row.cells[1].textContent.toLowerCase().includes(searchValue) || // Name
                        row.cells[2].textContent.toLowerCase().includes(searchValue) || // Category
                        row.cells[3].textContent.toLowerCase().includes(searchValue) || // Organization
                        row.cells[4].textContent.toLowerCase().includes(searchValue);   // Email
                    
                    if (categoryMatch && statusMatch && textMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
            
            // Enhanced function untuk menampilkan modal berdasarkan status
            function showStatusModal(status, kategoriName) {
                const modal = document.getElementById('statusModal');
                const modalInstance = new bootstrap.Modal(modal);
                const modalMessage = document.getElementById('modalMessage');
                const modalTitle = document.getElementById('modalTitle');
                const modalIcon = document.getElementById('modalIcon');
                
                // Reset modal classes
                modal.classList.remove('success', 'failed');
                
                if (status === 'BATAL') {
                    // Status BATAL - Not Passed
                    modal.classList.add('failed');
                    modalTitle.textContent = "Hasil Seleksi - " + kategoriName;
                    modalMessage.innerHTML = `
                        <strong>Anda tidak LULUS seleksi</strong>
                        <br><br>
                        Mohon maaf, Anda belum berhasil dalam seleksi kali ini. 
                        Terima kasih telah berpartisipasi dalam proses seleksi kami.
                        <br><br>
                        <small>Jangan berkecil hati, tetap semangat untuk kesempatan selanjutnya!</small>
                    `;
                    modalIcon.className = "fas fa-times-circle status-failed";
                    
                } else if (status === 'INPG') {
                    // Status INPG - Passed
                    modal.classList.add('success');
                    modalTitle.textContent = "Hasil Seleksi - " + kategoriName;
                    modalMessage.innerHTML = `
                        <strong>🎉 SELAMAT ANDA LULUS SELEKSI! 🎉</strong>
                        <br><br>
                        Selamat! Anda telah berhasil melewati tahap seleksi kami.
                        <br><br>
                        <strong>Langkah Selanjutnya:</strong>
                        <br>
                        Silakan datang sesuai dengan jadwal yang telah disediakan. 
                        Informasi lebih lanjut akan segera dikirimkan melalui email atau kontak yang telah Anda berikan.
                        <br><br>
                        <small>Selamat bergabung dengan kami!</small>
                    `;
                    modalIcon.className = "fas fa-check-circle status-success";
                }
                
                // Show modal
                modalInstance.show();
                
                // Enhanced modal close handlers
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modalInstance.hide();
                    }
                });
                
                // Close modal when clicking close button or "Mengerti" button
                modal.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
                    btn.addEventListener('click', function() {
                        modalInstance.hide();
                    });
                });
                
                // Auto close after 15 seconds (optional)
                setTimeout(function() {
                    if (modal.classList.contains('show')) {
                        modalInstance.hide();
                    }
                }, 15000);
            }
            
            // Check status dan tampilkan modal untuk member dengan kategori aktif
            @if(Auth::user()->role === 'member' && count($forms) > 0)
                @php
                    $statusToShow = null;
                    $kategoriToShow = null;
                    
                    // Loop through forms to find active category with status 'batal' or 'INPG'
                    foreach($forms as $form) {
                        $kategori = $kategoris->where('id', $form->kategori_id)->first();
                        $kategoriStatus = $kategori->status ?? 'non-aktif';
                        $kategoriName = $kategori->nama_kategori ?? 'Unknown';
                        
                        // Only show modal for active categories
                        if($kategoriStatus === 'aktif') {
                            if($form->status === 'BATAL') {
                                $statusToShow = 'BATAL';
                                $kategoriToShow = $kategoriName;
                                break; // Prioritize 'BATAL' status
                            } else if($form->status === 'INPG' && $statusToShow === null) {
                                $statusToShow = 'INPG';
                                $kategoriToShow = $kategoriName;
                            }
                        }
                    }
                @endphp
                
                @if($statusToShow && $kategoriToShow)
                    // Show modal after page loads
                    setTimeout(function() {
                        showStatusModal('{{ $statusToShow }}', '{{ $kategoriToShow }}');
                    }, 1500); // Delay 1.5 seconds for better UX
                @endif
            @endif
        });
    </script>
</body>

</html>