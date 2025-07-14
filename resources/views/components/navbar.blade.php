<header class="absolute w-full z-50">
    <!-- Logo dan Login Button -->
    <div class="w-full bg-transparent p-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-3 items-center gap-4">
            <div class="flex justify-start">
                <a href="{{ route('beranda') }}" class="-m-1.5 p-1.5">
                    <img class="h-[75px] w-auto" src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}"
                        alt="Company Logo" />
                </a>
            </div>

            <div class="hidden lg:block"></div>

            <div class="hidden justify-end items-center lg:flex">
                <!-- Language Selector Desktop -->
                <div class="hidden justify-end items-center lg:flex">
                    <!-- Dropdown Bahasa Custom -->
                    <div x-data="{ open: false, selectedLang: 'id' }" class="relative">
                        <button @click="open = !open"
                            class="bg-white/20 backdrop-blur-sm text-sm font-semibold text-gray-900 rounded-full px-4 py-2 hover:bg-white/30 transition flex items-center space-x-2">
                            <span
                                x-text="{
                'id': '🇮🇩 ID',
                'en': '🇺🇸 EN',
                'ms': '🇲🇾 MS',
                'th': '🇹🇭 TH',
                'vi': '🇻🇳 VI',
                'zh-CN': '🇨🇳 ZH',
                'ja': '🇯🇵 JA',
                'ko': '🇰🇷 KO'
            }[selectedLang]"></span>
                            <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 z-50">
                            <div class="py-1">
                                <!-- Loop Bahasa -->
                                @foreach ([['id', '🇮🇩', 'Bahasa Indonesia'], ['en', '🇺🇸', 'English'], ['ms', '🇲🇾', 'Bahasa Melayu'], ['th', '🇹🇭', 'ไทย'], ['vi', '🇻🇳', 'Tiếng Việt'], ['zh-CN', '🇨🇳', '中文'], ['ja', '🇯🇵', '日本語'], ['ko', '🇰🇷', '한국어']] as [$code, $flag, $label])
                                    <button
                                        @click="selectedLang = '{{ $code }}'; open = false; changeGoogleLanguage('{{ $code }}')"
                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 flex items-center space-x-3"
                                        :class="selectedLang === '{{ $code }}' ? 'bg-indigo-50 text-indigo-700' : ''">
                                        <span>{{ $flag }}</span>
                                        <span>{{ $label }}</span>
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('login') }}"
                        class="bg-amber-100 text-sm font-semibold text-gray-900 rounded-[50px] px-6 py-3.5 hover:bg-amber-200 transition">
                        Log in
                    </a>
                </div>

                <div class="flex lg:hidden justify-end">
                    <button type="button" id="mobile-menu-button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- fixed navbar -->
        <nav class="fixed top-10 left-1/2 transform -translate-x-1/2 z-50 hidden lg:block">
            <div class="h-[50px] px-6 flex justify-center items-center rounded-[75px] bg-white/30 backdrop-blur-md">
                <div class="flex gap-x-12">
                    @foreach ($menus as $menu)
                        @php
                            $isActive = rtrim(request()->url(), '/') === rtrim($menu->url, '/');
                        @endphp

                        @if ($menu->children->count())
                            <div class="inline-flex items-center relative group">
                                <p
                                    class="relative text-sm font-semibold text-gray-800 drop-shadow-md group transition-transform duration-200">
                                    {{ $menu->title }}
                                </p>

                                <div
                                    class="absolute top-full mt-2 left-0 bg-white shadow-lg rounded-lg opacity-0 
                        group-hover:opacity-100 group-hover:visible invisible 
                        transition duration-200 min-w-[160px]">
                                    @foreach ($menu->children as $sub)
                                        @php
                                            $subActive = rtrim(request()->url(), '/') === rtrim($sub->url, '/');
                                        @endphp
                                        <a href="{{ $sub->url }}"
                                            class="block px-4 py-2 text-sm font-medium rounded-lg transition duration-200
                        {{ $subActive
                            ? 'bg-amber-100 text-gray-800 hover:bg-gray-700 hover:text-white'
                            : 'text-gray-700 hover:bg-amber-100' }}">
                                            {{ $sub->title }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ $menu->url }}"
                                class="relative text-sm font-semibold text-gray-800 drop-shadow-md group transition-transform duration-200">
                                {{ $menu->title }}
                                <span
                                    class="absolute bottom-0 right-0 h-[2px] bg-amber-200 transition-all duration-300 
                    {{ $isActive ? 'w-full left-0' : 'w-0 group-hover:w-full group-hover:right-auto left-0' }}">
                                </span>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </nav>
        
        <div id="mobile-menu" class="lg:hidden fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-black/25"></div>
            <div
                class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="mt-6 px-4 flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <img class="h-8 w-auto" src="{{ asset('storage/' . $site['yayasanProfile']->logo) }}"
                            alt="" />
                    </a>
                    <button type="button" id="close-menu-button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
                        <span class="sr-only">Close menu</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6" x-data="{ openDropdown: null }">
                            @foreach ($menus as $menu)
                                @php
                                    $isActive = rtrim(request()->url(), '/') === rtrim($menu->url, '/');
                                @endphp

                                @if ($menu->children->count())
                                    <div class="border border-gray-200 rounded-lg">
                                        <button
                                            @click="openDropdown === {{ $menu->id_menus }} ? openDropdown = null : openDropdown = {{ $menu->id_menus }}"
                                            class="w-full flex justify-between items-center px-3 py-2 font-semibold text-gray-900">
                                            <span>{{ $menu->title }}</span>
                                            <svg class="h-5 w-5 transform transition-transform"
                                                :class="openDropdown === {{ $menu->id_menus }} ? 'rotate-180' : ''"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>

                                        <div x-show="openDropdown === {{ $menu->id_menus }}" x-collapse>
                                            @foreach ($menu->children as $sub)
                                                <a href="{{ $sub->url }}"
                                                    class="block px-6 py-2 text-sm text-gray-700 hover:bg-blue-100">
                                                    {{ $sub->title }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ $menu->url }}"
                                        class="block px-3 py-2 text-base font-semibold text-gray-900 hover:bg-blue-100">
                                        {{ $menu->title }}
                                    </a>
                                @endif
                            @endforeach
                        </div>

                        <div class="py-6">
                            <a href="{{ route('login') }}"
                                class="-mx-3 block px-3 py-2.5 text-base/7 font-semibold text-gray-900 text-center rounded-full hover:bg-blue-100">
                                Log in
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Hide Google Translate element -->
        <div id="google_translate_element" style="display: none;"></div>
