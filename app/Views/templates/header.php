<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website for BPS Kabupaten Tanggamus providing document management, reminders, tracking, and more.">
    <title>Assista</title>
    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->

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
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="<?= base_url('assets/image/logo_assista.png') ?>" alt="Logo Assista" style="width: 30px; height: 30px; margin-right: 10px;">
                Assista
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('') ?>">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('dokumen') ?>" id="dokumenDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Manajemen Dokumen</a>
                        <ul class="dropdown-menu" aria-labelledby="dokumenDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('dokumen') ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('surat/manage') ?>">Surat</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('sk/manage') ?>">SK</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('kontrak/manage') ?>">Kontrak</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('humas') ?>" id="humasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Reminder Humas</a>
                        <ul class="dropdown-menu" aria-labelledby="humasDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('humas') ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('humas/manage') ?>">Manage</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('kendala') ?>" id="kendalaDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kendala Lapangan</a>
                        <ul class="dropdown-menu" aria-labelledby="kendalaDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('kendala') ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('kendala/manage') ?>">Manage</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('sbml') ?>" id="sbmlDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">SBML</a>
                        <ul class="dropdown-menu" aria-labelledby="sbmlDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('sbml') ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('sbml/manage') ?>">Manage</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('tracking') ?>" id="trackingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tracking</a>
                        <ul class="dropdown-menu" aria-labelledby="trackingDropdown">
                            <li><a class="dropdown-item" href="<?= base_url('tracking') ?>">Dashboard</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('tracking/manage') ?>">Manage</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>