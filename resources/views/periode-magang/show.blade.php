@extends('layouts.sidebar')

@section('title', 'Detail Periode Magang')
@section('page-title', 'Detail Periode Magang')

@section('content')
    <div class="mb-6 fade-in">
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('periode-magang.index') }}"
                class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-600 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Detail Periode Magang</h1>
                <p class="text-gray-600">Informasi lengkap periode {{ $periode->nama_periode }}</p>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Main Info -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Periode Info Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-primary to-primary-dark px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <i class="fas fa-calendar-alt"></i>
                        Informasi Periode
                    </h2>
                </div>
                <div class="p-6 space-y-4">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-gray-500 text-sm">Nama Batch</label>
                            <p class="text-gray-900 font-semibold text-lg">{{ $periode->nama_batch }}</p>
                        </div>
                        <div>
                            <label class="text-gray-500 text-sm">Nama Periode</label>
                            <p class="text-gray-900 font-semibold text-lg">{{ $periode->nama_periode }}</p>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="bg-green-50 rounded-xl p-4">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-calendar-check text-green-500"></i>
                                <label class="text-green-700 text-sm font-medium">Tanggal Mulai</label>
                            </div>
                            <p class="text-green-900 font-bold text-lg">{{ $periode->tanggal_mulai->format('d M Y') }}</p>
                        </div>
                        <div class="bg-red-50 rounded-xl p-4">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fas fa-calendar-times text-red-500"></i>
                                <label class="text-red-700 text-sm font-medium">Tanggal Selesai</label>
                            </div>
                            <p class="text-red-900 font-bold text-lg">{{ $periode->tanggal_selesai->format('d M Y') }}</p>
                        </div>
                    </div>

                    @if ($periode->keterangan)
                        <hr class="border-gray-200">
                        <div>
                            <label class="text-gray-500 text-sm">Keterangan</label>
                            <p class="text-gray-700 mt-1">{{ $periode->keterangan }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('periode-magang.edit', $periode->id) }}"
                    class="flex-1 sm:flex-none bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                    <i class="fas fa-edit"></i>
                    <span>Edit Periode</span>
                </a>
                <form action="{{ route('periode-magang.toggle-status', $periode->id) }}" method="POST"
                    class="flex-1 sm:flex-none">
                    @csrf
                    @method('PATCH')
                    <button type="submit"
                        class="w-full {{ $periode->is_active ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-primary hover:bg-primary-dark' }} text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                        @if ($periode->is_active)
                            <i class="fas fa-pause"></i>
                            <span>Nonaktifkan</span>
                        @else
                            <i class="fas fa-play"></i>
                            <span>Aktifkan</span>
                        @endif
                    </button>
                </form>
                <button type="button" onclick="openDeleteModal()"
                    class="flex-1 sm:flex-none bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2">
                    <i class="fas fa-trash"></i>
                    <span>Hapus</span>
                </button>
            </div>
        </div>

        <!-- Sidebar Info -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div
                    class="bg-gradient-to-r {{ $periode->isOpenForRegistration() ? 'from-green-500 to-green-600' : ($periode->is_active ? 'from-yellow-500 to-yellow-600' : 'from-gray-500 to-gray-600') }} px-6 py-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <i class="fas fa-info-circle"></i>
                        Status
                    </h2>
                </div>
                <div class="p-6 text-center">
                    @if ($periode->isOpenForRegistration())
                        <div class="w-20 h-20 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-check-circle text-green-500 text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-green-700 mb-2">Pendaftaran Dibuka</h3>
                        <p class="text-gray-600 text-sm">
                            Sampai tanggal mulai:
                            <strong class="text-green-600">{{ $periode->tanggal_mulai->format('d M Y') }}</strong>
                        </p>
                    @elseif($periode->is_active)
                        <div class="w-20 h-20 rounded-full bg-yellow-100 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-clock text-yellow-500 text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-yellow-700 mb-2">Magang Berlangsung</h3>
                        <p class="text-gray-600 text-sm">
                            Pendaftaran sudah ditutup
                        </p>
                    @else
                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-times-circle text-gray-500 text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">Tidak Aktif</h3>
                        <p class="text-gray-600 text-sm">Periode ini tidak ditampilkan ke pendaftar</p>
                    @endif
                </div>
            </div>

            <!-- Duration Card -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-clock text-primary"></i>
                    Durasi Magang
                </h3>
                <div class="text-center">
                    <p class="text-4xl font-bold text-primary">{{ $periode->durasi }}</p>
                    <p class="text-gray-500 text-sm mt-1">
                        {{ $periode->tanggal_mulai->format('d M') }} - {{ $periode->tanggal_selesai->format('d M Y') }}
                    </p>
                </div>
            </div>

            <!-- Meta Info Card -->
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-history text-gray-500"></i>
                    Informasi Lainnya
                </h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Dibuat oleh</span>
                        <span class="font-medium text-gray-800">{{ $periode->creator->name ?? 'System' }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Dibuat pada</span>
                        <span class="font-medium text-gray-800">{{ $periode->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Terakhir diubah</span>
                        <span class="font-medium text-gray-800">{{ $periode->updated_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
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
                    Apakah Anda yakin ingin menghapus periode <strong>{{ $periode->nama_periode }}</strong>?
                </p>

                <form action="{{ route('periode-magang.destroy', $periode->id) }}" method="POST">
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
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
@endsection
