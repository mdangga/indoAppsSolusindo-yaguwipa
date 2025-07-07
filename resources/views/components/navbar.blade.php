<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<header class="absolute w-full z-50">
    <!-- Logo dan Login Button -->
    <div class="w-full bg-transparent p-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-3 items-center gap-4">
            <div class="flex justify-start">
                <a href="{{ route('beranda') }}" class="-m-1.5 p-1.5">
                    <img class="h-[75px] w-auto" src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}"
                        alt="Company Logo" />
                </a>
            </div>

            <div class="hidden lg:block"></div>

            <div class="hidden justify-end items-center lg:flex">
                <a href="{{ route('login') }}"
                    class="bg-blue-100 text-sm font-semibold text-gray-900 rounded-[50px] px-6 py-3.5 hover:bg-blue-200 transition">
                    Log in
                </a>
            </div>

            <div class="flex lg:hidden justify-end">
                <button type="button" id="mobile-menu-button"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- fixed navbar -->
    <nav class="fixed top-10 left-1/2 transform -translate-x-1/2 z-50 hidden lg:block">
        <div class="h-[50px] px-6 flex justify-center items-center rounded-[75px] bg-white/30 backdrop-blur-md">
            <div class="flex gap-x-12">
                @foreach ($menus as $menu)
                    @php
                        $isActive = rtrim(request()->url(), '/') === rtrim($menu->url, '/');
                    @endphp

                    @if ($menu->children->count())
                        <div class="inline-flex items-center relative group">
                            <p
                                class="relative text-sm font-semibold text-gray-900 group transition-transform duration-200">
                                {{ $menu->title }}
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
                            class="relative text-sm font-semibold text-gray-900 group transition-transform duration-200">
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
    <div id="mobile-menu" class="lg:hidden fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-black/25"></div>
        <div
            class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
            <div class="mt-6 px-4 flex items-center justify-between">
                <a href="#" class="-m-1.5 p-1.5">
                    <img class="h-8 w-auto" src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}"
                        alt="" />
                </a>
                <button type="button" id="close-menu-button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Close menu</span>
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="mt-6 flow-root">
                <div class="-my-6 divide-y divide-gray-500/10">
                    <div class="space-y-2 py-6" x-data="{ openDropdown: null }">
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
                                            :class="openDropdown === {{ $menu->id_menus }} ? 'rotate-180' : ''"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
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
                                    class="block px-3 py-2 text-base font-semibold text-gray-900 hover:bg-blue-100">
                                    {{ $menu->title }}
                                </a>
                            @endif
                        @endforeach

                    </div>


                    <div class="py-6">
                        <a href="{{ route('login') }}"
                            class="-mx-3 block px-3 py-2.5 text-base/7 font-semibold text-gray-900 text-center rounded-full hover:bg-blue-100">
                            Log in
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
