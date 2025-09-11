 

<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .chart-container {
            position: relative;
            height: 400px;
            margin-bottom: 30px;
        }
        .period-tabs {
            margin-bottom: 20px;
        }
        .period-tabs .nav-link {
            border-radius: 8px;
            margin-right: 5px;
        }
        .period-tabs .nav-link.active {
            background-color: #007bff;
            border-color: #007bff;
        }
        .table-container {
            max-height: 500px;
            overflow-y: auto;
        }
        .export-buttons {
            gap: 10px;
        }
        .chart-toggle {
            margin-bottom: 15px;
        }
        @media (max-width: 768px) {
            .chart-container {
                height: 300px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        @include('admin.sidebar')

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
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
                </div>
                <x-app-layout>
                </x-app-layout>
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="page-header">
                        <h3 class="fw-bold mb-3">Laporan Klik Majalah</h3>
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
                                <a href="#">Laporan</a>
                            </li>
                        </ul>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Filter Section -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="GET" action="{{ route('product.report') }}" class="row">
                                        <div class="col-md-3">
                                            <label class="form-label">Filter Majalah</label>
                                            <select name="product_id" class="form-control">
                                                <option value="">Semua Majalah</option>
                                                @foreach($products ?? [] as $product)
                                                    <option value="{{ $product->id }}" 
                                                        {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                                        {{ $product->description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Periode</label>
                                            <select name="date_range" class="form-control" id="dateRangeSelect">
                                                <option value="default" {{ request('date_range') == 'default' ? 'selected' : '' }}>Default</option>
                                                <option value="custom" {{ request('date_range') == 'custom' ? 'selected' : '' }}>Custom</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2" id="startDateDiv" style="display: {{ request('date_range') == 'custom' ? 'block' : 'none' }}">
                                            <label class="form-label">Dari Tanggal</label>
                                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                        </div>
                                        <div class="col-md-2" id="endDateDiv" style="display: {{ request('date_range') == 'custom' ? 'block' : 'none' }}">
                                            <label class="form-label">Sampai Tanggal</label>
                                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                        </div>
                                         
                                        <div class="col-md-2">
                                            <label class="form-label">&nbsp;</label>
                                            <div class="d-grid gap-2">  <!-- Grid layout dengan gap -->
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-filter"></i> Filter
                                                </button>
                                                <a href="{{ route('magazines.report') }}" class="btn btn-secondary">
                                                    <i class="fa fa-refresh"></i> Reset
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Statistics -->
                    @if(isset($summary))
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3 class="text-primary">{{ number_format($summary['total_clicks']) }}</h3>
                                    <p class="text-muted mb-0">Total Klik</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3 class="text-success">{{ number_format($summary['total_products']) }}</h3>
                                    <p class="text-muted mb-0">Total Majalah</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3 class="text-info">{{ number_format($summary['today_clicks']) }}</h3>
                                    <p class="text-muted mb-0">Klik Hari Ini</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h3 class="text-warning">{{ number_format($summary['avg_clicks_per_day'], 1) }}</h3>
                                    <p class="text-muted mb-0">Rata-rata/Hari</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="card-title">Analisis Klik Majalah</h4>
                                        <div class="d-flex export-buttons">
                                            <a href="{{ route('magazines.export') }}" class="btn btn-success">
                                                <i class="fa fa-download"></i> Download Excel
                                            </a>
                                            <button id="printReport" class="btn btn-info">
                                                <i class="fa fa-print"></i> Print
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <!-- Period Tabs -->
                                    <ul class="nav nav-tabs period-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#daily-tab" role="tab">
                                                <i class="fa fa-calendar-day"></i> Harian
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#weekly-tab" role="tab">
                                                <i class="fa fa-calendar-week"></i> Mingguan
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#monthly-tab" role="tab">
                                                <i class="fa fa-calendar-alt"></i> Bulanan
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#yearly-tab" role="tab">
                                                <i class="fa fa-calendar"></i> Tahunan
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Tab Content -->
                                    <div class="tab-content">
                                        <!-- Daily Tab -->
                                        <div class="tab-pane fade show active" id="daily-tab" role="tabpanel">
                                            <div class="chart-toggle">
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleChartType('daily', 'line')">Line Chart</button>
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleChartType('daily', 'bar')">Bar Chart</button>
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleChartType('daily', 'doughnut')">Pie Chart</button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="chart-container">
                                                        <canvas id="dailyChart"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="table-container">
                                                        <table class="table table-striped table-sm" id="dailyTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Majalah</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Klik</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse($daily as $product_id => $records)
                                                                    @foreach($records as $record)
                                                                        <tr>
                                                                            <td>{{ $record->product->description ?? 'Unknown' }}</td>
                                                                            <td>{{ $record->date ? \Carbon\Carbon::parse($record->date)->format('d/m/Y') : '' }}</td>
                                                                            <td><span class="badge badge-primary">{{ $record->total }}</span></td>
                                                                        </tr>
                                                                    @endforeach
                                                                @empty
                                                                    <tr>
                                                                        <td colspan="3" class="text-center text-muted">Tidak ada data</td>
                                                                    </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Weekly Tab -->
                                        <div class="tab-pane fade" id="weekly-tab" role="tabpanel">
                                            <div class="chart-toggle">
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleChartType('weekly', 'line')">Line Chart</button>
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleChartType('weekly', 'bar')">Bar Chart</button>
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleChartType('weekly', 'doughnut')">Pie Chart</button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="chart-container">
                                                        <canvas id="weeklyChart"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="table-container">
                                                        <table class="table table-striped table-sm" id="weeklyTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Majalah</th>
                                                                    <th>Minggu</th>
                                                                    <th>Klik</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($weekly) && count($weekly) > 0)
                                                                    @foreach($weekly as $product_id => $records)
                                                                        @foreach($records as $record)
                                                                            <tr>
                                                                                <td>{{ Str::limit($record->product->description ?? 'Unknown', 20) }}</td>
                                                                                <td>{{ $record->week }}</td>
                                                                                <td><span class="badge badge-success">{{ $record->total }}</span></td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="3" class="text-center text-muted">Tidak ada data</td>
                                                                    </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Monthly Tab -->
                                        <div class="tab-pane fade" id="monthly-tab" role="tabpanel">
                                            <div class="chart-toggle">
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleChartType('monthly', 'line')">Line Chart</button>
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleChartType('monthly', 'bar')">Bar Chart</button>
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleChartType('monthly', 'doughnut')">Pie Chart</button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="chart-container">
                                                        <canvas id="monthlyChart"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="table-container">
                                                        <table class="table table-striped table-sm" id="monthlyTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Majalah</th>
                                                                    <th>Bulan</th>
                                                                    <th>Klik</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if(isset($monthly) && count($monthly) > 0)
                                                                    @foreach($monthly as $product_id => $records)
                                                                        @foreach($records as $record)
                                                                            <tr>
                                                                                <td>{{ Str::limit($record->product->description ?? 'Unknown', 20) }}</td>
                                                                                <td>{{ $record->month }}</td>
                                                                                <td><span class="badge badge-warning">{{ $record->total }}</span></td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="3" class="text-center text-muted">Tidak ada data</td>
                                                                    </tr>
                                                                @endif

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Yearly Tab -->
                                        <div class="tab-pane fade" id="yearly-tab" role="tabpanel">
                                            <div class="chart-toggle">
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleChartType('yearly', 'line')">Line Chart</button>
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleChartType('yearly', 'bar')">Bar Chart</button>
                                                <button class="btn btn-sm btn-outline-primary" onclick="toggleChartType('yearly', 'doughnut')">Pie Chart</button>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="chart-container">
                                                        <canvas id="yearlyChart"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="table-container">
                                                        <table class="table table-striped table-sm" id="yearlyTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Majalah</th>
                                                                    <th>Tahun</th>
                                                                    <th>Klik</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                 @if(isset($yearly) && count($yearly) > 0)
                                                                    @foreach($yearly as $product_id => $records)
                                                                        @foreach($records as $record)
                                                                            <tr>
                                                                                <td>{{ Str::limit($record->product->description ?? 'Unknown', 20) }}</td>
                                                                                <td>{{ $record->year }}</td>
                                                                                <td><span class="badge badge-danger">{{ $record->total }}</span></td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="3" class="text-center text-muted">Tidak ada data</td>
                                                                    </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

    @include('admin.js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    
    <script>
        // Konfigurasi Chart
        const chartConfig = {
            colors: [
                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40',
                '#8E5EA2', '#3cba9f', '#e8c3b9', '#c45850', '#DD1B16', '#00D2FF',
                '#FF9500', '#8BC34A', '#FF5722', '#795548', '#607D8B', '#E91E63',
                '#9C27B0', '#673AB7', '#3F51B5', '#2196F3', '#03A9F4', '#00BCD4',
                '#009688', '#4CAF50', '#8BC34A', '#CDDC39', '#FFEB3B'
            ],
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 10,
                            font: { size: 10 }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    x: {
                        display: true,
                        title: { display: true, text: 'Periode' }
                    },
                    y: {
                        display: true,
                        title: { display: true, text: 'Jumlah Klik' },
                        beginAtZero: true
                    }
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            },
            doughnutOptions: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 10,
                            font: { size: 10 }
                        }
                    }
                }
            }
        };

        // Inisialisasi variabel global
        const charts = {};
        let chartData = {
            daily: null,
            weekly: null,
            monthly: null,
            yearly: null
        };

        // Fungsi utilitas
        function getRandomColor() {
            return chartConfig.colors[Math.floor(Math.random() * chartConfig.colors.length)];
        }

        function formatDate(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID');
        }

        // Fungsi untuk memproses data chart
        // function processChartData(rawData, periodType) {
        //     try {
        //         if (!rawData || typeof rawData !== 'object') {
        //             return { labels: [], datasets: [] };
        //         }

        //         // Ekstrak semua label unik
        //         const allLabels = [];
        //         Object.values(rawData).forEach(group => {
        //             group.forEach(item => {
        //                 let label;
        //                 switch(periodType) {
        //                     case 'daily': 
        //                         label = formatDate(item.date);
        //                         break;
        //                     case 'weekly': 
        //                         label = item.week;
        //                         break;
        //                     case 'monthly': 
        //                         label = item.month;
        //                         break;
        //                     case 'yearly': 
        //                         label = item.year;
        //                         break;
        //                     default: 
        //                         label = '';
        //                 }
        //                 if (label && !allLabels.includes(label)) {
        //                     allLabels.push(label);
        //                 }
        //             });
        //         });

        //         // Urutkan label berdasarkan periode
        //         allLabels.sort((a, b) => {
        //             if (periodType === 'daily') {
        //                 return new Date(a.split('/').reverse().join('-')) - new Date(b.split('/').reverse().join('-'));
        //             }
        //             return a.localeCompare(b);
        //         });

        //         // Buat dataset untuk setiap majalah
        //         const datasets = Object.entries(rawData).map(([productId, records], index) => {
        //             const proukTitle = records[0]?.product?.description || 'Unknown';
        //             const shortTitle = proukTitle.length > 25 
        //                 ? proukTitle.substring(0, 22) + '...' 
        //                 : proukTitle;

        //             const dataPoints = allLabels.map(label => {
        //                 const record = records.find(r => {
        //                     switch(periodType) {
        //                         case 'daily': return formatDate(r.date) === label;
        //                         case 'weekly': return r.week === label;
        //                         case 'monthly': return r.month === label;
        //                         case 'yearly': return r.year === label;
        //                         default: return false;
        //                     }
        //                 });
        //                 return record ? record.total : 0;
        //             });

        //             return {
        //                 label: shortTitle,
        //                 data: dataPoints,
        //                 borderColor: chartConfig.colors[index % chartConfig.colors.length] || getRandomColor(),
        //                 backgroundColor: chartConfig.colors[index % chartConfig.colors.length] || getRandomColor(),
        //                 fill: false,
        //                 tension: 0.4
        //             };
        //         });

        //         return {
        //             labels: allLabels,
        //             datasets: datasets
        //         };
        //     } catch (error) {
        //         console.error(`Error processing ${periodType} data:`, error);
        //         return { labels: [], datasets: [] };
        //     }
        // }
        // Fungsi untuk memproses data chart
        function processChartData(rawData, periodType) {
            try {
                if (!rawData || typeof rawData !== 'object' || Object.keys(rawData).length === 0) {
                    console.warn(`No data available for ${periodType} period`);
                    return { labels: ['No Data'], datasets: [{ label: 'No Data', data: [0], backgroundColor: '#cccccc' }] };
                }

                // Collect all unique periods
                const allPeriods = new Set();
                const productsData = {};

                // Process each product's records
                Object.entries(rawData).forEach(([productId, records]) => {
                    records.forEach(record => {
                        let period;
                        switch(periodType) {
                            case 'daily':
                                period = record.date ? new Date(record.date).toLocaleDateString('id-ID') : '';
                                break;
                            case 'weekly':
                                period = `Minggu ${record.week}`;
                                break;
                            case 'monthly':
                                period = record.month ? new Date(record.month + '-01').toLocaleDateString('id-ID', { month: 'long', year: 'numeric' }) : '';
                                break;
                            case 'yearly':
                                period = record.year ? record.year.toString() : '';
                                break;
                            default:
                                period = '';
                        }

                        if (period) {
                            allPeriods.add(period);
                            
                            if (!productsData[productId]) {
                                productsData[productId] = {
                                    label: record.product?.description || 'Unknown',
                                    data: {},
                                    color: getRandomColor()
                                };
                            }
                            
                            productsData[productId].data[period] = record.total;
                        }
                    });
                });

                // Sort periods
                const sortedPeriods = Array.from(allPeriods).sort((a, b) => {
                    if (periodType === 'daily') {
                        return new Date(a.split('/').reverse().join('-')) - new Date(b.split('/').reverse().join('-'));
                    } else if (periodType === 'monthly') {
                        return new Date(a) - new Date(b);
                    }
                    return a.localeCompare(b);
                });

                // Prepare datasets
                const datasets = Object.values(productsData).map((product, index) => {
                    const dataPoints = sortedPeriods.map(period => product.data[period] || 0);
                    
                    return {
                        label: product.label.length > 25 
                            ? product.label.substring(0, 22) + '...' 
                            : product.label,
                        data: dataPoints,
                        borderColor: chartConfig.colors[index % chartConfig.colors.length] || getRandomColor(),
                        backgroundColor: chartConfig.colors[index % chartConfig.colors.length] || getRandomColor(),
                        fill: false,
                        tension: 0.4
                    };
                });

                return {
                    labels: sortedPeriods,
                    datasets: datasets
                };
            } catch (error) {
                console.error(`Error processing ${periodType} data:`, error);
                return { labels: ['Error'], datasets: [{ label: 'Error', data: [0], backgroundColor: '#ff0000' }] };
            }
        }

        // Fungsi untuk menginisialisasi chart
        function initializeChart(chartId, data, initialType = 'line') {
            const ctx = document.getElementById(chartId).getContext('2d');
            if (charts[chartId]) {
                charts[chartId].destroy();
            }

            charts[chartId] = new Chart(ctx, {
                type: initialType,
                data: data,
                options: initialType === 'doughnut' ? chartConfig.doughnutOptions : chartConfig.options
            });
        }

        // Fungsi untuk toggle tipe chart
        function toggleChartType(period, type) {
            const chartId = `${period}Chart`;
            if (!chartData[period]) return;

            if (type === 'doughnut') {
                // Buat data agregat untuk pie chart
                const aggregatedData = {
                    labels: chartData[period].datasets.map(d => d.label),
                    datasets: [{
                        data: chartData[period].datasets.map(d => d.data.reduce((a, b) => a + b, 0)),
                        backgroundColor: chartData[period].datasets.map(d => d.backgroundColor)
                    }]
                };
                initializeChart(chartId, aggregatedData, 'doughnut');
            } else {
                initializeChart(chartId, chartData[period], type);
            }
        }

        // Fungsi untuk inisialisasi semua chart
        function initializeAllCharts() {
            // Proses data dari PHP ke format yang sesuai
            chartData = {
                daily: processChartData(@json($daily ?? []), 'daily'),
                weekly: processChartData(@json($weekly ?? []), 'weekly'),
                monthly: processChartData(@json($monthly ?? []), 'monthly'),
                yearly: processChartData(@json($yearly ?? []), 'yearly')
            };

            // Inisialisasi masing-masing chart
            initializeChart('dailyChart', chartData.daily);
            initializeChart('weeklyChart', chartData.weekly);
            initializeChart('monthlyChart', chartData.monthly);
            initializeChart('yearlyChart', chartData.yearly);
        }

        // Event Listeners
        function setupEventListeners() {
            // Tombol print
            document.getElementById('printReport')?.addEventListener('click', () => window.print());

            // Filter tanggal
            const dateRangeSelect = document.getElementById('dateRangeSelect');
            const startDateDiv = document.getElementById('startDateDiv');
            const endDateDiv = document.getElementById('endDateDiv');
            
            if (dateRangeSelect) {
                dateRangeSelect.addEventListener('change', function() {
                    const showCustom = this.value === 'custom';
                    startDateDiv.style.display = showCustom ? 'block' : 'none';
                    endDateDiv.style.display = showCustom ? 'block' : 'none';
                });
            }

            // Resize chart saat tab diubah
            document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
                tab.addEventListener('shown.bs.tab', () => {
                    setTimeout(() => {
                        Object.values(charts).forEach(chart => chart?.resize());
                    }, 100);
                });
            });
        }

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', () => {
            initializeAllCharts();
            setupEventListeners();
        });
    </script>

<style media="print">
    .export-buttons, .chart-toggle {
        display: none !important;
    }
    .chart-container {
        height: 300px !important;
    }
    .tab-content > .tab-pane {
        display: block !important;
        opacity: 1 !important;
    }
    .nav-tabs {
        display: none !important;
    }
</style>

</body>
</html>