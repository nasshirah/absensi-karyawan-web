<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Karyawan' }} · Absensi Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/metronic-lite.css') }}">
</head>
<body>
<div class="d-flex min-vh-100">
    <aside class="app-aside">
        <div class="aside-header">
            <span class="brand">Karyawan</span>
        </div>
        <nav class="aside-nav">
            <a class="nav-link {{ request()->routeIs('karyawan.dashboard') ? 'active' : '' }}" href="{{ route('karyawan.dashboard') }}">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span>
            </a>
            <a class="nav-link {{ request()->routeIs('karyawan.absensi.index') ? 'active' : '' }}" href="{{ route('karyawan.absensi.index') }}">
                <i class="fa-solid fa-fingerprint"></i>
                <span>Absensi</span>
            </a>
            <a class="nav-link {{ request()->routeIs('karyawan.absensi.riwayat') ? 'active' : '' }}" href="{{ route('karyawan.absensi.riwayat') }}">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>Riwayat Absensi</span>
            </a>
            <a class="nav-link {{ request()->routeIs('karyawan.cuti.ajukan') ? 'active' : '' }}" href="{{ route('karyawan.cuti.ajukan') }}">
                <i class="fa-solid fa-plane-departure"></i>
                <span>Ajukan Cuti</span>
            </a>
            <a class="nav-link {{ request()->routeIs('karyawan.cuti.riwayat') ? 'active' : '' }}" href="{{ route('karyawan.cuti.riwayat') }}">
                <i class="fa-solid fa-list"></i>
                <span>Riwayat Cuti</span>
            </a>
            <a class="nav-link {{ request()->routeIs('karyawan.profil') ? 'active' : '' }}" href="{{ route('karyawan.profil') }}">
                <i class="fa-solid fa-user"></i>
                <span>Profil</span>
            </a>
            <form class="mt-3" action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="nav-link btn btn-link text-start w-100" type="submit">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Logout</span>
                </button>
            </form>
        </nav>
    </aside>
    <main class="flex-grow-1 app-main">
        <header class="app-topbar d-flex align-items-center justify-content-between">
            <div class="fw-semibold">{{ $title ?? 'Karyawan' }}</div>
            <div class="small text-muted">{{ auth()->user()->name ?? '' }}</div>
        </header>
        <div class="app-content container-fluid py-4">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="fw-semibold mb-1">Terjadi kesalahan:</div>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

