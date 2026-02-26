@extends('layouts.sidebar')

@section('title', 'Detail Pengajuan')
@section('page-title', 'Detail Pengajuan')

@section('content')
    <div class="mb-6">
        <a href="{{ url()->previous() }}" class="text-gray-600 hover:text-gray-800">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2">
            <!-- Intern Details -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-user-graduate text-teal-500 mr-2"></i>
                    Data Peserta Magang
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-500">Nama Lengkap</label>
                        <p class="font-medium text-gray-800">{{ $acceptedIntern->intern->nama }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Jenis Kelamin</label>
                        <p class="font-medium text-gray-800">{{ $acceptedIntern->intern->jenis_kelamin }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Asal Kampus</label>
                        <p class="font-medium text-gray-800">{{ $acceptedIntern->intern->asal_kampus }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Program Studi</label>
                        <p class="font-medium text-gray-800">{{ $acceptedIntern->intern->program_studi }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Email</label>
                        <p class="font-medium text-gray-800">{{ $acceptedIntern->intern->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">No. Telepon</label>
                        <p class="font-medium text-gray-800">{{ $acceptedIntern->intern->no_telepon }}</p>
                    </div>
                </div>
            </div>

            <!-- Internship Details -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-briefcase text-blue-500 mr-2"></i>
                    Data Magang
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm text-gray-500">Unit Magang</label>
                        <p class="font-medium text-gray-800">{{ $acceptedIntern->unit_magang }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Periode Magang</label>
                        <p class="font-medium text-gray-800">
                            {{ $acceptedIntern->periode_magang ?? ($acceptedIntern->intern->periode_magang ?? '-') }}
                        </p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Diinput oleh</label>
                        <p class="font-medium text-gray-800">{{ $acceptedIntern->creator->name ?? 'Tidak diketahui' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Tanggal Input</label>
                        <p class="font-medium text-gray-800">{{ $acceptedIntern->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Documents -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-file-alt text-orange-500 mr-2"></i>
                    Dokumen
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @if ($acceptedIntern->intern->file_proposal)
                        <a href="{{ asset('storage/' . $acceptedIntern->intern->file_proposal) }}" target="_blank"
                            class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-800">Proposal</p>
                                <p class="text-sm text-gray-500">Lihat dokumen</p>
                            </div>
                        </a>
                    @endif
                    @if ($acceptedIntern->intern->file_cv)
                        <a href="{{ asset('storage/' . $acceptedIntern->intern->file_cv) }}" target="_blank"
                            class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-800">CV</p>
                                <p class="text-sm text-gray-500">Lihat dokumen</p>
                            </div>
                        </a>
                    @endif
                    @if ($acceptedIntern->intern->file_surat)
                        <a href="{{ asset('storage/' . $acceptedIntern->intern->file_surat) }}" target="_blank"
                            class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                            <div>
                                <p class="font-medium text-gray-800">Surat Pengantar</p>
                                <p class="text-sm text-gray-500">Lihat dokumen</p>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Status Sidebar -->
        <div class="lg:col-span-1">
            <!-- Current Status -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Status Approval</h2>

                <div class="text-center mb-4">
                    <span class="px-4 py-2 rounded-full text-sm font-medium {{ $acceptedIntern->approval_status_color }}">
                        {{ $acceptedIntern->approval_status_label }}
                    </span>
                </div>

                @if ($acceptedIntern->rejection_reason)
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4 mt-4">
                        <p class="text-sm font-medium text-red-800">Alasan Penolakan:</p>
                        <p class="text-sm text-red-700 mt-1">{{ $acceptedIntern->rejection_reason }}</p>
                    </div>
                @endif
            </div>

            <!-- Approval Timeline -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Timeline Approval</h2>

                <div class="space-y-4">
                    <!-- Created -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-8 h-8 bg-teal-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-plus text-teal-600 text-xs"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-800">Diinput ke Unit</p>
                            <p class="text-xs text-gray-500">{{ $acceptedIntern->created_at->format('d M Y H:i') }}</p>
                            @if ($acceptedIntern->creator)
                                <p class="text-xs text-gray-400">oleh {{ $acceptedIntern->creator->name }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Sent to Div Head -->
                    @if ($acceptedIntern->sent_to_divhead_at)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-paper-plane text-blue-600 text-xs"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-800">Dikirim ke Div Head</p>
                                <p class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($acceptedIntern->sent_to_divhead_at)->format('d M Y H:i') }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Approved by Div Head -->
                    @if ($acceptedIntern->approved_divhead_at)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-check text-green-600 text-xs"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-800">Disetujui Div Head</p>
                                <p class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($acceptedIntern->approved_divhead_at)->format('d M Y H:i') }}
                                </p>
                                @if ($acceptedIntern->approverDivHead)
                                    <p class="text-xs text-gray-400">oleh {{ $acceptedIntern->approverDivHead->name }}</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Sent to Deputy -->
                    @if ($acceptedIntern->sent_to_deputy_at)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-share text-purple-600 text-xs"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-800">Dikirim ke Deputy</p>
                                <p class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($acceptedIntern->sent_to_deputy_at)->format('d M Y H:i') }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Approved by Deputy -->
                    @if ($acceptedIntern->approved_deputy_at)
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-check-double text-white text-xs"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-800">Disetujui Final Deputy</p>
                                <p class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($acceptedIntern->approved_deputy_at)->format('d M Y H:i') }}
                                </p>
                                @if ($acceptedIntern->approverDeputy)
                                    <p class="text-xs text-gray-400">oleh {{ $acceptedIntern->approverDeputy->name }}</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Rejected -->
                    @if ($acceptedIntern->approval_status === 'rejected')
                        <div class="flex items-start">
                            <div class="flex-shrink-0 w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-times text-red-600 text-xs"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">Ditolak</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
