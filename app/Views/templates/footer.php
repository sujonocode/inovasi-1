</div>
<!-- Footer -->
<!-- ================== FOOTER PREMIUM SUPERAPP ================== -->
<footer id="footer" class="footer-blue text-white pt-5 pb-4 position-relative">

    <!-- Soft Glass Layer -->
    <div class="glass-layer"></div>

    <div class="container position-relative">

        <div class="row gy-4 align-items-center justify-content-between">

            <!-- LEFT : BPS BRAND -->
            <div class="col-lg-6 col-md-6 footer-section text-center">

                <div class="d-flex align-items-center justify-content-center mb-3 footer-brand-block">
                    <img src="<?= base_url('/assets/image/bps.png') ?>"
                        alt="Logo BPS"
                        class="footer-icon-img floating-icon me-2">

                    <div>
                        <h6 class="fst-italic fw-bold footer-title mb-1">
                            BADAN PUSAT STATISTIK
                        </h6>
                        <h6 class="fst-italic fw-bold footer-title mb-1">
                            KABUPATEN TANGGAMUS
                        </h6>
                    </div>
                </div>

                <p class="fw-semibold fst-italic opacity-75 mt-2 footer-slogan">
                    “Statistik Berdampak untuk Indonesia Maju”
                </p>

            </div>



            <!-- RIGHT : ASSISTA -->
            <div class="col-lg-5 col-md-6 footer-section text-center">

                <img src="<?= base_url('/assets/image/assista.png') ?>"
                    alt="ASSISTA Logo"
                    class="footer-icon-img floating-icon mb-1">

                <p class="fw-bold mt-1 mb-1">ASSISTA</p>

                <p class="small opacity-75 mb-1">
                    Aplikasi Satu Sistem Internal, SuperApp Terpadu dan Adaptif
                </p>

                <p class="small fst-italic opacity-75 mb-1">
                    A Single-System Internal SuperApp for Integrated and Adaptive Services
                </p>

                <p class="small fw-semibold fst-italic mt-2">
                    — Satu Aplikasi, Semua Terhubung —
                </p>

            </div>

        </div>

        <!-- Divider -->
        <div class="neon-divider mt-4 mb-3"></div>

        <!-- BOTTOM -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center small">
            <p class="mb-0 opacity-75">© 2026 BPS Kabupaten Tanggamus — All Rights Reserved</p>
            <p class="mb-0 mt-2 mt-md-0 opacity-75">Made with <i class="fa-solid fa-heart footer-heart"></i> by Tim TI</p>
        </div>

    </div>
</footer>

<!-- ================== CSS ================== -->
<style>
    .footer-icon-img {
        height: 45px !important;
        /* dari 65px → 45px */
    }

    /* Block logo + teks tetap berada di tengah */
    .footer-brand-block {
        justify-content: center !important;
        text-align: left !important;
        /* teks tetap rata kiri */
    }

    /* Paragraf slogan rata tengah */
    .footer-slogan {
        text-align: center !important;
        width: 100%;
    }

    /* Section container rata tengah */
    .footer-section {
        text-align: center !important;
    }

    .footer-blue {
        background: linear-gradient(135deg, #0d47a1, #1565c0);
        backdrop-filter: blur(10px);
    }

    /* Glass layer */
    .glass-layer {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(12px);
        z-index: 0;
    }

    .footer-section {
        position: relative;
        z-index: 3;
    }

    .footer-link {
        color: #e3eaff;
        text-decoration: none;
        transition: 0.2s;
    }

    .footer-link:hover {
        color: white;
        padding-left: 3px;
    }

    .neon-title {
        text-shadow: 0 0 6px rgba(255, 255, 255, 0.7);
    }

    /* Floating Icons */
    .floating-icon {
        height: 65px;
        animation: float 4s ease-in-out infinite;
        filter: drop-shadow(0 0 4px rgba(255, 255, 255, 0.5));
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-6px);
        }
    }

    .glow-icon {
        color: #ffffff;
        text-shadow: 0 0 6px rgba(255, 255, 255, 0.7);
    }

    /* Neon Divider */
    .neon-divider {
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #78aaff, transparent);
        box-shadow: 0 0 8px #78aaff;
    }

    /* Google Map */
    .footer-map {
        width: 100%;
        height: 140px;
        border: 0;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
    }

    /* Back To Top Button */
    .btn-top {
        position: fixed;
        bottom: 30px;
        right: 25px;
        background: #1e88e5;
        color: white;
        border: none;
        padding: 12px 14px;
        border-radius: 50%;
        font-size: 18px;
        display: none;
        z-index: 999;
        transition: 0.3s;
        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.3);
    }

    .btn-top:hover {
        background: #42a5f5;
        transform: translateY(-4px);
    }

    /* Dark Mode Toggle */
    .btn-darkmode {
        position: fixed;
        bottom: 30px;
        left: 25px;
        background: #212121;
        color: #ffc107;
        border: none;
        padding: 12px 14px;
        border-radius: 50%;
        font-size: 18px;
        z-index: 999;
        transition: 0.3s;
        box-shadow: 0 5px 12px rgba(0, 0, 0, 0.3);
    }

    .btn-darkmode:hover {
        background: #424242;
    }

    /* Dark Mode Effect */
    body.dark {
        background: #0a0a0a;
        color: #e0e0e0;
    }

    body.dark footer {
        background: #0d1b2a !important;
    }
