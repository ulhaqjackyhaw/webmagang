@extends('layouts.sidebar')

@section('title', 'Monitoring Approval Magang')
@section('page-title', 'Monitoring Approval')

@section('content')
    <!-- Header Section with Modern Design -->
    <div class="mb-8 fade-in">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-heading mb-2">
                    Monitoring Approval Magang
                </h1>
                <p class="text-gray-500 text-lg font-light flex items-center gap-2">
                    <span class="w-1 h-4 rounded-full" style="background-color: #20B2AA;"></span>
                    Pantau proses approval peserta magang
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('accepted-interns.create') }}"
                    class="group relative overflow-hidden text-white px-6 py-3 rounded-xl font-medium smooth-transition flex items-center gap-2 shadow-lg hover:shadow-xl"
                    style="background: linear-gradient(to right, #20B2AA, #1a8f89); box-shadow: 0 10px 15px -3px rgba(32, 178, 170, 0.3);"
                    onmouseover="this.style.background='linear-gradient(to right, #1a8f89, #157a74)'; this.style.boxShadow='0 20px 25px -5px rgba(32, 178, 170, 0.4)';"
                    onmouseout="this.style.background='linear-gradient(to right, #20B2AA, #1a8f89)'; this.style.boxShadow='0 10px 15px -3px rgba(32, 178, 170, 0.3)';">
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
            <div class="rounded-lg shadow-lg p-6 text-white mb-4"
                style="background: linear-gradient(to right, #20B2AA, #1a8f89);">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold">Jumlah Peserta yang Lolos Apply</h2>
                        <p class="text-white text-opacity-90">Data keseluruhan peserta yang sudah lolos apply</p>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-full px-8 py-4">
                        <p class="text-5xl font-bold">{{ $totalInterns }}</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Filter Section -->
        <div class="mb-6">
            <form method="GET" action="{{ route('accepted-interns.index') }}"
                class="bg-white rounded-xl shadow-md p-6 mb-4">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <!-- Unit Magang Filter -->
                    <div>
                        <label for="unit" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-building mr-1" style="color: #20B2AA;"></i> Unit Magang
                        </label>
                        <select name="unit" id="unit"
                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:border-transparent transition-all duration-300"
                            onfocus="this.style.borderColor='#20B2AA'; this.style.boxShadow='0 0 0 3px rgba(32, 178, 170, 0.1)';"
                            onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                            <option value="">Semua Unit</option>
                            @foreach ($unitStats as $stat)
                                <option value="{{ $stat->unit_magang }}"
                                    {{ $selectedUnit == $stat->unit_magang ? 'selected' : '' }}>
                                    {{ $stat->unit_magang }} ({{ $stat->total }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Periode Filter -->
                    <div>
                        <label for="periode" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt mr-1" style="color: #20B2AA;"></i> Periode Pendaftaran Magang
                        </label>
                        <select name="periode" id="periode"
                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:border-transparent transition-all duration-300"
                            onfocus="this.style.borderColor='#20B2AA'; this.style.boxShadow='0 0 0 3px rgba(32, 178, 170, 0.1)';"
                            onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                            <option value="">Semua Periode</option>
                            @foreach ($availablePeriodes as $periode)
                                <option value="{{ $periode }}" {{ $selectedPeriode == $periode ? 'selected' : '' }}>
                                    {{ $periode }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-tasks mr-1" style="color: #20B2AA;"></i> Status Approval
                        </label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:border-transparent transition-all duration-300"
                            onfocus="this.style.borderColor='#20B2AA'; this.style.boxShadow='0 0 0 3px rgba(32, 178, 170, 0.1)';"
                            onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                            <option value="">Semua Status</option>
                            <option value="doc_unread" {{ ($selectedStatus ?? '') == 'doc_unread' ? 'selected' : '' }}>
                                Dokumen Belum Dibaca</option>
                            <option value="doc_read" {{ ($selectedStatus ?? '') == 'doc_read' ? 'selected' : '' }}>Dokumen
                                Telah Dibaca</option>
                            <option value="sent_to_divhead"
                                {{ ($selectedStatus ?? '') == 'sent_to_divhead' ? 'selected' : '' }}>Terkirim ke Div Head
                            </option>
                            <option value="approved_divhead"
                                {{ ($selectedStatus ?? '') == 'approved_divhead' ? 'selected' : '' }}>Disetujui Div Head
                            </option>
                            <option value="sent_to_deputy"
                                {{ ($selectedStatus ?? '') == 'sent_to_deputy' ? 'selected' : '' }}>Terkirim ke Deputy
                            </option>
                            <option value="approved_deputy"
                                {{ ($selectedStatus ?? '') == 'approved_deputy' ? 'selected' : '' }}>Disetujui Deputy
                                (Final)
                            </option>
                            <option value="rejected" {{ ($selectedStatus ?? '') == 'rejected' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>

                    <!-- Per Page Filter -->
                    <div>
                        <label for="per_page" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-list-ol mr-1" style="color: #20B2AA;"></i> Tampilkan Per Halaman
                        </label>
                        <select name="per_page" id="per_page"
                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:border-transparent transition-all duration-300"
                            onfocus="this.style.borderColor='#20B2AA'; this.style.boxShadow='0 0 0 3px rgba(32, 178, 170, 0.1)';"
                            onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                            <option value="10" {{ ($perPage ?? 10) == 10 ? 'selected' : '' }}>10 data</option>
                            <option value="50" {{ ($perPage ?? 10) == 50 ? 'selected' : '' }}>50 data</option>
                            <option value="100" {{ ($perPage ?? 10) == 100 ? 'selected' : '' }}>100 data</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-end gap-2">
                        <button type="submit"
                            class="flex-1 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-200"
                            style="background-color: #20B2AA;" onmouseover="this.style.backgroundColor='#1a8f89';"
                            onmouseout="this.style.backgroundColor='#20B2AA';">
                            <i class="fas fa-filter mr-1"></i> Terapkan
                        </button>
                        @if ($selectedUnit || $selectedPeriode || ($selectedStatus ?? null) || ($perPage ?? 10) != 10)
                            <a href="{{ route('accepted-interns.index') }}"
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
                    class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all duration-300"
                    onfocus="this.style.borderColor='#20B2AA'; this.style.boxShadow='0 0 0 3px rgba(32, 178, 170, 0.1)';"
                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';"
                    placeholder="Cari nama, NIM, kampus, unit magang, atau periode...">
            </div>
        </div>

        <!-- Bulk Action Bar -->
        <div id="bulkActionBar"
            class="hidden mb-4 bg-gradient-to-r from-cyan-50 to-teal-50 border border-cyan-200 rounded-xl p-4">
            <div class="flex items-center justify-between flex-wrap gap-3">
                <div class="flex items-center gap-3">
                    <span class="font-semibold" style="color: #20B2AA;">
                        <i class="fas fa-check-square mr-2"></i>
                        <span id="selectedCount">0</span> data terpilih
                    </span>
                    <span id="selectedStatusInfo" class="text-sm text-gray-500"></span>
                </div>
                <div class="flex gap-2 flex-wrap">
                    <button type="button" onclick="clearSelection()"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg text-sm font-medium transition">
                        <i class="fas fa-times mr-1"></i> Batal
                    </button>
                    <button type="button" id="btnBulkForward" onclick="openBulkForwardModal()"
                        class="hidden px-4 py-2 text-white rounded-lg text-sm font-medium transition shadow-lg"
                        style="background-color: #20B2AA;" onmouseover="this.style.backgroundColor='#1a8f89';"
                        onmouseout="this.style.backgroundColor='#20B2AA';">
                        <i class="fas fa-paper-plane mr-1"></i> Forward ke Div Head
                    </button>
                    <button type="button" onclick="openBulkDeleteModal()"
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition shadow-lg shadow-red-500/30">
                        <i class="fas fa-trash mr-1"></i> Hapus Terpilih
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Card View -->
    <div class="mobile-card space-y-4">
        @forelse($acceptedInterns as $index => $acceptedIntern)
            <div class="searchable-card bg-white rounded-xl shadow-md p-4"
                data-search="{{ strtolower($acceptedIntern->intern->nama . ' ' . $acceptedIntern->intern->asal_kampus . ' ' . $acceptedIntern->unit_magang) }}">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex-1">
                        <h3 class="font-bold text-gray-900 text-lg">{{ $acceptedIntern->intern->nama }}</h3>
                        <p class="text-gray-500 text-sm">{{ $acceptedIntern->intern->asal_kampus }}</p>
                    </div>
                    <span
                        class="px-3 py-1 text-xs font-semibold rounded-full {{ $acceptedIntern->approval_status_color ?? 'bg-gray-100 text-gray-800' }}">
                        {{ $acceptedIntern->approval_status_label ?? 'Pending' }}
                    </span>
                </div>

                <div class="space-y-2 text-sm border-t border-gray-100 pt-3">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-building text-gray-400 w-4"></i>
                        <span class="text-gray-600 font-medium"
                            style="color: #20B2AA;">{{ $acceptedIntern->unit_magang }}</span>
                    </div>
                </div>

                <div class="flex flex-wrap gap-2 mt-4 pt-3 border-t border-gray-100">
                    @if ($acceptedIntern->approval_status === 'rejected')
                        {{-- Rejected: Show WhatsApp rejection and Delete buttons --}}
                        @if (!$acceptedIntern->rejection_wa_sent)
                            @php
                                $phoneWaReject = preg_replace('/[^0-9]/', '', $acceptedIntern->intern->no_wa ?? '');
                                if (str_starts_with($phoneWaReject, '0')) {
                                    $phoneWaReject = '62' . substr($phoneWaReject, 1);
                                }
                                $rejectionSource = $acceptedIntern->rejection_source ?? 'Tim';
                                $messageWaReject =
                                    'Halo ' .
                                    $acceptedIntern->intern->nama .
                                    ", perkenalkan saya PIC Magang Unit Learning Management Kantor Regional I.\n\nMohon maaf, setelah melalui proses seleksi, pengajuan magang kamu tidak dapat kami terima dengan alasan:\n\n\"" .
                                    ($acceptedIntern->rejection_reason ?? 'Tidak memenuhi kriteria') .
                                    "\"\n\nDitolak oleh: " .
                                    $rejectionSource .
                                    "\n\nTerima kasih atas minat dan partisipasinya.\n-Admin Pemagangan Kantor Regional I (URSHIPORTS)";
                            @endphp
                            <a href="https://wa.me/{{ $phoneWaReject }}?text={{ urlencode($messageWaReject) }}"
                                target="_blank" onclick="markRejectionWaSent({{ $acceptedIntern->id }})"
                                class="flex-1 text-center text-white hover:opacity-90 px-3 py-2 rounded-lg text-sm font-medium transition-colors bg-green-500">
                                <i class="fab fa-whatsapp mr-1"></i> WA Penolakan
                            </a>
                        @endif
                        <button type="button" onclick="openDeleteModal({{ $acceptedIntern->id }})"
                            class="flex-1 text-center bg-red-500 text-white hover:bg-red-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    @elseif ($acceptedIntern->approval_status === 'pending')
                        {{-- Pending: Only show view (to verify docs) and delete --}}
                        <a href="{{ route('accepted-interns.show', $acceptedIntern->id) }}"
                            class="flex-1 text-center text-white hover:opacity-90 px-3 py-2 rounded-lg text-sm font-medium transition-colors"
                            style="background-color: #20B2AA;">
                            <i class="fas fa-eye mr-1"></i> Lihat & Verifikasi
                        </a>
                        <button type="button" onclick="openDeleteModal({{ $acceptedIntern->id }})"
                            class="flex-1 text-center bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    @else
                        {{-- Other statuses: Show view, edit, delete buttons --}}
                        <a href="{{ route('accepted-interns.show', $acceptedIntern->id) }}"
                            class="flex-1 text-center text-white hover:opacity-90 px-3 py-2 rounded-lg text-sm font-medium transition-colors"
                            style="background-color: #20B2AA;">
                            <i class="fas fa-eye mr-1"></i> Lihat
                        </a>
                        <a href="{{ route('accepted-interns.edit', $acceptedIntern->id) }}"
                            class="flex-1 text-center bg-yellow-50 text-yellow-600 hover:bg-yellow-100 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <button type="button" onclick="openDeleteModal({{ $acceptedIntern->id }})"
                            class="flex-1 text-center bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-md p-8 text-center text-gray-500">
                <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                @if ($selectedUnit)
                    <p>Tidak ada data peserta magang di unit <strong>{{ $selectedUnit }}</strong></p>
                @else
                    <p>Belum ada data peserta magang yang terdaftar</p>
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
                    <i class="fas fa-filter" style="color: #20B2AA;"></i>
                    Data Peserta di Unit: <span style="color: #20B2AA;">{{ $selectedUnit }}</span>
                @else
                    <i class="fas fa-list text-gray-600"></i> Semua Data Peserta Magang
                @endif
            </h3>
        </div>
        <div class="overflow-x-auto" style="max-width: 100%;">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left">
                            <input type="checkbox" id="selectAll" onchange="toggleSelectAll(this)"
                                class="w-4 h-4 text-cyan-600 rounded border-gray-300 focus:ring-cyan-500">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kampus</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit
                            Magang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($acceptedInterns as $index => $acceptedIntern)
                        <tr class="searchable-row hover:bg-gray-50">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <input type="checkbox"
                                    class="row-checkbox w-4 h-4 text-cyan-600 rounded border-gray-300 focus:ring-cyan-500"
                                    value="{{ $acceptedIntern->id }}"
                                    data-status="{{ $acceptedIntern->approval_status }}"
                                    data-documents-verified="{{ $acceptedIntern->documents_verified ? '1' : '0' }}"
                                    onchange="updateBulkSelection()">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $acceptedInterns->firstItem() + $index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $acceptedIntern->intern->nama }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $acceptedIntern->intern->asal_kampus }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $acceptedIntern->unit_magang }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 py-1 text-xs rounded-full {{ $acceptedIntern->approval_status_color ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $acceptedIntern->approval_status_label ?? 'Pending' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                @if ($acceptedIntern->approval_status === 'rejected')
                                    {{-- Rejected: Show WhatsApp rejection and Delete buttons --}}
                                    @if (!$acceptedIntern->rejection_wa_sent)
                                        @php
                                            $phoneWaRejectTable = preg_replace(
                                                '/[^0-9]/',
                                                '',
                                                $acceptedIntern->intern->no_wa ?? '',
                                            );
                                            if (str_starts_with($phoneWaRejectTable, '0')) {
                                                $phoneWaRejectTable = '62' . substr($phoneWaRejectTable, 1);
                                            }
                                            $rejectionSourceTable = $acceptedIntern->rejection_source ?? 'Tim';
                                            $messageWaRejectTable =
                                                'Halo ' .
                                                $acceptedIntern->intern->nama .
                                                ", perkenalkan saya PIC Magang Unit Learning Management Kantor Regional I.\n\nMohon maaf, setelah melalui proses seleksi, pengajuan magang kamu tidak dapat kami terima dengan alasan:\n\n\"" .
                                                ($acceptedIntern->rejection_reason ?? 'Tidak memenuhi kriteria') .
                                                "\"\n\nDitolak oleh: " .
                                                $rejectionSourceTable .
                                                "\n\nTerima kasih atas minat dan partisipasinya.\n-Admin Pemagangan Kantor Regional I (URSHIPORTS)";
                                        @endphp
                                        <a href="https://wa.me/{{ $phoneWaRejectTable }}?text={{ urlencode($messageWaRejectTable) }}"
                                            target="_blank" onclick="markRejectionWaSent({{ $acceptedIntern->id }})"
                                            class="text-green-500 hover:text-green-700" title="Kirim WA Penolakan">
                                            <i class="fab fa-whatsapp text-lg"></i>
                                        </a>
                                    @endif
                                    <button type="button" onclick="openDeleteModal({{ $acceptedIntern->id }})"
                                        class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @elseif ($acceptedIntern->approval_status === 'pending')
                                    {{-- Pending: Only show eye (to verify docs) and delete --}}
                                    <a href="{{ route('accepted-interns.show', $acceptedIntern->id) }}"
                                        class="hover:opacity-80 transition-opacity" style="color: #20B2AA;"
                                        title="Lihat & Verifikasi Dokumen">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" onclick="openDeleteModal({{ $acceptedIntern->id }})"
                                        class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                @else
                                    {{-- Other status: Show view, edit, delete buttons --}}
                                    <a href="{{ route('accepted-interns.show', $acceptedIntern->id) }}"
                                        class="hover:opacity-80 transition-opacity" style="color: #20B2AA;"
                                        title="Lihat Detail">
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
                                @endif
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

        <!-- Pagination -->
        @if ($acceptedInterns->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $acceptedInterns->firstItem() ?? 0 }} - {{ $acceptedInterns->lastItem() ?? 0 }}
                        dari {{ $acceptedInterns->total() }} data
                    </div>
                    <div>
                        {{ $acceptedInterns->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
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

    <!-- Modal Konfirmasi Bulk Delete -->
    <div id="bulkDeleteModal"
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
                <h3 class="text-2xl font-bold text-gray-800 text-center mb-2">Konfirmasi Hapus Massal</h3>
                <p class="text-gray-600 text-center mb-6">
                    Apakah Anda yakin ingin menghapus <span id="bulkSelectedCount" class="font-bold text-red-600">0</span>
                    data yang dipilih? <br>
                    <span class="text-red-600 font-semibold">Tindakan ini tidak dapat dibatalkan!</span>
                </p>

                <!-- Form Hidden -->
                <form id="bulkDeleteForm" method="POST" action="{{ route('accepted-interns.bulkDelete') }}">
                    @csrf
                    @method('DELETE')
                    <div id="bulkDeleteIds"></div>
                </form>

                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <button type="button" onclick="closeBulkDeleteModal()"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-xl font-semibold transition-all duration-200">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="button" onclick="confirmBulkDelete()"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200">
                        <i class="fas fa-trash mr-2"></i>Hapus Semua
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Bulk Forward to Div Head -->
    <div id="bulkForwardModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <!-- Icon -->
                <div class="flex justify-center mb-4">
                    <div class="w-20 h-20 rounded-full flex items-center justify-center"
                        style="background-color: rgba(32, 178, 170, 0.1);">
                        <i class="fas fa-paper-plane text-4xl" style="color: #20B2AA;"></i>
                    </div>
                </div>

                <!-- Title & Message -->
                <h3 class="text-2xl font-bold text-gray-800 text-center mb-2">Forward ke Div Head</h3>
                <p class="text-gray-600 text-center mb-6">
                    Apakah Anda yakin ingin mengirim <span id="bulkForwardCount" class="font-bold"
                        style="color: #20B2AA;">0</span>
                    data yang dipilih ke Div Head untuk approval?
                </p>

                <!-- Form Hidden -->
                <form id="bulkForwardForm" method="POST" action="{{ route('accepted-interns.bulkForwardToDivHead') }}">
                    @csrf
                    <div id="bulkForwardIds"></div>
                </form>

                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <button type="button" onclick="closeBulkForwardModal()"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-xl font-semibold transition-all duration-200">
                        <i class="fas fa-times mr-2"></i>Batal
                    </button>
                    <button type="button" onclick="confirmBulkForward()"
                        class="flex-1 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200"
                        style="background-color: #20B2AA;" onmouseover="this.style.backgroundColor='#1a8f89';"
                        onmouseout="this.style.backgroundColor='#20B2AA';">
                        <i class="fas fa-paper-plane mr-2"></i>Forward
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
        const searchableCards = document.querySelectorAll('.searchable-card');
        const noResultsRow = document.getElementById('noResultsRow');
        const noResultsCard = document.getElementById('noResultsCard');
        const emptyRow = document.getElementById('emptyRow');

        /**
         * Search/Filter Table Rows and Cards
         */
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

        function markRejectionWaSent(internId) {
            // Send POST request to mark rejection WhatsApp as sent
            fetch(`/accepted-interns/${internId}/mark-rejection-wa-sent`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                // Reload the page after marking as sent to update the UI
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            }).catch(error => {
                console.error('Error marking rejection WA sent:', error);
            });
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

        /**
         * Bulk Selection Functions
         */
        const bulkActionBar = document.getElementById('bulkActionBar');
        const selectedCount = document.getElementById('selectedCount');
        const selectedStatusInfo = document.getElementById('selectedStatusInfo');
        const selectAllCheckbox = document.getElementById('selectAll');
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');
        const bulkDeleteForm = document.getElementById('bulkDeleteForm');
        const bulkDeleteModal = document.getElementById('bulkDeleteModal');
        const bulkSelectedCount = document.getElementById('bulkSelectedCount');
        const btnBulkForward = document.getElementById('btnBulkForward');
        const bulkForwardModal = document.getElementById('bulkForwardModal');
        const bulkForwardCount = document.getElementById('bulkForwardCount');
        const bulkForwardForm = document.getElementById('bulkForwardForm');

        function toggleSelectAll() {
            const isChecked = selectAllCheckbox.checked;
            rowCheckboxes.forEach(checkbox => {
                // Only select visible rows
                const row = checkbox.closest('tr');
                if (row && row.style.display !== 'none') {
                    checkbox.checked = isChecked;
                }
            });
            updateBulkSelection();
        }

        function updateBulkSelection() {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            const count = checkedBoxes.length;

            if (count > 0) {
                bulkActionBar.classList.remove('hidden');
                selectedCount.textContent = count;

                // Check if all selected items are "Dokumen Telah Dibaca" (pending + documents_verified)
                let allDocRead = true;
                let docReadCount = 0;

                checkedBoxes.forEach(cb => {
                    const status = cb.getAttribute('data-status');
                    const docsVerified = cb.getAttribute('data-documents-verified') === '1';

                    if (status === 'pending' && docsVerified) {
                        docReadCount++;
                    } else {
                        allDocRead = false;
                    }
                });

                // Show Forward button when at least one doc_read item is selected
                if (docReadCount > 0 && allDocRead) {
                    btnBulkForward.classList.remove('hidden');
                    selectedStatusInfo.textContent = '(Semua: Dokumen Telah Dibaca)';
                } else if (docReadCount > 0) {
                    btnBulkForward.classList.add('hidden');
                    selectedStatusInfo.textContent = '(Campuran status - tidak bisa forward)';
                } else {
                    btnBulkForward.classList.add('hidden');
                    selectedStatusInfo.textContent = '';
                }
            } else {
                bulkActionBar.classList.add('hidden');
                btnBulkForward.classList.add('hidden');
                selectedStatusInfo.textContent = '';
            }

            // Update selectAll checkbox state
            const visibleCheckboxes = Array.from(rowCheckboxes).filter(cb => {
                const row = cb.closest('tr');
                return row && row.style.display !== 'none';
            });

            if (visibleCheckboxes.length > 0 && checkedBoxes.length === visibleCheckboxes.length) {
                selectAllCheckbox.checked = true;
                selectAllCheckbox.indeterminate = false;
            } else if (checkedBoxes.length > 0) {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = true;
            } else {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = false;
            }
        }

        function clearSelection() {
            rowCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            selectAllCheckbox.checked = false;
            selectAllCheckbox.indeterminate = false;
            bulkActionBar.classList.add('hidden');
            btnBulkForward.classList.add('hidden');
            selectedStatusInfo.textContent = '';
        }

        function openBulkDeleteModal() {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            if (checkedBoxes.length === 0) return;

            bulkSelectedCount.textContent = checkedBoxes.length;
            bulkDeleteModal.classList.remove('hidden');
        }

        function closeBulkDeleteModal() {
            bulkDeleteModal.classList.add('hidden');
        }

        function confirmBulkDelete() {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            const ids = Array.from(checkedBoxes).map(cb => cb.value);

            // Create hidden inputs for each selected ID
            const container = document.getElementById('bulkDeleteIds');
            container.innerHTML = '';
            ids.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                container.appendChild(input);
            });

            bulkDeleteForm.submit();
        }

        /**
         * Bulk Forward to Div Head Functions
         */
        function openBulkForwardModal() {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            // Filter only doc_read items
            const docReadIds = Array.from(checkedBoxes).filter(cb => {
                const status = cb.getAttribute('data-status');
                const docsVerified = cb.getAttribute('data-documents-verified') === '1';
                return status === 'pending' && docsVerified;
            });

            if (docReadIds.length === 0) return;

            bulkForwardCount.textContent = docReadIds.length;
            bulkForwardModal.classList.remove('hidden');
        }

        function closeBulkForwardModal() {
            bulkForwardModal.classList.add('hidden');
        }

        function confirmBulkForward() {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            // Filter only doc_read items
            const ids = Array.from(checkedBoxes).filter(cb => {
                const status = cb.getAttribute('data-status');
                const docsVerified = cb.getAttribute('data-documents-verified') === '1';
                return status === 'pending' && docsVerified;
            }).map(cb => cb.value);

            // Create hidden inputs for each selected ID
            const container = document.getElementById('bulkForwardIds');
            container.innerHTML = '';
            ids.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                container.appendChild(input);
            });

            bulkForwardForm.submit();
        }

        // Close modals with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeBulkDeleteModal();
                closeBulkForwardModal();
            }
        });

        // Close bulk delete modal when clicking outside
        if (bulkDeleteModal) {
            bulkDeleteModal.addEventListener('click', function(e) {
                if (e.target === bulkDeleteModal) {
                    closeBulkDeleteModal();
                }
            });
        }

        // Close bulk forward modal when clicking outside
        if (bulkForwardModal) {
            bulkForwardModal.addEventListener('click', function(e) {
                if (e.target === bulkForwardModal) {
                    closeBulkForwardModal();
                }
            });
        }
    </script>
@endsection
