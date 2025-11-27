@extends('layouts.app')

@section('title', 'Database Magang Diterima')

@section('content')
    <!-- Header Section with Modern Design -->
    <div class="mb-8 fade-in">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-heading mb-2">
                    Database Peserta Magang
                </h1>
                <p class="text-gray-500 text-lg font-light flex items-center gap-2">
                    <span class="w-1 h-4 bg-blue-500 rounded-full"></span>
                    Data peserta magang yang telah terdaftar
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('accepted-interns.create') }}"
                    class="group relative overflow-hidden bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-6 py-3 rounded-xl font-medium smooth-transition flex items-center gap-2 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40">
                    <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                    <i class="fas fa-plus text-sm group-hover:rotate-90 smooth-transition"></i>
                    <span>Tambah Data</span>
                </a>

                <!-- Export Button -->
                <a href="{{ route('accepted-interns.export', $selectedUnit ? ['unit' => $selectedUnit] : []) }}"
                    class="group relative overflow-hidden bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-3 rounded-xl font-medium smooth-transition flex items-center gap-2 shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40">
                    <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                    <i class="fas fa-file-excel text-sm"></i>
                    <span class="font-semibold">
                        @if ($selectedUnit)
                            Export {{ $selectedUnit }}
                        @else
                            Export Semua Data
                        @endif
                    </span>
                </a>
            </div>
        </div>

        <!-- Statistics Section -->
        <div class="mb-6">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-6 text-white mb-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold">Total Peserta Magang</h2>
                        <p class="text-blue-100">Keseluruhan peserta yang terdaftar</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full px-8 py-4">
                        <p class="text-5xl font-bold">{{ $totalInterns }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-building text-blue-600"></i> Daftar Unit Magang
                    </h3>
                    @if ($selectedUnit)
                        <a href="{{ route('accepted-interns.index') }}"
                            class="text-sm bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">
                            <i class="fas fa-times"></i> Hapus Filter
                        </a>
                    @endif
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                    @forelse($unitStats as $stat)
                        <a href="{{ route('accepted-interns.index', ['unit' => $stat->unit_magang]) }}"
                            class="group border-2 rounded-lg p-4 transition-all hover:shadow-lg cursor-pointer
                            {{ $selectedUnit == $stat->unit_magang ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-blue-300' }}">
                            <div class="flex flex-col items-center text-center">
                                <div
                                    class="w-16 h-16 rounded-full flex items-center justify-center mb-2
                                {{ $selectedUnit == $stat->unit_magang ? 'bg-blue-500' : 'bg-gray-100 group-hover:bg-blue-100' }}">
                                    <i
                                        class="fas fa-users 
                                    {{ $selectedUnit == $stat->unit_magang ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }} 
                                    text-2xl"></i>
                                </div>
                                <h4 class="font-semibold text-gray-800 mb-1 line-clamp-2">{{ $stat->unit_magang }}</h4>
                                <div class="flex items-center">
                                    <span
                                        class="text-2xl font-bold 
                                    {{ $selectedUnit == $stat->unit_magang ? 'text-blue-600' : 'text-gray-700' }}">
                                        {{ $stat->total }}
                                    </span>
                                    <span class="text-xs text-gray-500 ml-1">peserta</span>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-8">
                            Belum ada data unit magang
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="mb-6">
            <form method="GET" action="{{ route('accepted-interns.index') }}"
                class="bg-white rounded-xl shadow-md p-6 mb-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Year Filter -->
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt text-blue-500 mr-1"></i> Tahun
                        </label>
                        <select name="year" id="year"
                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
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
                            <i class="fas fa-calendar text-blue-500 mr-1"></i> Bulan
                        </label>
                        <select name="month" id="month"
                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300">
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
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-200">
                            <i class="fas fa-filter mr-1"></i> Terapkan
                        </button>
                        @if ($selectedYear || $selectedMonth)
                            <a href="{{ route('accepted-interns.index', $selectedUnit ? ['unit' => $selectedUnit] : []) }}"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold transition-all duration-200">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>
                @if ($selectedUnit)
                    <input type="hidden" name="unit" value="{{ $selectedUnit }}">
                @endif
            </form>
        </div>

        <!-- Search Box -->
        <div class="mb-6">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="searchInput"
                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300"
                    placeholder="Cari nama, NIM, kampus, unit magang, atau periode...">
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-800">
                    @if ($selectedUnit)
                        <i class="fas fa-filter text-blue-600"></i>
                        Data Peserta di Unit: <span class="text-blue-600">{{ $selectedUnit }}</span>
                    @else
                        <i class="fas fa-list text-gray-600"></i> Semua Data Peserta Magang
                    @endif
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit
                                Magang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Periode
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($acceptedInterns as $index => $acceptedIntern)
                            <tr class="searchable-row">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $acceptedIntern->intern->nama }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $acceptedIntern->intern->nim }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $acceptedIntern->intern->asal_kampus }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $acceptedIntern->unit_magang }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $acceptedIntern->periode_awal->format('d/m/Y') }} -
                                    {{ $acceptedIntern->periode_akhir->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('accepted-interns.show', $acceptedIntern->id) }}"
                                        class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('accepted-interns.edit', $acceptedIntern->id) }}"
                                        class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" onclick="openDeleteModal({{ $acceptedIntern->id }})"
                                        class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    @if ($selectedUnit)
                                        Tidak ada data peserta magang di unit <strong>{{ $selectedUnit }}</strong>
                                    @else
                                        Belum ada data peserta magang yang terdaftar
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                        <!-- No Results Row (hidden by default) -->
                        <tr id="noResultsRow" class="hidden">
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                <i class="fas fa-search text-gray-400 text-3xl mb-2"></i>
                                <p class="font-semibold">Tidak ada data yang cocok dengan pencarian Anda</p>
                                <p class="text-sm">Coba gunakan kata kunci yang berbeda</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
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

        <script>
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

            function openDeleteModal(internId) {
                deleteForm.action = `/accepted-interns/${internId}`;
                deleteModal.classList.remove('hidden');
            }

            function closeDeleteModal() {
                deleteModal.classList.add('hidden');
            }

            function confirmDelete() {
                deleteForm.submit();
            }

            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeDeleteModal();
                }
            });

            // Close modal when clicking outside
            deleteModal.addEventListener('click', function(e) {
                if (e.target === deleteModal) {
                    closeDeleteModal();
                }
            });
        </script>
    @endsection
