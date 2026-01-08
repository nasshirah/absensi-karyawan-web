@extends('layouts.karyawan')
@php($title = 'Ajukan Cuti')
@section('content')

<style>
    .form-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .form-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 40px -5px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .card-header-gradient {
        background: linear-gradient(135deg, #A04ACF 0%, #6B2C8E 100%);
        padding: 2.5rem 3rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .card-header-gradient::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0) 70%);
        border-radius: 50%;
    }

    .header-title {
        font-size: 1.75rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .header-subtitle {
        font-size: 0.95rem;
        opacity: 0.9;
        font-weight: 400;
    }

    .card-body-custom {
        padding: 3rem;
    }

    /* Custom Form Controls */
    .form-label-custom {
        font-size: 0.85rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 0.5px;
        margin-bottom: 0.75rem;
    }

    .form-control-custom, .form-select-custom {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 0.8rem 1.25rem;
        font-size: 1rem;
        font-weight: 500;
        color: #1e293b;
        transition: all 0.3s ease;
        background: #f8fafc;
        width: 100%;
    }

    .form-control-custom:focus, .form-select-custom:focus {
        border-color: #A04ACF;
        background: white;
        box-shadow: 0 0 0 4px rgba(160, 74, 207, 0.1);
        outline: none;
    }

    .btn-submit {
        background: linear-gradient(135deg, #A04ACF 0%, #6B2C8E 100%);
        color: white;
        font-weight: 700;
        padding: 1rem 2.5rem;
        border-radius: 14px;
        border: none;
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px -5px rgba(160, 74, 207, 0.4);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px -5px rgba(160, 74, 207, 0.5);
    }

    .btn-history {
        color: #64748b;
        font-weight: 600;
        text-decoration: none;
        padding: 1rem 2rem;
        border-radius: 14px;
        transition: all 0.2s ease;
    }

    .btn-history:hover {
        background: #f1f5f9;
        color: #334155;
    }

    .info-note {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
        color: #166534;
        display: flex;
        gap: 0.75rem;
        margin-bottom: 2rem;
    }

</style>

<div class="form-container">
    <div class="form-card">
        <div class="card-header-gradient">
            <h1 class="header-title">Formulir Cuti</h1>
            <p class="header-subtitle">Silahkan lengkapi data di bawah ini untuk mengajukan permohonan cuti.</p>
        </div>

        <div class="card-body-custom">
            
            <form method="POST" action="{{ route('karyawan.cuti.store') }}">
                @csrf
                
                <div class="row g-4">
                    <!-- Tipe Cuti -->
                    <div class="col-md-12">
                        <label class="form-label-custom">Jenis Cuti</label>
                        <select name="type" class="form-select-custom" required>
                            <option value="" selected disabled>Pilih jenis cuti...</option>
                            <option value="tahunan">Cuti Tahunan</option>
                            <option value="sakit">Sakit</option>
                            <option value="lainnya">Keperluan Lainnya</option>
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div class="col-md-6">
                        <label class="form-label-custom">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control-custom" required>
                    </div>
                    
                    <div class="col-md-6">
                        <label class="form-label-custom">Tanggal Selesai</label>
                        <input type="date" name="end_date" class="form-control-custom" required>
                    </div>

                    <!-- Alasan -->
                    <div class="col-12">
                        <label class="form-label-custom">Alasan / Keterangan</label>
                        <textarea name="reason" class="form-control-custom" rows="4" placeholder="Jelaskan alasan pengajuan cuti Anda secara singkat..." style="resize: none;" required></textarea>
                        <div class="form-text mt-2 text-muted small"><i class="fa-solid fa-circle-info me-1"></i> Penjelasan yang detail membantu mempercepat proses persetujuan.</div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between mt-5 pt-3 border-top">
                    <a href="{{ route('karyawan.cuti.riwayat') }}" class="btn-history">
                        <i class="fa-solid fa-clock-rotate-left me-2"></i> Lihat Riwayat
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-paper-plane me-2"></i> Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
