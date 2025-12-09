@extends('layouts.metronic')
@php($title = 'Hapus Karyawan')
@section('content')
<div class="card border-0 shadow-sm">
  <div class="card-body">
    <h5 class="mb-3">Hapus Karyawan</h5>
    <p>Yakin ingin menghapus karyawan ini? Tindakan tidak dapat dibatalkan.</p>
    <form action="{{ route('admin.karyawan.destroy', request()->route('karyawan')) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">Hapus</button>
      <a href="{{ route('admin.karyawan.index') }}" class="btn btn-light">Batal</a>
    </form>
  </div>
</div>
@endsection
