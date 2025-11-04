@extends('layouts.app')

@section('title', 'Edit Data Magang')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <h1
            class="text-4xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent flex items-center">
            <i class="fas fa-user-edit mr-3 text-green-600"></i>
            Edit Data Pengajuan Magang
        </h1>
        <p class="text-gray-600 mt-2 flex items-center">
            <i class="fas fa-edit mr-2 text-green-500"></i>
            Update data pengajuan magang
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-8">
        <form action="{{ route('interns.update', $intern->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Lengkap <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $intern->nama) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama') border-red-500 @enderror"
                        required>
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nim" class="block text-gray-700 font-medium mb-2">NIM <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nim" id="nim" value="{{ old('nim', $intern->nim) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nim') border-red-500 @enderror"
                        required>
                    @error('nim')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="asal_kampus" class="block text-gray-700 font-medium mb-2">Asal Kampus <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="asal_kampus" id="asal_kampus"
                        value="{{ old('asal_kampus', $intern->asal_kampus) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('asal_kampus') border-red-500 @enderror"
                        required>
                    @error('asal_kampus')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="program_studi" class="block text-gray-700 font-medium mb-2">Program Studi <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="program_studi" id="program_studi"
                        value="{{ old('program_studi', $intern->program_studi) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('program_studi') border-red-500 @enderror"
                        required>
                    @error('program_studi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email_kampus" class="block text-gray-700 font-medium mb-2">Email Kampus
                        <span class="text-xs text-gray-500">(opsional)</span>
                    </label>
                    <input type="email" name="email_kampus" id="email_kampus"
                        value="{{ old('email_kampus', $intern->email_kampus) }}" placeholder="mahasiswa@kampus.ac.id"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email_kampus') border-red-500 @enderror">
                    @error('email_kampus')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_wa" class="block text-gray-700 font-medium mb-2">No WhatsApp <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="no_wa" id="no_wa" value="{{ old('no_wa', $intern->no_wa) }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('no_wa') border-red-500 @enderror"
                        required>
                    @error('no_wa')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-paperclip text-purple-500 mr-2"></i>
                    Lampiran Dokumen
                </h3>
                <p class="text-sm text-gray-600 mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                    <i class="fas fa-info-circle text-yellow-600 mr-2"></i>
                    Kosongkan jika tidak ingin mengubah file
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="file_proposal" class="block text-gray-700 font-medium mb-2">
                            File Proposal
                            <span class="text-xs text-gray-500">(PDF/DOC, max 2MB)</span>
                        </label>
                        @if ($intern->file_proposal)
                            <p class="text-xs text-gray-600 mb-2">File saat ini: {{ basename($intern->file_proposal) }}</p>
                        @endif
                        <input type="file" name="file_proposal" id="file_proposal" accept=".pdf,.doc,.docx"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('file_proposal') border-red-500 @enderror">
                        @error('file_proposal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="file_cv" class="block text-gray-700 font-medium mb-2">
                            File CV
                            <span class="text-xs text-gray-500">(PDF/DOC, max 2MB)</span>
                        </label>
                        @if ($intern->file_cv)
                            <p class="text-xs text-gray-600 mb-2">File saat ini: {{ basename($intern->file_cv) }}</p>
                        @endif
                        <input type="file" name="file_cv" id="file_cv" accept=".pdf,.doc,.docx"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('file_cv') border-red-500 @enderror">
                        @error('file_cv')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="file_surat" class="block text-gray-700 font-medium mb-2">
                            Surat Magang dari Kampus
                            <span class="text-xs text-gray-500">(PDF/DOC, max 2MB)</span>
                        </label>
                        @if ($intern->file_surat)
                            <p class="text-xs text-gray-600 mb-2">File saat ini: {{ basename($intern->file_surat) }}</p>
                        @endif
                        <input type="file" name="file_surat" id="file_surat" accept=".pdf,.doc,.docx"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('file_surat') border-red-500 @enderror">
                        @error('file_surat')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-8 flex space-x-4">
                <button type="submit"
                    class="group bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-save group-hover:scale-110 transition-transform"></i>
                    <span class="font-semibold">Update Data</span>
                </button>
                <a href="{{ route('interns.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span class="font-semibold">Kembali</span>
                </a>
            </div>
        </form>
    </div>
@endsection
