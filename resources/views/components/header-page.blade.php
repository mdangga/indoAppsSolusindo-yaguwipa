@props(['title', 'description' => '', 'id' => null])
<style>
    .header-page h1::after {
        content: "";
        position: absolute;
        left: 50%;
        top: 25%;
        transform: translate(-50%, -50%);
        width: 122px;
        height: 66px;
        background: url('{{ asset('img/section-title-bg.png') }}') no-repeat;
        background-size: contain;
        background-position: center;
        z-index: -1;
        opacity: .5;
        /* Tambahkan filter hue di sini */
        filter: hue-rotate(220deg);
        /* Supaya tidak ganggu teks */
        pointer-events: none;
    }

    /* Responsive design */
    @media (max-width: 640px) {
        .header-page h1::after {
            left: 50%;
            top: 17%;
        }
    }

    /* Responsive for tablet */
    @media (max-width: 768px) and (min-width: 641px) {
        .header-page h1::after {
            left: 50%;
            top: 17%;
        }
    }
</style>

<div class="relative py-20 text-center overflow-hidden section-title-bg">
    <div class="header-page relative z-10">
        <h1 {{ $id ? "id=$id" : '' }} class="text-4xl font-semibold text-gray-900">
            {{ $title }}
        </h1>
        @if ($description)
            <p class="mt-4 text-gray-700">
                {{ $description }}
            </p>
        @endif
    </div>
</div>
