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

        function buildMobileNavItems(pathname) {
            var normalizedPath = pathname.toLowerCase();
            if (normalizedPath.indexOf("/admin/") !== -1) {
                return [
                    { label: "Dashboard", href: "dashboard_siswa.html", icon: "fa-solid fa-house" },
                    { label: "Kelas", href: "kelas_siswa.html", icon: "fa-solid fa-chalkboard-user" },
                    { label: "Tugas", href: "tugas_siswa.html", icon: "fa-solid fa-clipboard-list" },
                    { label: "Jadwal", href: "jadwal_siswa.html", icon: "fa-solid fa-calendar-days" }
                ];
            }

            if (normalizedPath.indexOf("/superadmin/") !== -1) {
                return [
                    { label: "Dashboard", href: "dashboard.html", icon: "fa-solid fa-house" },
                    { label: "Kelas", href: "class_all.html", icon: "fa-solid fa-chalkboard-user" },
                    { label: "Notifikasi", href: "notifikasi.html", icon: "fa-solid fa-bell" },
                    { label: "Pengaturan", href: "pengaturan_website.html", icon: "fa-solid fa-gear" }
                ];
            }

            return [];
        }

        function injectMobileBottomNav() {
            var navItems = buildMobileNavItems(window.location.pathname);
            if (!navItems.length) {
                return;
            }

            var mobileNav = document.createElement("nav");
            mobileNav.className = "mobile-bottom-nav";

            var currentFile = window.location.pathname.split("/").pop().toLowerCase();
            navItems.forEach(function (item) {
                var link = document.createElement("a");
                link.href = item.href;
                if (currentFile === item.href.toLowerCase()) {
                    link.classList.add("active");
                }
                link.innerHTML = '<i class="' + item.icon + '"></i><span>' + item.label + "</span>";
                mobileNav.appendChild(link);
            });

            document.body.appendChild(mobileNav);
        }

        document.body.appendChild(toggleButton);
        document.body.appendChild(overlay);
        updateLayoutByScreen();
        injectMobileBottomNav();
    }

    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", setupSidebarToggle);
    } else {
        setupSidebarToggle();
    }
})();
