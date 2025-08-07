@props([
    'type' => 'info',
    'message' => '',
    'duration' => 5000,
    'position' => 'bottom-right',
])

<div x-data="{
    show: false,
    type: '{{ $type }}',
    message: '{{ $message }}',
    init() {
        this.show = true;
        setTimeout(() => { this.show = false }, {{ $duration }});
    }
}" x-show="show" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed z-[9999] flex items-center gap-3 border-2 w-full max-w-xs p-4 rounded-lg shadow
        {{ $type === 'success'
            ? 'bg-green-50 border-green-500'
            : ($type === 'error'
                ? 'bg-red-50 border-red-500'
                : ($type === 'warning'
                    ? 'bg-yellow-50 border-yellow-500'
                    : 'bg-blue-50 border-blue-500')) }}
        {{ $position === 'top-right'
            ? 'top-4 right-4'
            : ($position === 'top-left'
                ? 'top-4 left-4'
                : ($position === 'bottom-left'
                    ? 'bottom-4 left-4'
                    : 'bottom-4 right-4')) }}"
    style="display: none;" x-cloak>

    <!-- Icon -->
    <div
        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg 
        {{ $type === 'success'
            ? 'text-green-500 bg-green-100'
            : ($type === 'error'
                ? 'text-red-500 bg-red-100'
                : ($type === 'warning'
                    ? 'text-yellow-500 bg-yellow-100'
                    : 'text-blue-500 bg-blue-100')) }}">
        <!-- SVG sesuai type -->
        @if ($type === 'success')
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
            </svg>
        @elseif($type === 'error')
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
            </svg>
        @elseif($type === 'warning')
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
        @else
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                    clip-rule="evenodd" />
            </svg>
        @endif
    </div>

    <!-- Message -->
    <div class="text-sm font-normal flex-1" x-text="message"></div>

    <!-- Close Button -->
    <button type="button" @click="show = false"
        class="text-gray-400 hover:text-gray-900 rounded-lg p-1.5 inline-flex h-8 w-8 items-center justify-center">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd" />
        </svg>
    </button>
</div>
