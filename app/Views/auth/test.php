<!-- DEBUG-VIEW START 1 APPPATH\Views\templates\header.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website for BPS Kabupaten Tanggamus providing document management, reminders, tracking, and more.">
    <link rel="shortcut icon" type="image/png" href="/assista.ico">
    <title>Assista</title>
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/33529d3488.js" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />

    <!-- FullCalendar Core and Plugins CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.8/main.min.css" rel="stylesheet">

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="http://localhost:8080/assets/css/styles.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="http://localhost:8080/assets/image/logo_assista.png" alt="Logo Assista" style="width: 30px; height: 30px; margin-right: 10px;">
                Assista
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8080/">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://localhost:8080/dokumen" id="dokumenDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Manajemen Dokumen</a>
                        <ul class="dropdown-menu" aria-labelledby="dokumenDropdown">
                            <li><a class="dropdown-item" href="http://localhost:8080/dokumen">Dashboard</a></li>
                            <li><a class="dropdown-item" href="http://localhost:8080/surat/manage">Surat</a></li>
                            <li><a class="dropdown-item" href="http://localhost:8080/sk/manage">SK</a></li>
                            <li><a class="dropdown-item" href="http://localhost:8080/kontrak/manage">Kontrak</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://localhost:8080/humas" id="humasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Reminder Humas</a>
                        <ul class="dropdown-menu" aria-labelledby="humasDropdown">
                            <li><a class="dropdown-item" href="http://localhost:8080/humas">Dashboard</a></li>
                            <li><a class="dropdown-item" href="http://localhost:8080/humas/manage">Manage</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://localhost:8080/kendala" id="kendalaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kendala Lapangan</a>
                        <ul class="dropdown-menu" aria-labelledby="kendalaDropdown">
                            <li><a class="dropdown-item" href="http://localhost:8080/kendala">Dashboard</a></li>
                            <li><a class="dropdown-item" href="http://localhost:8080/kendala/manage">Manage</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://localhost:8080/sbml" id="sbmlDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">SBML</a>
                        <ul class="dropdown-menu" aria-labelledby="sbmlDropdown">
                            <li><a class="dropdown-item" href="http://localhost:8080/sbml">Dashboard</a></li>
                            <li><a class="dropdown-item" href="http://localhost:8080/sbml/manage">Manage</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://localhost:8080/tracking" id="trackingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tracking</a>
                        <ul class="dropdown-menu" aria-labelledby="trackingDropdown">
                            <li><a class="dropdown-item" href="http://localhost:8080/tracking">Dashboard</a></li>
                            <li><a class="dropdown-item" href="http://localhost:8080/tracking/manage">Manage</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                    <button type="button" onclick="generateWhatsAppLink()" class="btn btn-primary"><i class="fa-brands fa-whatsapp"></i> Kirim Pesan</button>
                </div>
            </form>
        </div>
    </section>

    <script>
        function generateWhatsAppLink() {
            // Get the name and email values from the form
            const form = document.getElementById('waForm');
            const nama = document.getElementById('nama').value;
            const jk = document.getElementById('jk').value;
            const pesan = document.getElementById('pesan').value;

            // Check if both fields are filled
            if (!nama || !jk || !pesan) {
                alert('Lenkapi semua isian!');
                return;
            }

            // Generate the WhatsApp link with encoded text
            const message = `Nama         : ${nama}\nJenis Kelamin: ${jk}\n\n${pesan}`;
            const whatsappLink = `https://wa.me/6282337039320?text=${encodeURIComponent(message)}`;

            // Open the link in a new tab
            window.open(whatsappLink, '_blank');

            // Clear the form
            form.reset();
        }
    </script>

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
    <!-- DEBUG-VIEW ENDED 2 APPPATH\Views\index.php -->
    <!-- DEBUG-VIEW START 3 APPPATH\Views\templates\footer.php -->
    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025. Made with
                <img width="20px" height="20px" alt="love"
                    src="https://img.icons8.com/color/20/000000/filled-like.png">
                by Tim Inovasi BPS Kabupaten Tanggamus
            </p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

</body>

</html>
<!-- DEBUG-VIEW ENDED 3 APPPATH\Views\templates\footer.php -->