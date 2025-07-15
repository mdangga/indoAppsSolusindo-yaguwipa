{{-- resources/views/components/contact-widget.blade.php --}}
@props([
    'email',
    'phone',
    'autoHide' => true,
    'autoHideDelay' => 5000,
    'showBackToTop' => true,
    'scrollThreshold' => 300,
    'size' => 'default',,
])

@php
    $whatsapp = $site['yayasanSosmed']->filter(fn($item) => strtolower($item->nama) === 'whatsapp')->first()->link ?? null;

    // Size classes
    $sizes = [
        'sm' => [
            'button' => 'w-12 h-12',
            'box' => 'w-56',
            'icon' => 'text-lg',
        ],
        'default' => [
            'button' => 'w-14 h-14',
            'box' => 'w-64',
            'icon' => 'text-xl',
        ],
        'lg' => [
            'button' => 'w-16 h-16',
            'box' => 'w-72',
            'icon' => 'text-2xl',
        ],
    ];

    $currentSize = $sizes[$size] ?? $sizes['default'];
@endphp

<!-- Contact Widget -->
<div id="contact-widget" class="fixed z-50 flex flex-col items-end space-y-3 bottom-7 right-7">
    <!-- Contact Info Box -->
    <div id="contact-info"
        class="contact-box bg-white border-gray-200 {{ $currentSize['box'] }} rounded-lg p-4 shadow-xl border text-sm hidden transition-all duration-300 ease-out"
        role="dialog" aria-label="Contact Information" aria-hidden="true">

        <div class="flex items-center mb-3">
            <i class="fas fa-headset text-green-500 mr-2" aria-hidden="true"></i>
            <p class="font-semibold text-gray-800">Hubungi Kami</p>
        </div>

        <div class="space-y-2">
            @if ($email)
                <!-- Email -->
                <a href="mailto:{{ $email }}"
                    class="contact-link flex items-center text-blue-600 hover:text-blue-800 p-2 rounded-md hover:bg-blue-50 transition-all duration-200"
                    aria-label="Send email to {{ $email }}">
                    <i class="fas fa-envelope w-5 mr-3" aria-hidden="true"></i>
                    <span>{{ $email }}</span>
                </a>
            @endif

            @if ($whatsapp)
                <!-- WhatsApp -->
                <a href="{{ $whatsapp }}" target="_blank" rel="noopener noreferrer"
                    class="contact-link flex items-center text-green-600 hover:text-green-800 p-2 rounded-md hover:bg-green-50 transition-all duration-200"
                    aria-label="Open WhatsApp chat">
                    <i class="fab fa-whatsapp w-5 mr-3" aria-hidden="true"></i>
                    <span>WhatsApp</span>
                </a>
            @endif

            @if ($phone)
                <!-- Phone -->
                <a href="tel:{{ $phone }}"
                    class="contact-link flex items-center text-purple-600 hover:text-purple-800 p-2 rounded-md hover:bg-purple-50 transition-all duration-200"
                    aria-label="Call {{ $phone }}">
                    <i class="fas fa-phone w-5 mr-3" aria-hidden="true"></i>
                    <span>{{ $phone }}</span>
                </a>
            @endif
        </div>
    </div>

    <!-- Contact Toggle Button -->
    <button id="contact-toggle"
        class="{{ $currentSize['button'] }} flex items-center justify-center bg-green-500 hover:bg-green-600 text-white {{ $currentSize['icon'] }} rounded-full shadow-lg transition-all duration-300 pulse-animation hover:scale-110 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
        aria-label="Toggle contact information" aria-expanded="false" aria-controls="contact-info">
        <i class="fas fa-comments" aria-hidden="true"></i>
    </button>
</div>

