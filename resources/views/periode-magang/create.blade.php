@extends('layouts.sidebar')

@section('title', 'Tambah Periode Magang')
@section('page-title', 'Tambah Periode Magang')

@section('content')
    <div class="mb-6 fade-in">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('periode-magang.index') }}"
                class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-600 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tambah Periode Magang</h1>
                <p class="text-gray-600">Buat periode pendaftaran magang baru</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">
        <form action="{{ route('periode-magang.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <!-- Nama Batch -->
                <div>
                    <label for="nama_batch" class="block text-gray-700 font-medium mb-2">
                        <i class="fas fa-layer-group text-primary mr-1"></i>
                        Nama Batch <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_batch" id="nama_batch" value="{{ old('nama_batch') }}"
                        placeholder="Contoh: Pendaftaran Juni 2026"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('nama_batch') border-red-500 @enderror"
                        required>
                    <p class="text-gray-500 text-sm mt-1">Nama batch untuk mengelompokkan periode yang dibuka bersamaan</p>
                    @error('nama_batch')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Periode -->
                <div>
                    <label for="nama_periode" class="block text-gray-700 font-medium mb-2">
                        <i class="fas fa-calendar-alt text-primary mr-1"></i>
                        Nama Periode <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_periode" id="nama_periode" value="{{ old('nama_periode') }}"
                        placeholder="Contoh: Juli - September 2026"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('nama_periode') border-red-500 @enderror"
                        required>
                    <p class="text-gray-500 text-sm mt-1">Nama periode pendaftaran magang yang akan ditampilkan ke pendaftar
                    </p>
                    @error('nama_periode')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Grid -->
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Tanggal Mulai -->
                    <div>
                        <label for="tanggal_mulai" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-calendar-check text-green-500 mr-1"></i>
                            Tanggal Mulai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('tanggal_mulai') border-red-500 @enderror"
                            required>
                        @error('tanggal_mulai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label for="tanggal_selesai" class="block text-gray-700 font-medium mb-2">
                            <i class="fas fa-calendar-times text-red-500 mr-1"></i>
                            Tanggal Selesai <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai"
                            value="{{ old('tanggal_selesai') }}"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('tanggal_selesai') border-red-500 @enderror"
                            required>
                        @error('tanggal_selesai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Keterangan -->
                <div>
                    <label for="keterangan" class="block text-gray-700 font-medium mb-2">
                        <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                        Keterangan
                    </label>
                    <textarea name="keterangan" id="keterangan" rows="3"
                        placeholder="Informasi tambahan tentang periode ini (opsional)"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all @error('keterangan') border-red-500 @enderror">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-gray-50 rounded-xl p-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            {{ old('is_active', true) ? 'checked' : '' }}
                            class="w-5 h-5 text-primary border-gray-300 rounded focus:ring-primary">
                        <span class="ml-3">
                            <span class="text-gray-700 font-medium">Aktifkan Periode</span>
                            <span class="block text-gray-500 text-sm">Periode akan langsung tersedia untuk pendaftaran jika
                                tanggal mulai belum terlewati</span>
                        </span>
                    </label>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row gap-4">
                <button type="submit"
                    class="flex-1 sm:flex-none bg-primary hover:bg-primary-dark text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>
                    <span>Simpan Periode</span>
                </button>
                <a href="{{ route('periode-magang.index') }}"
                    class="flex-1 sm:flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 px-8 py-3 rounded-xl font-semibold transition-all flex items-center justify-center gap-2">
                    <i class="fas fa-times"></i>
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Info Card -->
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
        <div class="flex gap-3">
            <i class="fas fa-lightbulb text-blue-500 text-xl"></i>
            <div>
                <h4 class="font-semibold text-blue-800 mb-1">Tips Pengisian</h4>
                <ul class="text-blue-700 text-sm space-y-1">
                    <li>• <strong>Nama Batch</strong>: Gunakan untuk mengelompokkan periode yang dibuka di waktu yang sama
                        (contoh: "Pendaftaran Juni 2026")</li>
                    <li>• <strong>Nama Periode</strong>: Periode pelaksanaan magang yang akan dilihat pendaftar (contoh:
                        "Juli - September 2026")</li>
                    <li>• Pendaftaran akan dibuka otomatis sebelum tanggal mulai magang</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
