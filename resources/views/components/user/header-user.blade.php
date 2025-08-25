@props([
    'user' => null,
    'profilePath' => null,
    'title' => 'Edit Profile',
    'randomBg' => 'bg-blue-500',
    'route' => route('dashboard'),
    'description' => 'Kelola informasi akun Anda',
])
<div class="bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
            <div class="flex items-center space-x-4">
                <a href="{{ $route }}" class="text-gray-500 hover:text-blue-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 hover:scale-110 transition-all duration-100"
                        viewBox="0 0 1024 1024">
                        <path fill="currentColor"
                            d="M685.248 104.704a64 64 0 0 1 0 90.496L368.448 512l316.8 316.8a64 64 0 0 1-90.496 90.496L232.704 557.248a64 64 0 0 1 0-90.496l362.048-362.048a64 64 0 0 1 90.496 0" />
                    </svg>
                </a>
                <div>
                    <h1 class="text-md lg:text-xl font-bold text-gray-900">{{ $title }}</h1>
                    <p class="text-sm lg:text-md text-gray-600 hidden sm:block">{{ $description }}</p>
                </div>

            </div>
            <div class="flex items-center gap-3">
                <div>
                    <p class="text-right text-sm font-medium text-gray-900 leading-tight">
                        {{ $user->nama ?? $user->username }}
                    </p>
                    <p class="text-right text-xs text-gray-500">
                        {{ ucfirst($user->role) }}
                    </p>
                </div>

                @if ($profilePath)
                    <img src="{{ asset('storage/' . $profilePath) }}" alt="Profile"
                        class="w-10 h-10 rounded-full object-cover border-2 border-gray-300" />
                @else
                    <div
                        class="w-10 h-10 {{ $randomBg }} rounded-full text-white flex items-center justify-center font-semibold uppercase text-sm">
                        {{ strtoupper(substr($user->username ?? ($user->nama ?? 'U'), 0, 1)) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
