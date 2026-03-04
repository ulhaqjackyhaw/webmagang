@extends('layouts.sidebar')

@section('title', 'Kelola Periode Magang')
@section('page-title', 'Kelola Periode Magang')

@section('content')
    <div class="mb-8 fade-in">
        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-heading mb-2">
                    Periode Pendaftaran Magang
                </h1>
                <p class="text-gray-500 text-lg font-light flex items-center gap-2">
                    <span class="w-1 h-4 bg-cyan-500 rounded-full"></span>
                    Kelola periode pendaftaran magang
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('periode-magang.create') }}"
                    class="group bg-primary hover:bg-primary-dark text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-plus group-hover:scale-110 transition-transform"></i>
                    <span class="font-semibold">Tambah Periode</span>
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="mt-6 mb-6">
            <form method="GET" action="{{ route('periode-magang.index') }}" class="bg-white rounded-xl shadow-md p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-filter text-indigo-500 mr-1"></i> Filter Status
                        </label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300">
                            <option value="">Semua Status</option>
                            <option value="active" {{ $filterStatus === 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ $filterStatus === 'inactive' ? 'selected' : '' }}>Tidak Aktif
                            </option>
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit"
                            class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-semibold transition-all duration-200">
                            <i class="fas fa-filter mr-1"></i> Terapkan
                        </button>
                        @if ($filterStatus)
                            <a href="{{ route('periode-magang.index') }}"
                                class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg font-semibold transition-all duration-200">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Mobile Card View -->
        <div class="mobile-card space-y-4">
            @forelse($periodes as $periode)
                <div class="bg-white rounded-xl shadow-md p-4">
                    <div class="flex justify-between items-start mb-3">
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-900 text-lg">{{ $periode->nama_periode }}</h3>
                            <p class="text-gray-500 text-sm">{{ $periode->nama_batch }}</p>
                        </div>
                        <div>
                            @if ($periode->is_active)
                                @if ($periode->isOpenForRegistration())
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Dibuka
                                    </span>
                                @else
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i> Aktif (Tutup)
                                    </span>
                                @endif
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                    <i class="fas fa-times-circle mr-1"></i> Tidak Aktif
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="space-y-2 text-sm border-t border-gray-100 pt-3">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-calendar-check text-green-500 w-4"></i>
                            <span class="text-gray-600">Mulai: {{ $periode->tanggal_mulai->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-calendar-times text-red-500 w-4"></i>
                            <span class="text-gray-600">Selesai: {{ $periode->tanggal_selesai->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fas fa-clock text-blue-500 w-4"></i>
                            <span class="text-gray-600">Durasi: {{ $periode->durasi }}</span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 mt-4 pt-3 border-t border-gray-100">
                        <a href="{{ route('periode-magang.show', $periode->id) }}"
                            class="flex-1 text-center bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-eye mr-1"></i> Lihat
                        </a>
                        <a href="{{ route('periode-magang.edit', $periode->id) }}"
                            class="flex-1 text-center bg-green-50 text-green-600 hover:bg-green-100 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <form action="{{ route('periode-magang.toggle-status', $periode->id) }}" method="POST"
                            class="flex-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="w-full text-center {{ $periode->is_active ? 'bg-yellow-50 text-yellow-600 hover:bg-yellow-100' : 'bg-primary/10 text-primary hover:bg-primary/20' }} px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                @if ($periode->is_active)
                                    <i class="fas fa-pause mr-1"></i> Nonaktifkan
                                @else
                                    <i class="fas fa-play mr-1"></i> Aktifkan
                                @endif
                            </button>
                        </form>
                        <button type="button"
                            onclick="openDeleteModal({{ $periode->id }}, '{{ $periode->nama_periode }}')"
                            class="flex-1 text-center bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl shadow-md p-8 text-center text-gray-500">
                    <i class="fas fa-calendar-times text-gray-300 text-4xl mb-3"></i>
                    <p>Belum ada periode magang</p>
                    <a href="{{ route('periode-magang.create') }}" class="text-primary hover:underline mt-2 inline-block">
                        <i class="fas fa-plus mr-1"></i> Tambah Periode Baru
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Desktop Table View -->
        <div class="desktop-table bg-white rounded-2xl shadow-xl">
            <div class="overflow-x-auto" style="max-width: 100%;">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Periode Pendaftaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Mulai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Selesai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($periodes as $index => $periode)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $periode->nama_batch }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $periode->nama_periode }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $periode->tanggal_mulai->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $periode->tanggal_selesai->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($periode->is_active)
                                        @if ($periode->isOpenForRegistration())
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                <i class="fas fa-check-circle mr-1"></i> Dibuka
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                <i class="fas fa-clock mr-1"></i> Aktif (Tutup)
                                            </span>
                                        @endif
                                    @else
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            <i class="fas fa-times-circle mr-1"></i> Tidak Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                    <a href="{{ route('periode-magang.show', $periode->id) }}"
                                        class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('periode-magang.edit', $periode->id) }}"
                                        class="text-green-600 hover:text-green-900" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('periode-magang.toggle-status', $periode->id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="{{ $periode->is_active ? 'text-yellow-600 hover:text-yellow-900' : 'text-primary hover:text-primary-dark' }}"
                                            title="{{ $periode->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            <i class="fas {{ $periode->is_active ? 'fa-pause' : 'fa-play' }}"></i>
                                        </button>
                                    </form>
                                    <button type="button"
                                        onclick="openDeleteModal({{ $periode->id }}, '{{ $periode->nama_periode }}')"
                                        class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    <i class="fas fa-calendar-times text-gray-300 text-3xl mb-2"></i>
                                    <p>Belum ada periode magang</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-md">
            <div class="p-6">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fas fa-trash text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Hapus Periode Magang</h3>
                        <p class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan</p>
                    </div>
                </div>

                <p class="text-gray-700 mb-6">
                    Apakah Anda yakin ingin menghapus periode <strong id="deleteModalPeriodeName"></strong>?
                </p>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="button" onclick="closeDeleteModal()"
                            class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                            <i class="fas fa-trash mr-1"></i> Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openDeleteModal(id, name) {
            document.getElementById('deleteForm').action = '{{ url('periode-magang') }}/' + id;
            document.getElementById('deleteModalPeriodeName').textContent = name;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
@endsection
