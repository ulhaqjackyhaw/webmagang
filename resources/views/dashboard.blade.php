@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Welcome Section with Gradient -->
    <div
        class="mb-8 bg-gradient-to-r from-blue-600 via-blue-500 to-indigo-600 rounded-2xl shadow-xl p-8 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-40 h-40 bg-white opacity-10 rounded-full"></div>
        <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-48 h-48 bg-white opacity-5 rounded-full"></div>
        <div class="relative z-10">
            <h1 class="text-4xl font-bold mb-2 animate-fade-in">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
            <p class="text-blue-100 text-lg">Dashboard Sistem Manajemen Magang</p>
            <div class="mt-4 inline-flex items-center bg-white bg-opacity-20 rounded-full px-4 py-2 backdrop-blur-sm">
                <i class="fas fa-user-tag mr-2"></i>
                <span class="font-semibold">{{ ucfirst(auth()->user()->role) }}</span>
            </div>
        </div>
    </div>

    <!-- Statistics Cards with Modern Design -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Apply Card -->
        <div
            class="group bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-6 text-white relative overflow-hidden">
            <div
                class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full group-hover:scale-150 transition-transform duration-500">
            </div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white bg-opacity-20 p-3 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-blue-100 text-sm font-medium">Total Apply</p>
                        <p class="text-4xl font-bold mt-1">{{ $stats['total'] }}</p>
                    </div>
                </div>
                <div class="flex items-center text-blue-100 text-sm">
                    <i class="fas fa-chart-line mr-2"></i>
                    <span>Total Pendaftar Magang</span>
                </div>
            </div>
        </div>

        <!-- Menunggu Card -->
        <div
            class="group bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-6 text-white relative overflow-hidden">
            <div
                class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full group-hover:scale-150 transition-transform duration-500">
            </div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white bg-opacity-20 p-3 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-clock text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-yellow-100 text-sm font-medium">Menunggu</p>
                        <p class="text-4xl font-bold mt-1">{{ $stats['pending'] }}</p>
                    </div>
                </div>
                <div class="flex items-center text-yellow-100 text-sm">
                    <i class="fas fa-hourglass-half mr-2"></i>
                    <span>Belum Diproses</span>
                </div>
            </div>
        </div>

        <!-- Diterima Card -->
        <div
            class="group bg-gradient-to-br from-green-500 to-green-600 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-6 text-white relative overflow-hidden">
            <div
                class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full group-hover:scale-150 transition-transform duration-500">
            </div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white bg-opacity-20 p-3 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-green-100 text-sm font-medium">Diterima</p>
                        <p class="text-4xl font-bold mt-1">{{ $stats['approved'] }}</p>
                    </div>
                </div>
                <div class="flex items-center text-green-100 text-sm">
                    <i class="fas fa-thumbs-up mr-2"></i>
                    <span>Telah Disetujui</span>
                </div>
            </div>
        </div>

        <!-- Ditolak Card -->
        <div
            class="group bg-gradient-to-br from-red-500 to-red-600 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-6 text-white relative overflow-hidden">
            <div
                class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full group-hover:scale-150 transition-transform duration-500">
            </div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white bg-opacity-20 p-3 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-times-circle text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-red-100 text-sm font-medium">Ditolak</p>
                        <p class="text-4xl font-bold mt-1">{{ $stats['rejected'] }}</p>
                    </div>
                </div>
                <div class="flex items-center text-red-100 text-sm">
                    <i class="fas fa-ban mr-2"></i>
                    <span>Tidak Disetujui</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Menu Section -->
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                    Menu Cepat
                </h2>
                <p class="text-gray-600 text-sm mt-1">Akses fitur utama dengan cepat</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @if (auth()->user()->role === 'tu')
                <a href="{{ route('interns.create') }}"
                    class="group relative bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-500 hover:to-blue-600 border-2 border-blue-200 hover:border-blue-600 rounded-xl p-6 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl overflow-hidden">
                    <div
                        class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-blue-300 opacity-20 rounded-full group-hover:scale-150 transition-transform duration-500">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="bg-blue-500 group-hover:bg-white w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition-colors duration-300 shadow-lg">
                            <i
                                class="fas fa-plus-circle text-white group-hover:text-blue-600 text-2xl transition-colors duration-300"></i>
                        </div>
                        <h3
                            class="font-bold text-gray-800 group-hover:text-white text-lg mb-2 transition-colors duration-300">
                            Tambah Data Magang</h3>
                        <p class="text-gray-600 group-hover:text-blue-100 text-sm transition-colors duration-300">Input data
                            peserta magang baru</p>
                        <div
                            class="mt-4 flex items-center text-blue-600 group-hover:text-white text-sm font-medium transition-colors duration-300">
                            <span>Mulai Input</span>
                            <i
                                class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform duration-300"></i>
                        </div>
                    </div>
                </a>
            @endif

            <a href="{{ route('interns.index') }}"
                class="group relative bg-gradient-to-br from-green-50 to-green-100 hover:from-green-500 hover:to-green-600 border-2 border-green-200 hover:border-green-600 rounded-xl p-6 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl overflow-hidden">
                <div
                    class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-green-300 opacity-20 rounded-full group-hover:scale-150 transition-transform duration-500">
                </div>
                <div class="relative z-10">
                    <div
                        class="bg-green-500 group-hover:bg-white w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition-colors duration-300 shadow-lg">
                        <i
                            class="fas fa-list text-white group-hover:text-green-600 text-2xl transition-colors duration-300"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-white text-lg mb-2 transition-colors duration-300">
                        Lihat Data Pengajuan Magang</h3>
                    <p class="text-gray-600 group-hover:text-green-100 text-sm transition-colors duration-300">Lihat semua
                        data pengajuan magang</p>
                    <div
                        class="mt-4 flex items-center text-green-600 group-hover:text-white text-sm font-medium transition-colors duration-300">
                        <span>Buka Data</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </div>
                </div>
            </a>

            @if (auth()->user()->role === 'hc' || auth()->user()->role === 'admin')
                <a href="{{ route('accepted-interns.index') }}"
                    class="group relative bg-gradient-to-br from-teal-50 to-teal-100 hover:from-teal-500 hover:to-teal-600 border-2 border-teal-200 hover:border-teal-600 rounded-xl p-6 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl overflow-hidden">
                    <div
                        class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-teal-300 opacity-20 rounded-full group-hover:scale-150 transition-transform duration-500">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="bg-teal-500 group-hover:bg-white w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition-colors duration-300 shadow-lg">
                            <i
                                class="fas fa-database text-white group-hover:text-teal-600 text-2xl transition-colors duration-300"></i>
                        </div>
                        <h3
                            class="font-bold text-gray-800 group-hover:text-white text-lg mb-2 transition-colors duration-300">
                            Database Peserta Magang</h3>
                        <p class="text-gray-600 group-hover:text-teal-100 text-sm transition-colors duration-300">Data
                            peserta magang terdaftar</p>
                        <div
                            class="mt-4 flex items-center text-teal-600 group-hover:text-white text-sm font-medium transition-colors duration-300">
                            <span>Lihat Database</span>
                            <i
                                class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform duration-300"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('interns.export') }}?status=all"
                    class="group relative bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-500 hover:to-purple-600 border-2 border-purple-200 hover:border-purple-600 rounded-xl p-6 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl overflow-hidden">
                    <div
                        class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-purple-300 opacity-20 rounded-full group-hover:scale-150 transition-transform duration-500">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="bg-purple-500 group-hover:bg-white w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition-colors duration-300 shadow-lg">
                            <i
                                class="fas fa-file-excel text-white group-hover:text-purple-600 text-2xl transition-colors duration-300"></i>
                        </div>
                        <h3
                            class="font-bold text-gray-800 group-hover:text-white text-lg mb-2 transition-colors duration-300">
                            Export Data</h3>
                        <p class="text-gray-600 group-hover:text-purple-100 text-sm transition-colors duration-300">Export
                            ke Excel</p>
                        <div
                            class="mt-4 flex items-center text-purple-600 group-hover:text-white text-sm font-medium transition-colors duration-300">
                            <span>Download Excel</span>
                            <i
                                class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform duration-300"></i>
                        </div>
                    </div>
                </a>
            @endif

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('users.index') }}"
                    class="group relative bg-gradient-to-br from-orange-50 to-orange-100 hover:from-orange-500 hover:to-orange-600 border-2 border-orange-200 hover:border-orange-600 rounded-xl p-6 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl overflow-hidden">
                    <div
                        class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-orange-300 opacity-20 rounded-full group-hover:scale-150 transition-transform duration-500">
                    </div>
                    <div class="relative z-10">
                        <div
                            class="bg-orange-500 group-hover:bg-white w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition-colors duration-300 shadow-lg">
                            <i
                                class="fas fa-user-cog text-white group-hover:text-orange-600 text-2xl transition-colors duration-300"></i>
                        </div>
                        <h3
                            class="font-bold text-gray-800 group-hover:text-white text-lg mb-2 transition-colors duration-300">
                            Kelola User</h3>
                        <p class="text-gray-600 group-hover:text-orange-100 text-sm transition-colors duration-300">
                            Tambah/edit user TU & HC</p>
                        <div
                            class="mt-4 flex items-center text-orange-600 group-hover:text-white text-sm font-medium transition-colors duration-300">
                            <span>Kelola User</span>
                            <i
                                class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform duration-300"></i>
                        </div>
                    </div>
                </a>
            @endif
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
@endsection
