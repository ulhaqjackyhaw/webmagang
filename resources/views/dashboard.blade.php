@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600">Selamat datang, {{ auth()->user()->name }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Apply Magang</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-blue-100 p-4 rounded-full">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Menunggu</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-yellow-100 p-4 rounded-full">
                    <i class="fas fa-clock text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Diterima</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['approved'] }}</p>
                </div>
                <div class="bg-green-100 p-4 rounded-full">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Ditolak</p>
                    <p class="text-3xl font-bold text-red-600">{{ $stats['rejected'] }}</p>
                </div>
                <div class="bg-red-100 p-4 rounded-full">
                    <i class="fas fa-times-circle text-red-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Menu Cepat</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @if (auth()->user()->role === 'tu')
                <a href="{{ route('interns.create') }}"
                    class="bg-blue-50 hover:bg-blue-100 border border-blue-200 rounded-lg p-4 transition">
                    <i class="fas fa-plus-circle text-blue-600 text-2xl mb-2"></i>
                    <h3 class="font-semibold text-gray-800">Tambah Data Magang</h3>
                    <p class="text-gray-600 text-sm">Input data peserta magang baru</p>
                </a>
            @endif

            <a href="{{ route('interns.index') }}"
                class="bg-green-50 hover:bg-green-100 border border-green-200 rounded-lg p-4 transition">
                <i class="fas fa-list text-green-600 text-2xl mb-2"></i>
                <h3 class="font-semibold text-gray-800">Lihat Data Magang</h3>
                <p class="text-gray-600 text-sm">Lihat semua data magang</p>
            </a>

            @if (auth()->user()->role === 'hc' || auth()->user()->role === 'admin')
                <a href="{{ route('accepted-interns.index') }}"
                    class="bg-teal-50 hover:bg-teal-100 border border-teal-200 rounded-lg p-4 transition">
                    <i class="fas fa-database text-teal-600 text-2xl mb-2"></i>
                    <h3 class="font-semibold text-gray-800">Database Magang</h3>
                    <p class="text-gray-600 text-sm">Data peserta magang terdaftar</p>
                </a>

                <a href="{{ route('interns.export') }}?status=all"
                    class="bg-purple-50 hover:bg-purple-100 border border-purple-200 rounded-lg p-4 transition">
                    <i class="fas fa-file-excel text-purple-600 text-2xl mb-2"></i>
                    <h3 class="font-semibold text-gray-800">Export Data</h3>
                    <p class="text-gray-600 text-sm">Export ke Excel</p>
                </a>
            @endif

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('users.index') }}"
                    class="bg-orange-50 hover:bg-orange-100 border border-orange-200 rounded-lg p-4 transition">
                    <i class="fas fa-user-cog text-orange-600 text-2xl mb-2"></i>
                    <h3 class="font-semibold text-gray-800">Kelola User</h3>
                    <p class="text-gray-600 text-sm">Tambah/edit user TU & HC</p>
                </a>
            @endif
        </div>
    </div>
@endsection
