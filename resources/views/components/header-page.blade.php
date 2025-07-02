@props(['title', 'description' => '', 'id' => ''])

<div class="sm:flex-row pb-10 gap-4 text-center">
    <h1 @if ($id) id="{{ $id }}" @endif
        class="mt-15 text-3xl font-semibold text-gray-900">
        {{ $title }}
    </h1>
    @if ($description)
        <p class="mt-4">
            {{ $description }}
        </p>
    @endif
</div>
