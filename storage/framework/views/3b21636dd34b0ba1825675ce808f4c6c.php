<?php ($title = 'Review Cuti'); ?>
<?php $__env->startSection('content'); ?>

<style>
    .review-container {
        max-width: 900px;
        margin: 0 auto;
        animation: fadeIn 0.6s ease-out forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .review-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
        padding: 0;
        overflow: hidden;
        position: relative;
    }

    /* Decorative Header */
    .card-header-bg {
        background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
        padding: 3rem 2.5rem;
        position: relative;
        overflow: hidden;
    }

    .card-header-bg::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(160, 74, 207, 0.4) 0%, rgba(0,0,0,0) 70%);
        border-radius: 50%;
        opacity: 0.6;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        position: relative;
        z-index: 10;
    }

    .avatar-lg {
        width: 80px;
        height: 80px;
        background: white;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .user-details h2 {
        color: white;
        margin: 0;
        font-size: 1.75rem;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .user-details p {
        color: rgba(255, 255, 255, 0.7);
        margin: 0.25rem 0 0 0;
        font-size: 1rem;
    }

    /* Content Area */
    .card-content {
        padding: 2.5rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin-bottom: 2.5rem;
    }

    .info-item label {
        display: block;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #94a3b8;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .info-value {
        font-size: 1.1rem;
        color: #334155;
        font-weight: 600;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    /* Action Area */
    .action-area {
        background: #f8fafc;
        padding: 2rem 2.5rem;
        border-top: 1px solid #e2e8f0;
    }

    .action-form {
        max-width: 100%;
    }

    .reason-box {
        margin-bottom: 2rem;
    }

    .reason-textarea {
        width: 100%;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        padding: 1rem;
        font-size: 1rem;
        resize: vertical;
        transition: all 0.3s ease;
        background: white;
    }

    .reason-textarea:focus {
        border-color: #A04ACF;
        box-shadow: 0 0 0 4px rgba(160, 74, 207, 0.1);
        outline: none;
    }

    .btn-group-custom {
        display: flex;
        gap: 1rem;
    }

    .btn-custom {
        flex: 1;
        padding: 1rem;
        border-radius: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border: none;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        font-size: 0.95rem;
        cursor: pointer;
    }

    .btn-approve {
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
    }

    .btn-approve:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(34, 197, 94, 0.4);
    }

    .btn-reject {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-reject:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.4);
    }

    .btn-back {
        background: white;
        border: 2px solid #e2e8f0;
        color: #64748b;
        width: auto;
        padding: 0 1.5rem;
    }

    .btn-back:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
        color: #334155;
    }
</style>

<div class="review-container">
    <div class="review-card">
        <!-- Header -->
        <div class="card-header-bg">
            <div class="user-profile">
                <div class="avatar-lg">
                    <?php echo e(strtoupper(substr($leave->user->name ?? '?', 0, 1))); ?>

                </div>
                <div class="user-details">
                    <h2><?php echo e($leave->user->name); ?></h2>
                    <p><?php echo e($leave->user->division ?? 'Karyawan'); ?> &bull; Pengajuan Cuti</p>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="card-content">
            <div class="info-grid">
                <div class="info-item">
                    <label>Jenis Cuti</label>
                    <div class="info-value">
                        <i class="fa-solid fa-tag me-2 text-muted"></i>
                        <?php echo e(ucfirst($leave->type)); ?>

                    </div>
                </div>
                <div class="info-item">
                    <label>Status Saat Ini</label>
                    <div>
                        <span class="status-badge" style="background: rgba(245, 158, 11, 0.1); color: #d97706; border: 1px solid rgba(245, 158, 11, 0.2);">
                            <i class="fa-solid fa-clock"></i> <?php echo e(ucfirst($leave->status)); ?>

                        </span>
                    </div>
                </div>
                <div class="info-item">
                    <label>Periode Cuti</label>
                    <div class="info-value">
                        <i class="fa-solid fa-calendar-days me-2 text-muted"></i>
                        <?php echo e($leave->start_date->format('d M Y')); ?> - <?php echo e($leave->end_date->format('d M Y')); ?>

                    </div>
                </div>
                <div class="info-item">
                    <label>Durasi</label>
                    <div class="info-value">
                        <i class="fa-solid fa-hourglass-half me-2 text-muted"></i>
                        <?php echo e($leave->days); ?> Hari
                    </div>
                </div>
                <div class="info-item" style="grid-column: span 2;">
                    <label>Alasan Pengajuan</label>
                    <div class="info-value" style="font-style: italic; color: #475569;">
                        "<?php echo e($leave->reason); ?>"
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Area -->
        <div class="action-area">
            <form action="<?php echo e(route('admin.cuti.process', $leave)); ?>" method="POST" class="action-form">
                <?php echo csrf_field(); ?>
                <div class="reason-box">
                    <label class="info-item mb-2 d-block"><strong style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: #64748b;">Catatan Reviewer</strong> <span class="text-muted fw-normal" style="font-size: 0.8rem; text-transform: none;">(Opsional)</span></label>
                    <textarea name="reviewed_reason" class="reason-textarea" rows="3" placeholder="Tuliskan alasan persetujuan atau penolakan..."></textarea>
                </div>

                <div class="btn-group-custom">
                    <a href="<?php echo e(route('admin.cuti.index')); ?>" class="btn-custom btn-back">
                        <i class="fa-solid fa-arrow-left"></i> Kembali
                    </a>
                    
                    <?php if($leave->status == 'pending'): ?>
                    <button type="submit" name="action" value="approve" class="btn-custom btn-approve">
                        <i class="fa-solid fa-check-circle"></i> Setujui
                    </button>
                    <button type="submit" name="action" value="reject" class="btn-custom btn-reject">
                        <i class="fa-solid fa-times-circle"></i> Tolak
                    </button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.metronic', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Absensi_Karyawan\resources\views/admin/cuti/review.blade.php ENDPATH**/ ?>