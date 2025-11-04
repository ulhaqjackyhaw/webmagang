@extends('layouts.app')

@section('title', 'Data Magang')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
        <div>
            <h1 class="text-4xl font-bold text-indigo-600 flex items-center">
                <i class="fas fa-users mr-3"></i>
                Data Pengajuan Magang
            </h1>
            <p class="text-gray-600 mt-2 flex items-center">
                <i class="fas fa-tasks mr-2 text-indigo-500"></i>
                Kelola data pengajuan magang
            </p>
        </div>
        <div class="flex space-x-3">
            @if (auth()->user()->role === 'tu')
                <a href="{{ route('interns.create') }}"
                    class="group bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-plus-circle group-hover:rotate-90 transition-transform duration-300"></i>
                    <span class="font-semibold">Tambah Data</span>
                </a>
            @endif

            @if (auth()->user()->role === 'hc' || auth()->user()->role === 'admin')
                <div class="relative inline-block text-left">
                    <button onclick="toggleDropdown(event)" type="button"
                        class="group bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2 cursor-pointer pointer-events-auto"
                        style="position: relative; z-index: 100;">
                        <i class="fas fa-file-excel group-hover:scale-110 transition-transform"></i>
                        <span class="font-semibold">Export</span>
                        <i class="fas fa-chevron-down ml-1"></i>
                    </button>
                    <div id="exportDropdown"
                        class="hidden absolute right-0 mt-2 w-64 rounded-xl shadow-2xl bg-white ring-1 ring-gray-200 overflow-hidden pointer-events-none"
                        style="z-index: 200;">
                        <div class="py-2 pointer-events-auto">
                            <a href="{{ route('interns.export') }}?status=all"
                                class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 transition-all duration-200">
                                <i class="fas fa-list text-blue-500 mr-3 group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium">Semua Data</span>
                            </a>
                            <a href="{{ route('interns.export') }}?status=pending"
                                class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-yellow-50 transition-all duration-200">
                                <i class="fas fa-clock text-yellow-500 mr-3 group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium">Menunggu Persetujuan</span>
                            </a>
                            <a href="{{ route('interns.export') }}?status=approved"
                                class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-all duration-200">
                                <i
                                    class="fas fa-check-circle text-green-500 mr-3 group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium">Diterima</span>
                            </a>
                            <a href="{{ route('interns.export') }}?status=rejected"
                                class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-red-50 transition-all duration-200">
                                <i
                                    class="fas fa-times-circle text-red-500 mr-3 group-hover:scale-110 transition-transform"></i>
                                <span class="font-medium">Ditolak</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kampus
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Program
                            Studi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No WA
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($interns as $index => $intern)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $intern->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $intern->nim }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $intern->asal_kampus }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $intern->program_studi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $intern->no_wa }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($intern->status === 'pending')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu
                                    </span>
                                @elseif($intern->status === 'approved')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Diterima
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('interns.show', $intern->id) }}"
                                    class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                @if (auth()->user()->role === 'tu' && $intern->created_by === auth()->id())
                                    <a href="{{ route('interns.edit', $intern->id) }}"
                                        class="text-green-600 hover:text-green-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('interns.destroy', $intern->id) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif

                                @if ((auth()->user()->role === 'hc' || auth()->user()->role === 'admin') && $intern->status === 'pending')
                                    <form action="{{ route('interns.updateStatus', $intern->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit" class="text-green-600 hover:text-green-900"
                                            title="Approve & Kirim WA">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                    </form>
                                    <button type="button" onclick="openRejectModal({{ $intern->id }})"
                                        class="text-red-600 hover:text-red-900" title="Tolak">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                Belum ada data magang
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="rejectModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg w-full max-w-md">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Alasan Penolakan</h3>
                <form id="rejectForm" method="POST" action="">
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

    {{-- 
        ================================================================
        REFAKTOR JAVASCRIPT DIMULAI DARI SINI
        ================================================================
    --}}
    <script>
        // --- Dropdown Logic ---
        const exportDropdown = document.getElementById('exportDropdown');
        const rejectModal = document.getElementById('rejectModal');
        const rejectForm = document.getElementById('rejectForm');
        const rejectReasonText = document.getElementById('rejection_reason');

        /**
         * Menutup Export Dropdown
         */
        function closeDropdown() {
            if (exportDropdown && !exportDropdown.classList.contains('hidden')) {
                exportDropdown.classList.add('hidden');
                exportDropdown.classList.add('pointer-events-none');
                exportDropdown.classList.remove('pointer-events-auto');
            }
        }

        /**
         * Membuka/Menutup Export Dropdown
         */
        function toggleDropdown(event) {
            event.stopPropagation();
            const isHidden = exportDropdown.classList.contains('hidden');
            if (isHidden) {
                exportDropdown.classList.remove('hidden');
                exportDropdown.classList.remove('pointer-events-none');
                exportDropdown.classList.add('pointer-events-auto');
            } else {
                closeDropdown();
            }
        }

        // --- Modal Logic ---

        /**
         * Membuka Modal Penolakan
         */
        function openRejectModal(internId) {
            // Set action form secara dinamis
            rejectForm.action = `/interns/${internId}/status`;
            // Kosongkan textarea
            rejectReasonText.value = '';
            // Tampilkan modal
            rejectModal.classList.remove('hidden');
            // Fokus ke textarea
            rejectReasonText.focus();
        }

        /**
         * Menutup Modal Penolakan
         */
        function closeRejectModal() {
            if (rejectModal && !rejectModal.classList.contains('hidden')) {
                rejectModal.classList.add('hidden');
            }
        }

        // --- Global Event Listeners ---

        // Listener untuk klik di luar dropdown
        document.addEventListener('click', function(event) {
            const button = event.target.closest('button[onclick*="toggleDropdown"]');
            // Jika klik BUKAN pada tombol ATAU di dalam area dropdown
            if (!button && exportDropdown && !exportDropdown.contains(event.target)) {
                closeDropdown();
            }
        });

        // Listener untuk tombol 'Escape'
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeDropdown();
                closeRejectModal();
            }
        });
    </script>
@endsection
