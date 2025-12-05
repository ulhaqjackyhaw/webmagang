@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="fixed inset-0 w-full h-full bg-cover bg-center bg-no-repeat"
        style="background-image: url('/images/T3bg.jpg'); background-attachment: fixed;">
        <!-- Dark overlay for better text readability -->
        <div class="absolute inset-0 bg-black bg-opacity-40"></div>

        <div class="min-h-screen flex items-center justify-center relative z-10 px-4">
            <div
                class="relative bg-white bg-opacity-20 backdrop-blur-lg p-10 rounded-3xl shadow-2xl w-full max-w-md transform hover:scale-105 transition-transform duration-300 border border-white border-opacity-30">
                <!-- Logo/Icon -->
                <div class="text-center mb-8">
                    <div
                        class="inline-flex items-center justify-center w-60 h-30 bg-white bg-opacity-90 rounded-2xl shadow-lg mb-3 transform hover:rotate-6 transition-transform duration-300 overflow-hidden">
                        <img src="/images/company-logo.png" alt="Company Logo" class="w-40 h-20 object-contain" />
                    </div>
                    <h1 class="text-4xl font-bold text-white tracking-wide mb-1 drop-shadow-lg">URSHIPORTS</h1>
                    <p class="text-sm text-white font-medium drop-shadow-md">Your Internship Programme</p>
                    <p class="text-sm text-white font-medium drop-shadow-md">at Injourney Airports Kantor Regional I</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="group">
                        <label for="email" class="block text-white font-medium mb-2 flex items-center drop-shadow-md">
                            <i class="fas fa-envelope text-white mr-2"></i>
                            Email
                        </label>
                        <div class="relative">
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                class="w-full px-4 py-3 bg-white bg-opacity-30 backdrop-blur-sm border-2 border-white border-opacity-40 rounded-xl focus:outline-none focus:ring-2 focus:ring-white focus:border-white focus:bg-opacity-40 transition-all duration-300 text-gray-900 placeholder-gray-600 placeholder-opacity-80 @error('email') border-red-300 @enderror"
                                placeholder="nama@email.com" required autofocus>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i
                                    class="fas fa-user text-white text-opacity-70 group-focus-within:text-white transition-colors"></i>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-red-200 text-sm mt-2 flex items-center drop-shadow-md">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="group">
                        <label for="password" class="block text-white font-medium mb-2 flex items-center drop-shadow-md">
                            <i class="fas fa-lock text-white mr-2"></i>
                            Password
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-3 pr-12 bg-white bg-opacity-30 backdrop-blur-sm border-2 border-white border-opacity-40 rounded-xl focus:outline-none focus:ring-2 focus:ring-white focus:border-white focus:bg-opacity-40 transition-all duration-300 text-gray-900 placeholder-gray-600 placeholder-opacity-80 @error('password') border-red-300 @enderror"
                                placeholder="••••••••" required>
                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer hover:text-white transition-colors">
                                <i id="toggleIcon" class="fas fa-eye text-white text-opacity-70"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-200 text-sm mt-2 flex items-center drop-shadow-md">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <label class="flex items-center cursor-pointer group">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 text-blue-600 border-white border-opacity-50 rounded focus:ring-white focus:ring-2 transition bg-white bg-opacity-20">
                            <span class="ml-2 text-white text-sm group-hover:text-white drop-shadow-md">Ingat
                                Saya</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-white bg-opacity-90 backdrop-blur-sm text-blue-600 py-3 rounded-xl hover:bg-opacity-100 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>

                <!-- Footer Info -->
                <div class="mt-6 text-center">
                    <p class="text-white text-xs drop-shadow-md">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Sistem ini dilindungi dan aman
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
                toggleIcon.classList.add('text-white');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
                toggleIcon.classList.remove('text-white');
            }
        }
    </script>
@endsection
