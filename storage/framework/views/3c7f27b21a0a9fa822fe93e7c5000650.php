<?php ($title = 'Data Karyawan'); ?>
<?php $__env->startSection('content'); ?>

<style>
    .premium-container {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* Header Styles */
    .page-header {
        margin-bottom: 2rem;
        position: relative;
    }
    
    .page-title {
        font-weight: 800;
        font-size: 1.75rem;
        color: #1e293b;
        letter-spacing: -0.5px;
        background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 0.95rem;
        margin-top: 0.25rem;
    }

    /* Search & Filter Styles */
    .search-container {
        position: relative;
        transition: all 0.3s ease;
    }
    
    .search-input {
        background: white;
        border: 2px solid #f1f5f9;
        border-radius: 16px;
        padding: 0.75rem 1rem 0.75rem 3rem;
        font-size: 0.95rem;
        width: 300px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(148, 163, 184, 0.05);
    }
    
    .search-input:focus {
        border-color: #A04ACF;
        box-shadow: 0 4px 20px rgba(160, 74, 207, 0.15);
        outline: none;
        width: 340px;
    }
    
    .search-icon {
        position: absolute;
        left: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .search-input:focus ~ .search-icon {
        color: #A04ACF;
    }

    /* Premium Button Styles */
    .btn-premium {
        border: none;
        padding: 0.75rem 1.75rem;
        border-radius: 14px;
        font-weight: 600;
        letter-spacing: 0.3px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.95rem;
        position: relative;
        overflow: hidden;
    }

    .btn-primary-gradient {
        background: linear-gradient(135deg, #A04ACF 0%, #8739B0 100%);
        color: white;
        box-shadow: 0 8px 16px rgba(160, 74, 207, 0.2);
    }

    .btn-primary-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(160, 74, 207, 0.3);
        color: white;
    }

    .btn-primary-gradient:active {
        transform: translateY(1px);
    }

    .btn-glass {
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(226, 232, 240, 0.8);
        color: #64748b;
        backdrop-filter: blur(8px);
    }

    .btn-glass:hover {
        background: white;
        border-color: #cbd5e1;
        color: #334155;
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(148, 163, 184, 0.1);
    }

    /* Card/Table Styles */
    .table-container {
        background: transparent;
    }
    
    .data-card {
        background: white;
        border-radius: 18px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    
    .data-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, #A04ACF, #C3398D);
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .data-card:hover {
        transform: translateY(-4px) scale(1.005);
        box-shadow: 0 20px 40px -6px rgba(0, 0, 0, 0.08); /* Premium shadow */
        z-index: 10;
        border-color: transparent;
    }

    .data-card:hover::before {
        opacity: 1;
    }

    /* Avatar Styles */
    .avatar-wrapper {
        position: relative;
        margin-right: 1.5rem;
    }
    
    .avatar-premium {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        color: #0ea5e9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
        box-shadow: 0 4px 10px rgba(14, 165, 233, 0.15);
        position: relative;
        z-index: 1;
        border: 2px solid white;
    }

    .avatar-wrapper::after {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 18px;
        background: linear-gradient(135deg, #e0f2fe, white);
        z-index: 0;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .data-card:hover .avatar-wrapper::after {
        opacity: 1;
    }

    /* Content Grid */
    .card-info {
        display: grid;
        grid-template-columns: 2fr 1.5fr 1.2fr 1.2fr 1.2fr auto;
        width: 100%;
        align-items: center;
        gap: 1.5rem;
    }

    .info-group {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
        margin-bottom: 0.25rem;
        font-weight: 600;
    }

    .info-value {
        font-weight: 600;
        color: #334155;
        font-size: 0.95rem;
    }

    .main-text {
        color: #1e293b;
        font-weight: 700;
        font-size: 1rem;
    }
    
    .sub-text {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 500;
    }

    /* Badge Styles */
    .premium-badge {
        padding: 0.35rem 0.85rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.02em;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .badge-purple {
        background: rgba(160, 74, 207, 0.1);
        color: #A04ACF;
        border: 1px solid rgba(160, 74, 207, 0.2);
    }

    .badge-blue {
        background: rgba(14, 165, 233, 0.1);
        color: #0284c7;
        border: 1px solid rgba(14, 165, 233, 0.2);
    }
    
    /* Action Buttons */
    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        border: none;
        background: transparent;
        color: #94a3b8;
    }

    .action-btn:hover {
        background: #f1f5f9;
        color: #475569;
        transform: scale(1.1);
    }

    .action-btn.edit:hover {
        background: #fff7ed;
        color: #ea580c;
    }

    .action-btn.delete:hover {
        background: #fef2f2;
        color: #ef4444;
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        border-top: 1px solid rgba(226, 232, 240, 0.6);
    }

    /* Animation */
    @keyframes slideUpFade {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-entry {
        animation: slideUpFade 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
    }

    <?php for($i = 1; $i <= 10; $i++): ?>
        .delay-<?php echo e($i); ?> { animation-delay: <?php echo e($i * 100); ?>ms; }
    <?php endfor; ?>
</style>

<div class="premium-container">
    <!-- Header Section -->
    <div class="d-flex flex-wrap justify-content-between align-items-end mb-5">
        <div class="page-header mb-0">
            <h1 class="page-title">Data Karyawan</h1>
            <p class="page-subtitle">Kelola informasi dan data lengkap karyawan</p>
        </div>
        
        <div class="d-flex gap-2 align-items-center">
            <form action="<?php echo e(route('admin.karyawan.index')); ?>" method="GET" class="search-container">
                <input type="text" class="form-control search-input" placeholder="Cari nama atau email..." name="q" value="<?php echo e($q); ?>" autocomplete="off">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
            </form>
            
            <div class="dropdown">
                <button class="btn btn-premium btn-glass dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-file-export"></i>
                    <span>Export</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg" aria-labelledby="exportDropdown" style="border-radius: 12px; padding: 0.5rem;">
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="<?php echo e(route('admin.karyawan.export.excel', ['q' => $q])); ?>" style="border-radius: 8px;">
                            <i class="fa-regular fa-file-excel text-success"></i>
                            Excel (.xlsx)
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="<?php echo e(route('admin.karyawan.export.pdf', ['q' => $q])); ?>" style="border-radius: 8px;">
                            <i class="fa-regular fa-file-pdf text-danger"></i>
                            PDF (.pdf)
                        </a>
                    </li>
                </ul>
            </div>

            <a href="<?php echo e(route('admin.karyawan.create')); ?>" class="btn btn-premium btn-primary-gradient">
                <i class="fa-solid fa-plus-circle"></i>
                <span>Tambah Karyawan</span>
            </a>
        </div>
    </div>

    <!-- Data List -->
    <div class="table-container">
        <!-- Header Row (Visual Only) -->
        <div class="d-none d-lg-grid px-4 py-2 mb-2" style="grid-template-columns: 80px 2fr 1.5fr 1.2fr 1.2fr 1.2fr 100px; gap: 1.5rem; color: #94a3b8; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">
            <div></div>
            <div>Profil</div>
            <div>Kontak</div>
            <div>Divisi</div>
            <div>Jabatan</div>
            <div>Bergabung</div>
            <div class="text-end">Aksi</div>
        </div>

        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="data-card animate-entry delay-<?php echo e($index + 1); ?>" style="animation-delay: <?php echo e(($index + 1) * 0.1); ?>s">
                <div class="d-flex w-100 align-items-center">
                    <!-- Avatar section -->
                    <div class="avatar-wrapper flex-shrink-0">
                        <div class="avatar-premium">
                            <?php echo e(strtoupper(substr($u->name, 0, 1))); ?>

                        </div>
                    </div>

                    <!-- Info Grid -->
                    <div class="card-info flex-grow-1">
                        <!-- Name & ID -->
                        <div class="info-group">
                            <div class="main-text"><?php echo e($u->name); ?></div>
                            <div class="sub-text">ID: #<?php echo e(str_pad($u->id, 4, '0', STR_PAD_LEFT)); ?></div>
                        </div>

                        <!-- Email -->
                        <div class="info-group">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-regular fa-envelope text-muted" style="font-size: 0.8rem;"></i>
                                <span class="info-value" style="font-weight: 500;"><?php echo e($u->email); ?></span>
                            </div>
                        </div>

                        <!-- Division -->
                        <div class="info-group">
                            <?php if($u->division): ?>
                            <div class="premium-badge badge-purple">
                                <i class="fa-solid fa-layer-group" style="font-size: 0.7rem;"></i>
                                <?php echo e($u->division); ?>

                            </div>
                            <?php else: ?>
                            <span class="text-muted text-sm">-</span>
                            <?php endif; ?>
                        </div>

                        <!-- Position -->
                        <div class="info-group">
                            <?php if($u->position): ?>
                            <div class="premium-badge badge-blue">
                                <i class="fa-solid fa-briefcase" style="font-size: 0.7rem;"></i>
                                <?php echo e($u->position); ?>

                            </div>
                            <?php else: ?>
                            <span class="text-muted text-sm">-</span>
                            <?php endif; ?>
                        </div>

                        <!-- Join Date -->
                        <div class="info-group">
                            <?php if($u->join_date): ?>
                            <div class="info-value"><?php echo e(\Illuminate\Support\Carbon::parse($u->join_date)->format('d M Y')); ?></div>
                            <div class="text-xs text-muted" style="font-size: 0.75rem;"><?php echo e(\Illuminate\Support\Carbon::parse($u->join_date)->diffForHumans()); ?></div>
                            <?php else: ?>
                            <span class="text-muted">-</span>
                            <?php endif; ?>
                        </div>

                        <!-- Actions -->
                        <div class="d-flex justify-content-end gap-1">
                            <a href="<?php echo e(route('admin.karyawan.edit', $u)); ?>" class="action-btn edit" title="Edit Data">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            
                            <form action="<?php echo e(route('admin.karyawan.destroy', $u)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Apakah anda yakin ingin menghapus data <?php echo e($u->name); ?>?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="action-btn delete" title="Hapus Karyawan">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-5 animate-entry">
                <div class="mb-3">
                    <div style="width: 80px; height: 80px; background: #f1f5f9; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 2rem;">
                        <i class="fa-solid fa-users-slash"></i>
                    </div>
                </div>
                <h5 class="text-muted fw-bold">Tidak ada data karyawan</h5>
                <p class="text-muted small">Coba ubah kata kunci pencarian atau tambah karyawan baru.</p>
                <a href="<?php echo e(route('admin.karyawan.index')); ?>" class="btn btn-sm btn-link text-decoration-none">Reset Pencarian</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        <div class="text-muted small">
            Menampilkan <span class="fw-bold text-dark"><?php echo e($users->firstItem() ?? 0); ?></span> sampai <span class="fw-bold text-dark"><?php echo e($users->lastItem() ?? 0); ?></span> dari <span class="fw-bold text-dark"><?php echo e($users->total()); ?></span> total data
        </div>
        <div>
            <?php echo e($users->appends(['q' => $q])->links()); ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.metronic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Absensi_Karyawan\resources\views/admin/karyawan/index.blade.php ENDPATH**/ ?>