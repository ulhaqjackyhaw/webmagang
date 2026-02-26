@extends('layouts.sidebar')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profil')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <h1
            class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent flex items-center">
            <i class="fas fa-user-edit mr-3 text-blue-600"></i>
            Edit Profile
        </h1>
        <p class="text-gray-600 mt-2 flex items-center">
            <i class="fas fa-pencil-alt mr-2 text-blue-500"></i>
            Perbarui informasi akun Anda
        </p>
    </div>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Name Input -->
                    <div>
                        <label for="name" class="block text-gray-700 font-bold mb-3 flex items-center">
                            <i class="fas fa-user text-blue-500 mr-2"></i>
                            Nama Lengkap <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                            required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-gray-700 font-bold mb-3 flex items-center">
                            <i class="fas fa-envelope text-blue-500 mr-2"></i>
                            Email <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                            required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Role (Read Only) -->
                    <div>
                        <label class="block text-gray-700 font-bold mb-3 flex items-center">
                            <i class="fas fa-shield-alt text-gray-500 mr-2"></i>
                            Role / Jabatan
                        </label>
                        <div class="bg-gray-100 px-4 py-3 rounded-xl border-2 border-gray-200">
                            <p class="text-gray-700 font-semibold capitalize">
                                @if ($user->role === 'admin')
                                    <span class="text-red-600"><i class="fas fa-crown mr-1"></i> Administrator</span>
                                @elseif($user->role === 'hc')
                                    <span class="text-blue-600"><i class="fas fa-user-tie mr-1"></i> Human Capital</span>
                                @elseif($user->role === 'div_head')
                                    <span class="text-green-600"><i class="fas fa-user-shield mr-1"></i> Division
                                        Head</span>
                                @elseif($user->role === 'deputy')
                                    <span class="text-orange-600"><i class="fas fa-user-cog mr-1"></i> Deputy HC</span>
                                @endif
                            </p>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Role tidak dapat diubah sendiri. Hubungi administrator jika perlu perubahan.
                        </p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t-2 border-gray-200 flex flex-wrap gap-3">
                    <button type="submit"
                        class="group bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-save group-hover:scale-110 transition-transform"></i>
                        <span class="font-semibold">Simpan Perubahan</span>
                    </button>

                    <a href="{{ route('profile.show') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-times"></i>
                        <span class="font-semibold">Batal</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
