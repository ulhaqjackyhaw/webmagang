@extends('layouts.sidebar')

@section('title', 'Administrasi Persuratan')
@section('page-title', 'Administrasi Persuratan')

@section('content')
    <!-- Header Section -->
    <div class="mb-8 fade-in">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-heading mb-2">
                    Administrasi Persuratan
                </h1>
                <p class="text-gray-500 text-lg font-light flex items-center gap-2">
                    <span class="w-1 h-4 rounded-full" style="background-color: #20B2AA;"></span>
                    Kelola surat dan onboarding peserta yang sudah di-ACC Deputy
                </p>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg fade-in" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <p>{{ session('success') }}</p>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg fade-in" role="alert">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                <p>{{ session('error') }}</p>
            </div>
        </div>
    @endif

    <!-- Filter Section -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-6 fade-in">
        <form method="GET" action="{{ route('administrasi-persuratan.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-filter mr-1" style="color: #20B2AA;"></i> Status Persuratan
                    </label>
                    <select name="status" id="status"
                        class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:border-transparent transition-all duration-300"
                        onfocus="this.style.borderColor='#20B2AA'; this.style.boxShadow='0 0 0 3px rgba(32, 178, 170, 0.1)';"
                        onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                        <option value="">Semua Status</option>
                        <option value="incomplete" {{ ($filterStatus ?? '') == 'incomplete' ? 'selected' : '' }}>Belum
                            Lengkap</option>
                        <option value="complete" {{ ($filterStatus ?? '') == 'complete' ? 'selected' : '' }}>Sudah Lengkap
                        </option>
                    </select>
                </div>

                <!-- Search -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-search mr-1" style="color: #20B2AA;"></i> Cari
                    </label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}"
                        placeholder="Nama, NIM, atau Kampus..."
                        class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:border-transparent transition-all duration-300"
                        onfocus="this.style.borderColor='#20B2AA'; this.style.boxShadow='0 0 0 3px rgba(32, 178, 170, 0.1)';"
                        onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                </div>

                <!-- Per Page Filter -->
                <div>
                    <label for="per_page" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-list-ol mr-1" style="color: #20B2AA;"></i> Tampilkan
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

                <!-- Filter Button -->
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="flex-1 px-6 py-2 text-white rounded-lg font-medium transition-all hover:shadow-lg"
                        style="background: linear-gradient(to right, #20B2AA, #1a8f89);"
                        onmouseover="this.style.background='linear-gradient(to right, #1a8f89, #157a74)';"
                        onmouseout="this.style.background='linear-gradient(to right, #20B2AA, #1a8f89)';">
                        <i class="fas fa-filter mr-1"></i> Terapkan
                    </button>
                    @if (($filterStatus ?? '') || request('search') || ($perPage ?? 10) != 10)
                        <a href="{{ route('administrasi-persuratan.index') }}"
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition-all text-center">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Bulk Actions Form -->
    <form id="bulkForm" method="POST">
        @csrf

        <!-- Bulk Action Buttons -->
        <div class="bg-white rounded-xl shadow-md p-4 mb-6 fade-in">
            <div class="flex flex-wrap items-center gap-3">
                <span class="text-gray-600 font-medium">Aksi Massal:</span>
                <button type="button" onclick="bulkAction('konfirmasi')"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-all flex items-center gap-2 disabled:opacity-50"
                    id="btnBulkKonfirmasi">
                    <i class="fas fa-file-word"></i>
                    <span>Download Surat Konfirmasi</span>
                </button>
                <button type="button" onclick="bulkAction('kampus')"
                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all flex items-center gap-2 disabled:opacity-50"
                    id="btnBulkKampus">
                    <i class="fas fa-file-word"></i>
                    <span>Download Surat Kampus</span>
                </button>
                <button type="button" onclick="bulkAction('whatsapp')"
                    class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-medium transition-all flex items-center gap-2 disabled:opacity-50"
                    id="btnBulkWhatsapp">
                    <i class="fab fa-whatsapp"></i>
                    <span>Tandai WA Terkirim</span>
                </button>
                <span id="selectedCount" class="ml-auto text-gray-500 text-sm">0 dipilih</span>
            </div>
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden fade-in">
            <!-- Desktop Table -->
            <div class="desktop-table">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-white text-left"
                                style="background: linear-gradient(to right, #20B2AA, #1a8f89);">
                                <th class="px-4 py-4 font-semibold">
                                    <input type="checkbox" id="selectAll" onclick="toggleSelectAll()"
                                        class="w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary">
                                </th>
                                <th class="px-4 py-4 font-semibold">No</th>
                                <th class="px-4 py-4 font-semibold">Nama</th>
                                <th class="px-4 py-4 font-semibold">NIM</th>
                                <th class="px-4 py-4 font-semibold">Asal Kampus</th>
                                <th class="px-4 py-4 font-semibold">Unit Magang</th>
                                <th class="px-4 py-4 font-semibold text-center">Status</th>
                                <th class="px-4 py-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($acceptedInterns as $index => $accepted)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4">
                                        <input type="checkbox" name="ids[]" value="{{ $accepted->id }}"
                                            class="item-checkbox w-4 h-4 rounded border-gray-300 text-primary focus:ring-primary"
                                            onclick="updateSelectedCount()">
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-900">
                                        {{ $acceptedInterns->firstItem() + $index }}</td>
                                    <td class="px-4 py-4">
                                        <div class="font-medium text-gray-900">{{ $accepted->intern->nama ?? '-' }}</div>
                                        <div class="text-sm text-gray-500">{{ $accepted->intern->email ?? '-' }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-gray-700">{{ $accepted->intern->nim ?? '-' }}</td>
                                    <td class="px-4 py-4 text-gray-700">{{ $accepted->intern->asal_kampus ?? '-' }}</td>
                                    <td class="px-4 py-4 text-gray-700">{{ $accepted->unit_magang ?? '-' }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-col items-center gap-1">
                                            <!-- Surat Konfirmasi Unit -->
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium {{ $accepted->surat_konfirmasi_unit_downloaded ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                <i
                                                    class="fas {{ $accepted->surat_konfirmasi_unit_downloaded ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                                Surat Konfirmasi
                                            </span>
                                            <!-- Surat ke Kampus -->
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium {{ $accepted->surat_ke_kampus_downloaded ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                <i
                                                    class="fas {{ $accepted->surat_ke_kampus_downloaded ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                                Surat Kampus
                                            </span>
                                            <!-- WhatsApp Onboarding -->
                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium {{ $accepted->wa_onboarding_sent ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                <i class="fab fa-whatsapp"></i>
                                                WA Onboarding
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <div class="flex flex-col items-center gap-2">
                                            <!-- Download Surat Konfirmasi Unit -->
                                            <a href="{{ route('administrasi-persuratan.download-surat-konfirmasi', $accepted->id) }}"
                                                class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-all"
                                                title="Download Surat Konfirmasi Unit">
                                                <i class="fas fa-file-word"></i>
                                                <span>Surat Konfirmasi</span>
                                            </a>

                                            <!-- Download Surat ke Kampus -->
                                            <a href="{{ route('administrasi-persuratan.download-surat-kampus', $accepted->id) }}"
                                                class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-all"
                                                title="Download Surat ke Kampus">
                                                <i class="fas fa-file-word"></i>
                                                <span>Surat Kampus</span>
                                            </a>

                                            <!-- WhatsApp Onboarding -->
                                            <a href="{{ route('administrasi-persuratan.send-whatsapp', $accepted->id) }}"
                                                target="_blank"
                                                class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium transition-all"
                                                title="Kirim WA Onboarding">
                                                <i class="fab fa-whatsapp"></i>
                                                <span>WA Onboarding</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                                            <p class="text-gray-500 text-lg">Tidak ada data peserta yang sudah di-ACC
                                                Deputy</p>
                                            <p class="text-gray-400 text-sm mt-1">Peserta akan muncul setelah mendapat
                                                approval dari Deputy</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile Cards -->
            <div class="mobile-card p-4 space-y-4">
                @forelse($acceptedInterns as $accepted)
                    <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="ids[]" value="{{ $accepted->id }}"
                                    class="item-checkbox w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary"
                                    onclick="updateSelectedCount()">
                                <div>
                                    <h3 class="font-semibold text-gray-900">{{ $accepted->intern->nama ?? '-' }}</h3>
                                    <p class="text-sm text-gray-500">{{ $accepted->intern->nim ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2 text-sm mb-4">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Kampus:</span>
                                <span class="font-medium text-gray-700">{{ $accepted->intern->asal_kampus ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Unit:</span>
                                <span class="font-medium text-gray-700">{{ $accepted->unit_magang ?? '-' }}</span>
                            </div>
                        </div>

                        <!-- Status Badges -->
                        <div class="flex flex-wrap gap-1 mb-4">
                            <span
                                class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium {{ $accepted->surat_konfirmasi_unit_downloaded ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                <i
                                    class="fas {{ $accepted->surat_konfirmasi_unit_downloaded ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                Konfirmasi
                            </span>
                            <span
                                class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium {{ $accepted->surat_ke_kampus_downloaded ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                <i
                                    class="fas {{ $accepted->surat_ke_kampus_downloaded ? 'fa-check-circle' : 'fa-clock' }}"></i>
                                Kampus
                            </span>
                            <span
                                class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium {{ $accepted->wa_onboarding_sent ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                <i class="fab fa-whatsapp"></i>
                                WA
                            </span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('administrasi-persuratan.download-surat-konfirmasi', $accepted->id) }}"
                                class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-all">
                                <i class="fas fa-file-word"></i>
                                <span>Download Surat Konfirmasi</span>
                            </a>
                            <a href="{{ route('administrasi-persuratan.download-surat-kampus', $accepted->id) }}"
                                class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-all">
                                <i class="fas fa-file-word"></i>
                                <span>Download Surat Kampus</span>
                            </a>
                            <a href="{{ route('administrasi-persuratan.send-whatsapp', $accepted->id) }}" target="_blank"
                                class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium transition-all">
                                <i class="fab fa-whatsapp"></i>
                                <span>Kirim WA Onboarding</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">Tidak ada data</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($acceptedInterns->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
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
    </form>

    <script>
        function toggleSelectAll() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.item-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
            updateSelectedCount();
        }

        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('.item-checkbox:checked');
            const count = checkboxes.length;
            document.getElementById('selectedCount').textContent = count + ' dipilih';

            // Update select all checkbox state
            const allCheckboxes = document.querySelectorAll('.item-checkbox');
            const selectAll = document.getElementById('selectAll');
            if (allCheckboxes.length > 0) {
                selectAll.checked = count === allCheckboxes.length;
                selectAll.indeterminate = count > 0 && count < allCheckboxes.length;
            }
        }

        function bulkAction(action) {
            const checkboxes = document.querySelectorAll('.item-checkbox:checked');
            if (checkboxes.length === 0) {
                alert('Pilih minimal satu data terlebih dahulu.');
                return;
            }

            const form = document.getElementById('bulkForm');

            switch (action) {
                case 'konfirmasi':
                    form.action = '{{ route('administrasi-persuratan.bulk-download-konfirmasi') }}';
                    break;
                case 'kampus':
                    form.action = '{{ route('administrasi-persuratan.bulk-download-kampus') }}';
                    break;
                case 'whatsapp':
                    form.action = '{{ route('administrasi-persuratan.bulk-send-whatsapp') }}';
                    break;
            }

            form.submit();
        }
    </script>
@endsection
