<?php $__env->startSection('title', 'Data Absensi'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .premium-container { max-width: 1400px; margin: 0 auto; }
    
    /* Header Styles */
    .page-header { margin-bottom: 2rem; position: relative; }
    .page-title { 
        font-weight: 800; font-size: 1.75rem; color: #1e293b; letter-spacing: -0.5px;
        background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    }
    .page-subtitle { color: #64748b; font-size: 0.95rem; margin-top: 0.25rem; }

    /* Filter Styles */
    .filter-bar { background: white; padding: 0.75rem; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
    .form-control-premium, .form-select-premium {
        border: 2px solid #f1f5f9; border-radius: 12px; padding: 0.6rem 1rem; font-size: 0.9rem; transition: all 0.3s;
    }
    .form-control-premium:focus, .form-select-premium:focus {
        border-color: #A04ACF; box-shadow: 0 0 0 4px rgba(160, 74, 207, 0.1); outline: none;
    }

    /* Card/Table Styles */
    .table-container { background: transparent; }
    
    .data-card {
        background: white; border-radius: 18px; padding: 1.25rem; margin-bottom: 0.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        display: flex; align-items: center; position: relative; overflow: hidden;
    }
    
    .data-card::before {
        content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
        background: #cbd5e1; opacity: 1; transition: all 0.3s ease;
    }
    
    .data-card:hover {
        transform: translateY(-4px) scale(1.005);
        box-shadow: 0 20px 40px -6px rgba(0, 0, 0, 0.08);
        z-index: 10; border-color: transparent;
    }

    /* Status Colors for Sidebar */
    .data-card.status-late::before { background: #ef4444; }
    .data-card.status-ontime::before { background: #22c55e; }
    .data-card.status-overtime::before { background: #3b82f6; }

    /* Avatar Styles */
    .avatar-wrapper { position: relative; margin-right: 1.5rem; }
    .avatar-premium {
        width: 52px; height: 52px; border-radius: 14px;
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        color: #0ea5e9; display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 1.2rem; box-shadow: 0 4px 10px rgba(14, 165, 233, 0.15);
        border: 2px solid white;
    }

    /* Content Grid */
    .card-info {
        display: grid;
        grid-template-columns: 80px 2.5fr 1.5fr 1fr 1fr 1fr 60px; /* Proportional grid */
        width: 100%; align-items: center; gap: 1rem;
    }

    .info-group { display: flex; flex-direction: column; }
    .info-label {
        font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8;
        margin-bottom: 0.25rem; font-weight: 700;
    }
    .info-value { font-weight: 600; color: #334155; font-size: 0.95rem; }
    
    .date-box {
        background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;
        padding: 6px; text-align: center; width: 60px;
    }
    .date-box .day { font-size: 1.2rem; font-weight: 800; color: #0f172a; line-height: 1; }
    .date-box .month { font-size: 0.7rem; color: #64748b; font-weight: 600; text-transform: uppercase; }

    /* Badges */
    .badge-premium {
        padding: 0.35rem 0.85rem; border-radius: 50px; font-size: 0.75rem;
        font-weight: 600; letter-spacing: 0.02em; display: inline-flex; align-items: center; gap: 0.4rem;
    }
    .badge-late { background: #fee2e2; color: #ef4444; border: 1px solid #fecaca; }
    .badge-ontime { background: #dcfce7; color: #16a34a; border: 1px solid #bbf7d0; }
    .badge-overtime { background: #dbeafe; color: #2563eb; border: 1px solid #bfdbfe; }

    /* Action Button */
    .action-btn {
        width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center;
        transition: all 0.2s ease; border: none; background: transparent; color: #94a3b8;
    }
    .action-btn:hover { background: #fee2e2; color: #ef4444; transform: scale(1.1); }

    .animate-entry { animation: slideUpFade 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards; opacity: 0; }
    @keyframes slideUpFade { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
</style>

<div class="premium-container">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
        <div class="page-header mb-0">
            <h1 class="page-title">Data Absensi</h1>
            <p class="page-subtitle">Riwayat kehadiran karyawan per periode</p>
        </div>
        
        <!-- Filter Bar -->
        <form method="GET" action="<?php echo e(route('admin.absensi.index')); ?>" class="filter-bar d-flex gap-2 align-items-center">
            <input type="text" name="q" class="form-control-premium" placeholder="Cari nama karyawan..." value="<?php echo e($q ?? ''); ?>" style="width: 250px;">
            
            <select name="month" class="form-select-premium" style="width: 140px;">
                <?php for($m = 1; $m <= 12; $m++): ?>
                    <option value="<?php echo e($m); ?>" <?php if((int)$m === (int)$month): echo 'selected'; endif; ?>>
                        <?php echo e(\Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM')); ?>

                    </option>
                <?php endfor; ?>
            </select>

            <select name="year" class="form-select-premium" style="width: 100px;">
                <?php for($y = date('Y') - 2; $y <= date('Y') + 1; $y++): ?>
                    <option value="<?php echo e($y); ?>" <?php if((int)$y === (int)$year): echo 'selected'; endif; ?>><?php echo e($y); ?></option>
                <?php endfor; ?>
            </select>

            <button type="submit" class="btn btn-dark px-4" style="border-radius: 12px; font-weight: 600;">
                <i class="fa-solid fa-filter me-1"></i> Filter
            </button>
            
            <div class="dropdown">
                <button class="btn btn-light border px-3" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 12px; font-weight: 600;">
                    <i class="fa-solid fa-download me-1"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" style="border-radius: 12px;">
                    <li><a class="dropdown-item px-3 py-2" href="<?php echo e(route('admin.absensi.export.excel', request()->all())); ?>"><i class="fa-regular fa-file-excel text-success me-2"></i>Excel</a></li>
                    <li><a class="dropdown-item px-3 py-2" href="<?php echo e(route('admin.absensi.export.pdf', request()->all())); ?>"><i class="fa-regular fa-file-pdf text-danger me-2"></i>PDF</a></li>
                </ul>
            </div>
        </form>
    </div>

    <!-- Data List -->
    <div class="table-container">
        <!-- Floating Header -->
        <div class="d-none d-lg-grid px-4 py-2 mb-2" 
             style="grid-template-columns: 80px 2.5fr 1.5fr 1fr 1fr 1fr 60px; gap: 1rem; color: #94a3b8; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
            <div class="text-center">Tanggal</div>
            <div>Karyawan</div>
            <div>Status</div>
            <div>Masuk</div>
            <div>Pulang</div>
            <div>Telat</div>
            <div class="text-end">Aksi</div>
        </div>

        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $status = strtolower($row->status);
                $statusClass = match ($status) {
                    'late' => 'status-late',
                    'present', 'on time' => 'status-ontime',
                    'overtime' => 'status-overtime',
                    default => ''
                };
                
                $badgeClass = match ($status) {
                    'late' => 'badge-late',
                    'present', 'on time' => 'badge-ontime',
                    'overtime' => 'badge-overtime',
                    default => 'badge-premium' // fallback
                };
                
                $icon = match ($status) {
                    'late' => 'fa-clock',
                    'present', 'on time' => 'fa-check',
                    'overtime' => 'fa-briefcase',
                    default => 'fa-circle'
                };
            ?>

            <div class="data-card <?php echo e($statusClass); ?> animate-entry" style="animation-delay: <?php echo e($index * 0.05); ?>s;">
                <div class="card-info">
                    
                    <!-- Tanggal -->
                    <div class="d-flex justify-content-center">
                        <div class="date-box">
                            <div class="day"><?php echo e(\Carbon\Carbon::parse($row->date)->format('d')); ?></div>
                            <div class="month"><?php echo e(\Carbon\Carbon::parse($row->date)->format('M')); ?></div>
                        </div>
                    </div>

                    <!-- Karyawan -->
                    <div class="d-flex align-items-center">
                        <div class="avatar-premium me-3" style="width: 40px; height: 40px; font-size: 1rem;">
                            <?php echo e(substr($row->user->name, 0, 1)); ?>

                        </div>
                        <div>
                            <div class="main-text" style="font-weight: 700; color: #1e293b;"><?php echo e($row->user->name); ?></div>
                            <div class="sub-text" style="font-size: 0.8rem; color: #64748b;"><?php echo e($row->user->division ?? 'Staff'); ?></div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <div class="badge-premium <?php echo e($badgeClass); ?>">
                            <i class="fa-solid <?php echo e($icon); ?>"></i>
                            <?php echo e(ucfirst($row->status)); ?>

                        </div>
                    </div>

                    <!-- Masuk -->
                    <div class="info-group">
                        <span class="info-value font-monospace"><?php echo e($row->check_in ? \Carbon\Carbon::parse($row->check_in)->format('H:i') : '-'); ?></span>
                    </div>

                    <!-- Pulang -->
                    <div class="info-group">
                        <span class="info-value font-monospace"><?php echo e($row->check_out ? \Carbon\Carbon::parse($row->check_out)->format('H:i') : '-'); ?></span>
                    </div>

                    <!-- Telat -->
                    <div class="info-group">
                        <?php if($row->minutes_late > 0): ?>
                            <span class="text-danger fw-bold"><?php echo e($row->minutes_late); ?>m</span>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </div>

                    <!-- Aksi -->
                    <div class="text-end">
                        <form action="<?php echo e(route('admin.absensi.destroy', $row->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="action-btn" title="Hapus Data">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-5 text-muted">
                <i class="fa-solid fa-clipboard-list fa-3x mb-3 text-light-emphasis"></i>
                <p>Tidak ada data absensi untuk periode ini</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        <?php echo e($items->appends(request()->query())->links()); ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.metronic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Absensi_Karyawan\resources\views/admin/absensi/index.blade.php ENDPATH**/ ?>