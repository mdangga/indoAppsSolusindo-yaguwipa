<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $program->name }} - Program Yayasan</title>

  {{-- icon --}}
  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net" />
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

  <!-- Laravel Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">

  {{-- navbar --}}
  <x-navbar :menus="$menus ?? []" />

  {{-- Konten Utama --}}
  <main class="max-w-4xl mx-auto px-4 pt-32 pb-10">
    <article class="bg-white rounded-xl shadow-md p-8">
      {{-- Judul --}}
      <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $program->nama }}</h1>

      {{-- Gambar --}}
      @if($program->image_path)
        <img src="{{ asset('storage/' . $program->image_path) }}" alt="{{ $program->nama }}"
          class="w-full h-64 object-cover rounded-lg shadow mb-4">
      @endif

      {{-- Status dan Kategori --}}
      <div class="flex flex-wrap items-center gap-2 mb-4">
        <span class="inline-block px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-800">
          {{ $program->KategoriProgram->nama ?? 'Tanpa Kategori' }}
        </span>
        <span class="inline-block px-3 py-1 text-sm rounded-full 
          {{ $program->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
          {{ $program->status }}
        </span>
      </div>

      {{-- Deskripsi --}}
      <div class="prose max-w-none text-justify mb-6">
        <p>{{ $program->deskripsi }}</p>
      </div>

      {{-- Pihak yang Terlibat --}}
      <div>
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Pihak yang Ikut:</h2>
        <ul class="list-disc pl-5 space-y-1 text-sm text-gray-700">
          @forelse($program->institusiTerlibat as $institusi)
            <li>
              {{ $institusi->nama }}
              <span class="text-xs text-gray-400">
                ({{ \Carbon\Carbon::parse($institusi->joined_at)->translatedFormat('d M Y') }})
              </span>
            </li>
          @empty
            <li class="text-gray-400 italic">Belum ada institusi terlibat.</li>
          @endforelse
        </ul>
      </div>
    </article>
  </main>

  {{-- footer --}}
  <x-footer />

  <script>
    AOS.init();
  </script>
</body>

</html>
