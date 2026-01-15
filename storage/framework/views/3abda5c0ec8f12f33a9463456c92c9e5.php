<?php $__env->startSection('title', 'Data Cuti'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .premium-container {
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
    }

    .premium-container::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(160, 74, 207, 0.15) 0%, rgba(0,0,0,0) 70%);
        z-index: -1;
        pointer-events: none;
    }

    .page-header {
        margin-bottom: 2.5rem;
    }

    .page-title {
        font-weight: 800;
        font-size: 2rem;
        background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: .5rem;
        position: relative;
        display: inline-block;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #A04ACF, #C3398D);
        border-radius: 4px;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 1rem;
        font-weight: 500;
    }

    .filter-bar {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 1rem 1.5rem;
        display: inline-flex;
        gap: 1.25rem;
        align-items: center;
        margin-bottom: 2.5rem;
    }

    .data-card {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        padding: 1.5rem 2rem;
        margin-bottom: 1rem;
        position: relative;
        display: flex;
        align-items: center;
    }

    .status-indicator {
        width: 6px;
        height: 60%;
        border-radius: 10px;
        position: absolute;
        left: 0;
        top: 20%;
    }

    .card-grid {
        display: grid;
        grid-template-columns: 2fr 130px 1.8fr 1.2fr 120px 1.5fr 1.5fr 100px;
        width: 100%;
        gap: 1.5rem;
        align-items: center;
    }

    .badge-status {
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-transform: uppercase;
    }

    .status-approved { background: #dcfce7; color: #166534; }
    .status-rejected { background: #fee2e2; color: #991b1b; }
    .status-pending  { background: #fef3c7; color: #92400e; }
</style>

<div class="premium-container">

    <div class="page-header">
        <h1 class="page-title">Riwayat Cuti</h1>
        <p class="page-subtitle">Daftar riwayat permintaan cuti karyawan</p>
    </div>

    <!-- FILTER -->
    <form method="GET" action="<?php echo e(route('admin.cuti.index')); ?>" class="filter-bar">
        <label class="mb-0 fw-bold text-muted">Status</label>
        <select name="status" class="form-select">
            <option value="">Semua</option>
            <?php $__currentLoopData = ['pending' => 'Pending', 'approved' => 'Disetujui', 'rejected' => 'Ditolak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($val); ?>" <?php echo e(request('status') === $val ? 'selected' : ''); ?>>
                    <?php echo e($label); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button class="btn btn-dark" type="submit">
            <i class="fa-solid fa-filter me-2"></i>Filter
        </button>

        <div class="dropdown ms-auto">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-file-export me-1"></i> Export
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="exportDropdown" style="border-radius: 12px;">
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="<?php echo e(route('admin.cuti.export.excel', ['status' => request('status')])); ?>">
                        <i class="fa-regular fa-file-excel text-success"></i>
                        Excel (.xlsx)
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="<?php echo e(route('admin.cuti.export.pdf', ['status' => request('status')])); ?>">
                        <i class="fa-regular fa-file-pdf text-danger"></i>
                        PDF (.pdf)
                    </a>
                </li>
            </ul>
        </div>
    </form>

    <!-- DATA -->
    <div class="d-flex flex-column gap-2">
        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

            <?php
                $status = strtolower($leave->status);

                $statusClass = match ($status) {
                    'approved' => 'status-approved',
                    'rejected' => 'status-rejected',
                    default => 'status-pending',
                };

                $borderColor = match ($status) {
                    'approved' => '#22c55e',
                    'rejected' => '#ef4444',
                    default => '#f59e0b',
                };
            ?>

            <div class="data-card">
                <div class="status-indicator" style="background-color: <?php echo e($borderColor); ?>;"></div>

                <div class="card-grid">
                    <!-- Karyawan -->
                    <div>
                        <strong><?php echo e($leave->user->name); ?></strong><br>
                        <small class="text-muted"><?php echo e($leave->user->division ?? '-'); ?></small>
                    </div>

                    <!-- Jenis -->
                    <div><?php echo e(ucfirst($leave->type)); ?></div>

                    <!-- Periode -->
                    <div>
                        <?php echo e($leave->start_date->format('d M Y')); ?><br>
                        <small class="text-muted">s/d <?php echo e($leave->end_date->format('d M Y')); ?></small>
                    </div>

                    <!-- DURASI + SISA CUTI -->
                    <div>
                        <div class="fw-bold"><?php echo e($leave->days); ?> hari</div>
                        <small>
                            Sisa:
                            <?php if($leave->sisa_cuti <= 0): ?>
                                <span class="text-danger fw-bold">Habis</span>
                            <?php elseif($leave->sisa_cuti < $leave->days): ?>
                                <span class="text-warning fw-bold">
                                    <?php echo e($leave->sisa_cuti); ?> hari
                                </span>
                            <?php else: ?>
                                <span class="text-success fw-bold">
                                    <?php echo e($leave->sisa_cuti); ?> hari
                                </span>
                            <?php endif; ?>
                        </small>
                    </div>

                    <!-- Status -->
                    <div>
                        <span class="badge-status <?php echo e($statusClass); ?>">
                            <?php echo e(ucfirst($leave->status)); ?>

                        </span>
                    </div>

                    <!-- Reviewer -->
                    <div><?php echo e(optional($leave->reviewer)->name ?? '-'); ?></div>

                    <!-- Catatan -->
                    <div class="text-muted small">
                        <?php echo e($leave->reviewed_reason ?? '-'); ?>

                    </div>

                    <!-- Aksi -->
                    <div class="text-center d-flex gap-2 justify-content-center">
                        <?php if($leave->status === 'pending'): ?>
                            <a href="<?php echo e(route('admin.cuti.review', $leave)); ?>"
                               class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>
                        <?php endif; ?>
                        
                        <form action="<?php echo e(route('admin.cuti.destroy', $leave)); ?>" method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data cuti ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-5 text-muted">
                Tidak ada data cuti
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-4">
        <?php echo e($items->appends(request()->query())->links()); ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.metronic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Absensi_Karyawan\resources\views/admin/cuti/index.blade.php ENDPATH**/ ?>