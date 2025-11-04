@extends('layouts.app')

@section('title', 'Detail Data Database Magang')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Detail Data Database Magang</h1>
        <p class="text-gray-600">Informasi lengkap anak magang yang terdaftar</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Data Pribadi</h3>
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

        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Informasi Magang</h3>
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

        <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Dokumen Lampiran</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            @if ($acceptedIntern->intern->file_proposal)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_proposal) }}" target="_blank"
                    class="border rounded-lg p-4 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">Proposal</p>
                            <p class="text-blue-600 font-semibold text-xs">
                                <i class="fas fa-file-pdf"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i class="fas fa-external-link-alt text-blue-500 text-xl"></i>
                    </div>
                </a>
            @endif

            @if ($acceptedIntern->intern->file_cv)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_cv) }}" target="_blank"
                    class="border rounded-lg p-4 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">CV</p>
                            <p class="text-blue-600 font-semibold text-xs">
                                <i class="fas fa-file-pdf"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i class="fas fa-external-link-alt text-blue-500 text-xl"></i>
                    </div>
                </a>
            @endif

            @if ($acceptedIntern->intern->file_surat)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_surat) }}" target="_blank"
                    class="border rounded-lg p-4 hover:shadow-md transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm">Surat Magang</p>
                            <p class="text-blue-600 font-semibold text-xs">
                                <i class="fas fa-file-pdf"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i class="fas fa-external-link-alt text-blue-500 text-xl"></i>
                    </div>
                </a>
            @endif
        </div>

        <div class="flex space-x-4">
            <a href="{{ route('accepted-interns.edit', $acceptedIntern->id) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('accepted-interns.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
@endsection
