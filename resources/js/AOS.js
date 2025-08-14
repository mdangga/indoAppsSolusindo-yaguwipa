// init AOS when have data-aos
document.addEventListener("DOMContentLoaded", function () {
    if (document.querySelector("[data-aos]") && typeof AOS !== "undefined") {
        AOS.init({
            duration: 1000,
            once: true,
        });
    }
});
