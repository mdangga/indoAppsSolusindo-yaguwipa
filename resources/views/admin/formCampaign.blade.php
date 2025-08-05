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

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Quill Snow Theme --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

    {{-- Highlight.js Theme --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css" />

    {{-- KaTeX CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.css" />

</head>

<body>
    <x-admin.navbar />
    <x-admin.sidebar />

    <main class="p-4 md:ml-64 pt-20">
        <div class="container">
            <h1>{{ isset($campaign) ? 'Edit' : 'Buat' }} Campaign</h1>

            <form
                action="{{ isset($campaign) ? route('campaigns.update', $campaign->id_campaign) : route('campaigns.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($campaign))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <label for="nama">Nama Campaign</label>
                    <input type="text" class="form-control" id="nama" name="nama"
                        value="{{ old('nama', $campaign->nama ?? '') }}" required>
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $campaign->deskripsi ?? '') }}</textarea>
                    @error('deskripsi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Gambar Campaign</label>
                    <input type="file" class="form-control-file" id="image_path" name="image_path">
                    @if (isset($campaign) && $campaign->image_path)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $campaign->image_path) }}" alt="Gambar Campaign"
                                style="max-width: 200px;">
                        </div>
                    @endif
                    @error('image_path')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="target_dana">Target Dana (Rp)</label>
                    <input type="number" class="form-control" id="target_dana" name="target_dana"
                        value="{{ old('target_dana', $campaign->target_dana ?? '') }}" required>
                    @error('target_dana')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai"
                        value="{{ old('tanggal_mulai', isset($campaign) ? $campaign->tanggal_mulai->format('Y-m-d') : '') }}"
                        required>
                    @error('tanggal_mulai')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai</label>
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai"
                        value="{{ old('tanggal_selesai', isset($campaign) ? $campaign->tanggal_selesai->format('Y-m-d') : '') }}"
                        required>
                    @error('tanggal_selesai')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="aktif"
                            {{ old('status', $campaign->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif"
                            {{ old('status', $campaign->status ?? '') == 'nonaktif' ? 'selected' : '' }}>Nonaktif
                        </option>
                        <option value="selesai"
                            {{ old('status', $campaign->status ?? '') == 'selesai' ? 'selected' : '' }}>Selesai
                        </option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lokasi">Lokasi</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi"
                        value="{{ old('lokasi', $campaign->lokasi ?? '') }}" required>
                    @error('lokasi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="id_program">Program</label>
                    <select class="form-control" id="id_program" name="id_program" required>
                        @foreach ($programs as $program)
                            <option value="{{ $program->id_program }}"
                                {{ old('id_program', $campaign->id_program ?? '') == $program->id_program ? 'selected' : '' }}>
                                {{ $program->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_program')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('campaigns.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </main>

    {{-- Quill Setup --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/katex@0.16.9/dist/katex.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.min.js"></script>

    <script>
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Compose an epic...',
            modules: {
                syntax: true, // Syntax highlighting
                formula: true, // KaTeX formula
                toolbar: '#toolbar-container'
            }
        });

        // Optional: re-highlight code blocks after content change
        quill.on('text-change', function() {
            document.querySelectorAll('pre code').forEach(block => {
                hljs.highlightElement(block);
            });
        });

        const form = document.querySelector('#formBerita');
        form.addEventListener('submit', function() {
            const isi_berita = document.querySelector('#isi_berita');
            isi_berita.value = quill.root.innerHTML;
        });
    </script>
    </script>
</body>

</html>
