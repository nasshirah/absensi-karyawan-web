@extends('layouts.karyawan')
@php($title = 'Profil Saya')
@section('content')

<style>
    .profile-container {
        max-width: 900px;
        margin: 0 auto;
        padding-bottom: 2rem;
    }

    /* Ambient Glow */
    .profile-container::before {
        content: '';
        position: absolute;
        top: 20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(160, 74, 207, 0.15) 0%, rgba(0,0,0,0) 70%);
        z-index: -1;
        pointer-events: none;
        border-radius: 50%;
        filter: blur(40px);
    }

    .profile-card {
        background: white;
        border-radius: 24px;
        box-shadow: 0 10px 40px -5px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.5);
        overflow: hidden;
        position: relative;
    }

    .card-header-bg {
        background: linear-gradient(135deg, #A04ACF 0%, #6B2C8E 100%);
        height: 160px;
        position: relative;
        overflow: hidden;
    }

    .card-header-bg::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 40px;
        background: white;
        border-radius: 24px 24px 0 0;
    }

    .avatar-wrapper {
        position: relative;
        margin-top: -80px;
        margin-bottom: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .avatar-circle {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: 800;
        color: #A04ACF;
        border: 5px solid white;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 10;
        text-transform: uppercase;
    }

    .user-name-display {
        margin-top: 1rem;
        font-size: 1.5rem;
        font-weight: 800;
        color: #1e293b;
    }

    .user-role-display {
        font-size: 0.95rem;
        color: #64748b;
        font-weight: 500;
    }

    /* Form Styles */
    .form-section {
        padding: 0 3rem 3rem 3rem;
    }

    .form-label-custom {
        font-size: 0.8rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #64748b;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .form-control-custom {
        display: block;
        width: 100%;
        padding: 0.875rem 1.25rem;
        font-size: 1rem;
        font-weight: 500;
        line-height: 1.5;
        color: #1e293b;
        background-color: #f8fafc;
        background-clip: padding-box;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .form-control-custom:focus {
        border-color: #A04ACF;
        background-color: white;
        outline: 0;
        box-shadow: 0 0 0 4px rgba(160, 74, 207, 0.1);
    }

    .form-control-custom:disabled, .form-control-custom[readonly] {
        background-color: #f1f5f9;
        border-color: #e2e8f0;
        color: #94a3b8;
        cursor: not-allowed;
        opacity: 1;
    }

    .btn-save {
        background: linear-gradient(135deg, #A04ACF 0%, #6B2C8E 100%);
        color: white;
        font-weight: 700;
        padding: 1rem 3rem;
        border-radius: 14px;
        border: none;
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px -5px rgba(160, 74, 207, 0.4);
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px -5px rgba(160, 74, 207, 0.5);
        color: white;
    }

    @media (max-width: 768px) {
        .form-section {
            padding: 0 1.5rem 2rem 1.5rem;
        }
        
        .card-header-bg {
            height: 120px;
        }
        
        .avatar-circle {
            width: 100px;
            height: 100px;
            font-size: 2.5rem;
            margin-top: -50px;
        }
    }
</style>

<div class="profile-container">
    <div class="profile-card">
        <div class="card-header-bg">
            <div class="position-absolute top-50 start-50 translate-middle w-100 text-center text-white" style="margin-top: -20px;">
                <i class="fa-solid fa-shapes fa-4x" style="opacity: 0.1;"></i>
            </div>
        </div>

        <div class="avatar-wrapper">
            <div class="avatar-circle">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div class="user-name-display">{{ $user->name }}</div>
            <div class="user-role-display">
                <i class="fa-solid fa-id-badge me-1"></i> {{ $user->division ?? 'Karyawan' }}
            </div>
        </div>

        <div class="form-section">
            <form method="POST" action="{{ route('karyawan.profil.update') }}">
                @csrf
                
                <div class="row g-4">
                    <!-- Personal Info Section -->
                    <div class="col-12 mb-2">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-light text-primary border px-3 py-2 rounded-pill">
                                <i class="fa-solid fa-user me-2"></i>Informasi Pribadi
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control-custom" value="{{ old('name', $user->name) }}" required placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0" style="position: absolute; left: 2px; top: 2px; bottom: 2px; z-index: 5; background: transparent; border: none;">
                                <i class="fa-solid fa-envelope text-muted ps-2"></i>
                            </span>
                            <input type="email" class="form-control-custom" value="{{ $user->email }}" disabled style="padding-left: 2.5rem;">
                        </div>
                        <div class="form-text mt-1 text-xs"><i class="fa-solid fa-circle-info me-1"></i> Email tidak dapat diubah.</div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control-custom" value="{{ old('phone', $user->phone) }}" placeholder="+62...">
                    </div>

                    <!-- Work Info Section -->
                    <div class="col-12 mt-4 mb-2">
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <span class="badge bg-light text-purple border px-3 py-2 rounded-pill" style="color: #A04ACF;">
                                <i class="fa-solid fa-briefcase me-2"></i>Informasi Pekerjaan
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Divisi</label>
                        <input type="text" name="division" class="form-control-custom" value="{{ old('division', $user->division) }}" placeholder="Contoh: IT, HRD, Marketing">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-custom">Jabatan</label>
                        <input type="text" name="position" class="form-control-custom" value="{{ old('position', $user->position) }}" placeholder="Contoh: Staff, Supervisor">
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-5 pt-3 border-top">
                    <button type="submit" class="btn-save">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
