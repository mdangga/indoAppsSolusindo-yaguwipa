<footer class="bg-gray-900 text-white py-10 px-6">
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Kiri: Info Yayasan -->
        <div>
            <h2 class="text-xl font-bold uppercase">{{ $site['yayasanProfile']->company }}</h2>

            @php
                $fields = [
                    'Alamat' => [
                        'text' => 'Alamat',
                        'key' => 'address',
                    ],
                    'telp' => [
                        'text' => 'Phone',
                        'key' => 'telephone',
                    ],
                    'fax' => [
                        'text' => 'Fax',
                        'key' => 'fax',
                    ],
                    'email' => [
                        'text' => 'Email',
                        'key' => 'email',
                    ],
                ];

            @endphp
            @foreach ($fields as $field => $config)
                @php
                    $value = $site['yayasanProfile']->{$config['key']};
                @endphp

                @if (!is_null($value))
                    <p class="mb-2">
                        <span class="font-semibold">{{ $config['text'] }} :</span>
                        {{ $value }}
                    </p>
                @endif
            @endforeach

            <p class="mt-4 mb-2 font-semibold">Follow Us :</p>
            <div class="flex space-x-4">
                <!-- YouTube -->
                <a href="#" class="text-white hover:text-red-200" aria-label="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m10 15l5.19-3L10 9zm11.56-7.83c.13.47.22 1.1.28 1.9c.07.8.1 1.49.1 2.09L22 12c0 2.19-.16 3.8-.44 4.83c-.25.9-.83 1.48-1.73 1.73c-.47.13-1.33.22-2.65.28c-1.3.07-2.49.1-3.59.1L12 19c-4.19 0-6.8-.16-7.83-.44c-.9-.25-1.48-.83-1.73-1.73c-.13-.47-.22-1.1-.28-1.9c-.07-.8-.1-1.49-.1-2.09L2 12c0-2.19.16-3.8.44-4.83c.25-.9.83-1.48 1.73-1.73c.47-.13 1.33-.22 2.65-.28c1.3-.07 2.49-.1 3.59-.1L12 5c4.19 0 6.8.16 7.83.44c.9.25 1.48.83 1.73 1.73" />
                    </svg>
                </a>
                <!-- Facebook -->
                <a href="#" class="text-white hover:text-blue-200" aria-label="Facebook">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95" />
                    </svg>
                </a>
                <!-- Instagram -->
                <a href="#" class="text-white hover:text-pink-200" aria-label="Instagram">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M13.028 2c1.125.003 1.696.009 2.189.023l.194.007c.224.008.445.018.712.03c1.064.05 1.79.218 2.427.465c.66.254 1.216.598 1.772 1.153a4.9 4.9 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428c.012.266.022.487.03.712l.006.194c.015.492.021 1.063.023 2.188l.001.746v1.31a79 79 0 0 1-.023 2.188l-.006.194c-.008.225-.018.446-.03.712c-.05 1.065-.22 1.79-.466 2.428a4.9 4.9 0 0 1-1.153 1.772a4.9 4.9 0 0 1-1.772 1.153c-.637.247-1.363.415-2.427.465l-.712.03l-.194.006c-.493.014-1.064.021-2.189.023l-.746.001h-1.309a78 78 0 0 1-2.189-.023l-.194-.006a63 63 0 0 1-.712-.031c-1.064-.05-1.79-.218-2.428-.465a4.9 4.9 0 0 1-1.771-1.153a4.9 4.9 0 0 1-1.154-1.772c-.247-.637-.415-1.363-.465-2.428l-.03-.712l-.005-.194A79 79 0 0 1 2 13.028v-2.056a79 79 0 0 1 .022-2.188l.007-.194c.008-.225.018-.446.03-.712c.05-1.065.218-1.79.465-2.428A4.9 4.9 0 0 1 3.68 3.678a4.9 4.9 0 0 1 1.77-1.153c.638-.247 1.363-.415 2.428-.465c.266-.012.488-.022.712-.03l.194-.006a79 79 0 0 1 2.188-.023zM12 7a5 5 0 1 0 0 10a5 5 0 0 0 0-10m0 2a3 3 0 1 1 .001 6a3 3 0 0 1 0-6m5.25-3.5a1.25 1.25 0 0 0 0 2.5a1.25 1.25 0 0 0 0-2.5" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Kanan: Kosongkan -->
        <div id="test" class="relative group max-w-full overflow-hidden">
            {{-- <div
                class="absolute inset-0 bg-gradient-to-br from-black/70 via-gray-800/60 to-black/70 rounded-md z-10 transition-opacity duration-300 group-hover:opacity-0 pointer-events-none">
            </div> --}}
            {{-- <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2828.1566751622727!2d115.23003191579483!3d-8.638782329040929!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd23f8661ef31cd%3A0x663c45c04ca4cfb3!2sPT.%20Indo%20Apps%20Solusindo%20-%20Apps%20%26%20Web%20Development%20%7C%20Software%20Services%20%7C%20Seo%20Services%20di%20Bali%20%7C%20Domain%20%26%20Hosting%20%7C%20IoT!5e0!3m2!1sid!2sid!4v1750918670426!5m2!1sid!2sid"
                class="rounded-md w-full h-[250px] border-0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe> --}}
            <div class="rounded-md w-full h-[250px] border-0">
                {!! $site['yayasanProfile']->map !!}
            </div>
        </div>
    </div>
</footer>
