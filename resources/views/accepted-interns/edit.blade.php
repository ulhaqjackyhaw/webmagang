@extends('layouts.app')

@section('title', 'Edit Data Database Magang')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <h1
            class="text-4xl font-bold text-yellow-600 flex items-center">
            <i class="fas fa-edit mr-3 text-yellow-600"></i>
            Edit Data Database Magang
        </h1>
        <p class="text-gray-600 mt-2 flex items-center">
            <i class="fas fa-info-circle mr-2 text-yellow-500"></i>
            Update informasi periode magang
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-8">
        <!-- Display Intern Info (Read Only) -->
        <div class="mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-user text-blue-500 mr-2"></i>
                Data Anak Magang
            </h3>
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-200 rounded-xl p-6">
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

            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-calendar-alt text-green-500 mr-2"></i>
                Informasi Periode Magang
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="periode_awal" class="block text-gray-700 font-medium mb-2">
                        Periode Awal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="periode_awal" id="periode_awal"
                        value="{{ old('periode_awal', $acceptedIntern->periode_awal->format('Y-m-d')) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('periode_awal') border-red-500 @enderror"
                        required>
                    @error('periode_awal')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="periode_akhir" class="block text-gray-700 font-medium mb-2">
                        Periode Akhir <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="periode_akhir" id="periode_akhir"
                        value="{{ old('periode_akhir', $acceptedIntern->periode_akhir->format('Y-m-d')) }}"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('periode_akhir') border-red-500 @enderror"
                        required>
                    @error('periode_akhir')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="unit_magang" class="block text-gray-700 font-medium mb-2">
                        Unit Magang <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="unit_magang" id="unit_magang"
                        value="{{ old('unit_magang', $acceptedIntern->unit_magang) }}" placeholder="Contoh: IT Department"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('unit_magang') border-red-500 @enderror"
                        required>
                    @error('unit_magang')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 flex space-x-4">
                <button type="submit"
                    class="group bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-save group-hover:scale-110 transition-transform"></i>
                    <span class="font-semibold">Update Data</span>
                </button>
                <a href="{{ route('accepted-interns.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span class="font-semibold">Kembali</span>
                </a>
            </div>
        </form>
    </div>
@endsection
