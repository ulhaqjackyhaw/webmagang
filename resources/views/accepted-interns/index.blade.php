@extends('layouts.app')

@section('title', 'Database Magang Diterima')

@section('content')
    <!-- Header Section with Modern Design -->
    <div class="mb-8 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
        <div>
            <h1 class="text-4xl font-bold text-blue-600 flex items-center">
                <i class="fas fa-database mr-3"></i>
                Database Peserta Magang
            </h1>
            <p class="text-gray-600 mt-2 flex items-center">
                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                Data peserta magang yang telah terdaftar
            </p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('accepted-interns.create') }}"
                class="group bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                <i class="fas fa-plus-circle group-hover:rotate-90 transition-transform duration-300"></i>
                <span class="font-semibold">Tambah Data</span>
            </a>

            <!-- Export Button -->
            <a href="{{ route('accepted-interns.export', $selectedUnit ? ['unit' => $selectedUnit] : []) }}"
                class="group bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                <i class="fas fa-file-excel group-hover:scale-110 transition-transform duration-300"></i>
                <span class="font-semibold">
                    @if ($selectedUnit)
                        Export {{ $selectedUnit }}
                    @else
                        Export Semua Data
                    @endif
                </span>
            </a>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="mb-6">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg p-6 text-white mb-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold">Total Peserta Magang</h2>
                    <p class="text-blue-100">Keseluruhan peserta yang terdaftar</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full px-8 py-4">
                    <p class="text-5xl font-bold">{{ $totalInterns }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">
                    <i class="fas fa-building text-blue-600"></i> Daftar Unit Magang
                </h3>
                @if ($selectedUnit)
                    <a href="{{ route('accepted-interns.index') }}"
                        class="text-sm bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">
                        <i class="fas fa-times"></i> Hapus Filter
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                @forelse($unitStats as $stat)
                    <a href="{{ route('accepted-interns.index', ['unit' => $stat->unit_magang]) }}"
                        class="group border-2 rounded-lg p-4 transition-all hover:shadow-lg cursor-pointer
                            {{ $selectedUnit == $stat->unit_magang ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-blue-300' }}">
                        <div class="flex flex-col items-center text-center">
                            <div
                                class="w-16 h-16 rounded-full flex items-center justify-center mb-2
                                {{ $selectedUnit == $stat->unit_magang ? 'bg-blue-500' : 'bg-gray-100 group-hover:bg-blue-100' }}">
                                <i
                                    class="fas fa-users 
                                    {{ $selectedUnit == $stat->unit_magang ? 'text-white' : 'text-gray-600 group-hover:text-blue-600' }} 
                                    text-2xl"></i>
                            </div>
                            <h4 class="font-semibold text-gray-800 mb-1 line-clamp-2">{{ $stat->unit_magang }}</h4>
                            <div class="flex items-center">
                                <span
                                    class="text-2xl font-bold 
                                    {{ $selectedUnit == $stat->unit_magang ? 'text-blue-600' : 'text-gray-700' }}">
                                    {{ $stat->total }}
                                </span>
                                <span class="text-xs text-gray-500 ml-1">peserta</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center text-gray-500 py-8">
                        Belum ada data unit magang
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-800">
                @if ($selectedUnit)
                    <i class="fas fa-filter text-blue-600"></i>
                    Data Peserta di Unit: <span class="text-blue-600">{{ $selectedUnit }}</span>
                @else
                    <i class="fas fa-list text-gray-600"></i> Semua Data Peserta Magang
                @endif
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kampus
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit
                            Magang</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Periode
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($acceptedInterns as $index => $acceptedIntern)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $acceptedIntern->intern->nama }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $acceptedIntern->intern->nim }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $acceptedIntern->intern->asal_kampus }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $acceptedIntern->unit_magang }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $acceptedIntern->periode_awal->format('d/m/Y') }} -
                                {{ $acceptedIntern->periode_akhir->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('accepted-interns.show', $acceptedIntern->id) }}"
                                    class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('accepted-interns.edit', $acceptedIntern->id) }}"
                                    class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('accepted-interns.destroy', $acceptedIntern->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                @if ($selectedUnit)
                                    Tidak ada data peserta magang di unit <strong>{{ $selectedUnit }}</strong>
                                @else
                                    Belum ada data peserta magang yang terdaftar
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
