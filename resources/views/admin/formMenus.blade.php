<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- Tailwind + JS Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-50">
    <x-admin.navbar />
    <x-admin.sidebar />
    <main class="p-6 sm:ml-64 pt-24 transition-all">
        <div class="w-full bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold mb-4">{{ isset($menu) ? 'Edit Menu' : 'Tambah Menu' }}</h1>

            @if (session('message'))
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ session('message') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-700 p-2 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php $isEdit = isset($menu); @endphp

            <form id="formMenus" action="{{ $isEdit ? route('menus.update', $menu->id_menus) : route('menus.store') }}" method="POST">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif

                <div class="grid md:grid-cols-2 gap-6 mt-4">
                    {{-- Parent Menu --}}
                    <div>
                        <label for="parent_menu" class="block mb-1 text-sm font-medium text-gray-900">Parent Menu</label>
                        <select id="parent_menu" name="parent_menu"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                            <option value="">Tidak ada</option>
                            @foreach ($menus as $item)
                                @if (!$isEdit || $menu->id_menus != $item->id_menus)
                                    <option value="{{ $item->id_menus }}"
                                        {{ old('parent_menu', $menu->parent_menu ?? '') == $item->id_menus ? 'selected' : '' }}>
                                        {{ $item->title }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('parent_menu')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    {{-- Title --}}
                    <div>
                        <label for="title" class="block mb-1 text-sm font-medium">Title</label>
                        <input id="title" type="text" name="title"
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                            placeholder="Masukkan title..."
                            value="{{ old('title', $isEdit ? $menu->title : '') }}" required />
                        @error('title')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- URL --}}
                <div class="mt-4">
                    <label for="url" class="block mb-1 text-sm font-medium">Url</label>
                    <input id="url" type="text" name="url"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5"
                        placeholder="Masukkan url..."
                        value="{{ old('url', $isEdit ? $menu->url : '') }}" />
                    @error('url')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mt-4">
                    <label for="status" class="block mb-1 text-sm font-medium">Status</label>
                    <select id="status" name="status"
                        class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                        <option value="show" {{ old('status', $menu->status ?? '') == 'show' ? 'selected' : '' }}>Show</option>
                        <option value="hide" {{ old('status', $menu->status ?? '') == 'hide' ? 'selected' : '' }}>Hide</option>
                    </select>
                    @error('status')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
