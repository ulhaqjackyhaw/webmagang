<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pendaftaran Berhasil - URSHIPORTS</title>

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Tailwind CDN + custom config -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        accent: {
                            cyan: '#22d3ee',
                            cyanDark: '#06b6d4',
                        },
                        primary: {
                            900: '#0f172a',
                            800: '#1e293b',
                        },
                    },
                    animation: {
                        'success-pop': 'successPop 0.8s ease-out',
                        'fade-up': 'fadeInUp 1s ease-out forwards',
                    },
                    keyframes: {
                        successPop: {
                            '0%': {
                                transform: 'scale(0)',
                                opacity: '0'
                            },
                            '50%': {
                                transform: 'scale(1.15)'
                            },
                            '100%': {
                                transform: 'scale(1)',
                                opacity: '1'
                            },
                        },
                        fadeInUp: {
                            'from': {
                                opacity: '0',
                                transform: 'translateY(40px)'
                            },
                            'to': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                    },
                },
            },
        }
    </script>

    <!-- AOS untuk animasi reveal -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        body {
            background: linear-gradient(to bottom, #0f172a, #1e293b);
        }

        .glass {
            background: rgba(30, 41, 59, 0.55);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(34, 211, 238, 0.2);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.5);
        }

        .gradient-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 40%, #22d3ee 100%);
        }

        .glow-cyan {
            box-shadow: 0 0 30px rgba(34, 211, 238, 0.5);
        }
    </style>
</head>

