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
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Kelas</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->intern->kelas ?? '-' }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Semester</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->intern->semester ?? '-' }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Tujuan Magang</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->intern->tujuan_magang ?? '-' }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Jenis Kelamin</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->intern->jenis_kelamin ?? '-' }}</p>
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
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Periode
                    Pendaftaran</label>
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
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal Mulai
                    Magang</label>
                <p class="text-gray-900 font-semibold text-lg flex items-center gap-2">
                    <i class="fas fa-calendar-check text-green-500 text-sm"></i>
                    {{ $acceptedIntern->intern->tanggal_mulai_magang ? $acceptedIntern->intern->tanggal_mulai_magang->format('d M Y') : '-' }}
                </p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal Selesai
                    Magang</label>
                <p class="text-gray-900 font-semibold text-lg flex items-center gap-2">
                    <i class="fas fa-calendar-times text-red-500 text-sm"></i>
                    {{ $acceptedIntern->intern->tanggal_selesai_magang ? $acceptedIntern->intern->tanggal_selesai_magang->format('d M Y') : '-' }}
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
            @if ($acceptedIntern->approval_status === 'pending' && !$acceptedIntern->documents_verified)
                <span id="docProgressBadge"
                    class="ml-auto text-sm px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 font-medium">
                    <i class="fas fa-clock mr-1"></i>
                    <span id="viewedCount">0</span>/<span id="totalCount">0</span> dokumen dibaca
                </span>
            @elseif ($acceptedIntern->documents_verified)
                <span class="ml-auto text-sm px-3 py-1 rounded-full bg-green-100 text-green-800 font-medium">
                    <i class="fas fa-check-circle mr-1"></i> Semua dokumen terverifikasi
                </span>
            @endif
        </div>

        {{-- Progress Alert for pending documents --}}
        @if ($acceptedIntern->approval_status === 'pending' && !$acceptedIntern->documents_verified)
            <div id="docAlert"
                class="mb-6 p-4 rounded-xl bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-info-circle text-blue-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-blue-900">Klik semua dokumen untuk verifikasi</p>
                        <p class="text-blue-700 text-sm mt-1">Setelah semua dokumen dibaca, status akan otomatis berubah
                            menjadi "Dikirim ke Div Head"</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
            @if ($acceptedIntern->intern->file_cv)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_cv) }}" target="_blank" data-document="cv"
                    data-viewed="{{ $acceptedIntern->viewed_cv ? 'true' : 'false' }}"
                    class="doc-link group border-2 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 {{ $acceptedIntern->viewed_cv ? 'border-green-400 bg-gradient-to-br from-green-100 to-green-200' : 'border-gray-200 hover:border-green-400 bg-gradient-to-br from-green-50 to-green-100' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-gray-600 text-sm font-medium flex items-center gap-2">
                                CV
                                @if ($acceptedIntern->viewed_cv)
                                    <span class="text-green-600"><i class="fas fa-check-circle"></i></span>
                                @endif
                            </p>
                            <p class="text-green-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i>
                                {{ $acceptedIntern->viewed_cv ? 'Sudah Dibaca' : 'Lihat Dokumen' }}
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-green-500 text-xl group-hover:scale-110 transition-transform flex-shrink-0"></i>
                    </div>
                </a>
            @endif

            @if ($acceptedIntern->intern->file_transkrip)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_transkrip) }}" target="_blank"
                    data-document="transkrip" data-viewed="{{ $acceptedIntern->viewed_transkrip ? 'true' : 'false' }}"
                    class="doc-link group border-2 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 {{ $acceptedIntern->viewed_transkrip ? 'border-blue-400 bg-gradient-to-br from-blue-100 to-blue-200' : 'border-gray-200 hover:border-blue-400 bg-gradient-to-br from-blue-50 to-blue-100' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-gray-600 text-sm font-medium flex items-center gap-2">
                                Transkrip Nilai
                                @if ($acceptedIntern->viewed_transkrip)
                                    <span class="text-blue-600"><i class="fas fa-check-circle"></i></span>
                                @endif
                            </p>
                            <p class="text-blue-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i>
                                {{ $acceptedIntern->viewed_transkrip ? 'Sudah Dibaca' : 'Lihat Dokumen' }}
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-blue-500 text-xl group-hover:scale-110 transition-transform flex-shrink-0"></i>
                    </div>
                </a>
            @endif

            @if ($acceptedIntern->intern->file_ktp_ktm)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_ktp_ktm) }}" target="_blank"
                    data-document="ktp_ktm" data-viewed="{{ $acceptedIntern->viewed_ktp_ktm ? 'true' : 'false' }}"
                    class="doc-link group border-2 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 {{ $acceptedIntern->viewed_ktp_ktm ? 'border-amber-400 bg-gradient-to-br from-amber-100 to-amber-200' : 'border-gray-200 hover:border-amber-400 bg-gradient-to-br from-amber-50 to-amber-100' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-gray-600 text-sm font-medium flex items-center gap-2">
                                KTP & KTM
                                @if ($acceptedIntern->viewed_ktp_ktm)
                                    <span class="text-amber-600"><i class="fas fa-check-circle"></i></span>
                                @endif
                            </p>
                            <p class="text-amber-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i>
                                {{ $acceptedIntern->viewed_ktp_ktm ? 'Sudah Dibaca' : 'Lihat Dokumen' }}
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-amber-500 text-xl group-hover:scale-110 transition-transform flex-shrink-0"></i>
                    </div>
                </a>
            @endif

            @if ($acceptedIntern->intern->file_bpjs)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_bpjs) }}" target="_blank"
                    data-document="bpjs" data-viewed="{{ $acceptedIntern->viewed_bpjs ? 'true' : 'false' }}"
                    class="doc-link group border-2 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 {{ $acceptedIntern->viewed_bpjs ? 'border-red-400 bg-gradient-to-br from-red-100 to-red-200' : 'border-gray-200 hover:border-red-400 bg-gradient-to-br from-red-50 to-red-100' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-gray-600 text-sm font-medium flex items-center gap-2">
                                Bukti Kepesertaan BPJS Kesehatan / Asuransi
                                @if ($acceptedIntern->viewed_bpjs)
                                    <span class="text-red-600"><i class="fas fa-check-circle"></i></span>
                                @endif
                            </p>
                            <p class="text-red-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i>
                                {{ $acceptedIntern->viewed_bpjs ? 'Sudah Dibaca' : 'Lihat Dokumen' }}
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-red-500 text-xl group-hover:scale-110 transition-transform flex-shrink-0"></i>
                    </div>
                </a>
            @endif

            @if ($acceptedIntern->intern->file_surat)
                <a href="{{ asset('storage/' . $acceptedIntern->intern->file_surat) }}" target="_blank"
                    data-document="surat" data-viewed="{{ $acceptedIntern->viewed_surat ? 'true' : 'false' }}"
                    class="doc-link group border-2 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 {{ $acceptedIntern->viewed_surat ? 'border-purple-400 bg-gradient-to-br from-purple-100 to-purple-200' : 'border-gray-200 hover:border-purple-400 bg-gradient-to-br from-purple-50 to-purple-100' }}">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-gray-600 text-sm font-medium flex items-center gap-2">
                                Surat Pengantar Kampus
                                @if ($acceptedIntern->viewed_surat)
                                    <span class="text-purple-600"><i class="fas fa-check-circle"></i></span>
                                @endif
                            </p>
                            <p class="text-purple-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i>
                                {{ $acceptedIntern->viewed_surat ? 'Sudah Dibaca' : 'Lihat Dokumen' }}
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-purple-500 text-xl group-hover:scale-110 transition-transform flex-shrink-0"></i>
                    </div>
                </a>
            @endif
        </div>

        <div class="pt-8 mt-8 border-t border-gray-100 flex flex-wrap gap-3">
            {{-- Show action buttons when documents are verified but not yet sent --}}
            @if ($acceptedIntern->approval_status === 'pending' && $acceptedIntern->documents_verified)
                {{-- Terima & Kirim ke Div Head --}}
                <button type="button" onclick="openForwardModal()"
                    class="group relative overflow-hidden bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40">
                    <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                    <i class="fas fa-check-circle text-sm"></i>
                    <span>Terima & Kirim ke Div Head</span>
                </button>

                {{-- Tolak Button --}}
                <button type="button" onclick="openRejectModal()"
                    class="group relative overflow-hidden bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-600 hover:to-rose-600 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40">
                    <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                    <i class="fas fa-times-circle text-sm"></i>
                    <span>Tolak</span>
                </button>
            @endif

            {{-- Hidden buttons for JS to show dynamically after all docs read --}}
            <div id="actionButtonsContainer" class="hidden flex-wrap gap-3">
                {{-- Terima & Kirim ke Div Head --}}
                <button type="button" onclick="openForwardModal()"
                    class="group relative overflow-hidden bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40">
                    <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                    <i class="fas fa-check-circle text-sm"></i>
                    <span>Terima & Kirim ke Div Head</span>
                </button>

                {{-- Tolak Button --}}
                <button type="button" onclick="openRejectModal()"
                    class="group relative overflow-hidden bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-600 hover:to-rose-600 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40">
                    <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                    <i class="fas fa-times-circle text-sm"></i>
                    <span>Tolak</span>
                </button>
            </div>

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

    @if ($acceptedIntern->approval_status === 'pending' && !$acceptedIntern->documents_verified)
        {{-- Success Modal --}}
        <div id="successModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl w-full max-w-md transform transition-all animate-bounce-in">
                <div class="p-8 text-center">
                    <div
                        class="w-20 h-20 mx-auto mb-4 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                        <i class="fas fa-check text-white text-3xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Dokumen Telah Dibaca!</h3>
                    <p class="text-gray-600 mb-6">Semua dokumen telah dibaca. Silakan pilih aksi selanjutnya: Terima &
                        Kirim ke Div Head atau Tolak.</p>
                    <button type="button" onclick="closeSuccessModal()"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-xl font-semibold transition-all">
                        <i class="fas fa-check"></i>
                        Mengerti
                    </button>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const docLinks = document.querySelectorAll('.doc-link');
                const viewedCountEl = document.getElementById('viewedCount');
                const totalCountEl = document.getElementById('totalCount');
                const progressBadge = document.getElementById('docProgressBadge');
                const docAlert = document.getElementById('docAlert');
                const successModal = document.getElementById('successModal');
                const actionButtonsContainer = document.getElementById('actionButtonsContainer');
                const acceptedInternId = '{{ $acceptedIntern->id }}';
                const csrfToken = '{{ csrf_token() }}';

                // Count total and viewed documents
                let totalDocs = docLinks.length;
                let viewedDocs = 0;

                docLinks.forEach(link => {
                    if (link.dataset.viewed === 'true') {
                        viewedDocs++;
                    }
                });

                // Update counter display
                if (totalCountEl) totalCountEl.textContent = totalDocs;
                if (viewedCountEl) viewedCountEl.textContent = viewedDocs;

                // Update badge color based on progress
                updateBadgeColor();

                // Add click handlers to document links
                docLinks.forEach(link => {
                    link.addEventListener('click', function(e) {
                        const docType = this.dataset.document;
                        const isViewed = this.dataset.viewed === 'true';

                        // Only track if not already viewed
                        if (!isViewed) {
                            markDocumentViewed(docType, this);
                        }
                    });
                });

                function markDocumentViewed(docType, linkElement) {
                    fetch(`/accepted-interns/${acceptedInternId}/mark-document-viewed`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                document: docType
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update UI to show document as viewed
                                linkElement.dataset.viewed = 'true';
                                viewedDocs++;

                                // Update counter
                                if (viewedCountEl) viewedCountEl.textContent = viewedDocs;
                                updateBadgeColor();

                                // Check if all documents are viewed
                                if (data.all_viewed && data.documents_verified) {
                                    // Show success modal
                                    if (successModal) {
                                        successModal.classList.remove('hidden');
                                    }
                                    // Show action buttons
                                    if (actionButtonsContainer) {
                                        actionButtonsContainer.classList.remove('hidden');
                                        actionButtonsContainer.classList.add('flex');
                                    }
                                    // Update alert
                                    if (docAlert) {
                                        docAlert.innerHTML = `
                                        <div class="flex items-start gap-3">
                                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-check-circle text-green-600"></i>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-green-900">Semua dokumen telah dibaca!</p>
                                                <p class="text-green-700 text-sm mt-1">Silakan pilih aksi: Terima & Kirim ke Div Head atau Tolak.</p>
                                            </div>
                                        </div>
                                    `;
                                        docAlert.className =
                                            'mb-6 p-4 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200';
                                    }
                                    // Update badge
                                    if (progressBadge) {
                                        progressBadge.innerHTML =
                                            '<i class="fas fa-check-circle mr-1"></i> Dokumen Dibaca';
                                        progressBadge.className =
                                            'ml-auto text-sm px-3 py-1 rounded-full bg-green-100 text-green-800 font-medium';
                                    }
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error marking document as viewed:', error);
                        });
                }

                function updateBadgeColor() {
                    if (!progressBadge) return;

                    const percentage = totalDocs > 0 ? (viewedDocs / totalDocs) * 100 : 0;

                    if (percentage === 100) {
                        progressBadge.className =
                            'ml-auto text-sm px-3 py-1 rounded-full bg-green-100 text-green-800 font-medium';
                    } else if (percentage >= 50) {
                        progressBadge.className =
                            'ml-auto text-sm px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-medium';
                    } else {
                        progressBadge.className =
                            'ml-auto text-sm px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 font-medium';
                    }
                }
            });

            function closeSuccessModal() {
                document.getElementById('successModal').classList.add('hidden');
            }
        </script>
    @endif

    {{-- Rejection Modal - Always available --}}
    <div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <div class="flex justify-center mb-4">
                    <div
                        class="w-16 h-16 rounded-full bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center">
                        <i class="fas fa-times text-white text-2xl"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 text-center mb-2">Tolak Pengajuan</h3>
                <p class="text-gray-600 text-center mb-6">Berikan alasan penolakan untuk
                    {{ $acceptedIntern->intern->nama }}</p>

                <form action="{{ route('accepted-interns.rejectByHC', $acceptedIntern->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alasan Penolakan <span
                                class="text-red-500">*</span></label>
                        <textarea name="rejection_reason" rows="4" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                            placeholder="Contoh: Dokumen tidak lengkap, periode magang tidak sesuai, dll..."></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" onclick="closeRejectModal()"
                            class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-semibold transition-all">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-600 hover:to-rose-600 text-white rounded-xl font-semibold transition-all">
                            <i class="fas fa-times-circle mr-2"></i>Tolak & Kirim WA
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Forward to Div Head Modal --}}
    <div id="forwardModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md transform transition-all animate-[fadeInScale_0.3s_ease-out]">
            <div class="p-6">
                {{-- Icon Header --}}
                <div class="flex justify-center mb-4">
                    <div
                        class="w-20 h-20 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center shadow-lg shadow-green-500/30">
                        <i class="fas fa-paper-plane text-white text-3xl"></i>
                    </div>
                </div>

                {{-- Title --}}
                <h3 class="text-2xl font-bold text-gray-800 text-center mb-2">Kirim ke Div Head</h3>
                <p class="text-gray-600 text-center mb-6">Anda akan menerima dan mengirim data ini ke Div Head untuk proses
                    approval selanjutnya.</p>

                {{-- Info Box --}}
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-4 mb-6">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-user text-green-600"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $acceptedIntern->intern->nama }}</p>
                            <p class="text-sm text-gray-600">{{ $acceptedIntern->intern->asal_kampus }}</p>
                            <p class="text-sm text-gray-500">{{ $acceptedIntern->unit_magang }}</p>
                        </div>
                    </div>
                </div>

                {{-- Warning --}}
                <div class="flex items-center gap-2 text-sm text-amber-700 bg-amber-50 rounded-lg px-4 py-3 mb-6">
                    <i class="fas fa-info-circle text-amber-500"></i>
                    <span>Data akan diteruskan ke Div Head untuk approval final.</span>
                </div>

                {{-- Form --}}
                <form id="forwardForm" action="{{ route('accepted-interns.sendToApproval', $acceptedIntern->id) }}"
                    method="POST">
                    @csrf
                </form>

                {{-- Action Buttons --}}
                <div class="flex gap-3">
                    <button type="button" onclick="closeForwardModal()"
                        class="flex-1 px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-semibold transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-times"></i>
                        Batal
                    </button>
                    <button type="button" onclick="submitForwardForm()"
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white rounded-xl font-semibold transition-all flex items-center justify-center gap-2 shadow-lg shadow-green-500/30">
                        <i class="fas fa-paper-plane"></i>
                        Ya, Kirim
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: scale(0.9);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>

    <script>
        function openRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }

        function openForwardModal() {
            document.getElementById('forwardModal').classList.remove('hidden');
        }

        function closeForwardModal() {
            document.getElementById('forwardModal').classList.add('hidden');
        }

        function submitForwardForm() {
            document.getElementById('forwardForm').submit();
        }

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeRejectModal();
                closeForwardModal();
            }
        });

        // Close modal when clicking outside
        document.getElementById('rejectModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });

        document.getElementById('forwardModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeForwardModal();
            }
        });
    </script>
@endsection
