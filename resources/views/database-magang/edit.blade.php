@extends('layouts.sidebar')

@section('title', 'Edit Data Peserta Magang')
@section('page-title', 'Database Magang Final')

@section('content')
    <!-- Header Section -->
    <div class="mb-8 fade-in">
        <div class="flex items-center gap-4 mb-3">
            <div
                class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg shadow-yellow-500/30">
                <i class="fas fa-edit text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 font-heading">
                    Edit Data Peserta
                </h1>
            </div>
        </div>
        <p class="text-gray-500 text-lg font-light ml-16">
            Perbarui informasi peserta magang
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10 fade-in" style="animation-delay: 0.1s">
        <!-- Display Intern Info (Read Only) -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user text-blue-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 font-heading">
                    Data Peserta Magang
                </h3>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Nama Lengkap</label>
                        <p class="text-gray-900 font-semibold">{{ $acceptedIntern->intern->nama }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">NIM</label>
                        <p class="text-gray-900 font-semibold">{{ $acceptedIntern->intern->nim }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Asal Kampus</label>
                        <p class="text-gray-900 font-semibold">{{ $acceptedIntern->intern->asal_kampus }}</p>
                    </div>
                    <div>
                        <label class="block text-gray-600 text-sm mb-1">Program Studi</label>
                        <p class="text-gray-900 font-semibold">{{ $acceptedIntern->intern->program_studi }}</p>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('database-magang.update', $acceptedIntern->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="flex items-center gap-3 mb-6 pt-8 border-t border-gray-100">
                <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-green-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 font-heading">
                    Informasi Magang
                </h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label for="periode_magang" class="block text-sm font-semibold text-gray-700">
                        Periode Magang
                    </label>
                    <input type="text" name="periode_magang" id="periode_magang"
                        value="{{ old('periode_magang', $acceptedIntern->periode_magang ?? $acceptedIntern->intern->periode_magang) }}"
                        placeholder="Contoh: Januari - Maret 2026"
                        class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('periode_magang') border-red-300 bg-red-50 @enderror">
                    @error('periode_magang')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <i class="fas fa-exclamation-circle text-xs"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="unit_magang_select" class="block text-sm font-semibold text-gray-700">
                        Unit Magang <span class="text-red-500">*</span>
                    </label>
                    <select id="unit_magang_select" onchange="handleUnitChange(this)"
                        class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('unit_magang') border-red-300 bg-red-50 @enderror">
                        <option value="">-- Pilih Unit Magang --</option>
                        <option value="Communication & Legal Reg I"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Communication & Legal Reg I' ? 'selected' : '' }}>
                            Communication & Legal Reg I</option>
                        <option value="Procurement Reg I"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Procurement Reg I' ? 'selected' : '' }}>
                            Procurement Reg I</option>
                        <option value="Finance, Asset & Risk Management Reg I"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Finance, Asset & Risk Management Reg I' ? 'selected' : '' }}>
                            Finance, Asset & Risk Management Reg I</option>
                        <option value="Human Capital Solution & Business Support Reg I"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Human Capital Solution & Business Support Reg I' ? 'selected' : '' }}>
                            Human Capital Solution & Business Support Reg I</option>
                        <option value="CSR & GS Reg I"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'CSR & GS Reg I' ? 'selected' : '' }}>
                            CSR & GS Reg I</option>
                        <option value="Airport Commercial Development Reg I"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airport Commercial Development Reg I' ? 'selected' : '' }}>
                            Airport Commercial Development Reg I</option>
                        <option value="Airport Operation Control Center CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airport Operation Control Center CGK' ? 'selected' : '' }}>
                            Airport Operation Control Center CGK</option>
                        <option value="Communication & Legal CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Communication & Legal CGK' ? 'selected' : '' }}>
                            Communication & Legal CGK</option>
                        <option value="Quality & Safety Management System CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Quality & Safety Management System CGK' ? 'selected' : '' }}>
                            Quality & Safety Management System CGK</option>
                        <option value="Airport Customer Experience CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airport Customer Experience CGK' ? 'selected' : '' }}>
                            Airport Customer Experience CGK</option>
                        <option value="Airside Operation Services CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airside Operation Services CGK' ? 'selected' : '' }}>
                            Airside Operation Services CGK</option>
                        <option value="Airport Rescue & Fire Fighting CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airport Rescue & Fire Fighting CGK' ? 'selected' : '' }}>
                            Airport Rescue & Fire Fighting CGK</option>
                        <option value="Airport Security Services CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airport Security Services CGK' ? 'selected' : '' }}>
                            Airport Security Services CGK</option>
                        <option value="Landside Operation Services & Support CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Landside Operation Services & Support CGK' ? 'selected' : '' }}>
                            Landside Operation Services & Support CGK</option>
                        <option value="Aero Business CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Aero Business CGK' ? 'selected' : '' }}>
                            Aero Business CGK</option>
                        <option value="Non-Aero Business CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Non-Aero Business CGK' ? 'selected' : '' }}>
                            Non-Aero Business CGK</option>
                        <option value="Airport Electrical Services CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airport Electrical Services CGK' ? 'selected' : '' }}>
                            Airport Electrical Services CGK</option>
                        <option value="Airport Mechanical Services CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airport Mechanical Services CGK' ? 'selected' : '' }}>
                            Airport Mechanical Services CGK</option>
                        <option value="Airport Electronics Services CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airport Electronics Services CGK' ? 'selected' : '' }}>
                            Airport Electronics Services CGK</option>
                        <option value="Airport Technology Services CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airport Technology Services CGK' ? 'selected' : '' }}>
                            Airport Technology Services CGK</option>
                        <option value="Airside Facility & Support Services CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airside Facility & Support Services CGK' ? 'selected' : '' }}>
                            Airside Facility & Support Services CGK</option>
                        <option value="Airport Building Facility Services CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airport Building Facility Services CGK' ? 'selected' : '' }}>
                            Airport Building Facility Services CGK</option>
                        <option value="Asset Management CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Asset Management CGK' ? 'selected' : '' }}>
                            Asset Management CGK</option>
                        <option value="General Services & CSR CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'General Services & CSR CGK' ? 'selected' : '' }}>
                            General Services & CSR CGK</option>
                        <option value="Procurement CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Procurement CGK' ? 'selected' : '' }}>
                            Procurement CGK</option>
                        <option value="Terminal 1 CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Terminal 1 CGK' ? 'selected' : '' }}>
                            Terminal 1 CGK</option>
                        <option value="Terminal 2 CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Terminal 2 CGK' ? 'selected' : '' }}>
                            Terminal 2 CGK</option>
                        <option value="Terminal 3 CGK"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Terminal 3 CGK' ? 'selected' : '' }}>
                            Terminal 3 CGK</option>
                        <option value="Airport Operation & Services - BDO"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airport Operation & Services - BDO' ? 'selected' : '' }}>
                            Airport Operation & Services - BDO</option>
                        <option value="Airport Technical - BDO"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airport Technical - BDO' ? 'selected' : '' }}>
                            Airport Technical - BDO</option>
                        <option value="Airport Commercial - BDO"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Airport Commercial - BDO' ? 'selected' : '' }}>
                            Airport Commercial - BDO</option>
                        <option value="Bussiness Support - BDO"
                            {{ old('unit_magang', $acceptedIntern->unit_magang) == 'Bussiness Support - BDO' ? 'selected' : '' }}>
                            Bussiness Support - BDO</option>
                        <option value="other" id="other_option">Lainnya (Tulis Sendiri)</option>
                    </select>
                    <input type="text" name="unit_magang" id="unit_magang"
                        value="{{ old('unit_magang', $acceptedIntern->unit_magang) }}" placeholder="Tulis nama unit..."
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
                    class="group relative overflow-hidden bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2 shadow-lg shadow-yellow-500/30 hover:shadow-xl hover:shadow-yellow-500/40">
                    <span class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 smooth-transition"></span>
                    <i class="fas fa-check text-sm"></i>
                    <span>Update Data</span>
                </button>
                <a href="{{ route('database-magang.show', $acceptedIntern->id) }}"
                    class="group bg-gray-100 hover:bg-gray-200 text-gray-700 hover:text-gray-900 px-8 py-3.5 rounded-xl font-semibold smooth-transition flex items-center gap-2">
                    <i class="fas fa-arrow-left text-sm"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </form>
    </div>

    <script>
        const unitList = [
            'Communication & Legal Reg I',
            'Procurement Reg I',
            'Finance, Asset & Risk Management Reg I',
            'Human Capital Solution & Business Support Reg I',
            'CSR & GS Reg I',
            'Airport Commercial Development Reg I',
            'Airport Operation Control Center CGK',
            'Communication & Legal CGK',
            'Quality & Safety Management System CGK',
            'Airport Customer Experience CGK',
            'Airside Operation Services CGK',
            'Airport Rescue & Fire Fighting CGK',
            'Airport Security Services CGK',
            'Landside Operation Services & Support CGK',
            'Aero Business CGK',
            'Non-Aero Business CGK',
            'Airport Electrical Services CGK',
            'Airport Mechanical Services CGK',
            'Airport Electronics Services CGK',
            'Airport Technology Services CGK',
            'Airside Facility & Support Services CGK',
            'Airport Building Facility Services CGK',
            'Asset Management CGK',
            'General Services & CSR CGK',
            'Procurement CGK',
            'Terminal 1 CGK',
            'Terminal 2 CGK',
            'Terminal 3 CGK',
            'Airport Operation & Services - BDO',
            'Airport Technical - BDO',
            'Airport Commercial - BDO',
            'Bussiness Support - BDO'
        ];

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

        // Initialize on page load - check if current value is in the list
        document.addEventListener('DOMContentLoaded', function() {
            const selectEl = document.getElementById('unit_magang_select');
            const inputEl = document.getElementById('unit_magang');
            const currentValue = inputEl.value;

            if (currentValue && !unitList.includes(currentValue)) {
                // Value is not in the list - show "other" option with text input
                selectEl.value = 'other';
                inputEl.classList.remove('hidden');
                inputEl.required = true;
            } else if (currentValue) {
                // Value is in the list - select it
                selectEl.value = currentValue;
            }
        });
    </script>
@endsection
