@extends('layouts.sidebar')

@section('title', 'Approval Div Head')
@section('page-title', 'Approval Pengajuan')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Approval Pengajuan Magang</h1>
        <p class="text-gray-600">Daftar pengajuan yang memerlukan persetujuan Div Head</p>
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
                <i class="fas fa-clock text-yellow-500 mr-2"></i>
                Menunggu Persetujuan
                <span
                    class="ml-2 bg-yellow-100 text-yellow-800 text-sm px-2 py-1 rounded-full">{{ $pendingApprovals->count() }}</span>
            </h2>
        </div>

        @if ($pendingApprovals->isEmpty())
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-inbox text-4xl mb-3"></i>
                <p>Tidak ada pengajuan yang menunggu persetujuan</p>
            </div>
        @else
            <!-- Mobile Card View -->
            <div class="mobile-card space-y-4">
                @foreach ($pendingApprovals as $index => $item)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $item->intern->nama }}</h3>
                                <p class="text-sm text-gray-500">{{ $item->intern->program_studi }}</p>
                            </div>
                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Pending</span>
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
                                <i class="fas fa-user text-gray-400 w-4"></i>
                                <span class="text-gray-600">{{ $item->creator->name ?? '-' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-clock text-gray-400 w-4"></i>
                                <span
                                    class="text-gray-600">{{ $item->sent_to_divhead_at ? \Carbon\Carbon::parse($item->sent_to_divhead_at)->format('d M Y H:i') : '-' }}</span>
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
                                <i class="fas fa-check mr-1"></i> Setujui
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
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Peserta</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Asal Kampus</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit Magang</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Periode</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diajukan Oleh</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Kirim</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($pendingApprovals as $index => $item)
                            <tr class="hover:bg-gray-50">
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
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $item->creator->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">
                                    {{ $item->sent_to_divhead_at ? \Carbon\Carbon::parse($item->sent_to_divhead_at)->format('d M Y H:i') : '-' }}
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
                                            <i class="fas fa-check mr-1"></i> Setujui
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
                <i class="fas fa-history text-green-500 mr-2"></i>
                Riwayat Persetujuan Saya
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
                            <span class="px-2 py-1 text-xs rounded-full {{ $item->approval_status_color }}">
                                {{ $item->approval_status_label }}
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
                                    class="text-gray-600">{{ $item->approved_divhead_at ? \Carbon\Carbon::parse($item->approved_divhead_at)->format('d M Y H:i') : '-' }}</span>
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
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Disetujui
                            </th>
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
                                    {{ $item->approved_divhead_at ? \Carbon\Carbon::parse($item->approved_divhead_at)->format('d M Y H:i') : '-' }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $item->approval_status_color }}">
                                        {{ $item->approval_status_label }}
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
                            <i class="fas fa-check-circle text-white text-xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Setujui Pengajuan</h3>
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
                        <i class="fas fa-paper-plane text-green-500 text-2xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Konfirmasi Persetujuan</h4>
                    <p class="text-gray-600 text-sm">
                        Pengajuan ini akan disetujui dan diteruskan ke <span
                            class="font-semibold text-emerald-600">Deputy</span> untuk persetujuan final.
                    </p>
                </div>
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 mb-6">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-info-circle text-emerald-500 mt-0.5"></i>
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
                            <i class="fas fa-check mr-2"></i>Ya, Setujui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showRejectModal(id) {
            document.getElementById('rejectForm').action = '/approvals/divhead/' + id + '/reject';
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectModal').classList.add('flex');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectModal').classList.remove('flex');
        }

        function showApproveModal(id, name) {
            document.getElementById('approveForm').action = '/approvals/divhead/' + id + '/approve';
            document.getElementById('approveInternName').textContent = name;
            document.getElementById('approveModal').classList.remove('hidden');
            document.getElementById('approveModal').classList.add('flex');
        }

        function closeApproveModal() {
            document.getElementById('approveModal').classList.add('hidden');
            document.getElementById('approveModal').classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });

        document.getElementById('approveModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeApproveModal();
            }
        });
    </script>
@endsection
