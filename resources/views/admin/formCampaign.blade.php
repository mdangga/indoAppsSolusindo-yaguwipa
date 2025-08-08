@extends('layouts.formAdmin')

@section('title', isset($campaign) ? 'Edit Campaign' : 'Buat Campaign Baru')

@section('content')
    <h1>{{ isset($campaign) ? 'Edit' : 'Buat' }} Campaign</h1>

    <form action="{{ isset($campaign) ? route('campaigns.update', $campaign->id_campaign) : route('campaigns.store') }}"
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
                <option value="aktif" {{ old('status', $campaign->status ?? '') == 'aktif' ? 'selected' : '' }}>Aktif
                </option>
                <option value="nonaktif" {{ old('status', $campaign->status ?? '') == 'nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>
                <option value="selesai" {{ old('status', $campaign->status ?? '') == 'selesai' ? 'selected' : '' }}>Selesai
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



@endsection

@push('scripts')
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
@endpush
