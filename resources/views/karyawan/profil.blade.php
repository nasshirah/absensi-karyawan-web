@extends('layouts.karyawan')
@php($title = 'Profil')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body">
  <h5 class="mb-3">Profil</h5>
  <form method="POST" action="{{ route('karyawan.profil.update') }}" class="row g-3">
    @csrf
    <div class="col-md-6">
      <label class="form-label">Nama</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" class="form-control" value="{{ $user->email }}" disabled>
    </div>
    <div class="col-md-4">
      <label class="form-label">Telepon</label>
      <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
    </div>
    <div class="col-md-4">
      <label class="form-label">Divisi</label>
      <input type="text" name="division" class="form-control" value="{{ old('division', $user->division) }}">
    </div>
    <div class="col-md-4">
      <label class="form-label">Jabatan</label>
      <input type="text" name="position" class="form-control" value="{{ old('position', $user->position) }}">
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div></div>
@endsection

