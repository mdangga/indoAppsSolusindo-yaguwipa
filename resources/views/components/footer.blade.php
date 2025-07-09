<footer class="bg-gray-900 text-white py-10 px-6">
    <div class="max-w-screen-xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-6">
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
                @foreach ($site['yayasanSosmed'] as $sosmed)
                    <x-social-icon :link="$sosmed->link" :label="$sosmed->nama" />
                @endforeach

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
        <p>{{ $site['yayasanProfile']->copyright }}</p>
    </div>
</footer>
