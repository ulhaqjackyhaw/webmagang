@extends('layouts.sidebar')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Welcome Section with Gradient -->
    <div class="mb-8 rounded-2xl shadow-xl p-8 text-white relative overflow-hidden"
        style="background: linear-gradient(to right, #20B2AA, #1a8f89, #20B2AA);">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-40 h-40 bg-white opacity-10 rounded-full"></div>
        <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-48 h-48 bg-white opacity-5 rounded-full"></div>
        <div class="relative z-10">
            <h1 class="text-4xl font-bold mb-2 animate-fade-in">Selamat Datang, {{ auth()->user()->name }}!</h1>
            <p class="text-white text-opacity-90 text-lg">Dashboard URSHIPORTS (Your Internship Programme at Injourney
                Airports Kantor Regional I)</p>
            <div class="mt-4 inline-flex items-center bg-white bg-opacity-20 rounded-full px-4 py-2 backdrop-blur-sm">
                <i class="fas fa-user-tag mr-2"></i>
                <span class="font-semibold">{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</span>
            </div>
        </div>
    </div>

    <!-- Statistics Cards with Modern Design -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Apply Card -->
        <div class="group rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 p-6 text-white relative overflow-hidden"
            style="background: linear-gradient(to bottom right, #20B2AA, #1a8f89);">
            <div
                class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full group-hover:scale-150 transition-transform duration-500">
            </div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white bg-opacity-20 p-3 rounded-xl backdrop-blur-sm">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <div class="text-right">
                        <p class="text-white text-opacity-90 text-sm font-medium">Total Apply</p>
                        <p class="text-4xl font-bold mt-1">{{ $stats['total'] }}</p>
                    </div>
                </div>
                <div class="flex items-center text-white text-opacity-90 text-sm">
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

    <!-- Approval Status Cards (for HC/Admin) -->
    @if (auth()->user()->role === 'hc' || auth()->user()->role === 'admin')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Menunggu Div Head</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $acceptanceStats['sent_to_divhead'] ?? 0 }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-paper-plane text-blue-500"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Menunggu Deputy</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $acceptanceStats['sent_to_deputy'] ?? 0 }}</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-user-tie text-purple-500"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Approval Final</p>
                        <p class="text-2xl font-bold text-green-600">{{ $acceptanceStats['approved_deputy'] ?? 0 }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check-double text-green-500"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-4 border-l-4 border-red-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Ditolak</p>
                        <p class="text-2xl font-bold text-red-600">{{ $acceptanceStats['rejected'] ?? 0 }}</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <i class="fas fa-times text-red-500"></i>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Gender Distribution Chart -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-venus-mars text-pink-500 mr-2"></i>
                Distribusi Gender
            </h3>
            <div class="relative h-64">
                <canvas id="genderChart"></canvas>
            </div>
            <div class="flex justify-center gap-6 mt-4">
                <div class="flex items-center">
                    <div class="w-4 h-4 rounded-full bg-blue-500 mr-2"></div>
                    <span class="text-sm text-gray-600">Laki-laki</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 rounded-full bg-pink-500 mr-2"></div>
                    <span class="text-sm text-gray-600">Perempuan</span>
                </div>
            </div>
        </div>

        <!-- Program Studi Chart -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-graduation-cap text-indigo-500 mr-2"></i>
                Top 10 Program Studi
            </h3>
            <div class="relative h-64">
                <canvas id="prodiChart"></canvas>
            </div>
        </div>

        <!-- Asal Kampus Chart -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-university text-teal-500 mr-2"></i>
                Top 10 Asal Kampus
            </h3>
            <div class="relative h-64">
                <canvas id="kampusChart"></canvas>
            </div>
        </div>

        <!-- Monthly Trend Chart -->
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-chart-line text-green-500 mr-2"></i>
                Trend Pendaftaran Bulanan
            </h3>
            <div class="relative h-64">
                <canvas id="trendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Quick Menu Section -->
    <div class="bg-white rounded-2xl shadow-xl p-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-list text-yellow-500 mr-3"></i>
                    Menu
                </h2>
                <p class="text-gray-600 text-sm mt-1">Akses fitur utama dengan cepat</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('interns.index') }}"
                class="group relative rounded-xl p-6 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl overflow-hidden border-2"
                style="background: linear-gradient(to bottom right, rgba(32, 178, 170, 0.1), rgba(32, 178, 170, 0.2)); border-color: #20B2AA;">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 opacity-20 rounded-full group-hover:scale-150 transition-transform duration-500"
                    style="background-color: #20B2AA;">
                </div>
                <div class="relative z-10">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition-colors duration-300 shadow-lg group-hover:bg-white"
                        style="background-color: #20B2AA;">
                        <i
                            class="fas fa-list text-white text-2xl transition-colors duration-300 group-hover:text-[#20B2AA]"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 group-hover:text-white text-lg mb-2 transition-colors duration-300">
                        Lihat Data Pengajuan Magang</h3>
                    <p
                        class="text-gray-600 group-hover:text-white group-hover:text-opacity-90 text-sm transition-colors duration-300">
                        Lihat semua
                        data pengajuan magang</p>
                    <div class="mt-4 flex items-center text-sm font-medium transition-colors duration-300 group-hover:text-white"
                        style="color: #20B2AA;">
                        <span>Buka Data</span>
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </div>
                </div>
            </a>

            @if (auth()->user()->role === 'hc' || auth()->user()->role === 'admin')
                <a href="{{ route('accepted-interns.index') }}"
                    class="group relative rounded-xl p-6 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl overflow-hidden border-2"
                    style="background: linear-gradient(to bottom right, rgba(32, 178, 170, 0.1), rgba(32, 178, 170, 0.2)); border-color: #20B2AA;">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 opacity-20 rounded-full group-hover:scale-150 transition-transform duration-500"
                        style="background-color: #20B2AA;">
                    </div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition-colors duration-300 shadow-lg group-hover:bg-white"
                            style="background-color: #20B2AA;">
                            <i
                                class="fas fa-database text-white text-2xl transition-colors duration-300 group-hover:text-[#20B2AA]"></i>
                        </div>
                        <h3
                            class="font-bold text-gray-800 group-hover:text-white text-lg mb-2 transition-colors duration-300">
                            Database Peserta Magang</h3>
                        <p
                            class="text-gray-600 group-hover:text-white group-hover:text-opacity-90 text-sm transition-colors duration-300">
                            Data peserta magang terdaftar</p>
                        <div class="mt-4 flex items-center text-sm font-medium transition-colors duration-300 group-hover:text-white"
                            style="color: #20B2AA;">
                            <span>Lihat Database</span>
                            <i
                                class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform duration-300"></i>
                        </div>
                    </div>
                </a>

                <a href="{{ route('interns.export') }}?status=all"
                    class="group relative rounded-xl p-6 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl overflow-hidden border-2"
                    style="background: linear-gradient(to bottom right, rgba(32, 178, 170, 0.1), rgba(32, 178, 170, 0.2)); border-color: #20B2AA;">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 opacity-20 rounded-full group-hover:scale-150 transition-transform duration-500"
                        style="background-color: #20B2AA;">
                    </div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl flex items-center justify-center mb-4 transition-colors duration-300 shadow-lg group-hover:bg-white"
                            style="background-color: #20B2AA;">
                            <i
                                class="fas fa-file-excel text-white text-2xl transition-colors duration-300 group-hover:text-[#20B2AA]"></i>
                        </div>
                        <h3
                            class="font-bold text-gray-800 group-hover:text-white text-lg mb-2 transition-colors duration-300">
                            Export Data Apply(Diterima/Ditolak)</h3>
                        <p
                            class="text-gray-600 group-hover:text-white group-hover:text-opacity-90 text-sm transition-colors duration-300">
                            Export ke Excel</p>
                        <div class="mt-4 flex items-center text-sm font-medium transition-colors duration-300 group-hover:text-white"
                            style="color: #20B2AA;">
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gender Chart
            const genderCtx = document.getElementById('genderChart').getContext('2d');
            new Chart(genderCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        data: [{{ $stats['male'] ?? 0 }}, {{ $stats['female'] ?? 0 }}],
                        backgroundColor: ['#3B82F6', '#EC4899'],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    cutout: '60%'
                }
            });

            // Program Studi Chart
            const prodiCtx = document.getElementById('prodiChart').getContext('2d');
            new Chart(prodiCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($programStudiData->pluck('program_studi')) !!},
                    datasets: [{
                        label: 'Jumlah',
                        data: {!! json_encode($programStudiData->pluck('total')) !!},
                        backgroundColor: '#6366F1',
                        borderRadius: 6,
                        barThickness: 20
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 10
                                }
                            }
                        }
                    }
                }
            });

            // Kampus Chart
            const kampusCtx = document.getElementById('kampusChart').getContext('2d');
            new Chart(kampusCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($kampusData->pluck('asal_kampus')) !!},
                    datasets: [{
                        label: 'Jumlah',
                        data: {!! json_encode($kampusData->pluck('total')) !!},
                        backgroundColor: '#14B8A6',
                        borderRadius: 6,
                        barThickness: 20
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    indexAxis: 'y',
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 10
                                }
                            }
                        }
                    }
                }
            });

            // Monthly Trend Chart
            const trendCtx = document.getElementById('trendChart').getContext('2d');
            new Chart(trendCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($monthlyTrend->pluck('month_name')) !!},
                    datasets: [{
                        label: 'Pendaftar',
                        data: {!! json_encode($monthlyTrend->pluck('total')) !!},
                        borderColor: '#22C55E',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#22C55E',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
