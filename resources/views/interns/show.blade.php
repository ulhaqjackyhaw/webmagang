@extends('layouts.app')

@section('title', 'Detail Data Magang')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Detail Data Magang</h1>
        <p class="text-gray-600">Informasi lengkap anak magang</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
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

        <div class="border-t pt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Dokumen Lampiran</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @if ($intern->file_proposal)
                    <div class="border rounded-lg p-4 hover:shadow-md transition cursor-pointer"
                        onclick="openPreview('{{ asset('storage/' . $intern->file_proposal) }}', 'Proposal')">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-gray-600 text-sm">Proposal</p>
                                <p class="text-gray-900 font-semibold text-xs truncate">
                                    {{ basename($intern->file_proposal) }}</p>
                            </div>
                            <div class="text-blue-500">
                                <i class="fas fa-eye text-2xl"></i>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($intern->file_cv)
                    <div class="border rounded-lg p-4 hover:shadow-md transition cursor-pointer"
                        onclick="openPreview('{{ asset('storage/' . $intern->file_cv) }}', 'CV')">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-gray-600 text-sm">CV</p>
                                <p class="text-gray-900 font-semibold text-xs truncate">{{ basename($intern->file_cv) }}
                                </p>
                            </div>
                            <div class="text-blue-500">
                                <i class="fas fa-eye text-2xl"></i>
                            </div>
                        </div>
                    </div>
                @endif

                @if ($intern->file_surat)
                    <div class="border rounded-lg p-4 hover:shadow-md transition cursor-pointer"
                        onclick="openPreview('{{ asset('storage/' . $intern->file_surat) }}', 'Surat Magang')">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <p class="text-gray-600 text-sm">Surat Magang</p>
                                <p class="text-gray-900 font-semibold text-xs truncate">{{ basename($intern->file_surat) }}
                                </p>
                            </div>
                            <div class="text-blue-500">
                                <i class="fas fa-eye text-2xl"></i>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="border-t pt-6 mt-6">
            <div class="flex space-x-4">
                <a href="{{ route('interns.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                @if ((auth()->user()->role === 'hc' || auth()->user()->role === 'admin') && $intern->status === 'pending')
                    <form action="{{ route('interns.updateStatus', $intern->id) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
                            <i class="fas fa-check-circle"></i> Approve & Hubungi via WhatsApp
                        </button>
                    </form>
                    <button type="button" onclick="openRejectModal()"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">
                        <i class="fas fa-times-circle"></i> Tolak
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
    <div id="previewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg w-full max-w-6xl h-5/6 flex flex-col">
            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-xl font-bold text-gray-800" id="modalTitle">Preview Dokumen</h3>
                <div class="flex space-x-2">
                    <a id="downloadBtn" href="#" download
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                        <i class="fas fa-download"></i> Download
                    </a>
                    <button onclick="closePreview()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        <i class="fas fa-times"></i> Tutup
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
