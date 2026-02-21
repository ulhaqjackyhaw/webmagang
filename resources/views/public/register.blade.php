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
                <div class="grid md:grid-cols-2 gap-8 mb-12" data-aos="fade-up" data-aos-delay="100">
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
                            <li class="flex items-start gap-3"><i class="fas fa-check text-accent-cyan mt-1"></i>
                                Download formulir dan isi</li>
                            <li class="flex items-start gap-3"><i class="fas fa-check text-accent-cyan mt-1"></i> Upload
                                formulir yang sudah diisi</li>
                            <li class="flex items-start gap-3"><i class="fas fa-check text-accent-cyan mt-1"></i> Upload
                                CV, Proposal, Surat Magang Resmi</li>
                        </ul>
                    </div>
                </div>

                <form action="{{ route('public.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-10">
                    @csrf

                    <!-- Data Pribadi -->
                    <div class="glass rounded-2xl p-8" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                            <i class="fas fa-user text-accent-cyan"></i> Data Pribadi
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-slate-300 mb-2">Nama Lengkap
                                    *</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                                    class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:border-accent-cyan transition-all" />
                            </div>
                            <div>
                                <label for="nim" class="block text-sm font-medium text-slate-300 mb-2">NIM
                                    *</label>
                                <input type="text" name="nim" id="nim" value="{{ old('nim') }}" required
                                    class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:border-accent-cyan transition-all" />
                            </div>
                            <div>
                                <label for="no_wa" class="block text-sm font-medium text-slate-300 mb-2">Nomor
                                    WhatsApp *</label>
                                <input type="text" name="no_wa" id="no_wa" value="{{ old('no_wa') }}" required
                                    placeholder="Contoh: 081234567890"
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
                    <div class="glass rounded-2xl p-8" data-aos="fade-up" data-aos-delay="300">
                        <h3 class="text-2xl font-bold mb-6 flex items-center gap-3">
                            <i class="fas fa-graduation-cap text-accent-cyan"></i> Data Akademik
                        </h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="asal_kampus" class="block text-sm font-medium text-slate-300 mb-2">Asal
                                    Kampus *</label>
                                <select name="asal_kampus" id="asal_kampus" required
                                    onchange="toggleKampusLainnya(this.value)"
                                    class="w-full px-5 py-3 bg-slate-800/50 border border-slate-600 rounded-xl text-white placeholder-slate-400 focus:border-accent-cyan transition-all">
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

                    <!-- Download Formulir -->
                    <div class="glass rounded-2xl p-8" data-aos="fade-up" data-aos-delay="400">
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
                    </div>

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
                            <div>
                                <label for="file_formulir"
                                    class="block text-sm font-medium text-slate-300 mb-2 flex items-center gap-2">
                                    <i class="fas fa-file-signature text-accent-cyan"></i> Formulir Pendaftaran yang
                                    Sudah Diisi *
                                </label>
                                <input type="file" name="file_formulir" id="file_formulir" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-5 py-4 bg-slate-800/50 border border-slate-600 rounded-xl text-slate-300 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:font-medium file:bg-gradient-to-r file:from-accent-cyan file:to-cyanDark file:text-slate-950 hover:file:opacity-90 transition-all" />
                            </div>

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

        // Initialize on page load (for old() values)
        document.addEventListener('DOMContentLoaded', function() {
            const kampusSelect = document.getElementById('asal_kampus');
            if (kampusSelect.value === 'Lainnya') {
                toggleKampusLainnya('Lainnya');
            }
        });
    </script>
</body>

</html>
