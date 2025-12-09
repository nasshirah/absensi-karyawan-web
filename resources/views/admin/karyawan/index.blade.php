@extends('layouts.metronic')
@php($title = 'Data Karyawan')
@section('content')
<div class="card border-0 shadow-sm">
  <div class="card-body">
    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center mb-3">
      <h5 class="mb-0">Data Karyawan</h5>
      <div class="d-flex gap-2">
        <form action="{{ route('admin.karyawan.index') }}" method="GET" class="d-flex gap-2">
          <input type="text" class="form-control form-control-sm" placeholder="Cari nama/email" name="q" value="{{ $q }}" />
          <button class="btn btn-outline-secondary btn-sm" type="submit">Cari</button>
        </form>
        <a href="{{ route('admin.karyawan.create') }}" class="btn btn-primary btn-sm">Tambah Karyawan</a>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-sm align-middle">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Divisi</th>
            <th>Jabatan</th>
            <th>Bergabung</th>
            <th style="width:150px">Aksi</th>
          </tr>
        </thead>
        <tbody>
        @forelse($users as $u)
          <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->division ?? '-' }}</td>
            <td>{{ $u->position ?? '-' }}</td>
            <td>{{ $u->join_date ? \Illuminate\Support\Carbon::parse($u->join_date)->format('d M Y') : '-' }}</td>
            <td>
              <a href="{{ route('admin.karyawan.edit', $u) }}" class="btn btn-warning btn-xs btn-sm">Edit</a>
              <form action="{{ route('admin.karyawan.destroy', $u) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus karyawan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-xs btn-sm">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="text-center text-muted">Belum ada data.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>
    <div>
      {{ $users->links() }}
    </div>
  </div>
</div>
@endsection
