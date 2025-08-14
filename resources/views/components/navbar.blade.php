<style>
    select.goog-te-combo {
        background-color: transparent !important;
        background-image: none !important;
    }

    /* Styling kotak dropdown sebelum dibuka */
    .goog-te-gadget .goog-te-combo {
        background-color: transparent !important;
        color: #1F2937 !important;
        font-weight: 600 !important;
        border: none !important;
        padding-block: 1px !important;
        font-size: 0.875rem !important;
        font-family: "Instrument Sans", sans-serif !important;
        appearance: none !important;
        cursor: pointer;
        display: block !important;
        margin: 4px -25px 4px 0 !important;
        top: 6px !important;
        position: relative !important;
        max-width: 170px !important;
    }

    /* Saat dropdown difokuskan */
    .goog-te-combo:focus {
        outline: none !important;
        box-shadow: none !important;
        --tw-ring-shadow: 0 0 #0000 !important;
        background: transparent !important;
        --tw-ring-color: transparent !important;
    }

    /* Untuk iOS/Android */
    .goog-te-combo option {
        color: black;
    }

    /* Container utama Google Translate - force column layout */
    .goog-te-gadget {
        display: block !important;
        width: auto !important;
        font-family: sans-serif !important;
        font-size: 0px !important;
    }

    /* Alternative: Hide just the powered by text content */
    .goog-te-gadget {
        color: transparent !important;
    }

    /* Make sure only dropdown is visible in skiptranslate */
    .skiptranslate .goog-te-combo {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

    /* Semua span dalam google translate */
    .goog-te-gadget span,
    .goog-te-gadget>span,
    span[style*="white-space:nowrap"],
    div[id*="targetLanguage"] span {
        display: inline-flex !important;
        align-items: center !important;
        gap: 2px !important;
        font-size: 9px !important;
        color: #666 !important;
        line-height: 1 !important;
        margin: 0 !important;
        padding: 0 !important;
        vertical-align: middle !important;
        white-space: nowrap !important;
        position: relative !important;
    }

    /* Semua link dalam google translate */
    .goog-te-gadget a,
    .goog-te-gadget>a,
    div[id*="targetLanguage"] a,
    span[style*="white-space:nowrap"] a,
    .goog-logo-link {
        display: inline-flex !important;
        align-items: center !important;
        font-size: 10px !important;
        color: #717272 !important;
        text-decoration: none !important;
        font-weight: normal !important;
        margin: 0 !important;
        padding: 0 !important;
        line-height: 1 !important;
        vertical-align: middle !important;
        border: none !important;
        background: none !important;
    }

    .goog-te-gadget a:hover,
    div[id*="targetLanguage"] a:hover {
        text-decoration: underline !important;
    }

    /* Semua gambar dalam google translate */
    .goog-te-gadget img,
    .goog-te-gadget>img,
    div[id*="targetLanguage"] img,
    span[style*="white-space:nowrap"] img,
    .goog-logo-link img {
        height: 11px !important;
        width: auto !important;
        margin: 0 !important;
        padding: 0 !important;
        display: inline-block !important;
        vertical-align: middle !important;
        flex-shrink: 0 !important;
        border: none !important;
    }

    /* Force semua child elements untuk alignment */
    .goog-te-gadget * {
        box-sizing: border-box !important;
    }

    /* Specific targeting untuk struktur yang muncul */
    .goog-te-gadget>span[style*="white-space"] {
        display: flex !important;
        align-items: center !important;
        gap: 3px !important;
        margin-inline-start: 10px !important;
    }

    /* Override inline styles yang mungkin konflik */
    .goog-te-gadget [style*="display"],
    .goog-te-gadget [style*="vertical-align"],
    .goog-te-gadget [style*="white-space"] {
        display: inline-flex !important;
        align-items: center !important;
        vertical-align: middle !important;
        gap: 3px !important;
    }

    /* Responsive */
    @media (max-width: 768px) {

        .goog-te-gadget div,
        .goog-te-gadget span,
        .goog-te-gadget a {
            font-size: 10px !important;
        }

        .goog-te-gadget img {
            height: 10px !important;
        }
    }

    /* Fallback untuk memastikan tidak ada float */
    .goog-te-gadget,
    .goog-te-gadget * {
        float: none !important;
        clear: both !important;
    }

    [x-cloak] {
        display: none !important;
    }
</style>

<header x-data="{ sidebarOpen: false }" class="absolute w-full z-50">
    <!-- Logo dan Login Button -->
    <div class="w-full bg-transparent p-6 lg:px-8">
        <div class="flex justify-between items-center gap-4">
            <!-- Hamburger menu (Mobile - Left) -->
            <div class="flex lg:hidden justify-start">
                <button @click="sidebarOpen = true" type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 bg-white/30 backdrop-blur-sm cursor-pointer">
                    <span class="sr-only">Open menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 5.25a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10zm0 5.25a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 15.25z" />
                    </svg>
                </button>
            </div>

            <!-- Logo (Centered on mobile) -->
            <div class="flex justify-center lg:justify-start">
                <a href="{{ route('beranda') }}" class="-m-1.5 p-1.5">
                    <img class="h-[50px] sm:h-[75px] w-auto"
                        src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}" alt="Logo Yayasan" />
                </a>
            </div>

            <!-- Login Button (Right on mobile) -->
            <div class="flex justify-end items-center">
                @if (auth()->check())
                    @php
                        $user = auth()->user();
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
                    @endphp

                    @if ($profilePath)
                        <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar">
                            <img src="{{ asset('storage/' . $profilePath) }}" alt="Profile"
                                class="w-12 h-12 rounded-full object-cover border-2 border-gray-100/10 hover:scale-105 transition" />
                        </button>
                    @else
                        <button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar"
                            class="w-12 h-12 {{ $randomBg }} {{ $hoverBg }} rounded-full text-white flex items-center justify-center font-semibold uppercase select-none transition-colors duration-200 cursor-pointer text-lg">
                            {{ strtoupper(substr($user->username ?? ($user->nama ?? 'U'), 0, 1)) }}
                        </button>
                    @endif

                    <!-- Dropdown menu -->
                    <div id="dropdownAvatar"
                        class="z-10 right-0 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-xl max-w-60 min-w-44 ">
                        <div class="px-4 py-3 text-sm text-gray-900 ">
                            <div class="font-bold mb-1">{{ '@' . ($user->username ?? '-') }}</div>
                            <div class="text-gray-500">{{ $user->nama ?? '-' }}</div>
                        </div>
                        <ul class="pt-2 text-sm text-gray-700" aria-labelledby="dropdownUserAvatarButton">
                            <li>
                                <a href="{{ $user->role === 'admin' ? route('admin.profiles') : route('dashboard') }}"
                                    class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                            </li>
                            @if (!$user->role === 'admin')
                                <li>
                                    <a href="{{ route('user.edit-profile') }}"
                                        class="block px-4 py-2 hover:bg-gray-100">Edit Profile</a>
                                </li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="py-2">
                                    @csrf
                                    <button type="submit"
                                        class="block px-4 w-full py-2 text-sm text-red-700 hover:bg-red-100 text-left cursor-pointer">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block bg-amber-100 text-sm font-semibold text-gray-900 rounded-[50px] px-4 py-2.5 lg:px-6 lg:py-3.5 hover:bg-amber-200 transition">
                        Log in
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- fixed navbar -->
    <nav class="fixed mt-[-87px] left-1/2 transform -translate-x-1/2 z-50 hidden lg:block">
        <div class="h-[50px] px-6 flex justify-center items-center rounded-[75px] bg-white/30 backdrop-blur-md">
            <div class="flex gap-x-12 items-center">
                @foreach ($menus as $menu)
                    @php
                        $isActive = rtrim(request()->url(), '/') === rtrim($menu->url, '/');
                    @endphp

                    @if ($menu->children->count())
                        <div class="inline-flex items-center relative group cursor-default">
                            <p
                                class="relative text-sm font-semibold text-gray-800 drop-shadow-md group transition-transform duration-200 flex items-center gap-1 whitespace-nowrap overflow-hidden text-ellipsis">
                                {{ $menu->title }}
                                <svg class="w-3 h-3 text-gray-600 group-hover:rotate-180 transition-transform duration-300"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.21 8.27a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span
                                    class="absolute bottom-0 right-0 h-[2px] bg-amber-200 transition-all duration-300 
                                    {{ $isActive ? 'w-full left-0' : 'w-0 group-hover:w-full group-hover:right-auto left-0' }}">
                                </span>
                            </p>

                            <div
                                class="absolute top-full mt-2 left-0 bg-white shadow-lg rounded-lg opacity-0 
                                group-hover:opacity-100 group-hover:visible invisible 
                                transition duration-200 min-w-[160px]">
                                @foreach ($menu->children as $sub)
                                    @php
                                        $subActive = rtrim(request()->url(), '/') === rtrim($sub->url, '/');
                                    @endphp
                                    <a href="{{ $sub->url }}"
                                        class="block px-4 py-2 text-sm font-medium rounded-lg transition duration-200
                                        {{ $subActive
                                            ? 'bg-amber-100 text-gray-800 hover:bg-gray-700 hover:text-white'
                                            : 'text-gray-700 hover:bg-amber-100' }}">
                                        {{ $sub->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $menu->url }}"
                            class="relative text-sm font-semibold text-gray-800 drop-shadow-md group transition-transform duration-200 whitespace-nowrap overflow-hidden text-ellipsis">
                            {{ $menu->title }}
                            <span
                                class="absolute bottom-0 right-0 h-[2px] bg-amber-200 transition-all duration-300 
                                {{ $isActive ? 'w-full left-0' : 'w-0 group-hover:w-full group-hover:right-auto left-0' }}">
                            </span>
                        </a>
                    @endif
                @endforeach
                <div id="google_translate_element" class="translate-box"></div>
            </div>
        </div>
    </nav>

    <!-- Overlay -->
    <div x-show="sidebarOpen" x-cloak x-transition.opacity class="fixed inset-0 bg-black/25 z-40"
        @click="sidebarOpen = false">
    </div>

    <!-- Sidebar panel -->
    <div x-show="sidebarOpen" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed inset-y-0 right-0 z-50 w-full sm:max-w-sm bg-white p-6 overflow-y-auto ring-1 ring-gray-900/10"
        @click.away="sidebarOpen = false">
        <!-- Header Sidebar -->
        <div class="flex items-center justify-between mb-6">
            <a href="#" class="-m-1.5 p-1.5">
                <img class="h-8 w-auto" src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}" alt="Logo" />
            </a>
            <button @click="sidebarOpen = false" type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                <span class="sr-only">Close menu</span>
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Menu List -->
        <div x-data="{ openDropdown: null }">
            <div class="space-y-2">
                @foreach ($menus as $menu)
                    @php
                        $isActive = rtrim(request()->url(), '/') === rtrim($menu->url, '/');
                    @endphp

                    @if ($menu->children->count())
                        <div class="border border-gray-200 rounded-lg">
                            <button
                                @click="openDropdown === {{ $menu->id_menus }} ? openDropdown = null : openDropdown = {{ $menu->id_menus }}"
                                class="w-full flex justify-between items-center px-3 py-2 font-semibold text-gray-900">
                                <span>{{ $menu->title }}</span>
                                <svg class="h-5 w-5 transform transition-transform"
                                    :class="openDropdown === {{ $menu->id_menus }} ? 'rotate-180' : ''" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="openDropdown === {{ $menu->id_menus }}" x-collapse>
                                @foreach ($menu->children as $sub)
                                    <a href="{{ $sub->url }}"
                                        class="block px-6 py-2 text-sm text-gray-700 hover:bg-blue-100">
                                        {{ $sub->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $menu->url }}"
                            class="block px-3 py-2 text-base font-semibold text-gray-900 hover:bg-blue-100 rounded-lg">
                            {{ $menu->title }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</header>
