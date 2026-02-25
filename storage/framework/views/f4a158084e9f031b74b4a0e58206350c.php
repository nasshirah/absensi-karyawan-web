<!DOCTYPE html>
<html>
<head>
    <title>Laporan Cuti</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h1 { margin: 0; font-size: 16px; color: #1a5c8e; }
        .header p { margin: 5px 0 0; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: left; }
        th { background-color: #f8f9fa; font-weight: bold; color: #1a5c8e; }
        .badge { padding: 2px 4px; border-radius: 3px; font-size: 8px; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PENGAJUAN CUTI</h1>
        <p>Status: <?php echo e($status ? ucfirst($status) : 'Semua Status'); ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="15%">Karyawan</th>
                <th width="12%">Jenis</th>
                <th width="10%">Mulai</th>
                <th width="10%">Selesai</th>
                <th width="5%">Hari</th>
                <th width="20%">Alasan</th>
                <th width="10%">Status</th>
                <th width="18%">Reviewer</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($leave->user->name); ?></td>
                <td><?php echo e(ucfirst($leave->type)); ?></td>
                <td class="text-center"><?php echo e($leave->start_date->format('d/m/Y')); ?></td>
                <td class="text-center"><?php echo e($leave->end_date->format('d/m/Y')); ?></td>
                <td class="text-center"><?php echo e($leave->days); ?></td>
                <td><?php echo e($leave->reason); ?></td>
                <td class="text-center"><?php echo e(ucfirst($leave->status)); ?></td>
                <td><?php echo e($leave->reviewer->name ?? '-'); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <p style="text-align: right; font-size: 9px;">Dicetak pada: <?php echo e(now()->format('d M Y H:i')); ?></p>
</body>
</html>
<?php /**PATH C:\laragon\www\Absensi_Karyawan\resources\views/admin/exports/cuti.blade.php ENDPATH**/ ?>