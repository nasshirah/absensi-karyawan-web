@extends('layouts.metronic')
@php($title = 'Persetujuan Cuti')
@section('content')

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
        background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, rgba(0,0,0,0) 70%);
        z-index: -1;
        pointer-events: none;
    }

    .page-header {
        margin-bottom: 2.5rem;
    }

    .page-title {
        font-weight: 800;
        font-size: 2rem;
        background: linear-gradient(135deg, #1e293b 0%, #475569 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: .5rem;
    }

    .page-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #f59e0b, #d97706);
        border-radius: 4px;
        margin-top: .5rem;
    }

    .page-subtitle {
        color: #64748b;
        font-weight: 500;
    }

    .data-card {
        background: rgba(255,255,255,.95);
        border-radius: 20px;
        padding: 1.5rem 2rem;
        border: 1px solid rgba(226,232,240,.8);
        display: flex;
        position: relative;
        transition: .3s;
    }

    .data-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0,0,0,.08);
        border-color: #f59e0b;
    }

    .status-indicator {
        width: 6px;
        background: #f59e0b;
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        border-radius: 20px 0 0 20px;
    }

    .card-grid {
        display: grid;
        grid-template-columns: 2fr 130px 2fr 1.2fr 1.5fr 150px;
        width: 100%;
        gap: 2rem;
        padding-left: 1rem;
        align-items: center;
    }

    .user-info {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .user-avatar-sm {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg,#fffbeb,#fef3c7);
        color: #d97706;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
    }

    .data-value {
        font-weight: 600;
        color: #334155;
    }

    .btn-review {
        background: linear-gradient(135deg,#f59e0b,#d97706);
        color: #fff;
        padding: .6rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: .5rem;
    }

    .btn-review:hover {
        color: #fff;
        box-shadow: 0 8px 20px rgba(245,158,11,.4);
    }
</style>

<div class="premium-container">
    <div class="page-header">
        <h1 class="page-title">Persetujuan Cuti</h1>
        <p class="page-subtitle">Daftar pengajuan cuti yang menunggu persetujuan Anda.</p>
    </div>

    <!-- Header -->
    <div class="d-none d-lg-grid px-4 py-2 mb-2"
         style="grid-template-columns: 2fr 130px 2fr 1.2fr 1.5fr 150px; gap:2rem;
                font-size:.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;">
        <div>Karyawan</div>
        <div>Jenis</div>
        <div>Periode</div>
        <div>Durasi</div>
        <div>Alasan</div>
        <div class="text-end">Aksi</div>
    </div>

    <div class="d-flex flex-column gap-3">
        @if($items->count())
            @foreach($items as $leave)
                <div class="data-card">
                    <div class="status-indicator"></div>

                    <div class="card-grid">

                        <!-- Karyawan -->
                        <div class="user-info">
                            <div class="user-avatar-sm">
                                {{ strtoupper(substr($leave->user->name ?? '?',0,1)) }}
                            </div>
                            <div>
                                <div class="data-value">{{ $leave->user->name }}</div>
                                <div class="text-muted small">{{ $leave->user->division ?? 'Staff' }}</div>
                            </div>
                        </div>

                        <!-- Jenis -->
                        <div>
                            <span class="badge bg-light text-dark border">
                                {{ ucfirst($leave->type) }}
                            </span>
                        </div>

                        <!-- Periode -->
                        <div>
                            <div class="data-value">
                                {{ $leave->start_date->format('d M Y') }}
                            </div>
                            <div class="text-muted small">
                                s/d {{ $leave->end_date->format('d M Y') }}
                            </div>
                        </div>

                        <!-- DURASI + SISA CUTI -->
                        <div>
                            <div>
                                <span class="fw-bold fs-5">{{ $leave->days }}</span>
                                <span class="text-muted small">hari</span>
                            </div>

                            <div class="small mt-1">
                                <span class="text-muted">Sisa:</span>

                                @if($leave->sisa_cuti <= 0)
                                    <span class="fw-bold text-danger">Habis</span>
                                @elseif($leave->sisa_cuti < $leave->days)
                                    <span class="fw-bold text-warning">
                                        {{ $leave->sisa_cuti }} hari
                                    </span>
                                @else
                                    <span class="fw-bold text-success">
                                        {{ $leave->sisa_cuti }} hari
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Alasan -->
                        <div class="text-muted small fst-italic text-truncate" title="{{ $leave->reason }}">
                            "{{ $leave->reason }}"
                        </div>

                        <!-- Aksi -->
                        <div class="text-end">
                            <a href="{{ route('admin.cuti.review', $leave) }}" class="btn-review">
                                <i class="fa-solid fa-gavel"></i> Review
                            </a>
                        </div>

                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-5">
                <h6 class="text-muted fw-bold">Semua Bersih!</h6>
                <p class="text-muted small">
                    Tidak ada pengajuan cuti yang menunggu persetujuan.
                </p>
            </div>
        @endif
    </div>

    <div class="mt-4">
        {{ $items->links() }}
    </div>
</div>
@endsection
