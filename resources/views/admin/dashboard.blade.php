@extends('layouts.metronic')

@section('content')
@php($title = 'Dashboard')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<style>
    .dashboard-header {
        margin-bottom: 2rem;
    }
    
    .dashboard-title {
        font-size: 28px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.5rem;
    }
    
    .dashboard-subtitle {
        color: #718096;
        font-size: 15px;
    }

    .stat-card {
        border: none;
        border-radius: 20px;
        transition: all 0.3s ease;
        background: white;
        overflow: hidden;
        position: relative;
        height: 100%;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.12);
    }
    
    .stat-card-body {
        padding: 1.75rem;
        position: relative;
        z-index: 1;
    }
    
    .icon-box {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        color: #fff;
        margin-bottom: 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .stat-label {
        color: #718096;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }
    
    .stat-value {
        font-size: 2.25rem;
        font-weight: 800;
        color: #2d3748;
        line-height: 1;
    }
    
    .stat-card.clickable {
        cursor: pointer;
    }
    
    .stat-card.clickable:hover .icon-box {
        transform: scale(1.1) rotate(5deg);
        transition: all 0.3s ease;
    }
    
    /* Color schemes */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .bg-gradient-danger {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }
    
    .bg-gradient-success {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }
    
    .bg-gradient-warning {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }
    
    .bg-gradient-info {
        background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
    }
    
    .bg-gradient-green {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }
    
    .bg-gradient-orange {
        background: linear-gradient(135deg, #ee0979 0%, #ff6a00 100%);
    }
    
    .bg-gradient-secondary {
        background: linear-gradient(135deg, #868f96 0%, #596164 100%);
    }
    
    /* Chart Cards */
    .chart-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        height: 100%;
    }
    
    .chart-header {
        margin-bottom: 1.5rem;
    }
    
    .chart-title {
        font-size: 18px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.25rem;
    }
    
    .chart-subtitle {
        font-size: 13px;
        color: #718096;
    }
    
    .chart-container {
        position: relative;
        height: 300px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .stat-value {
            font-size: 1.75rem;
        }
        
        .icon-box {
            width: 48px;
            height: 48px;
            font-size: 22px;
        }
        
        .chart-container {
            height: 250px;
        }
    }
</style>

<div class="dashboard-header">
    <h1 class="dashboard-title">Dashboard Overview</h1>
    <p class="dashboard-subtitle">Monitor sistem dan aktivitas karyawan secara real-time</p>
</div>

<div class="row g-4 mb-4">
    {{-- Total Users --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm">
            <div class="stat-card-body">
                <div class="icon-box bg-gradient-primary">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-label">Total Users</div>
                <div class="stat-value">{{ $stats['total_users'] }}</div>
            </div>
        </div>
    </div>

    {{-- Admins --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm">
            <div class="stat-card-body">
                <div class="icon-box bg-gradient-danger">
                    <i class="bi bi-person-gear"></i>
                </div>
                <div class="stat-label">Admins</div>
                <div class="stat-value">{{ $stats['admins'] }}</div>
            </div>
        </div>
    </div>

    {{-- Karyawans --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm">
            <div class="stat-card-body">
                <div class="icon-box bg-gradient-success">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div class="stat-label">Karyawans</div>
                <div class="stat-value">{{ $stats['karyawans'] }}</div>
            </div>
        </div>
    </div>

    {{-- Roles --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm">
            <div class="stat-card-body">
                <div class="icon-box bg-gradient-warning">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <div class="stat-label">Roles</div>
                <div class="stat-value">{{ $stats['roles'] }}</div>
            </div>
        </div>
    </div>

    {{-- Permissions --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm">
            <div class="stat-card-body">
                <div class="icon-box bg-gradient-info">
                    <i class="bi bi-key"></i>
                </div>
                <div class="stat-label">Permissions</div>
                <div class="stat-value">{{ $stats['permissions'] }}</div>
            </div>
        </div>
    </div>

    {{-- Hadir Hari Ini --}}
    <div class="col-sm-6 col-lg-3">
        <a href="{{ route('admin.dashboard.today') }}" class="text-decoration-none">
            <div class="card stat-card shadow-sm clickable">
                <div class="stat-card-body">
                    <div class="icon-box bg-gradient-green">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-label">Hadir Hari Ini</div>
                    <div class="stat-value">{{ $stats['present_today'] }}</div>
                </div>
            </div>
        </a>
    </div>

    {{-- Telat Hari Ini --}}
    <div class="col-sm-6 col-lg-3">
        <a href="{{ route('admin.dashboard.telat') }}" class="text-decoration-none">
            <div class="card stat-card shadow-sm clickable">
                <div class="stat-card-body">
                    <div class="icon-box bg-gradient-orange">
                        <i class="bi bi-exclamation-circle"></i>
                    </div>
                    <div class="stat-label">Telat Hari Ini</div>
                    <div class="stat-value">{{ $stats['late_today'] }}</div>
                </div>
            </div>
        </a>
    </div>

    {{-- Tidak Hadir --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm">
            <div class="stat-card-body">
                <div class="icon-box bg-gradient-secondary">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div class="stat-label">Tidak Hadir</div>
                <div class="stat-value">{{ $stats['absent_today'] }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Charts Section --}}
<div class="row g-4">
    {{-- Attendance Overview Chart --}}
    <div class="col-lg-8">
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Statistik Kehadiran Mingguan</h3>
                <p class="chart-subtitle">Data kehadiran 7 hari terakhir</p>
            </div>
            <div class="chart-container">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Attendance Status Pie Chart --}}
    <div class="col-lg-4">
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Status Kehadiran Hari Ini</h3>
                <p class="chart-subtitle">Persentase kehadiran karyawan</p>
            </div>
            <div class="chart-container">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Monthly Attendance Trend --}}
    <div class="col-lg-12">
        <div class="chart-card">
            <div class="chart-header">
                <h3 class="chart-title">Tren Kehadiran Bulanan</h3>
                <p class="chart-subtitle">Perbandingan kehadiran, keterlambatan, dan ketidakhadiran bulan ini</p>
            </div>
            <div class="chart-container" style="height: 350px;">
                <canvas id="monthlyTrendChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Chart colors
    const colors = {
        primary: '#667eea',
        success: '#11998e',
        danger: '#f5576c',
        warning: '#fee140',
        secondary: '#868f96',
        info: '#30cfd0'
    };

    // Weekly Attendance Chart
    const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
    new Chart(attendanceCtx, {
        type: 'bar',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: 'Hadir',
                data: [85, 92, 88, 90, 87, 45, 12],
                backgroundColor: 'rgba(17, 153, 142, 0.8)',
                borderColor: 'rgba(17, 153, 142, 1)',
                borderWidth: 2,
                borderRadius: 8
            }, {
                label: 'Telat',
                data: [8, 5, 7, 6, 9, 3, 1],
                backgroundColor: 'rgba(238, 9, 121, 0.8)',
                borderColor: 'rgba(238, 9, 121, 1)',
                borderWidth: 2,
                borderRadius: 8
            }, {
                label: 'Tidak Hadir',
                data: [7, 3, 5, 4, 4, 2, 1],
                backgroundColor: 'rgba(134, 143, 150, 0.8)',
                borderColor: 'rgba(134, 143, 150, 1)',
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 15,
                        font: {
                            size: 12,
                            weight: '600'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    borderRadius: 8,
                    titleFont: {
                        size: 14,
                        weight: '600'
                    },
                    bodyFont: {
                        size: 13
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: '600'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });

    // Status Pie Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Hadir', 'Telat', 'Tidak Hadir'],
            datasets: [{
                data: [{{ $stats['present_today'] }}, {{ $stats['late_today'] }}, {{ $stats['absent_today'] }}],
                backgroundColor: [
                    'rgba(17, 153, 142, 0.9)',
                    'rgba(238, 9, 121, 0.9)',
                    'rgba(134, 143, 150, 0.9)'
                ],
                borderColor: [
                    'rgba(17, 153, 142, 1)',
                    'rgba(238, 9, 121, 1)',
                    'rgba(134, 143, 150, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            size: 12,
                            weight: '600'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    borderRadius: 8,
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            cutout: '65%'
        }
    });

    // Monthly Trend Chart
    const monthlyCtx = document.getElementById('monthlyTrendChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: ['1', '5', '10', '15', '20', '25', '30'],
            datasets: [{
                label: 'Hadir',
                data: [88, 90, 87, 92, 89, 91, 88],
                borderColor: 'rgba(17, 153, 142, 1)',
                backgroundColor: 'rgba(17, 153, 142, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: 'rgba(17, 153, 142, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }, {
                label: 'Telat',
                data: [7, 6, 8, 5, 7, 6, 8],
                borderColor: 'rgba(238, 9, 121, 1)',
                backgroundColor: 'rgba(238, 9, 121, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: 'rgba(238, 9, 121, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }, {
                label: 'Tidak Hadir',
                data: [5, 4, 5, 3, 4, 3, 4],
                borderColor: 'rgba(134, 143, 150, 1)',
                backgroundColor: 'rgba(134, 143, 150, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 7,
                pointBackgroundColor: 'rgba(134, 143, 150, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 15,
                        font: {
                            size: 12,
                            weight: '600'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    borderRadius: 8,
                    titleFont: {
                        size: 14,
                        weight: '600'
                    },
                    bodyFont: {
                        size: 13
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: 'Tanggal',
                        font: {
                            size: 13,
                            weight: '600'
                        }
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    title: {
                        display: true,
                        text: 'Jumlah Karyawan',
                        font: {
                            size: 13,
                            weight: '600'
                        }
                    },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
});
</script>

@endsection