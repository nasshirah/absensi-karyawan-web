@extends('layouts.karyawan')
@php($title = 'Riwayat Cuti')
@section('content')

<style>
    .history-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    .btn-create {
        background: linear-gradient(135deg, #A04ACF 0%, #6B2C8E 100%);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(160, 74, 207, 0.3);
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(160, 74, 207, 0.4);
        color: white;
    }

    .history-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        border: 1px solid rgba(0,0,0,0.05);
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .history-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px -5px rgba(0,0,0,0.08);
    }

    .status-border {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 5px;
    }

    .grid-layout {
        display: grid;
        grid-template-columns: 1fr 1.5fr 1fr 1fr 1.5fr;
        gap: 1.5rem;
        align-items: center;
    }

    @media (max-width: 992px) {
        .grid-layout {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
    }

    .data-group label {
        display: block;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .data-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #334155;
    }

    .type-badge {
        display: inline-block;
        padding: 0.35rem 0.85rem;
        background: #f1f5f9;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #475569;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 0.85rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-approved { background: rgba(34, 197, 94, 0.1); color: #16a34a; }
    .border-approved { background: #22c55e; }
    .status-rejected { background: rgba(239, 68, 68, 0.1); color: #dc2626; }
    .border-rejected { background: #ef4444; }
    .status-pending { background: rgba(245, 158, 11, 0.1); color: #d97706; }
    .border-pending { background: #f59e0b; }

    .animate-item {
        animation: fadeIn 0.5s ease-out forwards;
        opacity: 0;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="history-container">
    <div class="page-header">
        <h1 class="page-title">Riwayat Pengajuan</h1>
        <a href="{{ route('karyawan.cuti.ajukan') }}" class="btn-create">
            <i class="fa-solid fa-plus me-2"></i> Ajukan Baru
        </a>
    </div>

    <div class="d-none d-lg-grid px-4 mb-2" style="grid-template-columns: 1fr 1.5fr 1fr 1fr 1.5fr; gap: 1.5rem;">
        <div class="text-uppercase text-xs fw-bold text-muted">Diajukan Pada</div>
        <div class="text-uppercase text-xs fw-bold text-muted">Periode & Durasi</div>
        <div class="text-uppercase text-xs fw-bold text-muted">Jenis Cuti</div>
        <div class="text-uppercase text-xs fw-bold text-muted">Status</div>
        <div class="text-uppercase text-xs fw-bold text-muted">Catatan/Review</div>
    </div>

    <?php if($items && count($items) > 0): ?>
        <?php $index = 0; ?>
        <?php foreach($items as $leave): ?>
            <?php
                $statusLink = 'border-pending';
                $badgeClass = 'status-pending';
                $icon = 'fa-clock';
                
                if($leave->status == 'approved') {
                    $statusLink = 'border-approved';
                    $badgeClass = 'status-approved';
                    $icon = 'fa-check';
                } elseif($leave->status == 'rejected') {
                    $statusLink = 'border-rejected';
                    $badgeClass = 'status-rejected';
                    $icon = 'fa-xmark';
                }
            ?>

            <div class="history-card animate-item" style="animation-delay: <?php echo $index * 0.1; ?>s">
                <div class="status-border <?php echo $statusLink; ?>"></div>
                
                <div class="grid-layout">
                    <div class="data-group">
                        <label class="d-lg-none">Diajukan Pada</label>
                        <div class="data-value">
                            <?php echo $leave->created_at->format('d M Y'); ?>
                            <div class="text-muted small fw-normal"><?php echo $leave->created_at->format('H:i'); ?></div>
                        </div>
                    </div>

                    <div class="data-group">
                        <label class="d-lg-none">Periode</label>
                        <div class="data-value text-primary">
                            <i class="fa-regular fa-calendar me-1"></i>
                            <?php echo $leave->start_date->format('d M'); ?> - <?php echo $leave->end_date->format('d M Y'); ?>
                        </div>
                        <div class="small text-muted"><?php echo $leave->days; ?> Hari Kerja</div>
                    </div>

                    <div class="data-group">
                        <label class="d-lg-none">Jenis</label>
                        <span class="type-badge"><?php echo ucfirst($leave->type); ?></span>
                    </div>

                    <div class="data-group">
                        <label class="d-lg-none">Status</label>
                        <span class="status-badge <?php echo $badgeClass; ?>">
                            <i class="fa-solid <?php echo $icon; ?>"></i> <?php echo ucfirst($leave->status); ?>
                        </span>
                    </div>

                    <div class="data-group">
                        <label class="d-lg-none">Catatan</label>
                        <?php if($leave->reviewed_reason): ?>
                            <div class="small fst-italic text-muted">
                                "<?php echo e($leave->reviewed_reason); ?>"
                            </div>
                            <?php if($leave->reviewer): ?>
                                <div class="text-xs fw-bold mt-1 text-muted">
                                    by <?php echo explode(' ', $leave->reviewer->name)[0]; ?>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <span class="text-muted small">-</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php $index++; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-5">
            <div class="mb-3 text-muted" style="font-size: 3rem; opacity: 0.3;">
                <i class="fa-solid fa-folder-open"></i>
            </div>
            <h6 class="text-muted fw-bold">Belum ada riwayat</h6>
            <p class="text-muted small">Anda belum pernah mengajukan cuti sebelumnya.</p>
            <a href="{{ route('karyawan.cuti.ajukan') }}" class="btn-create mt-3 d-inline-block">Mulai Ajukan</a>
        </div>
    <?php endif; ?>

    <div class="mt-4">
        <?php if(method_exists($items, 'links')): ?>
            <?php echo $items->links(); ?>
        <?php endif; ?>
    </div>
</div>
@endsection
