<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', $site['yayasanProfile']->nama_yayasan)</title>

    {{-- Icon --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->favicon) }}">

    {{-- Global CSS & JS via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- alpine js navbar collapse --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- google translate script for navbar --}}
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
            }, 'google_translate_element');
        };
    </script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    {{-- css khusus halaman --}}
    @stack('styles')

    {{-- js khusus halaman --}}
    @stack('scripts-head')
</head>

<body>
    {{-- Loader --}}
    <x-loader-component />

    {{-- Navbar --}}
    <x-navbar :menus="$menus" />

    {{-- Floating Button --}}
    <x-contact-btt-floating size="default" :auto-hide="true" :auto-hide-delay="3000" :show-back-to-top="true" :scroll-threshold="200" />

    {{-- Konten halaman --}}

    @yield('content')

    {{-- footer --}}
    <x-footer />
    {{-- Scripts khusus halaman --}}
    @stack('scripts')
</body>

</html>
