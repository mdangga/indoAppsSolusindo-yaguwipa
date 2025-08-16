@props([
    'user' => null,
    'profilePath' => null,
    'randomBg' => 'bg-blue-500',
])

<div class="bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
            <!-- Bagian Kiri -->
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-gray-600">Selamat datang kembali, {{ $user->name ?? $user->username }}</p>
            </div>

            <!-- Bagian Kanan -->
            <div class="flex items-center space-x-4">
                <!-- Notifikasi -->
                <div class="relative mr-4">
                    <button id="notificationButton" type="button"
                        class="relative p-2 text-gray-600 rounded-full hover:text-black hover:bg-amber-100 focus:outline-none transition-all duration-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.268 21a2 2 0 0 0 3.464 0m-10.47-5.674A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326" />
                        </svg>

                        @if ($user->unreadNotifications->count() > 0)
                            <span
                                class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border border-white animate-pulse"></span>
                        @endif
                    </button>

                    <!-- Dropdown Notifikasi -->
                    <div id="notificationDropdown"
                        class="hidden absolute right-0 mt-2 w-80 max-h-96 overflow-y-auto bg-white border border-gray-200 rounded-lg shadow-xl z-50 divide-y divide-gray-100">
                        <div class="p-4 bg-white sticky top-0 z-10 border-b border-gray-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-900">Notifikasi</h3>
                                @if ($user->unreadNotifications->count() > 0)
                                    <button id="markAllRead"
                                        class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                        Tandai semua terbaca
                                    </button>
                                @endif
                            </div>
                        </div>

                        @forelse($user->notifications->take(10) as $notification)
                            <a href="{{ $notification->data['url'] ?? '#' }}" class="block hover:bg-gray-50">
                                <a
                                    href="{{ route('notifications.read', $notification->id) }} "class="block hover:bg-gray-50">
                                    <div
                                        class="relative flex items-start px-4 py-3 transition-colors duration-150 {{ $notification->read_at ? '' : 'bg-blue-50' }}">
                                        <!-- Icon Status -->
                                        <div class="flex-shrink-0 mr-3 pt-1">
                                            @switch($notification->data['type'] ?? 'info')
                                                @case('success')
                                                    <div
                                                        class="flex items-center justify-center w-6 h-6 bg-green-100 rounded-full">
                                                        <svg class="w-4 h-4 text-green-600" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </div>
                                                @break

                                                @case('rejected')
                                                    <div
                                                        class="flex items-center justify-center w-6 h-6 bg-red-100 rounded-full">
                                                        <svg class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24"
                                                            stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </div>
                                                @break

                                                @default
                                                    <div class="mt-1.5 w-2 h-2 bg-blue-500 rounded-full"></div>
                                            @endswitch
                                        </div>

                                        <!-- Konten Notifikasi -->
                                        <div class="flex-1 min-w-0">
                                            <div class="text-sm font-medium text-gray-900 mb-1">
                                                {{ $notification->data['title'] ?? 'Notifikasi' }}
                                            </div>
                                            <p class="text-sm text-gray-600 mb-1">
                                                {{ $notification->data['message'] ?? '-' }}
                                            </p>
                                            <div class="flex items-center justify-between">
                                                <span class="text-xs text-gray-400">
                                                    {{ $notification->created_at->diffForHumans() }}
                                                </span>
                                                @if (!$notification->read_at)
                                                    <span
                                                        class="inline-flex items-center px-1.5 py-0.5 rounded-full text-[10px] font-medium bg-blue-100 text-blue-800">
                                                        Baru
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        @if (!$notification->read_at)
                                            <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500 rounded-l"></div>
                                        @endif
                                    </div>
                                </a>
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

                            @if ($user->notifications->count() > 0)
                                <div class="p-3 bg-gray-50 text-center border-t border-gray-200">
                                    <a href="{{ route('notifications.index') }}"
                                        class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                        Lihat semua notifikasi
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Waktu -->
                    <div class="text-right">
                        <p class="text-sm text-gray-500" id="current-date">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
                        <p class="text-sm font-medium text-gray-900" id="current-time">{{ now()->format('H:i') }}</p>
                    </div>

                    <!-- Profil User -->
                    <div class="relative">
                        @if ($profilePath)
                            <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar">
                                <img src="{{ asset('storage/' . $profilePath) }}" alt="Profile"
                                    class="w-12 h-12 rounded-full object-cover border-2 border-gray-100/10 cursor-pointer hover:brightness-90 transition" />
                            </button>
                        @else
                            <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar"
                                class="w-12 h-12 {{ $randomBg }} {{ $hoverBg }} rounded-full text-white flex items-center justify-center font-semibold uppercase select-none transition-colors duration-200 cursor-pointer text-lg">
                                {{ strtoupper(substr($user->username ?? ($user->nama ?? 'U'), 0, 1)) }}
                            </button>
                        @endif

                        <!-- Dropdown Menu -->
                        <div id="dropdownAvatar"
                            class="hidden absolute right-0 mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 z-50">
                            <div class="px-4 py-3 text-sm text-gray-900">
                                <div class="font-bold truncate">{{ '@' . $user->username }}</div>
                                <div class="text-gray-500 truncate">{{ $user->nama }}</div>
                            </div>
                            <ul class="py-2 text-sm text-gray-700">
                                @if ($user->role === 'donatur')
                                    <li>
                                        <a href="{{ route('mitra.join') }}" class="block px-4 py-2 hover:bg-gray-100">Join
                                            Mitra</a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('user.edit-profile') }}"
                                        class="block px-4 py-2 hover:bg-gray-100">Edit Profile</a>
                                </li>
                            </ul>
                            <div class="py-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">
                                        Logout
                                    </button>
                                </form>
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
