@extends('layouts.sidebar')

@section('title', 'Database Magang Final')
@section('page-title', 'Database Magang Final')

@section('content')
    <div class="mb-8 fade-in">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 font-heading mb-2">
                    Database Magang Final
                </h1>
                <p class="text-gray-500 text-lg font-light flex items-center gap-2">
                    <span class="w-1 h-4 rounded-full bg-green-500"></span>
                    Data peserta magang yang sudah disetujui final (Deputy)
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                @if (!in_array(auth()->user()->role, ['div_head', 'deputy']))
                    <!-- Export Button -->
                    <a href="{{ route('database-magang.export', $selectedUnit ? ['unit' => $selectedUnit, 'periode' => $selectedPeriode ?? ''] : ['periode' => $selectedPeriode ?? '']) }}"
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
                @endif
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="mb-6">
        <div class="rounded-lg shadow-lg p-6 text-white mb-4"
            style="background: linear-gradient(to right, #10b981, #059669);">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Total Peserta Magang Final</h2>
                    <p class="text-white text-opacity-90">Peserta yang sudah disetujui Deputy</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full px-8 py-4">
                    <p class="text-5xl font-bold">{{ $totalInterns }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-building text-green-600"></i> Daftar Unit Magang
                </h3>
                @if ($selectedUnit)
                    <a href="{{ route('database-magang.index', $selectedPeriode ? ['periode' => $selectedPeriode] : []) }}"
                        class="text-sm bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">
                        <i class="fas fa-times"></i> Hapus Filter Unit
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                @forelse($unitStats as $stat)
                    <a href="{{ route('database-magang.index', array_merge(['unit' => $stat->unit_magang], $selectedPeriode ? ['periode' => $selectedPeriode] : [])) }}"
                        class="group border-2 rounded-lg p-4 transition-all hover:shadow-lg cursor-pointer {{ $selectedUnit == $stat->unit_magang ? 'border-green-500 bg-green-50' : 'border-gray-200' }}">
                        <div class="flex flex-col items-center text-center">
                            <div
                                class="w-16 h-16 rounded-full flex items-center justify-center mb-2 transition-all {{ $selectedUnit == $stat->unit_magang ? 'bg-green-500' : 'bg-gray-100 group-hover:bg-green-100' }}">
                                <i
                                    class="fas fa-users text-2xl transition-colors {{ $selectedUnit == $stat->unit_magang ? 'text-white' : 'text-gray-500 group-hover:text-green-600' }}"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-1 line-clamp-2">{{ $stat->unit_magang }}</h4>
                            <div class="flex items-center">
                                <span
                                    class="text-2xl font-bold {{ $selectedUnit == $stat->unit_magang ? 'text-green-600' : 'text-gray-700' }}">
                                    {{ $stat->total }}
                                </span>
                                <span class="text-xs text-gray-500 ml-1">peserta</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-8">
                        <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                        <p>Belum ada data peserta magang yang disetujui final</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="mb-6">
        <form method="GET" action="{{ route('database-magang.index') }}" class="bg-white rounded-xl shadow-md p-6 mb-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Periode Filter -->
                <div>
                    <label for="periode" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt mr-1 text-green-600"></i> Periode Magang
                    </label>
                    <select name="periode" id="periode"
                        class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300">
                        <option value="">Semua Periode</option>
                        @foreach ($availablePeriodes as $periode)
                            <option value="{{ $periode }}" {{ $selectedPeriode == $periode ? 'selected' : '' }}>
                                {{ $periode }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-200">
                        <i class="fas fa-filter mr-1"></i> Terapkan
                    </button>
                    @if ($selectedPeriode)
                        <a href="{{ route('database-magang.index', $selectedUnit ? ['unit' => $selectedUnit] : []) }}"
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
                class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all duration-300"
                placeholder="Cari nama, NIM, kampus, unit magang, atau periode...">
        </div>
    </div>

    <!-- Mobile Card View -->
    <div class="mobile-card space-y-4">
        @forelse($acceptedInterns as $index => $acceptedIntern)
            <div class="searchable-card bg-white rounded-xl shadow-md p-4"
                data-search="{{ strtolower($acceptedIntern->intern->nama . ' ' . $acceptedIntern->intern->nim . ' ' . $acceptedIntern->intern->asal_kampus . ' ' . $acceptedIntern->unit_magang . ' ' . ($acceptedIntern->periode_magang ?? '')) }}">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900 text-lg">{{ $acceptedIntern->intern->nama }}</h3>
                        <p class="text-gray-500 text-sm">{{ $acceptedIntern->intern->nim }}</p>
                    </div>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i> Final
                    </span>
                </div>

                <div class="space-y-2 text-sm border-t border-gray-100 pt-3">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-university text-gray-400 w-4"></i>
                        <span class="text-gray-600">{{ $acceptedIntern->intern->asal_kampus }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-building text-gray-400 w-4"></i>
                        <span class="text-gray-600 font-medium text-green-600">{{ $acceptedIntern->unit_magang }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-calendar-alt text-gray-400 w-4"></i>
                        <span class="text-gray-600">{{ $acceptedIntern->periode_magang ?? '-' }}</span>
                    </div>
                    @if ($acceptedIntern->approved_deputy_at)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-double text-gray-400 w-4"></i>
                            <span class="text-gray-600">Disetujui:
                                {{ $acceptedIntern->approved_deputy_at->format('d M Y') }}</span>
                        </div>
                    @endif
                </div>

                <div class="flex flex-wrap gap-2 mt-4 pt-3 border-t border-gray-100">
                    @if (!in_array(auth()->user()->role, ['div_head', 'deputy']))
                        @php
                            $phoneWa = preg_replace('/[^0-9]/', '', $acceptedIntern->intern->no_wa ?? '');
                            if (str_starts_with($phoneWa, '0')) {
                                $phoneWa = '62' . substr($phoneWa, 1);
                            }
                            $messageWa =
                                'Halo ' .
                                $acceptedIntern->intern->nama .
                                ", perkenalkan saya PIC Magang Unit Learning Management Kantor Regional I\n\nSaat ini berkas pengajuan kamu sudah kami terima dan sedang diproses sesuai dengan ketentuan dan kebutuhan perusahaan. Untuk informasinya selanjutnya akan diberitahukan di kesempatan berikutnya.\n\nTerima kasih.\n-Admin Pemagangan Kantor Regional I (URSHIPORTS; Your Internship Programme at Injourney Airports Kantor Regional I)";
                        @endphp
                        <a href="https://wa.me/{{ $phoneWa }}?text={{ urlencode($messageWa) }}" target="_blank"
                            class="flex-1 text-center text-white hover:opacity-90 px-3 py-2 rounded-lg text-sm font-medium transition-colors bg-green-500">
                            <i class="fab fa-whatsapp mr-1"></i> Kirim WA Surat
                        </a>
                    @endif
                    <a href="{{ route('database-magang.show', $acceptedIntern->id) }}"
                        class="flex-1 text-center text-white hover:opacity-90 px-3 py-2 rounded-lg text-sm font-medium transition-colors bg-blue-600">
                        <i class="fas fa-eye mr-1"></i> Detail
                    </a>
                    @if (!in_array(auth()->user()->role, ['div_head', 'deputy']))
                        <a href="{{ route('database-magang.edit', $acceptedIntern->id) }}"
                            class="flex-1 text-center text-white hover:opacity-90 px-3 py-2 rounded-lg text-sm font-medium transition-colors bg-yellow-500">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <button type="button"
                            onclick="showDeleteModal('{{ route('database-magang.destroy', $acceptedIntern->id) }}', '{{ $acceptedIntern->intern->nama }}')"
                            class="flex-1 text-center text-white hover:opacity-90 px-3 py-2 rounded-lg text-sm font-medium transition-colors bg-red-500">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-md p-8 text-center text-gray-500">
                <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                @if ($selectedUnit || $selectedPeriode)
                    <p>Tidak ada data peserta magang dengan filter yang dipilih</p>
                @else
                    <p>Belum ada data peserta magang yang disetujui final</p>
                @endif
            </div>
        @endforelse
        <div id="noResultsCard" class="hidden bg-white rounded-xl shadow-md p-8 text-center text-gray-500">
            <i class="fas fa-search text-gray-300 text-4xl mb-3"></i>
            <p class="font-semibold">Tidak ada data yang cocok</p>
            <p class="text-sm">Coba gunakan kata kunci yang berbeda</p>
        </div>
    </div>

    <!-- Desktop Table View -->
    <div class="desktop-table bg-white rounded-lg shadow">
        <div class="bg-gray-50 px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-800">
                @if ($selectedUnit)
                    <i class="fas fa-filter text-green-600"></i>
                    Data Peserta di Unit: <span class="text-green-600">{{ $selectedUnit }}</span>
                @else
                    <i class="fas fa-database text-green-600"></i> Semua Data Peserta Final
                @endif
                @if ($selectedPeriode)
                    <span class="text-sm font-normal text-gray-500 ml-2">(Periode: {{ $selectedPeriode }})</span>
                @endif
            </h3>
        </div>
        <div class="overflow-x-auto" style="max-width: 100%;">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kampus
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit
                            Magang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                            Disetujui</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($acceptedInterns as $index => $acceptedIntern)
                        <tr class="searchable-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $acceptedIntern->intern->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $acceptedIntern->intern->nim }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $acceptedIntern->intern->asal_kampus }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $acceptedIntern->unit_magang }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $acceptedIntern->periode_magang ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if ($acceptedIntern->approved_deputy_at)
                                    {{ $acceptedIntern->approved_deputy_at->format('d M Y') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-3">
                                    @if (!in_array(auth()->user()->role, ['div_head', 'deputy']))
                                        @php
                                            $phoneWaTable = preg_replace(
                                                '/[^0-9]/',
                                                '',
                                                $acceptedIntern->intern->no_wa ?? '',
                                            );
                                            if (str_starts_with($phoneWaTable, '0')) {
                                                $phoneWaTable = '62' . substr($phoneWaTable, 1);
                                            }
                                            $messageWaTable =
                                                'Halo ' .
                                                $acceptedIntern->intern->nama .
                                                ", perkenalkan saya PIC Magang Unit Learning Management Kantor Regional I\n\nSaat ini berkas pengajuan kamu sudah kami terima dan sedang diproses sesuai dengan ketentuan dan kebutuhan perusahaan. Untuk informasinya selanjutnya akan diberitahukan di kesempatan berikutnya.\n\nTerima kasih.\n-Admin Pemagangan Kantor Regional I (URSHIPORTS; Your Internship Programme at Injourney Airports Kantor Regional I)";
                                        @endphp
                                        <a href="https://wa.me/{{ $phoneWaTable }}?text={{ urlencode($messageWaTable) }}"
                                            target="_blank" class="text-green-500 hover:text-green-700"
                                            title="Kirim WA Surat ke Kampus">
                                            <i class="fab fa-whatsapp text-lg"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('database-magang.show', $acceptedIntern->id) }}"
                                        class="text-blue-600 hover:text-blue-800" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if (!in_array(auth()->user()->role, ['div_head', 'deputy']))
                                        <a href="{{ route('database-magang.edit', $acceptedIntern->id) }}"
                                            class="text-yellow-600 hover:text-yellow-800" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button"
                                            onclick="showDeleteModal('{{ route('database-magang.destroy', $acceptedIntern->id) }}', '{{ $acceptedIntern->intern->nama }}')"
                                            class="text-red-600 hover:text-red-800" title="Hapus Data">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyRow">
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                @if ($selectedUnit || $selectedPeriode)
                                    Tidak ada data peserta magang dengan filter yang dipilih
                                @else
                                    Belum ada data peserta magang yang disetujui final
                                @endif
                            </td>
                        </tr>
                    @endforelse
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
                    <p class="font-semibold text-gray-800 text-lg mb-4" id="deleteInternName"></p>
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
                        <form id="deleteForm" method="POST" class="flex-1">
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
        // Delete Modal Functions
        function showDeleteModal(actionUrl, internName) {
            document.getElementById('deleteForm').action = actionUrl;
            document.getElementById('deleteInternName').textContent = internName;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideDeleteModal();
            }
        });

        const searchInput = document.getElementById('searchInput');
        const searchableRows = document.querySelectorAll('.searchable-row');
        const searchableCards = document.querySelectorAll('.searchable-card');
        const noResultsRow = document.getElementById('noResultsRow');
        const noResultsCard = document.getElementById('noResultsCard');

        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase().trim();
                let visibleRowCount = 0;
                let visibleCardCount = 0;

                searchableRows.forEach(function(row) {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                        visibleRowCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                searchableCards.forEach(function(card) {
                    const text = card.getAttribute('data-search') || card.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        card.style.display = '';
                        visibleCardCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (searchableRows.length > 0) {
                    if (visibleRowCount === 0 && searchTerm !== '') {
                        noResultsRow.classList.remove('hidden');
                    } else {
                        noResultsRow.classList.add('hidden');
                    }
                }

                if (searchableCards.length > 0) {
                    if (visibleCardCount === 0 && searchTerm !== '') {
                        noResultsCard.classList.remove('hidden');
                    } else {
                        noResultsCard.classList.add('hidden');
                    }
                }
            });
        }
    </script>
@endsection
