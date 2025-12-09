@extends('layouts.karyawan')
@php($title = 'Absensi')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body">
  <h5 class="mb-3">Absensi Hari Ini</h5>
  <div class="mb-2">Tanggal: <strong>{{ \Illuminate\Support\Carbon::parse($today)->format('d/m/Y') }}</strong></div>
  <div class="mb-3">Status: <strong>{{ $attendance->exists && $attendance->check_in ? strtoupper($attendance->status) : 'BELUM ABSEN' }}</strong></div>

  <div class="d-flex gap-2">
    <form action="{{ route('karyawan.absensi.checkin') }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-success" {{ ($attendance->exists && $attendance->check_in) ? 'disabled' : '' }}>Check-in</button>
    </form>
    <form action="{{ route('karyawan.absensi.checkout') }}" method="POST">
      @csrf
      <button type="submit" class="btn btn-danger" {{ (!$attendance->exists || !$attendance->check_in || $attendance->check_out) ? 'disabled' : '' }}>Check-out</button>
    </form>
  </div>
  @if ($attendance->exists)
  <div class="mt-3">
    <div>Jam Masuk: <strong>{{ $attendance->check_in ? \Illuminate\Support\Carbon::parse($attendance->check_in)->format('H:i') : '-' }}</strong></div>
    <div>Jam Pulang: <strong>{{ $attendance->check_out ? \Illuminate\Support\Carbon::parse($attendance->check_out)->format('H:i') : '-' }}</strong></div>
    <div>Telat (menit): <strong>{{ $attendance->minutes_late }}</strong></div>
  </div>
  @endif
</div></div>
@endsection

