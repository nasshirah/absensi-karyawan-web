@extends('layouts.karyawan')
@php($title = 'Presensi Harian')
@section('content')

<style>
    .station-container {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
    }

    .absensi-card {
        background: white;
        border-radius: 30px;
        padding: 3rem 2rem;
        box-shadow: 0 20px 60px -10px rgba(0, 0, 0, 0.1);
        text-align: center;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

    .absensi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #0ea5e9, #a855f7);
    }

    .date-display {
        background: #f8fafc;
        display: inline-block;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        color: #475569;
        margin-bottom: 2rem;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.03);
    }

    .clock-display {
        font-size: 4rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 2.5rem;
        letter-spacing: -2px;
        font-variant-numeric: tabular-nums;
        text-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .action-area {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .btn-action-lg {
        padding: 1.5rem 3rem;
        border-radius: 24px;
        border: none;
        font-size: 1.25rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        align-items: center;
        gap: 1rem;
        min-width: 220px;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .btn-action-lg:disabled {
        background: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
        transform: none !important;
        box-shadow: none !important;
    }

    .btn-checkin {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 10px 25px -5px rgba(16, 185, 129, 0.4);
    }

    .btn-checkin:hover:not(:disabled) {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 20px 35px -5px rgba(16, 185, 129, 0.5);
    }

    .btn-checkout {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.4);
    }

    .btn-checkout:hover:not(:disabled) {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 20px 35px -5px rgba(239, 68, 68, 0.5);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-top: 2rem;
        border-top: 1px solid #f1f5f9;
        padding-top: 2rem;
    }

    .stat-item {
        background: #f8fafc;
        padding: 1rem;
        border-radius: 16px;
    }

    .stat-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #64748b;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
    }
    
    .status-badge {
        position: absolute;
        top: 2rem;
        right: 2rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.8rem;
    }

    .status-present { background: rgba(16, 185, 129, 0.1); color: #059669; }
    .status-late { background: rgba(239, 68, 68, 0.1); color: #dc2626; }
    .status-none { background: rgba(148, 163, 184, 0.1); color: #64748b; }

</style>

<div class="station-container">
    <div class="absensi-card">
        <!-- Status Badge -->
        <?php
            $statusClass = 'status-none';
            $statusText = 'BELUM ABSEN';
            
            if($attendance && $attendance->exists && $attendance->check_in) {
                $statusText = $attendance->status;
                if($attendance->status == 'hadir') {
                    $statusClass = 'status-present';
                } elseif($attendance->status == 'telat') {
                    $statusClass = 'status-late';
                }
            }
        ?>
        <div class="status-badge {{ $statusClass }}">
            {{ strtoupper($statusText) }}
        </div>

        <div class="date-display">
            <i class="fa-regular fa-calendar-days me-2"></i>
            {{ \Illuminate\Support\Carbon::parse($today)->translatedFormat('l, d F Y') }}
        </div>

        <div class="clock-display" id="liveClock">
            --:--:--
        </div>

        <!-- Action Area -->
        <div class="action-area">
            <form action="{{ route('karyawan.absensi.checkin') }}" method="POST">
                @csrf
                <button type="submit" class="btn-action-lg btn-checkin" {{ ($attendance->exists && $attendance->check_in) ? 'disabled' : '' }}>
                    <i class="fa-solid fa-fingerprint"></i> Check-in
                </button>
            </form>

            <form action="{{ route('karyawan.absensi.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-action-lg btn-checkout" {{ (!$attendance->exists || !$attendance->check_in || $attendance->check_out) ? 'disabled' : '' }}>
                    <i class="fa-solid fa-person-walking-arrow-right"></i> Check-out
                </button>
            </form>
        </div>

        @if ($attendance->exists)
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-label">
                    <i class="fa-solid fa-arrow-right-to-bracket me-1 text-success"></i> Jam Masuk
                </div>
                <div class="stat-value">
                    {{ $attendance->check_in ? \Illuminate\Support\Carbon::parse($attendance->check_in)->format('H:i') : '-' }}
                </div>
            </div>
            
            <div class="stat-item">
                <div class="stat-label">
                    <i class="fa-solid fa-arrow-right-from-bracket me-1 text-danger"></i> Jam Pulang
                </div>
                <div class="stat-value">
                    {{ $attendance->check_out ? \Illuminate\Support\Carbon::parse($attendance->check_out)->format('H:i') : '-' }}
                </div>
            </div>

            <div class="stat-item">
                <div class="stat-label">
                    <i class="fa-solid fa-triangle-exclamation me-1 text-warning"></i> Keterlambatan
                </div>
                <div class="stat-value text-danger">
                    {{ $attendance->minutes_late > 0 ? $attendance->minutes_late . ' Menit' : 'Tepat Waktu' }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', { 
            hour12: false, 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit' 
        });
        document.getElementById('liveClock').textContent = timeString;
    }
    
    setInterval(updateClock, 1000);
    updateClock();
</script>
@endsection
