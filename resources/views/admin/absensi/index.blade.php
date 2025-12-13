@extends('layouts.metronic')
@php($title = 'Data Absensi')
@section('content')

<style>
    .premium-container {
        max-width: 1400px;
        margin: 0 auto;
    }
    
    /* Header Styles */
    .page-header {
        margin-bottom: 2rem;
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

    /* Filters Styles */
    .filter-bar {
        background: white;
        border-radius: 16px;
        padding: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.6);
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        align-items: center;
        margin-bottom: 2rem;
    }

    .search-input {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.6rem 1rem 0.6rem 2.8rem;
        font-size: 0.9rem;
        min-width: 250px;
        transition: all 0.3s ease;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: 12px center;
    }
    
    .search-input:focus {
        border-color: #A04ACF;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(160, 74, 207, 0.1);
        outline: none;
    }

    .form-select-premium {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.6rem 2.5rem 0.6rem 1rem;
        font-size: 0.9rem;
        color: #334155;
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        appearance: none;
        min-width: 120px;
    }

    .form-select-premium:focus {
        border-color: #A04ACF;
        box-shadow: 0 0 0 3px rgba(160, 74, 207, 0.1);
        outline: none;
    }

    .btn-filter {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        color: white;
        border: none;
        padding: 0.6rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .btn-filter:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.2);
        color: white;
    }

    /* Card/List Styles */
    .data-card {
        background: white;
        border-radius: 16px;
        padding: 1rem 1.5rem;
        margin-bottom: 0.8rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(226, 232, 240, 0.8);
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
    }
    
    .data-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px -10px rgba(0, 0, 0, 0.1);
        border-color: transparent;
        z-index: 10;
    }

    .status-indicator {
        width: 4px;
        height: 70%;
        border-radius: 4px;
        position: absolute;
        left: 0;
        top: 15%;
    }

    /* Data Grid */
    .card-grid {
        display: grid;
        grid-template-columns: 100px 2fr 100px 100px 100px 100px 1.5fr;
        width: 100%;
        align-items: center;
        gap: 1.5rem;
    }

    .data-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94a3b8;
        margin-bottom: 0.2rem;
        font-weight: 600;
    }

    .data-value {
        font-weight: 600;
        color: #334155;
        font-size: 0.95rem;
    }
    
    .date-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 0.5rem;
        text-align: center;
        border: 1px solid #f1f5f9;
        min-width: 80px;
    }

    .date-day {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1;
    }

    .date-month {
        font-size: 0.75rem;
        text-transform: uppercase;
        color: #64748b;
        font-weight: 600;
    }

    /* Status Badges */
    .badge-status {
        padding: 0.35rem 0.85rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .status-hadir {
        background: rgba(34, 197, 94, 0.1);
        color: #16a34a;
        border: 1px solid rgba(34, 197, 94, 0.2);
    }

    .status-telat {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }
    
    .status-ijin, .status-sakit {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    /* Animation */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(15px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-item {
        animation: slideUp 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
    }
</style>

<div class="premium-container">
    <div class="page-header">
        <h1 class="page-title">Data Absensi</h1>
        <p class="page-subtitle">Riwayat kehadiran karyawan per periode</p>
    </div>

    <!-- Filter Section -->
    <form method="GET" action="{{ route('admin.absensi.index') }}" class="filter-bar">
        <div class="flex-grow-1">
            <input type="text" name="q" class="search-input w-100" placeholder="Cari nama karyawan..." value="{{ $q }}" autocomplete="off">
        </div>
        
        <div class="d-flex gap-2 align-items-center">
            <select name="month" class="form-select-premium">
                @for ($m=1; $m<=12; $m++)
                    <option value="{{ $m }}" {{ $m==$month?'selected':'' }}>{{ \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM') }}</option>
                @endfor
            </select>
            
            <select name="year" class="form-select-premium">
                @for ($y=date('Y')-2; $y<=date('Y')+1; $y++)
                    <option value="{{ $y }}" {{ $y==$year?'selected':'' }}>{{ $y }}</option>
                @endfor
            </select>
            
            <button class="btn-filter" type="submit">
                <i class="fa-solid fa-filter me-2"></i>Filter
            </button>
        </div>
    </form>

    <!-- Header Row -->
    <div class="d-none d-lg-grid px-4 py-2 mb-2" style="grid-template-columns: 100px 2fr 100px 100px 100px 100px 1.5fr; gap: 1.5rem; color: #94a3b8; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">
        <div class="text-center">Tanggal</div>
        <div>Karyawan</div>
        <div>Status</div>
        <div>Masuk</div>
        <div>Pulang</div>
        <div>Telat</div>
        <div>Catatan</div>
    </div>

    <!-- Data List -->
    <div class="d-flex flex-column gap-2">
        <?php if($items->count() > 0): ?>
            <?php foreach($items as $index => $row): ?>
                <?php
                    $status = strtolower($row->status);
                    $statusClass = 'status-ijin';
                    $borderClass = '#f59e0b';
                    
                    if ($status == 'late') {
                        $statusClass = 'status-telat';
                        $borderClass = '#ef4444';
                    } elseif ($status == 'present') {
                        $statusClass = 'status-hadir';
                        $borderClass = '#22c55e';
                    }
                ?>
                
                <div class="data-card animate-item" style="animation-delay: {{ $index * 0.05 }}s">
                    <div class="status-indicator" style="background-color: {{ $borderClass }}"></div>
                    
                    <div class="card-grid">
                        <!-- Date -->
                        <div class="date-box">
                            <div class="date-day">{{ \Illuminate\Support\Carbon::parse($row->date)->format('d') }}</div>
                            <div class="date-month">{{ \Illuminate\Support\Carbon::parse($row->date)->format('M') }}</div>
                        </div>

                        <!-- User -->
                        <div>
                            <div class="data-value">{{ $row->user->name }}</div>
                            <div class="text-muted small" style="font-size: 0.8rem;">{{ $row->user->division ?? 'Staff' }}</div>
                        </div>

                        <!-- Status -->
                        <div>
                            <span class="badge-status {{ $statusClass }}">
                                @if(strtolower($row->status) == 'late') <i class="fa-solid fa-triangle-exclamation"></i>
                                @elseif(strtolower($row->status) == 'present') <i class="fa-solid fa-check"></i>
                                @else <i class="fa-solid fa-info-circle"></i>
                                @endif
                                {{ ucfirst($row->status) }}
                            </span>
                        </div>

                        <!-- Time In -->
                        <div>
                            <div class="data-label">Masuk</div>
                            <div class="data-value {{ $row->check_in ? '' : 'text-muted' }}">
                                {{ $row->check_in ? \Illuminate\Support\Carbon::parse($row->check_in)->format('H:i') : '-' }}
                            </div>
                        </div>

                        <!-- Time Out -->
                        <div>
                            <div class="data-label">Pulang</div>
                            <div class="data-value {{ $row->check_out ? '' : 'text-muted' }}">
                                {{ $row->check_out ? \Illuminate\Support\Carbon::parse($row->check_out)->format('H:i') : '-' }}
                            </div>
                        </div>

                        <!-- Late -->
                        <div>
                            <div class="data-label">Telat</div>
                            <div class="data-value {{ $row->minutes_late > 0 ? 'text-danger' : 'text-muted' }}">
                                {{ $row->minutes_late > 0 ? $row->minutes_late . 'm' : '-' }}
                            </div>
                        </div>

                        <!-- Notes -->
                        <div>
                            @if($row->notes)
                                <div class="text-muted small fst-italic text-truncate" title="{{ $row->notes }}" style="max-width: 200px;">
                                    "{{ $row->notes }}"
                                </div>
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
                    <div style="width: 70px; height: 70px; background: #f1f5f9; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 1.75rem;">
                        <i class="fa-solid fa-clipboard"></i>
                    </div>
                </div>
                <h6 class="text-muted fw-bold">Tidak ada data absensi</h6>
                <p class="text-muted small">Tidak ada data ditemukan untuk periode yang dipilih.</p>
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-4">
        {{ $items->appends(request()->query())->links() }}
    </div>
</div>
@endsection
