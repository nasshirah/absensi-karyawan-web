@extends('layouts.metronic')
@php($title = 'Data Cuti')
@section('content')
<div class="card border-0 shadow-sm">
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="mb-0">Riwayat Cuti</h5>
      <form method="GET" action="{{ route('admin.cuti.index') }}" class="d-flex gap-2">
        <select name="status" class="form-select form-select-sm">
          <option value="">Semua Status</option>
          @foreach (['pending','approved','rejected'] as $st)
            <option value="{{ $st }}" {{ request('status')===$st?'selected':'' }}>{{ ucfirst($st) }}</option>
          @endforeach
        </select>
        <button class="btn btn-outline-secondary btn-sm" type="submit">Filter</button>
      </form>
    </div>
    <div class="table-responsive">
      <table class="table table-sm align-middle">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Periode</th>
            <th>Hari</th>
            <th>Status</th>
            <th>Reviewer</th>
            <th>Catatan</th>
          </tr>
        </thead>
        <tbody>
          @forelse($items as $leave)
            <tr>
              <td>{{ $leave->user->name }}</td>
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
    <div>
      {{ $items->links() }}
    </div>
  </div>
</div>
@endsection
