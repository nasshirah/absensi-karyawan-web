@extends('layouts.metronic')

@section('title', 'Data Cuti')

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
    <form method="GET" action="{{ route('admin.cuti.index') }}" class="filter-bar">
        <label class="mb-0 fw-bold text-muted">Status</label>
        <select name="status" class="form-select">
            <option value="">Semua</option>
            @foreach (['pending' => 'Pending', 'approved' => 'Disetujui', 'rejected' => 'Ditolak'] as $val => $label)
                <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        <button class="btn btn-dark" type="submit">
            <i class="fa-solid fa-filter me-2"></i>Filter
        </button>
    </form>

    <!-- DATA -->
    <div class="d-flex flex-column gap-2">
        @forelse ($items as $index => $leave)

            @php
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
            @endphp

            <div class="data-card">
                <div class="status-indicator" style="background-color: {{ $borderColor }};"></div>

                <div class="card-grid">
                    <!-- Karyawan -->
                    <div>
                        <strong>{{ $leave->user->name }}</strong><br>
                        <small class="text-muted">{{ $leave->user->division ?? '-' }}</small>
                    </div>

                    <!-- Jenis -->
                    <div>{{ ucfirst($leave->type) }}</div>

                    <!-- Periode -->
                    <div>
                        {{ $leave->start_date->format('d M Y') }}<br>
                        <small class="text-muted">s/d {{ $leave->end_date->format('d M Y') }}</small>
                    </div>

                    <!-- DURASI + SISA CUTI -->
                    <div>
                        <div class="fw-bold">{{ $leave->days }} hari</div>
                        <small>
                            Sisa:
                            @if($leave->sisa_cuti <= 0)
                                <span class="text-danger fw-bold">Habis</span>
                            @elseif($leave->sisa_cuti < $leave->days)
                                <span class="text-warning fw-bold">
                                    {{ $leave->sisa_cuti }} hari
                                </span>
                            @else
                                <span class="text-success fw-bold">
                                    {{ $leave->sisa_cuti }} hari
                                </span>
                            @endif
                        </small>
                    </div>

                    <!-- Status -->
                    <div>
                        <span class="badge-status {{ $statusClass }}">
                            {{ ucfirst($leave->status) }}
                        </span>
                    </div>

                    <!-- Reviewer -->
                    <div>{{ optional($leave->reviewer)->name ?? '-' }}</div>

                    <!-- Catatan -->
                    <div class="text-muted small">
                        {{ $leave->reviewed_reason ?? '-' }}
                    </div>

                    <!-- Aksi -->
                    <div class="text-center">
                        @if ($leave->status === 'pending')
                            <a href="{{ route('admin.cuti.review', $leave) }}"
                               class="btn btn-sm btn-outline-primary">
                                Review
                            </a>
                        @else
                            -
                        @endif
                    </div>
                </div>
            </div>

        @empty
            <div class="text-center py-5 text-muted">
                Tidak ada data cuti
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $items->appends(request()->query())->links() }}
    </div>

</div>
@endsection