</style>

<script>
    // Ensure click toggles dropdowns on all devices
    document.addEventListener('DOMContentLoaded', () => {
        const dropdowns = document.querySelectorAll('.dropdown');

        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent event bubbling
                const menu = this.querySelector('.dropdown-menu');
                const isVisible = menu.classList.contains('show');

                // Close all other dropdowns
                document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));

                // Toggle the current dropdown menu
                if (!isVisible) {
                    menu.classList.add('show');
                } else {
                    menu.classList.remove('show');
                }
            });
        });

        // Close dropdown if clicked outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown-menu').forEach(menu => menu.classList.remove('show'));
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const currentPath = window.location.pathname.replace(/\/$/, ""); // Remove trailing slash
        const navLinks = document.querySelectorAll(".nav-link, .dropdown-item");

        // Route mappings for dropdowns and their submenus
        const routeMappings = {
            "/surat_keluar": {
                dropdown: "dokumenDropdown",
                submenu: "surat_keluar/manage"
            },
            "/surat_masuk": {
                dropdown: "dokumenDropdown",
                submenu: "surat_masuk/manage"
            },
            "/sk": {
                dropdown: "dokumenDropdown",
                submenu: "sk/manage"
            },
            "/kontrak": {
                dropdown: "dokumenDropdown",
                submenu: "kontrak/manage"
            },
            "/humas": {
                dropdown: "humasDropdown",
                submenu: "humas/manage"
            },
            "/quality_gates": {
                dropdown: "humasDropdown",
                submenu: "quality_gates/manage"
            },
            "/publikasi": {
                dropdown: "humasDropdown",
                submenu: "publikasi/manage"
            },
            "/lainnya": {
                dropdown: "humasDropdown",
                submenu: "lainnya/manage"
            },
            "/maintenance1": {
                dropdown: "dokumenDropdown",
                submenu: "humas/maintenance1"
            },
            "/maintenance2": {
                dropdown: "dokumenDropdown",
                submenu: "humas/maintenance2"
            },
            "/maintenance3": {
                dropdown: "humasDropdown",
                submenu: "humas/maintenance3"
            },
            "/maintenance4": {
                dropdown: "humasDropdown",
                submenu: "humas/maintenance4"
            },
            "/maintenance5": {
                dropdown: "humasDropdown",
                submenu: "humas/maintenance5"
            },
            "/maintenance6": {
                dropdown: "humasDropdown",
                submenu: "humas/maintenance6"
            },
            "/maintenance7": {
                dropdown: "humasDropdown",
                submenu: "humas/maintenance7"
            },
            "/maintenance8": {
                dropdown: "humasDropdown",
                submenu: "humas/maintenance8"
            },
            "/maintenance9": {
                dropdown: "humasDropdown",
                submenu: "humas/maintenance9"
            }
        };

        navLinks.forEach(link => {
            const linkPath = new URL(link.href).pathname.replace(/\/$/, "");

            // Exact match: Highlight the submenu link
            if (currentPath === linkPath) {
                link.classList.add("active");
            }

            // Handle `create`, `edit/{id}`, and `manage` for correct dropdown + submenu activation
            Object.keys(routeMappings).forEach(route => {
                if (currentPath.startsWith(route) || currentPath.match(new RegExp(`^${route}/edit/\\d+$`))) {
                    const {
                        dropdown,
                        submenu
                    } = routeMappings[route];

                    // Activate dropdown menu
                    document.getElementById(dropdown)?.classList.add("active");

                    // Activate the submenu
                    document.querySelectorAll(".dropdown-item").forEach(item => {
                        if (item.href.includes(submenu) || item.href.includes(route)) {
                            item.classList.add("active");
                        }
                    });
                }
            });
        });

        // Special handling for Profile & Admin Dashboard in User Dropdown
        if (currentPath === "/profile" || currentPath === "/admin_dashboard") {
            document.getElementById("userDropdown")?.classList.add("active");

            document.querySelectorAll(".dropdown-item").forEach(item => {
                if (item.href.includes("profile") && currentPath === "/profile") {
                    item.classList.add("active");
                }
                if (item.href.includes("admin_dashboard") && currentPath === "/admin_dashboard") {
                    item.classList.add("active");
                }
            });
        }
    });
</script>
</body>

</html>