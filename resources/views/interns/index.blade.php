@extends('layouts.app')

@section('title', 'Data Magang')

@section('content')
    <div class="mb-8 fade-in">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-heading mb-2">
                    Data Pengajuan Magang
                </h1>
                <p class="text-gray-500 text-lg font-light flex items-center gap-2">
                    <span class="w-1 h-4 bg-cyan-500 rounded-full"></span>
                    Kelola dan monitor semua pengajuan magang
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                @if (auth()->user()->role === 'tu')
                    <a href="{{ route('interns.create') }}"
                        class="group relative overflow-hidden bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-6 py-3 rounded-xl font-medium smooth-transition flex items-center gap-2 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40">
                        <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                        <i class="fas fa-plus text-sm group-hover:rotate-90 smooth-transition"></i>
                        <span>Tambah Data</span>
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
                                    <i
                                        class="fas fa-list text-blue-500 mr-3 group-hover:scale-110 transition-transform"></i>
                                    <span class="font-medium">Semua Data</span>
                                </a>
                                <a href="{{ route('interns.export') }}?status=pending"
                                    class="group flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-yellow-50 transition-all duration-200">
                                    <i
                                        class="fas fa-clock text-yellow-500 mr-3 group-hover:scale-110 transition-transform"></i>
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

        <!-- Filter Section -->
        <div class="mb-6">
            <form method="GET" action="{{ route('interns.index') }}" class="bg-white rounded-xl shadow-md p-6 mb-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Year Filter -->
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt text-indigo-500 mr-1"></i> Tahun
                        </label>
                        <select name="year" id="year"
                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300">
                            <option value="">Semua Tahun</option>
                            @foreach ($availableYears as $year)
                                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Month Filter -->
                    <div>
                        <label for="month" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar text-indigo-500 mr-1"></i> Bulan
                        </label>
                        <select name="month" id="month"
                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300">
                            <option value="">Semua Bulan</option>
                            <option value="1" {{ $selectedMonth == 1 ? 'selected' : '' }}>Januari</option>
                            <option value="2" {{ $selectedMonth == 2 ? 'selected' : '' }}>Februari</option>
                            <option value="3" {{ $selectedMonth == 3 ? 'selected' : '' }}>Maret</option>
                            <option value="4" {{ $selectedMonth == 4 ? 'selected' : '' }}>April</option>
                            <option value="5" {{ $selectedMonth == 5 ? 'selected' : '' }}>Mei</option>
                            <option value="6" {{ $selectedMonth == 6 ? 'selected' : '' }}>Juni</option>
                            <option value="7" {{ $selectedMonth == 7 ? 'selected' : '' }}>Juli</option>
                            <option value="8" {{ $selectedMonth == 8 ? 'selected' : '' }}>Agustus</option>
                            <option value="9" {{ $selectedMonth == 9 ? 'selected' : '' }}>September</option>
                            <option value="10" {{ $selectedMonth == 10 ? 'selected' : '' }}>Oktober</option>
                            <option value="11" {{ $selectedMonth == 11 ? 'selected' : '' }}>November</option>
                            <option value="12" {{ $selectedMonth == 12 ? 'selected' : '' }}>Desember</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-end gap-2">
                        <button type="submit"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-200">
                            <i class="fas fa-filter mr-1"></i> Terapkan
                        </button>
                        @if ($selectedYear || $selectedMonth)
                            <a href="{{ route('interns.index') }}"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold transition-all duration-200">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Search Box -->
        <div class="mb-6">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="searchInput"
                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300"
                    placeholder="Cari nama, NIM, kampus, program studi, atau nomor WA...">
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kampus
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Program
                                Studi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No WA
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($interns as $index => $intern)
                            <tr class="searchable-row">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $intern->nama }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $intern->nim }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $intern->asal_kampus }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $intern->program_studi }}
                                </td>
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
                                        <button type="button" onclick="openDeleteModal({{ $intern->id }})"
                                            class="text-red-600 hover:text-red-900" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
                            <tr id="emptyRow">
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada data magang
                                </td>
                            </tr>
                        @endforelse
                        <!-- No Results Row (hidden by default) -->
                        <tr id="noResultsRow" class="hidden">
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                <i class="fas fa-search text-gray-400 text-3xl mb-2"></i>
                                <p class="font-semibold">Tidak ada data yang cocok dengan pencarian Anda</p>
                                <p class="text-sm">Coba gunakan kata kunci yang berbeda</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal Alasan Penolakan -->
        <div id="rejectModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
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

        <!-- Modal Konfirmasi Hapus -->
        <div id="deleteModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl w-full max-w-md transform transition-all">
                <div class="p-6">
                    <!-- Icon Warning -->
                    <div class="flex justify-center mb-4">
                        <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-600 text-4xl"></i>
                        </div>
                    </div>

                    <!-- Title & Message -->
                    <h3 class="text-2xl font-bold text-gray-800 text-center mb-2">Konfirmasi Hapus</h3>
                    <p class="text-gray-600 text-center mb-6">
                        Apakah Anda yakin ingin menghapus data ini? <br>
                        <span class="text-red-600 font-semibold">Tindakan ini tidak dapat dibatalkan!</span>
                    </p>

                    <!-- Form Hidden -->
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                    </form>

                    <!-- Action Buttons -->
                    <div class="flex gap-3">
                        <button type="button" onclick="closeDeleteModal()"
                            class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-xl font-semibold transition-all duration-200">
                            <i class="fas fa-times mr-2"></i>Batal
                        </button>
                        <button type="button" onclick="confirmDelete()"
                            class="flex-1 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200">
                            <i class="fas fa-trash mr-2"></i>Hapus
                        </button>
                    </div>
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
            const deleteModal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            const searchInput = document.getElementById('searchInput');
            const searchableRows = document.querySelectorAll('.searchable-row');
            const noResultsRow = document.getElementById('noResultsRow');
            const emptyRow = document.getElementById('emptyRow');

            /**
             * Search/Filter Table Rows
             */
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase().trim();
                    let visibleCount = 0;

                    searchableRows.forEach(function(row) {
                        const text = row.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Show/hide no results message
                    if (searchableRows.length > 0) {
                        if (visibleCount === 0 && searchTerm !== '') {
                            noResultsRow.classList.remove('hidden');
                        } else {
                            noResultsRow.classList.add('hidden');
                        }
                    }
                });
            }

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
                rejectForm.action = `/interns/${internId}/status`;
                rejectReasonText.value = '';
                rejectModal.classList.remove('hidden');
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

            /**
             * Membuka Modal Konfirmasi Hapus
             */
            function openDeleteModal(internId) {
                deleteForm.action = `/interns/${internId}`;
                deleteModal.classList.remove('hidden');
            }

            /**
             * Menutup Modal Konfirmasi Hapus
             */
            function closeDeleteModal() {
                if (deleteModal && !deleteModal.classList.contains('hidden')) {
                    deleteModal.classList.add('hidden');
                }
            }

            /**
             * Konfirmasi dan Submit Delete
             */
            function confirmDelete() {
                deleteForm.submit();
            }

            // --- Global Event Listeners ---

            // Listener untuk klik di luar dropdown
            document.addEventListener('click', function(event) {
                const button = event.target.closest('button[onclick*="toggleDropdown"]');
                if (!button && exportDropdown && !exportDropdown.contains(event.target)) {
                    closeDropdown();
                }
            });

            // Listener untuk klik di luar modal delete
            if (deleteModal) {
                deleteModal.addEventListener('click', function(e) {
                    if (e.target === deleteModal) {
                        closeDeleteModal();
                    }
                });
            }

            // Listener untuk tombol 'Escape'
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeDropdown();
                    closeRejectModal();
                    closeDeleteModal();
                }
            });
        </script>
    @endsection
