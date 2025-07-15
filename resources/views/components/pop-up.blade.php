{{-- resources/views/components/pop-up.blade.php --}}
@props(['imageSrc', 'imageAlt' => 'Image', 'show' => true])

<div 
    x-data="{ show: {{ $show ? 'true' : 'false' }} }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @keydown.escape.window="show = false"
    class="fixed inset-0 z-[8888] flex items-center justify-center"
    x-cloak
>
    <!-- Latar belakang blur -->
    <div 
        @click="show = false"
        class="absolute inset-0 bg-black/50 backdrop-blur-sm"
    ></div>

    <!-- Konten popup -->
    <div @click.stop class="relative z-10 max-w-4xl max-h-full p-4">
        <!-- Tombol close -->
        <button 
            @click="show = false"
            class="absolute top-2 right-2 z-20 flex items-center justify-center w-8 h-8 bg-white text-black hover:bg-amber-200 hover:text-gray-500 bg-opacity-20 hover:bg-opacity-30 rounded-full transition-colors duration-200"
            aria-label="Close popup"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Gambar -->
        <img 
            src="{{ asset('storage/' . $imageSrc) }}" 
            alt="{{ $imageAlt }}"
            class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl"
        >
    </div>
</div>
