<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>URSHIPORTS - Your Internship Programme at Injourney Airports</title>

    <!-- Google Fonts: Inter (modern sans-serif) -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Tailwind CSS CDN + custom config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            900: '#0f172a',
                            800: '#1e293b',
                        },
                        accent: {
                            cyan: '#22d3ee',
                            cyanDark: '#06b6d4',
                        },
                    },
                    animation: {
                        'glow-pulse': 'glowPulse 2s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        glowPulse: {
                            '0%': {
                                boxShadow: '0 0 15px rgba(34, 211, 238, 0.4)'
                            },
                            '100%': {
                                boxShadow: '0 0 35px rgba(34, 211, 238, 0.7), 0 0 60px rgba(34, 211, 238, 0.3)'
                            },
                        },
                    },
                    backdropBlur: {
                        xs: '2px',
                    },
                },
            },
        }
    </script>

    <!-- AOS CSS & JS untuk reveal animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        /* Glassmorphism base */
        .glass {
            background: rgba(30, 41, 59, 0.45);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
        }

        /* Input glow effect */
        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.3);
            border-color: #22d3ee;
            transition: all 0.2s;
        }

        /* Parallax hero (sederhana via CSS) */
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }
    </style>
</head>

<body
    class="bg-gradient-to-b from-slate-950 via-slate-900 to-primary-900 text-slate-100 font-sans antialiased selection:bg-accent-cyan selection:text-slate-950">

    <!-- Navbar Glassmorphism -->
    <nav class="fixed top-0 inset-x-0 z-50 glass">
        <div class="container mx-auto px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="#" class="flex items-center gap-3 hover:opacity-90 transition">
                <img src="{{ asset('images/company-logo.png') }}" alt="Injourney Airports" class="h-12" />
                <div>
                    <span class="text-xl font-bold tracking-tight">URSHIPORTS</span>
                    <p class="text-xs text-slate-400">Your Internship Programme at Injourney Airports</p>
                </div>
            </a>

            <div class="hidden md:flex items-center gap-10">
                <a href="#benefits"
                    class="text-sm font-medium text-slate-300 hover:text-accent-cyan transition-colors">Keuntungan</a>
                <a href="#requirements"
                    class="text-sm font-medium text-slate-300 hover:text-accent-cyan transition-colors">Persyaratan</a>
                <a href="{{ route('login') }}"
                    class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white rounded-xl font-medium transition-all hover:shadow-lg hover:shadow-cyan-500/20">
                    Login →
                </a>
            </div>

            <!-- Mobile menu button (gunakan Alpine nanti) -->
            <button class="md:hidden text-2xl text-slate-300">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- Hero Section dengan Parallax ringan -->
    <section class="relative min-h-screen flex items-center pt-24 overflow-hidden">
        <div class="absolute inset-0 parallax-bg"
            style="background-image: url('{{ asset('images/T3bg.jpg') }}'); opacity: 0.25;"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-slate-950/60 to-slate-950"></div>

        <div class="container mx-auto px-6 relative z-10 text-center" data-aos="fade-up" data-aos-duration="1000">
            <div
                class="inline-flex items-center gap-3 px-5 py-2 rounded-full glass text-cyan-300 text-xs font-semibold tracking-wider uppercase mb-8">
                <span class="w-2 h-2 rounded-full bg-accent-cyan animate-pulse"></span>
                URSHIPORTS - Kantor Regional I
            </div>

            <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold leading-tight tracking-tight mb-8">
                Your Internship<br />
                Programme at<br />
                <span class="bg-gradient-to-r from-cyan-300 to-accent-cyan bg-clip-text text-transparent">Injourney
                    Airports</span>
            </h1>

            <p class="text-xl md:text-2xl text-slate-300 max-w-4xl mx-auto mb-6 font-light">
                Selamat datang di <span class="font-semibold text-accent-cyan">URSHIPORTS</span> - Platform resmi
                program magang Injourney Airports Kantor Regional I.
            </p>

            <p class="text-lg text-slate-400 max-w-3xl mx-auto mb-12">
                Dapatkan ilmu dan pengalaman nyata di dunia industri pengelolaan bandara Indonesia.
            </p>

            <div class="flex flex-col sm:flex-row gap-5 justify-center">
                <a href="{{ route('public.register') }}"
                    class="px-10 py-5 bg-gradient-to-r from-cyan-500 to-accent-cyan rounded-2xl text-slate-950 font-bold text-lg shadow-2xl shadow-cyan-500/30 hover:shadow-cyan-400/50 transition-all hover:scale-105">
                    Daftar Sekarang
                </a>
                <a href="#about"
                    class="px-10 py-5 glass text-white font-semibold rounded-2xl hover:bg-slate-700/30 transition-all">
                    Pelajari Dulu →
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 relative">
        <div class="container mx-auto px-6">
            <div class="max-w-5xl mx-auto text-center" data-aos="fade-up">
                <div class="inline-block px-8 py-4 glass rounded-full mb-10">
                    <h2 class="text-accent-cyan font-semibold text-sm tracking-widest uppercase">Apa itu URSHIPORTS?
                    </h2>
                </div>

                <h3 class="text-4xl md:text-6xl font-extrabold mb-10 leading-tight">
                    Your Intern<span class="text-accent-cyan">ship</span> Programme<br />
                    At Injourney Air<span class="text-accent-cyan">ports</span>
                </h3>

                <div class="glass rounded-3xl p-8 md:p-12 mb-12">
                    <p class="text-lg text-slate-200 leading-relaxed mb-6">
                        <span class="font-bold text-accent-cyan">URSHIPORTS</span> adalah singkatan dari <span
                            class="font-semibold text-white">Your Internship Programme at Injourney Airports</span>,
                        sebuah platform digital yang memfasilitasi pendaftaran program magang resmi di lingkungan PT Angkasa Pura
                        Indonesia khususnya Kantor Regional 1.
                    </p>
                    <p class="text-lg text-slate-200 leading-relaxed mb-6">
                        Sistem ini dirancang untuk mempermudah proses pendaftaran magang, mulai dari tahap seleksi awal hingga pengumuman akhir
                        mengenai status penerimaan calon peserta magang secara transparan dan sistematis.
                    </p>
                    <p class="text-lg text-slate-200 leading-relaxed">
                        Para calon peserta magang dapat dengan mudah melengkapi dokumen persyaratan, mengisi formulir
                        pendaftaran, dan mengunggah berkas yang diperlukan hanya dengan <span
                            class="font-semibold text-accent-cyan">klik tombol "Daftar Sekarang"</span> yang tersedia di
                        halaman ini.
                    </p>
                </div>

                <!-- Mini stats bento -->
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="glass rounded-2xl p-8 text-center" data-aos="zoom-in" data-aos-delay="100">
                        <div class="text-5xl font-bold text-accent-cyan mb-3">100+</div>
                        <p class="text-slate-300">Peserta Magang per Tahun</p>
                    </div>
                    <div class="glass rounded-2xl p-8 text-center" data-aos="zoom-in" data-aos-delay="200">
                        <div class="text-5xl font-bold text-accent-cyan mb-3">15+</div>
                        <p class="text-slate-300">Unit Penempatan Kerja</p>
                    </div>
                    <div class="glass rounded-2xl p-8 text-center" data-aos="zoom-in" data-aos-delay="300">
                        <div class="text-5xl font-bold text-accent-cyan mb-3">95%</div>
                        <p class="text-slate-300">Tingkat Kepuasan Peserta</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits - Bento Grid style -->
    <section id="benefits" class="py-24 bg-slate-950/50">
        <div class="container mx-auto px-6">
            <div class="text-center max-w-4xl mx-auto mb-16" data-aos="fade-up">
                <h2 class="text-accent-cyan font-semibold text-sm tracking-widest uppercase mb-4">Kenapa Bergabung?</h2>
                <h3 class="text-4xl md:text-5xl font-bold mb-6">Keuntungan Program Magang</h3>
                <p class="text-slate-400 text-lg">Investasi terbaik untuk masa depan dimulai dari sini.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="glass rounded-3xl p-8 hover:scale-[1.03] transition-all duration-300 group"
                    data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="w-16 h-16 rounded-2xl bg-cyan-500/10 flex items-center justify-center text-accent-cyan text-3xl mb-6 group-hover:bg-cyan-500/20 transition-colors">
                        <i class="fas fa-plane-departure"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-4">Pengalaman Praktis</h4>
                    <p class="text-slate-300">Terjun langsung ke operasional dan pengelolaan bandara internasional.</p>
                </div>

                <!-- Card 2 -->
                <div class="glass rounded-3xl p-8 hover:scale-[1.03] transition-all duration-300 group"
                    data-aos="fade-up" data-aos-delay="150">
                    <div
                        class="w-16 h-16 rounded-2xl bg-cyan-500/10 flex items-center justify-center text-accent-cyan text-3xl mb-6 group-hover:bg-cyan-500/20 transition-colors">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-4">Mentoring</h4>
                    <p class="text-slate-300">Bimbingan dari para praktisi ahli yang telah berpengalaman di industri
                        ini.</p>
                </div>

                <!-- Card 3 -->
                <div class="glass rounded-3xl p-8 hover:scale-[1.03] transition-all duration-300 group"
                    data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="w-16 h-16 rounded-2xl bg-cyan-500/10 flex items-center justify-center text-accent-cyan text-3xl mb-6 group-hover:bg-cyan-500/20 transition-colors">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-4">Sertifikat Resmi</h4>
                    <p class="text-slate-300">Dapatkan sertifikat resmi Injourney Airports untuk
                        portofolio CV Anda.</p>
                </div>

                <!-- Card 4 -->
                <div class="glass rounded-3xl p-8 hover:scale-[1.03] transition-all duration-300 group"
                    data-aos="fade-up" data-aos-delay="250">
                    <div
                        class="w-16 h-16 rounded-2xl bg-cyan-500/10 flex items-center justify-center text-accent-cyan text-3xl mb-6 group-hover:bg-cyan-500/20 transition-colors">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-4">Networking Luas</h4>
                    <p class="text-slate-300">Bangun relasi profesional di industri pengelolaan bandara.</p>
                </div>

                <!-- Card 5 -->
                <div class="glass rounded-3xl p-8 hover:scale-[1.03] transition-all duration-300 group"
                    data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="w-16 h-16 rounded-2xl bg-cyan-500/10 flex items-center justify-center text-accent-cyan text-3xl mb-6 group-hover:bg-cyan-500/20 transition-colors">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-4">Peluang Karir</h4>
                    <p class="text-slate-300">Akses informasi rekrutmen dan peluang karir di ekosistem Injourney.</p>
                </div>

                <!-- Card 6 -->
                <div class="glass rounded-3xl p-8 hover:scale-[1.03] transition-all duration-300 group"
                    data-aos="fade-up" data-aos-delay="350">
                    <div
                        class="w-16 h-16 rounded-2xl bg-cyan-500/10 flex items-center justify-center text-accent-cyan text-3xl mb-6 group-hover:bg-cyan-500/20 transition-colors">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h4 class="text-2xl font-bold mb-4">Skill Development</h4>
                    <p class="text-slate-300">Pengembangan soft-skill kepemimpinan, komunikasi, dan problem solving
                        nyata.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Requirements -->
    <section id="requirements" class="py-24">
        <div class="container mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-16 items-center" data-aos="fade-up">
                <div class="lg:w-1/3 text-center lg:text-left">
                    <h2 class="text-accent-cyan font-semibold text-sm tracking-widest uppercase mb-4">Persyaratan</h2>
                    <h3 class="text-4xl md:text-5xl font-bold mb-6">Siapkan Dokumen Anda</h3>
                    <p class="text-slate-400 text-lg mb-8">Pastikan Anda memenuhi kriteria dan melengkapi seluruh
                        dokumen sebelum mendaftar.</p>
                    <a href="{{ route('public.register') }}"
                        class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-cyan-600 to-accent-cyan rounded-2xl text-slate-950 font-bold hover:shadow-xl hover:shadow-cyan-500/30 transition-all">
                        Daftar Sekarang <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="lg:w-2/3 grid md:grid-cols-2 gap-8">
                    <!-- Kriteria Peserta -->
                    <div class="glass rounded-3xl p-10">
                        <div class="flex items-center gap-5 mb-8">
                            <div
                                class="w-14 h-14 rounded-2xl bg-cyan-500/10 text-accent-cyan flex items-center justify-center text-2xl">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <h4 class="text-2xl font-bold">Kriteria Peserta</h4>
                        </div>
                        <ul class="space-y-5 text-slate-300">
                            <li class="flex items-start gap-4"><i class="fas fa-check text-accent-cyan mt-1.5"></i>
                                Mahasiswa atau siswa aktif</li>
                            <li class="flex items-start gap-4"><i class="fas fa-check text-accent-cyan mt-1.5"></i>
                                Sehat jasmani & rohani</li>
                            <li class="flex items-start gap-4"><i class="fas fa-check text-accent-cyan mt-1.5"></i>
                                Bersedia ditempatkan di unit kerja</li>
                        </ul>
                    </div>

                    <!-- Dokumen Wajib -->
                    <div class="glass rounded-3xl p-10">
                        <div class="flex items-center gap-5 mb-8">
                            <div
                                class="w-14 h-14 rounded-2xl bg-cyan-500/10 text-accent-cyan flex items-center justify-center text-2xl">
                                <i class="fas fa-file-lines"></i>
                            </div>
                            <h4 class="text-2xl font-bold">Dokumen Wajib</h4>
                        </div>
                        <ul class="space-y-5 text-slate-300">
                            <li class="flex items-start gap-4"><i class="fas fa-check text-accent-cyan mt-1.5"></i>
                                Lengkapi data diri</li>
                            <li class="flex items-start gap-4"><i class="fas fa-check text-accent-cyan mt-1.5"></i>
                                Download formulir dan isi</li>
                            <li class="flex items-start gap-4"><i class="fas fa-check text-accent-cyan mt-1.5"></i>
                                Upload formulir yang sudah diisi</li>
                            <li class="flex items-start gap-4"><i class="fas fa-check text-accent-cyan mt-1.5"></i>
                                Upload CV, Proposal, Surat Magang Resmi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Multi-step Form Contoh (ganti link asli dengan ini kalau mau embed langsung) -->
    <!-- Untuk sekarang saya beri contoh sederhana multi-step dengan glow -->
    <!-- Bisa dikembangkan lebih lanjut -->

    <!-- Footer -->
    <footer class="bg-slate-950 border-t border-slate-800/50 py-16">
        <div class="container mx-auto px-6 text-center">
            <div class="flex flex-col md:flex-row justify-center items-center gap-6 mb-10">
                <div class="flex items-center gap-4">
                    <div>
                        <span class="text-3xl font-bold">URSHIPORTS</span>
                        <p class="text-sm text-slate-500">Your Internship Programme at Injourney Airports</p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-center items-center gap-6 mb-10">
                <div class="flex items-center gap-4">
                    <div>
                        <img src="{{ asset('images/company-logo.png') }}" alt="Injourney Airports" class="h-14" />

                    </div>
                </div>
            </div>

            <div class="flex justify-center gap-8 mb-8">
                <a href="#benefits" class="text-slate-400 hover:text-accent-cyan">Keuntungan</a>
                <a href="#requirements" class="text-slate-400 hover:text-accent-cyan">Persyaratan</a>
                <a href="{{ route('login') }}" class="text-slate-400 hover:text-accent-cyan">Login</a>
            </div>

            <p class="text-slate-600 text-sm">
                © 2026 URSHIPORTS. All rights reserved. Powered by Human Capital Division.<br />
                <span class="font-medium text-slate-500">Injourney Airports Kantor Regional I</span>
            </p>
        </div>
    </footer>

    <!-- Init AOS -->
    <script>
        AOS.init({
            once: true,
            duration: 800
        });
    </script>

    <!-- Alpine.js CDN (untuk logic multi-step nanti) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</body>

</html>
