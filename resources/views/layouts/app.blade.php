<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Manajemen Magang')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    @auth
        <nav
            class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 text-white shadow-2xl relative overflow-hidden">
            <!-- Decorative elements -->
            <div class="absolute top-0 left-0 w-64 h-64 bg-white opacity-5 rounded-full -mt-32 -ml-32"></div>
            <div class="absolute bottom-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mb-32 -mr-32"></div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="flex items-center justify-between py-4">
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white bg-opacity-20 p-2 rounded-xl backdrop-blur-sm">
                                <i class="fas fa-graduation-cap text-xl"></i>
                            </div>
                            <h1 class="text-xl font-bold">Sistem Magang</h1>
                        </div>
                        <div class="hidden md:flex space-x-2">
                            <a href="{{ route('dashboard') }}"
                                class="hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-300 flex items-center space-x-2 backdrop-blur-sm">
                                <i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                            @if (auth()->user()->role === 'tu' || auth()->user()->role === 'hc' || auth()->user()->role === 'admin')
                                <a href="{{ route('interns.index') }}"
                                    class="hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-300 flex items-center space-x-2 backdrop-blur-sm">
                                    <i class="fas fa-users"></i>
                                    <span>Data Apply Magang</span>
                                </a>
                            @endif
                            @if (auth()->user()->role === 'hc' || auth()->user()->role === 'admin')
                                <a href="{{ route('accepted-interns.index') }}"
                                    class="hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-300 flex items-center space-x-2 backdrop-blur-sm">
                                    <i class="fas fa-database"></i>
                                    <span>Database Magang</span>
                                </a>
                            @endif
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('users.index') }}"
                                    class="hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-300 flex items-center space-x-2 backdrop-blur-sm">
                                    <i class="fas fa-user-cog"></i>
                                    <span>Kelola User</span>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm">
                            <i class="fas fa-user"></i> {{ auth()->user()->name }}
                            <span
                                class="text-xs bg-blue-800 px-2 py-1 rounded">{{ strtoupper(auth()->user()->role) }}</span>
                        </span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    @endauth

    <main class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div
                class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg mb-6 shadow-lg transform animate-slide-in flex items-center">
                <div class="bg-green-500 text-white rounded-full w-10 h-10 flex items-center justify-center mr-4">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div class="flex-1">
                    <p class="font-semibold">Berhasil!</p>
                    <p class="text-sm">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div
                class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg mb-6 shadow-lg transform animate-slide-in flex items-center">
                <div class="bg-red-500 text-white rounded-full w-10 h-10 flex items-center justify-center mr-4">
                    <i class="fas fa-exclamation-circle text-xl"></i>
                </div>
                <div class="flex-1">
                    <p class="font-semibold">Error!</p>
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <style>
        @keyframes slide-in {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .animate-slide-in {
            animation: slide-in 0.3s ease-out;
        }
    </style>
</body>

</html>
