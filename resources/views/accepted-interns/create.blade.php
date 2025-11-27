@extends('layouts.app')

@section('title', 'Tambah Data ke Database Magang')

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
                    Tambah ke Database Magang
                </h1>
            </div>
        </div>
        <p class="text-gray-500 text-lg font-light ml-16">
            Cari dan pilih peserta magang yang sudah diterima
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-10 fade-in" style="animation-delay: 0.1s">
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-search text-teal-600"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 font-heading">
                    Cari Peserta Magang
                </h3>
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="searchInput" placeholder="Ketik nama, NIM, atau kampus untuk mencari..."
                    class="input-modern w-full pl-12 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white focus:border-transparent smooth-transition">
                <div id="searchResults"
                    class="hidden absolute z-10 w-full mt-2 bg-white border-2 border-gray-100 rounded-xl shadow-2xl max-h-96 overflow-y-auto">
                </div>
            </div>
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-2">
                <label for="periode_awal" class="block text-sm font-semibold text-gray-700">
                    Periode Awal <span class="text-red-500">*</span>
                </label>
                <input type="date" name="periode_awal" id="periode_awal" value="{{ old('periode_awal') }}"
                    class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('periode_awal') border-red-300 bg-red-50 @enderror"
                    required>
                @error('periode_awal')
                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle text-xs"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="periode_akhir" class="block text-sm font-semibold text-gray-700">
                    Periode Akhir <span class="text-red-500">*</span>
                </label>
                <input type="date" name="periode_akhir" id="periode_akhir" value="{{ old('periode_akhir') }}"
                    class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('periode_akhir') border-red-300 bg-red-50 @enderror"
                    required>
                @error('periode_akhir')
                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                        <i class="fas fa-exclamation-circle text-xs"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="unit_magang" class="block text-sm font-semibold text-gray-700">
                    Unit Magang <span class="text-red-500">*</span>
                </label>
                <input type="text" name="unit_magang" id="unit_magang" value="{{ old('unit_magang') }}"
                    placeholder="Contoh: IT Department"
                    class="input-modern w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white focus:border-transparent smooth-transition @error('unit_magang') border-red-300 bg-red-50 @enderror"
                    required>
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
        let debounceTimer;
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');

        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            const query = this.value.trim();

            if (query.length < 2) {
                searchResults.classList.add('hidden');
                return;
            }

            debounceTimer = setTimeout(() => {
                fetch(`{{ route('accepted-interns.search') }}?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        displaySearchResults(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }, 300);
        });

        function displaySearchResults(interns) {
            if (interns.length === 0) {
                searchResults.innerHTML =
                    '<div class="p-4 text-gray-500 text-center">Tidak ada data ditemukan</div>';
                searchResults.classList.remove('hidden');
                return;
            }

            let html = '<div class="divide-y">';
            interns.forEach(intern => {
                html += `
                    <div class="p-4 hover:bg-gray-50 cursor-pointer" onclick='selectIntern(${JSON.stringify(intern)})'>
                        <div class="font-semibold text-gray-900">${intern.nama}</div>
                        <div class="text-sm text-gray-600">NIM: ${intern.nim} | ${intern.asal_kampus}</div>
                        <div class="text-xs text-gray-500">${intern.program_studi}</div>
                    </div>
                `;
            });
            html += '</div>';

            searchResults.innerHTML = html;
            searchResults.classList.remove('hidden');
        }

        function selectIntern(intern) {
            // Hide search results
            searchResults.classList.add('hidden');
            searchInput.value = '';

            // Set hidden input
            document.getElementById('intern_id').value = intern.id;

            // Display selected intern
            document.getElementById('display_nama').textContent = intern.nama;
            document.getElementById('display_nim').textContent = intern.nim;
            document.getElementById('display_asal_kampus').textContent = intern.asal_kampus;
            document.getElementById('display_program_studi').textContent = intern.program_studi;
            document.getElementById('display_email_kampus').textContent = intern.email_kampus || '-';
            document.getElementById('display_no_wa').textContent = intern.no_wa;

            // Show sections
            document.getElementById('selectedIntern').classList.remove('hidden');
            document.getElementById('manualInputSection').classList.remove('hidden');
        }

        function clearSelection() {
            document.getElementById('intern_id').value = '';
            document.getElementById('selectedIntern').classList.add('hidden');
            document.getElementById('manualInputSection').classList.add('hidden');
            searchInput.focus();
        }

        // Close search results when clicking outside
        document.addEventListener('click', function(event) {
            if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
                searchResults.classList.add('hidden');
            }
        });
    </script>
@endsection
