<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();
        $attendanceToday = Attendance::where('user_id', $user->id)->whereDate('date', $today)->first();

        return view('karyawan.dashboard', [
            'title' => 'Dashboard',
            'attendanceToday' => $attendanceToday,
        ]);
    }
}

