<?php

namespace App\Exports;

use App\Models\LeaveRequest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Carbon;

class CutiExport implements FromCollection, WithHeadings, WithMapping
{
    protected $status;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    public function collection()
    {
        return LeaveRequest::with(['user','reviewer'])
            ->when($this->status, function ($q) {
                $q->where('status', $this->status);
            })
            ->orderByDesc('created_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama Karyawan',
            'Divisi',
            'Jenis Cuti',
            'Mulai',
            'Selesai',
            'Durasi (hari)',
            'Alasan',
            'Status',
            'Reviewer',
            'Catatan Review',
        ];
    }

    public function map($leave): array
    {
        return [
            $leave->user->name,
            $leave->user->division,
            ucfirst($leave->type),
            $leave->start_date->format('d-m-Y'),
            $leave->end_date->format('d-m-Y'),
            $leave->days,
            $leave->reason,
            ucfirst($leave->status),
            $leave->reviewer->name ?? '-',
            $leave->reviewed_reason ?? '-',
        ];
    }
}
