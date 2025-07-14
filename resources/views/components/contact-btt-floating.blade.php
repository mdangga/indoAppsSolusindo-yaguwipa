<!-- Contact Widget -->
<div id="contact-widget" class="fixed z-50 flex flex-col items-end space-y-3" style="bottom: 1.75rem; right: 1.75rem;">
    <!-- Contact Info Box -->
    <div id="contact-info" class="contact-box bg-white text-gray-800 rounded-lg p-4 w-64 shadow-xl border border-gray-200 text-sm hidden">
        <div class="flex items-center mb-3">
            <i class="fa-solid fa-headset text-green-500 mr-2"></i>
            <p class="font-semibold text-gray-800">Hubungi Kami</p>
        </div>
        
        <div class="space-y-2">
            <a href="mailto:contact@example.com" class="contact-link flex items-center text-blue-600 hover:text-blue-800 p-2 rounded-md hover:bg-blue-50 transition-all duration-200">
                <i class="fa-solid fa-envelope w-5 mr-3"></i>
                <span>contact@example.com</span>
            </a>
            
            <a href="https://wa.me/6281234567890" target="_blank" class="contact-link flex items-center text-green-600 hover:text-green-800 p-2 rounded-md hover:bg-green-50 transition-all duration-200">
                <i class="fa-brands fa-whatsapp w-5 mr-3"></i>
                <span>WhatsApp</span>
            </a>
            
            <a href="tel:+6281234567890" class="contact-link flex items-center text-purple-600 hover:text-purple-800 p-2 rounded-md hover:bg-purple-50 transition-all duration-200">
                <i class="fa-solid fa-phone w-5 mr-3"></i>
                <span>+62 812-3456-7890</span>
            </a>
        </div>
    </div>

    <!-- Contact Toggle Button -->
    <button id="contact-toggle" class="w-14 h-14 flex items-center justify-center bg-green-500 hover:bg-green-600 text-white text-xl rounded-full shadow-lg transition-all duration-300 pulse-animation hover:scale-110">
        <i class="fa-solid fa-comments"></i>
    </button>
</div>

<!-- Back to Top Button -->
<button id="back-to-top" class="back-to-top hidden fixed w-14 h-14 items-center justify-center bg-blue-600 hover:bg-blue-700 text-white text-xl rounded-full shadow-lg z-50 hover:scale-110" style="bottom: 6rem; right: 1.75rem;">
    <i class="fa-solid fa-arrow-up"></i>
</button>

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

    .animate-fade-in {
        animation: fade-in 0.3s ease forwards;
    }

    .animate-slide-in {
        animation: slide-in 0.3s ease forwards;
    }

    /* Smooth transitions untuk contact box */
    .contact-box {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .contact-box.hidden {
        opacity: 0;
        transform: translateY(10px);
        pointer-events: none;
    }

    .contact-box.show {
        opacity: 1;
        transform: translateY(0);
        pointer-events: all;
    }

    /* Pulse animation untuk toggle button */
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

    /* Hover effects untuk contact links */
    .contact-link:hover {
        transform: translateX(4px);
        transition: transform 0.2s ease;
    }

    /* Back to top button smooth appearance dan positioning */
    .back-to-top {
        transition: all 0.3s ease;
    }

    .back-to-top.hidden {
        opacity: 0;
        transform: translateY(20px);
        pointer-events: none;
    }

    .back-to-top.show {
        opacity: 1;
        transform: translateY(0);
        pointer-events: all;
    }

    /* Back to top button naik ke atas saat contact box terbuka */
    .back-to-top.contact-active {
        transform: translateY(-10rem); /* Naik ke atas saat contact box terbuka */
    }

    /* Responsive design */
    @media (max-width: 640px) {
        .contact-box {
            width: 240px;
            margin-right: 0.5rem;
        }
        
        #contact-widget {
            bottom: 1rem;
            right: 1rem;
        }
        /* Back to top button naik ke atas saat contact box terbuka */
        .back-to-top.contact-active {
            bottom: 12rem; /* Naik ke atas saat contact box terbuka */
        }
    }
</style>

<!-- Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // DOM Elements
        const toggleBtn = document.getElementById('contact-toggle');
        const contactBox = document.getElementById('contact-info');
        const backToTopBtn = document.getElementById('back-to-top');
        const contactWidget = document.getElementById('contact-widget');

        // State tracking
        let isContactBoxVisible = false;

        // Toggle contact info dengan animasi yang lebih smooth
        toggleBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            
            if (isContactBoxVisible) {
                hideContactBox();
            } else {
                showContactBox();
            }
        });

        // Functions untuk show/hide contact box
        function showContactBox() {
            contactBox.classList.remove('hidden');
            // Force reflow untuk memastikan animasi berjalan
            contactBox.offsetHeight;
            contactBox.classList.add('show');
            contactBox.classList.add('animate-slide-in');
            
            // Naikkan back to top button
            backToTopBtn.classList.add('contact-active');
            
            isContactBoxVisible = true;
        }

        function hideContactBox() {
            contactBox.classList.remove('show');
            contactBox.classList.remove('animate-slide-in');
            
            // Turunkan back to top button kembali
            backToTopBtn.classList.remove('contact-active');
            
            setTimeout(() => {
                contactBox.classList.add('hidden');
            }, 300);
            isContactBoxVisible = false;
        }

        // Hide contact info jika clicked outside
        document.addEventListener('click', (e) => {
            if (!contactWidget.contains(e.target) && isContactBoxVisible) {
                hideContactBox();
            }
        });

        // Keyboard support - ESC to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isContactBoxVisible) {
                hideContactBox();
            }
        });

        // Show/Hide Back to Top button on scroll dengan throttling
        let scrollTimeout;
        window.addEventListener('scroll', () => {
            if (scrollTimeout) {
                clearTimeout(scrollTimeout);
            }
            
            scrollTimeout = setTimeout(() => {
                if (window.scrollY > 300) {
                    backToTopBtn.classList.remove('hidden');
                    backToTopBtn.classList.add('show');
                } else {
                    backToTopBtn.classList.remove('show');
                    backToTopBtn.classList.add('hidden');
                }
            }, 10);
        });

        // Scroll to top on click dengan smooth behavior
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ 
                top: 0, 
                behavior: 'smooth' 
            });
        });

        // Auto-hide contact box after 5 seconds jika tidak ada interaksi
        let autoHideTimeout;
        
        function resetAutoHide() {
            if (autoHideTimeout) {
                clearTimeout(autoHideTimeout);
            }
            
            if (isContactBoxVisible) {
                autoHideTimeout = setTimeout(() => {
                    hideContactBox();
                }, 5000);
            }
        }

        // Reset auto-hide timer saat ada interaksi
        contactBox.addEventListener('mouseenter', () => {
            if (autoHideTimeout) {
                clearTimeout(autoHideTimeout);
            }
        });

        contactBox.addEventListener('mouseleave', resetAutoHide);
    });
</script>