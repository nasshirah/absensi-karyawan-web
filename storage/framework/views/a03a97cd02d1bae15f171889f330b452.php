
<?php ($title = 'Riwayat Absensi'); ?>
<?php $__env->startSection('content'); ?>

<style>
    .premium-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); /* Soft, premium shadow */
        border: 1px solid rgba(0,0,0,0.04);
        overflow: hidden;
    }
    
    .card-header-custom {
        padding: 24px 32px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #fff;
    }

    .page-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        letter-spacing: -0.5px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .filter-group .form-select {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 10px 40px 10px 16px; /* Increased right padding for arrow */
        font-size: 0.9rem;
        font-weight: 500;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s;
        line-height: 1.5;
        background-position: right 1rem center; /* Adjust arrow position */
    }

    .filter-group .form-select:hover {
        border-color: #cbd5e1;
    }

    .filter-group .form-select:focus {
        border-color: #A04ACF;
        box-shadow: 0 0 0 3px rgba(160, 74, 207, 0.1);
    }

    .btn-apply {
        background: linear-gradient(135deg, #A04ACF 0%, #6B2C8E 100%);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .btn-apply:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(160, 74, 207, 0.25);
        color: white;
    }

    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .custom-table th {
        background: #f8fafc;
        padding: 16px 24px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #64748b;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
    }

    .custom-table th:first-child {
        border-top-left-radius: 10px;
    }

    .custom-table td {
        padding: 18px 24px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 0.95rem;
        font-weight: 500;
        transition: background 0.2s;
    }

    .custom-table tr:hover td {
        background: #f8fafc;
    }

    .custom-table tr:last-child td {
        border-bottom: none;
    }

    /* Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-ontime { background: #dcfce7; color: #15803d; }
    .badge-late { background: #fee2e2; color: #b91c1c; }
    .badge-overtime { background: #dbeafe; color: #1d4ed8; }
    .badge-late-overtime { background: #fef9c3; color: #a16207; }

    /* Time styling */
    .time-box {
        font-family: 'Courier New', monospace; /* Monospaced for accurate alignment */
        background: #f1f5f9;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
    }

    /* Buttons */
    .btn-delete {
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border: 1px solid #fee2e2;
        color: #ef4444;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
        border-color: #ef4444;
        transform: scale(1.1);
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="premium-card">
            <!-- Header -->
            <div class="card-header-custom">
                <h2 class="page-title">
                    <i class="fa-solid fa-clock-rotate-left text-muted"></i>
                    Riwayat Absensi
                </h2>
                <form method="GET" class="filter-group d-flex gap-2">
                    <select name="month" class="form-select">
                        <?php for ($m = 1; $m <= 12; $m++): ?>
                            <option value="<?php echo $m; ?>" <?php echo (int)$m == (int)$month ? 'selected' : ''; ?>>
                                <?php echo date('F', mktime(0, 0, 0, $m, 1)); ?> <!-- Display Month Name -->
                            </option>
                        <?php endfor; ?>
                    </select>
                    <select name="year" class="form-select">
                        <?php for ($y = date('Y') - 2; $y <= date('Y') + 1; $y++): ?>
                            <option value="<?php echo $y; ?>" <?php echo (int)$y == (int)$year ? 'selected' : ''; ?>>
                                <?php echo $y; ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                    <button class="btn-apply" type="submit">Filter</button>
                </form>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th width="15%">TANGGAL</th>
                            <th width="15%">STATUS</th>
                            <th width="15%">MASUK</th>
                            <th width="15%">PULANG</th>
                            <th>KETERLAMBATAN</th>
                            <th>LEMBUR</th>
                            <th width="10%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($items) > 0): ?>
                            <?php foreach ($items as $row): ?>
                                <?php
                                    // Logic Status Badge
                                    $badgeClass = 'badge-secondary';
                                    $statusIcon = 'fa-circle-question';
                                    
                                    if ($row->status == 'ON TIME') {
                                        $badgeClass = 'badge-ontime';
                                        $statusIcon = 'fa-check-circle';
                                    } elseif ($row->status == 'LATE') {
                                        $badgeClass = 'badge-late';
                                        $statusIcon = 'fa-circle-exclamation';
                                    } elseif ($row->status == 'OVERTIME') {
                                        $badgeClass = 'badge-overtime';
                                        $statusIcon = 'fa-briefcase';
                                    }
                                    
                                    if (str_contains($row->status, 'LATE') && str_contains($row->status, 'OVERTIME')) {
                                        $badgeClass = 'badge-late-overtime';
                                        $statusIcon = 'fa-triangle-exclamation';
                                    }

                                    $jamMasuk = $row->check_in ? \Carbon\Carbon::parse($row->check_in)->format('H:i:s') : '-';
                                    $jamPulang = $row->check_out ? \Carbon\Carbon::parse($row->check_out)->format('H:i:s') : '-';
                                    $tanggal = \Carbon\Carbon::parse($row->date);
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-dark"><?php echo $tanggal->translatedFormat('d F Y'); ?></span>
                                            <span class="text-muted small"><?php echo $tanggal->translatedFormat('l'); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge <?php echo $badgeClass; ?>">
                                            <i class="fa-solid <?php echo $statusIcon; ?>"></i>
                                            <?php echo $row->status; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($row->check_in): ?>
                                            <span class="time-box text-success"><i class="fa-solid fa-arrow-right-to-bracket me-1"></i><?php echo $jamMasuk; ?></span>
                                        <?php else: ?>
                                            <span class="text-muted small">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($row->check_out): ?>
                                            <span class="time-box text-danger"><i class="fa-solid fa-arrow-right-from-bracket me-1"></i><?php echo $jamPulang; ?></span>
                                        <?php else: ?>
                                            <span class="text-muted small">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($row->minutes_late > 0): ?>
                                            <span class="text-danger fw-bold">
                                                <i class="fa-regular fa-clock me-1"></i><?php echo $row->minutes_late; ?> menit
                                            </span>
                                        <?php else: ?>
                                            <span class="text-success small fw-semibold"><i class="fa-solid fa-check me-1"></i>Tepat Waktu</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($row->overtime_minutes > 0): ?>
                                            <span class="text-primary fw-bold">
                                                <i class="fa-solid fa-stopwatch me-1"></i><?php echo $row->overtime_minutes; ?> menit
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted small">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <form action="<?php echo route('karyawan.absensi.destroy', $row->id); ?>" method="POST" style="display:inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn-delete" title="Hapus Data">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center text-muted">
                                        <i class="fa-solid fa-calendar-xmark fa-3x mb-3 text-light-emphasis"></i>
                                        <h6 class="fw-bold mb-1">Data Tidak Ditemukan</h6>
                                        <p class="small mb-0">Tidak ada riwayat absensi untuk periode yang dipilih.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.karyawan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Absensi_Karyawan\resources\views/karyawan/absensi/riwayat.blade.php ENDPATH**/ ?>