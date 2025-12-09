@extends('layouts.karyawan')
@php($title = 'Dashboard')
@section('content')
<div class="row g-3">
  <div class="col-md-4">
    <div class="card border-0 shadow-sm"><div class="card-body">
      <div class="text-secondary small">Status Absensi Hari Ini</div>
      <div class="fs-4 fw-bold">{{ $attendanceToday? strtoupper($attendanceToday->status) : 'BELUM ABSEN' }}</div>
    </div></div>
  </div>
  <div class="col-md-4">
    <a href="{{ route('karyawan.absensi.index') }}" class="text-decoration-none text-reset">
      <div class="card border-0 shadow-sm"><div class="card-body">
        <div class="text-secondary small">Absensi</div>
        <div class="fs-4 fw-bold">Check-in / Check-out</div>
      </div></div>
    </a>
  </div>
  <div class="col-md-4">
    <a href="{{ route('karyawan.cuti.ajukan') }}" class="text-decoration-none text-reset">
      <div class="card border-0 shadow-sm"><div class="card-body">
        <div class="text-secondary small">Cuti</div>
        <div class="fs-4 fw-bold">Ajukan Cuti</div>
      </div></div>
    </a>
  </div>
</div>
@endsection

