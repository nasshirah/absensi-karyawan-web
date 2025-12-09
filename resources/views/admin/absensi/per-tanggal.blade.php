@extends('layouts.metronic')
@php($title = 'Absensi per Tanggal')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body">
  <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Absensi per Tanggal</h5>
    <form method="GET" action="{{ route('admin.absensi.per-tanggal') }}" class="d-flex flex-wrap gap-2">
      <input type="date" name="date" value="{{ $date }}" class="form-control form-control-sm" />
      <button class="btn btn-outline-secondary btn-sm" type="submit">Terapkan</button>
    </form>
  </div>

  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Status</th>
          <th>Masuk</th>
          <th>Pulang</th>
          <th>Telat (menit)</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($items as $row)
          <tr>
            <td>{{ $row->user->name }}</td>
            <td>{{ ucfirst($row->status) }}</td>
            <td>{{ $row->check_in ? \Illuminate\Support\Carbon::parse($row->check_in)->format('H:i') : '-' }}</td>
            <td>{{ $row->check_out ? \Illuminate\Support\Carbon::parse($row->check_out)->format('H:i') : '-' }}</td>
            <td>{{ $row->minutes_late }}</td>
            <td>{{ $row->notes }}</td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center text-muted">Tidak ada data pada tanggal ini.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div></div>
@endsection
