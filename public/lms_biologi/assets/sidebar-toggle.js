(function () {
    function setupSidebarToggle() {
        var sidebar = document.querySelector(".sidebar");
        var mainContent = document.querySelector(".main-content");

        if (!sidebar || !mainContent) {
            return;
        }

        var body = document.body;
        var mobileQuery = window.matchMedia("(max-width: 991.98px)");

        var toggleButton = document.createElement("button");
        toggleButton.type = "button";
        toggleButton.className = "sidebar-toggle-btn";
        toggleButton.setAttribute("aria-label", "Buka atau tutup sidebar");
        toggleButton.innerHTML = '<i class="fa-solid fa-bars"></i>';

        var overlay = document.createElement("div");
        overlay.className = "sidebar-overlay";

        function closeMobileSidebar() {
            body.classList.remove("sidebar-open");
            body.style.overflow = "";
        }

        function openMobileSidebar() {
            body.classList.add("sidebar-open");
            body.style.overflow = "hidden";
        }

        function updateLayoutByScreen() {
            if (mobileQuery.matches) {
                body.classList.remove("sidebar-collapsed");
                body.classList.remove("sidebar-open");
                body.style.overflow = "";
            } else {
                body.classList.remove("sidebar-open");
                body.style.overflow = "";
            }
        }

        toggleButton.addEventListener("click", function () {
            if (mobileQuery.matches) {
                if (body.classList.contains("sidebar-open")) {
                    closeMobileSidebar();
                } else {
                    openMobileSidebar();
                }
            } else {
                body.classList.toggle("sidebar-collapsed");
            }
        });

        overlay.addEventListener("click", closeMobileSidebar);

        sidebar.querySelectorAll("a").forEach(function (link) {
            link.addEventListener("click", function () {
                if (mobileQuery.matches) {
                    closeMobileSidebar();
                }
            });
        });

        window.addEventListener("resize", updateLayoutByScreen);
        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape" && mobileQuery.matches) {
                closeMobileSidebar();
            }
        });

        document.body.appendChild(toggleButton);
        document.body.appendChild(overlay);
        updateLayoutByScreen();
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", setupSidebarToggle);
    } else {
        setupSidebarToggle();
    }
})();