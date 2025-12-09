<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    public function ajukan()
    {
        return view('karyawan.cuti.ajukan');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|string|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string',
        ]);

        $start = Carbon::parse($data['start_date']);
        $end = Carbon::parse($data['end_date']);
        $days = $start->diffInDays($end) + 1;

        LeaveRequest::create([
            'user_id' => Auth::id(),
            'type' => $data['type'],
            'start_date' => $start,
            'end_date' => $end,
            'days' => $days,
            'reason' => $data['reason'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('karyawan.cuti.riwayat')->with('success', 'Pengajuan cuti dikirim.');
    }

    public function riwayat()
    {
        $items = LeaveRequest::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('karyawan.cuti.riwayat', compact('items'));
    }
}

