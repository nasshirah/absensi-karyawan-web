<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($title ?? 'Karyawan'); ?> · Absensi Karyawan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/metronic-lite.css')); ?>">

    <style>
        :root {
            --retali-pink: #C3398D;
            --retali-purple: #A04ACF;
            --retali-dark: #4A0F69;
            --retali-bg: #F6F5F7;
            --sidebar-width: 260px;
        }

        * {
            margin: 0;
            padding: 0; 
            box-sizing: border-box;
        }

        body {
            background: var(--retali-bg);
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* ================== SIDEBAR ================== */
        .app-aside {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #A04ACF 0%, #6B2C8E 50%, #4A0F69 100%);
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            box-shadow: 4px 0 24px rgba(0,0,0,0.12);
            z-index: 1000;
        }

        .aside-header {
            padding: 28px 24px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .aside-logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .aside-logo-icon {
            width: 42px;
            height: 42px;
            background: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--retali-purple);
            font-size: 22px;
            font-weight: 800;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .aside-logo-text {
            font-size: 22px;
            font-weight: 800;
            color: white;
            letter-spacing: 0.5px;
        }

        .aside-nav {
            padding: 20px 0;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .aside-nav::-webkit-scrollbar {
            width: 4px;
        }

        .aside-nav::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .aside-nav::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        .nav-section-title {
            color: rgba(255, 255, 255, 0.6);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0 24px;
            margin: 20px 0 10px 0;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 13px 24px;
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 0;
            margin: 2px 0;
            transition: all 0.25s ease;
            position: relative;
            text-decoration: none;
            border-left: 3px solid transparent;
        }

        .nav-link i {
            width: 20px;
            font-size: 18px;
            color: rgba(255, 255, 255, 0.85);
            transition: all 0.25s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.12);
            color: white;
            border-left-color: rgba(255, 255, 255, 0.4);
        }

        .nav-link:hover i {
            color: white;
            transform: translateX(3px);
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            font-weight: 700;
            border-left-color: white;
            box-shadow: inset 0 0 20px rgba(255, 255, 255, 0.1);
        }

        .nav-link.active i {
            color: white;
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.5));
        }

        .nav-link.logout-btn {
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background: transparent;
            border-left: none;
        }

        .nav-link.logout-btn:hover {
            background: rgba(255, 50, 50, 0.15);
            border-left-color: #ff4444;
        }

        .btn.btn-link.nav-link {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-weight: 600;
        }

        /* ================== MAIN CONTENT ================== */
        .app-main {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .app-topbar {
            background: white;
            padding: 20px 32px;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-title {
            font-size: 20px;
            font-weight: 700;
            color: #2d3748;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--retali-purple), var(--retali-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .user-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
            line-height: 1.2;
        }

        .user-role {
            font-size: 12px;
            color: #718096;
        }

        .app-content {
            padding: 32px;
            flex: 1;
        }

        /* ================== ALERTS ================== */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 16px 20px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .alert .fw-semibold {
            font-weight: 700;
        }

        /* ================== RESPONSIVE ================== */
        @media (max-width: 992px) {
            :root {
                --sidebar-width: 0;
            }

            .app-aside {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .app-aside.show {
                transform: translateX(0);
            }

            .app-main {
                margin-left: 0;
            }

            .app-content {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .app-topbar {
                padding: 16px 20px;
            }

            .topbar-title {
                font-size: 18px;
            }

            .user-info {
                display: none;
            }
        }

        /* ================== SMOOTH SCROLLBAR ================== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }
    </style>
</head>

<body>
<div class="d-flex">
    <aside class="app-aside">
        <div class="aside-header">
            <div class="aside-logo">
                <div class="aside-logo-icon">K</div>
                <div class="aside-logo-text">Retali Karyawan</div>
            </div>
        </div>

        <nav class="aside-nav">
            <div class="nav-section-title">Main Menu</div>
            
            <a class="nav-link <?php echo e(request()->routeIs('karyawan.dashboard') ? 'active' : ''); ?>"
               href="<?php echo e(route('karyawan.dashboard')); ?>">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>

            <a class="nav-link <?php echo e(request()->routeIs('karyawan.absensi.index') ? 'active' : ''); ?>"
               href="<?php echo e(route('karyawan.absensi.index')); ?>">
                <i class="fa-solid fa-fingerprint"></i> Absensi
            </a>

            <a class="nav-link <?php echo e(request()->routeIs('karyawan.absensi.riwayat') ? 'active' : ''); ?>"
               href="<?php echo e(route('karyawan.absensi.riwayat')); ?>">
                <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Absensi
            </a>

            <div class="nav-section-title">Cuti & Izin</div>

            <a class="nav-link <?php echo e(request()->routeIs('karyawan.cuti.ajukan') ? 'active' : ''); ?>"
               href="<?php echo e(route('karyawan.cuti.ajukan')); ?>">
                <i class="fa-solid fa-plane-departure"></i> Ajukan Cuti
            </a>

            <a class="nav-link <?php echo e(request()->routeIs('karyawan.cuti.riwayat') ? 'active' : ''); ?>"
               href="<?php echo e(route('karyawan.cuti.riwayat')); ?>">
                <i class="fa-solid fa-list-check"></i> Riwayat Cuti
            </a>
            
            <div class="nav-section-title">Akun</div>

            <a class="nav-link <?php echo e(request()->routeIs('karyawan.profil') ? 'active' : ''); ?>"
               href="<?php echo e(route('karyawan.profil')); ?>">
                <i class="fa-solid fa-user-gear"></i> Profil Saya
            </a>

            <form action="<?php echo e(route('logout')); ?>" method="POST" class="mt-auto">
                <?php echo csrf_field(); ?>
                <button class="nav-link logout-btn btn btn-link text-start w-100" type="submit">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    <main class="app-main flex-grow-1">
        <header class="app-topbar">
            <div class="topbar-title"><?php echo e($title ?? 'Karyawan'); ?></div>
            <div class="topbar-user">
                <div class="user-avatar">
                    <?php echo e(strtoupper(substr(auth()->user()->name ?? 'K', 0, 1))); ?>

                </div>
                <div class="user-info">
                    <div class="user-name"><?php echo e(auth()->user()->name ?? 'Karyawan'); ?></div>
                    <div class="user-role"><?php echo e(auth()->user()->division ?? 'Staff'); ?></div>
                </div>
            </div>
        </header>

        <div class="app-content">
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <i class="fa-solid fa-circle-check me-2"></i><?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <div class="fw-semibold mb-2">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i>Terjadi kesalahan:
                    </div>
                    <ul class="mb-0 ps-3">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\Absensi_Karyawan\resources\views/layouts/karyawan.blade.php ENDPATH**/ ?>