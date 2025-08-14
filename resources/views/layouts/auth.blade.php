<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', $site['yayasanProfile']->nama_yayasan)</title>

    {{-- Icon --}}
    <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->favicon) }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- Global CSS & JS via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- css khusus halaman --}}
    @stack('styles')

    {{-- js khusus halaman --}}
    @stack('scripts-head')
</head>



<body class="bg-gray-50">
    {{-- content page --}}
    @yield('content')

    {{-- Scripts khusus halaman --}}
    @stack('scripts')
</body>

</html>
