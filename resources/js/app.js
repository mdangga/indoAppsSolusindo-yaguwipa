import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    // Get mobile menu elements
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");
    const closeMenuButton = document.getElementById("close-menu-button");
    const mobileMenuPanel = mobileMenu.querySelector(".fixed.inset-y-0");
    const backdrop = mobileMenu.querySelector(
        ".fixed.inset-0.bg-black\\/25, .fixed.inset-0.bg-black\\/50"
    );

    // Function to open mobile menu
    function openMobileMenu() {
        mobileMenu.classList.remove("hidden");
        setTimeout(() => {
            if (mobileMenuPanel) {
                mobileMenuPanel.style.transform = "translateX(0)";
            }
        }, 10);

        const menuIcon = mobileMenuButton.querySelector("svg path");
        if (menuIcon) {
            menuIcon.setAttribute("d", "M6 18 18 6M6 6l12 12");
        }

        document.body.style.overflow = "hidden";
    }

    function closeMobileMenu() {
        if (mobileMenuPanel) {
            mobileMenuPanel.style.transform = "translateX(100%)";
        }

        setTimeout(() => {
            mobileMenu.classList.add("hidden");
        }, 300);

        const menuIcon = mobileMenuButton.querySelector("svg path");
        if (menuIcon) {
            menuIcon.setAttribute(
                "d",
                "M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
            );
        }

        // Restore body scroll
        document.body.style.overflow = "";
    }

    // Mobile menu button click event
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();

            if (mobileMenu.classList.contains("hidden")) {
                openMobileMenu();
            } else {
                closeMobileMenu();
            }
        });
    }

    // Close menu button click event
    if (closeMenuButton) {
        closeMenuButton.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            closeMobileMenu();
        });
    }

    // Close menu when clicking on backdrop only
    if (mobileMenu) {
        mobileMenu.addEventListener("click", function (e) {
            // Only close if clicking on the backdrop (not the menu panel or menu items)
            if (
                e.target === mobileMenu ||
                e.target.classList.contains("bg-black/25") ||
                e.target.classList.contains("bg-black/50")
            ) {
                closeMobileMenu();
            }
        });

        // Prevent menu panel clicks from bubbling up to backdrop
        if (mobileMenuPanel) {
            mobileMenuPanel.addEventListener("click", function (e) {
                e.stopPropagation();
            });
        }
    }

    const mobileMenuLinks = mobileMenu.querySelectorAll(
        "a[href]:not(#mobile-dropdown-button)"
    );
    mobileMenuLinks.forEach((link) => {
        link.addEventListener("click", function () {
            setTimeout(closeMobileMenu, 100);
        });
    });

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && !mobileMenu.classList.contains("hidden")) {
            closeMobileMenu();
        }
    });

    // Responsive behavior - close mobile menu when resizing to desktop
    window.addEventListener("resize", function () {
        if (
            window.innerWidth >= 1024 &&
            !mobileMenu.classList.contains("hidden")
        ) {
            closeMobileMenu();
        }
    });

    // Initialize mobile menu panel position
    if (mobileMenuPanel) {
        mobileMenuPanel.style.transform = "translateX(100%)";
        mobileMenuPanel.style.transition = "transform 0.3s ease-in-out";
    }
});
AOS.init({
    duration: 1000, // durasi animasi (ms)
    once: true, // hanya muncul sekali
});
