@php
    $user = auth()->user();

    // Generalized user data (mitra/donatur)
    // $displayUser = $user->UserToMitra;
    $review = $user->Review;

    $colorMap = [
        'bg-red-400' => 'hover:bg-red-300',
        'bg-blue-400' => 'hover:bg-blue-300',
        'bg-green-400' => 'hover:bg-green-300',
        'bg-yellow-400' => 'hover:bg-yellow-300',
        'bg-purple-400' => 'hover:bg-purple-300',
        'bg-pink-400' => 'hover:bg-pink-300',
        'bg-teal-400' => 'hover:bg-teal-300',
        'bg-orange-400' => 'hover:bg-orange-300',
    ];

    $colors = array_keys($colorMap);
    $userIdentifier = $user->email ?? $user->id;
    $colorIndex = crc32($userIdentifier) % count($colors);
    $randomBg = $colors[$colorIndex];
    $hoverBg = $colorMap[$randomBg];

    $profilePath = optional($user)->profile_path;

    $emptyReview = !$review;
    $isEditReview = request()->query('edit') === '1';
@endphp


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User</title>
    @vite(['resources/css/app.css', 'resources/js/AOS.js', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs" defer></script>

</head>

<body>
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                        <p class="text-gray-600">Selamat datang kembali, {{ $user->username }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        {{-- Notifikasi Bell --}}
                        <div class="relative mr-4">
                            <button id="notificationButton" type="button"
                                class="relative p-2 text-gray-600 rounded-full hover:text-black hover:bg-amber-100 focus:outline-none transition-all duration-100">
                                <!-- Bell Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10.268 21a2 2 0 0 0 3.464 0m-10.47-5.674A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326" />
                                </svg>

                                @if (Auth::user()->unreadNotifications->count() > 0)
                                    <span
                                        class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border border-white animate-pulse"></span>
                                @endif
                            </button>

                            {{-- Notification Dropdown --}}
                            <div id="notificationDropdown"
                                class="hidden absolute left-0 mt-2 w-80 max-h-96 overflow-y-auto bg-white border border-gray-200 rounded-lg shadow-xl z-50 divide-y divide-gray-100">
                                <div class="p-4 bg-white sticky top-0 z-10 border-b border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-lg font-semibold text-gray-900">Notifikasi</h3>
                                        @if (Auth::user()->unreadNotifications->count() > 0)
                                            <button id="markAllRead"
                                                class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                                Tandai semua terbaca
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                @forelse(Auth::user()->notifications->take(10) as $notification)
                                    <div
                                        class="relative flex items-start px-4 py-3 hover:bg-gray-50 transition-colors duration-150 {{ $notification->read_at ? '' : 'bg-blue-50' }}">
                                        <!-- Status Indicator -->
                                        <div class="flex-shrink-0 mr-3 pt-1">
                                            @if (isset($notification->data['type']) && $notification->data['type'] === 'success')
                                                <div
                                                    class="flex items-center justify-center w-6 h-6 bg-green-100 rounded-full">
                                                    <svg class="w-4 h-4 text-green-600" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </div>
                                            @elseif(isset($notification->data['type']) && $notification->data['type'] === 'rejected')
                                                <div
                                                    class="flex items-center justify-center w-6 h-6 bg-red-100 rounded-full">
                                                    <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </div>
                                            @else
                                                <div class="mt-1.5 w-2 h-2 bg-blue-500 rounded-full"></div>
                                            @endif
                                        </div>

                                        {{-- Notification Content --}}
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-medium text-gray-900 mb-1">
                                                {{ $notification->data['title'] ?? 'Notifikasi' }}
                                            </div>
                                            <p class="text-sm text-gray-600 mb-1">
                                                {{ $notification->data['message'] ?? '-' }}
                                            </p>
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs text-gray-400">
                                                    {{ \Carbon\Carbon::parse($notification->data['time'] ?? $notification->created_at)->diffForHumans() }}
                                                </span>
                                                @if (!$notification->read_at)
                                                    <span
                                                        class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[10px] font-medium bg-blue-100 text-blue-800">
                                                        Baru
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Unread indicator --}}
                                        @if (!$notification->read_at)
                                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-l"></div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="px-4 py-6 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                        <h4 class="mt-2 text-sm font-medium text-gray-900">Tidak ada notifikasi</h4>
                                        <p class="mt-1 text-sm text-gray-500">Anda tidak memiliki notifikasi baru.</p>
                                    </div>
                                @endforelse

                                @if (Auth::user()->notifications->count() > 0)
                                    <div class="p-3 bg-gray-50 text-center border-t border-gray-200">
                                        <a href="{{ route('notifications.index') }}"
                                            class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                            Lihat semua notifikasi
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-500">Rabu, 23 Juli 2025</p>
                            <p class="text-sm font-medium text-gray-900" id="current-time">14:30</p>
                        </div>

                        @if ($profilePath)
                            <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar">
                                <img src="{{ asset('storage/' . $profilePath) }}" alt="Profile"
                                    class="w-12 h-12 rounded-full object-cover border-2 border-gray-300 hover:scale-105 transition" />
                            </button>
                        @else
                            <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar"
                                class="w-12 h-12 {{ $randomBg }} {{ $hoverBg }} rounded-full text-white flex items-center justify-center font-semibold uppercase select-none transition-colors duration-200 cursor-pointer text-lg">
                                {{ strtoupper(substr($user->username ?? ($user->nama ?? 'U'), 0, 1)) }}
                            </button>
                        @endif


                        <!-- Dropdown menu -->
                        <div id="dropdownAvatar"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm max-w-60 min-w-44 ">
                            <div class="px-4 py-3 text-sm text-gray-900 ">
                                <div class="font-bold mb-1">{{ '@' . $user->username ?? '-' }}
                                </div>
                                <div class="text-gray-500">{{ $user->nama ?? '-' }}
                                </div>

                            </div>
                            @if ($user->role === 'donatur')
                                <ul class="text-sm text-gray-700 " aria-labelledby="dropdownUserAvatarButton">
                                    <li>
                                        <a href="{{ route('mitra.join') }}"
                                            class="block px-4 py-2 hover:bg-gray-100">Join Mitra</a>
                                    </li>
                                </ul>
                            @endif
                            <ul class="pt-2 text-sm text-gray-700 " aria-labelledby="dropdownUserAvatarButton">
                                <li>
                                    <a href="{{ route('user.edit-profile') }}"
                                        class="block px-4 py-2 hover:bg-gray-100">Edit Profile</a>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" class="py-2">
                                        @csrf
                                        <button type="submit"
                                            class="block px-4 w-full py-2 text-sm text-red-700 hover:bg-red-100 text-left cursor-pointer">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Mobile Quick Actions - Only visible on mobile -->
            <div class="lg:hidden mb-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                    <div class="flex justify-around items-center">
                        <a href="{{ $user->role === 'mitra' ? route('mitra.kerja-sama') : route('mitra.join') }}"
                            class="flex flex-col items-center p-2 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-900">Kolaborasi</span>
                        </a>

                        <a href="#"
                            class="flex flex-col items-center p-2 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mb-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-900">Orders</span>
                        </a>

                        <a href="#"
                            class="flex flex-col items-center p-2 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mb-2">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                    </path>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-900">Wishlist</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Main Content Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Recent Activity --}}
                <div class="lg:col-span-2">
                    @if ($user->role === 'mitra')
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
                            <div class="px-6 py-4 border-b border-gray-200">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
                                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        Lihat Semua
                                    </a>
                                </div>
                            </div>
                            <div class="divide-y divide-gray-200">
                                @foreach ($recentActivities as $activity)
                                    <div class="px-6 py-4">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="w-5 h-5 text-blue-600" viewBox="0 0 640 512">
                                                        <path fill="currentColor"
                                                            d="m323.4 85.2l-96.8 78.4c-16.1 13-19.2 36.4-7 53.1c12.9 17.8 38 21.3 55.3 7.8l99.3-77.2c7-5.4 17-4.2 22.5 2.8s4.2 17-2.8 22.5L373 188.8l139 128V128h-.7l-3.9-2.5L434.8 79c-15.3-9.8-33.2-15-51.4-15c-21.8 0-43 7.5-60 21.2m22.8 124.4l-51.7 40.2c-31.5 24.6-77.2 18.2-100.8-14.2c-22.2-30.5-16.6-73.1 12.7-96.8l83.2-67.3c-11.6-4.9-24.1-7.4-36.8-7.4C234 64 215.7 69.6 200 80l-72 48v224h28.2l91.4 83.4c19.6 17.9 49.9 16.5 67.8-3.1c5.5-6.1 9.2-13.2 11.1-20.6l17 15.6c19.5 17.9 49.9 16.6 67.8-2.9c4.5-4.9 7.8-10.6 9.9-16.5c19.4 13 45.8 10.3 62.1-7.5c17.9-19.5 16.6-49.9-2.9-67.8zM16 128c-8.8 0-16 7.2-16 16v208c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V128zm32 192a16 16 0 1 1 0 32a16 16 0 1 1 0-32m496-192v224c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V144c0-8.8-7.2-16-16-16zm32 208a16 16 0 1 1 32 0a16 16 0 1 1-32 0" />
                                                    </svg>
                                                </div>
                                                <div class="ml-4">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        {{ $activity->kategoriKerjaSama->nama ?? 'Tanpa Kategori' }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        {{ $activity->keterangan }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-sm font-medium text-gray-900 mb-2">
                                                    {{ $activity->updated_at->format('d M Y') }}</p>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium 
                                                        @switch($activity->status)
                                                            @case('approved')
                                                              bg-green-100 text-green-800
                                                                @break
                                                            @case('rejected')
                                                              bg-red-100 text-red-800
                                                                @break
                                                            @case('pending')
                                                              bg-yellow-100 text-yellow-800
                                                                @break
                                                            @default
                                                              bg-gray-100 text-gray-800
                                                            @endswitch
                                                ">
                                                    {{ str_replace('_', ' ', ucfirst($activity->status ?? '-')) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    {{-- <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900">Pesanan Terbaru</h3>
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    Lihat Semua
                                </a>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <div class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">#ORD-001</p>
                                            <p class="text-sm text-gray-500">23 Jul 2025</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">Rp 125.000</p>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Completed
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">#ORD-002</p>
                                            <p class="text-sm text-gray-500">22 Jul 2025</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">Rp 89.000</p>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Processing
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">#ORD-003</p>
                                            <p class="text-sm text-gray-500">21 Jul 2025</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">Rp 275.000</p>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Pending
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">#ORD-004</p>
                                            <p class="text-sm text-gray-500">20 Jul 2025</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">Rp 195.000</p>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Completed
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <p class="text-sm font-medium text-gray-900">#ORD-005</p>
                                            <p class="text-sm text-gray-500">19 Jul 2025</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-medium text-gray-900">Rp 350.000</p>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Processing
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <!-- Individual Review -->
                    @if ($emptyReview || $isEditReview)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tulis Ulasan</h3>

                            @if (session('success'))
                                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form
                                action="{{ $isEditReview ? route('review.update', $review->id_review) : route('review.store') }}"
                                method="POST">
                                @csrf
                                @if ($isEditReview)
                                    @method('PUT')
                                @endif

                                <!-- Rating Input dengan Bintang -->
                                <div class="mb-4" x-data="{ rating: {{ old('rating', $review->rating ?? 0) }} }">
                                    <label for="rating"
                                        class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                                    <div class="flex space-x-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <button type="button" @click="rating = {{ $i }}"
                                                @keydown.enter.prevent="rating = {{ $i }}"
                                                :class="rating >= {{ $i }} ? 'text-yellow-400' : 'text-gray-300'"
                                                class="text-2xl focus:outline-none transition">
                                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                                </svg>
                                            </button>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="rating" :value="rating">
                                    @error('rating')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>


                                <!-- Review Textarea -->
                                <div class="mb-4">
                                    <label for="review"
                                        class="block text-sm font-medium text-gray-700 mb-1">Ulasan</label>
                                    <textarea id="review" name="review" rows="4"
                                        class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 p-3"
                                        placeholder="Tulis ulasanmu di sini..." required>{{ old('review', $review->review ?? '') }}</textarea>
                                    @error('review')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-4">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('dashboard') }}"
                                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                            Batal
                                        </a>
                                        <button type="submit"
                                            class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                                            {{ $isEditReview ? 'Update Ulasan' : 'Kirim Ulasan' }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                            <div class="flex items-start space-x-4">
                                <!-- Avatar -->
                                @if ($profilePath)
                                    <img src="{{ asset('storage/' . $profilePath) }}" alt="Profile"
                                        class="w-10 h-10 rounded-full object-cover border-2 border-gray-300 hover:scale-105 transition" />
                                @else
                                    <span
                                        class="w-10 h-10 {{ $randomBg }} {{ $hoverBg }} rounded-full text-white flex items-center justify-center font-semibold uppercase select-none transition-colors duration-200 cursor-pointer text-lg">
                                        {{ strtoupper(substr($user->username ?? ($user->nama ?? 'U'), 0, 1)) }}
                                    </span>
                                @endif


                                <!-- Review Content -->
                                <div class="flex-1 min-w-0">
                                    <!-- Header with name, date, and actions -->
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-1">
                                                <span class="font-medium text-gray-900">{{ $user->nama }}</span>
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ url()->current() }}?edit=1" title="Edit Review"
                                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('review.delete', $review->id_review) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" title="Hapus Review"
                                                            class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-3">
                                                <div class="flex space-x-0.5">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $review->rating)
                                                            <svg class="w-4 h-4 text-yellow-400 fill-current"
                                                                viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                                            </svg>
                                                        @else
                                                            <svg class="w-4 h-4 text-gray-300 fill-current"
                                                                viewBox="0 0 24 24">
                                                                <path
                                                                    d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Review Text -->
                                    <p class="text-gray-700 text-sm leading-relaxed">
                                        {{ $review->review }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Desktop Sidebar - Profile & Quick Actions -->
                <div class="md:space-y-6 lg:block">
                    <!-- Desktop Quick Actions - Hidden on mobile -->
                    <div class="hidden lg:block bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ $user->role === 'mitra' ? route('mitra.kerja-sama') : route('mitra.join') }}"
                                class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-600"
                                        viewBox="0 0 640 512">
                                        <path fill="currentColor"
                                            d="m323.4 85.2l-96.8 78.4c-16.1 13-19.2 36.4-7 53.1c12.9 17.8 38 21.3 55.3 7.8l99.3-77.2c7-5.4 17-4.2 22.5 2.8s4.2 17-2.8 22.5L373 188.8l139 128V128h-.7l-3.9-2.5L434.8 79c-15.3-9.8-33.2-15-51.4-15c-21.8 0-43 7.5-60 21.2m22.8 124.4l-51.7 40.2c-31.5 24.6-77.2 18.2-100.8-14.2c-22.2-30.5-16.6-73.1 12.7-96.8l83.2-67.3c-11.6-4.9-24.1-7.4-36.8-7.4C234 64 215.7 69.6 200 80l-72 48v224h28.2l91.4 83.4c19.6 17.9 49.9 16.5 67.8-3.1c5.5-6.1 9.2-13.2 11.1-20.6l17 15.6c19.5 17.9 49.9 16.6 67.8-2.9c4.5-4.9 7.8-10.6 9.9-16.5c19.4 13 45.8 10.3 62.1-7.5c17.9-19.5 16.6-49.9-2.9-67.8zM16 128c-8.8 0-16 7.2-16 16v208c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V128zm32 192a16 16 0 1 1 0 32a16 16 0 1 1 0-32m496-192v224c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V144c0-8.8-7.2-16-16-16zm32 208a16 16 0 1 1 32 0a16 16 0 1 1-32 0" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Kolaborasi</span>
                            </a>

                            <a href="{{ route('form.donasi') }}"
                                class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-green-600"
                                        viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M16 12c2.76 0 5-2.24 5-5s-2.24-5-5-5s-5 2.24-5 5s2.24 5 5 5m5.45 5.6c-.39-.4-.88-.6-1.45-.6h-7l-2.08-.73l.33-.94L13 16h2.8c.35 0 .63-.14.86-.37s.34-.51.34-.82c0-.54-.26-.91-.78-1.12L8.95 11H7v9l7 2l8.03-3c.01-.53-.19-1-.58-1.4M5 11H.984v11H5z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Donasi</span>
                            </a>

                            <a href="#"
                                class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Wishlist</span>
                            </a>
                        </div>
                    </div>

                    <!-- Notifications -->
                    {{-- <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Notifications</h3>
                        <div class="space-y-3">
                            <div class="flex items-start p-3 bg-blue-50 rounded-lg">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 mr-3"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Pesanan #ORD-002 sedang diproses</p>
                                    <p class="text-xs text-gray-500">2 jam yang lalu</p>
                                </div>
                            </div>

                            <div class="flex items-start p-3 bg-green-50 rounded-lg">
                                <div class="w-2 h-2 bg-green-500 rounded-full mt-2 mr-3"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Pesanan #ORD-001 telah selesai</p>
                                    <p class="text-xs text-gray-500">1 hari yang lalu</p>
                                </div>
                            </div>

                            <div class="flex items-start p-3 bg-yellow-50 rounded-lg">
                                <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2 mr-3"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900">Produk favorit sedang diskon 20%</p>
                                    <p class="text-xs text-gray-500">3 hari yang lalu</p>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update current time
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            document.getElementById('current-time').textContent = timeString;
        }

        updateTime();
        setInterval(updateTime, 1000);

        // Notification System
        document.addEventListener('DOMContentLoaded', function() {
            const notifButton = document.getElementById('notificationButton');
            const notifDropdown = document.getElementById('notificationDropdown');
            const markAllReadBtn = document.getElementById('markAllRead');

            // Toggle dropdown
            notifButton.addEventListener('click', function(e) {
                e.stopPropagation();
                notifDropdown.classList.toggle('hidden');
                notifButton.classList.toggle('bg-amber-100');
                notifButton.classList.toggle('text-black');
            });

            // Mark all as read
            if (markAllReadBtn) {
                markAllReadBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    fetch("{{ route('notifications.readAll') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json"
                            },
                            credentials: "same-origin"
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Network response was not ok');
                            return response.json();
                        })
                        .then(data => {
                            // Remove all 'new' badges and blue background
                            document.querySelectorAll('#notificationDropdown .bg-blue-50').forEach(
                                el => {
                                    el.classList.remove('bg-blue-50');
                                });
                            document.querySelectorAll('#notificationDropdown [class*="bg-blue-100"]')
                                .forEach(el => {
                                    el.remove();
                                });
                            document.querySelectorAll('#notificationDropdown .w-1.bg-blue-500').forEach(
                                el => {
                                    el.remove();
                                });

                            // Remove notification bell badge
                            const badge = document.querySelector('#notificationButton span');
                            if (badge) badge.remove();

                            // Disable mark all read button
                            markAllReadBtn.classList.add('hidden');

                            // Close dropdown after 1 second
                            setTimeout(() => {
                                notifDropdown.classList.add('hidden');
                                notifButton.classList.remove('bg-amber-100');
                                notifButton.classList.remove('text-black');
                            }, 1000);
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            }

            // Close when clicking outside
            document.addEventListener('click', function(event) {
                if (!notifButton.contains(event.target) && !notifDropdown.contains(event.target)) {
                    notifDropdown.classList.add('hidden');
                    notifButton.classList.remove('bg-amber-100');
                    notifButton.classList.remove('text-black');
                }
            });

            // Keyboard navigation
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && !notifDropdown.classList.contains('hidden')) {
                    notifDropdown.classList.add('hidden');
                    notifButton.classList.remove('bg-amber-100');
                    notifButton.classList.remove('text-black');
                }
            });
        });
    </script>
</body>

</html>
