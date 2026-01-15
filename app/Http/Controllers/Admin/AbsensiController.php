<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $month = (int)($request->input('month') ?: date('m'));
        $year = (int)($request->input('year') ?: date('Y'));
        $q = trim((string)$request->input('q',''));

        $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end = (clone $start)->endOfMonth();

        $items = Attendance::with('user')
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->when($q, fn($qBuilder) => $qBuilder->whereHas('user', function($u) use ($q) {
                $u->where('name','like',"%{$q}%")->orWhere('email','like',"%{$q}%");
            }))
            ->orderByDesc('date')
            ->orderBy('user_id')
            ->paginate(20)->withQueryString();

        return view('admin.absensi.index', [
            'items' => $items,
            'month' => $month,
            'year' => $year,
            'q' => $q,
        ]);
    }

    public function perKaryawan(Request $request)
    {
        $users = User::role('karyawan')->orderBy('name')->get();
        $userId = (int)($request->input('user_id') ?: ($users->first()->id ?? 0));
        $month = (int)($request->input('month') ?: date('m'));
        $year = (int)($request->input('year') ?: date('Y'));

        $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end = (clone $start)->endOfMonth();

        $records = collect();
        $user = null;
        if ($userId) {
            $user = User::find($userId);
            $records = Attendance::where('user_id', $userId)
                ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
                ->orderBy('date')
                ->get();
        }

        return view('admin.absensi.per-karyawan', compact('users','user','userId','month','year','records'));
    }

    public function perTanggal(Request $request)
    {
        $date = $request->input('date') ?: date('Y-m-d');
        $items = Attendance::with('user')
            ->whereDate('date', $date)
            ->orderBy('user_id')
            ->get();

        return view('admin.absensi.per-tanggal', compact('date','items'));
    }

    public function filter(Request $request)
    {
        $division = (string)$request->input('division', '');
        $month = (int)($request->input('month') ?: date('m'));
        $year = (int)($request->input('year') ?: date('Y'));

        $start = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end = (clone $start)->endOfMonth();

        $items = Attendance::with(['user'])
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->when($division !== '', fn($q) => $q->whereHas('user', fn($u) => $u->where('division', $division)))
            ->orderBy('date')
            ->paginate(20)->withQueryString();

        $divisions = User::role('karyawan')->whereNotNull('division')->distinct()->pluck('division');

        return view('admin.absensi.filter', [
            'items' => $items,
            'division' => $division,
            'divisions' => $divisions,
            'month' => $month,
            'year' => $year,
        ]);
    }

    public function exportExcel(Request $request)
    {
        $month = $request->month ?? date('m');
        $year = $request->year ?? date('Y');
        $q = $request->q;
        
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\AbsensiExport($month, $year, $q), "absensi-{$month}-{$year}.xlsx");
    }

    public function exportPdf(Request $request)
    {
        $month = $request->month ?? date('m');
        $year = $request->year ?? date('Y');
        $q = $request->q;

        $start = \Illuminate\Support\Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $end = (clone $start)->endOfMonth();

        $items = \App\Models\Attendance::with('user')
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->when($q, fn($qBuilder) => $qBuilder->whereHas('user', function($u) use ($q) {
                $u->where('name','like',"%{$q}%")->orWhere('email','like',"%{$q}%");
            }))
            ->orderByDesc('date')
            ->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.exports.absensi', [
            'items' => $items,
            'month' => $month,
            'year' => $year,
        ])->setPaper('a4', 'landscape');

        return $pdf->download("absensi-{$month}-{$year}.pdf");
    }
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return redirect()->back()->with('success', 'Data absensi berhasil dihapus.');
    }
}

