@extends('layouts.app')

@section('title', 'Edit Data Database Magang')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Edit Data Database Magang</h1>
        <p class="text-gray-600">Update informasi periode magang</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <!-- Display Intern Info (Read Only) -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Anak Magang</h3>
            <div class="bg-gray-50 border rounded-lg p-4">
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

            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Periode Magang</h3>
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

            <div class="mt-6 flex space-x-4">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                    <i class="fas fa-save"></i> Update
                </button>
                <a href="{{ route('accepted-interns.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
