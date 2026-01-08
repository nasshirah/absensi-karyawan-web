@extends('layouts.karyawan')
@php($title = 'Dashboard')
@section('content')

<style>
    /* Dashboard Container */
    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
    }

    /* Ambient Background Glow */
    .dashboard-container::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(14, 165, 233, 0.15) 0%, rgba(0,0,0,0) 70%);
        z-index: -1;
        pointer-events: none;
    }
    
    .dashboard-container::after {
        content: '';
        position: absolute;
        bottom: -150px;
        left: -150px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(168, 85, 247, 0.1) 0%, rgba(0,0,0,0) 70%);
        z-index: -1;
        pointer-events: none;
    }

    /* Header */
    .welcome-header {
        margin-bottom: 2.5rem;
    }

    .welcome-title {
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -1px;
        margin-bottom: 0.25rem;
        color: #1e293b;
    }
    
    .welcome-name {
        background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .welcome-subtitle {
        color: #64748b;
        font-size: 1.05rem;
        font-weight: 500;
    }

    /* Main Status Card */
    .status-card {
        background: white;
        border-radius: 24px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.8);
        transition: transform 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .status-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
    }

    /* Status Scenarios */
    .status-bg-default { background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%); }
    .status-bg-present { background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-color: #bbf7d0; }
    .status-bg-late { background: linear-gradient(135deg, #fff1f2 0%, #ffe4e6 100%); border-color: #fecdd3; }
    .status-bg-none { background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border-color: #bfdbfe; }

    .status-icon-wrapper {
        width: 64px;
        height: 64px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 8px 16px -4px rgba(0,0,0,0.1);
    }

    .icon-present { background: #22c55e; color: white; box-shadow: 0 10px 20px -5px rgba(34, 197, 94, 0.4); }
    .icon-late { background: #ef4444; color: white; box-shadow: 0 10px 20px -5px rgba(239, 68, 68, 0.4); }
    .icon-none { background: #3b82f6; color: white; box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4); }

    .status-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .status-value {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1.2;
    }

    .time-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: rgba(255,255,255,0.6);
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: 12px;
        font-weight: 600;
        color: #334155;
        margin-top: 1rem;
    }

    /* Action Cards */
    .action-card {
        background: white;
        border-radius: 24px;
        padding: 1.75rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        text-decoration: none;
        color: inherit;
        border: 1px solid #e2e8f0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .action-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px -10px rgba(0, 0, 0, 0.1);
        border-color: #cbd5e1;
    }

    .action-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        transition: transform 0.3s ease;
    }

    .action-card:hover .action-icon {
        transform: scale(1.1) rotate(-5deg);
    }

    .grad-blue { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white; }
    .grad-purple { background: linear-gradient(135deg, #a855f7 0%, #9333ea 100%); color: white; }
    .grad-teal { background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); color: white; }

    .action-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.2rem;
    }

    .action-desc {
        color: #64748b;
        font-size: 0.9rem;
    }

    .arrow-icon {
        margin-left: auto;
        color: #cbd5e1;
        transition: transform 0.3s ease;
    }

    .action-card:hover .arrow-icon {
        transform: translateX(4px);
        color: #94a3b8;
    }

    /* Animation */
    .animate-up {
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="welcome-header animate-up">
        <?php 
            $hour = date('H');
            $greeting = 'Selamat Pagi';
            if($hour >= 12 && $hour < 15) $greeting = 'Selamat Siang';
            elseif($hour >= 15 && $hour < 18) $greeting = 'Selamat Sore';
            elseif($hour >= 18) $greeting = 'Selamat Malam';
        ?>
        <h1 class="welcome-title">{{ $greeting }}, <span class="welcome-name">{{ Auth::user()->name }}</span>!</h1>
        <p class="welcome-subtitle">
            <i class="fa-regular fa-calendar me-2"></i>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </p>
    </div>

    <div class="row g-4 mb-5">
        <!-- Main Status Card -->
        <div class="col-lg-5 animate-up" style="animation-delay: 0.1s;">
            <?php
                // Determine styling based on status
                $statusType = 'none';
                $statusText = 'Belum Absen';
                $statusIcon = 'fa-fingerprint';
                $statusClass = 'status-bg-none';
                $iconClass = 'icon-none';

                if($attendanceToday) {
                    $statusText = strtoupper($attendanceToday->status);
                    if($attendanceToday->status == 'hadir') {
                        $statusType = 'present';
                        $statusClass = 'status-bg-present';
                        $iconClass = 'icon-present';
                        $statusIcon = 'fa-check';
                    } elseif($attendanceToday->status == 'telat') {
                        $statusType = 'late';
                        $statusClass = 'status-bg-late';
                        $iconClass = 'icon-late';
                        $statusIcon = 'fa-clock';
                    } else { // Ijin/Sakit/Alpha
                        $statusType = 'absent'; 
                        $statusClass = 'status-bg-late'; 
                        $iconClass = 'icon-late'; 
                        $statusIcon = 'fa-circle-exclamation'; 
                    }
                }
            ?>
            <div class="status-card {{ $statusClass }}">
                <div class="status-icon-wrapper {{ $iconClass }}">
                    <i class="fa-solid {{ $statusIcon }}"></i>
                </div>
                <div>
                    <div class="status-label">Status Absensi Hari Ini</div>
                    <div class="status-value">{{ $statusText }}</div>
                    
                    @if($attendanceToday)
                        <div class="mt-3">
                            <div class="time-badge">
                                <i class="fa-solid fa-arrow-right-to-bracket text-success"></i>
                                Masuk: {{ \Carbon\Carbon::parse($attendanceToday->check_in)->format('H:i') }}
                            </div>
                            @if($attendanceToday->check_out)
                                <div class="time-badge ms-2">
                                    <i class="fa-solid fa-arrow-right-from-bracket text-danger"></i>
                                    Pulang: {{ \Carbon\Carbon::parse($attendanceToday->check_out)->format('H:i') }}
                                </div>
                            @else
                                <div class="time-badge ms-2 bg-white border-warning text-warning">
                                    <i class="fa-solid fa-hourglass-half"></i> Belum Pulang
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-muted mt-2 mb-0">Anda belum melakukan presensi masuk hari ini. Silahkan lakukan check-in.</p>
                        <div class="mt-4">
                            <a href="{{ route('karyawan.absensi.index') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                                <i class="fa-solid fa-fingerprint me-2"></i>Absen Sekarang
                            </a>
                        </div>
                    @endif
                </div>
                
                <!-- Decorative Circle -->
                <div style="position: absolute; width: 150px; height: 150px; border-radius: 50%; background: currentColor; opacity: 0.05; right: -30px; top: -30px; pointer-events: none; color: inherit;"></div>
            </div>
        </div>

        <!-- Quick Actions Grid -->
        <div class="col-lg-7">
            <div class="row g-3">
                <!-- Absensi Action -->
                <div class="col-md-6 animate-up" style="animation-delay: 0.2s;">
                    <a href="{{ route('karyawan.absensi.index') }}" class="action-card">
                        <div class="action-icon grad-blue">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                        <div>
                            <div class="action-title">Absensi</div>
                            <div class="action-desc">Check-in & Check-out harian</div>
                        </div>
                        <i class="fa-solid fa-chevron-right arrow-icon"></i>
                    </a>
                </div>

                <!-- Cuti Action -->
                <div class="col-md-6 animate-up" style="animation-delay: 0.3s;">
                    <a href="{{ route('karyawan.cuti.ajukan') }}" class="action-card">
                        <div class="action-icon grad-purple">
                            <i class="fa-solid fa-plane-departure"></i>
                        </div>
                        <div>
                            <div class="action-title">Ajukan Cuti</div>
                            <div class="action-desc">Formulir permohonan cuti</div>
                        </div>
                        <i class="fa-solid fa-chevron-right arrow-icon"></i>
                    </a>
                </div>

                <!-- Riwayat Absensi -->
                <div class="col-md-6 animate-up" style="animation-delay: 0.4s;">
                    <a href="{{ route('karyawan.absensi.riwayat') }}" class="action-card">
                        <div class="action-icon grad-teal">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                        </div>
                        <div>
                            <div class="action-title">Riwayat Absensi</div>
                            <div class="action-desc">Lihat log kehadiran Anda</div>
                        </div>
                        <i class="fa-solid fa-chevron-right arrow-icon"></i>
                    </a>
                </div>

                <!-- Riwayat Cuti -->
                 <div class="col-md-6 animate-up" style="animation-delay: 0.5s;">
                    <a href="{{ route('karyawan.cuti.riwayat') }}" class="action-card">
                        <div class="action-icon" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">
                            <i class="fa-solid fa-list-check"></i>
                        </div>
                        <div>
                            <div class="action-title">Status Cuti</div>
                            <div class="action-desc">Cek status pengajuan cuti</div>
                        </div>
                        <i class="fa-solid fa-chevron-right arrow-icon"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
