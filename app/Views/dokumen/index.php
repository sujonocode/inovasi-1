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
                <a href=<?= base_url('surat/manage') ?> class="text-decoration-none text-dark">
                    <div class="icon-box text-center bg-light border rounded h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-file-lines fa-3x"></i>
                        <h4 class="mt-3">Surat</h4>
                        <p>BAST, SOP, formulir permintaan, surat tugas, dan sebagaianya</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href=<?= base_url('sk/manage') ?> class="text-decoration-none text-dark">
                    <div class="icon-box text-center bg-light border rounded h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-file-signature fa-3x"></i>
                        <h4 class="mt-3">SK</h4>
                        <p>Semua jenis Surat Keputusan (SK), seperti penetapan dan perubahan</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-6">
                <a href=<?= base_url('kontrak/manage') ?> class="text-decoration-none text-dark">
                    <div class="icon-box text-center bg-light border rounded h-100 d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-file-contract fa-3x"></i>
                        <h4 class="mt-3">Kontrak</h4>
                        <p>Kontrak petugas, kontrak mitra, outsourcing, dan sebagaianya</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>