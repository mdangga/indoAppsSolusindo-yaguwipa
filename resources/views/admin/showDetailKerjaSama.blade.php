<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Detail Kerja Sama</title>
    {{-- icon --}}
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="p-6 md:ml-64 pt-20">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-6 mt-6">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Detail Pengajuan Kerja Sama</h2>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700">Informasi Lembaga</h3>
                <div class="mt-2 space-y-1 text-sm text-gray-600">
                    <p><strong>Nama Lembaga:</strong> {{ $kerjasama->Mitra->User->nama }}</p>
                    <p><strong>Alamat:</strong> {{ $kerjasama->Mitra->User->alamat }}</p>
                    <p><strong>Email:</strong> {{ $kerjasama->Mitra->User->email }}</p>
                    <p><strong>No. Telp:</strong> {{ $kerjasama->Mitra->User->no_tlp }}</p>
                    <p><strong>Jenis Kerja Sama:</strong> {{ $kerjasama->KategoriKerjaSama->nama }}</p>
                    <p><strong>Keterangan:</strong> {{ $kerjasama->keterangan ?? '-' }}</p>
                    {{-- <p><strong>Tanggal mulai:</strong> {{ $kerjasama->tanggal_mulai->format('d M Y') }}</p>
                    <p><strong>Tanggal selesai:</strong> {{ $kerjasama->tanggal_selesai->format('d M Y') }}</p> --}}
                    <p><strong>Status:</strong>
                        @if ($kerjasama->status === 'pending')
                        <span class="text-yellow-500 font-semibold">Menunggu</span>
                        @elseif ($kerjasama->status === 'approved')
                        <span class="text-green-600 font-semibold">Diterima</span>
                        @elseif ($kerjasama->status === 'rejected')
                        <span class="text-red-600 font-semibold">Ditolak</span>
                        @elseif ($kerjasama->status === 'expired')
                        <span class="text-gray-600 font-semibold">Selesai</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-700">Lampiran File</h3>
                <ul class="list-disc pl-5 text-sm text-blue-600 mt-2">
                    @forelse ($kerjasama->FilePenunjang as $lampiran)
                    <li>
                        <a href="{{ asset('storage/' . $lampiran->file_path) }}" target="_blank" class="hover:underline">
                            {{ $lampiran->nama_file }}
                        </a>
                    </li>
                    @empty
                    <li class="text-gray-500">Tidak ada file lampiran.</li>
                    @endforelse
                </ul>
            </div>

            <div class="mt-6 flex space-x-2">
                <a href="{{ route('admin.kerjaSama') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Kembali</a>

                {{-- Tampilkan tombol aksi jika status masih pending --}}
                @if($kerjasama->status === 'pending')
                <form action="{{ route('kerjaSama.approved', $kerjasama->id_kerja_sama) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Terima
                    </button>
                </form>

                <form action="{{ route('kerjaSama.rejected', $kerjasama->id_kerja_sama) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                        Tolak
                    </button>
                </form>
                @endif
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

</body>

</html>