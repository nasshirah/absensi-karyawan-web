@extends('layouts.metronic')
@php($title = 'Karyawan Hadir Hari Ini')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Karyawan Hadir Hari Ini ({{ \Illuminate\Support\Carbon::parse($today)->format('d/m/Y') }})</h5>
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
          <tr><td colspan="6" class="text-center text-muted">Belum ada absensi.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div></div>
@endsection
