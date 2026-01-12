@extends('layouts.metronic')

@section('title', 'Data Absensi')

@section('content')

<style>
    .premium-container { max-width: 1400px; margin: 0 auto; }
    .page-title { font-weight: 800; font-size: 1.75rem; }
    .filter-bar { background: #fff; padding: 1rem; border-radius: 12px; }
    .data-card { background: #fff; border-radius: 16px; padding: 1rem; position: relative; }
    .status-indicator { width: 4px; height: 70%; position: absolute; left: 0; top: 15%; }
    .card-grid {
        display: grid;
        grid-template-columns: 100px 2fr 100px 100px 100px 100px 1.5fr;
        gap: 1.5rem;
        align-items: center;
    }
    .animate-item { opacity: 0; animation: slideUp .5s forwards; }
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="premium-container">

    {{-- HEADER --}}
    <div class="mb-4">
        <h1 class="page-title">Data Absensi</h1>
        <p class="text-muted">Riwayat kehadiran karyawan per periode</p>
    </div>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('admin.absensi.index') }}" class="filter-bar d-flex gap-2 mb-4">

        <input type="text"
               name="q"
               class="form-control"
               placeholder="Cari nama karyawan..."
               value="{{ $q ?? '' }}">

        {{-- BULAN --}}
        <select name="month" class="form-select">
            @for ($m = 1; $m <= 12; $m++)
                <option value="{{ $m }}" @selected((int)$m === (int)$month)>
                    {{ \Carbon\Carbon::create()->month($m)->locale('id')->isoFormat('MMMM') }}
                </option>
            @endfor
        </select>

        {{-- TAHUN --}}
        <select name="year" class="form-select">
            @for ($y = date('Y') - 2; $y <= date('Y') + 1; $y++)
                <option value="{{ $y }}" @selected((int)$y === (int)$year)>
                    {{ $y }}
                </option>
            @endfor
        </select>

        <button type="submit" class="btn btn-dark">
            <i class="fa-solid fa-filter me-1"></i> Filter
        </button>

        <div class="dropdown ms-auto">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-file-export me-1"></i> Export
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="exportDropdown" style="border-radius: 12px;">
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('admin.absensi.export.excel', ['month' => $month, 'year' => $year, 'q' => $q]) }}">
                        <i class="fa-regular fa-file-excel text-success"></i>
                        Excel (.xlsx)
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('admin.absensi.export.pdf', ['month' => $month, 'year' => $year, 'q' => $q]) }}">
                        <i class="fa-regular fa-file-pdf text-danger"></i>
                        PDF (.pdf)
                    </a>
                </li>
            </ul>
        </div>
    </form>

    {{-- LIST DATA --}}
    <div class="d-flex flex-column gap-2">

        @forelse ($items as $index => $row)

            @php
                $status = strtolower($row->status);
                $borderColor = match ($status) {
                    'late' => '#ef4444',
                    'present' => '#22c55e',
                    default => '#f59e0b',
                };
            @endphp

            <div class="data-card animate-item"
                 style="animation-delay: {{ $index * 0.05 }}s;">

                <div class="status-indicator"
                     style="background-color: {{ $borderColor }};"></div>

                <div class="card-grid">

                    {{-- TANGGAL --}}
                    <div>
                        <strong>{{ \Carbon\Carbon::parse($row->date)->format('d M') }}</strong>
                    </div>

                    {{-- USER --}}
                    <div>
                        <div class="fw-bold">{{ $row->user->name }}</div>
                        <small class="text-muted">{{ $row->user->division ?? 'Staff' }}</small>
                    </div>

                    {{-- STATUS --}}
                    <div>{{ ucfirst($row->status) }}</div>

                    {{-- MASUK --}}
                    <div>
                        {{ $row->check_in
                            ? \Carbon\Carbon::parse($row->check_in)->format('H:i')
                            : '-' }}
                    </div>

                    {{-- PULANG --}}
                    <div>
                        {{ $row->check_out
                            ? \Carbon\Carbon::parse($row->check_out)->format('H:i')
                            : '-' }}
                    </div>

                    {{-- TELAT --}}
                    <div>
                        {{ $row->minutes_late > 0 ? $row->minutes_late.'m' : '-' }}
                    </div>

                    {{-- CATATAN --}}
                    <div class="text-muted fst-italic">
                        {{ $row->notes ?? '-' }}
                    </div>

                </div>
            </div>

        @empty
            <div class="text-center py-5 text-muted">
                Tidak ada data absensi untuk periode ini
            </div>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $items->appends(request()->query())->links() }}
    </div>

</div>

@endsection