@if ($showBackToTop)
    <!-- Back to Top Button -->
    <button id="back-to-top"
        class="back-to-top fixed {{ $currentSize['button'] }} items-center justify-center bg-amber-400 hover:bg-amber-500 text-white {{ $currentSize['icon'] }} rounded-full shadow-lg z-40 hover:scale-110 transition-all duration-400 ease-out focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hidden"
        style="bottom: 6rem; right: 1.75rem;" aria-label="Back to top">
        <i class="fas fa-arrow-up " aria-hidden="true"></i>
    </button>
@endif

<!-- Styles -->
<style>
    @keyframes fade-in {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slide-in {
        from {
            opacity: 0;
            transform: translateX(20px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes zoom-in {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }

        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes zoom-out {
        0% {
            opacity: 1;
            transform: scale(1);
        }

        100% {
            opacity: 0;
            transform: scale(0.3);
        }
    }

    .animate-zoom-out {
        animation: zoom-out 0.3s ease forwards;
    }

    .animate-zoom-in {
        animation: zoom-in 0.3s ease forwards;
    }


    .animate-fade-in {
        animation: fade-in 0.3s ease forwards;
    }

    .animate-slide-in {
        animation: slide-in 0.3s ease forwards;
    }

    /* Smooth transitions for contact box */
    .contact-box {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .contact-box.hidden {
        opacity: 0;
        transform: translateY(15px) scale(0.95);
        pointer-events: none;
        visibility: hidden;
    }

    .contact-box.show {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: all;
        visibility: visible;
    }

    /* Pulse animation for toggle button */
    .pulse-animation {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(34, 197, 94, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(34, 197, 94, 0);
        }
    }

    /* Hover effects for contact links */
    .contact-link:hover {
        transform: translateX(4px);
        transition: transform 0.2s ease;
    }

    /* Back to top button smooth appearance */
    .back-to-top {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .back-to-top.hidden {
        opacity: 0;
        transform: translateY(30px) scale(0.8);
        pointer-events: none;
        visibility: hidden;
    }

    .back-to-top.show {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: all;
        visibility: visible;
    }

    /* Back to top button adjustment when contact box is open */
    .back-to-top.contact-active {
        transform: translateY(-12rem) scale(1);
    }

    /* Responsive design */
    @media (max-width: 640px) {
        .contact-box {
            width: 240px !important;
        }

        #contact-widget {
            bottom: 1rem !important;
            right: 1rem !important;
        }

        .back-to-top {
            bottom: 5rem !important;
            right: 1rem !important;
        }

        .back-to-top.contact-active {
            transform: translateY(-12rem) scale(1) !important;
        }
    }

    /* Responsive for tablet */
    @media (max-width: 768px) and (min-width: 641px) {
        .contact-box {
            width: 250px !important;
        }

        #contact-widget {
            bottom: 1.5rem !important;
            right: 1.5rem !important;
        }

        .back-to-top {
            bottom: 5.5rem !important;
            right: 1.5rem !important;
        }

        .back-to-top.contact-active {
            transform: translateY(-12rem) scale(1) !important;
        }
    }
</style>

<!-- Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configuration
        const config = {
            autoHide: @json($autoHide),
            autoHideDelay: @json($autoHideDelay),
            scrollThreshold: @json($scrollThreshold),
            showBackToTop: @json($showBackToTop)
        };

        // DOM Elements
        const toggleBtn = document.getElementById('contact-toggle');
        const contactBox = document.getElementById('contact-info');
        const backToTopBtn = document.getElementById('back-to-top');
        const contactWidget = document.getElementById('contact-widget');

        // State tracking
        let isContactBoxVisible = false;
        let autoHideTimeout;
        let scrollTimeout;

        // Utility functions
        function isMobile() {
            return window.innerWidth <= 640;
        }

        function isTablet() {
            return window.innerWidth <= 768 && window.innerWidth > 640;
        }

        // Toggle contact info with smooth animation
        if (toggleBtn) {
            toggleBtn.addEventListener('click', (e) => {
                e.stopPropagation();

                if (isContactBoxVisible) {
                    hideContactBox();
                } else {
                    showContactBox();
                }
            });
        }

        // Functions for show/hide contact box
        function showContactBox() {
            if (!contactBox) return;

            contactBox.classList.remove('hidden');
            contactBox.setAttribute('aria-hidden', 'false');

            // Force reflow to ensure animation runs
            contactBox.offsetHeight;

            contactBox.classList.add('show');
            contactBox.classList.add('animate-slide-in');

            // Update toggle button aria-expanded
            if (toggleBtn) {
                toggleBtn.setAttribute('aria-expanded', 'true');
            }

            // Adjust back to top button position
            if (config.showBackToTop && backToTopBtn) {
                backToTopBtn.classList.add('contact-active');
            }

            isContactBoxVisible = true;

            // Set auto-hide timer
            if (config.autoHide) {
                resetAutoHide();
            }
        }

        function hideContactBox() {
            if (!contactBox) return;

            contactBox.classList.remove('show');
            contactBox.classList.remove('animate-slide-in');
            contactBox.setAttribute('aria-hidden', 'true');

            // Update toggle button aria-expanded
            if (toggleBtn) {
                toggleBtn.setAttribute('aria-expanded', 'false');
            }

            // Reset back to top button position
            if (config.showBackToTop && backToTopBtn) {
                backToTopBtn.classList.remove('contact-active');
            }

            setTimeout(() => {
                contactBox.classList.add('hidden');
            }, 300);

            isContactBoxVisible = false;

            // Clear auto-hide timer
            if (autoHideTimeout) {
                clearTimeout(autoHideTimeout);
                autoHideTimeout = null;
            }
        }

        // Auto-hide functionality
        function resetAutoHide() {
            if (autoHideTimeout) {
                clearTimeout(autoHideTimeout);
                autoHideTimeout = null;
            }

            if (isContactBoxVisible && config.autoHide) {
                autoHideTimeout = setTimeout(() => {
                    hideContactBox();
                }, config.autoHideDelay);
            }
        }

        // Event listeners
        document.addEventListener('click', (e) => {
            if (contactWidget && !contactWidget.contains(e.target) && isContactBoxVisible) {
                hideContactBox();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isContactBoxVisible) {
                hideContactBox();
            }
        });

        // Mouse events for auto-hide
        if (config.autoHide && contactBox) {
            contactBox.addEventListener('mouseenter', () => {
                if (autoHideTimeout) {
                    clearTimeout(autoHideTimeout);
                    autoHideTimeout = null;
                }
            });

            contactBox.addEventListener('mouseleave', resetAutoHide);
        }

        // Back to top functionality
        if (config.showBackToTop && backToTopBtn) {
            // Scroll event listener
            window.addEventListener('scroll', () => {
                if (scrollTimeout) {
                    clearTimeout(scrollTimeout);
                }

                scrollTimeout = setTimeout(() => {
                    if (window.scrollY > config.scrollThreshold) {
                        if (!backToTopBtn.classList.contains('show')) {
                            backToTopBtn.classList.remove('hidden', 'animate-zoom-out');
                            backToTopBtn.classList.add('show', 'animate-zoom-in');

                            setTimeout(() => {
                                backToTopBtn.classList.remove('animate-zoom-in');
                            }, 300); // sama dengan durasi animasi
                        }
                    } else {
                        if (backToTopBtn.classList.contains('show')) {
                            backToTopBtn.classList.remove('animate-zoom-in');
                            backToTopBtn.classList.add('animate-zoom-out');

                            setTimeout(() => {
                                backToTopBtn.classList.remove('show',
                                    'animate-zoom-out');
                                backToTopBtn.classList.add('hidden');
                            }, 300);
                        }
                    }

                }, 10);
            });

            // Click event for back to top
            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Cleanup on page unload
        window.addEventListener('beforeunload', () => {
            if (autoHideTimeout) {
                clearTimeout(autoHideTimeout);
            }
            if (scrollTimeout) {
                clearTimeout(scrollTimeout);
            }
        });
    });
</script>
