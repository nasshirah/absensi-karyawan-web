<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Retali</title>

    <!-- GOOGLE FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --retali-primary: #9b2ba8;   
            --retali-secondary: #d357c1; 
            --retali-dark: #5b1b6b;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f3edf9;
        }

        .page-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* LEFT HERO PANEL */
        .left-panel {
            flex: 1.55; 
            background: radial-gradient(circle at top left, #d357c1 0%, #5b1b6b 40%, #2a1039 100%);
            color: #ffffff;
            padding: 60px 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 999px;
            padding: 8px 18px;
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        .badge-dot {
            width: 8px;
            height: 8px;
            border-radius: 999px;
            background: #ffd66b;
        }

        .left-title {
            font-size: 38px;
            line-height: 1.25;
            font-weight: 700;
            margin: 0 0 18px 0;
            max-width: 430px;
        }

        .left-title span.highlight {
            color: #ffd66b;
        }

        .left-subtitle {
            font-size: 14px;
            max-width: 440px;
            color: rgba(255, 255, 255, 0.85);
        }

        /* RIGHT LOGIN PANEL */
        .right-panel {
            flex: 1;
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 120px 40px 60px; /* FIX: geser form ke kiri */
        }

        .login-card {
            width: 380px;
            max-width: 100%;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 18px;
        }

        .login-logo img {
            width: 120px;
        }

        .login-title {
            text-align: center;
            margin-bottom: 6px;
            font-size: 22px;
            font-weight: 600;
            color: #2d2340;
        }

        .login-subtitle {
            text-align: center;
            margin-bottom: 32px;
            font-size: 13px;
            color: #7a758b;
        }

        .input-group { margin-bottom: 18px; }

        label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 6px;
            color: #4b3b64;
        }

        .input-field {
            width: 100%;
            border-radius: 999px;
            border: 1.6px solid #e0d5f2;
            padding: 12px 16px;
            font-size: 13px;
            outline: none;
            transition: 0.2s;
        }

        .input-field:focus {
            border-color: var(--retali-primary);
            box-shadow: 0 0 0 3px rgba(155, 43, 168, 0.16);
        }

        .btn-login {
            width: 100%;
            border: none;
            border-radius: 999px;
            padding: 13px;
            margin-top: 8px;
            background: linear-gradient(135deg, var(--retali-primary), var(--retali-secondary));
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 10px 18px rgba(155, 43, 168, 0.35);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: 0.15s ease;
        }

        .btn-login:hover {
            opacity: 0.96;
            transform: translateY(-1px);
            box-shadow: 0 14px 26px rgba(155, 43, 168, 0.45);
        }

        .btn-login-arrow {
            font-size: 16px;
        }

        .footer-text {
            margin-top: 26px;
            text-align: center;
            font-size: 12px;
            color: #a19ab4;
        }

        @media (max-width: 960px) {
            .page-wrapper { flex-direction: column; }

            .left-panel {
                flex: none;
                padding: 40px 24px 30px;
                text-align: center;
                align-items: center;
            }

            .right-panel {
                flex: none;
                padding: 30px 18px 40px;
            }
        }
    </style>
</head>
<body>

<div class="page-wrapper">

    <div class="left-panel">
        <div class="badge">
            <span class="badge-dot"></span>
            <span>Sistem Absensi Karyawan</span>
        </div>

        <h1 class="left-title">
            Kelola absensi karyawan dengan lebih <span class="highlight">mudah & teratur.</span>.
        </h1>

        <p class="left-subtitle">
            Retali menyediakan sistem absensi modern untuk memantau kehadiran, 
            jadwal kerja, dan data karyawan secara real-time, agar operasional 
            lebih efisien dan mudah dikelola.
        </p>
    </div>

    <div class="right-panel">
        <div class="login-card">

            <div class="login-logo">
                <img src="<?php echo e(asset('images/retali-logo.png')); ?>" alt="Retali Logo">
            </div>

            <div class="login-title">Login Absensi Karyawan</div>
            <div class="login-subtitle">
                Masuk untuk mengakses dashboard absensi dan data kehadiran karyawan.
            </div>

            <form action="<?php echo e(url('/login')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="input-group">
                    <label for="email">Email</label>
                    <input id="email" class="input-field" type="email" name="email" required placeholder="Masukkan email">
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input id="password" class="input-field" type="password" name="password" required placeholder="Masukkan password">
                </div>

                <button type="submit" class="btn-login">
                    <span>Login</span>
                    <span class="btn-login-arrow">→</span>
                </button>
            </form>

            <div class="footer-text">
                © <?php echo e(date('Y')); ?> Retali — All rights reserved.
            </div>

        </div>
    </div>

</div>

</body>
</html>
<?php /**PATH C:\laragon\www\Absensi_Karyawan\resources\views/auth/login.blade.php ENDPATH**/ ?>