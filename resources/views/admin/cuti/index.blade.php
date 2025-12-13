@extends('layouts.metronic')
@php($title = 'Data Cuti')
@section('content')

<style>
    .premium-container {
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
    }

    /* Ambient Glow Background */
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
    
    /* Header Styles */
    .page-header {
        margin-bottom: 2.5rem;
        position: relative;
    }
    
    .page-title {
        font-weight: 800;
        font-size: 2rem;
        letter-spacing: -0.5px;
        background: linear-gradient(135deg, #0f172a 0%, #334155 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
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

    /* Filters Bar Glassmorphism */
    .filter-bar {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 1rem 1.5rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.8);
        display: inline-flex;
        gap: 1.25rem;
        align-items: center;
        margin-bottom: 2.5rem;
        transition: all 0.3s ease;
    }

    .filter-bar:hover {
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        transform: translateY(-2px);
    }

    .filter-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #94a3b8;
    }

    .form-select-premium {
        background-color: rgba(248, 250, 252, 0.8);
        border: 2px solid transparent;
        border-radius: 14px;
        padding: 0.75rem 3rem 0.75rem 1.25rem;
        font-size: 0.95rem;
        font-weight: 600;
        color: #334155;
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px 12px;
        appearance: none;
        min-width: 180px;
        transition: all 0.3s ease;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
    }

    .form-select-premium:hover {
        background-color: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .form-select-premium:focus {
        background-color: white;
        border-color: #A04ACF;
        box-shadow: 0 0 0 4px rgba(160, 74, 207, 0.1);
        outline: none;
    }

    .btn-filter {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 14px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        letter-spacing: 0.3px;
        box-shadow: 0 8px 16px rgba(15, 23, 42, 0.15);
    }

    .btn-filter:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 12px 24px rgba(15, 23, 42, 0.25);
        color: white;
    }

    /* Card/List Styles */
    .data-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 1.5rem 2rem;
        margin-bottom: 1rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(255, 255, 255, 0.6);
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
    }
    
    .data-card:hover {
        transform: translateY(-4px) scale(1.01);
        box-shadow: 0 20px 40px -6px rgba(0, 0, 0, 0.08);
        border-color: white;
        z-index: 10;
    }

    /* Dynamic Border Gradient on Hover */
    .data-card::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 20px;
        padding: 2px;
        background: linear-gradient(135deg, rgba(255,255,255,0), rgba(255,255,255,0));
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
        transition: all 0.4s ease;
    }

    .data-card:hover::after {
        background: linear-gradient(135deg, rgba(160, 74, 207, 0.3), rgba(195, 57, 141, 0.3));
    }

    .status-indicator {
        width: 6px;
        height: 60%;
        border-radius: 10px;
        position: absolute;
        left: 0;
        top: 20%;
        transition: height 0.3s ease;
    }

    .data-card:hover .status-indicator {
        height: 80%;
        top: 10%;
    }

    /* Data Grid */
    .card-grid {
        display: grid;
        grid-template-columns: 2fr 130px 1.8fr 1fr 120px 1.5fr 1.5fr 100px;
        width: 100%;
        align-items: center;
        gap: 1.5rem;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 1.2rem;
    }

    .user-avatar-sm {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        color: #0ea5e9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.1rem;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.15);
        border: 2px solid white;
        transition: transform 0.3s ease;
    }

    .data-card:hover .user-avatar-sm {
        transform: scale(1.1) rotate(-5deg);
    }

    .data-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #94a3b8;
        margin-bottom: 0.35rem;
        font-weight: 700;
    }

    .data-value {
        font-weight: 600;
        color: #334155;
        font-size: 1rem;
    }
    
    .leave-type-badge {
        padding: 0.5rem 1rem;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.85rem;
        color: #475569;
        display: inline-block;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }

    /* Status Badges */
    .badge-status {
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.02em;
        transition: all 0.3s ease;
    }

    .status-approved {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1), rgba(22, 163, 74, 0.15));
        color: #15803d;
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .status-rejected {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.15));
        color: #b91c1c;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }
    
    .status-pending {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(217, 119, 6, 0.15));
        color: #b45309;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }
    
    .data-card:hover .badge-status {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    
    .btn-action {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border: 1px solid #e2e8f0;
        color: #64748b;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    
    .btn-action:hover {
        background: #0ea5e9;
        color: white;
        border-color: #0ea5e9;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
    }

    /* Animation */
    @keyframes slideUpFade {
        from { opacity: 0; transform: translateY(20px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    .animate-item {
        animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }
</style>

<div class="premium-container">
    <div class="page-header">
        <h1 class="page-title">Riwayat Cuti</h1>
        <p class="page-subtitle">Daftar riwayat permintaan cuti karyawan</p>
    </div>

    <!-- Filter Section -->
    <form method="GET" action="{{ route('admin.cuti.index') }}" class="filter-bar">
        <label class="filter-label mb-0">Status:</label>
        <select name="status" class="form-select-premium">
            <option value="">Semua Status</option>
            <?php foreach(['pending' => 'Pending', 'approved' => 'Disetujui', 'rejected' => 'Ditolak'] as $val => $label): ?>
                <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            <?php endforeach; ?>
        </select>
        <button class="btn-filter" type="submit">
            <i class="fa-solid fa-filter me-2"></i>Filter
        </button>
    </form>

    <!-- Header Row -->
    <div class="d-none d-lg-grid px-4 py-2 mb-2" style="grid-template-columns: 2fr 130px 1.8fr 1fr 120px 1.5fr 1.5fr 100px; gap: 1.5rem; color: #94a3b8; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">
        <div>Karyawan</div>
        <div>Jenis Cuti</div>
        <div>Periode</div>
        <div>Durasi</div>
        <div>Status</div>
        <div>Reviewer</div>
        <div>Catatan</div>
        <div class="text-center">Aksi</div>
    </div>

    <!-- Data List -->
    <div class="d-flex flex-column gap-2">
        <?php if($items->count() > 0): ?>
            <?php foreach($items as $index => $leave): ?>
                <?php
                    $status = strtolower($leave->status);
                    $statusClass = 'status-pending';
                    $borderClass = '#f59e0b';
                    $icon = 'fa-clock';
                    
                    if ($status == 'approved') {
                        $statusClass = 'status-approved';
                        $borderClass = '#22c55e';
                        $icon = 'fa-check';
                    } elseif ($status == 'rejected') {
                        $statusClass = 'status-rejected';
                        $borderClass = '#ef4444';
                        $icon = 'fa-xmark';
                    }
                ?>
                
                <div class="data-card animate-item" style="animation-delay: {{ $index * 0.08 }}s">
                    <div class="status-indicator" style="background-color: {{ $borderClass }}"></div>
                    
                    <div class="card-grid">
                        <!-- User Info -->
                        <div class="user-info">
                            <div class="user-avatar-sm">
                                {{ strtoupper(substr($leave->user->name ?? '?', 0, 1)) }}
                            </div>
                            <div>
                                <div class="data-value">{{ $leave->user->name }}</div>
                                <div class="text-muted small" style="font-size: 0.8rem; font-weight: 500;">
                                    {{ $leave->user->division ?? '-' }}
                                </div>
                            </div>
                        </div>

                        <!-- Type -->
                        <div>
                            <span class="leave-type-badge">{{ ucfirst($leave->type) }}</span>
                        </div>

                        <!-- Period -->
                        <div>
                            <div class="data-value">{{ $leave->start_date->format('d M Y') }}</div>
                            <div class="text-xs text-muted" style="font-size: 0.75rem;">
                                s/d {{ $leave->end_date->format('d M Y') }}
                            </div>
                        </div>

                        <!-- Days -->
                        <div>
                            <span class="fw-bold fs-5 text-dark">{{ $leave->days }}</span> <span class="text-muted small">hari</span>
                        </div>

                        <!-- Status -->
                        <div>
                            <span class="badge-status {{ $statusClass }}">
                                <i class="fa-solid {{ $icon }}"></i>
                                {{ ucfirst($leave->status) }}
                            </span>
                        </div>

                        <!-- Reviewer -->
                        <div>
                            @if(optional($leave->reviewer)->name)
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 24px; height: 24px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #64748b; font-weight: bold;">
                                        {{ substr($leave->reviewer->name, 0, 1) }}
                                    </div>
                                    <span class="text-dark small fw-medium">{{ explode(' ', $leave->reviewer->name)[0] }}</span>
                                </div>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>

                        <!-- Notes -->
                        <div>
                            @if($leave->reviewed_reason)
                                <div class="text-muted small fst-italic text-truncate" title="{{ $leave->reviewed_reason }}" style="max-width: 150px;">
                                    "{{ $leave->reviewed_reason }}"
                                </div>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>

                        <!-- Action -->
                        <div class="text-center">
                            @if($leave->status == 'pending')
                                <a href="{{ route('admin.cuti.review', $leave) }}" class="btn-action" title="Review Permintaan">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center py-5 animate-item">
                <div class="mb-3">
                    <div style="width: 80px; height: 80px; background: rgba(241, 245, 249, 0.8); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 2rem; box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);">
                        <i class="fa-solid fa-suitcase-rolling"></i>
                    </div>
                </div>
                <h6 class="text-muted fw-bold">Tidak ada data cuti</h6>
                <p class="text-muted small">Belum ada riwayat pengajuan cuti dengan filter ini.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-4">
        {{ $items->appends(request()->query())->links() }}
    </div>
</div>
@endsection
