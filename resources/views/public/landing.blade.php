<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URSHIPORTS - Your Internship Programme at Injourney Airports</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        teal: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            500: '#14b8a6',
                            600: '#0d9488',
                            900: '#134e4a',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Custom Styles yang tidak ada di Tailwind default */
        .glass-nav {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        }

        .hero-overlay {
            background: linear-gradient(to bottom, rgba(15, 23, 42, 0.3), rgba(15, 23, 42, 0.8));
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.1);
            border-color: #14b8a6;
            /* Teal 500 */
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased selection:bg-teal-500 selection:text-white">

    <nav class="fixed top-0 w-full z-50 glass-nav">
        <div class="container mx-auto px-6 h-20 flex items-center justify-between">
            <a href="#" class="flex items-center gap-3">
                <div
                    class="h-10 w-10 bg-teal-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                    <i class="fas fa-plane-up"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-xl font-bold tracking-tight text-slate-900 leading-none">URSHIPORTS</span>
                    <span class="text-[9px] font-medium tracking-wider text-slate-500 mt-1"
                        style="line-height: 1.3;">Your Internship Programme<br>at Injourney Airports</span>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="#benefits"
                    class="text-sm font-semibold text-slate-600 hover:text-teal-600 transition-colors">Keuntungan</a>
                <a href="#requirements"
                    class="text-sm font-semibold text-slate-600 hover:text-teal-600 transition-colors">Persyaratan</a>
                <a href="{{ route('login') }}"
                    class="px-5 py-2.5 rounded-full bg-slate-900 text-white text-sm font-semibold hover:bg-slate-800 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    Login <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>

            <button class="md:hidden text-2xl text-slate-700">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <section class="relative min-h-[90vh] flex items-center pt-20 overflow-hidden bg-slate-900">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/T3bg.jpg') }}" alt="Airport"
                class="w-full h-full object-cover object-bottom opacity-60">
            <div class="hero-overlay absolute inset-0"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 text-center">
            <div
                class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-teal-500/20 backdrop-blur-sm border border-teal-500/30 text-teal-200 text-xs font-bold tracking-wider uppercase mb-8">
                <span class="w-2 h-2 rounded-full bg-teal-400 animate-pulse"></span>
                URSHIPORTS - Kantor Regional I
            </div>

            <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold text-white mb-6 leading-tight tracking-tight">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-200 to-cyan-200">Your</span>
                Internship<br>
                Programme <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-200 to-cyan-200">at
                    Injourney Airports</span>
            </h1>

            <p class="text-lg md:text-xl text-slate-300 mb-4 max-w-3xl mx-auto font-light leading-relaxed">
                Selamat datang di <span class="font-semibold text-teal-300">URSHIPORTS</span> - Platform resmi program
                magang Injourney Airports Kantor Regional I.
            </p>
            <p class="text-base md:text-lg text-slate-400 mb-10 max-w-2xl mx-auto font-light">
                Dapatkan ilmu dan pengalaman nyata di dunia industri pengelolaan bandara Indonesia.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('public.register') }}"
                    class="px-8 py-4 bg-teal-500 rounded-full text-white font-bold text-lg shadow-lg shadow-teal-500/30 hover:bg-teal-600 transition-all hover:-translate-y-1">
                    Daftar Sekarang
                </a>
                <a href="#about"
                    class="px-8 py-4 rounded-full border border-white/20 bg-white/5 backdrop-blur text-white font-semibold hover:bg-white/10 transition-all">
                    Pelajari Dulu
                </a>
            </div>
        </div>
    </section>

    <!-- About URSHIPORTS Section -->
    <section id="about" class="py-20 bg-gradient-to-br from-slate-900 via-slate-800 to-teal-900">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center">
                <div
                    class="inline-block px-6 py-3 rounded-full bg-teal-500/20 backdrop-blur-sm border border-teal-500/40 mb-8">
                    <h2 class="text-teal-300 font-bold text-sm tracking-widest uppercase">Apa itu URSHIPORTS?</h2>
                </div>

                <h3 class="text-4xl md:text-5xl font-extrabold text-white mb-8 leading-tight">
                    Yo<span class="text-teal-400">ur</span> Intern<span class="text-teal-400">ship</span> Programme <br>
                    At Injourney Airp<span class="text-teal-400">orts</span>
                </h3>

                <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-3xl p-8 md:p-12">
                    <p class="text-base md:text-lg text-slate-200 leading-relaxed mb-6">
                        <span class="font-bold text-teal-300">URSHIPORTS</span> adalah singkatan dari <span
                            class="font-semibold text-white">Your Internship Programme at Injourney Airports</span>,
                        sebuah platform digital yang memfasilitasi program magang resmi di lingkungan PT Angkasa Pura
                        Indonesia khususnya Kantor Regional 1.
                    </p>
                    <p class="text-base md:text-lg text-slate-200 leading-relaxed mb-6">
                        Sistem ini dirancang untuk mempermudah proses pendaftaran, seleksi, dan pengelolaan peserta
                        magang,
                        memberikan pengalaman profesional di industri pengelolaan bandara dengan standar internasional.
                    </p>
                    <p class="text-base md:text-lg text-slate-200 leading-relaxed">
                        <span class="text-teal-300 font-semibold">Para calon peserta magang</span> dapat dengan mudah
                        melengkapi dokumen persyaratan,
                        mengisi formulir pendaftaran, dan mengunggah berkas yang diperlukan hanya dengan <span
                            class="font-semibold text-white">klik tombol "Daftar Sekarang"</span>
                        yang tersedia di halaman ini.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6 mt-12">
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div class="text-3xl font-bold text-teal-400 mb-2">100+</div>
                        <p class="text-sm text-slate-300">Peserta Magang per Tahun</p>
                    </div>
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div class="text-3xl font-bold text-teal-400 mb-2">15+</div>
                        <p class="text-sm text-slate-300">Unit Penempatan Kerja</p>
                    </div>
                    <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-6">
                        <div class="text-3xl font-bold text-teal-400 mb-2">95%</div>
                        <p class="text-sm text-slate-300">Tingkat Kepuasan Peserta</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="benefits" class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-teal-600 font-bold text-sm tracking-widest uppercase mb-3">Kenapa Bergabung?</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">Keuntungan Program Magang</h3>
                <p class="text-slate-500 text-lg">Investasi terbaik untuk masa depan karir Anda dimulai dari sini.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                <div class="bg-white p-8 rounded-2xl border border-slate-200 card-hover group">
                    <div
                        class="w-14 h-14 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                        <i class="fas fa-plane-departure"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Pengalaman Praktis</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Terjun langsung ke operasional dan pengelolaan bandara internasional.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-slate-200 card-hover group">
                    <div
                        class="w-14 h-14 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Mentoring</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Bimbingan dari para praktisi ahli yang telah berpengalaman di industri ini.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-slate-200 card-hover group">
                    <div
                        class="w-14 h-14 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Sertifikat Resmi</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Dapatkan sertifikat resmi Injourney Airports yang bernilai untuk portofolio CV Anda.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-slate-200 card-hover group">
                    <div
                        class="w-14 h-14 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Networking Luas</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Bangun relasi profesional di industri pengelolaan bandara dan sesama talenta muda.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-slate-200 card-hover group">
                    <div
                        class="w-14 h-14 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Peluang Karir</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Akses informasi rekrutmen dan peluang karir di ekosistem Injourney.
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl border border-slate-200 card-hover group">
                    <div
                        class="w-14 h-14 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Skill Development</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Pengembangan soft-skill kepemimpinan, komunikasi, dan problem solving nyata.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section id="requirements" class="py-24 bg-slate-50">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-16">
                <div class="lg:w-1/3">
                    <h2 class="text-teal-600 font-bold text-sm tracking-widest uppercase mb-3">Persyaratan</h2>
                    <h3 class="text-4xl font-bold text-slate-900 mb-6">Siapkan Dokumen Anda</h3>
                    <p class="text-slate-500 text-lg mb-8">Pastikan Anda memenuhi kriteria dan melengkapi seluruh
                        dokumen sebelum mendaftar.</p>
                    <a href="{{ route('public.register') }}"
                        class="hidden lg:inline-flex items-center gap-2 px-6 py-3 bg-slate-900 text-white rounded-lg font-semibold hover:bg-slate-800 transition-colors">
                        Daftar Sekarang <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="lg:w-2/3 grid md:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                        <div class="flex items-center gap-4 mb-6">
                            <div
                                class="w-10 h-10 rounded-lg bg-teal-100 text-teal-600 flex items-center justify-center">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <h4 class="text-xl font-bold text-slate-900">Kriteria Peserta</h4>
                        </div>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3 text-slate-600 text-sm">
                                <i class="fas fa-check text-teal-500 mt-1"></i> Mahasiswa atau siswa aktif
                            </li>
                            <li class="flex items-start gap-3 text-slate-600 text-sm">
                                <i class="fas fa-check text-teal-500 mt-1"></i> Sehat jasmani & rohani
                            </li>
                            <li class="flex items-start gap-3 text-slate-600 text-sm">
                                <i class="fas fa-check text-teal-500 mt-1"></i> Bersedia ditempatkan di unit kerja
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200">
                        <div class="flex items-center gap-4 mb-6">
                            <div
                                class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                                <i class="fas fa-file-lines"></i>
                            </div>
                            <h4 class="text-xl font-bold text-slate-900">Dokumen Wajib</h4>
                        </div>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3 text-slate-600 text-sm">
                                <i class="fas fa-check text-blue-500 mt-1"></i> Lengkapi data diri
                            </li>
                            <li class="flex items-start gap-3 text-slate-600 text-sm">
                                <i class="fas fa-check text-blue-500 mt-1"></i> Download formulir dan isi
                            </li>
                            <li class="flex items-start gap-3 text-slate-600 text-sm">
                                <i class="fas fa-check text-blue-500 mt-1"></i> Upload formulir yang sudah diisi
                            </li>
                            <li class="flex items-start gap-3 text-slate-600 text-sm">
                                <i class="fas fa-check text-blue-500 mt-1"></i> Upload CV, Proposal, Surat Magang Resmi
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-slate-900 border-t border-slate-800 py-16">
        <div class="container mx-auto px-6">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-center gap-8 mb-8">
                    <div class="flex items-center gap-3">
                        <div
                            class="h-12 w-12 bg-teal-600 rounded-lg flex items-center justify-center text-white font-bold text-2xl">
                            <i class="fas fa-plane-up"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-bold tracking-tight text-white leading-none">URSHIPORTS</span>
                            <span class="text-xs font-medium text-slate-400 mt-1">Your Internship Programme at
                                Injourney Airports</span>
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <a href="#benefits"
                            class="text-slate-400 hover:text-teal-400 transition-colors text-sm">Keuntungan</a>
                        <a href="#requirements"
                            class="text-slate-400 hover:text-teal-400 transition-colors text-sm">Persyaratan</a>
                        <a href="{{ route('login') }}"
                            class="text-slate-400 hover:text-teal-400 transition-colors text-sm">Login</a>
                    </div>
                </div>

                <div class="border-t border-slate-800 pt-8 text-center">
                    <p class="text-slate-500 text-sm mb-2">
                        <span class="font-semibold text-slate-400">Injourney Airports Kantor Regional I</span>
                    </p>
                    <p class="text-slate-600 text-xs">
                        &copy; 2026 URSHIPORTS. All rights reserved. Powered by Human Capital Division.
                    </p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
