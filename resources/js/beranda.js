document.addEventListener("DOMContentLoaded", function () {
    // Get mobile menu elements
    const mobileMenuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");
    const closeMenuButton = document.getElementById("close-menu-button");

    // Function to open mobile menu
    function openMobileMenu() {
        mobileMenu.classList.remove("hidden");

        const menuIcon = mobileMenuButton.querySelector("svg path");
        if (menuIcon) {
            menuIcon.setAttribute("d", "M6 18 18 6M6 6l12 12");
        }

        document.body.style.overflow = "hidden";
    }

    function closeMobileMenu() {
        setTimeout(() => {
            mobileMenu.classList.add("hidden");
        }, 1000);

        const menuIcon = mobileMenuButton.querySelector("svg path");
        if (menuIcon) {
            menuIcon.setAttribute(
                "d",
                "M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
            );
        }
        document.body.style.overflow = "";
    }

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

    if (closeMenuButton) {
        closeMenuButton.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            closeMobileMenu();
        });
    }

    if (mobileMenu) {
        mobileMenu.addEventListener("click", function (e) {
            if (
                e.target === mobileMenu ||
                e.target.classList.contains("bg-black/25") ||
                e.target.classList.contains("bg-black/50")
            ) {
                closeMobileMenu();
            }
        });
    }

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape" && !mobileMenu.classList.contains("hidden")) {
            closeMobileMenu();
        }
    });

    window.addEventListener("resize", function () {
        if (
            window.innerWidth >= 1024 &&
            !mobileMenu.classList.contains("hidden")
        ) {
            closeMobileMenu();
        }
    });
});
