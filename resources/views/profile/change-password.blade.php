@extends('layouts.app')

@section('title', 'Ganti Password')

@section('content')
    <!-- Header Section -->
    <div class="mb-8">
        <h1
            class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent flex items-center">
            <i class="fas fa-key mr-3 text-purple-600"></i>
            Ganti Password
        </h1>
        <p class="text-gray-600 mt-2 flex items-center">
            <i class="fas fa-lock mr-2 text-purple-500"></i>
            Perbarui password akun Anda untuk keamanan
        </p>
    </div>

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <!-- Security Notice -->
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border-l-4 border-yellow-400 p-4 rounded-lg mb-6">
                <div class="flex items-start">
                    <i class="fas fa-shield-alt text-yellow-600 text-2xl mr-3 mt-1"></i>
                    <div>
                        <h4 class="font-bold text-gray-800 mb-1">Tips Keamanan Password:</h4>
                        <ul class="text-sm text-gray-700 space-y-1">
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Minimal 8 karakter</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Gunakan kombinasi huruf besar, kecil, angka,
                                dan simbol</li>
                            <li><i class="fas fa-check text-green-500 mr-2"></i>Jangan gunakan informasi pribadi yang mudah
                                ditebak</li>
                        </ul>
                    </div>
                </div>
            </div>

            <form action="{{ route('profile.update-password') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <!-- Current Password -->
                    <div>
                        <label for="current_password" class="block text-gray-700 font-bold mb-3 flex items-center">
                            <i class="fas fa-lock text-gray-500 mr-2"></i>
                            Password Saat Ini <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="current_password" id="current_password"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('current_password') border-red-500 @enderror"
                                required>
                            <button type="button" onclick="togglePassword('current_password')"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-gray-700 font-bold mb-3 flex items-center">
                            <i class="fas fa-key text-purple-500 mr-2"></i>
                            Password Baru <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('password') border-red-500 @enderror"
                                required>
                            <button type="button" onclick="togglePassword('password')"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-2 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Password minimal 8 karakter
                        </p>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-gray-700 font-bold mb-3 flex items-center">
                            <i class="fas fa-check-circle text-purple-500 mr-2"></i>
                            Konfirmasi Password Baru <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all"
                                required>
                            <button type="button" onclick="togglePassword('password_confirmation')"
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 pt-6 border-t-2 border-gray-200 flex flex-wrap gap-3">
                    <button type="submit"
                        class="group bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center space-x-2">
                        <i class="fas fa-save group-hover:scale-110 transition-transform"></i>
                        <span class="font-semibold">Ubah Password</span>
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

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = event.currentTarget.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
