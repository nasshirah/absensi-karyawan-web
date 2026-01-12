<?php $__env->startSection('content'); ?>
<?php ($title = 'Dashboard'); ?>

<style>
    /* Global Dashboard Styles */
    .dashboard-container {
        max-width: 1600px;
        margin: 0 auto;
        position: relative;
    }

    /* Ambient Background Glow */
    .dashboard-container::before {
        content: '';
        position: absolute;
        top: -150px;
        right: -150px;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.15) 0%, rgba(0,0,0,0) 70%);
        z-index: -1;
        pointer-events: none;
    }
    
    .dashboard-container::after {
        content: '';
        position: absolute;
        bottom: -150px;
        left: -150px;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(236, 72, 153, 0.1) 0%, rgba(0,0,0,0) 70%);
        z-index: -1;
        pointer-events: none;
    }

    /* Header */
    .welcome-header {
        margin-bottom: 2.5rem;
        position: relative;
    }

    .welcome-title {
        font-size: 2.25rem;
        font-weight: 800;
        letter-spacing: -1px;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .welcome-subtitle {
        color: #64748b;
        font-size: 1.1rem;
        font-weight: 500;
    }

    /* Stat Cards */
    .stat-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 24px;
        padding: 1.75rem;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.95);
        border-color: rgba(255, 255, 255, 1);
    }

    .stat-icon-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1.25rem;
        transition: transform 0.3s ease;
        box-shadow: 0 8px 16px -4px rgba(0,0,0,0.1);
    }

    .stat-card:hover .stat-icon-wrapper {
        transform: scale(1.1) rotate(-5deg);
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1;
        margin-bottom: 0.25rem;
        letter-spacing: -1px;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Gradients for Icons */
    .grad-indigo { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: white; box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4); }
    .grad-pink { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); color: white; box-shadow: 0 10px 20px -5px rgba(219, 39, 119, 0.4); }
    .grad-emerald { background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; box-shadow: 0 10px 20px -5px rgba(5, 150, 105, 0.4); }
    .grad-amber { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; box-shadow: 0 10px 20px -5px rgba(217, 119, 6, 0.4); }
    .grad-cyan { background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: white; box-shadow: 0 10px 20px -5px rgba(8, 145, 178, 0.4); }
    .grad-red { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; box-shadow: 0 10px 20px -5px rgba(220, 38, 38, 0.4); }
    .grad-slate { background: linear-gradient(135deg, #64748b 0%, #475569 100%); color: white; box-shadow: 0 10px 20px -5px rgba(71, 85, 105, 0.4); }

    /* Chart Cards */
    .chart-panel {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        height: 100%;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        border: 1px solid rgba(226, 232, 240, 0.6);
        transition: all 0.3s ease;
    }
    
    .chart-panel:hover {
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.05);
    }

    .chart-header {
        margin-bottom: 2rem;
    }

    .chart-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -0.5px;
    }
    
    .chart-subtitle {
        color: #94a3b8;
        font-size: 0.9rem;
        margin-top: 0.25rem;
    }

    /* Animation Stagger */
    .animate-up {
        opacity: 0;
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="welcome-header animate-up">
        <h1 class="welcome-title">Dashboard Overview</h1>
        <p class="welcome-subtitle">Monitor performa presensi dan aktivitas karyawan secara real-time.</p>
    </div>

    <!-- Stats Grid -->
    <div class="row g-4 mb-5">
        <!-- Total Users -->
        <div class="col-sm-6 col-lg-3 animate-up" style="animation-delay: 0.1s;">
            <div class="stat-card">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <div class="stat-value"><?php echo e($stats['total_users']); ?></div>
                        <div class="stat-label">Total Pengguna</div>
                    </div>
                    <div class="stat-icon-wrapper grad-indigo">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="badge bg-light text-primary border rounded-pill px-3 py-2">
                        <i class="bi bi-people me-1"></i> +12% this month
                    </span>
                </div>
            </div>
        </div>

        <!-- Hadir Hari Ini -->
        <div class="col-sm-6 col-lg-3 animate-up" style="animation-delay: 0.2s;">
            <a href="<?php echo e(route('admin.dashboard.today')); ?>" class="text-decoration-none">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-value text-success"><?php echo e($stats['present_today']); ?></div>
                            <div class="stat-label">Hadir Hari Ini</div>
                        </div>
                        <div class="stat-icon-wrapper grad-emerald">
                            <i class="bi bi-check-lg"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 6px; border-radius: 10px; background: #e2e8f0;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e($stats['total_users'] > 0 ? ($stats['present_today'] / $stats['total_users']) * 100 : 0); ?>%"></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Telat Hari Ini -->
        <div class="col-sm-6 col-lg-3 animate-up" style="animation-delay: 0.3s;">
            <a href="<?php echo e(route('admin.dashboard.telat')); ?>" class="text-decoration-none">
                <div class="stat-card">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="stat-value text-danger"><?php echo e($stats['late_today']); ?></div>
                            <div class="stat-label">Terlambat</div>
                        </div>
                        <div class="stat-icon-wrapper grad-pink">
                            <i class="bi bi-alarm-fill"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="text-danger small fw-bold">
                            <i class="bi bi-arrow-up-right me-1"></i> Perlu Perhatian
                        </span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Tidak Hadir -->
        <div class="col-sm-6 col-lg-3 animate-up" style="animation-delay: 0.4s;">
            <div class="stat-card">
                <div class="d-flex align-items-start justify-content-between">
                    <div>
                        <div class="stat-value text-muted"><?php echo e($stats['absent_today']); ?></div>
                        <div class="stat-label">Tidak Hadir</div>
                    </div>
                    <div class="stat-icon-wrapper grad-slate">
                        <i class="bi bi-person-x-fill"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="text-muted small">Tanpa Keterangan: <?php echo e($stats['absent_today']); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="row g-4 mb-5 animate-up" style="animation-delay: 0.5s;">
        <div class="col-md-4">
            <div class="stat-card py-3 px-4 d-flex flex-row align-items-center gap-3">
                <div class="stat-icon-wrapper grad-amber mb-0" style="width: 48px; height: 48px; font-size: 1.25rem;">
                    <i class="bi bi-shield-check"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-dark"><?php echo e($stats['admins']); ?></div>
                    <div class="text-muted text-uppercase text-xs fw-bold">Administrators</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card py-3 px-4 d-flex flex-row align-items-center gap-3">
                <div class="stat-icon-wrapper grad-cyan mb-0" style="width: 48px; height: 48px; font-size: 1.25rem;">
                    <i class="bi bi-briefcase-fill"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-dark"><?php echo e($stats['karyawans']); ?></div>
                    <div class="text-muted text-uppercase text-xs fw-bold">Total Karyawan</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card py-3 px-4 d-flex flex-row align-items-center gap-3">
                <div class="stat-icon-wrapper grad-red mb-0" style="width: 48px; height: 48px; font-size: 1.25rem;">
                    <i class="bi bi-key-fill"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-dark"><?php echo e($stats['permissions']); ?></div>
                    <div class="text-muted text-uppercase text-xs fw-bold">Permissions</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-4">
        <!-- Monthly Trend -->
        <div class="col-lg-8 animate-up" style="animation-delay: 0.6s;">
            <div class="chart-panel">
                <div class="chart-header d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="chart-title">Tren Kehadiran Bulanan</h3>
                        <p class="chart-subtitle">Analisis grafik kehadiran selama 30 hari terakhir</p>
                    </div>
                </div>
                <div style="height: 350px;">
                    <canvas id="monthlyTrendChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Status Pie -->
        <div class="col-lg-4 animate-up" style="animation-delay: 0.7s;">
            <div class="chart-panel">
                <div class="chart-header">
                    <h3 class="chart-title">Status Hari Ini</h3>
                    <p class="chart-subtitle">Komposisi kehadiran karyawan</p>
                </div>
                <div style="height: 300px; position: relative;">
                    <canvas id="statusChart"></canvas>
                    <div class="position-absolute top-50 start-50 translate-middle text-center">
                        <div class="text-muted small text-uppercase fw-bold">Total</div>
                        <div class="fs-2 fw-bold text-dark"><?php echo e($stats['total_users']); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Styling constants
    Chart.defaults.font.family = "'Outfit', 'Helvetica', 'Arial', sans-serif";
    Chart.defaults.color = '#64748b';
    
    // Status Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Hadir', 'Telat', 'Tidak Hadir'],
            datasets: [{
                data: [<?php echo e($stats['present_today']); ?>, <?php echo e($stats['late_today']); ?>, <?php echo e($stats['absent_today']); ?>],
                backgroundColor: [
                    '#10b981', // Emerald
                    '#ec4899', // Pink
                    '#94a3b8'  // Slate
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            cutout: '75%',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { usePointStyle: true, padding: 20, font: { weight: 600 } }
                }
            }
        }
    });

    // Monthly Trend Chart
    const monthlyCtx = document.getElementById('monthlyTrendChart').getContext('2d');
    
    // Gradient for Area
    let gradientPresent = monthlyCtx.createLinearGradient(0, 0, 0, 400);
    gradientPresent.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
    gradientPresent.addColorStop(1, 'rgba(16, 185, 129, 0)');

    let gradientLate = monthlyCtx.createLinearGradient(0, 0, 0, 400);
    gradientLate.addColorStop(0, 'rgba(236, 72, 153, 0.2)');
    gradientLate.addColorStop(1, 'rgba(236, 72, 153, 0)');

    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: ['1', '5', '10', '15', '20', '25', '30'], // Sample labels
            datasets: [
                {
                    label: 'Hadir',
                    data: [85, 88, 87, 85, 89, 90, 88], // Sample data
                    borderColor: '#10b981',
                    backgroundColor: gradientPresent,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 0,
                    pointHoverRadius: 6
                },
                {
                    label: 'Telat',
                    data: [5, 3, 6, 8, 4, 3, 5], // Sample data
                    borderColor: '#ec4899',
                    backgroundColor: gradientLate,
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 0,
                    pointHoverRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { align: 'end', labels: { usePointStyle: true } }
            },
            scales: {
                y: { grid: { borderDash: [4, 4], color: '#f1f5f9' }, beginAtZero: true },
                x: { grid: { display: false } }
            }
        }
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.metronic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Absensi_Karyawan\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>