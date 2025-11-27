@extends('layouts.app')

@section('title', 'Edit Data Magang')

@section('content')
    <!-- Header Section -->
    <div class="mb-8 fade-in">
        <div class="flex items-center gap-4 mb-3">
            <div
                class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                <i class="fas fa-edit text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-heading">
                    Edit Data Magang
                </h1>
            </div>
        </div>
        <p class="text-gray-500 text-lg font-light ml-16">
            Perbarui informasi pengajuan magang
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10 fade-in" style="animation-delay: 0.1s">
        <form action="{{ route('interns.update', $intern->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="nama" class="block text-sm font-semibold text-gray-700">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $intern->nama) }}"
                        class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('nama') border-red-300 bg-red-50 @enderror"
                        placeholder="Masukkan nama lengkap" required>
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="nim" class="block text-sm font-semibold text-gray-700">
                        NIM <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nim" id="nim" value="{{ old('nim', $intern->nim) }}"
                        class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('nim') border-red-300 bg-red-50 @enderror"
                        placeholder="Masukkan NIM" required>
                    @error('nim')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="asal_kampus" class="block text-sm font-semibold text-gray-700">
                        Asal Kampus <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="asal_kampus" id="asal_kampus"
                        value="{{ old('asal_kampus', $intern->asal_kampus) }}"
                        class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('asal_kampus') border-red-300 bg-red-50 @enderror"
                        placeholder="Masukkan asal kampus" required>
                    @error('asal_kampus')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="program_studi" class="block text-sm font-semibold text-gray-700">
                        Program Studi <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="program_studi" id="program_studi"
                        value="{{ old('program_studi', $intern->program_studi) }}"
                        class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('program_studi') border-red-300 bg-red-50 @enderror"
                        placeholder="Masukkan program studi" required>
                    @error('program_studi')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="email_kampus" class="block text-sm font-semibold text-gray-700">
                        Email Kampus
                        <span class="text-xs font-normal text-gray-400">(opsional)</span>
                    </label>
                    <input type="email" name="email_kampus" id="email_kampus"
                        value="{{ old('email_kampus', $intern->email_kampus) }}" placeholder="mahasiswa@kampus.ac.id"
                        class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('email_kampus') border-red-300 bg-red-50 @enderror">
                    @error('email_kampus')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="no_wa" class="block text-sm font-semibold text-gray-700">
                        No WhatsApp <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="no_wa" id="no_wa" value="{{ old('no_wa', $intern->no_wa) }}"
                        placeholder="08xxxxxxxxxx"
                        class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('no_wa') border-red-300 bg-red-50 @enderror"
                        required>
                    @error('no_wa')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-gray-100">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-paperclip text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 font-heading">
                        Lampiran Dokumen
                    </h3>
                </div>
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                    <p class="text-sm text-amber-800 flex items-center gap-2">
                        <i class="fas fa-info-circle"></i>
                        <span>Kosongkan jika tidak ingin mengubah file</span>
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="space-y-2">
                        <label for="file_proposal" class="block text-sm font-semibold text-gray-700">
                            File Proposal
                        </label>
                        <p class="text-xs text-gray-400">PDF/DOC, max 2MB</p>
                        @if ($intern->file_proposal)
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-2 mb-2">
                                <p class="text-xs text-blue-700 flex items-center gap-1">
                                    <i class="fas fa-file-pdf"></i>
                                    <span class="truncate">{{ basename($intern->file_proposal) }}</span>
                                </p>
                            </div>
                        @endif
                        <div class="relative">
                            <input type="file" name="file_proposal" id="file_proposal" accept=".pdf,.doc,.docx"
                                class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 file:cursor-pointer @error('file_proposal') border-red-300 bg-red-50 @enderror">
                        </div>
                        @error('file_proposal')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="file_cv" class="block text-sm font-semibold text-gray-700">
                            File CV
                        </label>
                        <p class="text-xs text-gray-400">PDF/DOC, max 2MB</p>
                        @if ($intern->file_cv)
                            <div class="bg-green-50 border border-green-200 rounded-lg p-2 mb-2">
                                <p class="text-xs text-green-700 flex items-center gap-1">
                                    <i class="fas fa-file-pdf"></i>
                                    <span class="truncate">{{ basename($intern->file_cv) }}</span>
                                </p>
                            </div>
                        @endif
                        <div class="relative">
                            <input type="file" name="file_cv" id="file_cv" accept=".pdf,.doc,.docx"
                                class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 file:cursor-pointer @error('file_cv') border-red-300 bg-red-50 @enderror">
                        </div>
                        @error('file_cv')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="file_surat" class="block text-sm font-semibold text-gray-700">
                            Surat Magang dari Kampus
                        </label>
                        <p class="text-xs text-gray-400">PDF/DOC, max 2MB</p>
                        @if ($intern->file_surat)
                            <div class="bg-purple-50 border border-purple-200 rounded-lg p-2 mb-2">
                                <p class="text-xs text-purple-700 flex items-center gap-1">
                                    <i class="fas fa-file-pdf"></i>
                                    <span class="truncate">{{ basename($intern->file_surat) }}</span>
                                </p>
                            </div>
                        @endif
                        <div class="relative">
                            <input type="file" name="file_surat" id="file_surat" accept=".pdf,.doc,.docx"
                                class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 file:cursor-pointer @error('file_surat') border-red-300 bg-red-50 @enderror">
                        </div>
                        @error('file_surat')
                            <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                                <i class="fas fa-exclamation-circle text-xs"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-gray-100 flex flex-wrap gap-3">
                <button type="submit"
                    class="group relative overflow-hidden bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40">
                    <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                    <i class="fas fa-check text-sm"></i>
                    <span>Update Data</span>
                </button>
                <a href="{{ route('interns.index') }}"
                    class="group bg-gray-100 hover:bg-gray-200 text-gray-700 hover:text-gray-900 px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2">
                    <i class="fas fa-arrow-left text-sm"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </form>
    </div>
@endsection
