@extends('layouts.metronic')
@php($title = 'Review Cuti')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body">
  <h5 class="mb-3">Review Pengajuan Cuti</h5>
  <div class="mb-3">
      <div><strong>Nama:</strong> {{ $leave->user->name }}</div>
      <div><strong>Jenis:</strong> {{ ucfirst($leave->type) }}</div>
      <div><strong>Periode:</strong> {{ $leave->start_date->format('d/m/Y') }} - {{ $leave->end_date->format('d/m/Y') }} ({{ $leave->days }} hari)</div>
      <div><strong>Alasan:</strong> {{ $leave->reason }}</div>
      <div><strong>Status:</strong> {{ ucfirst($leave->status) }}</div>
  </div>

  <form action="{{ route('admin.cuti.process', $leave) }}" method="POST" class="row g-3">
    @csrf
    <div class="col-12">
      <label class="form-label">Catatan/Alasan (opsional)</label>
      <textarea name="reviewed_reason" class="form-control" rows="3" placeholder="Tulis catatan"></textarea>
    </div>
    <div class="col-12 d-flex gap-2">
      <button type="submit" name="action" value="approve" class="btn btn-success">Terima</button>
      <button type="submit" name="action" value="reject" class="btn btn-danger">Tolak</button>
      <a href="{{ route('admin.cuti.pending') }}" class="btn btn-light">Kembali</a>
    </div>
  </form>
</div></div>
@endsection
