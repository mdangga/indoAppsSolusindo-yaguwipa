@props(['item'])
<div
    class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg hover:scale-[1.02] flex flex-col h-full">

    <!-- Image Container -->
    <div class="relative">
        <a href="{{ route('berita.show', $item->slug) }}" class="block">
            <img class="w-full h-48 object-cover"
                src="{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('storage/img/img-placeholder.webp') }}"
                alt="{{ $item->judul }}" />
        </a>
        <!-- Date badge overlay -->
        <div
            class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-full text-xs font-medium text-gray-700">
            {{ $item->KategoriNewsEvent->nama ?? 'Tanpa Kategori' }}
        </div>
    </div>

    <!-- Content -->
    <div class="p-5 flex flex-col flex-grow">
        <!-- Title -->
        <h5 class="text-lg font-semibold text-gray-900 mb-3 line-clamp-2 hover:text-blue-600 transition-colors">
            <a href="{{ route('berita.show', $item->slug) }}">
                {{ $item->judul }}
            </a>
        </h5>

        <!-- Excerpt -->
        <p class="text-gray-600 text-sm leading-relaxed mb-4 flex-grow line-clamp-3">
            {{ Str::limit(strip_tags($item->isi_berita), 250) }}
        </p>

        <!-- Footer -->
        <div class="flex items-center justify-between pt-2 border-t border-gray-100">
            <span class="text-xs text-gray-500">
                {{ \Carbon\Carbon::parse($item->tanggal_publish)->diffForHumans() }}
            </span>
        </div>
    </div>
</div>
