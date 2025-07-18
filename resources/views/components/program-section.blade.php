@props([
    'id' => '',
    'title' => '',
    'programs' => [],
    'link' => null,
    'params' => [],
])

<section id="{{ $id }}" class="mt-10 w-full">
    <x-section-header :id="$id" :title="$title" :link="$link" :params="$params" buttonText="See More" />

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($programs as $prog)
            <x-program-card :program="$prog" />
        @endforeach
    </div>
</section>
