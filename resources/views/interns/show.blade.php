@extends('layouts.app')

@section('title', 'Detail Data Magang')

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
                    Detail Pengajuan Magang
                </h1>
            </div>
        </div>
        <p class="text-gray-500 text-lg font-light ml-16">
            Informasi lengkap pengajuan magang
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10 fade-in" style="animation-delay: 0.1s">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama Lengkap</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->nama }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">NIM</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->nim }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Asal Kampus</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->asal_kampus }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Program Studi</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->program_studi }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Email Kampus</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->email_kampus ?? '-' }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">No WhatsApp</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->no_wa }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</label>
                @if ($intern->status === 'pending')
                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-amber-50 text-amber-700 border border-amber-200">
                        <i class="fas fa-clock"></i> Menunggu Persetujuan
                    </span>
                @elseif($intern->status === 'approved')
                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <i class="fas fa-check-circle"></i> Diterima
                    </span>
                @else
                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-red-50 text-red-700 border border-red-200">
                        <i class="fas fa-times-circle"></i> Ditolak
                    </span>
                @endif
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Dibuat Oleh</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->creator->name }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal Dibuat</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->created_at->format('d M Y H:i') }}</p>
            </div>

            @if ($intern->status === 'rejected' && $intern->rejection_reason)
                <div class="col-span-2 space-y-2">
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Alasan
                        Penolakan</label>
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                        <p class="text-red-700 font-medium">{{ $intern->rejection_reason }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200 pt-8">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-file-alt text-purple-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 font-heading">
                Dokumen Lampiran
            </h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            @if ($intern->file_proposal)
                <a href="{{ asset('storage/' . $intern->file_proposal) }}" target="_blank"
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

            @if ($intern->file_cv)
                <a href="{{ asset('storage/' . $intern->file_cv) }}" target="_blank"
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

            @if ($intern->file_surat)
                <a href="{{ asset('storage/' . $intern->file_surat) }}" target="_blank"
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

        <div class="pt-8 mt-8 border-t border-gray-100">
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('interns.index') }}"
                    class="group bg-gray-100 hover:bg-gray-200 text-gray-700 hover:text-gray-900 px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2">
                    <i class="fas fa-arrow-left text-sm"></i>
                    <span>Kembali</span>
                </a>

                @if ((auth()->user()->role === 'hc' || auth()->user()->role === 'admin') && $intern->status === 'pending')
                    <form action="{{ route('interns.updateStatus', $intern->id) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="status" value="approved">
                        <button type="submit"
                            class="group relative overflow-hidden bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40">
                            <span
                                class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                            <i class="fas fa-check-circle text-sm"></i>
                            <span>Approve & Hubungi via WhatsApp</span>
                        </button>
                    </form>
                    <button type="button" onclick="openRejectModal()"
                        class="group relative overflow-hidden bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40">
                        <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                        <i class="fas fa-times-circle text-sm"></i>
                        <span>Tolak Lamaran</span>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Alasan Penolakan -->
    <div id="rejectModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-lg w-full max-w-md">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Alasan Penolakan</h3>
                <form action="{{ route('interns.updateStatus', $intern->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="rejected">

                    <div class="mb-4">
                        <label for="rejection_reason" class="block text-gray-700 font-medium mb-2">
                            Masukkan alasan penolakan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="rejection_reason" id="rejection_reason" rows="4"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500"
                            placeholder="Contoh: Dokumen tidak lengkap, CV tidak sesuai format, dll..." required></textarea>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeRejectModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                            Batal
                        </button>
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                            <i class="fas fa-times-circle"></i> Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Preview -->
    <div id="previewModal"
        class="hidden fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-full max-w-6xl h-5/6 flex flex-col shadow-2xl">
            <div
                class="flex justify-between items-center p-6 border-b-2 border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center" id="modalTitle">
                    <i class="fas fa-file-alt text-blue-600 mr-3"></i>
                    Preview Dokumen
                </h3>
                <div class="flex space-x-3">
                    <a id="downloadBtn" href="#" download
                        class="group bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-5 py-2 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-download group-hover:scale-110 transition-transform"></i>
                        <span class="font-semibold">Download</span>
                    </a>
                    <button onclick="closePreview()"
                        class="group bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white px-5 py-2 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-times group-hover:rotate-90 transition-transform"></i>
                        <span class="font-semibold">Tutup</span>
                    </button>
                </div>
            </div>
            <div class="flex-1 overflow-hidden">
                <iframe id="previewFrame" class="w-full h-full" frameborder="0"></iframe>
            </div>
        </div>
    </div>

    <script>
        function openPreview(url, title) {
            document.getElementById('modalTitle').textContent = 'Preview ' + title;
            document.getElementById('previewFrame').src = url;
            document.getElementById('downloadBtn').href = url;
            document.getElementById('previewModal').classList.remove('hidden');
        }

        function closePreview() {
            document.getElementById('previewModal').classList.add('hidden');
            document.getElementById('previewFrame').src = '';
        }

        function openRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('previewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePreview();
            }
        });

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePreview();
                closeRejectModal();
            }
        });
    </script>
@endsection
