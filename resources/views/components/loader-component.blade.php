@vite(['resources/css/loader.css'])

<div class="loader-container" id="loader">
    <div class="loader"></div>
</div>

<script>
    window.addEventListener('load', () => {
        const loader = document.getElementById('loader');
        if (loader) {
            setTimeout(() => {
                loader.classList.add('loader-hidden');
                loader.addEventListener('transitionend', () => loader.remove());
            }, 300);
        }
    });
</script>
