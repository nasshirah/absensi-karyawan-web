@extends('layouts.karyawan')
@php($title = 'Riwayat Cuti')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body">
  <h5 class="mb-3">Riwayat Cuti</h5>
  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead>
        <tr>
          <th>Tanggal Pengajuan</th>
          <th>Jenis</th>
          <th>Periode</th>
          <th>Hari</th>
          <th>Status</th>
          <th>Reviewer</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($items as $leave)
          <tr>
            <td>{{ $leave->created_at->format('d/m/Y H:i') }}</td>
            <td>{{ ucfirst($leave->type) }}</td>
            <td>{{ $leave->start_date->format('d/m/Y') }} - {{ $leave->end_date->format('d/m/Y') }}</td>
            <td>{{ $leave->days }}</td>
            <td>{{ ucfirst($leave->status) }}</td>
            <td>{{ optional($leave->reviewer)->name ?? '-' }}</td>
            <td>{{ $leave->reviewed_reason ?? '-' }}</td>
          </tr>
        @empty
          <tr><td colspan="7" class="text-center text-muted">Tidak ada data.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div></div>
@endsection

