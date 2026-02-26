@extends('layouts.sidebar')

@section('title', 'Kelola User')
@section('page-title', 'Kelola User')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">Kelola User</h1>
            <p class="text-gray-600">Manajemen akun TU dan HC</p>
        </div>
        <a href="{{ route('users.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-center">
            <i class="fas fa-plus"></i> Tambah User
        </a>
    </div>

    <!-- Mobile Card View -->
    <div class="mobile-card space-y-4">
        @forelse($users as $index => $user)
            <div class="bg-white rounded-xl shadow-md p-4">
                <div class="flex justify-between items-start mb-3">
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg">{{ $user->name }}</h3>
                        <p class="text-gray-500 text-sm">{{ $user->email }}</p>
                    </div>
                    @if ($user->role === 'admin')
                        <span
                            class="px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">ADMIN</span>
                    @elseif($user->role === 'hc')
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">HC</span>
                    @elseif($user->role === 'div_head')
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">DIV
                            HEAD</span>
                    @elseif($user->role === 'deputy')
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-cyan-100 text-cyan-800">DEPUTY</span>
                    @else
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">TU</span>
                    @endif
                </div>

                <div class="text-sm text-gray-500 border-t border-gray-100 pt-3">
                    <i class="fas fa-calendar-alt mr-1"></i> Dibuat: {{ $user->created_at->format('d M Y') }}
                </div>

                <div class="flex flex-wrap gap-2 mt-4 pt-3 border-t border-gray-100">
                    <a href="{{ route('users.edit', $user->id) }}"
                        class="flex-1 text-center bg-green-50 text-green-600 hover:bg-green-100 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
                    @if ($user->id !== auth()->id())
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="flex-1"
                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full text-center bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-md p-8 text-center text-gray-500">
                <i class="fas fa-users text-gray-300 text-4xl mb-3"></i>
                <p>Belum ada user</p>
            </div>
        @endforelse
    </div>

    <!-- Desktop Table View -->
    <div class="desktop-table bg-white rounded-lg shadow">
        <div class="overflow-x-auto" style="max-width: 100%;">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $index => $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($user->role === 'admin')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">ADMIN</span>
                                @elseif($user->role === 'hc')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">HC</span>
                                @elseif($user->role === 'div_head')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">DIV
                                        HEAD</span>
                                @elseif($user->role === 'deputy')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-cyan-100 text-cyan-800">DEPUTY</span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">TU</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('users.edit', $user->id) }}" class="text-green-600 hover:text-green-900"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @if ($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
