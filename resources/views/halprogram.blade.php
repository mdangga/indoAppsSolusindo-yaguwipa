<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Berita - Yayasan Guna Widya Paramesti</title>

  {{-- icon --}}
  <link rel="icon" type="image/png" href="{{ asset('storage/' . $site['yayasanProfile']->favicon) }}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net" />
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

  <!-- Laravel Vite -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  {{-- custom styling --}}
  <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">

  <!-- AOS Library -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">

 {{-- navbar --}}
 <x-navbar :menus="$menus" />
  {{-- Konten utama --}}
  <main class="max-w-4xl mx-auto px-4 py-10 pt-30">
    <article class="bg-white rounded-lg shadow-sm p-8">
      <h1 class="text-3xl font-bold mb-6 text-gray-900">
        Di Balik Tagar Save Raja Ampat dan Ekspansi Nikel yang Kian Gawat
      </h1>

      <img src="https://via.placeholder.com/800x450/93C5FD/FFFFFF?text=Gambar+Berita" alt="Aktivitas pertambangan nikel" class="w-full rounded-lg shadow-md mb-4">
      <p class="text-sm text-gray-500 mb-2">Aktivitas pertambangan nikel di Pulau Kawe, Raja Ampat, Papua.</p>
      <div class="flex items-center text-sm text-gray-400 mb-6 space-x-4">
        <span>⏰ 6 hari lalu</span>
        <span>Bagikan:</span>
        <div class="flex space-x-2">
          <button class="text-gray-400 hover:text-blue-600">𝕏</button>
          <button class="text-gray-400 hover:text-blue-600">📘</button>
          <button class="text-gray-400 hover:text-green-600">💬</button>
        </div>
      </div>

      <div class="prose max-w-none text-justify">
        <p><strong>Nationalgeographic.co.id</strong> — Aksi kampanye menggunakan tagar <em>"Save <a href="#" class="text-blue-600">Raja Ampat</a>"</em> sedang meramaikan media sosial. Salah satu pemicu awal tagar ini adalah temuan Greenpeace Indonesia yang menyorot adanya aktivitas pertambangan <a href="#" class="text-blue-600">nikel</a> di pulau-pulau kecil Raja Ampat di <a href="#" class="text-blue-600">Papua</a>—wilayah yang sering disebut sebagai surga terakhir di dunia.</p>
        <p>"Total itu ada sekitar 16 izin penambangan nikel di Raja Ampat yang kita tahu. Terus 5 itu sudah beroperasi," ujar perwakilan Greenpeace.</p>
      </div>
    </article>
  </main>

    {{-- end lembaga --}}
    <x-footer />

  <script>
    AOS.init();
  </script>
</body>
</html>
