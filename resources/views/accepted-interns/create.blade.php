@extends('layouts.app')

@section('title', 'Tambah Data ke Database Magang')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Tambah Data ke Database Magang</h1>
        <p class="text-gray-600">Cari dan pilih anak magang yang sudah diterima</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <!-- Search Section -->
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Cari Anak Magang</h3>
            <div class="relative">
                <input type="text" id="searchInput" placeholder="Cari nama, NIM, atau kampus..."
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <div id="searchResults"
                    class="hidden absolute z-10 w-full mt-2 bg-white border rounded-lg shadow-lg max-h-96 overflow-y-auto">
                </div>
            </div>
        </div>

        <form id="internForm" action="{{ route('accepted-interns.store') }}" method="POST">
            @csrf
            <input type="hidden" name="intern_id" id="intern_id" value="{{ old('intern_id') }}">

            <!-- Selected Intern Display -->
            <div id="selectedIntern" class="mb-6 {{ old('intern_id') ? '' : 'hidden' }}">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Data Anak Magang Terpilih</h3>
                <div class="bg-gray-50 border rounded-lg p-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                    <button type="button" onclick="clearSelection()" class="mt-4 text-red-600 hover:text-red-800 text-sm">
                        <i class="fas fa-times"></i> Ganti Pilihan
                    </button>
                </div>
            </div>

            @error('intern_id')
                <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
            @enderror

            <!-- Input Manual Section -->
            <div id="manualInputSection" class="{{ old('intern_id') ? '' : 'hidden' }}">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Periode Magang</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="periode_awal" class="block text-gray-700 font-medium mb-2">
                            Periode Awal <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="periode_awal" id="periode_awal" value="{{ old('periode_awal') }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('periode_awal') border-red-500 @enderror"
                            required>
                        @error('periode_awal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="periode_akhir" class="block text-gray-700 font-medium mb-2">
                            Periode Akhir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="periode_akhir" id="periode_akhir" value="{{ old('periode_akhir') }}"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('periode_akhir') border-red-500 @enderror"
                            required>
                        @error('periode_akhir')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="unit_magang" class="block text-gray-700 font-medium mb-2">
                            Unit Magang <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="unit_magang" id="unit_magang" value="{{ old('unit_magang') }}"
                            placeholder="Contoh: IT Department"
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('unit_magang') border-red-500 @enderror"
                            required>
                        @error('unit_magang')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex space-x-4">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('accepted-interns.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded">
                        <i class="fas fa-arrow-left"></i> Kembali
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
