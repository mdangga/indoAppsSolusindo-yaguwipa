@php
    $user = Auth::user();
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

    $profilePath = optional($user)->profile_path;
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">

    @if ($user->role === 'admin')
        <x-admin.navbar-admin />
        <x-admin.sidebar />
    @else
        <x-user.header-user :user="$user" :randomBg="$randomBg" :profilePath="$profilePath" :title="'Notifikasi'" :description="'Kelola notifikasi Anda'" />
    @endif
    <!-- Full Notifications Page -->
    <div class="container {{ $user->role === 'admin' ? 'mx-auto md:mx-72' : 'mx-auto' }} px-4 py-8 max-w-4xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Notifikasi</h1>
            <div class="flex space-x-2">
                @if ($user->unreadNotifications->count() > 0)
                    <button id="markAllRead" class="px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 cursor-pointer">
                        Tandai semua terbaca
                    </button>
                @endif
            </div>
        </div>

        <!-- Filter Tab -->
        <div class="flex border-b border-gray-200 mb-6">
            <a href="{{ route('notifications.index') }}?filter=all"
                class="px-4 py-2 font-medium text-sm {{ request('filter', 'all') === 'all' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                Semua
            </a>
            <a href="{{ route('notifications.index') }}?filter=unread"
                class="px-4 py-2 font-medium text-sm {{ request('filter') === 'unread' ? 'border-b-2 border-blue-500 text-blue-600' : 'text-gray-500 hover:text-gray-700' }}">
                Belum Dibaca
            </a>
        </div>

        <!-- Notifications List -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @forelse($notifications as $notification)
                <a href="{{ route('notifications.read', $notification->id) }}"
                    class="block border-b border-gray-100 last:border-0 hover:bg-gray-50 transition-colors duration-150 {{ $notification->read_at ? '' : 'bg-blue-50' }}">
                    <div class="p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mr-3">
                                @php
                                    $type = $notification->data['type'] ?? 'info';
                                    $iconClass = '';
                                    $bgColor = '';
                                    $iconSvg = '';

                                    switch ($type) {
                                        case 'success':
                                            $bgColor = 'bg-green-100';
                                            $iconClass = 'text-green-600';
                                            $iconSvg =
                                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />';
                                            break;
                                        case 'rejected':
                                            $bgColor = 'bg-red-100';
                                            $iconClass = 'text-red-600';
                                            $iconSvg =
                                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />';
                                            break;
                                        case 'warning':
                                            $bgColor = 'bg-yellow-100';
                                            $iconClass = 'text-yellow-600';
                                            $iconSvg =
                                                '<path fill="currentColor" d="m11.825 6.455l-.009-.006l-.793-.533a3 3 0 0 0-3.626.211L5.45 7.796a.75.75 0 0 1-.488.18H2.75a.75.75 0 0 0-.75.75v6.03c0 .414.336.75.75.75h2.088a.75.75 0 0 1 .563.254l2.339 2.66a2.25 2.25 0 0 0 2.968.365l.684-.473l.734.25a2.25 2.25 0 0 0 2.539-.803l.47-.642l.326.044a2.25 2.25 0 0 0 2.276-1.153l.049-.09h3.464a.75.75 0 0 0 .75-.75V8.727a.75.75 0 0 0-.75-.75h-2.211a.75.75 0 0 1-.49-.182L16.86 6.336a3.75 3.75 0 0 0-5.036.12m-1.64.705l.562.378l-1.96 1.971a2.25 2.25 0 0 0 .044 3.216l.068.064c.81.771 2.062.831 2.941.14l2.079-1.632l2.657 2.555a.75.75 0 0 1 .139.9l-.025.044l-.014.026l-.255.467a.75.75 0 0 1-.758.384l-.769-.103a.75.75 0 0 0-.705.3l-.734 1.002a.75.75 0 0 1-.846.268l-1.09-.37a.75.75 0 0 0-.668.093l-.994.687a.75.75 0 0 1-.99-.122l-2.339-2.66a2.25 2.25 0 0 0-1.69-.763H3.5v-4.53h1.461a2.25 2.25 0 0 0 1.464-.541l1.948-1.669a1.5 1.5 0 0 1 1.813-.106m8.12 7.259a2.25 2.25 0 0 0-.69-1.648l-2.521-2.424a.75.75 0 0 0-1.053-1.053l-.506.397l-.06.047l-2.562 2.013a.75.75 0 0 1-.981-.047l-.068-.065a.75.75 0 0 1-.015-1.072l2.965-2.98a2.25 2.25 0 0 1 3.066-.116l1.687 1.458a2.25 2.25 0 0 0 1.472.547h1.46v4.943z" />';
                                            break;
                                        default:
                                            $bgColor = 'bg-blue-100';
                                            $iconClass = 'text-blue-600';
                                            $iconSvg =
                                                '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z" />';
                                    }
                                @endphp

                                <div
                                    class="flex items-center justify-center w-10 h-10 {{ $bgColor }} rounded-full">
                                    <svg class="w-5 h-5 {{ $iconClass }}" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        {!! $iconSvg !!}
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $notification->data['title'] ?? 'Notifikasi' }}
                                </p>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $notification->data['message'] ?? '-' }}
                                </p>
                                <div class="mt-2 flex items-center justify-between">
                                    <span class="text-xs text-gray-500">
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
                                <div class="ml-4">
                                    <span class="h-2 w-2 rounded-full bg-blue-500 block"></span>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" viewBox="0 0 24 24">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2">
                            <g>
                                <path stroke-dasharray="4" stroke-dashoffset="4" d="M12 3v2">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" dur="0.2s"
                                        values="4;0" />
                                </path>
                                <path stroke-dasharray="28" stroke-dashoffset="28"
                                    d="M12 5c-3.31 0 -6 2.69 -6 6l0 6c-1 0 -2 1 -2 2h8M12 5c3.31 0 6 2.69 6 6l0 6c1 0 2 1 2 2h-8">
                                    <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.2s"
                                        dur="0.4s" values="28;0" />
                                </path>
                                <animateTransform fill="freeze" attributeName="transform" begin="0.9s" dur="6s"
                                    keyTimes="0;0.05;0.15;0.2;1" type="rotate"
                                    values="0 12 3;3 12 3;-3 12 3;0 12 3;0 12 3" />
                            </g>
                            <path stroke-dasharray="8" stroke-dashoffset="8"
                                d="M10 20c0 1.1 0.9 2 2 2c1.1 0 2 -0.9 2 -2">
                                <animate fill="freeze" attributeName="stroke-dashoffset" begin="0.6s" dur="0.2s"
                                    values="8;0" />
                                <animateTransform fill="freeze" attributeName="transform" begin="1.1s" dur="6s"
                                    keyTimes="0;0.05;0.15;0.2;1" type="rotate"
                                    values="0 12 8;6 12 8;-6 12 8;0 12 8;0 12 8" />
                            </path>
                        </g>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada notifikasi</h3>
                    <p class="mt-1 text-sm text-gray-500">Anda tidak memiliki notifikasi baru.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($notifications->hasPages())
            <div class="flex justify-center items-center space-x-2 mt-6">
                {{-- Previous Button --}}
                @if ($notifications->onFirstPage())
                    <span
                        class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                        ← Previous
                    </span>
                @else
                    <a href="{{ $notifications->previousPageUrl() }}"
                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition">
                        ← Previous
                    </a>
                @endif

                {{-- Page Numbers --}}
                <div class="flex space-x-1">
                    @php
                        $current = $notifications->currentPage();
                        $last = $notifications->lastPage();
                        $start = max($current - 2, 1);
                        $end = min($current + 2, $last);
                    @endphp

                    {{-- First page & ellipsis --}}
                    @if ($start > 1)
                        <a href="{{ $notifications->url(1) }}"
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition">
                            1
                        </a>
                        @if ($start > 2)
                            <span class="px-3 py-2 text-sm text-gray-400">...</span>
                        @endif
                    @endif

                    {{-- Range pages --}}
                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == $current)
                            <span
                                class="px-3 py-2 text-sm font-medium text-white bg-amber-400 border border-amber-500/50 rounded-lg">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $notifications->url($page) }}"
                                class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    {{-- Last page & ellipsis --}}
                    @if ($end < $last)
                        @if ($end < $last - 1)
                            <span class="px-3 py-2 text-sm text-gray-400">...</span>
                        @endif
                        <a href="{{ $notifications->url($last) }}"
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition">
                            {{ $last }}
                        </a>
                    @endif
                </div>

                {{-- Next Button --}}
                @if ($notifications->hasMorePages())
                    <a href="{{ $notifications->nextPageUrl() }}"
                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:text-gray-900 transition">
                        Next →
                    </a>
                @else
                    <span
                        class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                        Next →
                    </span>
                @endif
            </div>
        @endif
    </div>

    <script>
        // Mark all as read for page button
        const markAllReadBtn = document.getElementById('markAllRead');

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
                        document.querySelectorAll('.bg-blue-50').forEach(el => {
                            el.classList.remove('bg-blue-50');
                        });

                        document.querySelectorAll('.bg-blue-100.text-blue-800').forEach(el => {
                            el.remove();
                        });

                        document.querySelectorAll('.bg-blue-500').forEach(el => {
                            el.remove();
                        });

                        markAllReadBtn.classList.add('hidden');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        }
    </script>
</body>

</html>
