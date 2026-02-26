@extends('layouts.sidebar')

@section('title', 'Tambah Formulir')
@section('page-title', 'Tambah Formulir')

@section('content')
    <div class="mb-8 fade-in">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('formulir-templates.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-heading mb-2">
                    Tambah Formulir Baru
                </h1>
                <p class="text-gray-500 text-lg font-light flex items-center gap-2">
                    <span class="w-1 h-4 bg-cyan-500 rounded-full"></span>
                    Upload formulir template untuk calon peserta magang
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-3xl">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 fade-in">
            <div class="p-6 bg-gradient-to-r from-cyan-50 to-blue-50 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <i class="fas fa-file-upload text-cyan-600"></i>
                    Informasi Formulir
                </h2>
            </div>

            <form action="{{ route('formulir-templates.store') }}" method="POST" enctype="multipart/form-data"
                class="p-8">
                @csrf

                <div class="space-y-6">
                    <!-- Nama Formulir -->
                    <div>
                        <label for="nama_formulir" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Formulir <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_formulir" id="nama_formulir" value="{{ old('nama_formulir') }}"
                            required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all @error('nama_formulir') border-red-500 @enderror"
                            placeholder="Contoh: Formulir Pendaftaran Magang 2026">
                        @error('nama_formulir')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all @error('deskripsi') border-red-500 @enderror"
                            placeholder="Tambahkan deskripsi atau instruksi pengisian formulir...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Upload -->
                    <div>
                        <label for="file" class="block text-sm font-semibold text-gray-700 mb-2">
                            File Formulir <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="file" name="file" id="file" required accept=".pdf,.doc,.docx"
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-cyan-500 @error('file') border-red-500 @enderror">
                            <p class="mt-2 text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Format: PDF, DOC, atau DOCX. Maksimal 5MB.
                            </p>
                        </div>
                        @error('file')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Aktif -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }}
                                class="w-4 h-4 text-cyan-600 bg-gray-100 border-gray-300 rounded focus:ring-cyan-500">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="is_active" class="font-medium text-gray-700">
                                Aktifkan formulir
                            </label>
                            <p class="text-gray-500">Formulir yang aktif akan ditampilkan di halaman pendaftaran.</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-3 pt-6 mt-6 border-t">
                    <a href="{{ route('formulir-templates.index') }}"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white rounded-lg shadow-lg hover:shadow-xl transition-all">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Formulir
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
