@extends('layouts.sidebar')

@section('title', 'Detail Monitoring Approval')
@section('page-title', 'Monitoring Approval')

@section('content')
    <!-- Header Section -->
    <div class="mb-8 fade-in">
        <div class="flex items-center gap-4 mb-3">
            <div
                class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                <i class="fas fa-id-card text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-heading">
                    Detail Monitoring
                </h1>
            </div>
        </div>
        <p class="text-gray-500 text-lg font-light ml-16">
            Informasi lengkap dan status approval peserta
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10 fade-in" style="animation-delay: 0.1s">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-user-circle text-blue-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 font-heading">
                Data Pribadi
            </h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama Lengkap</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->intern->nama }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">NIM</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->intern->nim }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Asal Kampus</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->intern->asal_kampus }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Program Studi</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->intern->program_studi }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Email Kampus</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->intern->email_kampus ?? '-' }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">No WhatsApp</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->intern->no_wa }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200 pt-8">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-briefcase text-green-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 font-heading">
                Informasi Magang
            </h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Periode Magang</label>
                <p class="text-gray-900 font-semibold text-lg flex items-center gap-2">
                    <i class="fas fa-calendar text-blue-500 text-sm"></i>
                    {{ $acceptedIntern->periode_magang ?? ($acceptedIntern->intern->periode_magang ?? '-') }}
                </p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Unit Magang</label>
                <p class="text-gray-900 font-semibold text-lg flex items-center gap-2">
                    <i class="fas fa-building text-purple-500 text-sm"></i>
                    {{ $acceptedIntern->unit_magang }}
                </p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Status Approval</label>
                <span
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-semibold {{ $acceptedIntern->approval_status_color }}">
                    @if ($acceptedIntern->approval_status === 'approved_deputy')
                        <i class="fas fa-check-circle"></i>
                    @elseif($acceptedIntern->approval_status === 'rejected')
                        <i class="fas fa-times-circle"></i>
                    @else
                        <i class="fas fa-clock"></i>
                    @endif
                    {{ $acceptedIntern->approval_status_label }}
                </span>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Didaftarkan Oleh</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->creator->name }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal
                    Didaftarkan</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->created_at->format('d F Y, H:i') }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200 pt-8">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-file-alt text-purple-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 font-heading">
                Dokumen Lampiran
            </h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            @if ($acceptedIntern->intern->file_formulir)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_formulir) }}" target="_blank"
                    class="group border-2 border-gray-200 hover:border-orange-400 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-gradient-to-br from-orange-50 to-orange-100">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-gray-600 text-sm font-medium">Formulir</p>
                            <p class="text-orange-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-orange-500 text-xl group-hover:scale-110 transition-transform flex-shrink-0"></i>
                    </div>
                </a>
            @endif

            @if ($acceptedIntern->intern->file_proposal)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_proposal) }}" target="_blank"
                    class="group border-2 border-gray-200 hover:border-blue-400 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-gradient-to-br from-blue-50 to-blue-100">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-gray-600 text-sm font-medium">Proposal</p>
                            <p class="text-blue-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-blue-500 text-xl group-hover:scale-110 transition-transform flex-shrink-0"></i>
                    </div>
                </a>
            @endif

            @if ($acceptedIntern->intern->file_cv)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_cv) }}" target="_blank"
                    class="group border-2 border-gray-200 hover:border-green-400 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-gradient-to-br from-green-50 to-green-100">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-gray-600 text-sm font-medium">CV</p>
                            <p class="text-green-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-green-500 text-xl group-hover:scale-110 transition-transform flex-shrink-0"></i>
                    </div>
                </a>
            @endif

            @if ($acceptedIntern->intern->file_surat)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_surat) }}" target="_blank"
                    class="group border-2 border-gray-200 hover:border-purple-400 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-gradient-to-br from-purple-50 to-purple-100">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-gray-600 text-sm font-medium">Surat Magang</p>
                            <p class="text-purple-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-purple-500 text-xl group-hover:scale-110 transition-transform flex-shrink-0"></i>
                    </div>
                </a>
            @endif
        </div>

        <div class="pt-8 mt-8 border-t border-gray-100 flex flex-wrap gap-3">
            <a href="{{ route('accepted-interns.edit', $acceptedIntern->id) }}"
                class="group relative overflow-hidden bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-yellow-500/30 hover:shadow-xl hover:shadow-yellow-500/40">
                <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                <i class="fas fa-edit text-sm"></i>
                <span>Edit Data</span>
            </a>
            <a href="{{ route('accepted-interns.index') }}"
                class="group bg-gray-100 hover:bg-gray-200 text-gray-700 hover:text-gray-900 px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2">
                <i class="fas fa-arrow-left text-sm"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>
@endsection
