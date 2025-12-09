<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $items = LeaveRequest::with(['user','reviewer'])
            ->when($status, fn($q) => $q->where('status', $status))
            ->orderByDesc('created_at')
            ->paginate(20)->withQueryString();
        return view('admin.cuti.index', compact('items','status'));
    }

    public function pending()
    {
        $items = LeaveRequest::with('user')
            ->where('status', 'pending')
            ->orderBy('start_date')
            ->paginate(20);
        return view('admin.cuti.pending', compact('items'));
    }

    public function review(LeaveRequest $leaveRequest)
    {
        return view('admin.cuti.review', ['leave' => $leaveRequest]);
    }

    public function process(Request $request, LeaveRequest $leaveRequest)
    {
        $data = $request->validate([
            'action' => 'required|in:approve,reject',
            'reviewed_reason' => 'nullable|string|max:2000',
        ]);

        $leaveRequest->status = $data['action'] === 'approve' ? 'approved' : 'rejected';
        $leaveRequest->reviewed_by = Auth::id();
        $leaveRequest->reviewed_reason = $data['reviewed_reason'] ?? null;
        $leaveRequest->reviewed_at = Carbon::now();
        $leaveRequest->save();

        return redirect()->route('admin.cuti.pending')->with('success', 'Pengajuan cuti telah diperbarui.');
    }
}

