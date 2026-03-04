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
    <div class="container mx-auto px-4 sm:px-6 py-8">
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

    <div class="container mx-auto px-4 sm:px-6 pb-12 max-w-4xl">
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
                    <div class="glass rounded-2xl p-4 sm:p-8 overflow-hidden" data-aos="fade-up" data-aos-delay="150">
                        <h3 class="text-2xl font-bold mb-4 flex items-center gap-3">
                            <i class="fas fa-calendar-alt text-accent-cyan"></i> Periode Pendaftaran Magang Kantor
                            Regional I
                        </h3>
                        <p class="text-slate-400 text-sm mb-6">Pilih periode pendaftaran magang yang Tersedia</p>

                        <input type="hidden" name="periode_magang" id="periode_magang"
                            value="{{ old('periode_magang') }}" required />

                        <div class="space-y-6">
                            @forelse($periodes as $batchName => $batchPeriodes)
                                <div class="bg-slate-800/30 rounded-xl p-5 border border-slate-700">
                                    <div class="flex items-center gap-3 mb-4">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-cyan-500/20 text-accent-cyan flex items-center justify-center">
                                            <i class="fas fa-calendar"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-white">{{ $batchName }}</h4>
                                            <p class="text-xs text-slate-400">Pilih salah satu periode pendaftaran</p>
                                        </div>
                                    </div>
                                    <div class="grid sm:grid-cols-2 gap-4">
                                        @foreach ($batchPeriodes as $periode)
                                            <button type="button"
                                                onclick="selectPeriode('{{ $periode->nama_periode }}', '{{ $periode->tanggal_mulai->format('Y-m-d') }}', '{{ $periode->tanggal_selesai->format('Y-m-d') }}')"
                                                class="periode-btn px-5 py-4 rounded-xl border-2 border-slate-600 bg-slate-800/50 text-left hover:border-accent-cyan hover:bg-slate-700/50 transition-all group"
                                                data-periode="{{ $periode->nama_periode }}"
                                                data-start="{{ $periode->tanggal_mulai->format('Y-m-d') }}"
                                                data-end="{{ $periode->tanggal_selesai->format('Y-m-d') }}">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <p
                                                            class="font-semibold text-white group-hover:text-accent-cyan transition-colors">
                                                            {{ $periode->nama_periode }}</p>
                                                        <p class="text-xs text-slate-400 mt-1">
                                                            {{ $periode->tanggal_mulai->format('d M Y') }} -
                                                            {{ $periode->tanggal_selesai->format('d M Y') }}
                                                        </p>
                                                    </div>
                                                    <i
                                                        class="fas fa-check-circle text-accent-cyan opacity-0 periode-check transition-opacity"></i>
                                                </div>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="bg-slate-800/30 rounded-xl p-8 border border-slate-700 text-center">
                                    <i class="fas fa-calendar-times text-slate-500 text-4xl mb-4"></i>
                                    <p class="text-slate-400 font-medium">Tidak ada periode pendaftaran yang dibuka saat
                                        ini.</p>
                                    <p class="text-slate-500 text-sm mt-2">Silakan kunjungi kembali halaman ini nanti
                                        atau hubungi HC untuk informasi lebih lanjut.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Selected Period Display -->
                        <div id="selected-periode-display" class="mt-6 hidden">
                            <div class="bg-accent-cyan/10 border border-accent-cyan/30 rounded-xl px-5 py-4">
                                <div class="flex items-center gap-3 mb-4">
                                    <i class="fas fa-check-circle text-accent-cyan"></i>
                                    <span class="text-accent-cyan font-medium">Periode dipilih: <span
                                            id="selected-periode-text"></span></span>
                                </div>
                                <div class="bg-slate-800/50 rounded-lg p-4 border border-slate-700">
                                    <p class="text-sm text-slate-300 mb-3"><i
                                            class="fas fa-info-circle text-accent-cyan mr-2"></i>Pilih tanggal mulai
                                        (dalam periode) lalu tanggal selesai (durasi min. 1 bulan, maks. 6 bulan)</p>
                                    <div class="grid md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="tanggal_mulai_magang"
                                                class="block text-sm font-medium text-slate-300 mb-2">Tanggal Mulai
                                                Magang *</label>
                                            <input type="date" name="tanggal_mulai_magang" id="tanggal_mulai_magang"
                                                value="{{ old('tanggal_mulai_magang') }}" required
                                                class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white focus:border-accent-cyan transition-all"
                                                onchange="validateDates()" />
                                            <p class="text-xs text-slate-400 mt-1"><i
                                                    class="fas fa-calendar-check mr-1"></i>Harus dalam rentang periode
                                                yang dipilih</p>
                                        </div>
                                        <div>
                                            <label for="tanggal_selesai_magang"
                                                class="block text-sm font-medium text-slate-300 mb-2">Tanggal Selesai
                                                Magang *</label>
                                            <input type="date" name="tanggal_selesai_magang"
                                                id="tanggal_selesai_magang"
                                                value="{{ old('tanggal_selesai_magang') }}" required disabled
                                                class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white focus:border-accent-cyan transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                                                onchange="validateDates()" />
                                            <p class="text-xs text-slate-400 mt-1"><i
                                                    class="fas fa-clock mr-1"></i>Otomatis tersedia setelah pilih
                                                tanggal mulai (1-6 bulan)</p>
                                        </div>
                                    </div>
                                    <div id="date-validation-msg" class="mt-3 hidden">
                                        <p class="text-sm text-yellow-300"><i
                                                class="fas fa-exclamation-triangle mr-2"></i><span
                                                id="date-validation-text"></span></p>
                                    </div>
                                    <div id="duration-display" class="mt-3 hidden">
                                        <p class="text-sm text-green-400"><i class="fas fa-clock mr-2"></i>Durasi
                                            magang: <span id="duration-text"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Pribadi -->
                    <div class="glass rounded-2xl p-4 sm:p-8 overflow-hidden" data-aos="fade-up"
                        data-aos-delay="200">
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
                    <div class="glass rounded-2xl p-4 sm:p-8 relative z-[100]" data-aos="fade-up"
                        data-aos-delay="300">
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                            <i class="fas fa-graduation-cap text-accent-cyan"></i> Data Akademik
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="min-w-0">
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
                                        class="w-full px-4 sm:px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white cursor-pointer flex items-center justify-between hover:border-accent-cyan transition-all">
                                        <span id="kampus_selected_text" class="truncate text-sm sm:text-base">-- Pilih
                                            Universitas/Kampus
                                            --</span>
                                        <i class="fas fa-chevron-down text-slate-400 transition-transform"
                                            id="kampus_arrow"></i>
                                    </div>
                                    <div id="kampus_dropdown"
                                        class="absolute z-[9999] w-full mt-2 bg-slate-800 border border-slate-600 rounded-xl shadow-2xl hidden max-h-[60vh] overflow-hidden">
                                        <div class="p-3 border-b border-slate-700">
                                            <div class="relative">
                                                <i
                                                    class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                                                <input type="text" id="kampus_search" placeholder="Cari kampus..."
                                                    class="w-full pl-10 pr-4 py-2.5 bg-slate-700/50 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:border-accent-cyan focus:outline-none transition-all" />
                                            </div>
                                        </div>
                                        <div id="kampus_options" class="overflow-y-auto max-h-[50vh]">
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


                    <!-- Keterangan Surat Magang -->
                    <div class="glass rounded-2xl p-4 sm:p-8 overflow-hidden" data-aos="fade-up"
                        data-aos-delay="550">
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                            <i class="fas fa-file-signature text-accent-cyan"></i> Keterangan Surat Magang
                        </h3>
                        <p class="text-sm text-slate-400 mb-6">Isi keterangan berdasarkan surat permohonan magang resmi
                            dari kampus Anda</p>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="nomor_surat_kampus"
                                    class="block text-sm font-medium text-slate-300 mb-2">Nomor Surat Magang Kampus
                                    *</label>
                                <input type="text" name="nomor_surat_kampus" id="nomor_surat_kampus"
                                    value="{{ old('nomor_surat_kampus') }}" required
                                    placeholder="Contoh: 001/UN/PKL/2026"
                                    class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:border-accent-cyan transition-all" />
                            </div>
                            <div>
                                <label for="tanggal_surat"
                                    class="block text-sm font-medium text-slate-300 mb-2">Tanggal Surat *</label>
                                <input type="date" name="tanggal_surat" id="tanggal_surat"
                                    value="{{ old('tanggal_surat') }}" required
                                    class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white focus:border-accent-cyan transition-all" />
                            </div>
                            <div>
                                <label for="perihal_surat"
                                    class="block text-sm font-medium text-slate-300 mb-2">Perihal Surat *</label>
                                <input type="text" name="perihal_surat" id="perihal_surat"
                                    value="{{ old('perihal_surat') }}" required
                                    placeholder="Contoh: Permohonan Magang/PKL"
                                    class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:border-accent-cyan transition-all" />
                            </div>
                            <div>
                                <label for="pengirim_surat"
                                    class="block text-sm font-medium text-slate-300 mb-2">Pengirim / Penandatangan
                                    Surat *</label>
                                <input type="text" name="pengirim_surat" id="pengirim_surat"
                                    value="{{ old('pengirim_surat') }}" required
                                    placeholder="Contoh: Dekan Fakultas Teknik"
                                    class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:border-accent-cyan transition-all" />
                            </div>
                        </div>
                    </div>

                    <!-- Upload Dokumen -->
                    <div class="glass rounded-2xl p-4 sm:p-8 overflow-hidden" data-aos="fade-up"
                        data-aos-delay="500">
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                            <i class="fas fa-file-upload text-accent-cyan"></i> Dokumen Persyaratan
                        </h3>
                        <p
                            class="text-sm text-yellow-300 bg-yellow-900/30 border border-yellow-600/50 rounded-xl p-5 mb-8 flex items-start gap-3">
                            <i class="fas fa-exclamation-triangle mt-0.5"></i>
                            <span><strong>Format:</strong> PDF, DOC, DOCX | <strong>Maks:</strong> 2MB per file</span>
                        </p>

                        <div class="space-y-6">
                            <!-- 1. CV -->
                            <div>
                                <label for="file_cv"
                                    class="block text-sm font-medium text-slate-300 mb-2 flex items-center gap-2">
                                    <i class="fas fa-id-card text-accent-cyan"></i> Curriculum Vitae (CV) *
                                </label>
                                <input type="file" name="file_cv" id="file_cv" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-5 py-4 bg-slate-800/50 border border-slate-600 rounded-xl text-slate-300 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:font-medium file:bg-gradient-to-r file:from-accent-cyan file:to-cyanDark file:text-slate-950 hover:file:opacity-90 transition-all" />
                            </div>

                            <!-- 2. Transkrip Nilai -->
                            <div>
                                <label for="file_transkrip"
                                    class="block text-sm font-medium text-slate-300 mb-2 flex items-center gap-2">
                                    <i class="fas fa-file-alt text-accent-cyan"></i> Transkrip Nilai Terakhir *
                                </label>
                                <input type="file" name="file_transkrip" id="file_transkrip" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-5 py-4 bg-slate-800/50 border border-slate-600 rounded-xl text-slate-300 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:font-medium file:bg-gradient-to-r file:from-accent-cyan file:to-cyanDark file:text-slate-950 hover:file:opacity-90 transition-all" />
                            </div>

                            <!-- 3. KTP dan KTM/Kartu Pelajar -->
                            <div>
                                <label for="file_ktp_ktm"
                                    class="block text-sm font-medium text-slate-300 mb-2 flex items-center gap-2">
                                    <i class="fas fa-address-card text-accent-cyan"></i> Fotokopi KTP dan KTM/Kartu
                                    Pelajar (gabung 1 file) *
                                </label>
                                <input type="file" name="file_ktp_ktm" id="file_ktp_ktm" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-5 py-4 bg-slate-800/50 border border-slate-600 rounded-xl text-slate-300 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:font-medium file:bg-gradient-to-r file:from-accent-cyan file:to-cyanDark file:text-slate-950 hover:file:opacity-90 transition-all" />
                                <p class="text-xs text-slate-400 mt-2"><i
                                        class="fas fa-info-circle mr-1"></i>Gabungkan fotokopi KTP dan KTM/Kartu
                                    Pelajar dalam 1 file PDF</p>
                            </div>

                            <!-- 4. BPJS Kesehatan -->
                            <div>
                                <label for="file_bpjs"
                                    class="block text-sm font-medium text-slate-300 mb-2 flex items-center gap-2">
                                    <i class="fas fa-heartbeat text-accent-cyan"></i> Bukti Kepesertaan BPJS Kesehatan
                                    *
                                </label>
                                <input type="file" name="file_bpjs" id="file_bpjs" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-5 py-4 bg-slate-800/50 border border-slate-600 rounded-xl text-slate-300 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:font-medium file:bg-gradient-to-r file:from-accent-cyan file:to-cyanDark file:text-slate-950 hover:file:opacity-90 transition-all" />
                                <p class="text-xs text-slate-400 mt-2"><i class="fas fa-info-circle mr-1"></i>Bukti
                                    kepesertaan jaminan kesehatan yang masih aktif selama periode magang</p>
                            </div>

                            <!-- 5. Surat Permohonan Magang -->
                            <div>
                                <label for="file_surat"
                                    class="block text-sm font-medium text-slate-300 mb-2 flex items-center gap-2">
                                    <i class="fas fa-envelope-open-text text-accent-cyan"></i> Surat Permohonan Magang
                                    Resmi dari Kampus *
                                </label>
                                <input type="file" name="file_surat" id="file_surat" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-5 py-4 bg-slate-800/50 border border-slate-600 rounded-xl text-slate-300 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:font-medium file:bg-gradient-to-r file:from-accent-cyan file:to-cyanDark file:text-slate-950 hover:file:opacity-90 transition-all" />
                            </div>
                        </div>
                    </div>



                    <!-- Persetujuan -->
                    <div class="glass rounded-2xl p-4 sm:p-8 overflow-hidden" data-aos="fade-up"
                        data-aos-delay="600">
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

            // Initially disable end date input
            const endInput = document.getElementById('tanggal_selesai_magang');
            endInput.disabled = true;

            // Check for old() periode value
            const periodeValue = document.getElementById('periode_magang').value;
            if (periodeValue) {
                const selectedBtn = document.querySelector(`.periode-btn[data-periode="${periodeValue}"]`);
                if (selectedBtn) {
                    const startDate = selectedBtn.dataset.start;
                    const endDate = selectedBtn.dataset.end;
                    selectPeriode(periodeValue, startDate, endDate);

                    // Restore old date values
                    const oldStartDate = '{{ old('tanggal_mulai_magang') }}';
                    const oldEndDate = '{{ old('tanggal_selesai_magang') }}';
                    if (oldStartDate) {
                        document.getElementById('tanggal_mulai_magang').value = oldStartDate;
                        validateDates(); // This will enable end input and set constraints
                    }
                    if (oldEndDate) {
                        document.getElementById('tanggal_selesai_magang').value = oldEndDate;
                        validateDates(); // Recalculate duration display
                    }
                }
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
        let selectedPeriodStart = null;
        let selectedPeriodEnd = null;

        function selectPeriode(periode, startDate, endDate) {
            // Update hidden input
            document.getElementById('periode_magang').value = periode;
            selectedPeriodStart = startDate;
            selectedPeriodEnd = endDate;

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

            // Set date input constraints
            const startInput = document.getElementById('tanggal_mulai_magang');
            const endInput = document.getElementById('tanggal_selesai_magang');

            // Tanggal mulai harus dalam periode pendaftaran
            startInput.min = startDate;
            startInput.max = endDate;

            // Tanggal selesai akan diatur saat tanggal mulai dipilih
            endInput.min = '';
            endInput.max = '';
            endInput.disabled = true;

            // Reset date values
            startInput.value = '';
            endInput.value = '';
            document.getElementById('date-validation-msg').classList.add('hidden');
            document.getElementById('duration-display').classList.add('hidden');
        }

        function validateDates() {
            const startInput = document.getElementById('tanggal_mulai_magang');
            const endInput = document.getElementById('tanggal_selesai_magang');
            const validationMsg = document.getElementById('date-validation-msg');
            const validationText = document.getElementById('date-validation-text');
            const durationDisplay = document.getElementById('duration-display');
            const durationText = document.getElementById('duration-text');

            // Jika tanggal mulai dipilih, atur constraint untuk tanggal selesai
            if (startInput.value) {
                const start = new Date(startInput.value);

                // Min = tanggal mulai + 1 bulan
                const minEnd = new Date(start);
                minEnd.setMonth(minEnd.getMonth() + 1);

                // Max = tanggal mulai + 6 bulan
                const maxEnd = new Date(start);
                maxEnd.setMonth(maxEnd.getMonth() + 6);

                endInput.min = minEnd.toISOString().split('T')[0];
                endInput.max = maxEnd.toISOString().split('T')[0];
                endInput.disabled = false;
            } else {
                endInput.disabled = true;
                endInput.value = '';
            }

            if (!startInput.value || !endInput.value) {
                durationDisplay.classList.add('hidden');
                validationMsg.classList.add('hidden');
                return;
            }

            const start = new Date(startInput.value);
            const end = new Date(endInput.value);

            // Calculate months difference
            const monthsDiff = (end.getFullYear() - start.getFullYear()) * 12 + (end.getMonth() - start.getMonth());

            // Calculate days for more accurate display
            const daysDiff = Math.ceil((end - start) / (1000 * 60 * 60 * 24));

            // Validate minimum 1 month (approximately 28 days)
            if (daysDiff < 28) {
                validationMsg.classList.remove('hidden');
                validationText.textContent = 'Durasi magang minimal 1 bulan';
                durationDisplay.classList.add('hidden');
                return;
            }

            // Validate maximum 6 months (approximately 186 days)
            if (daysDiff > 186) {
                validationMsg.classList.remove('hidden');
                validationText.textContent = 'Durasi magang maksimal 6 bulan';
                durationDisplay.classList.add('hidden');
                return;
            }

            // Valid duration - show in months and days
            validationMsg.classList.add('hidden');
            durationDisplay.classList.remove('hidden');

            // Calculate full months accurately
            let fullMonths = monthsDiff;
            if (end.getDate() < start.getDate()) {
                fullMonths--;
            }

            // Calculate actual remaining days
            const tempDate = new Date(start);
            tempDate.setMonth(tempDate.getMonth() + fullMonths);
            const remainingDays = Math.ceil((end - tempDate) / (1000 * 60 * 60 * 24));

            if (fullMonths >= 1) {
                if (remainingDays > 0) {
                    durationText.textContent = fullMonths + ' bulan ' + remainingDays + ' hari';
                } else {
                    durationText.textContent = fullMonths + ' bulan';
                }
            } else {
                durationText.textContent = daysDiff + ' hari';
            }
        }
    </script>
</body>

</html>
