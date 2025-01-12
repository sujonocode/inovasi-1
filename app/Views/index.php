<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>BPS Kabupaten Tanggamus</h1>
        <p>Apa misi kita? Data akurat untuk rakyat!</p>
        <a href="#features" class="btn btn-primary btn-lg">Jelajahi Fitur</a>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="features py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Fitur Kami</h2>
        <div class="row g-4 justify-content-center">
            <div class="col-lg-3 col-md-6">
                <a href="/dokumen" class="text-decoration-none text-dark">
                    <div class="icon-box text-center bg-light border rounded h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-file-contract fa-3x"></i>
                        <h4 class="mt-3">Manajemen Dokumen</h4>
                        <p>Surat, SK, dan Kontrak.</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="/humas" class="text-decoration-none text-dark">
                    <div class="icon-box text-center bg-light border rounded h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-calendar-days fa-3x"></i>
                        <h4 class="mt-3">Humas</h4>
                        <p>Reminder (pengingat) membuat dan mengunggah konten humas.</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="/#" class="text-decoration-none text-dark">
                    <div class="icon-box text-center bg-light border rounded h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-list-check fa-3x"></i>
                        <h4 class="mt-3">Kendala Lapangan</h4>
                        <p>Pengumpulan kendala selama melaksanakan tugas di lapangan.</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="/#" class="text-decoration-none text-dark">
                    <div class="icon-box text-center bg-light border rounded h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-filter-circle-dollar fa-3x"></i>
                        <h4 class="mt-3">SBML</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href="/#" class="text-decoration-none text-dark">
                    <div class="icon-box text-center bg-light border rounded h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-map-location-dot fa-3x"></i>
                        <h4 class="mt-3">Tracking</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title text-center mb-4">Tentang Kami</h2>
        <p class="text-center section-subtitle">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi enim tortor, auctor nec tellus sed, pulvinar tincidunt ex. Quisque sed blandit nunc.
        </p>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5">
    <div class="container">
        <h2 class="section-title text-center mb-4">Hubungi Kami</h2>
        <form>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" class="form-control" placeholder="Nama" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input type="email" class="form-control" placeholder="Email" required>
                </div>
            </div>
            <div class="mb-3">
                <textarea class="form-control" rows="5" placeholder="Pesan" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
            </div>
        </form>
    </div>
</section>

<!-- Documents script -->
<script>
    // Smooth Scroll Script
    document.querySelector('.btn').addEventListener('click', (e) => {
        e.preventDefault();
        document.querySelector('#features').scrollIntoView({
            behavior: 'smooth'
        });
    });

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

    // Active nav
    document.addEventListener("DOMContentLoaded", function() {
        const navLinks = document.querySelectorAll(".nav-link");

        // Get the current URL
        const currentURL = window.location.href;

        navLinks.forEach(link => {
            // Check if the href of the link matches the current URL
            if (link.href === currentURL) {
                link.classList.add("active");
            }
        });
    });
</script>