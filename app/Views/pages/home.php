<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inovasi</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            padding-top: 60px;
            /* Adjusted padding for better spacing after fixed navbar */
        }

        .hero {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: white;
            padding: 80px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero p {
            font-size: 1.2rem;
        }

        .features .icon-box {
            text-align: center;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .features .icon-box i {
            font-size: 3rem;
            color: #2575fc;
        }

        .features .icon-box:hover {
            transform: translateY(-10px);
            /* Hover effect for features */
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        footer a {
            color: #6a11cb;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Ensure sections have clear spacing */
        .section-title {
            font-size: 2rem;
            font-weight: bold;
            color: #343a40;
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">1KnowFast-SI</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Fitur</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
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
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <a href="/surat" class="text-decoration-none text-dark">
                        <div class="icon-box text-center bg-light border rounded h-100 d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-file-contract fa-3x"></i>
                            <h4 class="mt-3">Surat</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="/tracking" class="text-decoration-none text-dark">
                        <div class="icon-box text-center bg-light border rounded h-100 d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-map-location-dot fa-3x"></i>
                            <h4 class="mt-3">Tracking</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="/humas" class="text-decoration-none text-dark">
                        <div class="icon-box text-center bg-light border rounded h-100 d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-calendar-days fa-3x"></i>
                            <h4 class="mt-3">Humas</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <a href="/sbml" class="text-decoration-none text-dark">
                        <div class="icon-box text-center bg-light border rounded h-100 d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-filter-circle-dollar fa-3x"></i>
                            <h4 class="mt-3">SBML</h4>
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

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2025. Made with
                <img width="20px" height="20px" alt="love" src="https://img.icons8.com/color/20/000000/filled-like.png">
                by Tim Inovasi BPS Kabupaten Tanggamus
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>