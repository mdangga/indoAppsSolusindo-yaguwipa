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

    {{-- Bagian Campaign Donasi --}}
    <section class="mt-8" data-aos="fade-up">
      {{-- Card Ringkasan Total --}}
      <div class="bg-gradient-to-r from-blue-50 to-green-50 rounded-xl shadow-md p-6 mb-6" data-aos="fade-up">
        <h2 class="text-xl font-bold text-gray-900 mb-4 text-center">Ringkasan Campaign Donasi</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="text-center">
            <div class="bg-white rounded-lg p-4 shadow-sm">
              <p class="text-sm text-gray-500 mb-1">Total Terkumpul</p>
              <p class="text-2xl font-bold text-green-600">Rp 76.500.000</p>
            </div>
          </div>
          <div class="text-center">
            <div class="bg-white rounded-lg p-4 shadow-sm">
              <p class="text-sm text-gray-500 mb-1">Total Target</p>
              <p class="text-2xl font-bold text-gray-900">Rp 130.000.000</p>
            </div>
          </div>
          <div class="text-center">
            <div class="bg-white rounded-lg p-4 shadow-sm">
              <p class="text-sm text-gray-500 mb-1">Total Donatur</p>
              <p class="text-2xl font-bold text-blue-600">490 orang</p>
            </div>
          </div>
        </div>
        {{-- Progress Bar Total --}}
        <div class="mt-6">
          <div class="flex justify-between text-sm text-gray-600 mb-2">
            <span class="font-medium">Progress Keseluruhan</span>
            <span class="font-medium">59%</span>
          </div>
          <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-gradient-to-r from-green-400 to-blue-500 h-4 rounded-full" style="width: 59%"></div>
          </div>
        </div>
      </div>

      {{-- List Campaign Donasi --}}
      <div class="bg-white rounded-xl shadow-md p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Daftar Campaign Donasi</h2>
        
        {{-- Campaign Donasi 1 --}}
        <div class="border-b border-gray-200 pb-6 mb-6" data-aos="fade-up" data-aos-delay="100">
          <div class="flex flex-col md:flex-row gap-6">
            {{-- Foto Campaign --}}
            <div class="md:w-64 md:flex-shrink-0">
              <img src="https://images.unsplash.com/photo-1497486751825-1233686d5d80?w=400&h=300&fit=crop" 
                   alt="Donasi Pendidikan Anak Yatim"
                   class="w-full h-48 md:h-40 object-cover rounded-lg shadow-sm">
            </div>

            {{-- Detail Campaign --}}
            <div class="flex-1">
              <h3 class="text-xl font-bold text-gray-900 mb-2">
                Donasi Pendidikan Anak Yatim
              </h3>
              
              {{-- Progress Bar --}}
              <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                  <span>Terkumpul</span>
                  <span>75%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                  <div class="bg-green-500 h-3 rounded-full" style="width: 75%"></div>
                </div>
              </div>

              {{-- Jumlah Terkumpul vs Target --}}
              <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                  <p class="text-sm text-gray-500">Terkumpul</p>
                  <p class="text-lg font-bold text-green-600">Rp 37.500.000</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Target</p>
                  <p class="text-lg font-bold text-gray-900">Rp 50.000.000</p>
                </div>
              </div>

              {{-- Status Campaign --}}
              <div class="flex items-center gap-2">
                <span class="inline-block px-3 py-1 text-sm rounded-full bg-green-100 text-green-700">
                  Aktif
                </span>
                <span class="text-sm text-gray-500">• 156 donatur</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Campaign Donasi 2 --}}
        <div class="border-b border-gray-200 pb-6 mb-6" data-aos="fade-up" data-aos-delay="200">
          <div class="flex flex-col md:flex-row gap-6">
            {{-- Foto Campaign --}}
            <div class="md:w-64 md:flex-shrink-0">
              <img src="https://images.unsplash.com/photo-1559757148-5c350d0d3c56?w=400&h=300&fit=crop" 
                   alt="Donasi Kesehatan Anak"
                   class="w-full h-48 md:h-40 object-cover rounded-lg shadow-sm">
            </div>

            {{-- Detail Campaign --}}
            <div class="flex-1">
              <h3 class="text-xl font-bold text-gray-900 mb-2">
                Donasi Kesehatan Anak
              </h3>
              
              {{-- Progress Bar --}}
              <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                  <span>Terkumpul</span>
                  <span>45%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                  <div class="bg-blue-500 h-3 rounded-full" style="width: 45%"></div>
                </div>
              </div>

              {{-- Jumlah Terkumpul vs Target --}}
              <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                  <p class="text-sm text-gray-500">Terkumpul</p>
                  <p class="text-lg font-bold text-blue-600">Rp 13.500.000</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Target</p>
                  <p class="text-lg font-bold text-gray-900">Rp 30.000.000</p>
                </div>
              </div>

              {{-- Status Campaign --}}
              <div class="flex items-center gap-2">
                <span class="inline-block px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-700">
                  Aktif
                </span>
                <span class="text-sm text-gray-500">• 89 donatur</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Campaign Donasi 3 --}}
        <div class="border-b border-gray-200 pb-6 mb-6" data-aos="fade-up" data-aos-delay="300">
          <div class="flex flex-col md:flex-row gap-6">
            {{-- Foto Campaign --}}
            <div class="md:w-64 md:flex-shrink-0">
              <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=400&h=300&fit=crop" 
                   alt="Donasi Perlengkapan Sekolah"
                   class="w-full h-48 md:h-40 object-cover rounded-lg shadow-sm">
            </div>

            {{-- Detail Campaign --}}
            <div class="flex-1">
              <h3 class="text-xl font-bold text-gray-900 mb-2">
                Donasi Perlengkapan Sekolah
              </h3>
              
              {{-- Progress Bar --}}
              <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                  <span>Terkumpul</span>
                  <span>90%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                  <div class="bg-yellow-500 h-3 rounded-full" style="width: 90%"></div>
                </div>
              </div>

              {{-- Jumlah Terkumpul vs Target --}}
              <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                  <p class="text-sm text-gray-500">Terkumpul</p>
                  <p class="text-lg font-bold text-yellow-600">Rp 18.000.000</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Target</p>
                  <p class="text-lg font-bold text-gray-900">Rp 20.000.000</p>
                </div>
              </div>

              {{-- Status Campaign --}}
              <div class="flex items-center gap-2">
                <span class="inline-block px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-700">
                  Hampir Tercapai
                </span>
                <span class="text-sm text-gray-500">• 203 donatur</span>
              </div>
            </div>
          </div>
        </div>

        {{-- Campaign Donasi 4 --}}
        <div class="pb-6 mb-6 last:border-b-0 last:pb-0 last:mb-0" data-aos="fade-up" data-aos-delay="400">
          <div class="flex flex-col md:flex-row gap-6">
            {{-- Foto Campaign --}}
            <div class="md:w-64 md:flex-shrink-0">
              <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?w=400&h=300&fit=crop" 
                   alt="Donasi Makanan Bergizi"
                   class="w-full h-48 md:h-40 object-cover rounded-lg shadow-sm">
            </div>

            {{-- Detail Campaign --}}
            <div class="flex-1">
              <h3 class="text-xl font-bold text-gray-900 mb-2">
                Donasi Makanan Bergizi
              </h3>
              
              {{-- Progress Bar --}}
              <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                  <span>Terkumpul</span>
                  <span>25%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3">
                  <div class="bg-orange-500 h-3 rounded-full" style="width: 25%"></div>
                </div>
              </div>

              {{-- Jumlah Terkumpul vs Target --}}
              <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                  <p class="text-sm text-gray-500">Terkumpul</p>
                  <p class="text-lg font-bold text-orange-600">Rp 7.500.000</p>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Target</p>
                  <p class="text-lg font-bold text-gray-900">Rp 30.000.000</p>
                </div>
              </div>

              {{-- Status Campaign --}}
              <div class="flex items-center gap-2">
                <span class="inline-block px-3 py-1 text-sm rounded-full bg-orange-100 text-orange-700">
                  Membutuhkan Dukungan
                </span>
                <span class="text-sm text-gray-500">• 42 donatur</span>
              </div>
            </div>
          </div>
        </div>

        </div>
      </div>
    </section>
  </main>

  {{-- footer --}}
  <x-footer />

  <script>
    AOS.init();
  </script>
</body>

</html>