@extends('layouts.karyawan')
@php($title = 'Riwayat Absensi')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Riwayat Absensi</h5>
    <form method="GET" class="d-flex gap-2">
      <select name="month" class="form-select form-select-sm">
        @for ($m=1; $m<=12; $m++)
          <option value="{{ $m }}" {{ $m==$month?'selected':'' }}>{{ str_pad($m,2,'0',STR_PAD_LEFT) }}</option>
        @endfor
      </select>
      <select name="year" class="form-select form-select-sm">
        @for ($y=date('Y')-2; $y<=date('Y')+1; $y++)
          <option value="{{ $y }}" {{ $y==$year?'selected':'' }}>{{ $y }}</option>
        @endfor
      </select>
      <button class="btn btn-outline-secondary btn-sm" type="submit">Terapkan</button>
    </form>
  </div>

  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Masuk</th>
          <th>Pulang</th>
          <th>Telat (menit)</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($items as $row)
          <tr>
            <td>{{ \Illuminate\Support\Carbon::parse($row->date)->format('d/m/Y') }}</td>
            <td>{{ strtoupper($row->status) }}</td>
            <td>{{ $row->check_in ? \Illuminate\Support\Carbon::parse($row->check_in)->format('H:i') : '-' }}</td>
            <td>{{ $row->check_out ? \Illuminate\Support\Carbon::parse($row->check_out)->format('H:i') : '-' }}</td>
            <td>{{ $row->minutes_late }}</td>
          </tr>
        @empty
          <tr><td colspan="5" class="text-center text-muted">Tidak ada data.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div></div>
@endsection

