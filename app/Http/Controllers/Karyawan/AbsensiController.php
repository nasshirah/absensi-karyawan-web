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
        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $attendance = Attendance::firstOrNew([
            'user_id' => $user->id,
            'date' => $today,
        ]);

        return view('karyawan.absensi.index', compact('attendance', 'today'));
    }

    public function checkIn(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now('Asia/Jakarta');
        $today = $now->toDateString();
        $attendance = Attendance::firstOrNew(['user_id' => $user->id, 'date' => $today]);

        if ($attendance->exists && $attendance->check_in) {
            return back()->with('success', 'Sudah absen masuk.');
        }

        $attendance->check_in = $now->format('H:i:s');
        
        // Jam masuk: 09:00:00 Strict
        $limitIn = Carbon::createFromFormat('Y-m-d H:i:s', $today . ' 09:00:00', 'Asia/Jakarta');

        if ($now->greaterThan($limitIn)) {
            $attendance->status = 'LATE';
            $attendance->minutes_late = $limitIn->diffInMinutes($now);
        } else {
            $attendance->status = 'ON TIME';
            $attendance->minutes_late = 0;
        }
        
        $attendance->overtime_minutes = 0; // Initialize
        $attendance->save();

        return back()->with('success', 'Berhasil absen masuk.');
    }

    public function checkOut(Request $request)
    {
        $user = Auth::user();
        $now = Carbon::now('Asia/Jakarta');
        $today = $now->toDateString();
        $attendance = Attendance::where('user_id', $user->id)->whereDate('date', $today)->first();

        if (!$attendance || !$attendance->check_in) {
            return back()->withErrors('Belum absen masuk.');
        }
        if ($attendance->check_out) {
            return back()->with('success', 'Sudah absen pulang.');
        }

        $attendance->check_out = $now->format('H:i:s');
        
        // Jam pulang: 17:00:00 Strict
        $limitOut = Carbon::createFromFormat('Y-m-d H:i:s', $today . ' 17:00:00', 'Asia/Jakarta');

        if ($now->greaterThan($limitOut)) {
            // Calculate overtime
            $overtime = $limitOut->diffInMinutes($now);
            $attendance->overtime_minutes = $overtime;
            
            // Append Status
            // Current status could be 'ON TIME' or 'LATE'
            $attendance->status = $attendance->status . ' + OVERTIME';
        } else {
            $attendance->overtime_minutes = 0;
            // Status Pulang = NORMAL (No change to main string, or maybe append + NORMAL?)
            // Requirement 10 example: "LATE" (alone) implies Late in, Normal out.
            // Requirement 11: "LATE + OVERTIME".
            // So we do not append anything if Normal.
        }
        
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

    public function destroy(Attendance $attendance)
    {
        $user = Auth::user();
        
        // Only allow deletion of own attendance records
        if ($attendance->user_id !== $user->id) {
            return back()->withErrors('Anda tidak memiliki akses untuk menghapus data ini.');
        }

        $attendance->delete();
        return back()->with('success', 'Data absensi berhasil dihapus.');
    }
}

