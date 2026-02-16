<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Magang - URSHIPORTS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .animate-slide-down {
            animation: slideDown 0.6s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-input:focus {
            border-color: #20B2AA;
            box-shadow: 0 0 0 3px rgba(32, 178, 170, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen py-8">
    <!-- Header -->
    <div class="container mx-auto px-4 mb-8">
        <div class="flex items-center justify-between animate-slide-down">
            <a href="{{ route('public.landing') }}" class="flex items-center space-x-3 hover:opacity-80 transition">
                <img src="{{ asset('images/injourney-logo.png') }}" alt="Injourney Airports" class="h-12">
                <div>
                    <h1 class="text-xl font-bold text-gray-800">URSHIPORTS</h1>
                    <p class="text-xs text-gray-600">Your Internship Programme</p>
                </div>
            </a>
            <a href="{{ route('public.landing') }}" class="flex items-center space-x-2 text-gray-600 transition"
                style="hover:color: #20B2AA;">
                <i class="fas fa-arrow-left"></i>
                <span class="hidden md:inline">Kembali</span>
            </a>
        </div>
    </div>

    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden animate-slide-down">
            <!-- Header Section -->
            <div class="p-10 text-white text-center"
                style="background: linear-gradient(135deg, #20B2AA 0%, #008B8B 100%);">
                <i class="fas fa-clipboard-list text-5xl mb-4"></i>
                <h2 class="text-4xl font-bold mb-2">Formulir Pendaftaran Magang</h2>
                <p class="text-lg" style="color: rgba(255,255,255,0.9);">Lengkapi data diri dan dokumen persyaratan Anda
                </p>
            </div>

            <div class="p-8 md:p-10">

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6"
                        role="alert">
                        <strong class="font-bold">Terdapat kesalahan!</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Requirements Info Section -->
                <div class="mb-8 grid md:grid-cols-2 gap-6">
                    <div class="bg-teal-50 border border-teal-200 rounded-xl p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-lg bg-teal-600 text-white flex items-center justify-center">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-800">Kriteria Peserta</h4>
                        </div>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-gray-700 text-sm">
                                <i class="fas fa-check text-teal-600 mt-0.5"></i> Mahasiswa atau siswa aktif
                            </li>
                            <li class="flex items-start gap-3 text-gray-700 text-sm">
                                <i class="fas fa-check text-teal-600 mt-0.5"></i> Sehat jasmani & rohani
                            </li>
                            <li class="flex items-start gap-3 text-gray-700 text-sm">
                                <i class="fas fa-check text-teal-600 mt-0.5"></i> Bersedia ditempatkan di unit kerja
                            </li>
                        </ul>
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-600 text-white flex items-center justify-center">
                                <i class="fas fa-file-lines"></i>
                            </div>
                            <h4 class="text-lg font-bold text-gray-800">Dokumen Wajib</h4>
                        </div>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-gray-700 text-sm">
                                <i class="fas fa-check text-blue-600 mt-0.5"></i> Lengkapi data diri
                            </li>
                            <li class="flex items-start gap-3 text-gray-700 text-sm">
                                <i class="fas fa-check text-blue-600 mt-0.5"></i> Download formulir dan isi
                            </li>
                            <li class="flex items-start gap-3 text-gray-700 text-sm">
                                <i class="fas fa-check text-blue-600 mt-0.5"></i> Upload formulir yang sudah diisi
                            </li>
                            <li class="flex items-start gap-3 text-gray-700 text-sm">
                                <i class="fas fa-check text-blue-600 mt-0.5"></i> Upload CV, Proposal, Surat Magang
                                Resmi
                            </li>
                        </ul>
                    </div>
                </div>

                <form action="{{ route('public.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

                    <!-- Personal Information -->
                    <div class="border-b pb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">
                            <i class="fas fa-user text-teal-600 mr-2"></i>Data Pribadi
                        </h3>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap
                                    *</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent"
                                    style="--tw-ring-color: rgba(32, 178, 170, 0.5);"
                                    onfocus="this.style.borderColor='#20B2AA'" onblur="this.style.borderColor=''">
                            </div>

                            <div>
                                <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM *</label>
                                <input type="text" name="nim" id="nim" value="{{ old('nim') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent"
                                    style="--tw-ring-color: rgba(32, 178, 170, 0.5);"
                                    onfocus="this.style.borderColor='#20B2AA'" onblur="this.style.borderColor=''">
                            </div>

                            <div>
                                <label for="no_wa" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                                    WhatsApp
                                    *</label>
                                <input type="text" name="no_wa" id="no_wa" value="{{ old('no_wa') }}" required
                                    placeholder="Contoh: 081234567890"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent"
                                    style="--tw-ring-color: rgba(32, 178, 170, 0.5);"
                                    onfocus="this.style.borderColor='#20B2AA'" onblur="this.style.borderColor=''">
                            </div>

                            <div>
                                <label for="email_kampus" class="block text-sm font-medium text-gray-700 mb-2">Email
                                    Kampus</label>
                                <input type="email" name="email_kampus" id="email_kampus"
                                    value="{{ old('email_kampus') }}" placeholder="nama@university.ac.id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent"
                                    style="--tw-ring-color: rgba(32, 178, 170, 0.5);"
                                    onfocus="this.style.borderColor='#20B2AA'" onblur="this.style.borderColor=''">
                            </div>
                        </div>
                    </div>

                    <!-- Academic Information -->
                    <div class="border-b pb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">
                            <i class="fas fa-graduation-cap text-teal-600 mr-2"></i>Data Akademik
                        </h3>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="asal_kampus" class="block text-sm font-medium text-gray-700 mb-2">Asal
                                    Kampus
                                    *</label>
                                <input type="text" name="asal_kampus" id="asal_kampus"
                                    value="{{ old('asal_kampus') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent"
                                    style="--tw-ring-color: rgba(32, 178, 170, 0.5);"
                                    onfocus="this.style.borderColor='#20B2AA'" onblur="this.style.borderColor=''">
                            </div>

                            <div>
                                <label for="program_studi"
                                    class="block text-sm font-medium text-gray-700 mb-2">Program
                                    Studi *</label>
                                <input type="text" name="program_studi" id="program_studi"
                                    value="{{ old('program_studi') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent"
                                    style="--tw-ring-color: rgba(32, 178, 170, 0.5);"
                                    onfocus="this.style.borderColor='#20B2AA'" onblur="this.style.borderColor=''">
                            </div>
                        </div>
                    </div>

                    <!-- Download Formulir Section -->
                    <div class="border-b pb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">
                            <i class="fas fa-download text-teal-600 mr-2"></i>Download Formulir
                        </h3>

                        @if ($formulirs->isEmpty())
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                                <i class="fas fa-info-circle text-gray-400 text-3xl mb-3"></i>
                                <p class="text-gray-600">
                                    Belum ada formulir yang tersedia saat ini.
                                </p>
                            </div>
                        @else
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                                <p class="text-gray-700 mb-4">
                                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                                    Download formulir pendaftaran, isi dengan lengkap, lalu upload kembali pada bagian
                                    dokumen di bawah.
                                </p>

                                <div class="space-y-3">
                                    @foreach ($formulirs as $formulir)
                                        <div
                                            class="bg-white border border-blue-300 rounded-lg p-4 flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-file-pdf text-blue-600 text-xl"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-semibold text-gray-800">
                                                        {{ $formulir->nama_formulir }}</h4>
                                                    @if ($formulir->deskripsi)
                                                        <p class="text-sm text-gray-600 mt-1">
                                                            {{ $formulir->deskripsi }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <a href="{{ route('public.download-formulir', $formulir->id) }}"
                                                class="inline-flex items-center gap-2 text-white font-semibold py-2 px-5 rounded-lg transition duration-300 shadow-md hover:shadow-lg"
                                                style="background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);">
                                                <i class="fas fa-file-download"></i>
                                                Download
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Document Upload -->
                    <div class="border-b pb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">
                            <i class="fas fa-file-upload text-teal-600 mr-2"></i>Dokumen Persyaratan
                        </h3>
                        <p class="text-sm text-gray-600 mb-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                            <strong>Format:</strong> PDF, DOC, atau DOCX. <strong>Maksimal 2MB</strong> per file.
                        </p>

                        <div class="space-y-4">
                            <div>
                                <label for="file_formulir" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-file-signature text-gray-600 mr-1"></i>
                                    Formulir Pendaftaran yang Sudah Diisi *
                                </label>
                                <input type="file" name="file_formulir" id="file_formulir" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-white hover:file:opacity-90"
                                    style="--tw-ring-color: rgba(32, 178, 170, 0.5); file:background: linear-gradient(135deg, #20B2AA 0%, #008B8B 100%);"
                                    onfocus="this.style.borderColor='#20B2AA'" onblur="this.style.borderColor=''">
                            </div>

                            <div>
                                <label for="file_cv" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-id-card text-gray-600 mr-1"></i>
                                    Curriculum Vitae (CV) *
                                </label>
                                <input type="file" name="file_cv" id="file_cv" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-white hover:file:opacity-90"
                                    style="--tw-ring-color: rgba(32, 178, 170, 0.5); file:background: linear-gradient(135deg, #20B2AA 0%, #008B8B 100%);"
                                    onfocus="this.style.borderColor='#20B2AA'" onblur="this.style.borderColor=''">
                            </div>

                            <div>
                                <label for="file_proposal" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-file-alt text-gray-600 mr-1"></i>
                                    Proposal Magang *
                                </label>
                                <input type="file" name="file_proposal" id="file_proposal" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-white hover:file:opacity-90"
                                    style="--tw-ring-color: rgba(32, 178, 170, 0.5); file:background: linear-gradient(135deg, #20B2AA 0%, #008B8B 100%);"
                                    onfocus="this.style.borderColor='#20B2AA'" onblur="this.style.borderColor=''">
                            </div>

                            <div>
                                <label for="file_surat" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="fas fa-envelope-open-text text-gray-600 mr-1"></i>
                                    Surat Permohonan Magang Resmi *
                                </label>
                                <input type="file" name="file_surat" id="file_surat" required
                                    accept=".pdf,.doc,.docx"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-white hover:file:opacity-90"
                                    style="--tw-ring-color: rgba(32, 178, 170, 0.5); file:background: linear-gradient(135deg, #20B2AA 0%, #008B8B 100%);"
                                    onfocus="this.style.borderColor='#20B2AA'" onblur="this.style.borderColor=''">
                            </div>
                        </div>
                    </div>

                    <!-- Persetujuan & Pernyataan -->
                    <div class="pb-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">
                            <i class="fas fa-check-circle text-teal-600 mr-2"></i>Persetujuan & Pernyataan
                        </h3>
                        <div class="space-y-4 bg-gray-50 rounded-lg p-6">
                            <div class="flex items-start">
                                <input type="checkbox" name="persetujuan_sehat" id="persetujuan_sehat" required
                                    class="mt-1 h-5 w-5 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                <label for="persetujuan_sehat" class="ml-3 text-sm text-gray-700">
                                    Saya menyatakan bahwa saya dalam kondisi <strong>sehat jasmani dan rohani</strong>,
                                    serta mampu menjalankan program magang dengan baik. *
                                </label>
                            </div>

                            <div class="flex items-start">
                                <input type="checkbox" name="persetujuan_penempatan" id="persetujuan_penempatan"
                                    required
                                    class="mt-1 h-5 w-5 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                <label for="persetujuan_penempatan" class="ml-3 text-sm text-gray-700">
                                    Saya <strong>bersedia ditempatkan di unit kerja manapun</strong> sesuai kebutuhan
                                    dan
                                    kebijakan Injourney Airports Kantor Regional I. *
                                </label>
                            </div>

                            <div class="flex items-start">
                                <input type="checkbox" name="persetujuan_data" id="persetujuan_data" required
                                    class="mt-1 h-5 w-5 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                                <label for="persetujuan_data" class="ml-3 text-sm text-gray-700">
                                    Saya menyatakan bahwa <strong>seluruh data dan dokumen yang saya berikan adalah
                                        benar</strong> dan dapat dipertanggungjawabkan. *
                                    </labelborder-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg
                                        file:border-0 file:text-white hover:file:opacity-90"
                                        style="--tw-ring-color: rgba(32, 178, 170, 0.5); file:background: linear-gradient(135deg, #20B2AA 0%, #008B8B 100%);"
                                        onfocus="this.style.borderColor='#20B2AA'" onblur="this.style.borderColor=''">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-between items-center pt-6 border-t">
                        <a href="{{ route('public.landing') }}" class="text-gray-600 hover:text-gray-800">Batal</a>
                        <button type="submit"
                            class="text-white font-bold py-4 px-10 rounded-lg transition duration-300 shadow-lg transform hover:scale-105"
                            style="background: linear-gradient(135deg, #20B2AA 0%, #008B8B 100%);">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Pendaftaran
                        </button>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8 text-gray-600">
                <p class="text-sm">* = Wajib diisi</p>
            </div>
        </div>
</body>

</html>
