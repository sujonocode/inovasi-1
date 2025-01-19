<!-- Hero Section -->
<!-- <section class="hero">
    <div class="container">
        <h1>BPS Kabupaten Tanggamus</h1>
        <p>Apa misi kita? Data akurat untuk rakyat!</p>
        <a href="#features" class="btn btn-primary btn-lg">Jelajahi Fitur</a>
    </div>
</section> -->

<!-- Features Section -->
<section id="features" class="features py-5">
    <div class="container">
        <h2 class="section-title text-center mb-5">Dokumen</h2>
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

<!-- Dashboard -->
<section id="dashboard" class="features py-5">
    <div class="container mt-5">
        <!-- <h1 class="mb-4">Dashboard</h1> -->
        <div class="row">
            <div class="col-md-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Jumlah Dokumen</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $totalSurat + $totalSK + $totalKontrak ?></h5>
                        <!-- <p class="card-text">Jumlah dokumen (surat, SK, dan kontrak)</p> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Jumlah Surat</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $totalSurat ?></h5>
                        <!-- <p class="card-text">Jumlah surat masuk dan keluar (internal dan eksternal)</p> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Jumlah Surat Keputusan (SK)</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $totalSK ?></h5>
                        <!-- <p class="card-text">Jumlah SK</p> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-header">Jumlah Kontrak</div>
                    <div class="card-body">
                        <h5 class="card-title"><?= $totalKontrak ?></h5>
                        <!-- <p class="card-text">Jumlah kontrak</p> -->
                    </div>
                </div>
            </div>
        </div>
        <h1 class="mb-4">Surat</h1>
        <div class="row">
            <?php foreach ($totalSuratByKodeArsip as $category): ?>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header"><?= $category['kode_arsip'] ?></div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $category['count'] ?></h5>
                            <!-- <p class="card-text">Records in the <?= $category['kode_arsip'] ?> category.</p> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <h1 class="mb-4">SK</h1>
        <div class="row">
            <?php foreach ($totalSKByKodeArsip as $category): ?>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header"><?= $category['kode_arsip'] ?></div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $category['count'] ?></h5>
                            <!-- <p class="card-text">Records in the <?= $category['kode_arsip'] ?> category.</p> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <h1 class="mb-4">Kontrak</h1>
        <div class="row">
            <?php foreach ($totalKontrakByKodeArsip as $category): ?>
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header"><?= $category['kode_arsip'] ?></div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $category['count'] ?></h5>
                            <!-- <p class="card-text">Records in the <?= $category['kode_arsip'] ?> category.</p> -->
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>