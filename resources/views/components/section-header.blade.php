@props(['title', 'link' => null, 'buttonText' => 'See More'])


<div class="flex flex-row items-center justify-between pb-10 gap-4">
    <div class="section-title">
        <h1 {{ $attributes->merge(['class' => 'relative text-3xl font-semibold text-gray-900']) }}>
            {{ $title }}
        </h1>
    </div>

    @if ($link)
        <a href="{{ route($link) }}"
            class="rounded-full px-6 py-3 text-sm font-semibold text-black bg-white hover:bg-gray-100 border-2 border-gray-300 shadow-sm focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-gray-600">
            {{ $buttonText ?? 'See More' }}
        </a>
    @endif
</div>
