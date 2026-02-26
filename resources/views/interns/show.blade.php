@extends('layouts.sidebar')

@section('title', 'Detail Data Magang')@section('page-title', 'Detail Pengajuan Magang')
@section('content')
    <!-- Header Section -->
    <div class="mb-8 fade-in">
        <div class="flex items-center gap-4 mb-3">
            <div
                class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                <i class="fas fa-id-card text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-heading">
                    Detail Pengajuan Magang
                </h1>
            </div>
        </div>
        <p class="text-gray-500 text-lg font-light ml-16">
            Informasi lengkap pengajuan magang
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10 fade-in" style="animation-delay: 0.1s">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Nama Lengkap</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->nama }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">NIM</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->nim }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Asal Kampus</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->asal_kampus }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Program Studi</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->program_studi }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Email Kampus</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->email_kampus ?? '-' }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">No WhatsApp</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->no_wa }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Jenis Kelamin</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->jenis_kelamin ?? '-' }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Periode Magang</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->periode_magang ?? '-' }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</label>
                @if ($intern->status === 'pending')
                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-amber-50 text-amber-700 border border-amber-200">
                        <i class="fas fa-clock"></i> Menunggu Persetujuan
                    </span>
                @elseif($intern->status === 'approved')
                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <i class="fas fa-check-circle"></i> Diterima
                    </span>
                @else
                    <span
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold rounded-xl bg-red-50 text-red-700 border border-red-200">
                        <i class="fas fa-times-circle"></i> Ditolak
                    </span>
                @endif
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Dibuat Oleh</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->creator?->name ?? 'Pendaftar Publik' }}</p>
            </div>

            <div class="space-y-2">
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal Dibuat</label>
                <p class="text-gray-900 font-semibold text-lg">{{ $intern->created_at->format('d M Y H:i') }}</p>
            </div>

            @if ($intern->status === 'rejected' && $intern->rejection_reason)
                <div class="col-span-2 space-y-2">
                    <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider">Alasan
                        Penolakan</label>
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                        <p class="text-red-700 font-medium">{{ $intern->rejection_reason }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200 pt-8">
            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-file-alt text-purple-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 font-heading">
                Dokumen Lampiran
            </h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            @if ($intern->file_formulir)
                <a href="{{ asset('storage/' . $intern->file_formulir) }}" target="_blank"
                    class="group border-2 border-gray-200 hover:border-orange-400 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-gradient-to-br from-orange-50 to-orange-100">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-gray-600 text-sm font-medium">Formulir</p>
                            <p class="text-orange-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-orange-500 text-xl group-hover:scale-110 transition-transform flex-shrink-0"></i>
                    </div>
                </a>
            @endif

            @if ($intern->file_proposal)
                <a href="{{ asset('storage/' . $intern->file_proposal) }}" target="_blank"
                    class="group border-2 border-gray-200 hover:border-blue-400 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-gradient-to-br from-blue-50 to-blue-100">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-gray-600 text-sm font-medium">Proposal</p>
                            <p class="text-blue-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-blue-500 text-xl group-hover:scale-110 transition-transform flex-shrink-0"></i>
                    </div>
                </a>
            @endif

            @if ($intern->file_cv)
                <a href="{{ asset('storage/' . $intern->file_cv) }}" target="_blank"
                    class="group border-2 border-gray-200 hover:border-green-400 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-gradient-to-br from-green-50 to-green-100">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-gray-600 text-sm font-medium">CV</p>
                            <p class="text-green-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-green-500 text-xl group-hover:scale-110 transition-transform flex-shrink-0"></i>
                    </div>
                </a>
            @endif

            @if ($intern->file_surat)
                <a href="{{ asset('storage/' . $intern->file_surat) }}" target="_blank"
                    class="group border-2 border-gray-200 hover:border-purple-400 rounded-xl p-5 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 bg-gradient-to-br from-purple-50 to-purple-100">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 pr-3">
                            <p class="text-gray-600 text-sm font-medium">Surat Magang</p>
                            <p class="text-purple-600 font-bold text-sm flex items-center mt-1">
                                <i class="fas fa-file-pdf mr-1"></i> Lihat Dokumen
                            </p>
                        </div>
                        <i
                            class="fas fa-external-link-alt text-purple-500 text-xl group-hover:scale-110 transition-transform flex-shrink-0"></i>
                    </div>
                </a>
            @endif
        </div>

        <div class="pt-8 mt-8 border-t border-gray-100">
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('interns.index') }}"
                    class="group bg-gray-100 hover:bg-gray-200 text-gray-700 hover:text-gray-900 px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2">
                    <i class="fas fa-arrow-left text-sm"></i>
                    <span>Kembali</span>
                </a>

                @if ((auth()->user()->role === 'hc' || auth()->user()->role === 'admin') && $intern->status === 'pending')
                    <button type="button" onclick="openRejectModal()"
                        class="group relative overflow-hidden bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-500/40">
                        <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                        <i class="fas fa-times-circle text-sm"></i>
                        <span>Tolak Pengajuan</span>
                    </button>
                @endif
            </div>

            @if (
                (auth()->user()->role === 'hc' || auth()->user()->role === 'admin') &&
                    ($intern->status === 'pending' || ($intern->status === 'approved' && !$intern->acceptedIntern)))
                <!-- Inline Form Terima Pengajuan -->
                <div class="mt-6 bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-xl p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Terima Pengajuan Magang</h3>
                            <p class="text-sm text-gray-500">Pilih unit penempatan untuk {{ $intern->nama }}</p>
                        </div>
                    </div>

                    <form id="acceptForm" action="{{ route('interns.accept', $intern->id) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-gray-700 font-medium mb-2 text-sm">
                                    <i class="fas fa-calendar-alt text-green-500 mr-1"></i> Periode Magang
                                </label>
                                <div
                                    class="px-4 py-2.5 bg-white border border-gray-200 rounded-lg text-gray-700 font-medium text-sm">
                                    {{ $intern->periode_magang ?? 'Belum dipilih' }}
                                </div>
                            </div>
                            <div>
                                <label for="unit_magang_select" class="block text-gray-700 font-medium mb-2 text-sm">
                                    <i class="fas fa-building text-green-500 mr-1"></i> Unit Magang <span
                                        class="text-red-500">*</span>
                                </label>
                                <select id="unit_magang_select" onchange="handleUnitChange(this)"
                                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-sm"
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
                                <input type="text" name="unit_magang" id="unit_magang"
                                    class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-sm mt-2 hidden"
                                    placeholder="Tulis nama unit...">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="openConfirmModal()"
                                class="group relative overflow-hidden bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-6 py-2.5 rounded-lg font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-green-500/30">
                                <i class="fas fa-check text-sm"></i>
                                <span>Terima & Proses</span>
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Konfirmasi Terima Pengajuan -->
    @if (
        (auth()->user()->role === 'hc' || auth()->user()->role === 'admin') &&
            ($intern->status === 'pending' || ($intern->status === 'approved' && !$intern->acceptedIntern)))
        <div id="confirmModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
            <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl">
                <div class="p-6">
                    <!-- Header -->
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-14 h-14 rounded-full bg-gradient-to-br from-green-400 to-emerald-500 flex items-center justify-center shadow-lg">
                            <i class="fas fa-paper-plane text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Konfirmasi Penerimaan</h3>
                            <p class="text-sm text-gray-500">Data akan diteruskan ke Div Head</p>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-4 mb-4">
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-user text-blue-500 w-5"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Nama Peserta</p>
                                    <p class="font-semibold text-gray-800">{{ $intern->nama }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-calendar text-blue-500 w-5"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Periode Magang</p>
                                    <p class="font-semibold text-gray-800">
                                        {{ $intern->periode_magang ?? 'Belum dipilih' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-building text-blue-500 w-5"></i>
                                <div>
                                    <p class="text-xs text-gray-500">Unit Penempatan</p>
                                    <p class="font-semibold text-gray-800" id="confirmUnitDisplay">-</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mb-6">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-info-circle text-amber-500 mt-0.5"></i>
                            <div class="text-sm text-amber-700">
                                <p class="font-semibold mb-1">Perhatian!</p>
                                <p>Setelah dikonfirmasi, data peserta magang akan:</p>
                                <ul class="list-disc list-inside mt-1 space-y-1">
                                    <li>Diterima dan masuk daftar "Data Anak Magang"</li>
                                    <li>Diteruskan ke <strong>Div Head</strong> untuk persetujuan</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeConfirmModal()"
                            class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-all">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </button>
                        <button type="button" onclick="submitAcceptForm()"
                            class="px-5 py-2.5 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-lg font-semibold shadow-lg transition-all flex items-center gap-2">
                            <i class="fas fa-check-circle"></i>
                            <span>Ya, Terima & Kirim ke Div Head</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal Alasan Penolakan -->
    <div id="rejectModal"
        class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-lg w-full max-w-md">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Alasan Penolakan</h3>
                <form action="{{ route('interns.updateStatus', $intern->id) }}" method="POST">
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

    <!-- Modal Preview -->
    <div id="previewModal"
        class="hidden fixed inset-0 bg-black bg-opacity-70 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-2xl w-full max-w-6xl h-5/6 flex flex-col shadow-2xl">
            <div
                class="flex justify-between items-center p-6 border-b-2 border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                <h3 class="text-2xl font-bold text-gray-800 flex items-center" id="modalTitle">
                    <i class="fas fa-file-alt text-blue-600 mr-3"></i>
                    Preview Dokumen
                </h3>
                <div class="flex space-x-3">
                    <a id="downloadBtn" href="#" download
                        class="group bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white px-5 py-2 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-download group-hover:scale-110 transition-transform"></i>
                        <span class="font-semibold">Download</span>
                    </a>
                    <button onclick="closePreview()"
                        class="group bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white px-5 py-2 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-times group-hover:rotate-90 transition-transform"></i>
                        <span class="font-semibold">Tutup</span>
                    </button>
                </div>
            </div>
            <div class="flex-1 overflow-hidden">
                <iframe id="previewFrame" class="w-full h-full" frameborder="0"></iframe>
            </div>
        </div>
    </div>

    <script>
        function openPreview(url, title) {
            document.getElementById('modalTitle').textContent = 'Preview ' + title;
            document.getElementById('previewFrame').src = url;
            document.getElementById('downloadBtn').href = url;
            document.getElementById('previewModal').classList.remove('hidden');
        }

        function closePreview() {
            document.getElementById('previewModal').classList.add('hidden');
            document.getElementById('previewFrame').src = '';
        }

        function handleUnitChange(selectEl) {
            const inputEl = document.getElementById('unit_magang');
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

        function openRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }

        function openConfirmModal() {
            // Validate unit selection first
            const selectEl = document.getElementById('unit_magang_select');
            const inputEl = document.getElementById('unit_magang');

            let selectedUnit = '';
            if (selectEl.value === 'other') {
                if (!inputEl.value.trim()) {
                    inputEl.focus();
                    alert('Silakan masukkan unit penempatan terlebih dahulu!');
                    return;
                }
                selectedUnit = inputEl.value.trim();
            } else if (selectEl.value) {
                selectedUnit = selectEl.value;
            } else {
                alert('Silakan pilih unit penempatan terlebih dahulu!');
                selectEl.focus();
                return;
            }

            // Update modal display
            document.getElementById('confirmUnitDisplay').textContent = selectedUnit;

            // Show modal
            document.getElementById('confirmModal').classList.remove('hidden');
        }

        function closeConfirmModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }

        function submitAcceptForm() {
            // Submit the accept form
            document.getElementById('acceptForm').submit();
        }

        // Close modal when clicking outside
        document.getElementById('previewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePreview();
            }
        });

        const rejectModal = document.getElementById('rejectModal');
        if (rejectModal) {
            rejectModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeRejectModal();
                }
            });
        }

        const confirmModal = document.getElementById('confirmModal');
        if (confirmModal) {
            confirmModal.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeConfirmModal();
                }
            });
        }

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePreview();
                closeRejectModal();
                closeConfirmModal();
            }
        });
    </script>
@endsection
