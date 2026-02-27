@extends('layouts.sidebar')

@section('title', 'Detail Peserta Magang Final')
@section('page-title', 'Database Magang Final')

@section('content')
    <!-- Header Section -->
    <div class="mb-8 fade-in">
        <div class="flex items-center gap-4 mb-3">
            <div
                class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg shadow-green-500/30">
                <i class="fas fa-user-check text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-heading">
                    Detail Peserta Final
                </h1>
            </div>
        </div>
        <p class="text-gray-500 text-lg font-light ml-16">
            Informasi lengkap peserta magang yang sudah disetujui Deputy
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10 fade-in" style="animation-delay: 0.1s">
        <!-- Data Pribadi Section -->
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
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Jenis Kelamin</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->intern->jenis_kelamin }}</p>
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

        <!-- Informasi Magang Section -->
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
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</label>
                <span
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                    <i class="fas fa-check-circle"></i>
                    Disetujui Final (Deputy)
                </span>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal Disetujui
                    Deputy</label>
                <p class="text-gray-900 font-semibold text-lg">
                    @if ($acceptedIntern->approved_deputy_at)
                        {{ $acceptedIntern->approved_deputy_at->format('d F Y, H:i') }}
                    @else
                        -
                    @endif
                </p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Didaftarkan Oleh</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->creator->name ?? '-' }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal
                    Didaftarkan</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $acceptedIntern->created_at->format('d F Y, H:i') }}</p>
            </div>
        </div>

        <!-- Dokumen Lampiran Section -->
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

        <!-- WhatsApp Section -->
        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200 pt-8">
            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-paper-plane text-green-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 font-heading">
                Kirim Pesan
            </h3>
        </div>
        <div class="flex flex-wrap gap-4">
            @php
                $phoneWa = preg_replace('/[^0-9]/', '', $acceptedIntern->intern->no_wa ?? '');
                if (str_starts_with($phoneWa, '0')) {
                    $phoneWa = '62' . substr($phoneWa, 1);
                }
                $messageWa =
                    'Halo ' .
                    $acceptedIntern->intern->nama .
                    ", perkenalkan saya PIC Magang Unit Learning Management Kantor Regional I\n\nSaat ini berkas pengajuan kamu sudah kami terima dan sedang diproses sesuai dengan ketentuan dan kebutuhan perusahaan. Untuk informasinya selanjutnya akan diberitahukan di kesempatan berikutnya.\n\nTerima kasih.\n-Admin Pemagangan Kantor Regional I (URSHIPORTS; Your Internship Programme at Injourney Airports Kantor Regional I)";

                $emailSubject = 'Informasi Magang - ' . $acceptedIntern->intern->nama;
                $emailBody =
                    'Halo ' .
                    $acceptedIntern->intern->nama .
                    ",\n\nPerkenalkan saya PIC Magang Unit Learning Management Kantor Regional I.\n\nSaat ini berkas pengajuan kamu sudah kami terima dan sedang diproses sesuai dengan ketentuan dan kebutuhan perusahaan. Untuk informasinya selanjutnya akan diberitahukan di kesempatan berikutnya.\n\nTerima kasih.\n-Admin Pemagangan Kantor Regional I (URSHIPORTS; Your Internship Programme at Injourney Airports Kantor Regional I)";
            @endphp

            <a href="https://wa.me/{{ $phoneWa }}?text={{ urlencode($messageWa) }}" target="_blank"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40">
                <i class="fab fa-whatsapp text-xl"></i>
                <span>Kirim WhatsApp</span>
            </a>

            @if ($acceptedIntern->intern->email_kampus)
                <a href="https://mail.google.com/mail/?view=cm&to={{ urlencode($acceptedIntern->intern->email_kampus) }}&su={{ urlencode($emailSubject) }}&body={{ urlencode($emailBody) }}"
                    target="_blank"
                    class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40">
                    <i class="fas fa-envelope text-xl"></i>
                    <span>Kirim Email</span>
                </a>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="pt-8 mt-8 border-t border-gray-100 flex flex-wrap gap-3">
            <a href="{{ route('database-magang.edit', $acceptedIntern->id) }}"
                class="group relative overflow-hidden bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-yellow-500/30 hover:shadow-xl hover:shadow-yellow-500/40">
                <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                <i class="fas fa-edit text-sm"></i>
                <span>Edit Data</span>
            </a>
            <button type="button" onclick="showDeleteModal()"
                class="group relative overflow-hidden bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-600 hover:to-rose-600 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40">
                <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                <i class="fas fa-trash text-sm"></i>
                <span>Hapus Data</span>
            </button>
            <a href="{{ route('database-magang.index') }}"
                class="group bg-gray-100 hover:bg-gray-200 text-gray-700 hover:text-gray-900 px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2">
                <i class="fas fa-arrow-left text-sm"></i>
                <span>Kembali ke Database</span>
            </a>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true"
                onclick="hideDeleteModal()"></div>

            <!-- Modal panel -->
            <div
                class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl">
                <div class="flex flex-col items-center">
                    <!-- Warning Icon -->
                    <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full mb-4">
                        <i class="fas fa-exclamation-triangle text-red-600 text-3xl"></i>
                    </div>

                    <!-- Title -->
                    <h3 class="text-xl font-bold text-gray-900 mb-2" id="modal-title">
                        Konfirmasi Hapus Data
                    </h3>

                    <!-- Message -->
                    <p class="text-gray-500 text-center mb-2">
                        Apakah Anda yakin ingin menghapus data peserta magang:
                    </p>
                    <p class="font-semibold text-gray-800 text-lg mb-4">{{ $acceptedIntern->intern->nama }}</p>
                    <p class="text-sm text-red-500 mb-6">
                        <i class="fas fa-info-circle mr-1"></i>
                        Tindakan ini tidak dapat dibatalkan!
                    </p>

                    <!-- Buttons -->
                    <div class="flex gap-3 w-full">
                        <button type="button" onclick="hideDeleteModal()"
                            class="flex-1 px-4 py-3 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-xl font-medium transition-colors">
                            <i class="fas fa-times mr-2"></i>Batal
                        </button>
                        <form action="{{ route('database-magang.destroy', $acceptedIntern->id) }}" method="POST"
                            class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full px-4 py-3 text-white bg-red-500 hover:bg-red-600 rounded-xl font-medium transition-colors">
                                <i class="fas fa-trash mr-2"></i>Ya, Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideDeleteModal();
            }
        });
    </script>
@endsection
