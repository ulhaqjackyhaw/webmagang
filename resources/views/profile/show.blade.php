@extends('layouts.app')

@section('title', 'Profile Saya')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <h1
            class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent flex items-center">
            <i class="fas fa-user-circle mr-3 text-indigo-600"></i>
            Profile Saya
        </h1>
        <p class="text-gray-600 mt-2 flex items-center">
            <i class="fas fa-info-circle mr-2 text-indigo-500"></i>
            Informasi akun dan pengaturan
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Card -->
        <div class="lg:col-span-1">
            <div
                class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow-xl p-8 text-center border-2 border-indigo-200">
                <div class="mb-6">
                    <div
                        class="w-32 h-32 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full mx-auto flex items-center justify-center shadow-lg">
                        <i class="fas fa-user text-6xl text-white"></i>
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $user->name }}</h2>
                <p class="text-gray-600 mb-1 flex items-center justify-center">
                    <i class="fas fa-envelope mr-2 text-indigo-500"></i>
                    {{ $user->email }}
                </p>
                <div class="mt-4">
                    @if ($user->role === 'admin')
                        <span
                            class="px-4 py-2 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-full text-sm font-bold shadow-lg">
                            <i class="fas fa-crown mr-1"></i> Administrator
                        </span>
                    @elseif($user->role === 'hc')
                        <span
                            class="px-4 py-2 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-full text-sm font-bold shadow-lg">
                            <i class="fas fa-user-tie mr-1"></i> Human Capital
                        </span>
                    @else
                        <span
                            class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-full text-sm font-bold shadow-lg">
                            <i class="fas fa-user-check mr-1"></i> Tata Usaha
                        </span>
                    @endif
                </div>
                <div class="mt-6 text-sm text-gray-500">
                    <p class="flex items-center justify-center mb-1">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Bergabung: {{ $user->created_at->format('d M Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Profile Details & Actions -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center border-b-2 border-indigo-200 pb-4">
                    <i class="fas fa-info-circle text-indigo-500 mr-3"></i>
                    Informasi Akun
                </h3>

                <div class="space-y-6">
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-6 border-l-4 border-indigo-500">
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            <i class="fas fa-user mr-2 text-indigo-500"></i>
                            Nama Lengkap
                        </label>
                        <p class="text-xl font-bold text-gray-800">{{ $user->name }}</p>
                    </div>

                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-6 border-l-4 border-purple-500">
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            <i class="fas fa-envelope mr-2 text-purple-500"></i>
                            Email
                        </label>
                        <p class="text-xl font-bold text-gray-800">{{ $user->email }}</p>
                    </div>

                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-6 border-l-4 border-blue-500">
                        <label class="block text-sm font-medium text-gray-600 mb-2">
                            <i class="fas fa-shield-alt mr-2 text-blue-500"></i>
                            Role / Jabatan
                        </label>
                        <p class="text-xl font-bold text-gray-800 capitalize">
                            @if ($user->role === 'admin')
                                Administrator
                            @elseif($user->role === 'hc')
                                Human Capital
                            @else
                                Tata Usaha
                            @endif
                        </p>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t-2 border-gray-200">
                    <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-cog text-gray-600 mr-2"></i>
                        Pengaturan Akun
                    </h4>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('profile.edit') }}"
                            class="group bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                            <i class="fas fa-edit group-hover:scale-110 transition-transform"></i>
                            <span class="font-semibold">Edit Profile</span>
                        </a>

                        <a href="{{ route('profile.edit-password') }}"
                            class="group bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                            <i class="fas fa-key group-hover:rotate-12 transition-transform"></i>
                            <span class="font-semibold">Ganti Password</span>
                        </a>

                        <a href="{{ route('dashboard') }}"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                            <i class="fas fa-arrow-left"></i>
                            <span class="font-semibold">Kembali</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
