<!-- Hero Section -->
<section class="hero text-center d-flex align-items-center justify-content-center"
    style="min-height:100vh; background: linear-gradient(135deg, #007bff, #6610f2); color: white;">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">
            BPS Kabupaten Tanggamus
        </h1>
        <p class="lead mb-4 animate__animated animate__fadeInUp">
            “Statistik Berdampak untuk Indonesia Maju”
        </p>
        <div class="my-4">
            <h2 class="fw-bold text-warning mb-1 animate__animated animate__fadeInUp">ASSISTA</h2>
            <p class="mb-1">Aplikasi Satu Sistem Internal, SuperApp Terpadu dan Adaptif</p>
            <p class="fst-italic">A Single-System Internal SuperApp for Integrated and Adaptive Services</p>
            <p class="fw-semibold mt-3">— Satu Aplikasi, Semua Terhubung —</p>
        </div>
        <a href="#features" class="btn btn-light btn-lg rounded-pill shadow px-5 py-3">
            Jelajahi Fitur
        </a>
    </div>
</section>

<!-- Tambahkan animasi optional -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

<!-- Features Section -->
<section id="features" class="features py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Fitur Kami</h2>
        <div class="row g-4 justify-content-center">
            <!-- Feature Item -->
            <div class="col-lg-6 col-md-6">
                <a href="/dokumen26" class="text-decoration-none text-dark">
                    <div class="icon-box text-center bg-light border h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-file-contract"></i>
                        <h4 class="mt-3">SIPASTI</h4>
                        <p>Sistem Informasi Penomoran dan Pengarsipan Surat Terintegrasi</p>
                    </div>
                </a>
            </div>
            <!-- Feature Item -->
            <div class="col-lg-6 col-md-6">
                <a href="/humas" class="text-decoration-none text-dark">
                    <div class="icon-box text-center bg-light border h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fa-solid fa-bell"></i>
                        <h4 class="mt-3">RINGTAS</h4>
                        <p>Reminder Integrasi Tugas dan Agenda Satuan Kerja</p>
                    </div>
                </a>
            </div>
            <!-- Feature Item -->
            <div class="col-lg-6 col-md-6">
                <a href="/pantau" class="text-decoration-none text-dark">
                    <div class="icon-box text-center bg-light border h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-binoculars"></i>
                        <h4 class="mt-3">PANTAU</h4>
                        <p>Panel Analitik Aktivitas Unit Kerja</p>
                    </div>
                </a>
            </div>
            <!-- Feature Item -->
            <div class="col-lg-6 col-md-6">
                <a href="/humas" class="text-decoration-none text-dark">
                    <div class="icon-box text-center bg-light border h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fa-solid fa-link"></i>
                        <h4 class="mt-3">MANDALA</h4>
                        <p>Manajemen Digital Link, Arsip, dan Akun Satuan Kerja</p>
                    </div>
                </a>
            </div>
            <!-- Feature Item -->
            <div class="col-lg-6 col-md-6">
                <a href="/humas" class="text-decoration-none text-dark">
                    <div class="icon-box text-center bg-light border h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fa-solid fa-handshake"></i>
                        <h4 class="mt-3">LANTAS</h4>
                        <p>Laporan Kendala Tugas Lapangan dan Solusi</p>
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
            Assista adalah aplikasi website yang dikembangkan oleh Tim TI BPS Kabupaten Tanggamus, Provinsi Lampung. Aplikasi ini
            menyediakan berbagai fitur inovatif yang mendukung kelancaran kegiatan administrasi serta meningkatkan efisiensi dalam
            pengelolaan data dan informasi di lingkungan BPS Kabupaten Tanggamus.
        </p>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5">
    <div class="container">
        <h2 class="section-title text-center mb-4">Hubungi Kami</h2>
        <form id="waForm">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama" required>
                </div>
                <div class="col-md-6 mb-3">
                    <input id="jk" name="jk" type="text" class="form-control" placeholder="Jenis kelamin" required>
                </div>
            </div>
            <div class="mb-3">
                <textarea id="pesan" name="pesan" class="form-control" rows="5" placeholder="Pesan" required></textarea>
            </div>
            <div class="text-center">
                <button type="button" onclick="generateWhatsAppLink()" class="btn btn-primary">
                    <i class="fa-brands fa-whatsapp"></i> Kirim Pesan
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Flash Message Modal (Bootstrap) -->
<div class="modal fade" id="flashMessageModal" tabindex="-1" aria-labelledby="flashMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="flashMessageModalLabel">Pesan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- The flash message content will be injected here -->
                <p id="flashMessageText"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function generateWhatsAppLink() {
        // Get the name, gender, and message values from the form
        const form = document.getElementById('waForm');
        const nama = document.getElementById('nama').value;
        const jk = document.getElementById('jk').value;
        const pesan = document.getElementById('pesan').value;

        // Check if fields are filled
        if (!nama || !jk || !pesan) {
            // Show the flash message using Bootstrap modal
            showFlashMessage('Lengkapi semua isian!');
            return;
        }

        // Generate the WhatsApp link with encoded text
        const message = `Nama            : ${nama}\nJenis Kelamin: ${jk}\n\n${pesan}`;
        const whatsappLink = `https://wa.me/6282337039320?text=${encodeURIComponent(message)}`;

        // Open the link in a new tab
        window.open(whatsappLink, '_blank');

        // Clear the form
        form.reset();
    }

    // Function to show flash message in the modal
    function showFlashMessage(message) {
        // Set the message text in the modal
        document.getElementById('flashMessageText').textContent = message;

        // Show the modal
        var myModal = new bootstrap.Modal(document.getElementById('flashMessageModal'));
        myModal.show();
    }

    // Check if there's a success message in PHP flashdata
    <?php if (session()->getFlashdata('success')): ?>
        showFlashMessage('<?= session()->getFlashdata('success') ?>');
    <?php endif; ?>
</script>

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
</script>