</header>

<!-- Load Alpine.js -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Google Translate Script -->
<script>
    // Global variables
    let isTranslateReady = false;
    let googleTranslateSelect = null;
    let pendingLanguageChange = null;

    function googleTranslateElementInit() {
        try {
            new google.translate.TranslateElement({
                pageLanguage: 'id',
                includedLanguages: 'id,en,ms,th,vi,zh-CN,ja,ko',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                autoDisplay: false
            }, 'google_translate_element');
            
            console.log('Google Translate initialized');
            waitForTranslateReady();
        } catch (error) {
            console.error('Error initializing Google Translate:', error);
        }
    }

    function waitForTranslateReady() {
        let attempts = 0;
        const maxAttempts = 100;
        const checkInterval = 100;

        const checkReady = () => {
            const select = document.querySelector('select.goog-te-combo');
            
            if (select && select.options && select.options.length > 1) {
                googleTranslateSelect = select;
                isTranslateReady = true;
                console.log('Google Translate is ready with', select.options.length, 'options');
                
                // Hide translate elements
                hideTranslateElements();
                
                // Handle pending language change
                if (pendingLanguageChange) {
                    changeGoogleLanguage(pendingLanguageChange);
                    pendingLanguageChange = null;
                }
                
                // Set up change listener
                select.addEventListener('change', function() {
                    console.log('Language changed to:', select.value);
                    updateCustomDropdown(select.value);
                });
                
                return;
            }
            
            attempts++;
            if (attempts < maxAttempts) {
                setTimeout(checkReady, checkInterval);
            } else {
                console.error('Google Translate failed to load after', maxAttempts, 'attempts');
                // Fallback: try to reload
                setTimeout(() => {
                    location.reload();
                }, 5000);
            }
        };
        
        checkReady();
    }

    function hideTranslateElements() {
        // Create and inject CSS to hide Google Translate elements
        const style = document.createElement('style');
        style.id = 'google-translate-custom-style';
        style.textContent = `
            .goog-te-banner-frame,
            .goog-te-menu-frame,
            .skiptranslate,
            #google_translate_element,
            .goog-te-spinner-pos {
                display: none !important;
            }
            
            body {
                top: 0px !important;
                position: static !important;
            }
            
            .goog-te-combo {
                display: none !important;
            }
        `;
        
        if (!document.getElementById('google-translate-custom-style')) {
            document.head.appendChild(style);
        }
    }

    function updateCustomDropdown(langCode) {
        // Find Alpine.js component and update it
        const dropdownElement = document.querySelector('[x-data*="selectedLang"]');
        if (dropdownElement) {
            // Use Alpine's $dispatch to update the data
            if (window.Alpine) {
                window.Alpine.evaluate(dropdownElement, '$data.selectedLang = "' + (langCode || 'id') + '"');
            }
        }
    }

    function changeGoogleLanguage(langCode) {
        console.log('Attempting to change language to:', langCode);
        
        if (!isTranslateReady || !googleTranslateSelect) {
            console.warn('Google Translate not ready, queuing language change');
            pendingLanguageChange = langCode;
            return;
        }

        try {
            // Check if the language code is valid
            const option = Array.from(googleTranslateSelect.options).find(opt => opt.value === langCode);
            if (!option) {
                console.error('Language code not found:', langCode);
                return;
            }

            // Set the value
            googleTranslateSelect.value = langCode;
            
            // Create and dispatch change event
            const changeEvent = new Event('change', {
                bubbles: true,
                cancelable: true
            });
            
            googleTranslateSelect.dispatchEvent(changeEvent);
            
            console.log('Language changed to:', langCode);
            
        } catch (error) {
            console.error('Error changing language:', error);
        }
    }

    // Load Google Translate script when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        // Check if script already exists
        if (document.querySelector('script[src*="translate.google.com"]')) {
            console.log('Google Translate script already loaded');
            return;
        }

        // Load the script
        const script = document.createElement('script');
        script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
        script.async = true;
        script.defer = true;
        script.onerror = function() {
            console.error('Failed to load Google Translate script');
        };
        
        document.head.appendChild(script);
        console.log('Google Translate script loaded');
    });

    // Handle mobile menu functionality
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const closeMenuButton = document.getElementById('close-menu-button');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.remove('hidden');
            });
        }

        if (closeMenuButton && mobileMenu) {
            closeMenuButton.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        }
    });

    // Debug function to check translate status
    function checkTranslateStatus() {
        console.log('Translate ready:', isTranslateReady);
        console.log('Google select:', googleTranslateSelect);
        console.log('Pending change:', pendingLanguageChange);
        
        const select = document.querySelector('select.goog-te-combo');
        if (select) {
            console.log('Available options:', Array.from(select.options).map(opt => opt.value));
        }
    }
    
    // Make debug function available globally
    window.checkTranslateStatus = checkTranslateStatus;
</script>