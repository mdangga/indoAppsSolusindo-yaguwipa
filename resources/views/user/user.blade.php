@php
    $user = auth()->user();

    // Generalized user data (mitra/donatur)
    $displayUser = $user->role === 'mitra' ? $user->UserToMitra : $user->UserToDonatur;
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

    $profilePath = optional($displayUser)->profile_path;

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
                        <p class="text-gray-600">Selamat datang kembali, {{ auth()->user()->username }}</p>
                    </div>
                    <div class="flex items-center space-x-4">
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
                                {{ strtoupper(substr($user->username ?? ($displayUser->nama ?? 'U'), 0, 1)) }}
                            </button>
                        @endif


                        <!-- Dropdown menu -->
                        <div id="dropdownAvatar"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm max-w-60 min-w-44 ">
                            <div class="px-4 py-3 text-sm text-gray-900 ">
                                <div class="font-bold mb-1">{{ '@' . auth()->user()->username ?? '-' }}
                                </div>
                                <div class="text-gray-500">{{ $displayUser->nama ?? '-' }}
                                </div>

                            </div>
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
                        <a href="#"
                            class="flex flex-col items-center p-2 hover:bg-gray-50 rounded-lg transition-colors">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <span class="text-xs font-medium text-gray-900">Products</span>
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

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Orders -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
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
                    </div>

                    <!-- Individual Review -->
                    @if ($emptyReview || $isEditReview)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mt-8">
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
                                <div class="mb-4" x-data="{ rating: {{ old('rating', $review->bintang ?? 0) }} }">
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
                        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mt-8">
                            <div class="flex items-start space-x-4">
                                <!-- Avatar -->
                                @if ($profilePath)
                                    <img src="{{ asset('storage/' . $profilePath) }}" alt="Profile"
                                        class="w-10 h-10 rounded-full object-cover border-2 border-gray-300 hover:scale-105 transition" />
                                @else
                                    <span
                                        class="w-10 h-10 {{ $randomBg }} {{ $hoverBg }} rounded-full text-white flex items-center justify-center font-semibold uppercase select-none transition-colors duration-200 cursor-pointer text-lg">
                                        {{ strtoupper(substr($user->username ?? ($displayUser->nama ?? 'U'), 0, 1)) }}
                                    </span>
                                @endif


                                <!-- Review Content -->
                                <div class="flex-1 min-w-0">
                                    <!-- Header with name, date, and actions -->
                                    <div class="flex items-start justify-between mb-3">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-1">
                                                <span
                                                    class="font-medium text-gray-900">{{ $displayUser->nama }}</span>
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ url()->current() }}?edit=1" title="Edit Review"
                                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('review.delete', $review->id_review) }}" method="POST">
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
                                                        @if ($i <= $review->bintang)
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
                            <a href="#"
                                class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">Browse Products</span>
                            </a>

                            <a href="#"
                                class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-sm font-medium text-gray-900">View Orders</span>
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
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
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
                    </div>
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
    </script>
</body>

</html>
