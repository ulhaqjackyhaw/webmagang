@extends('layouts.app')

@section('title', 'Detail Data Magang')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <h1
            class="text-4xl font-bold text-purple-600 flex items-center">
            <i class="fas fa-id-card-alt mr-3 text-purple-600"></i>
            Detail Data Pengajuan Magang
        </h1>
        <p class="text-gray-600 mt-2 flex items-center">
            <i class="fas fa-info-circle mr-2 text-purple-500"></i>
            Informasi lengkap pengajuan magang
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-xl p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-gray-600 text-sm mb-1">Nama Lengkap</label>
                <p class="text-gray-900 font-semibold">{{ $intern->nama }}</p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">NIM</label>
                <p class="text-gray-900 font-semibold">{{ $intern->nim }}</p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">Asal Kampus</label>
                <p class="text-gray-900 font-semibold">{{ $intern->asal_kampus }}</p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">Program Studi</label>
                <p class="text-gray-900 font-semibold">{{ $intern->program_studi }}</p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">Email Kampus</label>
                <p class="text-gray-900 font-semibold">{{ $intern->email_kampus ?? '-' }}</p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">No WhatsApp</label>
                <p class="text-gray-900 font-semibold">{{ $intern->no_wa }}</p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">Status</label>
                @if ($intern->status === 'pending')
                    <span
                        class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i> Menunggu Persetujuan
                    </span>
                @elseif($intern->status === 'approved')
                    <span
                        class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i> Diterima
                    </span>
                @else
                    <span
                        class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                        <i class="fas fa-times-circle mr-1"></i> Ditolak
                    </span>
                @endif
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">Dibuat Oleh</label>
                <p class="text-gray-900 font-semibold">{{ $intern->creator->name }}</p>
            </div>

            <div>
                <label class="block text-gray-600 text-sm mb-1">Tanggal Dibuat</label>
                <p class="text-gray-900 font-semibold">{{ $intern->created_at->format('d M Y H:i') }}</p>
            </div>

            @if ($intern->status === 'rejected' && $intern->rejection_reason)
                <div class="col-span-2">
                    <label class="block text-gray-600 text-sm mb-1">Alasan Penolakan</label>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <p class="text-red-800">{{ $intern->rejection_reason }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="border-t-2 border-purple-200 pt-8 mt-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-file-alt text-purple-500 mr-3"></i>
                Dokumen Lampiran
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @if ($intern->file_proposal)
                    <div class="group border-2 border-gray-200 hover:border-blue-400 rounded-xl p-5 hover:shadow-2xl transition-all duration-300 cursor-pointer transform hover:-translate-y-1 bg-gradient-to-br from-blue-50 to-blue-100"
                        onclick="openPreview('{{ asset('storage/' . $intern->file_proposal) }}', 'Proposal')">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-gray-600 text-sm font-medium mb-1">Proposal</p>
                                <p class="text-gray-900 font-bold text-xs truncate">
                                    {{ basename($intern->file_proposal) }}</p>
                            </div>
                            <div class="text-blue-500">
                                <i class="fas fa-eye text-3xl group-hover:scale-125 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($intern->file_cv)
                    <div class="group border-2 border-gray-200 hover:border-green-400 rounded-xl p-5 hover:shadow-2xl transition-all duration-300 cursor-pointer transform hover:-translate-y-1 bg-gradient-to-br from-green-50 to-green-100"
                        onclick="openPreview('{{ asset('storage/' . $intern->file_cv) }}', 'CV')">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-gray-600 text-sm font-medium mb-1">CV</p>
                                <p class="text-gray-900 font-bold text-xs truncate">{{ basename($intern->file_cv) }}
                                </p>
                            </div>
                            <div class="text-green-500">
                                <i class="fas fa-eye text-3xl group-hover:scale-125 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($intern->file_surat)
                    <div class="group border-2 border-gray-200 hover:border-purple-400 rounded-xl p-5 hover:shadow-2xl transition-all duration-300 cursor-pointer transform hover:-translate-y-1 bg-gradient-to-br from-purple-50 to-purple-100"
                        onclick="openPreview('{{ asset('storage/' . $intern->file_surat) }}', 'Surat Magang')">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-gray-600 text-sm font-medium mb-1">Surat Magang</p>
                                <p class="text-gray-900 font-bold text-xs truncate">{{ basename($intern->file_surat) }}
                                </p>
                            </div>
                            <div class="text-purple-500">
                                <i class="fas fa-eye text-3xl group-hover:scale-125 transition-transform duration-300"></i>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="border-t-2 border-gray-200 pt-8 mt-8">
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('interns.index') }}"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-arrow-left"></i>
                    <span class="font-semibold">Kembali</span>
                </a>

                @if ((auth()->user()->role === 'hc' || auth()->user()->role === 'admin') && $intern->status === 'pending')
                    <form action="{{ route('interns.updateStatus', $intern->id) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="status" value="approved">
                        <button type="submit"
                            class="group bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                            <i class="fas fa-check-circle group-hover:scale-110 transition-transform"></i>
                            <span class="font-semibold">Approve & Hubungi via WhatsApp</span>
                        </button>
                    </form>
                    <button type="button" onclick="openRejectModal()"
                        class="group bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-times-circle group-hover:scale-110 transition-transform"></i>
                        <span class="font-semibold">Tolak Lamaran</span>
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Alasan Penolakan -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
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