<body
    class="min-h-screen flex items-center justify-center py-6 md:py-12 antialiased selection:bg-accent-cyan selection:text-slate-950">

    <div class="container mx-auto px-4 md:px-6 max-w-4xl">

        <!-- Logo Header -->
        <div class="text-center mb-6 md:mb-10" data-aos="fade-down">
            <img src="{{ asset('images/company-logo.png') }}" alt="Injourney Airports"
                class="h-12 md:h-16 mx-auto mb-4 md:mb-6" />
        </div>

        <div class="glass rounded-2xl md:rounded-3xl overflow-hidden shadow-2xl" data-aos="zoom-in"
            data-aos-duration="900">

            <!-- Success Header -->
            <div class="gradient-header pt-8 md:pt-16 pb-6 md:pb-10 px-4 md:px-8 text-center">
                <div
                    class="animate-success-pop bg-slate-900 rounded-full w-20 h-20 md:w-32 md:h-32 flex items-center justify-center mx-auto mb-4 md:mb-8 glow-cyan">
                    <i class="fas fa-check text-4xl md:text-6xl text-accent-cyan"></i>
                </div>
                <h1
                    class="text-2xl sm:text-3xl md:text-5xl lg:text-6xl font-extrabold text-white mb-2 md:mb-4 tracking-tight animate-fade-up">
                    Pendaftaran Berhasil!</h1>
                <p class="text-base md:text-xl text-cyan-100 opacity-95 animate-fade-up delay-200">
                    ID Pendaftaran: #{{ str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT) }}
                </p>
            </div>

            <!-- Main Content -->
            <div class="p-4 sm:p-6 md:p-10 lg:p-12">

                <div class="text-center mb-6 md:mb-10" data-aos="fade-up" data-aos-delay="200">
                    <p class="text-base sm:text-lg md:text-xl lg:text-2xl text-slate-200 leading-relaxed">
                        Terima kasih telah mendaftar program magang <strong
                            class="text-accent-cyan">URSHIPORTS</strong>.<br class="hidden sm:inline">
                        Data Anda telah kami terima dengan baik dan sedang dalam proses review oleh tim kami.
                    </p>
                </div>

                <!-- Timeline / Langkah Selanjutnya -->
                <div class="glass rounded-xl md:rounded-2xl p-4 sm:p-6 md:p-10 mb-6 md:mb-10" data-aos="fade-up"
                    data-aos-delay="300">
                    <h3 class="text-xl md:text-3xl font-bold text-white mb-4 md:mb-8 text-center">Langkah Selanjutnya
                    </h3>
                    <div class="space-y-4 md:space-y-8">
                        <div class="flex items-start gap-3 md:gap-6">
                            <div
                                class="rounded-full w-10 h-10 md:w-14 md:h-14 flex items-center justify-center flex-shrink-0 bg-gradient-to-br from-accent-cyan to-cyanDark text-slate-950 font-bold text-base md:text-xl shadow-lg">
                                1
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-base md:text-xl font-bold text-white mb-1 md:mb-2">Review Berkas</h4>
                                <p class="text-sm md:text-base text-slate-300">Tim HC kami akan mereview semua dokumen
                                    dan data yang Anda
                                    kirimkan.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 md:gap-6">
                            <div
                                class="rounded-full w-10 h-10 md:w-14 md:h-14 flex items-center justify-center flex-shrink-0 bg-gradient-to-br from-accent-cyan to-cyanDark text-slate-950 font-bold text-base md:text-xl shadow-lg">
                                2
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-base md:text-xl font-bold text-white mb-1 md:mb-2">Notifikasi WhatsApp
                                </h4>
                                <p class="text-sm md:text-base text-slate-300">Anda akan dihubungi melalui WhatsApp
                                    dalam <strong class="text-accent-cyan">3-5 hari kerja</strong>.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 md:gap-6">
                            <div
                                class="rounded-full w-10 h-10 md:w-14 md:h-14 flex items-center justify-center flex-shrink-0 bg-gradient-to-br from-accent-cyan to-cyanDark text-slate-950 font-bold text-base md:text-xl shadow-lg">
                                3
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-base md:text-xl font-bold text-white mb-1 md:mb-2">Konfirmasi &
                                    Informasi</h4>
                                <p class="text-sm md:text-base text-slate-300">Informasi lengkap mengenai hasil seleksi
                                    dan jadwal magang
                                    akan diberikan.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 md:gap-6">
                            <div
                                class="rounded-full w-10 h-10 md:w-14 md:h-14 flex items-center justify-center flex-shrink-0 bg-gradient-to-br from-accent-cyan to-cyanDark text-slate-950 font-bold text-base md:text-xl shadow-lg">
                                4
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-base md:text-xl font-bold text-white mb-1 md:mb-2">Ada Pertanyaan?</h4>
                                <p class="text-sm md:text-base text-slate-300">Apabila ada pertanyaan dapat menghubungi
                                    PIC berikut:</p>
                                <div class="mt-2 md:mt-3 space-y-2">
                                    <a href="https://wa.me/6287876695169"
                                        class="flex items-center gap-2 text-accent-cyan hover:text-cyan-300 transition text-sm md:text-base">
                                        <i class="fab fa-whatsapp flex-shrink-0"></i>
                                        <span>087876695169 <span class="text-slate-400 text-xs md:text-sm">(WhatsApp
                                                only)</span></span>
                                    </a>
                                    <a href="mailto:yudha.roland@injourneyairports.id"
                                        class="flex items-center gap-2 text-accent-cyan hover:text-cyan-300 transition text-sm md:text-base">
                                        <i class="fas fa-envelope flex-shrink-0"></i>
                                        <span class="break-all">yudha.roland@injourneyairports.id</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Important Notice -->
                <div class="bg-yellow-900/30 border border-yellow-600/50 rounded-xl md:rounded-2xl p-4 sm:p-6 md:p-8 mb-6 md:mb-10 flex items-start gap-3 md:gap-6"
                    data-aos="fade-up" data-aos-delay="400">
                    <i class="fas fa-exclamation-triangle text-yellow-400 text-2xl md:text-4xl flex-shrink-0 mt-1"></i>
                    <div class="min-w-0">
                        <h4 class="text-lg md:text-2xl font-bold text-yellow-300 mb-2 md:mb-4">Penting!</h4>
                        <ul class="text-slate-200 space-y-2 md:space-y-3 text-sm md:text-lg">
                            <li>• Pastikan nomor WhatsApp Anda aktif dan dapat dihubungi</li>
                            <li>• Periksa pesan masuk secara berkala</li>
                            <li>• Simpan nomor kami agar pesan tidak masuk ke spam</li>
                            <li>• Jika dalam 7 hari kerja belum ada kabar, hubungi kami</li>
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 md:gap-6 justify-center" data-aos="fade-up"
                    data-aos-delay="500">
                    <a href="{{ route('public.landing') }}"
                        class="inline-flex items-center justify-center bg-gradient-to-r from-accent-cyan to-cyanDark text-slate-950 font-bold py-3 md:py-5 px-6 md:px-12 rounded-xl md:rounded-2xl shadow-2xl shadow-cyan-500/40 hover:shadow-cyan-400/60 transition-all hover:scale-105 text-sm md:text-lg">
                        <i class="fas fa-home mr-2 md:mr-3"></i>
                        Kembali ke Beranda
                    </a>
                    <a href="{{ route('public.register') }}"
                        class="inline-flex items-center justify-center bg-transparent border-2 border-accent-cyan text-accent-cyan font-bold py-3 md:py-5 px-6 md:px-12 rounded-xl md:rounded-2xl hover:bg-accent-cyan/10 transition-all hover:scale-105 text-sm md:text-lg">
                        <i class="fas fa-plus-circle mr-2 md:mr-3"></i>
                        Daftar Lagi
                    </a>
                </div>
            </div>

            <!-- Footer Contact -->
            <div class="bg-slate-900/60 px-4 md:px-10 py-6 md:py-8 text-center border-t border-slate-700">
                <p class="text-slate-300 mb-3 md:mb-4 text-sm md:text-base">Butuh bantuan atau ada pertanyaan?</p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 md:gap-8 text-sm md:text-lg">
                    <a href="mailto:yudha.roland@injourneyairports.id"
                        class="flex items-center gap-2 md:gap-3 text-accent-cyan hover:text-cyan-300 transition">
                        <i class="fas fa-envelope flex-shrink-0"></i>
                        <span class="break-all">yudha.roland@injourneyairports.id</span>
                    </a>
                    <a href="https://wa.me/6287876695169"
                        class="flex items-center gap-2 md:gap-3 text-accent-cyan hover:text-cyan-300 transition">
                        <i class="fab fa-whatsapp flex-shrink-0"></i>
                        087876695169 (WhatsApp only)
                    </a>
                </div>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="text-center mt-6 md:mt-10 text-slate-500 text-xs md:text-sm" data-aos="fade-up"
            data-aos-delay="600">
            <p>© {{ date('Y') }} Injourney Airports Kantor Regional I</p>
            <p class="mt-1 text-accent-cyan">URSHIPORTS - Your Internship Programme</p>
        </div>
    </div>

    <script>
        AOS.init({
            once: true,
            duration: 900
        });
    </script>
</body>

</html>
