<?php ($title = 'Presensi Harian'); ?>
<?php $__env->startSection('content'); ?>

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
        grid-template-columns: repeat(2, 1fr);
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

    .status-base { background: #f1f5f9; color: #64748b; }
    .status-ontime { background: rgba(16, 185, 129, 0.1); color: #059669; }
    .status-late { background: rgba(239, 68, 68, 0.1); color: #dc2626; }
    .status-overtime { background: rgba(59, 130, 246, 0.1); color: #2563eb; }
    .status-combination { background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(59, 130, 246, 0.1)); color: #475569; }

</style>

<div class="station-container">
    <div class="absensi-card">
        <!-- Main Status Badge (Combined) -->
        <?php
            $statusText = 'BELUM ABSEN';
            $statusClass = 'status-base';
            
            if($attendance && $attendance->exists && $attendance->check_in) {
                // Use the status string directly from DB (ON TIME, LATE, LATE + OVERTIME, etc.)
                $statusText = $attendance->status;
                
                if (str_contains($statusText, 'LATE') && str_contains($statusText, 'OVERTIME')) {
                    $statusClass = 'status-combination change-text-danger'; 
                    // Custom style for combination if needed, or mapped below
                } elseif (str_contains($statusText, 'LATE')) {
                    $statusClass = 'status-late';
                } elseif (str_contains($statusText, 'OVERTIME')) {
                    // Logic: If plain Overtime (e.g. On Time + Overtime = ON TIME + OVERTIME)
                    // If we want to style differently? 
                    // Simple check:
                    $statusClass = 'status-overtime'; // Prioritize marking it as Blue
                } elseif ($statusText == 'ON TIME') {
                    $statusClass = 'status-ontime';
                }
            }
        ?>
        <div class="status-badge <?php echo e($statusClass); ?>">
            <?php echo e($statusText); ?>

        </div>

        <div class="date-display">
            <i class="fa-regular fa-calendar-days me-2"></i>
            <?php echo e(\Illuminate\Support\Carbon::parse($today)->translatedFormat('l, d F Y')); ?>

        </div>

        <div class="clock-display" id="liveClock">
            --:--:--
        </div>

        <div class="schedule-display mb-4">
            <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill me-2">
                <i class="fa-solid fa-hourglass-start me-2 text-primary"></i>Masuk: 09:00
            </span>
            <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">
                <i class="fa-solid fa-hourglass-end me-2 text-danger"></i>Pulang: 17:00
            </span>
        </div>

        <!-- Action Area -->
        <div class="action-area">
            <form action="<?php echo e(route('karyawan.absensi.checkin')); ?>" method="POST" id="formCheckIn">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-action-lg btn-checkin" <?php echo e(($attendance->exists && $attendance->check_in) ? 'disabled' : ''); ?>>
                    <i class="fa-solid fa-fingerprint"></i> Check-in
                </button>
            </form>

            <form action="<?php echo e(route('karyawan.absensi.checkout')); ?>" method="POST" id="formCheckOut">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-action-lg btn-checkout" <?php echo e((!$attendance->exists || !$attendance->check_in || $attendance->check_out) ? 'disabled' : ''); ?>>
                    <i class="fa-solid fa-person-walking-arrow-right"></i> Check-out
                </button>
            </form>
        </div>

        <?php if($attendance->exists): ?>
        <div class="stats-grid" style="grid-template-columns: repeat(3, 1fr);">
            <!-- Row 1: Times -->
            <div class="stat-item">
                <div class="stat-label">
                    <i class="fa-solid fa-arrow-right-to-bracket me-1 text-success"></i> Jam Masuk
                </div>
                <div class="stat-value">
                    <?php echo e($attendance->check_in ? \Illuminate\Support\Carbon::parse($attendance->check_in)->format('H:i') : '-'); ?>

                </div>
            </div>
            
            <div class="stat-item">
                <div class="stat-label">
                    <i class="fa-solid fa-arrow-right-from-bracket me-1 text-danger"></i> Jam Pulang
                </div>
                <div class="stat-value">
                    <?php echo e($attendance->check_out ? \Illuminate\Support\Carbon::parse($attendance->check_out)->format('H:i') : '-'); ?>

                </div>
            </div>

            <!-- Row 1: Status Masuk -->
            <div class="stat-item">
                <div class="stat-label">Status Masuk</div>
                <div class="stat-value">
                    <?php if($attendance->minutes_late > 0): ?>
                        <span class="text-danger">LATE</span>
                    <?php else: ?>
                        <span class="text-success">ON TIME</span>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Row 2: Stats -->
            <div class="stat-item">
                <div class="stat-label">
                    <i class="fa-solid fa-triangle-exclamation me-1 text-warning"></i> Telat
                </div>
                <div class="stat-value text-danger">
                    <?php echo e($attendance->minutes_late > 0 ? $attendance->minutes_late . 'm' : '-'); ?>

                </div>
            </div>

             <div class="stat-item">
                <div class="stat-label">
                    <i class="fa-solid fa-clock-rotate-left me-1 text-primary"></i> Lembur
                </div>
                <div class="stat-value text-primary">
                    <?php echo e($attendance->overtime_minutes > 0 ? $attendance->overtime_minutes . 'm' : '-'); ?>

                </div>
            </div>

            <!-- Row 2: Status Pulang -->
            <div class="stat-item">
                <div class="stat-label">Status Pulang</div>
                <div class="stat-value">
                    <?php if($attendance->check_out): ?>
                        <?php if($attendance->overtime_minutes > 0): ?>
                            <span class="text-primary">OVERTIME</span>
                        <?php else: ?>
                            <span class="text-success">NORMAL</span>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
    // Initialize with server time to ensure accuracy
    let serverTime = new Date("<?php echo e(now('Asia/Jakarta')->format('Y-m-d H:i:s')); ?>");

    function updateClock() {
        // Increment server time by 1 second
        serverTime.setSeconds(serverTime.getSeconds() + 1);
        
        const hours = String(serverTime.getHours()).padStart(2, '0');
        const minutes = String(serverTime.getMinutes()).padStart(2, '0');
        const seconds = String(serverTime.getSeconds()).padStart(2, '0');
        
        const timeString = `${hours}:${minutes}:${seconds}`;
        document.getElementById('liveClock').textContent = timeString;
    }
    
    setInterval(updateClock, 1000);
    updateClock();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.karyawan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Absensi_Karyawan\resources\views/karyawan/absensi/index.blade.php ENDPATH**/ ?>