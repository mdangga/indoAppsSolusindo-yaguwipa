<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Tambah Berita</title>
    @vite('resources/css/app.css') {{-- Abaikan ini jika belum pakai Vite --}}
</head>
{{-- <body class="bg-gray-100 py-10">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Tambah Berita</h1>
        @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-2 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/berita" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="judul" class="block font-semibold mb-1">Judul</label>
                <input type="text" name="judul" id="judul" class="w-full border rounded p-2" required>
            </div>

            <div class="mb-4">
                <label for="keyword" class="block font-semibold mb-1">keyword</label>
                <input type="text" name="keyword" id="keyword" class="w-full border rounded p-2">
            </div>

            <div class="mb-4">
                <label for="isi_berita" class="block font-semibold mb-1">Isi Berita</label>
                <textarea name="isi_berita" id="isi_berita" rows="5" class="w-full border rounded p-2" required></textarea>
            </div>

            <div class="mb-4">
                <label for="thumbnail" class="block font-semibold mb-1">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="w-full">
            </div>

            <div class="mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_dipublish" value="1" class="mr-2">
                    Publikasikan sekarang
                </label>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Simpan Berita
            </button>
        </form>
    </div>
</body> --}}

<body>
    <h1>Upload Galeri</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="judul">Judul:</label>
        <input type="text" name="judul" id="judul" required><br><br>

        <label for="link">File (Foto/Video):</label>
        <input type="file" name="link" id="link" required><br><br>

        <label for="kategori">Kategori:</label>
        <select name="kategori" id="kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <option value="foto">Foto</option>
            <option value="video">Video</option>
        </select><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>

</html>
