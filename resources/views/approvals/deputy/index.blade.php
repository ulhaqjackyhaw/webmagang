@extends('layouts.sidebar')

@section('title', 'Approval Deputy')
@section('page-title', 'Final Approval')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Approval Final Deputy</h1>
        <p class="text-gray-600">Daftar pengajuan yang memerlukan persetujuan final Deputy</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Pending Approvals -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-gray-800 flex items-center">
                <i class="fas fa-clock text-purple-500 mr-2"></i>
                Menunggu Persetujuan Final
                <span
                    class="ml-2 bg-purple-100 text-purple-800 text-sm px-2 py-1 rounded-full">{{ $pendingApprovals->count() }}</span>
            </h2>
        </div>

        @if ($pendingApprovals->isEmpty())
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-inbox text-4xl mb-3"></i>
                <p>Tidak ada pengajuan yang menunggu persetujuan</p>
            </div>
        @else
            <!-- Bulk Actions -->
            <div id="bulkActionsBar" class="hidden mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="text-sm text-gray-600">
                        <span id="selectedCount">0</span> item dipilih
                    </span>
                    <button type="button" onclick="showBulkApproveModal()"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        <i class="fas fa-check-double mr-2"></i>Terima Semua
                    </button>
                    <button type="button" onclick="showBulkRejectModal()"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        <i class="fas fa-times-circle mr-2"></i>Tolak Semua
                    </button>
                </div>
            </div>

            <!-- Mobile Card View -->
            <div class="mobile-card space-y-4">
                @foreach ($pendingApprovals as $index => $item)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-start gap-3">
                                <input type="checkbox"
                                    class="item-checkbox mt-1 w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                    value="{{ $item->id }}" data-name="{{ $item->intern->nama }}">
                                <div>
                                    <h3 class="font-bold text-gray-900">{{ $item->intern->nama }}</h3>
                                    <p class="text-sm text-gray-500">{{ $item->intern->program_studi }}</p>
                                </div>
                            </div>
                            <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">Waiting Final</span>
                        </div>
                        <div class="space-y-2 text-sm border-t border-gray-200 pt-3">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-university text-gray-400 w-4"></i>
                                <span class="text-gray-600">{{ $item->intern->asal_kampus }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-building text-gray-400 w-4"></i>
                                <span class="text-gray-600">{{ $item->unit_magang }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-calendar text-gray-400 w-4"></i>
                                <span
                                    class="text-gray-600">{{ $item->periode_magang ?? ($item->intern->periode_magang ?? '-') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user-check text-gray-400 w-4"></i>
                                <span class="text-gray-600">Div Head: {{ $item->approverDivHead->name ?? '-' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock text-gray-400 w-4"></i>
                                <span
                                    class="text-gray-600">{{ $item->sent_to_deputy_at ? \Carbon\Carbon::parse($item->sent_to_deputy_at)->format('d M Y H:i') : '-' }}</span>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-4 pt-3 border-t border-gray-200">
                            <a href="{{ route('approvals.show', $item->id) }}"
                                class="flex-1 text-center bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition">
                                <i class="fas fa-eye mr-1"></i> Detail
                            </a>
                            <button type="button"
                                onclick="showApproveModal({{ $item->id }}, '{{ $item->intern->nama }}')"
                                class="flex-1 bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition">
                                <i class="fas fa-check-double mr-1"></i> Terima
                            </button>
                            <button type="button" onclick="showRejectModal({{ $item->id }})"
                                class="flex-1 bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition">
                                <i class="fas fa-times mr-1"></i> Tolak
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop Table View -->
            <div class="desktop-table overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center">
                                <input type="checkbox" id="selectAll"
                                    class="w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Peserta</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Asal Kampus</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit Magang</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Disetujui Div Head
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Kirim</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pendingApprovals as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-center">
                                    <input type="checkbox"
                                        class="item-checkbox w-4 h-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                        value="{{ $item->id }}" data-name="{{ $item->intern->nama }}">
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900">{{ $item->intern->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->intern->program_studi }}</div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $item->intern->asal_kampus }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $item->unit_magang }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $item->periode_magang ?? ($item->intern->periode_magang ?? '-') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    <div class="font-medium">{{ $item->approverDivHead->name ?? '-' }}</div>
                                    <div class="text-xs text-gray-400">
                                        {{ $item->approved_divhead_at ? \Carbon\Carbon::parse($item->approved_divhead_at)->format('d M Y H:i') : '-' }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $item->sent_to_deputy_at ? \Carbon\Carbon::parse($item->sent_to_deputy_at)->format('d M Y H:i') : '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('approvals.show', $item->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1.5 rounded-lg text-sm transition">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                        <button type="button"
                                            onclick="showApproveModal({{ $item->id }}, '{{ $item->intern->nama }}')"
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1.5 rounded-lg text-sm transition">
                                            <i class="fas fa-check-double mr-1"></i> Terima
                                        </button>
                                        <button type="button" onclick="showRejectModal({{ $item->id }})"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-sm transition">
                                            <i class="fas fa-times mr-1"></i> Tolak
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Approved History -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-gray-800 flex items-center">
                <i class="fas fa-check-double text-green-500 mr-2"></i>
                Riwayat Persetujuan Final Saya
            </h2>
        </div>

        @if ($approvedByMe->isEmpty())
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-folder-open text-4xl mb-3"></i>
                <p>Belum ada riwayat persetujuan</p>
            </div>
        @else
            <!-- Mobile Card View -->
            <div class="mobile-card space-y-4">
                @foreach ($approvedByMe as $index => $item)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $item->intern->nama }}</h3>
                                <p class="text-sm text-gray-500">{{ $item->intern->asal_kampus }}</p>
                            </div>
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-check-double mr-1"></i> Final
                            </span>
                        </div>
                        <div class="space-y-2 text-sm border-t border-gray-200 pt-3">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-building text-gray-400 w-4"></i>
                                <span class="text-gray-600">{{ $item->unit_magang }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-calendar-check text-gray-400 w-4"></i>
                                <span
                                    class="text-gray-600">{{ $item->approved_deputy_at ? \Carbon\Carbon::parse($item->approved_deputy_at)->format('d M Y H:i') : '-' }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop Table View -->
            <div class="desktop-table overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Peserta</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit Magang</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Final
                                Approve</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($approvedByMe as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $index + 1 }}</td>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900">{{ $item->intern->nama }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->intern->asal_kampus }}</div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $item->unit_magang }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $item->approved_deputy_at ? \Carbon\Carbon::parse($item->approved_deputy_at)->format('d M Y H:i') : '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-double mr-1"></i> Approved Final
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto transform transition-all">
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-t-2xl px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 p-2 rounded-lg">
                            <i class="fas fa-times-circle text-white text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Tolak Pengajuan</h3>
                    </div>
                    <button type="button" onclick="closeRejectModal()"
                        class="text-white/80 hover:text-white transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <!-- Body -->
            <form id="rejectForm" method="POST" class="p-6">
                @csrf
                <div class="mb-6">
                    <p class="text-gray-600 text-sm mb-4">
                        Apakah Anda yakin ingin menolak pengajuan ini? Anda dapat memberikan alasan penolakan (opsional).
                    </p>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-comment-alt text-gray-400 mr-1"></i>
                        Alasan Penolakan <span class="text-gray-400 font-normal">(Opsional)</span>
                    </label>
                    <textarea name="rejection_reason" rows="4"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition resize-none"
                        placeholder="Masukkan alasan penolakan jika diperlukan..."></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="closeRejectModal()"
                        class="flex-1 px-4 py-3 border-2 border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition">
                        <i class="fas fa-arrow-left mr-2"></i>Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 font-medium shadow-lg shadow-red-500/30 transition">
                        <i class="fas fa-times mr-2"></i>Ya, Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Approve Modal -->
    <div id="approveModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto transform transition-all">
            <!-- Header -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-t-2xl px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 p-2 rounded-lg">
                            <i class="fas fa-check-double text-white text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Terima Pengajuan Final</h3>
                    </div>
                    <button type="button" onclick="closeApproveModal()"
                        class="text-white/80 hover:text-white transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <!-- Body -->
            <div class="p-6">
                <div class="flex flex-col items-center text-center mb-6">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-award text-green-500 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Persetujuan Final</h4>
                    <p class="text-gray-600 text-sm">
                        Peserta ini akan mendapatkan <span class="font-semibold text-emerald-600">persetujuan final</span>
                        dan dapat memulai program magang.
                    </p>
                </div>
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-6">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-user-check text-emerald-500 mt-0.5"></i>
                        <div class="text-sm text-emerald-700">
                            <p class="font-medium mb-1">Peserta:</p>
                            <p id="approveInternName" class="font-bold text-emerald-800">-</p>
                        </div>
                    </div>
                </div>
                <form id="approveForm" method="POST">
                    @csrf
                    <div class="flex space-x-3">
                        <button type="button" onclick="closeApproveModal()"
                            class="flex-1 px-4 py-3 border-2 border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition">
                            <i class="fas fa-arrow-left mr-2"></i>Batal
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl hover:from-green-600 hover:to-emerald-700 font-medium shadow-lg shadow-green-500/30 transition">
                            <i class="fas fa-check-double mr-2"></i>Ya, Terima
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bulk Approve Modal -->
    <div id="bulkApproveModal"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto transform transition-all">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-t-2xl px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 p-2 rounded-lg">
                            <i class="fas fa-check-double text-white text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Terima Semua Final</h3>
                    </div>
                    <button type="button" onclick="closeBulkApproveModal()"
                        class="text-white/80 hover:text-white transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <div class="flex flex-col items-center text-center mb-6">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-users text-green-500 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Terima Final Massal</h4>
                    <p class="text-gray-600 text-sm">
                        <span id="bulkApproveCount" class="font-bold text-emerald-600">0</span> peserta akan mendapat
                        persetujuan final dan dapat memulai magang.
                    </p>
                </div>
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-6 max-h-40 overflow-y-auto">
                    <p class="font-medium text-sm text-emerald-700 mb-2">Peserta yang akan diterima:</p>
                    <ul id="bulkApproveNames" class="text-sm text-emerald-800 space-y-1"></ul>
                </div>
                <form id="bulkApproveForm" method="POST" action="{{ route('approvals.deputy.bulkApprove') }}">
                    @csrf
                    <input type="hidden" name="ids" id="bulkApproveIds">
                    <div class="flex space-x-3">
                        <button type="button" onclick="closeBulkApproveModal()"
                            class="flex-1 px-4 py-3 border-2 border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition">
                            <i class="fas fa-arrow-left mr-2"></i>Batal
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl hover:from-green-600 hover:to-emerald-700 font-medium shadow-lg shadow-green-500/30 transition">
                            <i class="fas fa-check-double mr-2"></i>Ya, Terima Semua
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bulk Reject Modal -->
    <div id="bulkRejectModal"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-auto transform transition-all">
            <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-t-2xl px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 p-2 rounded-lg">
                            <i class="fas fa-times-circle text-white text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Tolak Semua Pengajuan</h3>
                    </div>
                    <button type="button" onclick="closeBulkRejectModal()"
                        class="text-white/80 hover:text-white transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <form id="bulkRejectForm" method="POST" action="{{ route('approvals.deputy.bulkReject') }}"
                class="p-6">
                @csrf
                <input type="hidden" name="ids" id="bulkRejectIds">
                <div class="mb-4">
                    <p class="text-gray-600 text-sm mb-2">
                        <span id="bulkRejectCount" class="font-bold text-red-600">0</span> pengajuan akan ditolak.
                    </p>
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 max-h-32 overflow-y-auto mb-4">
                        <ul id="bulkRejectNames" class="text-sm text-red-800 space-y-1"></ul>
                    </div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-comment-alt text-gray-400 mr-1"></i>
                        Alasan Penolakan <span class="text-gray-400 font-normal">(Opsional)</span>
                    </label>
                    <textarea name="rejection_reason" rows="3"
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition resize-none"
                        placeholder="Masukkan alasan penolakan..."></textarea>
                </div>
                <div class="flex space-x-3">
                    <button type="button" onclick="closeBulkRejectModal()"
                        class="flex-1 px-4 py-3 border-2 border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 font-medium transition">
                        <i class="fas fa-arrow-left mr-2"></i>Batal
                    </button>
                    <button type="submit"
                        class="flex-1 px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl hover:from-red-600 hover:to-red-700 font-medium shadow-lg shadow-red-500/30 transition">
                        <i class="fas fa-times mr-2"></i>Ya, Tolak Semua
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Single item modal functions
        function showRejectModal(id) {
            document.getElementById('rejectForm').action = '/approvals/deputy/' + id + '/reject';
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectModal').classList.add('flex');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectModal').classList.remove('flex');
        }

        function showApproveModal(id, name) {
            document.getElementById('approveForm').action = '/approvals/deputy/' + id + '/approve';
            document.getElementById('approveInternName').textContent = name;
            document.getElementById('approveModal').classList.remove('hidden');
            document.getElementById('approveModal').classList.add('flex');
        }

        function closeApproveModal() {
            document.getElementById('approveModal').classList.add('hidden');
            document.getElementById('approveModal').classList.remove('flex');
        }

        // Helper: get only visible checkboxes (mobile or desktop, not both)
        function getVisibleCheckboxes(onlyChecked = false) {
            const selector = onlyChecked ? '.item-checkbox:checked' : '.item-checkbox';
            return [...document.querySelectorAll(selector)].filter(cb => cb.offsetParent !== null);
        }

        // Checkbox handling
        function updateBulkActionsBar() {
            const checkboxes = getVisibleCheckboxes(true);
            const bulkActionsBar = document.getElementById('bulkActionsBar');
            const selectedCount = document.getElementById('selectedCount');

            if (checkboxes.length > 0) {
                bulkActionsBar.classList.remove('hidden');
                selectedCount.textContent = checkboxes.length;
            } else {
                bulkActionsBar.classList.add('hidden');
            }
        }

        // Select all functionality
        document.getElementById('selectAll')?.addEventListener('change', function() {
            const checkboxes = getVisibleCheckboxes(false);
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateBulkActionsBar();
        });

        // Individual checkbox change
        document.querySelectorAll('.item-checkbox').forEach(cb => {
            cb.addEventListener('change', function() {
                const allCheckboxes = getVisibleCheckboxes(false);
                const checkedCheckboxes = getVisibleCheckboxes(true);
                const selectAll = document.getElementById('selectAll');

                if (selectAll) {
                    selectAll.checked = allCheckboxes.length === checkedCheckboxes.length;
                }
                updateBulkActionsBar();
            });
        });

        // Bulk approve modal
        function showBulkApproveModal() {
            const checkboxes = getVisibleCheckboxes(true);
            const ids = [];
            const names = [];

            checkboxes.forEach(cb => {
                ids.push(cb.value);
                names.push(cb.dataset.name);
            });

            document.getElementById('bulkApproveIds').value = ids.join(',');
            document.getElementById('bulkApproveCount').textContent = ids.length;
            document.getElementById('bulkApproveNames').innerHTML = names.map(n => `<li>• ${n}</li>`).join('');

            document.getElementById('bulkApproveModal').classList.remove('hidden');
            document.getElementById('bulkApproveModal').classList.add('flex');
        }

        function closeBulkApproveModal() {
            document.getElementById('bulkApproveModal').classList.add('hidden');
            document.getElementById('bulkApproveModal').classList.remove('flex');
        }

        // Bulk reject modal
        function showBulkRejectModal() {
            const checkboxes = getVisibleCheckboxes(true);
            const ids = [];
            const names = [];

            checkboxes.forEach(cb => {
                ids.push(cb.value);
                names.push(cb.dataset.name);
            });

            document.getElementById('bulkRejectIds').value = ids.join(',');
            document.getElementById('bulkRejectCount').textContent = ids.length;
            document.getElementById('bulkRejectNames').innerHTML = names.map(n => `<li>• ${n}</li>`).join('');

            document.getElementById('bulkRejectModal').classList.remove('hidden');
            document.getElementById('bulkRejectModal').classList.add('flex');
        }

        function closeBulkRejectModal() {
            document.getElementById('bulkRejectModal').classList.add('hidden');
            document.getElementById('bulkRejectModal').classList.remove('flex');
        }

        // Close modals when clicking outside
        ['rejectModal', 'approveModal', 'bulkApproveModal', 'bulkRejectModal'].forEach(modalId => {
            document.getElementById(modalId)?.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                    this.classList.remove('flex');
                }
            });
        });
    </script>
@endsection
