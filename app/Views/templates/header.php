<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website for BPS Kabupaten Tanggamus providing document management, reminders, tracking, and more.">
    <link rel="shortcut icon" type="image/png" href="/assista.ico">
    <title><?= esc($title) ?></title>
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/33529d3488.js" crossorigin="anonymous"></script>

    <!-- Favicon -->
    <link rel="icon" href=<?= base_url("assista.ico"); ?> type="image/x-icon">

    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />

    <!-- FullCalendar Core and Plugins CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.8/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.8/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@6.1.8/main.min.css" rel="stylesheet">

    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Add jQuery and Select2 scripts -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        @media (max-width: 768px) {
            .fc-toolbar {
                flex-direction: column;
                align-items: center;
            }

            .fc-toolbar-title {
                font-size: 1.2rem !important;
                text-align: center;
                margin-bottom: 5px;
            }

            .fc-button {
                font-size: 14px !important;
                padding: 5px 8px !important;
            }

            .fc-header-toolbar {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 5px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="<?= base_url('assets/image/assista.png') ?>" alt="Logo Assista"
                    style="width: 30px; height: 30px; margin-right: 10px;">
                <span>Assista</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == '' || uri_string() == '/') ? 'active' : '' ?>" href="<?= base_url('') ?>">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('dokumen') ?>" id="dokumenDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">SIPASTI</a>
                        <ul class="dropdown-menu" aria-labelledby="dokumenDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('dokumen') ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('surat_keluar/manage') ?>">Surat Keluar</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('surat_masuk/manage') ?>">Surat Masuk</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('sk/manage') ?>">SK</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('kontrak/manage') ?>">Kontrak</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('dokumen_26') ?>" id="dokumenDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">SIPASTI 2026</a>
                        <ul class="dropdown-menu" aria-labelledby="dokumenDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('dokumen26') ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('surat_keluar26/manage') ?>">Surat Keluar</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('surat_masuk26/manage') ?>">Surat Masuk</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('sk/manage26') ?>">SK</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('kontrak/manage26') ?>">Kontrak</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('kontrak/arsip') ?>">Arsip</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('humas') ?>" id="humasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">RINGTAS</a>
                        <ul class="dropdown-menu" aria-labelledby="humasDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('humas/manage') ?>">Humas</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('quality_gates/manage') ?>">Quality Gates</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('publikasi/manage') ?>">BRS dan Publikasi</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('lainnya/manage') ?>">Lainnya</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('/pantau') ?>" id="humasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">PANTAU</a>
                        <ul class="dropdown-menu" aria-labelledby="humasDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('/pantau') ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('/pantau/master') ?>">Master Kegiatan</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('/upload') ?>">Upload Beban Kerja</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('/pantau/progres') ?>">Progres</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('/pantau/work_calendar') ?>">Google Calendar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('humas') ?>" id="humasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">MANDALA</a>
                        <ul class="dropdown-menu" aria-labelledby="humasDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('humas/maintenance4') ?>">Umum</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('humas/maintenance5') ?>">TI dan Pengolahan</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('humas/maintenance6') ?>">Teknis</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('humas') ?>" id="humasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">LANTAS</a>
                        <ul class="dropdown-menu" aria-labelledby="humasDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('humas/maintenance7') ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('humas/maintenance8') ?>">Update Laporan</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('humas/maintenance9') ?>">Master</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('profile') ?>" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-circle-user"></i> <?= session()->get('nama') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('profile') ?>"><i class="fa-solid fa-user"></i> Profil Saya</a></li>
                            <?php if (session()->get('role') == 'admin'): ?>
                                <li><a class="dropdown-item" href="<?= base_url('admin_dashboard') ?>"><i class="fa-solid fa-users-gear"></i> Admin Dashboard</a></li>
                            <?php endif; ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">