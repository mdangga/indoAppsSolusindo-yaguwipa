<header class="absolute w-full z-50">
    <!-- Logo dan Login Button -->
    <div class="w-full bg-transparent p-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-3 items-center gap-4">
            <div class="flex justify-start">
                <a href="{{ route('beranda') }}" class="-m-1.5 p-1.5">
                    <img class="h-[75px] w-auto" src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}" alt="Company Logo" />
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
        <div class="h-[50px] px-6 flex justify-center items-center rounded-[75px] bg-white/5 backdrop-blur-sm">
            <div class="flex gap-x-12">
                @foreach ($menus as $menu)
                    @if ($menu->subMenus->count())
                        <div class="inline-flex items-center relative group">
                            <a href="{{ $menu->link }}"
                                class="text-sm font-semibold text-gray-900 border-b-2 border-transparent hover:border-amber-200 transition duration-200">
                                {{ $menu->nama_menu }}
                            </a>
                            <div
                                class="absolute top-full mt-2 left-0 bg-white shadow-lg rounded-lg py-2 opacity-0 group-hover:opacity-100 group-hover:visible invisible transition duration-200 min-w-[160px]">
                                @foreach ($menu->subMenus as $sub)
                                    <a href="{{ $sub->link }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100">
                                        {{ $sub->nama_menu }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ $menu->link }}"
                            class="text-sm font-semibold text-gray-900 border-b-2 transition duration-200
       {{ request()->url() === url($menu->link) ? 'border-amber-200' : 'border-transparent hover:border-amber-200' }}">
                            {{ $menu->nama_menu }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </nav>
</header>
