<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Attendance;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        $totalKaryawan = User::role('karyawan')->count();
        $presentToday = Attendance::whereDate('date', $today)
            ->whereIn('status', ['present','late','leave'])
            ->count();
        $lateToday = Attendance::whereDate('date', $today)
            ->where('status', 'late')
            ->count();
        $absentToday = max($totalKaryawan - $presentToday, 0);

        $stats = [
            'total_users' => User::count(),
            'admins' => User::role('admin')->count(),
            'karyawans' => $totalKaryawan,
            'roles' => Role::count(),
            'permissions' => Permission::count(),
            'present_today' => $presentToday,
            'late_today' => $lateToday,
            'absent_today' => $absentToday,
        ];

        return view('admin.dashboard', [
            'title' => 'Admin Dashboard',
            'stats' => $stats,
        ]);
    }

    public function today()
    {
        $today = Carbon::today()->toDateString();
        $items = Attendance::with('user')
            ->whereDate('date', $today)
            ->whereIn('status', ['present','late'])
            ->orderBy('status')
            ->orderBy('check_in')
            ->get();

        return view('admin.dashboard.today', [
            'title' => 'Karyawan Hadir Hari Ini',
            'today' => $today,
            'items' => $items,
        ]);
    }

    public function telat()
    {
        $today = Carbon::today()->toDateString();
        $karyawanIds = User::role('karyawan')->pluck('id');
        $attendanceToday = Attendance::whereDate('date', $today)->get();

        $late = $attendanceToday->where('status', 'late')->values();
        $presentIds = $attendanceToday->pluck('user_id')->unique();
        $notPresentIds = $karyawanIds->diff($presentIds);
        $notPresent = User::whereIn('id', $notPresentIds)->orderBy('name')->get();

        return view('admin.dashboard.telat', [
            'title' => 'Telat / Tidak Hadir',
            'today' => $today,
            'late' => $late,
            'notPresent' => $notPresent,
        ]);
    }
}
