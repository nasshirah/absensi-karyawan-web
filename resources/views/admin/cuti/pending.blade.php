@extends('layouts.metronic')
@php($title = 'Cuti Pending')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body">
  <h5 class="mb-3">Daftar Cuti Pending</h5>
  <div class="table-responsive">
    <table class="table table-sm align-middle">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Jenis</th>
          <th>Periode</th>
          <th>Hari</th>
          <th>Alasan</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $leave)
          <tr>
            <td>{{ $leave->user->name }}</td>
            <td>{{ ucfirst($leave->type) }}</td>
            <td>{{ $leave->start_date->format('d/m/Y') }} - {{ $leave->end_date->format('d/m/Y') }}</td>
            <td>{{ $leave->days }}</td>
            <td>{{ $leave->reason }}</td>
            <td>
              <a href="{{ route('admin.cuti.review', $leave) }}" class="btn btn-primary btn-sm">Review</a>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center text-muted">Tidak ada pengajuan pending.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div>
    {{ $items->links() }}
  </div>
</div></div>
@endsection
