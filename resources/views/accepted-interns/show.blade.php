@extends('layouts.app')

@section('title', 'Detail Data Database Magang')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <h1
            class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent flex items-center">
            <i class="fas fa-id-card mr-3 text-purple-600"></i>
            Detail Data Database Magang
        </h1>
        <p class="text-gray-600 mt-2 flex items-center">
            <i class="fas fa-info-circle mr-2 text-purple-500"></i>
            Informasi lengkap peserta magang yang terdaftar
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-8">
        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center border-b-2 border-blue-200 pb-4">
            <i class="fas fa-user-circle text-blue-500 mr-3"></i>
            Data Pribadi
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
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

            <div>
                <label class="block text-gray-600 text-sm mb-1">Email Kampus</label>
                <p class="text-gray-900 font-semibold">{{ $acceptedIntern->intern->email_kampus ?? '-' }}</p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">No WhatsApp</label>
                <p class="text-gray-900 font-semibold">{{ $acceptedIntern->intern->no_wa }}</p>
            </div>
        </div>

        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center border-b-2 border-green-200 pb-4">
            <i class="fas fa-briefcase text-green-500 mr-3"></i>
            Informasi Magang
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-600 text-sm mb-1">Periode Awal</label>
                <p class="text-gray-900 font-semibold">
                    <i class="fas fa-calendar text-blue-500"></i>
                    {{ $acceptedIntern->periode_awal->format('d F Y') }}
                </p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">Periode Akhir</label>
                <p class="text-gray-900 font-semibold">
                    <i class="fas fa-calendar text-blue-500"></i>
                    {{ $acceptedIntern->periode_akhir->format('d F Y') }}
                </p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">Durasi</label>
                <p class="text-gray-900 font-semibold">
                    <i class="fas fa-clock text-green-500"></i>
                    {{ $acceptedIntern->periode_awal->diffInDays($acceptedIntern->periode_akhir) }} hari
                </p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">Unit Magang</label>
                <p class="text-gray-900 font-semibold">
                    <i class="fas fa-building text-purple-500"></i>
                    {{ $acceptedIntern->unit_magang }}
                </p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">Didaftarkan Oleh</label>
                <p class="text-gray-900 font-semibold">{{ $acceptedIntern->creator->name }}</p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">Tanggal Didaftarkan</label>
                <p class="text-gray-900 font-semibold">{{ $acceptedIntern->created_at->format('d F Y, H:i') }}</p>
            </div>
        </div>

        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center border-b-2 border-purple-200 pb-4">
            <i class="fas fa-file-alt text-purple-500 mr-3"></i>
            Dokumen Lampiran
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            @if ($acceptedIntern->intern->file_proposal)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_proposal) }}" target="_blank"
                    class="group border-2 border-gray-200 hover:border-blue-400 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-gradient-to-br from-blue-50 to-blue-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Proposal</p>
                            <p class="text-blue-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-blue-500 text-2xl group-hover:scale-110 transition-transform"></i>
                    </div>
                </a>
            @endif

            @if ($acceptedIntern->intern->file_cv)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_cv) }}" target="_blank"
                    class="group border-2 border-gray-200 hover:border-green-400 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-gradient-to-br from-green-50 to-green-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">CV</p>
                            <p class="text-green-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-green-500 text-2xl group-hover:scale-110 transition-transform"></i>
                    </div>
                </a>
            @endif

            @if ($acceptedIntern->intern->file_surat)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_surat) }}" target="_blank"
                    class="group border-2 border-gray-200 hover:border-purple-400 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-gradient-to-br from-purple-50 to-purple-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium">Surat Magang</p>
                            <p class="text-purple-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-purple-500 text-2xl group-hover:scale-110 transition-transform"></i>
                    </div>
                </a>
            @endif
        </div>

        <div class="flex space-x-4">
            <a href="{{ route('accepted-interns.edit', $acceptedIntern->id) }}"
                class="group bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                <i class="fas fa-edit group-hover:scale-110 transition-transform"></i>
                <span class="font-semibold">Edit Data</span>
            </a>
            <a href="{{ route('accepted-interns.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                <i class="fas fa-arrow-left"></i>
                <span class="font-semibold">Kembali</span>
            </a>
        </div>
    </div>
@endsection
