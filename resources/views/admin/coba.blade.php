<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Include jQuery for AJAX -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include CSRF token for Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
      
    <style>
        /* CSS akan ditempatkan di sini */
       
        :root {
            --primary: #4361ee;
            --success: #47fc00;
            --warning: #f8961e;
            --danger: #f72585;
            --dark: #212529;
            --info: #007cf8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
            padding: 2rem;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .dashboard-title {
            color: #343a40;
            font-size: 1.8rem;
        }

        .period-selector {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .period-selector select {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            background: white;
            cursor: pointer;
        }

        .cards-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 1rem;
        }
         .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .chart-title {
            color: #343a40;
            font-size: 1.2rem;
            font-weight: 600;
        }
        .chart-legend {
            display: flex;
            gap: 1.5rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 3px;
        }
        .card-3d {
            position: relative;
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            transform-style: preserve-3d;
            perspective: 1000px;
            cursor: pointer;
            z-index: 1;
            overflow: hidden;
        }

        .card-3d::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent 0%, rgba(255, 255, 255, 0.3) 100%);
            z-index: -1;
            transition: all 0.3s ease;
        }

        .card-3d:hover {
            transform: translateY(-10px) rotateX(5deg) rotateY(5deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .card-3d:hover::before {
            transform: scale(1.1);
        }

        .card-3d.total-produk {
            border-left: 5px solid var(--primary);
        }

        .card-3d.pendapatan-selesai {
            border-left: 5px solid var(--success);
        }

        .card-3d.pendapatan-pending {
            border-left: 5px solid var(--warning);
        }

        .card-3d.produk-terjual {
            border-left: 5px solid var(--danger);
        }
        .card-3d.pendapatan-admin {
            border-left: 5px solid var(--info);
        }
        .pendapatan-member {
            border-left: 5px solid var(--success);
        }

        .pendapatan-member .card-icon {
            background: var(--success);
        }

        .pendapatan-admin {
            border-left: 5px solid var(--info);
        }

        .pendapatan-admin .card-icon {
            background: var(--info);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .card-3d:hover .card-icon {
            transform: scale(1.1) rotate(10deg);
        }

        .total-produk .card-icon {
            background: var(--primary);
        }

        .pendapatan-selesai .card-icon {
            background: var(--success);
        }

        .pendapatan-pending .card-icon {
            background: var(--warning);
        }

        .produk-terjual .card-icon {
            background: var(--danger);
        }
        .pendapatan-admin .card-icon {
            background: var(--info);
        }

        .card-title {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .card-value {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }

        .card-footer {
            display: flex;
            align-items: center;
            font-size: 0.8rem;
            color: #6c757d;
        }

        .card-footer i {
            margin-right: 5px;
        }

        .positive {
            color: #28a745;
        }

        .negative {
            color: #dc3545;
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30%;
            background: rgba(0, 0, 0, 0.03);
            clip-path: polygon(0 50%, 100% 0%, 100% 100%, 0% 100%);
            transition: all 0.3s ease;
        }

        .card-3d:hover .wave {
            height: 40%;
        }
        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            .cards-container {
                grid-template-columns: 1fr;
            }
            
            .chart-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .chart-legend {
                flex-wrap: wrap;
                gap: 0.8rem;
            }
        }
        /* Header Styles */
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f1f5f9;
        }

        .header-controls {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .current-month {
            font-size: 28px;
            font-weight: 700;
            color: #1e293b;
            min-width: 200px;
            text-align: center;
        }

        .view-controls {
            display: flex;
            gap: 10px;
        }

        /* Button Styles */
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-icon {
            width: 45px;
            height: 45px;
            padding: 0;
            justify-content: center;
            background: #f8fafc;
            color: #64748b;
            border: 2px solid #e2e8f0;
        }

        .btn-icon:hover {
            background: #667eea;
            color: white;
            border-color: #667eea;
            transform: translateY(-2px);
        }

        .btn-view {
            background: #f8fafc;
            color: #64748b;
            border: 2px solid #e2e8f0;
        }

        .btn-view.active,
        .btn-view:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-color: #667eea;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: #64748b;
            border: 2px solid #e2e8f0;
        }

        .btn-secondary:hover {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        /* Calendar Container */
        .calendar-container {
            position: relative;
            margin-bottom: 30px;
        }

        .calendar-view {
            display: none;
        }

        .calendar-view.active {
            display: block;
        }

        /* Month View */
        .calendar-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: #e2e8f0;
            border-radius: 10px 10px 0 0;
            overflow: hidden;
        }

        .weekday {
            background: #f8fafc;
            padding: 15px;
            text-align: center;
            font-weight: 600;
            color: #64748b;
            font-size: 14px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: #e2e8f0;
            border-radius: 0 0 10px 10px;
            overflow: hidden;
        }

        .calendar-day {
            background: white;
            min-height: 120px;
            padding: 10px;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .calendar-day:hover {
            background: #f8fafc;
        }

        .calendar-day.other-month {
            background: #f8fafc;
            color: #94a3b8;
        }

        .calendar-day.today {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .calendar-day.selected {
            background: #10b981;
            color: white;
        }

        .day-number {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 8px;
        }

        .day-events {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .event-dot {
            height: 4px;
            border-radius: 2px;
            margin-bottom: 2px;
            font-size: 10px;
            padding: 2px 4px;
            color: white;
            font-weight: 500;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Week View */
        .week-header {
            display: grid;
            grid-template-columns: 80px repeat(7, 1fr);
            gap: 1px;
            background: #e2e8f0;
            border-radius: 10px 10px 0 0;
            overflow: hidden;
        }

        .time-column,
        .day-column {
            background: #f8fafc;
            padding: 15px;
            text-align: center;
            font-weight: 600;
            color: #64748b;
        }

        .week-grid {
            display: grid;
            grid-template-columns: 80px repeat(7, 1fr);
            gap: 1px;
            background: #e2e8f0;
            border-radius: 0 0 10px 10px;
            overflow: hidden;
            max-height: 600px;
            overflow-y: auto;
        }

        .time-slot {
            background: white;
            padding: 10px;
            border-bottom: 1px solid #f1f5f9;
            min-height: 60px;
            position: relative;
        }

        .time-slot:first-child {
            border-top: none;
        }

        .time-label {
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
        }

        .week-event {
            position: absolute;
            left: 5px;
            right: 5px;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            color: white;
            font-weight: 500;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            z-index: 10;
        }

        /* Day View */
        .day-timeline {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            max-height: 600px;
            overflow-y: auto;
        }

        .day-time-slot {
            display: flex;
            padding: 15px;
            border-bottom: 1px solid #f1f5f9;
            min-height: 80px;
            position: relative;
        }

        .day-time-label {
            width: 80px;
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
        }

        .day-event {
            margin-left: 20px;
            padding: 10px 15px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            flex: 1;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .day-event:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Event Panel */
        .event-panel {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f5f9;
        }

        .panel-header h3 {
            font-size: 20px;
            color: #1e293b;
            font-weight: 600;
        }

        .events-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .event-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: #f8fafc;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .event-item:hover {
            background: #f1f5f9;
            transform: translateX(5px);
        }

        .event-color {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .event-info {
            flex: 1;
        }

        .event-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .event-time {
            font-size: 12px;
            color: #64748b;
        }

        .event-actions {
            display: flex;
            gap: 8px;
        }

        .event-actions button {
            width: 30px;
            height: 30px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: all 0.3s ease;
        }

        .edit-btn {
            background: #10b981;
            color: white;
        }

        .edit-btn:hover {
            background: #059669;
        }

        .delete-btn {
            background: #ef4444;
            color: white;
        }

        .delete-btn:hover {
            background: #dc2626;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            backdrop-filter: blur(5px);
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 15px;
            padding: 30px;
            max-width: 500px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f5f9;
        }

        .modal-header h3 {
            font-size: 24px;
            color: #1e293b;
            font-weight: 600;
        }

        .modal-close {
            width: 35px;
            height: 35px;
            border: none;
            background: #f1f5f9;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: #ef4444;
            color: white;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        .color-picker {
            display: flex;
            gap: 10px;
        }

        .color-picker input[type="radio"] {
            display: none;
        }

        .color-option {
            width: 35px;
            height: 35px;
            border-radius: 8px;
            cursor: pointer;
            border: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .color-picker input[type="radio"]:checked + .color-option {
            border-color: #1e293b;
            transform: scale(1.1);
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #f1f5f9;
        }
        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                margin: 10px;
                padding: 15px;
            }
            
            .calendar-header {
                flex-direction: column;
                gap: 20px;
            }
            
            .current-month {
                font-size: 24px;
            }
            
            .calendar-day {
                min-height: 80px;
                padding: 8px;
            }
            
            .day-number {
                font-size: 14px;
            }
            
            .event-dot {
                font-size: 9px;
                padding: 1px 3px;
            }
            
            .week-header,
            .week-grid {
                grid-template-columns: 60px repeat(7, 1fr);
            }
            
            .time-column,
            .day-column {
                padding: 10px;
                font-size: 12px;
            }
            
            .time-slot {
                padding: 8px;
                min-height: 50px;
            }
            
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .modal-content {
                padding: 20px;
                margin: 20px;
            }
        }

        /* Drag and Drop Styles */
        .dragging {
            opacity: 0.5;
            transform: rotate(5deg);
        }

        .drop-zone {
            background: #f0f9ff;
            border: 2px dashed #0ea5e9;
        }

        /* Loading States */
        .loading {
            opacity: 0.6;
            pointer-events: none;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .calendar-day,
        .event-item {
            animation: fadeIn 0.3s ease;
        }
        .date-error {
            color: #dc3545;
            font-size: 0.8rem;
            margin-top: 5px;
            display: none;
        }

        /* Alert Messages */
        .alert {
            padding: 12px 16px;
            margin: 10px 0;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-success {
            background: #d1f7c4;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f5c6cb;
            color: #721c24;
            border: 1px solid #f1b0b7;
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
                        <a href="index.html" class="logo">
                            <img src="{{ asset('admin/assets/img/logo/Logo.png') }}" style="width: 50%;">
                        </a>
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
                </div>
                <x-app-layout>
                </x-app-layout>
            </div>
            <!-- Body -->
            <div class="container">
                <div class="page-inner">
                     
                    <h1 style="margin-bottom: 2rem; color: #343a40;">Dashboard</h1>
        
                    <!-- Ganti bagian cards-container dengan ini: -->
                    <div class="cards-container">
                        <!-- Card Total Produk -->
                        <div class="card-3d total-produk">
                            <div class="card-icon">
                                <i class="fas fa-boxes"></i>
                            </div>
                            <h3 class="card-title">Total Anggota User</h3>
                            <h2 class="card-value">{{ $totalMembers }}</h2>
                            <div class="wave"></div>
                        </div>

                        {{-- Role Info Section --}}
                        <div class="mt-8">
                            @if ($isAdminOrStaff)
                                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                                    <p class="text-sm text-blue-700 font-medium">
                                        Anda login sebagai <span class="font-bold">{{ auth()->user()->role }}</span>. Data yang tampil adalah seluruh data sistem.
                                    </p>
                                </div>
                            @else
                                <div class="bg-green-50 border border-green-200 rounded-xl p-4">
                                    <p class="text-sm text-green-700 font-medium">
                                        Anda login sebagai <span class="font-bold">Member</span>. Data yang tampil hanya berdasarkan produk Anda.
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Alert Messages -->
                    <div id="alertContainer"></div>

                    <div class="card">
                        <header class="calendar-header">
                            <div class="header-controls">
                                <button class="btn btn-icon" id="prevMonth">
                                    <i class="fas fa-chevron-left"></i>
                                </button>
                                <h1 class="current-month" id="currentMonth">December 2024</h1>
                                <button class="btn btn-icon" id="nextMonth">
                                    <i class="fas fa-chevron-right"></i>
                                </button>
                            </div>
                            
                            <div class="view-controls">
                                <button class="btn btn-view active" data-view="month">Month</button>
                                <button class="btn btn-view" data-view="week">Week</button>
                                <button class="btn btn-view" data-view="day">Day</button>
                            </div>
                        </header>

                        <!-- Calendar Grid -->
                        <div class="calendar-container">
                            <!-- Month View -->
                            <div class="calendar-view month-view active" id="monthView">
                                <div class="calendar-weekdays">
                                    <div class="weekday">Sun</div>
                                    <div class="weekday">Mon</div>
                                    <div class="weekday">Tue</div>
                                    <div class="weekday">Wed</div>
                                    <div class="weekday">Thu</div>
                                    <div class="weekday">Fri</div>
                                    <div class="weekday">Sat</div>
                                </div>
                                <div class="calendar-grid" id="monthGrid">
                                    <!-- Days will be populated by JavaScript -->
                                </div>
                            </div>

                            <!-- Week View -->
                            <div class="calendar-view week-view" id="weekView">
                                <div class="week-header">
                                    <div class="time-column">Time</div>
                                    <div class="day-column" data-day="0">Sun</div>
                                    <div class="day-column" data-day="1">Mon</div>
                                    <div class="day-column" data-day="2">Tue</div>
                                    <div class="day-column" data-day="3">Wed</div>
                                    <div class="day-column" data-day="4">Thu</div>
                                    <div class="day-column" data-day="5">Fri</div>
                                    <div class="day-column" data-day="6">Sat</div>
                                </div>
                                <div class="week-grid" id="weekGrid">
                                    <!-- Time slots will be populated by JavaScript -->
                                </div>
                            </div>

                            <!-- Day View -->
                            <div class="calendar-view day-view" id="dayView">
                                <div class="day-timeline" id="dayTimeline">
                                    <!-- Time slots will be populated by JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Event Panel -->
                    <div class="event-panel" id="eventPanel">
                        <div class="panel-header">
                            <h3>Events</h3>
                            <button class="btn btn-primary" id="addEventBtn">
                                <i class="fas fa-plus"></i> Add Event
                            </button>
                        </div>
                        <div class="events-list" id="eventsList">
                            <!-- Events will be populated by JavaScript -->
                        </div>
                    </div>

                    <!-- Event Modal -->
                    <div class="modal" id="eventModal">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 id="modalTitle">Add New Event</h3>
                                <button class="modal-close" id="closeModal">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <form id="eventForm">
                                <div class="form-group">
                                    <label for="eventTitle">Event Title</label>
                                    <input type="text" id="eventTitle" name="name" required>
                                </div>
                                
                                <!-- Mengubah input tanggal tunggal menjadi range tanggal -->
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="eventStartDate">Start Date</label>
                                        <input type="date" id="eventStartDate" name="tgl_mulai" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="eventEndDate">End Date</label>
                                        <input type="date" id="eventEndDate" name="tgl_akhir" required>
                                        <div class="date-error" id="endDateError">End date cannot be before start date</div>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="eventStart">Start Time</label>
                                        <input type="time" id="eventStart" name="waktu_mulai" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="eventEnd">End Time</label>
                                        <input type="time" id="eventEnd" name="waktu_akhir" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="eventDescription">Description</label>
                                    <textarea id="eventDescription" name="deskripsi" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="eventColor">Color</label>
                                    <div class="color-picker">
                                        <input type="radio" name="warna" value="#667eea" id="color1" checked>
                                        <label for="color1" class="color-option" style="background: #667eea;"></label>
                                        
                                        <input type="radio" name="warna" value="#10b981" id="color2">
                                        <label for="color2" class="color-option" style="background: #10b981;"></label>
                                        
                                        <input type="radio" name="warna" value="#f59e0b" id="color3">
                                        <label for="color3" class="color-option" style="background: #f59e0b;"></label>
                                        
                                        <input type="radio" name="warna" value="#ef4444" id="color4">
                                        <label for="color4" class="color-option" style="background: #ef4444;"></label>
                                        
                                        <input type="radio" name="warna" value="#8b5cf6" id="color5">
                                        <label for="color5" class="color-option" style="background: #8b5cf6;"></label>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="button" class="btn btn-secondary" id="deleteEvent" style="display: none;">Delete</button>
                                    <button type="submit" class="btn btn-primary" id="saveEventBtn">Save Event</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            @include('admin.footer')
        </div>
    </div>
    <!--   Core JS Files   -->
    @include('admin.js')
     
    <script>
        // Setup CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Data untuk chart (contoh data)
        const allMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
        // Data statistik (contoh)
        const chartData = {
            labels: allMonths.slice(-6), // Default 6 bulan terakhir
            datasets: [
                {
                    label: 'Total Produk',
                    data: [1200, 1100, 1150, 1250, 1300, 1245],
                    backgroundColor: '#4361ee',
                    borderColor: '#4361ee',
                    tension: 0.3,
                    fill: false
                },
                {
                    label: 'Pendapatan Selesai (Jt)',
                    data: [18, 20, 22, 23, 24, 24.5],
                    backgroundColor: '#4cc9f0',
                    borderColor: '#4cc9f0',
                    tension: 0.3,
                    fill: false
                },
                {
                    label: 'Pendapatan Pending (Jt)',
                    data: [6, 5.5, 5, 5.8, 5.3, 5.2],
                    backgroundColor: '#f8961e',
                    borderColor: '#f8961e',
                    tension: 0.3,
                    fill: false
                },
                {
                    label: 'Produk Terjual',
                    data: [750, 800, 820, 850, 880, 892],
                    backgroundColor: '#f72585',
                    borderColor: '#f72585',
                    tension: 0.3,
                    fill: false
                }
            ]
        };

        // Function to show alert messages
        function showAlert(message, type = 'success') {
            const alertContainer = document.getElementById('alertContainer');
            const alertClass = type === 'success' ? 'alert-success' : 'alert-error';
            
            const alertHTML = `
                <div class="alert ${alertClass}">
                    ${message}
                </div>
            `;
            
            alertContainer.innerHTML = alertHTML;
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                alertContainer.innerHTML = '';
            }, 5000);
        }

        // Efek 3D untuk card
        document.querySelectorAll('.card-3d').forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const xAxis = (window.innerWidth / 2 - e.pageX) / 25;
                const yAxis = (window.innerHeight / 2 - e.pageY) / 25;
                card.style.transform = `translateY(-10px) rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
            });

            card.addEventListener('mouseenter', () => {
                card.style.transition = 'all 0.1s ease';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transition = 'all 0.5s ease';
                card.style.transform = 'translateY(0) rotateY(0) rotateX(0)';
            });
        });

        // Interactive Calendar Widget
        class InteractiveCalendar {
            constructor() {
                this.currentDate = new Date();
                this.selectedDate = new Date();
                this.currentView = 'month';
                this.events = [];
                this.draggedEvent = null;
                
                this.initializeElements();
                this.bindEvents();
                this.renderCalendar();
                this.loadEventsFromServer();
            }

            initializeElements() {
                // Header elements
                this.prevMonthBtn = document.getElementById('prevMonth');
                this.nextMonthBtn = document.getElementById('nextMonth');
                this.currentMonthEl = document.getElementById('currentMonth');
                this.viewBtns = document.querySelectorAll('.btn-view');
                
                // Calendar views
                this.monthView = document.getElementById('monthView');
                this.weekView = document.getElementById('weekView');
                this.dayView = document.getElementById('dayView');
                this.monthGrid = document.getElementById('monthGrid');
                this.weekGrid = document.getElementById('weekGrid');
                this.dayTimeline = document.getElementById('dayTimeline');
                
                // Event panel
                this.eventPanel = document.getElementById('eventPanel');
                this.addEventBtn = document.getElementById('addEventBtn');
                this.eventsList = document.getElementById('eventsList');
                
                // Modal
                this.eventModal = document.getElementById('eventModal');
                this.closeModal = document.getElementById('closeModal');
                this.eventForm = document.getElementById('eventForm');
                this.modalTitle = document.getElementById('modalTitle');
                this.deleteEventBtn = document.getElementById('deleteEvent');
                this.saveEventBtn = document.getElementById('saveEventBtn');
                
                // Form elements
                this.eventTitle = document.getElementById('eventTitle');
                this.eventStartDate = document.getElementById('eventStartDate');
                this.eventEndDate = document.getElementById('eventEndDate');
                this.eventStart = document.getElementById('eventStart');
                this.eventEnd = document.getElementById('eventEnd');
                this.eventDescription = document.getElementById('eventDescription');
                this.endDateError = document.getElementById('endDateError');
                
                this.editingEventId = null;
            }

            bindEvents() {
                // Navigation
                this.prevMonthBtn.addEventListener('click', () => this.navigateMonth(-1));
                this.nextMonthBtn.addEventListener('click', () => this.navigateMonth(1));
                
                // View switching
                this.viewBtns.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        this.switchView(e.target.dataset.view);
                    });
                });
                
                // Event management
                this.addEventBtn.addEventListener('click', () => this.openEventModal());
                this.closeModal.addEventListener('click', () => this.closeEventModal());
                this.eventForm.addEventListener('submit', (e) => this.handleEventSubmit(e));
                this.deleteEventBtn.addEventListener('click', () => this.deleteEvent());
                
                // Validasi end date
                this.eventStartDate.addEventListener('change', () => this.validateDates());
                this.eventEndDate.addEventListener('change', () => this.validateDates());
                
                // Modal backdrop click
                this.eventModal.addEventListener('click', (e) => {
                    if (e.target === this.eventModal) {
                        this.closeEventModal();
                    }
                });
                
                // Keyboard shortcuts
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        this.closeEventModal();
                    }
                });
            }

            // Load events from server
            loadEventsFromServer() {
                // Convert PHP events to JavaScript format
                const serverEvents = @json($events ?? []);
                
                this.events = serverEvents.map(event => ({
                    id: event.id,
                    title: event.name,
                    startDate: event.tgl_mulai,
                    endDate: event.tgl_akhir,
                    startTime: event.waktu_mulai,
                    endTime: event.waktu_akhir,
                    description: event.deskripsi || '',
                    color: event.warna
                }));
                
                this.renderEvents();
            }

            validateDates() {
                const startDate = new Date(this.eventStartDate.value);
                const endDate = new Date(this.eventEndDate.value);
                
                if (endDate < startDate) {
                    this.endDateError.style.display = 'block';
                    return false;
                } else {
                    this.endDateError.style.display = 'none';
                    return true;
                }
            }

            navigateMonth(direction) {
                this.currentDate.setMonth(this.currentDate.getMonth() + direction);
                this.renderCalendar();
                this.renderEvents();
            }

            switchView(view) {
                this.currentView = view;
                
                // Update active button
                this.viewBtns.forEach(btn => {
                    btn.classList.remove('active');
                    if (btn.dataset.view === view) {
                        btn.classList.add('active');
                    }
                });
                
                // Show/hide views
                this.monthView.classList.remove('active');
                this.weekView.classList.remove('active');
                this.dayView.classList.remove('active');
                
                switch (view) {
                    case 'month':
                        this.monthView.classList.add('active');
                        this.renderMonthView();
                        break;
                    case 'week':
                        this.weekView.classList.add('active');
                        this.renderWeekView();
                        break;
                    case 'day':
                        this.dayView.classList.add('active');
                        this.renderDayView();
                        break;
                }
                
                this.renderEvents();
            }

            renderCalendar() {
                this.currentMonthEl.textContent = this.currentDate.toLocaleDateString('en-US', {
                    month: 'long',
                    year: 'numeric'
                });
                
                this.renderMonthView();
            }

            renderMonthView() {
                const year = this.currentDate.getFullYear();
                const month = this.currentDate.getMonth();
                
                const firstDay = new Date(year, month, 1);
                const lastDay = new Date(year, month + 1, 0);
                const startDate = new Date(firstDay);
                startDate.setDate(startDate.getDate() - firstDay.getDay());
                
                this.monthGrid.innerHTML = '';
                
                for (let i = 0; i < 42; i++) {
                    const date = new Date(startDate);
                    date.setDate(startDate.getDate() + i);
                    
                    const dayElement = this.createDayElement(date, month);
                    this.monthGrid.appendChild(dayElement);
                }
            }

            createDayElement(date, currentMonth) {
                const dayDiv = document.createElement('div');
                dayDiv.className = 'calendar-day';
                dayDiv.dataset.date = date.toISOString().split('T')[0];
                
                const dayNumber = document.createElement('div');
                dayNumber.className = 'day-number';
                dayNumber.textContent = date.getDate();
                
                const dayEvents = document.createElement('div');
                dayEvents.className = 'day-events';
                
                dayDiv.appendChild(dayNumber);
                dayDiv.appendChild(dayEvents);
                
                // Add classes
                if (date.getMonth() !== currentMonth) {
                    dayDiv.classList.add('other-month');
                }
                
                if (this.isToday(date)) {
                    dayDiv.classList.add('today');
                }
                
                if (this.isSelected(date)) {
                    dayDiv.classList.add('selected');
                }
                
                // Add click event
                dayDiv.addEventListener('click', () => {
                    this.selectDate(date);
                });
                
                return dayDiv;
            }

            renderWeekView() {
                const startOfWeek = this.getStartOfWeek(this.selectedDate);
                this.weekGrid.innerHTML = '';
                
                // Create time slots (6 AM to 10 PM)
                for (let hour = 6; hour <= 22; hour++) {
                    const timeSlot = document.createElement('div');
                    timeSlot.className = 'time-slot';
                    timeSlot.style.gridRow = `span 1`;
                    
                    const timeLabel = document.createElement('div');
                    timeLabel.className = 'time-label';
                    timeLabel.textContent = this.formatHour(hour);
                    
                    timeSlot.appendChild(timeLabel);
                    this.weekGrid.appendChild(timeSlot);
                }
            }

            renderDayView() {
                this.dayTimeline.innerHTML = '';
                
                // Create time slots (6 AM to 10 PM)
                for (let hour = 6; hour <= 22; hour++) {
                    const timeSlot = document.createElement('div');
                    timeSlot.className = 'day-time-slot';
                    
                    const timeLabel = document.createElement('div');
                    timeLabel.className = 'day-time-label';
                    timeLabel.textContent = this.formatHour(hour);
                    
                    timeSlot.appendChild(timeLabel);
                    this.dayTimeline.appendChild(timeSlot);
                }
            }

            renderEvents() {
                // Clear existing events
                this.clearEventDisplay();
                
                // Render events based on current view
                switch (this.currentView) {
                    case 'month':
                        this.renderMonthEvents();
                        break;
                    case 'week':
                        this.renderWeekEvents();
                        break;
                    case 'day':
                        this.renderDayEvents();
                        break;
                }
                
                // Render events list
                this.renderEventsList();
            }

            // Method untuk menampilkan event di month view
            renderMonthEvents() {
                const dayElements = this.monthGrid.querySelectorAll('.calendar-day');
                
                dayElements.forEach(dayEl => {
                    const date = dayEl.dataset.date;
                    const dayEvents = this.getEventsForDate(date);
                    const eventsContainer = dayEl.querySelector('.day-events');
                    
                    dayEvents.forEach(event => {
                        const eventDot = document.createElement('div');
                        eventDot.className = 'event-dot';
                        eventDot.style.background = event.color;
                        eventDot.textContent = event.title;
                        eventDot.title = `${event.title} - ${event.startTime}`;
                        
                        eventDot.addEventListener('click', (e) => {
                            e.stopPropagation();
                            this.openEventModal(event);
                        });
                        
                        eventsContainer.appendChild(eventDot);
                    });
                });
            }

            // Method untuk menampilkan event di week view
            renderWeekEvents() {
                const startOfWeek = this.getStartOfWeek(this.selectedDate);
                
                for (let i = 0; i < 7; i++) {
                    const date = new Date(startOfWeek);
                    date.setDate(startOfWeek.getDate() + i);
                    const dateStr = date.toISOString().split('T')[0];
                    const dayEvents = this.getEventsForDate(dateStr);
                    
                    dayEvents.forEach(event => {
                        const eventElement = this.createWeekEventElement(event, i);
                        this.weekGrid.appendChild(eventElement);
                    });
                }
            }

            // Method untuk menampilkan event di day view
            renderDayEvents() {
                const dateStr = this.selectedDate.toISOString().split('T')[0];
                const dayEvents = this.getEventsForDate(dateStr);
                
                dayEvents.forEach(event => {
                    const eventElement = this.createDayEventElement(event);
                    this.dayTimeline.appendChild(eventElement);
                });
            }

            createWeekEventElement(event, dayIndex) {
                const eventDiv = document.createElement('div');
                eventDiv.className = 'week-event';
                eventDiv.style.background = event.color;
                eventDiv.style.gridColumn = dayIndex + 2; // +2 because first column is time
                eventDiv.style.gridRow = this.getTimeSlot(event.startTime);
                eventDiv.textContent = event.title;
                
                eventDiv.addEventListener('click', () => {
                    this.openEventModal(event);
                });
                
                return eventDiv;
            }

            createDayEventElement(event) {
                const eventDiv = document.createElement('div');
                eventDiv.className = 'day-event';
                eventDiv.style.background = event.color;
                eventDiv.textContent = `${event.title} (${event.startTime} - ${event.endTime})`;
                
                eventDiv.addEventListener('click', () => {
                    this.openEventModal(event);
                });
                
                return eventDiv;
            }

            renderEventsList() {
                this.eventsList.innerHTML = '';
                
                const sortedEvents = this.events.sort((a, b) => new Date(a.startDate) - new Date(b.startDate));
                
                sortedEvents.forEach(event => {
                    const eventItem = this.createEventListItem(event);
                    this.eventsList.appendChild(eventItem);
                });
            }

            // Method untuk membuat item event di list
            createEventListItem(event) {
                const eventDiv = document.createElement('div');
                eventDiv.className = 'event-item';
                
                const colorDot = document.createElement('div');
                colorDot.className = 'event-color';
                colorDot.style.background = event.color;
                
                const eventInfo = document.createElement('div');
                eventInfo.className = 'event-info';
                
                const eventTitle = document.createElement('div');
                eventTitle.className = 'event-title';
                eventTitle.textContent = event.title;
                
                const eventTime = document.createElement('div');
                eventTime.className = 'event-time';
                
                // Tampilkan rentang tanggal jika berbeda
                const startDate = new Date(event.startDate);
                const endDate = new Date(event.endDate);
                
                if (startDate.getTime() === endDate.getTime()) {
                    eventTime.textContent = `${this.formatDate(event.startDate)} - ${event.startTime}`;
                } else {
                    eventTime.textContent = `${this.formatDate(event.startDate)} - ${this.formatDate(event.endDate)}`;
                }
                
                eventInfo.appendChild(eventTitle);
                eventInfo.appendChild(eventTime);
                
                const eventActions = document.createElement('div');
                eventActions.className = 'event-actions';
                
                const editBtn = document.createElement('button');
                editBtn.className = 'edit-btn';
                editBtn.innerHTML = '<i class="fas fa-edit"></i>';
                editBtn.addEventListener('click', () => this.openEventModal(event));
                
                const deleteBtn = document.createElement('button');
                deleteBtn.className = 'delete-btn';
                deleteBtn.innerHTML = '<i class="fas fa-trash"></i>';
                deleteBtn.addEventListener('click', () => this.deleteEventById(event.id));
                
                eventActions.appendChild(editBtn);
                eventActions.appendChild(deleteBtn);
                
                eventDiv.appendChild(colorDot);
                eventDiv.appendChild(eventInfo);
                eventDiv.appendChild(eventActions);
                
                return eventDiv;
            }

            openEventModal(event = null) {
                this.editingEventId = event ? event.id : null;
                
                if (event) {
                    this.modalTitle.textContent = 'Edit Event';
                    this.eventTitle.value = event.title;
                    this.eventStartDate.value = event.startDate;
                    this.eventEndDate.value = event.endDate;
                    this.eventStart.value = event.startTime;
                    this.eventEnd.value = event.endTime;
                    this.eventDescription.value = event.description || '';
                    
                    // Set color
                    const colorRadio = document.querySelector(`input[name="warna"][value="${event.color}"]`);
                    if (colorRadio) colorRadio.checked = true;
                    
                    this.deleteEventBtn.style.display = 'block';
                    this.saveEventBtn.textContent = 'Update Event';
                } else {
                    this.modalTitle.textContent = 'Add New Event';
                    this.eventForm.reset();
                    
                    // Set tanggal default
                    const today = new Date().toISOString().split('T')[0];
                    this.eventStartDate.value = today;
                    this.eventEndDate.value = today;
                    
                    this.deleteEventBtn.style.display = 'none';
                    this.saveEventBtn.textContent = 'Save Event';
                }
                
                this.eventModal.classList.add('active');
            }

            handleEventSubmit(e) {
                e.preventDefault();
                
                // Validasi tanggal
                if (!this.validateDates()) {
                    return;
                }

                // Disable form while processing
                this.saveEventBtn.disabled = true;
                this.saveEventBtn.textContent = 'Saving...';
                
                const formData = new FormData(this.eventForm);
                
                if (this.editingEventId) {
                    this.updateEventOnServer(this.editingEventId, formData);
                } else {
                    this.addEventToServer(formData);
                }
            }

            addEventToServer(formData) {
                $.ajax({
                    url: '{{ route("events.store") }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: (response) => {
                        if (response.status === 'success') {
                            showAlert('Event berhasil disimpan!', 'success');
                            this.closeEventModal();
                            this.loadEventsFromServer();
                        } else {
                            showAlert('Gagal menyimpan event', 'error');
                        }
                    },
                    error: (xhr) => {
                        let errorMessage = 'Gagal menyimpan event';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = Object.values(xhr.responseJSON.errors).flat();
                            errorMessage = errors.join(', ');
                        }
                        showAlert(errorMessage, 'error');
                    },
                    complete: () => {
                        this.saveEventBtn.disabled = false;
                        this.saveEventBtn.textContent = this.editingEventId ? 'Update Event' : 'Save Event';
                    }
                });
            }

            updateEventOnServer(eventId, formData) {
                // Add PUT method override
                formData.append('_method', 'PUT');
                
                $.ajax({
                    url: `{{ url('/dashboard/events') }}/${eventId}`,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: (response) => {
                        if (response.status === 'success') {
                            showAlert('Event berhasil diupdate!', 'success');
                            this.closeEventModal();
                            this.loadEventsFromServer();
                        } else {
                            showAlert('Gagal mengupdate event', 'error');
                        }
                    },
                    error: (xhr) => {
                        let errorMessage = 'Gagal mengupdate event';
                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            const errors = Object.values(xhr.responseJSON.errors).flat();
                            errorMessage = errors.join(', ');
                        }
                        showAlert(errorMessage, 'error');
                    },
                    complete: () => {
                        this.saveEventBtn.disabled = false;
                        this.saveEventBtn.textContent = 'Update Event';
                    }
                });
            }

            closeEventModal() {
                this.eventModal.classList.remove('active');
                this.editingEventId = null;
                this.saveEventBtn.disabled = false;
            }

            deleteEvent() {
                if (this.editingEventId && confirm('Apakah Anda yakin ingin menghapus event ini?')) {
                    this.deleteEventById(this.editingEventId);
                    this.closeEventModal();
                }
            }

            deleteEventById(eventId) {
                if (!confirm('Apakah Anda yakin ingin menghapus event ini?')) {
                    return;
                }

                $.ajax({
                    url: `{{ url('/dashboard/events') }}/${eventId}`,
                    method: 'DELETE',
                    success: (response) => {
                        if (response.status === 'success') {
                            showAlert('Event berhasil dihapus!', 'success');
                            this.loadEventsFromServer();
                        } else {
                            showAlert('Gagal menghapus event', 'error');
                        }
                    },
                    error: (xhr) => {
                        showAlert('Gagal menghapus event', 'error');
                    }
                });
            }

            selectDate(date) {
                this.selectedDate = date;
                this.renderCalendar();
                this.renderEvents();
            }

            // Utility methods
            isToday(date) {
                const today = new Date();
                return date.toDateString() === today.toDateString();
            }

            isSelected(date) {
                return date.toDateString() === this.selectedDate.toDateString();
            }

            getStartOfWeek(date) {
                const start = new Date(date);
                const day = start.getDay();
                start.setDate(start.getDate() - day);
                return start;
            }

            getEventsForDate(date) {
                const targetDate = new Date(date);
                return this.events.filter(event => {
                    const startDate = new Date(event.startDate);
                    const endDate = new Date(event.endDate);
                    return targetDate >= startDate && targetDate <= endDate;
                });
            }

            formatHour(hour) {
                return hour < 12 ? `${hour} AM` : hour === 12 ? '12 PM' : `${hour - 12} PM`;
            }

            formatDate(dateStr) {
                return new Date(dateStr).toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric'
                });
            }

            getTimeSlot(timeStr) {
                const [hours, minutes] = timeStr.split(':').map(Number);
                return Math.max(1, hours - 5); // 6 AM = slot 1
            }

            clearEventDisplay() {
                // Clear month view events
                const dayEvents = this.monthGrid.querySelectorAll('.day-events');
                dayEvents.forEach(container => {
                    container.innerHTML = '';
                });
                
                // Clear week view events
                const weekEvents = this.weekGrid.querySelectorAll('.week-event');
                weekEvents.forEach(event => event.remove());
                
                // Clear day view events
                const dayViewEvents = this.dayTimeline.querySelectorAll('.day-event');
                dayViewEvents.forEach(event => event.remove());
            }
        }

        // Initialize calendar when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            const calendar = new InteractiveCalendar();
            
            // Make calendar globally accessible for debugging
            window.calendar = calendar;
        });
    </script>
</body>

</html>