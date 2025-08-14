@extends('layouts.main')

@section('title', 'Program')

@push('styles')
    <style>
        .category-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .program-card {
            transition: all 0.3s ease;
        }

        .program-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
    </style>
@endpush

@section('content')
    <main>
        <div class="px-4 sm:px-6 lg:px-12 py-16 ">
            <div class="max-w-7xl mx-auto pt-20">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <!-- Bagian Program -->
                    <div class="lg:col-span-3 space-y-12">
                        @foreach ($kategoriPrograms as $kategori)
                            <x-program-section :id="Str::slug($kategori->nama)" :title="$kategori->nama" :programs="$kategori->program" :link="'program.kategori'"
                                :params="['slug' => Str::slug($kategori->nama)]" />
                        @endforeach
                    </div>

                    <!-- Sidebar Berita Terkait -->
                    <div class="space-y-4 mt-13 lg:sticky lg:top-24 self-start">
                        <h2 class="text-lg font-semibold text-gray-800">Berita Terkait</h2>
                        @foreach ($beritaTerkait as $pop)
                            <a href="{{ route('berita.slug', $pop->slug) }}"
                                class="flex items-start gap-4 group hover:bg-gray-100 p-2 rounded-md transition">
                                <img src="{{ asset('storage/' . $pop->thumbnail) }}" alt="{{ $pop->judul }}"
                                    class="w-20 h-16 object-cover rounded" />
                                <div>
                                    <h3 class="text-sm font-medium text-gray-700 group-hover:text-black">
                                        {{ Str::limit($pop->judul, 60) }}
                                    </h3>
                                    <p class="text-xs text-gray-500">
                                        {{ $pop->KategoriNewsEvent->nama ?? 'Tanpa Kategori' }}
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
