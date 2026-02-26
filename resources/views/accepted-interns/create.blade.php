@extends('layouts.sidebar')

@section('title', 'Tambah Data Monitoring')
@section('page-title', 'Monitoring Approval')

@section('content')
    <!-- Header Section -->
    <div class="mb-8 fade-in">
        <div class="flex items-center gap-4 mb-3">
            <div
                class="w-12 h-12 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-xl flex items-center justify-center shadow-lg shadow-teal-500/30">
                <i class="fas fa-user-plus text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-heading">
                    Tambah Data Monitoring
                </h1>
            </div>
        </div>
        <p class="text-gray-500 text-lg font-light ml-16">
            Cari dan pilih peserta magang yang sudah diterima
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10 fade-in" style="animation-delay: 0.1s">
        <!-- List of Available Interns -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-users text-teal-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 font-heading">
                    Peserta Magang yang Sudah Diterima
                </h3>
            </div>

            @if ($availableInterns->count() > 0)
                <div class="space-y-3 max-h-96 overflow-y-auto pr-2">
                    @foreach ($availableInterns as $intern)
                        <div onclick='selectIntern(@json($intern))'
                            class="group p-4 border-2 border-gray-200 hover:border-teal-500 rounded-xl cursor-pointer smooth-transition hover:shadow-lg bg-white hover:bg-teal-50">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="font-bold text-gray-900 text-lg group-hover:text-teal-700 mb-1">
                                        {{ $intern->nama }}
                                    </div>
                                    <div class="text-sm text-gray-600 space-y-1">
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-id-card text-gray-400 w-4"></i>
                                            <span>NIM: {{ $intern->nim }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-university text-gray-400 w-4"></i>
                                            <span>{{ $intern->asal_kampus }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-book text-gray-400 w-4"></i>
                                            <span>{{ $intern->program_studi }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div
                                        class="w-10 h-10 bg-teal-500 group-hover:bg-teal-600 rounded-full flex items-center justify-center smooth-transition">
                                        <i class="fas fa-chevron-right text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                    <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500 text-lg">Tidak ada peserta yang sudah diterima dan belum terdaftar</p>
                    <p class="text-gray-400 text-sm mt-2">Semua peserta yang diterima sudah terdaftar di database</p>
                </div>
            @endif
        </div>

        <form id="internForm" action="{{ route('accepted-interns.store') }}" method="POST">
            @csrf
            <input type="hidden" name="intern_id" id="intern_id" value="{{ old('intern_id') }}">

            <!-- Selected Intern Display -->
            <div id="selectedIntern" class="mb-8 {{ old('intern_id') ? '' : 'hidden' }}">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-check text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 font-heading">
                        Data Peserta Terpilih
                    </h3>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 border border-green-200 rounded-xl p-6" <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Nama Lengkap</label>
                        <p class="text-gray-900 font-semibold" id="display_nama"></p>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">NIM</label>
                        <p class="text-gray-900 font-semibold" id="display_nim"></p>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Asal Kampus</label>
                        <p class="text-gray-900 font-semibold" id="display_asal_kampus"></p>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Program Studi</label>
                        <p class="text-gray-900 font-semibold" id="display_program_studi"></p>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Email Kampus</label>
                        <p class="text-gray-900 font-semibold" id="display_email_kampus"></p>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">No WhatsApp</label>
                        <p class="text-gray-900 font-semibold" id="display_no_wa"></p>
                    </div>
                </div>
                <button type="button" onclick="clearSelection()"
                    class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                    <i class="fas fa-times-circle"></i>
                    <span>Ganti Pilihan</span>
                </button>
            </div>
    </div>

    @error('intern_id')
        <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
    @enderror

    <!-- Input Manual Section -->
    <div id="manualInputSection" class="{{ old('intern_id') ? '' : 'hidden' }}">
        <div class="flex items-center gap-3 mb-6 pt-8 border-t border-gray-100">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-alt text-blue-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 font-heading">
                Informasi Periode Magang
            </h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-gray-700">
                    Periode Magang
                </label>
                <div id="periode_display" class="px-4 py-3 bg-gray-100 border border-gray-200 rounded-xl text-gray-700">
                    Pilih intern terlebih dahulu
                </div>
                <p class="text-xs text-gray-500">Periode dari pendaftaran awal, tidak dapat diubah</p>
            </div>

            <div class="space-y-2">
                <label for="unit_magang_select" class="block text-sm font-semibold text-gray-700">
                    Unit Magang <span class="text-red-500">*</span>
                </label>
                <select id="unit_magang_select" onchange="handleUnitChange(this)"
                    class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('unit_magang') border-red-300 bg-red-50 @enderror">
                    <option value="">-- Pilih Unit Magang --</option>
                    <option value="Communication & Legal Reg I">Communication & Legal Reg I</option>
                    <option value="Procurement Reg I">Procurement Reg I</option>
                    <option value="Finance, Asset & Risk Management Reg I">Finance, Asset & Risk Management Reg I</option>
                    <option value="Human Capital Solution & Business Support Reg I">Human Capital Solution & Business
                        Support Reg I</option>
                    <option value="CSR & GS Reg I">CSR & GS Reg I</option>
                    <option value="Airport Commercial Development Reg I">Airport Commercial Development Reg I</option>
                    <option value="Airport Operation Control Center CGK">Airport Operation Control Center CGK</option>
                    <option value="Communication & Legal CGK">Communication & Legal CGK</option>
                    <option value="Quality & Safety Management System CGK">Quality & Safety Management System CGK</option>
                    <option value="Airport Customer Experience CGK">Airport Customer Experience CGK</option>
                    <option value="Airside Operation Services CGK">Airside Operation Services CGK</option>
                    <option value="Airport Rescue & Fire Fighting CGK">Airport Rescue & Fire Fighting CGK</option>
                    <option value="Airport Security Services CGK">Airport Security Services CGK</option>
                    <option value="Landside Operation Services & Support CGK">Landside Operation Services & Support CGK
                    </option>
                    <option value="Aero Business CGK">Aero Business CGK</option>
                    <option value="Non-Aero Business CGK">Non-Aero Business CGK</option>
                    <option value="Airport Electrical Services CGK">Airport Electrical Services CGK</option>
                    <option value="Airport Mechanical Services CGK">Airport Mechanical Services CGK</option>
                    <option value="Airport Electronics Services CGK">Airport Electronics Services CGK</option>
                    <option value="Airport Technology Services CGK">Airport Technology Services CGK</option>
                    <option value="Airside Facility & Support Services CGK">Airside Facility & Support Services CGK
                    </option>
                    <option value="Airport Building Facility Services CGK">Airport Building Facility Services CGK</option>
                    <option value="Asset Management CGK">Asset Management CGK</option>
                    <option value="General Services & CSR CGK">General Services & CSR CGK</option>
                    <option value="Procurement CGK">Procurement CGK</option>
                    <option value="Terminal 1 CGK">Terminal 1 CGK</option>
                    <option value="Terminal 2 CGK">Terminal 2 CGK</option>
                    <option value="Terminal 3 CGK">Terminal 3 CGK</option>
                    <option value="Airport Operation & Services - BDO">Airport Operation & Services - BDO</option>
                    <option value="Airport Technical - BDO">Airport Technical - BDO</option>
                    <option value="Airport Commercial - BDO">Airport Commercial - BDO</option>
                    <option value="Bussiness Support - BDO">Bussiness Support - BDO</option>
                    <option value="other">Lainnya (Tulis Sendiri)</option>
                </select>
                <input type="text" name="unit_magang" id="unit_magang" value="{{ old('unit_magang') }}"
                    placeholder="Tulis nama unit..."
                    class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition hidden @error('unit_magang') border-red-300 bg-red-50 @enderror">
                @error('unit_magang')
                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle text-xs"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <div class="mt-10 pt-8 border-t border-gray-100 flex flex-wrap gap-3">
            <button type="submit"
                class="group relative overflow-hidden bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-500/40">
                <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                <i class="fas fa-check text-sm"></i>
                <span>Simpan Data</span>
            </button>
            <a href="{{ route('accepted-interns.index') }}"
                class="group bg-gray-100 hover:bg-gray-200 text-gray-700 hover:text-gray-900 px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2">
                <i class="fas fa-arrow-left text-sm"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>
    </form>
    </div>

    <script>
        function selectIntern(intern) {
            // Set hidden input
            document.getElementById('intern_id').value = intern.id;

            // Display selected intern
            document.getElementById('display_nama').textContent = intern.nama;
            document.getElementById('display_nim').textContent = intern.nim;
            document.getElementById('display_asal_kampus').textContent = intern.asal_kampus;
            document.getElementById('display_program_studi').textContent = intern.program_studi;
            document.getElementById('display_email_kampus').textContent = intern.email_kampus || '-';
            document.getElementById('display_no_wa').textContent = intern.no_wa;

            // Display periode_magang from intern
            document.getElementById('periode_display').textContent = intern.periode_magang || 'Belum dipilih';

            // Show sections
            document.getElementById('selectedIntern').classList.remove('hidden');
            document.getElementById('manualInputSection').classList.remove('hidden');

            // Scroll to selected section
            document.getElementById('selectedIntern').scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        }

        function clearSelection() {
            document.getElementById('intern_id').value = '';
            document.getElementById('selectedIntern').classList.add('hidden');
            document.getElementById('manualInputSection').classList.add('hidden');
            document.getElementById('periode_display').textContent = 'Pilih intern terlebih dahulu';
            // Reset unit selection
            document.getElementById('unit_magang_select').value = '';
            document.getElementById('unit_magang').value = '';
            document.getElementById('unit_magang').classList.add('hidden');
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
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
    </script>
@endsection
