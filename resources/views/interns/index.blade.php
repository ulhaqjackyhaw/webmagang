@extends('layouts.sidebar')

@section('title', 'Data Magang')
@section('page-title', 'Data Apply Magang')

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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Periode Filter -->
                    <div>
                        <label for="periode" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-calendar-alt text-indigo-500 mr-1"></i> Periode Magang
                        </label>
                        <select name="periode" id="periode"
                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300">
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
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-200">
                            <i class="fas fa-filter mr-1"></i> Terapkan
                        </button>
                        @if ($selectedPeriode)
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

        <!-- Mobile Card View -->
        <div class="mobile-card space-y-4">
            @forelse($interns as $index => $intern)
                <div class="searchable-card bg-white rounded-xl shadow-md p-4"
                    data-search="{{ strtolower($intern->nama . ' ' . $intern->nim . ' ' . $intern->asal_kampus . ' ' . $intern->program_studi . ' ' . $intern->no_wa) }}">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900 text-lg">{{ $intern->nama }}</h3>
                            <p class="text-gray-500 text-sm">{{ $intern->nim }}</p>
                        </div>
                        <div>
                            @if ($intern->status === 'pending')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Menunggu
                                </span>
                            @elseif($intern->status === 'approved')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    Diterima
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-2 text-sm border-t border-gray-100 pt-3">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-university text-gray-400 w-4"></i>
                            <span class="text-gray-600">{{ $intern->asal_kampus }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-graduation-cap text-gray-400 w-4"></i>
                            <span class="text-gray-600">{{ $intern->program_studi }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fab fa-whatsapp text-gray-400 w-4"></i>
                            <span class="text-gray-600">{{ $intern->no_wa }}</span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 mt-4 pt-3 border-t border-gray-100">
                        <a href="{{ route('interns.show', $intern->id) }}"
                            class="flex-1 text-center bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-eye mr-1"></i> Lihat
                        </a>

                        @if (auth()->user()->role === 'hc' || auth()->user()->role === 'admin')
                            <a href="{{ route('interns.edit', $intern->id) }}"
                                class="flex-1 text-center bg-green-50 text-green-600 hover:bg-green-100 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <button type="button" onclick="openDeleteModal({{ $intern->id }})"
                                class="flex-1 text-center bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        @endif

                        @if ((auth()->user()->role === 'hc' || auth()->user()->role === 'admin') && $intern->status === 'pending')
                            <button type="button"
                                onclick="openAcceptModal({{ $intern->id }}, '{{ addslashes($intern->nama) }}', '{{ addslashes($intern->periode_magang ?? 'Belum dipilih') }}')"
                                class="w-full text-center bg-emerald-500 text-white hover:bg-emerald-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors mt-2">
                                <i class="fas fa-check-circle mr-1"></i> Terima Pengajuan
                            </button>
                            <button type="button" onclick="openRejectModal({{ $intern->id }})"
                                class="w-full text-center bg-red-500 text-white hover:bg-red-600 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                <i class="fas fa-times-circle mr-1"></i> Tolak Pengajuan
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-md p-8 text-center text-gray-500">
                    <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                    <p>Belum ada data magang</p>
                </div>
            @endforelse
            <div id="noResultsCard" class="hidden bg-white rounded-xl shadow-md p-8 text-center text-gray-500">
                <i class="fas fa-search text-gray-300 text-4xl mb-3"></i>
                <p class="font-semibold">Tidak ada data yang cocok</p>
                <p class="text-sm">Coba gunakan kata kunci yang berbeda</p>
            </div>
        </div>

        <!-- Desktop Table View -->
        <div class="desktop-table bg-white rounded-2xl shadow-xl">
            <div class="overflow-x-auto" style="max-width: 100%;">
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
                                Kampus</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Program Studi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                                WA</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($interns as $index => $intern)
                            <tr class="searchable-row">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $intern->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $intern->nim }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $intern->asal_kampus }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $intern->program_studi }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $intern->no_wa }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($intern->status === 'pending')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                                    @elseif($intern->status === 'approved')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Diterima</span>
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('interns.show', $intern->id) }}"
                                        class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if (auth()->user()->role === 'hc' || auth()->user()->role === 'admin')
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
                                        <button type="button"
                                            onclick="openAcceptModal({{ $intern->id }}, '{{ addslashes($intern->nama) }}', '{{ addslashes($intern->periode_magang ?? 'Belum dipilih') }}')"
                                            class="text-green-600 hover:text-green-900" title="Terima Pengajuan">
                                            <i class="fas fa-check-circle"></i>
                                        </button>
                                        <button type="button" onclick="openRejectModal({{ $intern->id }})"
                                            class="text-red-600 hover:text-red-900" title="Tolak">
                                            <i class="fas fa-times-circle"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr id="emptyRow">
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">Belum ada data magang</td>
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

        <!-- Modal Terima Pengajuan -->
        <div id="acceptModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl w-full max-w-lg">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Terima Pengajuan Magang</h3>
                            <p class="text-sm text-gray-500" id="acceptInternName"></p>
                        </div>
                    </div>

                    <form id="acceptForm" method="POST" action="" onsubmit="return validateAcceptForm()">
                        @csrf

                        <div class="space-y-4">
                            <!-- Periode Magang (Read-only from registration) -->
                            <div>
                                <label class="block text-gray-700 font-medium mb-2">
                                    <i class="fas fa-calendar-alt text-green-500 mr-1"></i> Periode Magang
                                </label>
                                <div class="px-4 py-3 bg-gray-100 border border-gray-200 rounded-lg text-gray-700 font-medium"
                                    id="accept_periode_display">
                                    <!-- Will be filled by JS -->
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Periode sesuai pilihan saat pendaftaran</p>
                            </div>

                            <div>
                                <label for="accept_unit_select" class="block text-gray-700 font-medium mb-2">
                                    <i class="fas fa-building text-green-500 mr-1"></i> Unit Magang <span
                                        class="text-red-500">*</span>
                                </label>
                                <select id="accept_unit_select" onchange="handleAcceptUnitChange(this)"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                                    required>
                                    <option value="">-- Pilih Unit Magang --</option>
                                    <option value="Communication & Legal Reg I">Communication & Legal Reg I</option>
                                    <option value="Procurement Reg I">Procurement Reg I</option>
                                    <option value="Finance, Asset & Risk Management Reg I">Finance, Asset & Risk Management
                                        Reg I</option>
                                    <option value="Human Capital Solution & Business Support Reg I">Human Capital Solution
                                        & Business Support Reg I</option>
                                    <option value="CSR & GS Reg I">CSR & GS Reg I</option>
                                    <option value="Airport Commercial Development Reg I">Airport Commercial Development Reg
                                        I</option>
                                    <option value="Airport Operation Control Center CGK">Airport Operation Control Center
                                        CGK</option>
                                    <option value="Communication & Legal CGK">Communication & Legal CGK</option>
                                    <option value="Quality & Safety Management System CGK">Quality & Safety Management
                                        System CGK</option>
                                    <option value="Airport Customer Experience CGK">Airport Customer Experience CGK
                                    </option>
                                    <option value="Airside Operation Services CGK">Airside Operation Services CGK</option>
                                    <option value="Airport Rescue & Fire Fighting CGK">Airport Rescue & Fire Fighting CGK
                                    </option>
                                    <option value="Airport Security Services CGK">Airport Security Services CGK</option>
                                    <option value="Landside Operation Services & Support CGK">Landside Operation Services &
                                        Support CGK</option>
                                    <option value="Aero Business CGK">Aero Business CGK</option>
                                    <option value="Non-Aero Business CGK">Non-Aero Business CGK</option>
                                    <option value="Airport Electrical Services CGK">Airport Electrical Services CGK
                                    </option>
                                    <option value="Airport Mechanical Services CGK">Airport Mechanical Services CGK
                                    </option>
                                    <option value="Airport Electronics Services CGK">Airport Electronics Services CGK
                                    </option>
                                    <option value="Airport Technology Services CGK">Airport Technology Services CGK
                                    </option>
                                    <option value="Airside Facility & Support Services CGK">Airside Facility & Support
                                        Services CGK</option>
                                    <option value="Airport Building Facility Services CGK">Airport Building Facility
                                        Services CGK</option>
                                    <option value="Asset Management CGK">Asset Management CGK</option>
                                    <option value="General Services & CSR CGK">General Services & CSR CGK</option>
                                    <option value="Procurement CGK">Procurement CGK</option>
                                    <option value="Terminal 1 CGK">Terminal 1 CGK</option>
                                    <option value="Terminal 2 CGK">Terminal 2 CGK</option>
                                    <option value="Terminal 3 CGK">Terminal 3 CGK</option>
                                    <option value="Airport Operation & Services - BDO">Airport Operation & Services - BDO
                                    </option>
                                    <option value="Airport Technical - BDO">Airport Technical - BDO</option>
                                    <option value="Airport Commercial - BDO">Airport Commercial - BDO</option>
                                    <option value="Bussiness Support - BDO">Bussiness Support - BDO</option>
                                    <option value="other">Lainnya (Tulis Sendiri)</option>
                                </select>
                                <input type="text" name="unit_magang" id="accept_unit_magang"
                                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 mt-2 hidden"
                                    placeholder="Tulis nama unit magang...">
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mt-4">
                            <p class="text-sm text-blue-700">
                                <i class="fas fa-info-circle mr-2"></i>
                                Setelah diterima, data akan masuk ke daftar "Data Anak Magang" untuk diproses lebih lanjut
                                ke Div Head.
                            </p>
                        </div>

                        <div class="flex justify-end space-x-2 mt-6">
                            <button type="button" onclick="closeAcceptModal()"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg transition">
                                Batal
                            </button>
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition">
                                <i class="fas fa-check mr-2"></i> Terima & Proses
                            </button>
                        </div>
                    </form>
                </div>
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
            const acceptModal = document.getElementById('acceptModal');
            const acceptForm = document.getElementById('acceptForm');
            const acceptInternName = document.getElementById('acceptInternName');
            const rejectModal = document.getElementById('rejectModal');
            const rejectForm = document.getElementById('rejectForm');
            const rejectReasonText = document.getElementById('rejection_reason');
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

                    // Filter table rows
                    searchableRows.forEach(function(row) {
                        const text = row.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            row.style.display = '';
                            visibleRowCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    // Filter mobile cards
                    searchableCards.forEach(function(card) {
                        const text = card.getAttribute('data-search') || card.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            card.style.display = '';
                            visibleCardCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Show/hide no results message for table
                    if (searchableRows.length > 0) {
                        if (visibleRowCount === 0 && searchTerm !== '') {
                            noResultsRow.classList.remove('hidden');
                        } else {
                            noResultsRow.classList.add('hidden');
                        }
                    }

                    // Show/hide no results message for cards
                    if (searchableCards.length > 0) {
                        if (visibleCardCount === 0 && searchTerm !== '') {
                            noResultsCard.classList.remove('hidden');
                        } else {
                            noResultsCard.classList.add('hidden');
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
             * Handle Unit Change in Accept Modal
             */
            function handleAcceptUnitChange(selectEl) {
                const inputEl = document.getElementById('accept_unit_magang');
                if (selectEl.value === 'other') {
                    inputEl.classList.remove('hidden');
                    inputEl.value = '';
                    inputEl.required = true;
                    inputEl.focus();
                } else {
                    inputEl.classList.add('hidden');
                    inputEl.value = selectEl.value;
                    inputEl.required = false;
                }
            }

            /**
             * Validasi Form Accept sebelum submit
             */
            function validateAcceptForm() {
                const selectEl = document.getElementById('accept_unit_select');
                const inputEl = document.getElementById('accept_unit_magang');

                if (selectEl.value === '') {
                    alert('Silakan pilih unit magang terlebih dahulu!');
                    selectEl.focus();
                    return false;
                }

                if (selectEl.value === 'other' && !inputEl.value.trim()) {
                    alert('Silakan masukkan nama unit magang!');
                    inputEl.focus();
                    return false;
                }

                return true;
            }

            /**
             * Membuka Modal Terima Pengajuan
             */
            function openAcceptModal(internId, internName, periodeMagang) {
                acceptForm.action = `/interns/${internId}/accept`;
                acceptInternName.textContent = internName;
                document.getElementById('accept_periode_display').textContent = periodeMagang || 'Belum dipilih';

                // Reset select and input
                const selectEl = document.getElementById('accept_unit_select');
                const inputEl = document.getElementById('accept_unit_magang');
                selectEl.value = '';
                inputEl.value = '';
                inputEl.classList.add('hidden');
                inputEl.required = false;

                acceptModal.classList.remove('hidden');
                selectEl.focus();
            }

            /**
             * Menutup Modal Terima Pengajuan
             */
            function closeAcceptModal() {
                if (acceptModal && !acceptModal.classList.contains('hidden')) {
                    acceptModal.classList.add('hidden');
                }
            }

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

            // Listener untuk klik di luar modal accept
            if (acceptModal) {
                acceptModal.addEventListener('click', function(e) {
                    if (e.target === acceptModal) {
                        closeAcceptModal();
                    }
                });
            }

            // Listener untuk tombol 'Escape'
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeDropdown();
                    closeAcceptModal();
                    closeRejectModal();
                    closeDeleteModal();
                }
            });
        </script>
    </div>
@endsection
