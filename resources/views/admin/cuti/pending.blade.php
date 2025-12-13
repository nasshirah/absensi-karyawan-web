@extends('layouts.metronic')
@php($title = 'Persetujuan Cuti')
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
        background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, rgba(0,0,0,0) 70%);
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
        background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
        display: inline-block;
    }

    .page-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #f59e0b, #d97706);
        border-radius: 4px;
        margin-top: 0.5rem;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 1rem;
        font-weight: 500;
        margin-top: 0.5rem;
    }

    /* Card/List Styles */
    .data-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 1.5rem 2rem;
        margin-bottom: 1rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(226, 232, 240, 0.8);
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }
    
    .data-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px -6px rgba(0, 0, 0, 0.08);
        border-color: #f59e0b;
        z-index: 10;
    }

    .status-indicator {
        width: 6px;
        height: 100%; /* Full height for pending focus */
        position: absolute;
        left: 0;
        top: 0;
        background-color: #f59e0b;
        opacity: 0.8;
    }

    /* Data Grid */
    .card-grid {
        display: grid;
        grid-template-columns: 2fr 130px 2fr 1.2fr 1.5fr 150px;
        width: 100%;
        align-items: center;
        gap: 2rem;
        padding-left: 1rem; /* Spacing from indicator */
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
        background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
        color: #d97706;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.1rem;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(217, 119, 6, 0.15);
        border: 2px solid white;
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
    
    .btn-review {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }
    
    .btn-review:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.4);
        color: white;
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
        <h1 class="page-title">Persetujuan Cuti</h1>
        <p class="page-subtitle">Daftar pengajuan cuti yang menunggu persetujuan Anda.</p>
    </div>

    <!-- Header Row -->
    <div class="d-none d-lg-grid px-4 py-2 mb-2" style="grid-template-columns: 2fr 130px 2fr 1.2fr 1.5fr 150px; gap: 2rem; color: #94a3b8; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; padding-left: 3rem;">
        <div>Karyawan</div>
        <div>Jenis</div>
        <div>Periode</div>
        <div>Durasi</div>
        <div>Alasan</div>
        <div class="text-end">Aksi</div>
    </div>

    <!-- Data List -->
    <div class="d-flex flex-column gap-3">
        @if(isset($items) && $items->count() > 0)
            @foreach($items as $index => $leave)
                <div class="data-card animate-item" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="status-indicator"></div>
                    
                    <div class="card-grid">
                        <!-- User Info -->
                        <div class="user-info">
                            <div class="user-avatar-sm">
                                {{ strtoupper(substr($leave->user->name ?? '?', 0, 1)) }}
                            </div>
                            <div>
                                <div class="data-value">{{ $leave->user->name }}</div>
                                <div class="text-muted small">{{ $leave->user->division ?? 'Staff' }}</div>
                            </div>
                        </div>

                        <!-- Type -->
                        <div>
                            <span class="badge bg-light text-dark border">{{ ucfirst($leave->type) }}</span>
                        </div>

                        <!-- Period -->
                        <div>
                            <div class="data-value">{{ $leave->start_date->format('d M Y') }}</div>
                            <div class="text-xs text-muted">s/d {{ $leave->end_date->format('d M Y') }}</div>
                        </div>

                        <!-- Days -->
                        <div>
                            <span class="fw-bold fs-5 text-dark">{{ $leave->days }}</span> <span class="text-muted small">hari</span>
                        </div>

                        <!-- Reason -->
                        <div>
                            <div class="text-muted small fst-italic text-truncate" title="{{ $leave->reason }}" style="max-width: 200px;">
                                "{{ $leave->reason }}"
                            </div>
                        </div>

                        <!-- Action -->
                        <div class="text-end">
                            <a href="{{ route('admin.cuti.review', $leave) }}" class="btn-review">
                                <i class="fa-solid fa-gavel"></i> Review
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-5 animate-item">
                <div class="mb-3">
                    <div style="width: 80px; height: 80px; background: rgba(245, 158, 11, 0.1); border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 2rem;">
                        <i class="fa-solid fa-check-double"></i>
                    </div>
                </div>
                <h6 class="text-muted fw-bold">Semua Bersih!</h6>
                <p class="text-muted small">Tidak ada pengajuan cuti yang menunggu persetujuan saat ini.</p>
            </div>
        @endif
    </div>

    <div class="mt-4">
        @if(isset($items) && method_exists($items, 'links'))
            {{ $items->links() }}
        @endif
    </div>
</div>
@endsection
