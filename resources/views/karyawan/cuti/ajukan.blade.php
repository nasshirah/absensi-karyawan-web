@extends('layouts.karyawan')
@php($title = 'Ajukan Cuti')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body">
  <h5 class="mb-3">Ajukan Cuti</h5>
  <form method="POST" action="{{ route('karyawan.cuti.store') }}" class="row g-3">
    @csrf
    <div class="col-md-4">
      <label class="form-label">Jenis Cuti</label>
      <select name="type" class="form-select" required>
        <option value="tahunan">Tahunan</option>
        <option value="sakit">Sakit</option>
        <option value="lainnya">Lainnya</option>
      </select>
    </div>
    <div class="col-md-4">
      <label class="form-label">Mulai</label>
      <input type="date" name="start_date" class="form-control" required>
    </div>
    <div class="col-md-4">
      <label class="form-label">Selesai</label>
      <input type="date" name="end_date" class="form-control" required>
    </div>
    <div class="col-12">
      <label class="form-label">Alasan</label>
      <textarea name="reason" class="form-control" rows="3" placeholder="Opsional"></textarea>
    </div>
    <div class="col-12 d-flex gap-2">
      <button type="submit" class="btn btn-primary">Kirim</button>
      <a href="{{ route('karyawan.cuti.riwayat') }}" class="btn btn-light">Riwayat Cuti</a>
    </div>
  </form>
</div></div>
@endsection

