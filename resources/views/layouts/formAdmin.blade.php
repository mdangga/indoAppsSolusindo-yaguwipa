<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Admin')</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- Font Awesome (Opsional) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- Quill Snow Theme (Opsional) --}}
    @hasSection('quill')
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    @endif

    {{-- Highlight.js Theme (Opsional) --}}
    @hasSection('highlight')
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />
    @endif

    {{-- KaTeX CSS (Opsional) --}}
    @hasSection('katex')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />
    @endif

    {{-- App CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="bg-gray-100 min-h-screen font-sans antialiased">

    {{-- Navbar & Sidebar --}}
    <x-admin.navbar-admin />
    <x-admin.sidebar />

    <main class="p-4 md:ml-64 pt-20">
        <div class="w-full bg-white p-6 rounded shadow">
            @yield('content')
        </div>
    </main>

    {{-- Scripts --}}
    @hasSection('highlight')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    @endif

    @hasSection('katex')
        <script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    @endif

    @hasSection('quill')
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.min.js"></script>
    @endif

    @stack('scripts')
</body>

</html>
