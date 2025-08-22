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
                        <img src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}" class="h-8 me-3" alt="FlowBite Logo" />
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
                                        class="text-xs text-blue-600 hover:text-blue-800 font-medium cursor-pointer">
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
                                    <div class="flex items-center justify-center w-6 h-6 bg-yellow-100 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-yellow-600"
                                            viewBox="0 0 24 24">
                                            <path fill="currentColor"
                                                d="m11.825 6.455l-.009-.006l-.793-.533a3 3 0 0 0-3.626.211L5.45 7.796a.75.75 0 0 1-.488.18H2.75a.75.75 0 0 0-.75.75v6.03c0 .414.336.75.75.75h2.088a.75.75 0 0 1 .563.254l2.339 2.66a2.25 2.25 0 0 0 2.968.365l.684-.473l.734.25a2.25 2.25 0 0 0 2.539-.803l.47-.642l.326.044a2.25 2.25 0 0 0 2.276-1.153l.049-.09h3.464a.75.75 0 0 0 .75-.75V8.727a.75.75 0 0 0-.75-.75h-2.211a.75.75 0 0 1-.49-.182L16.86 6.336a3.75 3.75 0 0 0-5.036.12m-1.64.705l.562.378l-1.96 1.971a2.25 2.25 0 0 0 .044 3.216l.068.064c.81.771 2.062.831 2.941.14l2.079-1.632l2.657 2.555a.75.75 0 0 1 .139.9l-.025.044l-.014.026l-.255.467a.75.75 0 0 1-.758.384l-.769-.103a.75.75 0 0 0-.705.3l-.734 1.002a.75.75 0 0 1-.846.268l-1.09-.37a.75.75 0 0 0-.668.093l-.994.687a.75.75 0 0 1-.99-.122l-2.339-2.66a2.25 2.25 0 0 0-1.69-.763H3.5v-4.53h1.461a2.25 2.25 0 0 0 1.464-.541l1.948-1.669a1.5 1.5 0 0 1 1.813-.106m8.12 7.259a2.25 2.25 0 0 0-.69-1.648l-2.521-2.424a.75.75 0 0 0-1.053-1.053l-.506.397l-.06.047l-2.562 2.013a.75.75 0 0 1-.981-.047l-.068-.065a.75.75 0 0 1-.015-1.072l2.965-2.98a2.25 2.25 0 0 1 3.066-.116l1.687 1.458a2.25 2.25 0 0 0 1.472.547h1.46v4.943z" />
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
    const markAllReadBtn = document.getElementById('markAllRead');

    notifButton.addEventListener('click', function() {
        notifDropdown.classList.toggle('hidden');
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
    document.addEventListener('click', function(event) {
        if (!notifButton.contains(event.target) && !notifDropdown.contains(event.target)) {
            notifDropdown.classList.add('hidden');
        }
    });
</script>
