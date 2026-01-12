<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KaryawanExport implements FromCollection, WithHeadings, WithMapping
{
    protected $query;

    public function __construct($query = null)
    {
        $this->query = $query;
    }

    public function collection()
    {
        $q = $this->query;
        return User::role('karyawan')
            ->when($q, fn($query) => $query->where(fn($sub) => $sub->where('name','like',"%{$q}%")->orWhere('email','like',"%{$q}%")))
            ->orderBy('name')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'NIP',
            'Nama',
            'Email',
            'Divisi',
            'Jabatan',
            'Telepon',
            'Tanggal Bergabung',
            'Status',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->nip,
            $user->name,
            $user->email,
            $user->division,
            $user->position,
            $user->phone,
            $user->join_date,
            $user->status,
        ];
    }
}
