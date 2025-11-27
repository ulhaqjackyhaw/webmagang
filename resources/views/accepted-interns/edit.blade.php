@extends('layouts.app')

@section('title', 'Edit Data Database Magang')

@section('content')
    <!-- Header Section -->
    <div class="mb-8 fade-in">
        <div class="flex items-center gap-4 mb-3">
            <div
                class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg shadow-yellow-500/30">
                <i class="fas fa-edit text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-heading">
                    Edit Database Magang
                </h1>
            </div>
        </div>
        <p class="text-gray-500 text-lg font-light ml-16">
            Perbarui informasi periode magang
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10 fade-in" style="animation-delay: 0.1s">
        <!-- Display Intern Info (Read Only) -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user text-blue-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 font-heading">
                    Data Peserta Magang
                </h3>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Nama Lengkap</label>
                        <p class="text-gray-900 font-semibold">{{ $acceptedIntern->intern->nama }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">NIM</label>
                        <p class="text-gray-900 font-semibold">{{ $acceptedIntern->intern->nim }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Asal Kampus</label>
                        <p class="text-gray-900 font-semibold">{{ $acceptedIntern->intern->asal_kampus }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Program Studi</label>
                        <p class="text-gray-900 font-semibold">{{ $acceptedIntern->intern->program_studi }}</p>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('accepted-interns.update', $acceptedIntern->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-3 mb-6 pt-8 border-t border-gray-100">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-green-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 font-heading">
                    Informasi Periode Magang
                </h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="space-y-2">
                    <label for="periode_awal" class="block text-sm font-semibold text-gray-700">
                        Periode Awal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="periode_awal" id="periode_awal"
                        value="{{ old('periode_awal', $acceptedIntern->periode_awal->format('Y-m-d')) }}"
                        class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('periode_awal') border-red-300 bg-red-50 @enderror"
                        required>
                    @error('periode_awal')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="periode_akhir" class="block text-sm font-semibold text-gray-700">
                        Periode Akhir <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="periode_akhir" id="periode_akhir"
                        value="{{ old('periode_akhir', $acceptedIntern->periode_akhir->format('Y-m-d')) }}"
                        class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('periode_akhir') border-red-300 bg-red-50 @enderror"
                        required>
                    @error('periode_akhir')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="unit_magang" class="block text-sm font-semibold text-gray-700">
                        Unit Magang <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="unit_magang" id="unit_magang"
                        value="{{ old('unit_magang', $acceptedIntern->unit_magang) }}" placeholder="Contoh: IT Department"
                        class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('unit_magang') border-red-300 bg-red-50 @enderror"
                        required>
                    @error('unit_magang')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <div class="mt-10 pt-8 border-t border-gray-100 flex flex-wrap gap-3">
                <button type="submit"
                    class="group relative overflow-hidden bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-yellow-500/30 hover:shadow-xl hover:shadow-yellow-500/40">
                    <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                    <i class="fas fa-check text-sm"></i>
                    <span>Update Data</span>
                </button>
                <a href="{{ route('accepted-interns.index') }}"
                    class="group bg-gray-100 hover:bg-gray-200 text-gray-700 hover:text-gray-900 px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2">
                    <i class="fas fa-arrow-left text-sm"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </form>
    </div>
@endsection
