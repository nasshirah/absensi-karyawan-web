<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Karyawan Digital - PT. Retali</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                retali: {
                  primary: '#9b2ba8',
                  secondary: '#d357c1',
                  dark: '#5b1b6b',
                  light: '#f3edf9',
                }
              },
              fontFamily: {
                poppins: ['Poppins', 'sans-serif'],
              }
            }
          }
        }
    </script>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .glass-effect {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .bg-retali-gradient {
            background: radial-gradient(circle at top left, #d357c1 0%, #5b1b6b 40%, #2a1039 100%);
        }
    </style>
</head>
<body class="bg-[#fefaff] text-slate-900 scroll-smooth">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 glass-effect">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <img src="<?php echo e(asset('images/retali-logo.png')); ?>" alt="Logo" class="h-10 w-auto">
                    <span class="text-xl font-bold bg-gradient-to-r from-retali-primary to-retali-secondary bg-clip-text text-transparent">Absensi Digital</span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#fitur" class="text-slate-600 hover:text-retali-primary font-medium transition-colors">Fitur</a>
                    <a href="<?php echo e(route('login')); ?>" class="bg-retali-primary hover:bg-retali-dark text-white px-6 py-2.5 rounded-xl font-semibold transition-all transform hover:scale-105 shadow-lg shadow-purple-200">
                        Masuk Sistem
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight">
                    Kelola Absensi Karyawan <br>
                    <span class="text-retali-primary">Lebih Terintegrasi & Efisien</span>
                </h1>
                <p class="text-lg md:text-xl text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                    Sistem manajemen kehadiran digital untuk memudahkan pelacakan waktu, pengajuan cuti, dan laporan performa karyawan dalam satu platform yang aman.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="<?php echo e(route('login')); ?>" class="bg-retali-primary hover:bg-retali-dark text-white px-10 py-4 rounded-2xl font-bold text-lg transition-all shadow-xl shadow-purple-200">
                        Coba Sekarang
                    </a>
                    <a href="#fitur" class="bg-white hover:bg-slate-50 text-slate-700 px-10 py-4 rounded-2xl font-bold text-lg border border-slate-200 transition-all">
                        Pelajari Selengkapnya
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decoration -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 w-[600px] h-[600px] bg-purple-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-fuchsia-100 rounded-full blur-3xl opacity-50"></div>
    </section>

    <!-- Features -->
    <section id="fitur" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Fitur Utama Sistem</h2>
                <div class="w-20 h-1.5 bg-retali-primary mx-auto rounded-full"></div>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 rounded-3xl border border-slate-100 hover:border-purple-200 hover:bg-purple-50/50 transition-all group">
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 text-retali-primary group-hover:bg-retali-primary group-hover:text-white transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Absensi Real-time</h3>
                    <p class="text-slate-600">Catat kehadiran masuk dan pulang secara instan dengan pencatatan waktu yang akurat.</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-3xl border border-slate-100 hover:border-purple-200 hover:bg-purple-50/50 transition-all group">
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 text-retali-primary group-hover:bg-retali-primary group-hover:text-white transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Manajemen Cuti</h3>
                    <p class="text-slate-600">Ajukan cuti dan pantau status persetujuan langsung dari dashboard pribadi karyawan.</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-3xl border border-slate-100 hover:border-purple-200 hover:bg-purple-50/50 transition-all group">
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 text-retali-primary group-hover:bg-retali-primary group-hover:text-white transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H5a2 2 0 01-2-2V5a2 2 0 012-2h11.282a2 2 0 011.442.6L21 8.118V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Laporan Otomatis</h3>
                    <p class="text-slate-600">Rekapitulasi absensi bulanan otomatis yang siap diunduh dalam format PDF atau Excel.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-retali-dark text-slate-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex flex-col items-center gap-4 mb-8">
                <img src="<?php echo e(asset('images/retali-logo.png')); ?>" alt="Logo" class="h-10 w-auto">
                <p class="max-w-md">Solusi manajemen sumber daya manusia yang modern untuk produktivitas tim Anda.</p>
            </div>
            <div class="border-t border-purple-800/50 pt-8">
                <p>&copy; 2024 PT. Retali. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
<?php /**PATH C:\laragon\www\Absensi_Karyawan\resources\views/welcome.blade.php ENDPATH**/ ?>