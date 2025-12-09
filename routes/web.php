<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\CutiController;
use App\Http\Controllers\Karyawan\DashboardController as KaryawanDashboardController;
use App\Http\Controllers\Karyawan\AbsensiController as KaryawanAbsensiController;
use App\Http\Controllers\Karyawan\CutiController as KaryawanCutiController;
use App\Http\Controllers\Karyawan\ProfilController as KaryawanProfilController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/dashboard', function () {
    return "Selamat datang di Dashboard!";
})->middleware('auth');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Contoh route terproteksi role
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Data Karyawan (CRUD)
    Route::get('/admin/karyawan', [KaryawanController::class, 'index'])->name('admin.karyawan.index');
    Route::get('/admin/karyawan/tambah', [KaryawanController::class, 'create'])->name('admin.karyawan.create');
    Route::post('/admin/karyawan', [KaryawanController::class, 'store'])->name('admin.karyawan.store');
    Route::get('/admin/karyawan/{karyawan}/edit', [KaryawanController::class, 'edit'])->name('admin.karyawan.edit');
    Route::put('/admin/karyawan/{karyawan}', [KaryawanController::class, 'update'])->name('admin.karyawan.update');
    Route::delete('/admin/karyawan/{karyawan}', [KaryawanController::class, 'destroy'])->name('admin.karyawan.destroy');
    // Data Absensi (Views + filter)
    Route::get('/admin/absensi', [AbsensiController::class, 'index'])->name('admin.absensi.index');
    Route::get('/admin/absensi/per-karyawan', [AbsensiController::class, 'perKaryawan'])->name('admin.absensi.per-karyawan');
    Route::get('/admin/absensi/per-tanggal', [AbsensiController::class, 'perTanggal'])->name('admin.absensi.per-tanggal');
    Route::get('/admin/absensi/filter', [AbsensiController::class, 'filter'])->name('admin.absensi.filter');
    // Persetujuan Cuti + Data Cuti
    Route::get('/admin/cuti/persetujuan', [CutiController::class, 'pending'])->name('admin.cuti.approval');
    Route::get('/admin/cuti/pending', [CutiController::class, 'pending'])->name('admin.cuti.pending');
    Route::get('/admin/cuti/review/{leaveRequest}', [CutiController::class, 'review'])->name('admin.cuti.review');
    Route::post('/admin/cuti/review/{leaveRequest}', [CutiController::class, 'process'])->name('admin.cuti.process');
    Route::get('/admin/cuti', [CutiController::class, 'index'])->name('admin.cuti.index');
    Route::view('/admin/cuti/riwayat', 'admin.cuti.riwayat')->name('admin.cuti.riwayat');
    Route::view('/admin/cuti/jenis', 'admin.cuti.jenis')->name('admin.cuti.jenis');
    Route::view('/admin/cuti/sisa', 'admin.cuti.sisa')->name('admin.cuti.sisa');
    Route::view('/admin/laporan', 'admin.laporan.index')->name('admin.laporan.index');
    Route::view('/admin/laporan/absensi-bulanan', 'admin.laporan.absensi-bulanan')->name('admin.laporan.absensi-bulanan');
    Route::view('/admin/laporan/cuti', 'admin.laporan.cuti')->name('admin.laporan.cuti');
    Route::view('/admin/laporan/keterlambatan', 'admin.laporan.keterlambatan')->name('admin.laporan.keterlambatan');
    Route::view('/admin/laporan/export', 'admin.laporan.export')->name('admin.laporan.export');
    Route::view('/admin/pengaturan', 'admin.pengaturan.index')->name('admin.pengaturan.index');
    Route::view('/admin/pengaturan/jam-kerja', 'admin.pengaturan.jam-kerja')->name('admin.pengaturan.jam-kerja');
    Route::view('/admin/pengaturan/jatah-cuti', 'admin.pengaturan.jatah-cuti')->name('admin.pengaturan.jatah-cuti');
    Route::view('/admin/pengaturan/hak-akses', 'admin.pengaturan.hak-akses')->name('admin.pengaturan.hak-akses');

    // Dashboard subpages
    Route::get('/admin/dashboard/hari-ini', [AdminDashboardController::class, 'today'])->name('admin.dashboard.today');
    Route::get('/admin/dashboard/telat', [AdminDashboardController::class, 'telat'])->name('admin.dashboard.telat');
    Route::view('/admin/dashboard/grafik', 'admin.dashboard.grafik')->name('admin.dashboard.grafik');
});

// Area Karyawan
Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/karyawan/dashboard', [KaryawanDashboardController::class, 'index'])->name('karyawan.dashboard');

    // Absensi
    Route::get('/karyawan/absensi', [KaryawanAbsensiController::class, 'index'])->name('karyawan.absensi.index');
    Route::post('/karyawan/absensi/check-in', [KaryawanAbsensiController::class, 'checkIn'])->name('karyawan.absensi.checkin');
    Route::post('/karyawan/absensi/check-out', [KaryawanAbsensiController::class, 'checkOut'])->name('karyawan.absensi.checkout');
    Route::get('/karyawan/absensi/riwayat', [KaryawanAbsensiController::class, 'riwayat'])->name('karyawan.absensi.riwayat');

    // Cuti
    Route::get('/karyawan/cuti/ajukan', [KaryawanCutiController::class, 'ajukan'])->name('karyawan.cuti.ajukan');
    Route::post('/karyawan/cuti/ajukan', [KaryawanCutiController::class, 'store'])->name('karyawan.cuti.store');
    Route::get('/karyawan/cuti/riwayat', [KaryawanCutiController::class, 'riwayat'])->name('karyawan.cuti.riwayat');

    // Profil
    Route::get('/karyawan/profil', [KaryawanProfilController::class, 'index'])->name('karyawan.profil');
    Route::post('/karyawan/profil', [KaryawanProfilController::class, 'update'])->name('karyawan.profil.update');
});

Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/karyawan', function () {
        return 'Area Karyawan';
    });
});
