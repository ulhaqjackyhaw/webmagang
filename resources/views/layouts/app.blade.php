<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Manajemen Magang')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'heading': ['Poppins', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#2563eb',
                        'accent': '#06b6d4',
                        'success': '#10b981',
                        'warning': '#f59e0b',
                        'danger': '#ef4444',
                    }
                }
            }
        }
    </script>
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
        }

        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        .input-modern {
            transition: all 0.2s ease;
        }

        .input-modern:focus {
            transform: translateY(-1px);
        }

        body {
            overflow-x: hidden;
        }

        /* Prevent horizontal scroll while allowing dropdown to show */
        main {
            max-width: 100vw;
            overflow-x: hidden;
        }
    </style>
</head>

<body class="bg-gray-100">
    @auth
        <nav class="text-white shadow-2xl relative"
            style="z-index: 1000; overflow: visible; background: linear-gradient(to right, #20B2AA, #1a8f89, #20B2AA);">
            <!-- Decorative elements -->
            <div class="absolute top-0 left-0 w-64 h-64 bg-white opacity-5 rounded-full -mt-32 -ml-32 pointer-events-none">
            </div>
            <div
                class="absolute bottom-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mb-32 -mr-32 pointer-events-none">
            </div>

            <div class="container mx-auto px-4 relative z-10">
                <div class="flex items-center justify-between py-4">
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-3">
                            <div class="bg-white bg-opacity-20 p-2 rounded-xl backdrop-blur-sm">
                                <i class="fas fa-graduation-cap text-xl"></i>
                            </div>
                            <h1 class="text-xl font-bold">URSHIPORTS</h1>
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
                        <div class="relative" id="profileDropdown" style="z-index: 9999;">
                            <button onclick="toggleProfileDropdown(event)" type="button"
                                class="flex items-center space-x-2 hover:bg-white hover:bg-opacity-20 px-4 py-2 rounded-lg transition-all duration-300 backdrop-blur-sm">
                                <div class="bg-white bg-opacity-30 w-8 h-8 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <div class="text-left hidden md:block">
                                    <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                                    <p class="text-xs opacity-90">{{ strtoupper(auth()->user()->role) }}</p>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform duration-300"
                                    id="profileChevron"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="profileDropdownMenu"
                                class="hidden absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border border-gray-200"
                                style="z-index: 9999 !important;">
                                <div
                                    class="p-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-t-xl">
                                    <p class="font-bold text-gray-800">{{ auth()->user()->name }}</p>
                                    <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                                    <span class="inline-block mt-2 px-3 py-1 bg-blue-600 text-white text-xs rounded-full">
                                        {{ strtoupper(auth()->user()->role) }}
                                    </span>
                                </div>
                                <div class="py-2">
                                    <a href="{{ route('profile.show') }}"
                                        class="flex items-center space-x-3 px-4 py-3 hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200 group/item">
                                        <i
                                            class="fas fa-user-circle text-blue-600 group-hover/item:scale-110 transition-transform"></i>
                                        <span class="text-gray-700 font-medium">Lihat Profile</span>
                                    </a>
                                    <a href="{{ route('profile.edit') }}"
                                        class="flex items-center space-x-3 px-4 py-3 hover:bg-gradient-to-r hover:from-green-50 hover:to-emerald-50 transition-all duration-200 group/item">
                                        <i
                                            class="fas fa-edit text-green-600 group-hover/item:scale-110 transition-transform"></i>
                                        <span class="text-gray-700 font-medium">Edit Profile</span>
                                    </a>
                                    <a href="{{ route('profile.edit-password') }}"
                                        class="flex items-center space-x-3 px-4 py-3 hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 transition-all duration-200 group/item">
                                        <i
                                            class="fas fa-key text-purple-600 group-hover/item:scale-110 transition-transform"></i>
                                        <span class="text-gray-700 font-medium">Ganti Password</span>
                                    </a>
                                    <hr class="my-2">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center space-x-3 px-4 py-3 hover:bg-gradient-to-r hover:from-red-50 hover:to-pink-50 transition-all duration-200 group/item text-left">
                                            <i
                                                class="fas fa-sign-out-alt text-red-600 group-hover/item:scale-110 transition-transform"></i>
                                            <span class="text-gray-700 font-medium">Logout</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
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

        /* Profile dropdown styles */
        #profileDropdownMenu {
            transition: opacity 0.2s ease-out, transform 0.2s ease-out;
        }

        #profileDropdownMenu.hidden {
            display: none;
        }

        #profileDropdownMenu:not(.hidden) {
            display: block;
            animation: fadeIn 0.2s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        // Profile Dropdown Toggle
        function toggleProfileDropdown(event) {
            event.stopPropagation();
            const dropdown = document.getElementById('profileDropdownMenu');
            const chevron = document.getElementById('profileChevron');

            console.log('Dropdown toggle - Current state:', dropdown.classList.contains('hidden'));

            dropdown.classList.toggle('hidden');
            chevron.classList.toggle('rotate-180');

            console.log('Dropdown toggle - New state:', dropdown.classList.contains('hidden'));
        }

        // Close profile dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const profileDropdown = document.getElementById('profileDropdown');
            const dropdown = document.getElementById('profileDropdownMenu');
            const chevron = document.getElementById('profileChevron');

            if (profileDropdown && !profileDropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
                chevron.classList.remove('rotate-180');
            }
        });

        // Close on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const dropdown = document.getElementById('profileDropdownMenu');
                const chevron = document.getElementById('profileChevron');
                if (dropdown) {
                    dropdown.classList.add('hidden');
                    chevron.classList.remove('rotate-180');
                }
            }
        });
    </script>
</body>

</html>
