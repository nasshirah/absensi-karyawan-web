<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 16px; color: #1a5c8e; }
        .header p { margin: 5px 0 0; color: #666; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f8f9fa; font-weight: bold; color: #1a5c8e; }
        .text-center { text-align: center; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: right; font-size: 9px; color: #999; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN KEHADIRAN KARYAWAN</h1>
        <p>Periode: {{ \Carbon\Carbon::create()->month($month)->locale('id')->isoFormat('MMMM') }} {{ $year }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="10%">Tanggal</th>
                <th width="20%">Nama Karyawan</th>
                <th width="15%">Divisi</th>
                <th width="10%">Status</th>
                <th width="10%">Masuk</th>
                <th width="10%">Keluar</th>
                <th width="5%">Telat</th>
                <th width="20%">Catatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $row)
            <tr>
                <td>{{ \Carbon\Carbon::parse($row->date)->format('d-m-Y') }}</td>
                <td>{{ $row->user->name }}</td>
                <td>{{ $row->user->division ?? '-' }}</td>
                <td class="text-center">{{ ucfirst($row->status) }}</td>
                <td class="text-center">{{ $row->check_in ? \Carbon\Carbon::parse($row->check_in)->format('H:i') : '-' }}</td>
                <td class="text-center">{{ $row->check_out ? \Carbon\Carbon::parse($row->check_out)->format('H:i') : '-' }}</td>
                <td class="text-center">{{ $row->minutes_late ? $row->minutes_late.'m' : '-' }}</td>
                <td>{{ $row->notes ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: {{ now()->format('d M Y H:i') }}
    </div>
</body>
</html>
