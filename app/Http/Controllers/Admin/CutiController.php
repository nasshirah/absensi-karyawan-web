<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    const MAX_CUTI_TAHUNAN = 12;

    public function index(Request $request)
    {
        $status = $request->input('status');

        $items = LeaveRequest::with(['user','reviewer'])
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        // 🔴 WAJIB: inject sisa cuti
        $this->injectSisaCuti($items);

        return view('admin.cuti.index', compact('items','status'));
    }

    public function pending()
    {
        $items = LeaveRequest::with('user')
            ->where('status', 'pending')
            ->orderBy('start_date')
            ->paginate(20);

        // 🔴 WAJIB: inject sisa cuti
        $this->injectSisaCuti($items);

        return view('admin.cuti.pending', compact('items'));
    }

    public function review(LeaveRequest $leaveRequest)
    {
        return view('admin.cuti.review', [
            'leave'    => $leaveRequest,
            'usedDays' => $this->usedLeaveDaysThisYear($leaveRequest->user_id),
            'maxDays'  => self::MAX_CUTI_TAHUNAN,
        ]);
    }

    public function process(Request $request, LeaveRequest $leaveRequest)
    {
        $data = $request->validate([
            'action' => 'required|in:approve,reject',
            'reviewed_reason' => 'nullable|string|max:2000',
        ]);

        $totalDays = Carbon::parse($leaveRequest->start_date)
            ->diffInDays(Carbon::parse($leaveRequest->end_date)) + 1;

        if ($data['action'] === 'approve') {

            $used = $this->usedLeaveDaysThisYear($leaveRequest->user_id);

            if (($used + $totalDays) > self::MAX_CUTI_TAHUNAN) {
                return back()->withErrors([
                    'limit' => 'Jatah cuti karyawan telah melebihi '
                        . self::MAX_CUTI_TAHUNAN
                        . ' hari. Sisa: '
                        . max(0, self::MAX_CUTI_TAHUNAN - $used)
                        . ' hari.'
                ]);
            }

            $leaveRequest->status = 'approved';
        } else {
            $leaveRequest->status = 'rejected';
        }

        $leaveRequest->reviewed_by = Auth::id();
        $leaveRequest->reviewed_reason = $data['reviewed_reason'] ?? null;
        $leaveRequest->reviewed_at = now();
        $leaveRequest->save();

        return redirect()
            ->route('admin.cuti.pending')
            ->with('success', 'Pengajuan cuti berhasil diperbarui.');
    }

    public function destroy(LeaveRequest $leaveRequest)
    {
        $leaveRequest->delete();

        return back()->with('success', 'Data cuti berhasil dihapus.');
    }

    // ===============================
    // HELPER: HITUNG CUTI TERPAKAI
    // ===============================
    private function usedLeaveDaysThisYear($userId)
    {
        return LeaveRequest::where('user_id', $userId)
            ->where('status', 'approved')
            ->whereYear('start_date', date('Y'))
            ->get()
            ->sum(function ($leave) {
                return Carbon::parse($leave->start_date)
                    ->diffInDays(Carbon::parse($leave->end_date)) + 1;
            });
    }

    // ===============================
    // HELPER: INJECT SISA CUTI
    // ===============================
    private function injectSisaCuti($items)
    {
        foreach ($items as $leave) {
            $used = $this->usedLeaveDaysThisYear($leave->user_id);
            $leave->sisa_cuti = max(0, self::MAX_CUTI_TAHUNAN - $used);
        }
    }

    public function exportExcel(Request $request)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\CutiExport($request->status), 'data-cuti.xlsx');
    }

    public function exportPdf(Request $request)
    {
        $status = $request->status;
        $items = \App\Models\LeaveRequest::with(['user','reviewer'])
            ->when($status, function ($q) use ($status) {
                $q->where('status', $status);
            })
            ->orderByDesc('created_at')
            ->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.exports.cuti', [
            'items' => $items,
            'status' => $status,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('data-cuti.pdf');
    }
}
