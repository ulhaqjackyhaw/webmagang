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
        <nav class="bg-blue-600 text-white shadow-lg">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between py-4">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-xl font-bold">Sistem Magang</h1>
                        <div class="hidden md:flex space-x-4">
                            <a href="{{ route('dashboard') }}" class="hover:bg-blue-700 px-3 py-2 rounded">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                            @if (auth()->user()->role === 'tu' || auth()->user()->role === 'hc' || auth()->user()->role === 'admin')
                                <a href="{{ route('interns.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded">
                                    <i class="fas fa-users"></i> Data Apply Magang
                                </a>
                            @endif
                            @if (auth()->user()->role === 'hc' || auth()->user()->role === 'admin')
                                <a href="{{ route('accepted-interns.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded">
                                    <i class="fas fa-database"></i> Database Magang
                                </a>
                            @endif
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('users.index') }}" class="hover:bg-blue-700 px-3 py-2 rounded">
                                    <i class="fas fa-user-cog"></i> Kelola User
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
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>

</html>
