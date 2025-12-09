@extends('layouts.metronic')
@php($title = 'Telat / Tidak Hadir')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Telat / Tidak Hadir ({{ \Illuminate\Support\Carbon::parse($today)->format('d/m/Y') }})</h5>
  </div>

  <h6 class="mt-2 mb-2">Telat</h6>
  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Masuk</th>
          <th>Telat (menit)</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($late as $row)
          <tr>
            <td>{{ optional($row->user)->name }}</td>
            <td>{{ $row->check_in ? \Illuminate\Support\Carbon::parse($row->check_in)->format('H:i') : '-' }}</td>
            <td>{{ $row->minutes_late }}</td>
            <td>{{ $row->notes }}</td>
          </tr>
        @empty
          <tr><td colspan="4" class="text-center text-muted">Tidak ada yang telat.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <h6 class="mt-4 mb-2">Tidak Hadir</h6>
  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Divisi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($notPresent as $u)
          <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->division ?? '-' }}</td>
          </tr>
        @empty
          <tr><td colspan="2" class="text-center text-muted">Semua karyawan telah absen.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

</div></div>
@endsection
