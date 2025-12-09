<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today()->toDateString();
        $attendance = Attendance::firstOrNew([
            'user_id' => $user->id,
            'date' => $today,
        ]);

        return view('karyawan.absensi.index', compact('attendance', 'today'));
    }

    public function checkIn(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now();
        $today = $now->toDateString();
        $attendance = Attendance::firstOrNew(['user_id' => $user->id, 'date' => $today]);

        if ($attendance->exists && $attendance->check_in) {
            return back()->with('success', 'Sudah absen masuk.');
        }

        $attendance->check_in = $now->format('H:i:s');
        // aturan sederhana: telat jika setelah 08:00
        $startWork = Carbon::parse($today.' 08:00:00');
        if ($now->greaterThan($startWork)) {
            $attendance->status = 'late';
            $attendance->minutes_late = $startWork->diffInMinutes($now);
        } else {
            $attendance->status = 'present';
            $attendance->minutes_late = 0;
        }
        $attendance->save();

        return back()->with('success', 'Berhasil absen masuk.');
    }

    public function checkOut(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now();
        $today = $now->toDateString();
        $attendance = Attendance::where('user_id', $user->id)->whereDate('date', $today)->first();

        if (!$attendance || !$attendance->check_in) {
            return back()->withErrors('Belum absen masuk.');
        }
        if ($attendance->check_out) {
            return back()->with('success', 'Sudah absen pulang.');
        }

        $attendance->check_out = $now->format('H:i:s');
        $attendance->save();

        return back()->with('success', 'Berhasil absen pulang.');
    }

    public function riwayat(Request $request)
    {
        $user = Auth::user();
        $month = (int)($request->input('month') ?: date('m'));
        $year = (int)($request->input('year') ?: date('Y'));
        $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end = (clone $start)->endOfMonth();

        $items = Attendance::where('user_id', $user->id)
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->orderBy('date')
            ->get();

        return view('karyawan.absensi.riwayat', compact('items','month','year'));
    }
}

