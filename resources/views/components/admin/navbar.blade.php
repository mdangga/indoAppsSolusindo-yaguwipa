<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200    ">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200      ">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                {{-- <a href="https://flowbite.com" class="flex ms-2 md:me-24">
                        <img src="{{ asset('img/logo.png') }}" class="h-8 me-3" alt="FlowBite Logo" />
                        <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap  ">Yaguwipa</span>
                    </a> --}}
            </div>
            <div class="flex items-center">
                <div class="relative mr-4">
                    <button id="notificationButton" type="button"
                        class="relative p-2 text-gray-600 rounded-full hover:text-black hover:bg-amber-100 focus:outline-none transition-all duration-100">
                        <!-- Bell Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor">
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
                        class="hidden absolute right-0 mt-2 w-80 max-h-96 overflow-y-auto bg-white border border-gray-200 rounded-lg shadow-xl z-50 divide-y divide-gray-100">
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
                            <a href="{{ route('notifications.read', $notification->id) }}"
                                class="relative flex items-start px-4 py-3 hover:bg-gray-50 transition-colors duration-150 {{ $notification->read_at ? '' : 'bg-blue-50' }}">
                                <!-- Status Indicator -->
                                <div class="flex-shrink-0 mr-3 pt-1">
                                    <div class="flex items-center justify-center w-6 h-6 bg-red-100 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-600"
                                            viewBox="0 0 640 512">
                                            <path fill="currentColor"
                                                d="m323.4 85.2l-96.8 78.4c-16.1 13-19.2 36.4-7 53.1c12.9 17.8 38 21.3 55.3 7.8l99.3-77.2c7-5.4 17-4.2 22.5 2.8s4.2 17-2.8 22.5L373 188.8l139 128V128h-.7l-3.9-2.5L434.8 79c-15.3-9.8-33.2-15-51.4-15c-21.8 0-43 7.5-60 21.2m22.8 124.4l-51.7 40.2c-31.5 24.6-77.2 18.2-100.8-14.2c-22.2-30.5-16.6-73.1 12.7-96.8l83.2-67.3c-11.6-4.9-24.1-7.4-36.8-7.4C234 64 215.7 69.6 200 80l-72 48v224h28.2l91.4 83.4c19.6 17.9 49.9 16.5 67.8-3.1c5.5-6.1 9.2-13.2 11.1-20.6l17 15.6c19.5 17.9 49.9 16.6 67.8-2.9c4.5-4.9 7.8-10.6 9.9-16.5c19.4 13 45.8 10.3 62.1-7.5c17.9-19.5 16.6-49.9-2.9-67.8zM16 128c-8.8 0-16 7.2-16 16v208c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V128zm32 192a16 16 0 1 1 0 32a16 16 0 1 1 0-32m496-192v224c0 17.7 14.3 32 32 32h32c17.7 0 32-14.3 32-32V144c0-8.8-7.2-16-16-16zm32 208a16 16 0 1 1 32 0a16 16 0 1 1-32 0" />
                                        </svg>
                                    </div>
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

                        {{-- @if (Auth::user()->notifications->count() > 0)
                                    <div class="p-3 bg-gray-50 text-center border-t border-gray-200">
                                        <a href="{{ route('notifications.index') }}"
                                            class="text-sm font-medium text-blue-600 hover:text-blue-800">
                                            Lihat semua notifikasi
                                        </a>
                                    </div>
                                @endif --}}
                    </div>
                </div>

                <div class="flex items-center mx-3 space-x-2">
                    <span class="px-2">{{ Auth::user()->username }}</span>
                    <span>|</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-2 py-1 bg-transparent text-gray-500 font-medium  hover:text-gray-700">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
<script>
    const notifButton = document.getElementById('notificationButton');
    const notifDropdown = document.getElementById('notificationDropdown');

    notifButton.addEventListener('click', function() {
        notifDropdown.classList.toggle('hidden');
    });

    // Optional: Klik di luar untuk menutup dropdown
    document.addEventListener('click', function(event) {
        if (!notifButton.contains(event.target) && !notifDropdown.contains(event.target)) {
            notifDropdown.classList.add('hidden');
        }
    });
</script>
