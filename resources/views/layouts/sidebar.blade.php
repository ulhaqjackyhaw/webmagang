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
    <!-- Chart.js for dashboard graphics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'heading': ['Poppins', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#20B2AA',
                        'primary-dark': '#1a8f89',
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

        .sidebar-link {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background: rgba(32, 178, 170, 0.1);
            border-left: 3px solid #20B2AA;
            padding-left: 13px;
        }

        .sidebar-link.active {
            background: rgba(32, 178, 170, 0.15);
            border-left: 3px solid #20B2AA;
            color: #20B2AA;
            font-weight: 600;
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

        /* Sidebar Transitions */
        #sidebar {
            transition: all 0.3s ease-in-out;
        }

        /* Desktop collapsed state */
        @media (min-width: 1024px) {
            #sidebar.collapsed {
                width: 80px;
            }

            #sidebar.collapsed .sidebar-text,
            #sidebar.collapsed .sidebar-section-title,
            #sidebar.collapsed .sidebar-logo-text,
            #sidebar.collapsed .sidebar-user-info,
            #sidebar.collapsed .sidebar-badge {
                display: none;
            }

            #sidebar.collapsed .sidebar-link {
                justify-content: center;
                padding-left: 0;
                padding-right: 0;
            }

            #sidebar.collapsed .sidebar-link:hover {
                padding-left: 0;
                border-left: none;
                border-bottom: 3px solid #20B2AA;
            }

            #sidebar.collapsed .sidebar-link.active {
                border-left: none;
                border-bottom: 3px solid #20B2AA;
            }

            #sidebar.collapsed .sidebar-link i {
                margin: 0;
                font-size: 1.25rem;
            }

            #sidebar.collapsed .sidebar-logo-icon {
                margin: 0 auto;
            }

            #sidebar.collapsed .sidebar-user-avatar {
                margin: 0 auto;
            }

            #main-content {
                transition: margin-left 0.3s ease-in-out;
            }

            #main-content.expanded {
                margin-left: 80px;
            }
        }

        /* Mobile state */
        @media (max-width: 1023px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar.mobile-open {
                transform: translateX(0);
            }
        }

        /* Tooltip for collapsed sidebar */
        .sidebar-tooltip {
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background: #1f2937;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            margin-left: 0.5rem;
            z-index: 100;
        }

        #sidebar.collapsed .sidebar-link:hover .sidebar-tooltip {
            opacity: 1;
            visibility: visible;
        }

        /* Responsive table wrapper */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            max-width: 100%;
        }

        .table-responsive table {
            min-width: 800px;
        }

        /* Desktop table container - scroll only table, not page */
        .desktop-table {
            max-width: 100%;
            overflow: hidden;
        }

        .desktop-table .overflow-x-auto {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Prevent page horizontal scroll */
        #main-content {
            overflow-x: hidden;
            max-width: 100%;
        }

        #main-content main {
            overflow-x: hidden;
            max-width: 100%;
        }

        /* Mobile card view for tables */
        .mobile-card {
            display: none;
        }

        @media (max-width: 768px) {
            .desktop-table {
                display: none;
            }

            .mobile-card {
                display: block;
            }
        }

        @media (min-width: 769px) {
            .desktop-table {
                display: block;
            }

            .mobile-card {
                display: none;
            }
        }

        /* Responsive form */
        .form-responsive {
            display: grid;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .form-responsive {
                grid-template-columns: repeat(2, 1fr);
            }

            .form-responsive .full-width {
                grid-column: span 2;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">
    @auth
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-xl flex flex-col">
                <!-- Logo Section -->
                <div class="h-16 flex items-center px-4 border-b border-gray-200 flex-shrink-0"
                    style="background: linear-gradient(to right, #20B2AA, #1a8f89);">
                    <div class="flex items-center space-x-3 w-full">
                        <div class="sidebar-logo-icon bg-white bg-opacity-20 p-2 rounded-lg flex-shrink-0">
                            <i class="fas fa-graduation-cap text-white text-lg"></i>
                        </div>
                        <div class="sidebar-logo-text overflow-hidden">
                            <h1 class="text-white font-bold text-lg truncate">URSHIPORTS</h1>
                            <p class="text-white text-opacity-80 text-xs truncate leading-tight">Your Internship
                                Programme<br>at Injourney Airports</p>
                        </div>
                    </div>
                </div>

                <!-- User Info -->
                <div class="p-4 border-b border-gray-200 bg-gray-50 flex-shrink-0">
                    <div class="flex items-center space-x-3">
                        <div class="sidebar-user-avatar w-10 h-10 rounded-full flex items-center justify-center text-white flex-shrink-0"
                            style="background: linear-gradient(to right, #20B2AA, #1a8f89);">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="sidebar-user-info flex-1 min-w-0 overflow-hidden">
                            <p class="text-sm font-semibold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">
                                @switch(auth()->user()->role)
                                    @case('admin')
                                        Administrator
                                    @break

                                    @case('hc')
                                        Human Capital
                                    @break

                                    @case('div_head')
                                        Division Head
                                    @break

                                    @case('deputy')
                                        Deputy HC
                                    @break

                                    @default
                                        User
                                @endswitch
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                    <!-- Dashboard - All Roles -->
                    <a href="{{ route('dashboard') }}"
                        class="sidebar-link relative flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home w-5 text-center"></i>
                        <span class="sidebar-text">Dashboard</span>
                        <span class="sidebar-tooltip">Dashboard</span>
                    </a>

                    @if (in_array(auth()->user()->role, ['hc', 'admin']))
                        <!-- HC Menu Section -->
                        <div class="pt-4 pb-2 sidebar-section-title">
                            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu HC</p>
                        </div>

                        <a href="{{ route('interns.index') }}"
                            class="sidebar-link relative flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('interns.*') ? 'active' : '' }}">
                            <i class="fas fa-file-alt w-5 text-center"></i>
                            <span class="sidebar-text">Data Apply Magang</span>
                            <span class="sidebar-tooltip">Data Apply Magang</span>
                        </a>

                        <a href="{{ route('accepted-interns.index') }}"
                            class="sidebar-link relative flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('accepted-interns.*') ? 'active' : '' }}">
                            <i class="fas fa-tasks w-5 text-center"></i>
                            <span class="sidebar-text">Monitoring Approval</span>
                            <span class="sidebar-tooltip">Monitoring Approval</span>
                        </a>

                        <a href="{{ route('database-magang.index') }}"
                            class="sidebar-link relative flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('database-magang.*') ? 'active' : '' }}">
                            <i class="fas fa-database w-5 text-center"></i>
                            <span class="sidebar-text">Database Magang</span>
                            <span class="sidebar-tooltip">Database Magang</span>
                        </a>
                    @endif

                    @if (in_array(auth()->user()->role, ['div_head', 'admin']))
                        <!-- Div Head Menu Section -->
                        <div class="pt-4 pb-2 sidebar-section-title">
                            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu Div Head</p>
                        </div>

                        <a href="{{ route('approvals.divhead.index') }}"
                            class="sidebar-link relative flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('approvals.divhead.*') ? 'active' : '' }}">
                            <i class="fas fa-clipboard-check w-5 text-center"></i>
                            <span class="sidebar-text">Approval Pengajuan</span>
                            @php
                                $pendingDivHead = \App\Models\AcceptedIntern::where(
                                    'approval_status',
                                    'sent_to_divhead',
                                )->count();
                            @endphp
                            @if ($pendingDivHead > 0)
                                <span
                                    class="sidebar-badge ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $pendingDivHead }}</span>
                            @endif
                            <span class="sidebar-tooltip">Approval Pengajuan</span>
                        </a>
                    @endif

                    @if (in_array(auth()->user()->role, ['deputy', 'admin']))
                        <!-- Deputy Menu Section -->
                        <div class="pt-4 pb-2 sidebar-section-title">
                            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu Deputy</p>
                        </div>

                        <a href="{{ route('approvals.deputy.index') }}"
                            class="sidebar-link relative flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('approvals.deputy.*') ? 'active' : '' }}">
                            <i class="fas fa-stamp w-5 text-center"></i>
                            <span class="sidebar-text">Final Approval</span>
                            @php
                                $pendingDeputy = \App\Models\AcceptedIntern::where(
                                    'approval_status',
                                    'sent_to_deputy',
                                )->count();
                            @endphp
                            @if ($pendingDeputy > 0)
                                <span
                                    class="sidebar-badge ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $pendingDeputy }}</span>
                            @endif
                            <span class="sidebar-tooltip">Final Approval</span>
                        </a>
                    @endif

                    @if (auth()->user()->role === 'admin')
                        <!-- Admin Menu Section -->
                        <div class="pt-4 pb-2 sidebar-section-title">
                            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu Admin</p>
                        </div>

                        <a href="{{ route('users.index') }}"
                            class="sidebar-link relative flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('users.*') ? 'active' : '' }}">
                            <i class="fas fa-users-cog w-5 text-center"></i>
                            <span class="sidebar-text">Kelola User</span>
                            <span class="sidebar-tooltip">Kelola User</span>
                        </a>
                    @endif

                    <!-- Profile Section - All Roles -->
                    <div class="pt-4 pb-2 sidebar-section-title">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Akun</p>
                    </div>

                    <a href="{{ route('profile.show') }}"
                        class="sidebar-link relative flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="fas fa-user-circle w-5 text-center"></i>
                        <span class="sidebar-text">Profil Saya</span>
                        <span class="sidebar-tooltip">Profil Saya</span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit"
                            class="sidebar-link relative w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 hover:border-l-red-500">
                            <i class="fas fa-sign-out-alt w-5 text-center"></i>
                            <span class="sidebar-text">Logout</span>
                            <span class="sidebar-tooltip">Logout</span>
                        </button>
                    </form>
                </nav>

                <!-- Collapse Toggle Button (Desktop) -->
                <div class="p-4 border-t border-gray-200 flex-shrink-0 hidden lg:block">
                    <button onclick="toggleSidebarDesktop()"
                        class="w-full flex items-center justify-center space-x-2 px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 transition-colors">
                        <i id="collapse-icon" class="fas fa-chevron-left"></i>
                        <span class="sidebar-text text-sm">Tutup Menu</span>
                    </button>
                </div>
            </aside>

            <!-- Overlay for mobile -->
            <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"
                onclick="toggleSidebarMobile()"></div>

            <!-- Main Content -->
            <div id="main-content" class="flex-1 flex flex-col min-h-screen lg:ml-64">
                <!-- Top Navbar -->
                <header class="h-16 bg-white shadow-sm flex items-center justify-between px-4 md:px-6 sticky top-0 z-30">
                    <div class="flex items-center space-x-4">
                        <!-- Mobile menu button -->
                        <button onclick="toggleSidebarMobile()" class="lg:hidden text-gray-600 hover:text-gray-800 p-2">
                            <i class="fas fa-bars text-xl"></i>
                        </button>

                        <!-- Desktop collapse button -->
                        <button onclick="toggleSidebarDesktop()"
                            class="hidden lg:block text-gray-600 hover:text-gray-800 p-2">
                            <i id="navbar-collapse-icon" class="fas fa-bars text-xl"></i>
                        </button>

                        <div class="hidden sm:block">
                            <h2 class="text-lg font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2 md:space-x-4">
                        <!-- Back to Landing -->
                        <a href="{{ route('public.landing') }}" target="_blank"
                            class="text-gray-500 hover:text-primary transition-colors p-2" title="Lihat Landing Page">
                            <i class="fas fa-external-link-alt"></i>
                        </a>

                        <!-- Current Date -->
                        <div class="hidden md:flex items-center text-sm text-gray-500">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            {{ now()->format('d M Y') }}
                        </div>

                        <!-- User dropdown for mobile -->
                        <div class="lg:hidden flex items-center">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm"
                                style="background: linear-gradient(to right, #20B2AA, #1a8f89);">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1 p-4 md:p-6 overflow-auto">
                    @if (session('success'))
                        <div
                            class="bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 text-green-700 px-4 md:px-6 py-4 rounded-lg mb-6 shadow-lg flex items-center fade-in">
                            <div
                                class="bg-green-500 text-white rounded-full w-8 h-8 md:w-10 md:h-10 flex items-center justify-center mr-3 md:mr-4 flex-shrink-0">
                                <i class="fas fa-check-circle text-lg md:text-xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold">Berhasil!</p>
                                <p class="text-sm truncate">{{ session('success') }}</p>
                            </div>
                            <button onclick="this.parentElement.remove()"
                                class="text-green-700 hover:text-green-900 ml-2 flex-shrink-0">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div
                            class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 text-red-700 px-4 md:px-6 py-4 rounded-lg mb-6 shadow-lg flex items-center fade-in">
                            <div
                                class="bg-red-500 text-white rounded-full w-8 h-8 md:w-10 md:h-10 flex items-center justify-center mr-3 md:mr-4 flex-shrink-0">
                                <i class="fas fa-exclamation-circle text-lg md:text-xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold">Error!</p>
                                <p class="text-sm truncate">{{ session('error') }}</p>
                            </div>
                            <button onclick="this.parentElement.remove()"
                                class="text-red-700 hover:text-red-900 ml-2 flex-shrink-0">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    @yield('content')
                </main>

                <!-- Footer -->
                <footer class="bg-white border-t border-gray-200 py-4 px-4 md:px-6">
                    <div
                        class="flex flex-col sm:flex-row justify-between items-center text-xs md:text-sm text-gray-500 gap-2">
                        <p class="text-center sm:text-left">&copy; {{ date('Y') }} URSHIPORTS - Injourney Airports
                            Regional I</p>
                        <p>Human Capital Development</p>
                    </div>
                </footer>
            </div>
        </div>
    @else
        <!-- Guest Layout (login page) -->
        <main class="min-h-screen">
            @yield('content')
        </main>
    @endauth

    <script>
        // Check and apply saved sidebar state on page load
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (sidebarCollapsed && window.innerWidth >= 1024) {
                document.getElementById('sidebar').classList.add('collapsed');
                document.getElementById('main-content').classList.add('expanded');
                document.getElementById('main-content').classList.remove('lg:ml-64');
                document.getElementById('collapse-icon').classList.remove('fa-chevron-left');
                document.getElementById('collapse-icon').classList.add('fa-chevron-right');
            }
        });

        // Toggle sidebar for desktop (collapse to icons)
        function toggleSidebarDesktop() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const collapseIcon = document.getElementById('collapse-icon');

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            mainContent.classList.toggle('lg:ml-64');

            // Update icon direction
            if (sidebar.classList.contains('collapsed')) {
                collapseIcon.classList.remove('fa-chevron-left');
                collapseIcon.classList.add('fa-chevron-right');
                localStorage.setItem('sidebarCollapsed', 'true');
            } else {
                collapseIcon.classList.remove('fa-chevron-right');
                collapseIcon.classList.add('fa-chevron-left');
                localStorage.setItem('sidebarCollapsed', 'false');
            }
        }

        // Toggle sidebar for mobile (slide in/out)
        function toggleSidebarMobile() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            sidebar.classList.toggle('mobile-open');
            overlay.classList.toggle('hidden');
        }

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth >= 1024) {
                // Desktop: close mobile menu if open
                sidebar.classList.remove('mobile-open');
                overlay.classList.add('hidden');
            }
        });

        // Close mobile sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth < 1024 &&
                sidebar.classList.contains('mobile-open') &&
                !sidebar.contains(event.target) &&
                !event.target.closest('button[onclick="toggleSidebarMobile()"]')) {
                sidebar.classList.remove('mobile-open');
                overlay.classList.add('hidden');
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
