<?= $this->include('templates/header'); ?>
<style>
    .page-title {
        font-weight: 600;
        color: #0d47a1;
        margin-bottom: 1rem;
        border-left: 4px solid #0d47a1;
        padding-left: 10px;
    }

    .form-section {
        background-color: #f8faff;
        border: 1px solid #dbe7ff;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .form-section input::placeholder {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .form-section button {
        width: 100%;
        height: 100%;
    }

    .table thead th {
        background-color: #e3f2fd;
        color: #0d47a1;
        font-weight: 600;
        border-bottom: 2px solid #90caf9;
    }

    .table-hover tbody tr:hover {
        background-color: #f5f9ff;
    }

    .dataTables_wrapper .dataTables_paginate {
        margin-top: 1rem !important;
        display: flex;
        justify-content: center;
    }

    .dataTables_wrapper .dataTables_paginate .page-item .page-link {
        border-radius: 8px;
        color: #0d47a1;
    }

    .dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
        background-color: #0d47a1;
        border-color: #0d47a1;
        color: #fff;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 0.5rem;
    }
</style>

<div class="container my-4">
    <h4 class="page-title">Master Kegiatan</h4>

    <div class="form-section card shadow-sm p-3 mb-4">
        <h5 class="mb-3 text-primary">
            <i class="bi bi-clipboard-plus me-2"></i> Tambah Kegiatan
        </h5>

        <form action="<?= base_url('/pantau/tambah-kegiatan') ?>" method="post" class="row g-3">
            <?= csrf_field() ?>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Nama Kegiatan</label>
                <input name="nama_kegiatan" class="form-control" placeholder="Nama kegiatan" required>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">Tahun</label>
                <input name="tahun" class="form-control" placeholder="Tahun">
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">Bulan</label>
                <select name="bulan" class="form-select" required>
                    <option value="">Pilih Bulan</option>
                    <option value="Januari">Januari</option>
                    <option value="Februari">Februari</option>
                    <option value="Maret">Maret</option>
                    <option value="April">April</option>
                    <option value="Mei">Mei</option>
                    <option value="Juni">Juni</option>
                    <option value="Juli">Juli</option>
                    <option value="Agustus">Agustus</option>
                    <option value="September">September</option>
                    <option value="Oktober">Oktober</option>
                    <option value="November">November</option>
                    <option value="Desember">Desember</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">Awal Pengerjaan</label>
                <input name="awal_pengerjaan" type="date" class="form-control">
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">Deadline</label>
                <input name="deadline" type="date" class="form-control">
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold">Keterangan</label>
                <input name="keterangan" class="form-control" placeholder="Keterangan (opsional)">
            </div>

            <div class="col-12 text-end mt-3">
                <button class="btn btn-primary px-4" type="submit">
                    <i class="bi bi-plus-circle me-1"></i> Tambah Kegiatan
                </button>
            </div>
        </form>
    </div>

    <style>
        .form-section {
            border-radius: 10px;
            background-color: #f8fbff;
        }

        .form-label {
            font-size: 0.875rem;
            color: #0d6efd;
        }

        button[type="submit"] {
            font-weight: 500;
            letter-spacing: 0.3px;
        }
    </style>


    <style>
        .form-section {
            border-radius: 10px;
            background-color: #f8fbff;
        }

        .form-label {
            font-size: 0.875rem;
            color: #0d6efd;
        }
    </style>


    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabelKegiatan" class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Awal</th>
                            <th>Deadline</th>
                            <th>Creator</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($kegiatan as $k): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= esc($k['nama_kegiatan']) ?></td>
                                <td><?= esc($k['tahun']) ?></td>
                                <td><?= esc($k['bulan']) ?></td>
                                <td><?= esc($k['awal_pengerjaan']) ?></td>
                                <td><?= esc($k['deadline']) ?></td>
                                <td><?= esc($k['created_by_name']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tabelKegiatan').DataTable({
            order: [
                [0, 'asc']
            ],
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ baris",
                info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                zeroRecords: "Data tidak ditemukan",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "›",
                    previous: "‹"
                }
            },
            columnDefs: [{
                    targets: 0,
                    className: 'text-center fw-semibold text-muted'
                },
                {
                    targets: [2, 3, 4, 5],
                    className: 'text-center'
                },
                {
                    targets: 6,
                    className: 'text-center text-primary fw-semibold'
                },
            ]
        });
    });
</script>

<?= $this->include('templates/footer'); ?>