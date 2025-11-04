@extends('layouts.app')

@section('title', 'Tambah Data Magang')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Tambah Data Magang</h1>
        <p class="text-gray-600">Input data anak magang baru</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('interns.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Lengkap <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama') border-red-500 @enderror"
                        required>
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nim" class="block text-gray-700 font-medium mb-2">NIM <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nim" id="nim" value="{{ old('nim') }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nim') border-red-500 @enderror"
                        required>
                    @error('nim')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="asal_kampus" class="block text-gray-700 font-medium mb-2">Asal Kampus <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="asal_kampus" id="asal_kampus" value="{{ old('asal_kampus') }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('asal_kampus') border-red-500 @enderror"
                        required>
                    @error('asal_kampus')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="program_studi" class="block text-gray-700 font-medium mb-2">Program Studi <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="program_studi" id="program_studi" value="{{ old('program_studi') }}"
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
                    <input type="email" name="email_kampus" id="email_kampus" value="{{ old('email_kampus') }}"
                        placeholder="mahasiswa@kampus.ac.id"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email_kampus') border-red-500 @enderror">
                    @error('email_kampus')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_wa" class="block text-gray-700 font-medium mb-2">No WhatsApp <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="no_wa" id="no_wa" value="{{ old('no_wa') }}"
                        placeholder="08xxxxxxxxxx"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('no_wa') border-red-500 @enderror"
                        required>
                    @error('no_wa')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Lampiran Dokumen</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="file_proposal" class="block text-gray-700 font-medium mb-2">
                            File Proposal <span class="text-red-500">*</span>
                            <span class="text-xs text-gray-500">(PDF/DOC, max 2MB)</span>
                        </label>
                        <input type="file" name="file_proposal" id="file_proposal" accept=".pdf,.doc,.docx"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('file_proposal') border-red-500 @enderror"
                            required>
                        @error('file_proposal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="file_cv" class="block text-gray-700 font-medium mb-2">
                            File CV <span class="text-red-500">*</span>
                            <span class="text-xs text-gray-500">(PDF/DOC, max 2MB)</span>
                        </label>
                        <input type="file" name="file_cv" id="file_cv" accept=".pdf,.doc,.docx"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('file_cv') border-red-500 @enderror"
                            required>
                        @error('file_cv')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="file_surat" class="block text-gray-700 font-medium mb-2">
                            Surat Magang dari Kampus <span class="text-red-500">*</span>
                            <span class="text-xs text-gray-500">(PDF/DOC, max 2MB)</span>
                        </label>
                        <input type="file" name="file_surat" id="file_surat" accept=".pdf,.doc,.docx"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('file_surat') border-red-500 @enderror"
                            required>
                        @error('file_surat')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="mt-6 flex space-x-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('interns.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
