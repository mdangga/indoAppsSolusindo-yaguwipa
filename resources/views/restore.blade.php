<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laravel</title>
    <!-- Fonts -->
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- AOS Library -->
    <style>
        body {
            font-family: 'Instrument Sans', sans-serif;
        }

        .img-container {
            position: relative;
            overflow: hidden;
        }

        .img-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 1;
        }

        .img-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(6, 8, 220, 0.8) 0%, rgba(147, 51, 234, 0.2) 50%, rgba(252, 253, 175, 0.4) 100%);
            z-index: 2;
            opacity: 0.5;
            background-color: rgba(0, 0, 0, 0.805);
            -webkit-backdrop-filter: blur(50px);
            backdrop-filter: blur(50px);
        }

        .content-overlay {
            position: relative;
            z-index: 3;
        }
    </style>
</head>

<body class="h-full bg-gray-50">
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Pulihkan Akun Anda
                </h2>
            </div>
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif
            <form class="mt-8 space-y-6" action="{{ route('profile.restore') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input id="username" name="username" type="text" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Pulihkan Akun
                    </button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>
