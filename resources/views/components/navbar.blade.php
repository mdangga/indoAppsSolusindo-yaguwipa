<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    /* Styling kotak dropdown sebelum dibuka */
    .goog-te-gadget .goog-te-combo {
        background-color: rgba(255, 255, 255, 0.3) !important;
        color: rgb(47, 47, 47) !important;
        font-weight: 500 !important;
        border: 2px solid rgba(72, 72, 72, 0.084) !important;
        border-radius: 100px !important;
        padding: 10px 0px 10px 17px !important;
        font-size: 14px !important;
        font-family: "Instrument Sans", sans-serif !important;
        appearance: none !important;
        background-image: url("data:image/svg+xml,%3Csvg fill='rgb(47, 47, 47)' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.3rem center;
        background-size: 1.2rem;
        cursor: pointer;
        display: block !important;
        margin-bottom: 4px !important;
        top: 7.5px !important;
        position: relative !important;
        right: -70px !important;
        max-width: 160px !important;
        backdrop-filter: blur(5px) !important;
    }

    /* Saat dropdown difokuskan */
    .goog-te-combo:focus {
        /* outline: 2px solid #facc15 !important; */
        background-color: white !important;
        color: black !important;
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
        right: -80px !important;
        top: 3px !important;
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
        margin-top: 4px !important;
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

<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            // includedLanguages: 'en,id,es,fr,de,ja,ko,zh',
            layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
        }, 'google_translate_element');
    };
</script>


<header x-data="{ sidebarOpen: false }" class="absolute w-full z-50">
    <!-- Logo dan Login Button -->
    <div class="w-full bg-transparent p-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-3 items-center gap-4">
            <div class="flex justify-start">
                <a href="{{ route('beranda') }}" class="-m-1.5 p-1.5">
                    <img class="h-[50px] sm:h-[75px] w-auto"
                        src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}" alt="Company Logo" />
                </a>
            </div>

            <div class="hidden lg:block"></div>

            <div class="hidden justify-end items-center lg:flex">

                <div id="google_translate_element" class="mr-5"></div>

                <a href="{{ route('login') }}"
                    class="bg-amber-100 text-sm font-semibold text-gray-900 rounded-[50px] px-6 py-3.5 hover:bg-amber-200 transition">
                    Log in
                </a>
            </div>

            <!-- Tombol menu (Mobile) -->
            <div class="flex lg:hidden justify-end">
                <button @click="sidebarOpen = true" type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 bg-white/30 backdrop-blur-sm cursor-pointer">
                    <span class="sr-only">Open menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 5.25a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10zm0 5.25a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 15.25z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- fixed navbar -->
    <nav class="fixed mt-[-85px] left-1/2 transform -translate-x-1/2 z-50 hidden lg:block">
        <div class="h-[50px] px-6 flex justify-center items-center rounded-[75px] bg-white/30 backdrop-blur-md">
            <div class="flex gap-x-12">
                @foreach ($menus as $menu)
                    @php
                        $isActive = rtrim(request()->url(), '/') === rtrim($menu->url, '/');
                    @endphp

                    @if ($menu->children->count())
                        <div class="inline-flex items-center relative group">
                            <p
                                class="relative text-sm font-semibold text-gray-800 drop-shadow-md group transition-transform duration-200">
                                {{ $menu->title }}
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
                            class="relative text-sm font-semibold text-gray-800 drop-shadow-md group transition-transform duration-200">
                            {{ $menu->title }}
                            <span
                                class="absolute bottom-0 right-0 h-[2px] bg-amber-200 transition-all duration-300 
                    {{ $isActive ? 'w-full left-0' : 'w-0 group-hover:w-full group-hover:right-auto left-0' }}">
                            </span>
                        </a>
                    @endif
                @endforeach
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
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

            <!-- Login Button -->
            <div class="mt-6">
                <a href="{{ route('login') }}"
                    class="block w-full text-center bg-amber-100 py-2.5 rounded-full font-semibold text-gray-900 hover:bg-blue-100 md:px-7">
                    Log in
                </a>
            </div>
        </div>
    </div>
</header>

<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
