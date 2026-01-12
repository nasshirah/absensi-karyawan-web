<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Carbon;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping
{
    protected $month;
    protected $year;
    protected $q;

    public function __construct($month, $year, $q = '')
    {
        $this->month = $month;
        $this->year = $year;
        $this->q = $q;
    }

    public function collection()
    {
        $start = Carbon::createFromDate($this->year, $this->month, 1)->startOfMonth();
        $end = (clone $start)->endOfMonth();

        return Attendance::with('user')
            ->whereBetween('date', [$start->toDateString(), $end->toDateString()])
            ->when($this->q, fn($qBuilder) => $qBuilder->whereHas('user', function($u) {
                $u->where('name','like',"%{$this->q}%")->orWhere('email','like',"%{$this->q}%");
            }))
            ->orderByDesc('date')
            ->orderBy('user_id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama Karyawan',
            'Email',
            'Divisi',
            'Status',
            'Jam Masuk',
            'Jam Keluar',
            'Keterlambatan (menit)',
            'Catatan',
        ];
    }

    public function map($row): array
    {
        return [
            Carbon::parse($row->date)->format('d-m-Y'),
            $row->user->name,
            $row->user->email,
            $row->user->division,
            $row->status,
            $row->check_in,
            $row->check_out,
            $row->minutes_late,
            $row->notes,
        ];
    }
}
