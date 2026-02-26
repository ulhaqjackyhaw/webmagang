<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Magang - URSHIPORTS</title>

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
                        'glow-pulse': 'glowPulse 2s ease-in-out infinite alternate',
                    },
                    keyframes: {
                        glowPulse: {
                            '0%': {
                                boxShadow: '0 0 15px rgba(34, 211, 238, 0.4)'
                            },
                            '100%': {
                                boxShadow: '0 0 35px rgba(34, 211, 238, 0.7)'
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
            color: #e2e8f0;
        }

        .glass {
            background: rgba(30, 41, 59, 0.5);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(34, 211, 238, 0.15);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #22d3ee;
            box-shadow: 0 0 0 4px rgba(34, 211, 238, 0.25);
        }

        /* Uppercase input text */
        input[type="text"],
        input[type="email"] {
            text-transform: uppercase;
        }

        input[type="text"]::placeholder,
        input[type="email"]::placeholder {
            text-transform: none;
        }

        .file-input::-webkit-file-upload-button {
            background: linear-gradient(135deg, #22d3ee, #06b6d4);
            color: #0f172a;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
        }

        .gradient-header {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #22d3ee 100%);
        }
    </style>
</head>

<body class="min-h-screen antialiased selection:bg-accent-cyan selection:text-slate-950">

    <!-- Header -->
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center justify-between" data-aos="fade-down">
            <a href="{{ route('public.landing') }}" class="flex items-center gap-3 hover:opacity-90 transition">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">URSHIPORTS</h1>
                    <p class="text-xs text-slate-400">Your Internship Programme at Injourney Airports</p>
                </div>
            </a>
            <a href="{{ route('public.landing') }}"
                class="flex items-center gap-2 text-slate-300 hover:text-accent-cyan transition font-medium">
                <i class="fas fa-arrow-left"></i>
                <span class="hidden md:inline">Kembali ke Landing Page</span>
            </a>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-12 max-w-4xl">
        <div class="glass rounded-3xl overflow-hidden shadow-2xl" data-aos="fade-up" data-aos-duration="800">
            <!-- Header Gradient -->
            <div class="gradient-header p-12 text-center">
                <i class="fas fa-rocket text-6xl mb-6 text-white opacity-90"></i>
                <h2 class="text-4xl md:text-5xl font-extrabold text-white mb-4 tracking-tight">Pendaftaran Magang
                    URSHIPORTS</h2>
                <p class="text-xl text-cyan-100 opacity-95">Lengkapi data dan unggah dokumen Anda dengan aman & cepat
                </p>
            </div>

            <div class="p-8 md:p-12">

                <!-- Instruksi Pengisian -->
                <div class="bg-cyan-900/30 border border-cyan-500/50 text-cyan-100 px-6 py-4 rounded-2xl mb-10 backdrop-blur-sm flex items-center gap-3"
                    data-aos="fade-up">
                    <i class="fas fa-info-circle text-accent-cyan text-xl"></i>
                    <span class="font-medium">Mohon melakukan pengisian data dengan benar</span>
                </div>

                @if ($errors->any())
                    <div class="bg-red-900/40 border border-red-500/50 text-red-200 px-6 py-4 rounded-2xl mb-10 backdrop-blur-sm"
                        role="alert">
                        <strong class="font-bold block mb-2">Ada kesalahan!</strong>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Requirements Info - Bento style -->
                {{-- <div class="grid md:grid-cols-2 gap-8 mb-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="glass rounded-2xl p-8">
                        <div class="flex items-center gap-4 mb-6">
                            <div
                                class="w-12 h-12 rounded-xl bg-accent-cyan/20 text-accent-cyan flex items-center justify-center text-2xl">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <h4 class="text-xl font-bold text-white">Kriteria Peserta</h4>
                        </div>
                        <ul class="space-y-4 text-slate-300">
                            <li class="flex items-start gap-3"><i class="fas fa-check text-accent-cyan mt-1"></i>
                                Mahasiswa atau siswa aktif</li>
                            <li class="flex items-start gap-3"><i class="fas fa-check text-accent-cyan mt-1"></i> Sehat
                                jasmani & rohani</li>
                            <li class="flex items-start gap-3"><i class="fas fa-check text-accent-cyan mt-1"></i>
                                Bersedia ditempatkan di unit kerja</li>
                        </ul>
                    </div>

                    <div class="glass rounded-2xl p-8">
                        <div class="flex items-center gap-4 mb-6">
                            <div
                                class="w-12 h-12 rounded-xl bg-accent-cyan/20 text-accent-cyan flex items-center justify-center text-2xl">
                                <i class="fas fa-file-lines"></i>
                            </div>
                            <h4 class="text-xl font-bold text-white">Dokumen Wajib</h4>
                        </div>
                        <ul class="space-y-4 text-slate-300">
                            <li class="flex items-start gap-3"><i class="fas fa-check text-accent-cyan mt-1"></i>
                                Lengkapi data diri</li>
                            {{-- Formulir upload dihilangkan karena sudah input data kampus by ketik --}}
                {{-- <li class="flex items-start gap-3"><i class="fas fa-check text-accent-cyan mt-1"></i>
                                Download formulir dan isi</li>
                            <li class="flex items-start gap-3"><i class="fas fa-check text-accent-cyan mt-1"></i> Upload
                                formulir yang sudah diisi</li> --}}
                {{-- <li class="flex items-start gap-3"><i class="fas fa-check text-accent-cyan mt-1"></i> Upload
                                CV, Proposal, Surat Magang Resmi</li>
                        </ul>
                    </div>
                </div> --}}

                <form action="{{ route('public.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-10">
                    @csrf

                    <!-- Periode Magang -->
                    <div class="glass rounded-2xl p-8" data-aos="fade-up" data-aos-delay="150">
                        <h3 class="text-2xl font-bold mb-4 flex items-center gap-3">
                            <i class="fas fa-calendar-alt text-accent-cyan"></i> Periode Pendaftaran Magang Kantor
                            Regional I
                        </h3>
                        <p class="text-slate-400 text-sm mb-6">Pilih periode pelaksanaan magang yang Anda inginkan *</p>

                        <input type="hidden" name="periode_magang" id="periode_magang"
                            value="{{ old('periode_magang') }}" required />

                        <div class="space-y-6">
                            <!-- Periode Pendaftaran Juni 2026 -->
                            <div class="bg-slate-800/30 rounded-xl p-5 border border-slate-700">
                                <div class="flex items-center gap-3 mb-4">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-cyan-500/20 text-accent-cyan flex items-center justify-center">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-white">Pendaftaran Juni 2026</h4>
                                        <p class="text-xs text-slate-400">Pilih salah satu periode pelaksanaan</p>
                                    </div>
                                </div>
                                <div class="grid sm:grid-cols-2 gap-4">
                                    <button type="button" onclick="selectPeriode('Juli - September 2026')"
                                        class="periode-btn px-5 py-4 rounded-xl border-2 border-slate-600 bg-slate-800/50 text-left hover:border-accent-cyan hover:bg-slate-700/50 transition-all group"
                                        data-periode="Juli - September 2026">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p
                                                    class="font-semibold text-white group-hover:text-accent-cyan transition-colors">
                                                    Juli - September 2026</p>
                                                <p class="text-xs text-slate-400 mt-1">3 bulan pelaksanaan</p>
                                            </div>
                                            <i
                                                class="fas fa-check-circle text-accent-cyan opacity-0 periode-check transition-opacity"></i>
                                        </div>
                                    </button>
                                    <button type="button" onclick="selectPeriode('Oktober - Desember 2026')"
                                        class="periode-btn px-5 py-4 rounded-xl border-2 border-slate-600 bg-slate-800/50 text-left hover:border-accent-cyan hover:bg-slate-700/50 transition-all group"
                                        data-periode="Oktober - Desember 2026">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p
                                                    class="font-semibold text-white group-hover:text-accent-cyan transition-colors">
                                                    Oktober - Desember 2026</p>
                                                <p class="text-xs text-slate-400 mt-1">3 bulan pelaksanaan</p>
                                            </div>
                                            <i
                                                class="fas fa-check-circle text-accent-cyan opacity-0 periode-check transition-opacity"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>

                            <!-- Periode Pendaftaran Desember 2026 -->
                            <div class="bg-slate-800/30 rounded-xl p-5 border border-slate-700">
                                <div class="flex items-center gap-3 mb-4">
                                    <div
                                        class="w-10 h-10 rounded-lg bg-cyan-500/20 text-accent-cyan flex items-center justify-center">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-white">Pendaftaran Desember 2026</h4>
                                        <p class="text-xs text-slate-400">Pilih salah satu periode pelaksanaan</p>
                                    </div>
                                </div>
                                <div class="grid sm:grid-cols-2 gap-4">
                                    <button type="button" onclick="selectPeriode('Januari - Maret 2027')"
                                        class="periode-btn px-5 py-4 rounded-xl border-2 border-slate-600 bg-slate-800/50 text-left hover:border-accent-cyan hover:bg-slate-700/50 transition-all group"
                                        data-periode="Januari - Maret 2027">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p
                                                    class="font-semibold text-white group-hover:text-accent-cyan transition-colors">
                                                    Januari - Maret 2027</p>
                                                <p class="text-xs text-slate-400 mt-1">3 bulan pelaksanaan</p>
                                            </div>
                                            <i
                                                class="fas fa-check-circle text-accent-cyan opacity-0 periode-check transition-opacity"></i>
                                        </div>
                                    </button>
                                    <button type="button" onclick="selectPeriode('April - Juni 2027')"
                                        class="periode-btn px-5 py-4 rounded-xl border-2 border-slate-600 bg-slate-800/50 text-left hover:border-accent-cyan hover:bg-slate-700/50 transition-all group"
                                        data-periode="April - Juni 2027">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <p
                                                    class="font-semibold text-white group-hover:text-accent-cyan transition-colors">
                                                    April - Juni 2027</p>
                                                <p class="text-xs text-slate-400 mt-1">3 bulan pelaksanaan</p>
                                            </div>
                                            <i
                                                class="fas fa-check-circle text-accent-cyan opacity-0 periode-check transition-opacity"></i>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Selected Period Display -->
                        <div id="selected-periode-display" class="mt-6 hidden">
                            <div
                                class="bg-accent-cyan/10 border border-accent-cyan/30 rounded-xl px-5 py-3 flex items-center gap-3">
                                <i class="fas fa-check-circle text-accent-cyan"></i>
                                <span class="text-accent-cyan font-medium">Periode dipilih: <span
                                        id="selected-periode-text"></span></span>
                            </div>
                        </div>
                    </div>

                    <!-- Data Pribadi -->
                    <div class="glass rounded-2xl p-8" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                            <i class="fas fa-user text-accent-cyan"></i> Data Pribadi
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-slate-300 mb-2">Nama
                                    Lengkap
                                    *</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                    required
                                    class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:border-accent-cyan transition-all" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-300 mb-2">Jenis Kelamin *</label>
                                <div class="flex gap-4">
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" name="jenis_kelamin" value="Laki-laki"
                                            {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required
                                            class="hidden peer" />
                                        <div
                                            class="px-5 py-3 bg-slate-800/50 border-2 border-slate-600 rounded-xl text-white text-center peer-checked:border-accent-cyan peer-checked:bg-accent-cyan/10 hover:border-slate-500 transition-all">
                                            <i class="fas fa-mars mr-2"></i> Laki-laki
                                        </div>
                                    </label>
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" name="jenis_kelamin" value="Perempuan"
                                            {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required
                                            class="hidden peer" />
                                        <div
                                            class="px-5 py-3 bg-slate-800/50 border-2 border-slate-600 rounded-xl text-white text-center peer-checked:border-accent-cyan peer-checked:bg-accent-cyan/10 hover:border-slate-500 transition-all">
                                            <i class="fas fa-venus mr-2"></i> Perempuan
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div>
                                <label for="nim" class="block text-sm font-medium text-slate-300 mb-2">NIM
                                    *</label>
                                <input type="text" name="nim" id="nim" value="{{ old('nim') }}"
                                    required
                                    class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:border-accent-cyan transition-all" />
                            </div>
                            <div>
                                <label for="no_wa" class="block text-sm font-medium text-slate-300 mb-2">Nomor
                                    WhatsApp *</label>
                                <input type="text" name="no_wa" id="no_wa" value="{{ old('no_wa') }}"
                                    required placeholder="Contoh: 081234567890"
                                    class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:border-accent-cyan transition-all" />
                            </div>
                            <div>
                                <label for="email_kampus" class="block text-sm font-medium text-slate-300 mb-2">Email
                                    Kampus</label>
                                <input type="email" name="email_kampus" id="email_kampus"
                                    value="{{ old('email_kampus') }}" placeholder="nama@university.ac.id"
                                    class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:border-accent-cyan transition-all" />
                            </div>
                        </div>
                    </div>

                    <!-- Data Akademik -->
                    <div class="glass rounded-2xl p-8 relative z-[100]" data-aos="fade-up" data-aos-delay="300">
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                            <i class="fas fa-graduation-cap text-accent-cyan"></i> Data Akademik
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="asal_kampus" class="block text-sm font-medium text-slate-300 mb-2">Asal
                                    Kampus *</label>

                                <!-- Hidden select for form submission -->
                                <select name="asal_kampus" id="asal_kampus" required class="hidden">
                                    <option value="">-- Pilih Universitas/Kampus --</option>
                                    @foreach ($universities as $university)
                                        <option value="{{ $university }}"
                                            {{ old('asal_kampus') == $university ? 'selected' : '' }}>
                                            {{ $university }}
                                        </option>
                                    @endforeach
                                    <option value="Lainnya" {{ old('asal_kampus') == 'Lainnya' ? 'selected' : '' }}>
                                        Lainnya (Tulis Sendiri)</option>
                                </select>

                                <!-- Custom Searchable Dropdown -->
                                <div class="searchable-select-container relative" id="kampus_dropdown_container">
                                    <div id="kampus_selected"
                                        class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white cursor-pointer flex items-center justify-between hover:border-accent-cyan transition-all">
                                        <span id="kampus_selected_text" class="truncate">-- Pilih Universitas/Kampus
                                            --</span>
                                        <i class="fas fa-chevron-down text-slate-400 transition-transform"
                                            id="kampus_arrow"></i>
                                    </div>
                                    <div id="kampus_dropdown"
                                        class="absolute z-[9999] w-full mt-2 bg-slate-800 border border-slate-600 rounded-xl shadow-2xl hidden max-h-72 overflow-hidden">
                                        <div class="p-3 border-b border-slate-700">
                                            <div class="relative">
                                                <i
                                                    class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                                <input type="text" id="kampus_search" placeholder="Cari kampus..."
                                                    class="w-full pl-10 pr-4 py-2.5 bg-slate-700/50 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:border-accent-cyan focus:outline-none transition-all" />
                                            </div>
                                        </div>
                                        <div id="kampus_options" class="overflow-y-auto max-h-52">
                                            <!-- Options will be populated by JS -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="kampus_lainnya_wrapper" style="display: none;">
                                <label for="kampus_lainnya" class="block text-sm font-medium text-slate-300 mb-2">Nama
                                    Kampus Lainnya *</label>
                                <input type="text" name="kampus_lainnya" id="kampus_lainnya"
                                    value="{{ old('kampus_lainnya') }}" placeholder="Ketik nama kampus Anda"
                                    class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:border-accent-cyan transition-all" />
                            </div>
                            <div id="program_studi_wrapper"
                                class="{{ old('asal_kampus') == 'Lainnya' ? 'md:col-span-2' : '' }}">
                                <label for="program_studi"
                                    class="block text-sm font-medium text-slate-300 mb-2">Program Studi *</label>
                                <input type="text" name="program_studi" id="program_studi"
                                    value="{{ old('program_studi') }}" required
                                    class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:border-accent-cyan transition-all" />
                            </div>
                        </div>
                    </div>

                    {{-- Download Formulir - Dihilangkan karena sudah input data kampus by ketik --}}
                    {{-- <div class="glass rounded-2xl p-8" data-aos="fade-up" data-aos-delay="400">
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                            <i class="fas fa-download text-accent-cyan"></i> Download Formulir
                        </h3>

                        @if ($formulirs->isEmpty())
                            <div class="bg-slate-800/40 border border-slate-600 rounded-xl p-8 text-center">
                                <i class="fas fa-info-circle text-slate-400 text-4xl mb-4"></i>
                                <p class="text-slate-300">Belum ada formulir yang tersedia saat ini.</p>
                            </div>
                        @else
                            <div class="bg-slate-800/40 border border-slate-600 rounded-xl p-8">
                                <p class="text-slate-300 mb-6 flex items-center gap-3">
                                    <i class="fas fa-info-circle text-accent-cyan"></i>
                                    Download formulir, isi lengkap, lalu upload di bagian dokumen.
                                </p>
                                <div class="space-y-4">
                                    @foreach ($formulirs as $formulir)
                                        <div
                                            class="bg-slate-900/50 border border-slate-700 rounded-xl p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="w-14 h-14 bg-accent-cyan/10 rounded-xl flex items-center justify-center">
                                                    <i class="fas fa-file-pdf text-accent-cyan text-2xl"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold text-white">
                                                        {{ $formulir->nama_formulir }}</h4>
                                                    @if ($formulir->deskripsi)
                                                        <p class="text-sm text-slate-400 mt-1">
                                                            {{ $formulir->deskripsi }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <a href="{{ route('public.download-formulir', $formulir->id) }}"
                                                class="inline-flex items-center gap-2 bg-gradient-to-r from-accent-cyan to-cyanDark text-slate-950 font-bold py-3 px-6 rounded-xl hover:shadow-lg hover:shadow-cyan-500/30 transition-all hover:scale-105">
                                                <i class="fas fa-file-download"></i> Download
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div> --}}

                    <!-- Upload Dokumen -->
                    <div class="glass rounded-2xl p-8" data-aos="fade-up" data-aos-delay="500">
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                            <i class="fas fa-file-upload text-accent-cyan"></i> Dokumen Persyaratan
                        </h3>
                        <p
                            class="text-sm text-yellow-300 bg-yellow-900/30 border border-yellow-600/50 rounded-xl p-5 mb-8 flex items-start gap-3">
                            <i class="fas fa-exclamation-triangle mt-0.5"></i>
                            <span><strong>Format:</strong> PDF, DOC, DOCX | <strong>Maks:</strong> 2MB per file</span>
                        </p>

                        <div class="space-y-6">
                            {{-- File Formulir - Dihilangkan karena sudah input data kampus by ketik --}}
                            {{-- <div>
                                <label for="file_formulir"
                                    class="block text-sm font-medium text-slate-300 mb-2 flex items-center gap-2">
                                    <i class="fas fa-file-signature text-accent-cyan"></i> Formulir Pendaftaran yang
                                    Sudah Diisi *
                                </label>
                                <input type="file" name="file_formulir" id="file_formulir" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-5 py-4 bg-slate-800/50 border border-slate-600 rounded-xl text-slate-300 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:font-medium file:bg-gradient-to-r file:from-accent-cyan file:to-cyanDark file:text-slate-950 hover:file:opacity-90 transition-all" />
                            </div> --}}

                            <!-- Sisanya (CV, Proposal, Surat) pola sama, copy-paste dan ganti name/id/label -->
                            <div>
                                <label for="file_cv"
                                    class="block text-sm font-medium text-slate-300 mb-2 flex items-center gap-2">
                                    <i class="fas fa-id-card text-accent-cyan"></i> Curriculum Vitae (CV) *
                                </label>
                                <input type="file" name="file_cv" id="file_cv" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-5 py-4 bg-slate-800/50 border border-slate-600 rounded-xl text-slate-300 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:font-medium file:bg-gradient-to-r file:from-accent-cyan file:to-cyanDark file:text-slate-950 hover:file:opacity-90 transition-all" />
                            </div>

                            <div>
                                <label for="file_proposal"
                                    class="block text-sm font-medium text-slate-300 mb-2 flex items-center gap-2">
                                    <i class="fas fa-file-alt text-accent-cyan"></i> Proposal Magang *
                                </label>
                                <input type="file" name="file_proposal" id="file_proposal" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-5 py-4 bg-slate-800/50 border border-slate-600 rounded-xl text-slate-300 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:font-medium file:bg-gradient-to-r file:from-accent-cyan file:to-cyanDark file:text-slate-950 hover:file:opacity-90 transition-all" />
                            </div>

                            <div>
                                <label for="file_surat"
                                    class="block text-sm font-medium text-slate-300 mb-2 flex items-center gap-2">
                                    <i class="fas fa-envelope-open-text text-accent-cyan"></i> Surat Permohonan Magang
                                    Resmi *
                                </label>
                                <input type="file" name="file_surat" id="file_surat" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-5 py-4 bg-slate-800/50 border border-slate-600 rounded-xl text-slate-300 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:font-medium file:bg-gradient-to-r file:from-accent-cyan file:to-cyanDark file:text-slate-950 hover:file:opacity-90 transition-all" />
                            </div>
                        </div>
                    </div>

                    <!-- Persetujuan -->
                    <div class="glass rounded-2xl p-8" data-aos="fade-up" data-aos-delay="600">
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                            <i class="fas fa-check-circle text-accent-cyan"></i> Persetujuan & Pernyataan
                        </h3>
                        <div class="space-y-6 bg-slate-800/30 rounded-xl p-6 border border-slate-700">
                            <label class="flex items-start gap-4 cursor-pointer">
                                <input type="checkbox" name="persetujuan_sehat" id="persetujuan_sehat" required
                                    class="mt-1.5 h-5 w-5 text-accent-cyan border-slate-600 rounded focus:ring-accent-cyan" />
                                <span class="text-slate-300 text-sm">Saya menyatakan bahwa saya dalam kondisi <strong
                                        class="text-white">sehat jasmani dan rohani</strong>, serta mampu menjalankan
                                    program magang dengan baik. *</span>
                            </label>

                            <label class="flex items-start gap-4 cursor-pointer">
                                <input type="checkbox" name="persetujuan_penempatan" id="persetujuan_penempatan"
                                    required
                                    class="mt-1.5 h-5 w-5 text-accent-cyan border-slate-600 rounded focus:ring-accent-cyan" />
                                <span class="text-slate-300 text-sm">Saya <strong class="text-white">bersedia
                                        ditempatkan di unit kerja manapun</strong> sesuai kebutuhan dan kebijakan
                                    Injourney Airports Kantor Regional I. *</span>
                            </label>

                            <label class="flex items-start gap-4 cursor-pointer">
                                <input type="checkbox" name="persetujuan_data" id="persetujuan_data" required
                                    class="mt-1.5 h-5 w-5 text-accent-cyan border-slate-600 rounded focus:ring-accent-cyan" />
                                <span class="text-slate-300 text-sm">Saya menyatakan bahwa <strong
                                        class="text-white">seluruh data dan dokumen yang saya berikan adalah
                                        benar</strong> dan dapat dipertanggungjawabkan. *</span>
                            </label>
                        </div>
                    </div>

                    <!-- Submit -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-6 pt-8 border-t border-slate-700"
                        data-aos="fade-up" data-aos-delay="700">
                        <a href="{{ route('public.landing') }}"
                            class="text-slate-400 hover:text-accent-cyan font-medium transition flex items-center gap-2 order-2 sm:order-1">
                            <i class="fas fa-arrow-left"></i> Batal
                        </a>
                        <button type="submit"
                            class="bg-gradient-to-r from-accent-cyan to-cyanDark text-slate-950 font-bold py-5 px-12 rounded-2xl shadow-2xl shadow-cyan-500/30 hover:shadow-cyan-400/50 transition-all hover:scale-105 flex items-center gap-3 w-full sm:w-auto order-1 sm:order-2">
                            <i class="fas fa-paper-plane"></i> Kirim Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer kecil -->
        <div class="text-center mt-10 text-slate-500 text-sm" data-aos="fade-up">
            <p><i class="fas fa-shield-alt mr-2 text-accent-cyan"></i> Data Anda aman dan terlindungi sesuai standar
                Injourney Airports</p>
        </div>
    </div>

    <script>
        AOS.init({
            once: true,
            duration: 800
        });

        // Toggle kampus lainnya input
        function toggleKampusLainnya(value) {
            const lainnyaWrapper = document.getElementById('kampus_lainnya_wrapper');
            const lainnyaInput = document.getElementById('kampus_lainnya');
            const prodiWrapper = document.getElementById('program_studi_wrapper');

            if (value === 'Lainnya') {
                lainnyaWrapper.style.display = 'block';
                lainnyaInput.required = true;
                prodiWrapper.classList.add('md:col-span-2');
            } else {
                lainnyaWrapper.style.display = 'none';
                lainnyaInput.required = false;
                lainnyaInput.value = '';
                prodiWrapper.classList.remove('md:col-span-2');
            }
        }

        // Searchable Dropdown for Kampus
        class SearchableSelect {
            constructor(selectId, containerId) {
                this.select = document.getElementById(selectId);
                this.container = document.getElementById(containerId);
                this.selectedDisplay = document.getElementById('kampus_selected');
                this.selectedText = document.getElementById('kampus_selected_text');
                this.dropdown = document.getElementById('kampus_dropdown');
                this.searchInput = document.getElementById('kampus_search');
                this.optionsContainer = document.getElementById('kampus_options');
                this.arrow = document.getElementById('kampus_arrow');
                this.isOpen = false;
                this.options = [];

                this.init();
            }

            init() {
                // Build options from select
                this.buildOptions();

                // Set initial selected value
                this.updateSelectedDisplay();

                // Event listeners
                this.selectedDisplay.addEventListener('click', () => this.toggle());
                this.searchInput.addEventListener('input', (e) => this.filterOptions(e.target.value));
                this.searchInput.addEventListener('click', (e) => e.stopPropagation());

                // Close on outside click
                document.addEventListener('click', (e) => {
                    if (!this.container.contains(e.target)) {
                        this.close();
                    }
                });

                // Keyboard navigation
                this.searchInput.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') this.close();
                });
            }

            buildOptions() {
                this.options = Array.from(this.select.options).map(opt => ({
                    value: opt.value,
                    text: opt.text,
                    selected: opt.selected
                }));
                this.renderOptions(this.options);
            }

            renderOptions(options) {
                this.optionsContainer.innerHTML = options.map(opt => `
                    <div class="kampus-option px-4 py-3 cursor-pointer hover:bg-accent-cyan/20 transition-colors ${opt.value === this.select.value ? 'bg-accent-cyan/30 text-accent-cyan' : 'text-slate-200'}"
                        data-value="${opt.value}">
                        ${opt.text}
                    </div>
                `).join('');

                // Add click listeners to options
                this.optionsContainer.querySelectorAll('.kampus-option').forEach(optEl => {
                    optEl.addEventListener('click', () => this.selectOption(optEl.dataset.value));
                });
            }

            filterOptions(keyword) {
                const filtered = this.options.filter(opt =>
                    opt.text.toLowerCase().includes(keyword.toLowerCase()) ||
                    opt.value === '' ||
                    opt.value === 'Lainnya'
                );
                this.renderOptions(filtered);
            }

            selectOption(value) {
                this.select.value = value;
                this.updateSelectedDisplay();
                this.close();

                // Trigger change event for toggleKampusLainnya
                toggleKampusLainnya(value);
            }

            updateSelectedDisplay() {
                const selectedOption = this.options.find(opt => opt.value === this.select.value);
                if (selectedOption) {
                    this.selectedText.textContent = selectedOption.text;
                    if (this.select.value) {
                        this.selectedText.classList.remove('text-slate-400');
                        this.selectedText.classList.add('text-white');
                    } else {
                        this.selectedText.classList.add('text-slate-400');
                        this.selectedText.classList.remove('text-white');
                    }
                }
            }

            toggle() {
                this.isOpen ? this.close() : this.open();
            }

            open() {
                this.isOpen = true;
                this.dropdown.classList.remove('hidden');
                this.arrow.classList.add('rotate-180');
                this.selectedDisplay.classList.add('border-accent-cyan', 'ring-2', 'ring-accent-cyan/25');
                this.searchInput.value = '';
                this.renderOptions(this.options);
                setTimeout(() => this.searchInput.focus(), 50);
            }

            close() {
                this.isOpen = false;
                this.dropdown.classList.add('hidden');
                this.arrow.classList.remove('rotate-180');
                this.selectedDisplay.classList.remove('border-accent-cyan', 'ring-2', 'ring-accent-cyan/25');
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize searchable select
            new SearchableSelect('asal_kampus', 'kampus_dropdown_container');

            // Check for old() values
            const kampusSelect = document.getElementById('asal_kampus');
            if (kampusSelect.value === 'Lainnya') {
                toggleKampusLainnya('Lainnya');
            }

            // Check for old() periode value
            const periodeValue = document.getElementById('periode_magang').value;
            if (periodeValue) {
                selectPeriode(periodeValue);
            }

            // Auto uppercase for text inputs
            const uppercaseInputs = document.querySelectorAll('input[type="text"], input[type="email"]');
            uppercaseInputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    this.value = this.value.toUpperCase();
                });
            });
        });

        // Select periode magang
        function selectPeriode(periode) {
            // Update hidden input
            document.getElementById('periode_magang').value = periode;

            // Remove selected state from all buttons
            document.querySelectorAll('.periode-btn').forEach(btn => {
                btn.classList.remove('border-accent-cyan', 'bg-accent-cyan/10');
                btn.classList.add('border-slate-600', 'bg-slate-800/50');
                btn.querySelector('.periode-check').classList.add('opacity-0');
                btn.querySelector('.periode-check').classList.remove('opacity-100');
            });

            // Add selected state to clicked button
            const selectedBtn = document.querySelector(`.periode-btn[data-periode="${periode}"]`);
            if (selectedBtn) {
                selectedBtn.classList.remove('border-slate-600', 'bg-slate-800/50');
                selectedBtn.classList.add('border-accent-cyan', 'bg-accent-cyan/10');
                selectedBtn.querySelector('.periode-check').classList.remove('opacity-0');
                selectedBtn.querySelector('.periode-check').classList.add('opacity-100');
            }

            // Show selected display
            document.getElementById('selected-periode-display').classList.remove('hidden');
            document.getElementById('selected-periode-text').textContent = periode;
        }
    </script>
</body>

</html>
