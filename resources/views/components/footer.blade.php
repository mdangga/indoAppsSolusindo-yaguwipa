<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
<footer class="bg-gray-900 text-white ">
    <div class="px-4 sm:px-6 lg:px-12">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 pt-10 ">
            <!-- Kiri: Info Yayasan -->
            <div class="flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold uppercase border-b border-gray-700 pb-2 mb-4">
                        {{ $site['yayasanProfile']->company }}</h2>
                    @php
                        $fields = [
                            'Alamat' => ['text' => 'Alamat', 'key' => 'address'],
                            'telp' => ['text' => 'Phone', 'key' => 'telephone'],
                            'fax' => ['text' => 'Fax', 'key' => 'fax'],
                            'email' => ['text' => 'Email', 'key' => 'email'],
                        ];
                    @endphp

                    @foreach ($fields as $field => $config)
                        @php $value = $site['yayasanProfile']->{$config['key']}; @endphp

                        @if (!is_null($value))
                            <p class="mb-2">
                                <span class="font-semibold">{{ $config['text'] }}:</span>
                                {{ $value }}
                            </p>
                        @endif
                    @endforeach
                </div>

                <div>
                    <p class="mt-4 mb-2 font-semibold">Follow Us:</p>
                    <div class="flex space-x-4">
                        @foreach ($site['yayasanSosmed'] as $sosmed)
                            <x-social-icon :link="$sosmed->link" :label="$sosmed->nama" />
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Tengah: Site Map -->
            <div>
                <h3 class="text-lg font-bold mb-4 border-b border-gray-700 pb-2">Site Map</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <ul class="space-y-3 text-sm">
                        @foreach ($menus->slice(0, ceil($menus->count() / 2)) as $menu)
                            <li>
                                <a href="{{ $menu->url }}"
                                    class="text-white hover:text-gray-200 font-medium flex items-center gap-2 transition-colors duration-200">
                                    <i class="fas fa-chevron-right text-amber-400 text-xs"></i>
                                    {{ $menu->title }}
                                </a>

                                @if ($menu->children->count())
                                    <ul class="mt-1 ml-4 space-y-1 border-l border-gray-700 pl-4">
                                        @foreach ($menu->children as $child)
                                            <li class="flex items-center gap-2">
                                                <a href="{{ $child->url }}"
                                                    class="text-gray-400 hover:text-gray-200 text-sm transition duration-150">
                                                    {{ $child->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>

                    <ul class="space-y-3 text-sm">
                        @foreach ($menus->slice(ceil($menus->count() / 2)) as $menu)
                            <li>
                                <a href="{{ $menu->url }}"
                                    class="text-white hover:text-gray-200 font-medium flex items-center gap-2 transition-colors duration-200">
                                    <i class="fas fa-chevron-right text-amber-400 text-xs"></i>
                                    {{ $menu->title }}
                                </a>

                                @if ($menu->children->count())
                                    <ul class="mt-1 ml-4 space-y-1 border-l border-gray-700 pl-4">
                                        @foreach ($menu->children as $child)
                                            <li class="flex items-center gap-2">
                                                <a href="{{ $child->url }}"
                                                    class="text-gray-400 hover:text-gray-200 text-sm transition duration-150">
                                                    {{ $child->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Kanan: Map -->
            <div
                class="relative max-w-full h-[250px] border-0 [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:rounded-md">
                {!! $site['yayasanProfile']->map !!}
            </div>
        </div>
    </div>
    <div class="bg-[#182238] text-white mt-5">
        <div class="max-w-screen-xl mx-auto py-4 grid grid-cols-1 md:grid-cols-2 md:gap-6">
            <div class="text-center md:text-left text-md">
                &copy; {{ $site['yayasanProfile']->copyright }}. All Rights Reserved.
            </div>
            <div class="text-center md:text-right text-md">
                Design with <i class="fa-solid fa-heart text-red-400"></i> by AnggaYudaRelia
            </div>
        </div>
    </div>
</footer>
