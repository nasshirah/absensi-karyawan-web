@extends('layouts.metronic')
@php($title = 'Data Absensi')
@section('content')
<div class="card border-0 shadow-sm">
  <div class="card-body">
    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
      <h5 class="mb-0">Data Absensi</h5>
      <form method="GET" action="{{ route('admin.absensi.index') }}" class="d-flex flex-wrap gap-2">
        <input type="text" name="q" class="form-control form-control-sm" placeholder="Cari nama/email" value="{{ $q }}">
        <select name="month" class="form-select form-select-sm">
          @for ($m=1; $m<=12; $m++)
            <option value="{{ $m }}" {{ $m==$month?'selected':'' }}>{{ str_pad($m,2,'0',STR_PAD_LEFT) }}</option>
          @endfor
        </select>
        <select name="year" class="form-select form-select-sm">
          @for ($y=date('Y')-2; $y<=date('Y')+1; $y++)
            <option value="{{ $y }}" {{ $y==$year?'selected':'' }}>{{ $y }}</option>
          @endfor
        </select>
        <button class="btn btn-outline-secondary btn-sm" type="submit">Filter</button>
      </form>
    </div>

    <div class="table-responsive">
      <table class="table table-sm align-middle">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>Status</th>
            <th>Masuk</th>
            <th>Pulang</th>
            <th>Telat (menit)</th>
            <th>Catatan</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($items as $row)
            <tr>
              <td>{{ \Illuminate\Support\Carbon::parse($row->date)->format('d/m/Y') }}</td>
              <td>{{ $row->user->name }}</td>
              <td>{{ ucfirst($row->status) }}</td>
              <td>{{ $row->check_in ? \Illuminate\Support\Carbon::parse($row->check_in)->format('H:i') : '-' }}</td>
              <td>{{ $row->check_out ? \Illuminate\Support\Carbon::parse($row->check_out)->format('H:i') : '-' }}</td>
              <td>{{ $row->minutes_late }}</td>
              <td>{{ $row->notes }}</td>
            </tr>
          @empty
            <tr><td colspan="7" class="text-center text-muted">Tidak ada data untuk periode ini.</td></tr>
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
