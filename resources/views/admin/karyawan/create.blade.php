@extends('layouts.metronic')
@php($title = 'Tambah Karyawan')
@section('content')
<div class="card border-0 shadow-sm">
  <div class="card-body">
    <h5 class="mb-3">Tambah Karyawan</h5>
    <form action="{{ route('admin.karyawan.store') }}" method="POST" class="row g-3">
      @csrf
      <div class="col-md-6">
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">NIP</label>
        <input type="text" name="nip" class="form-control" value="{{ old('nip') }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Divisi</label>
        <input type="text" name="division" class="form-control" value="{{ old('division') }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Jabatan</label>
        <input type="text" name="position" class="form-control" value="{{ old('position') }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Telepon</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Tanggal Bergabung</label>
        <input type="date" name="join_date" class="form-control" value="{{ old('join_date') }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Status</label>
        <input type="text" name="status" class="form-control" value="{{ old('status') }}" placeholder="Aktif / Nonaktif">
      </div>
      <div class="col-12 d-flex gap-2">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.karyawan.index') }}" class="btn btn-light">Batal</a>
      </div>
    </form>
  </div>
</div>
@endsection
