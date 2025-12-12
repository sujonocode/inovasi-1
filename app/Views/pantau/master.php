<?= $this->include('templates/header'); ?>

<style>
    .page-title {
        font-weight: 600;
        color: #0d47a1;
        margin-bottom: 1rem;
        /* border-left: 4px solid #0d47a1;
        padding-left: 10px; */
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

    .auto-fill-section {
        background: #e8f2ff;
        border: 1px solid #bcd7ff;
        border-radius: 12px;
    }

    .auto-fill-section select[readonly],
    .auto-fill-section input[readonly] {
        background-color: #f1f5ff;
        cursor: not-allowed;
    }

    table.dataTable thead th {
        text-align: center !important;
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

    button[type="submit"] {
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    .form-section {
        border-radius: 10px;
        background-color: #f8fbff;
    }

    .form-label {
        font-size: 0.875rem;
        color: #0d6efd;
    }
</style>

<style>
    .btn-group .btn {
        padding: 4px 8px !important;
        border-width: 1.6px !important;
    }

    .btn-group .btn i {
        font-size: 14px;
    }
</style>

<style>
    .aksi-btn-group .btn {
        padding: 4px 10px !important;
        border-width: 1.6px !important;
        border-radius: 6px !important;
        margin: 0 2px !important;
        /* beri jarak antar tombol */
    }

    .aksi-btn-group .btn i {
        font-size: 14px;
    }

    /* hover lebih halus */
    .aksi-btn-group .btn:hover {
        opacity: .85;
    }

    #modalDelete .modal-content {
        border-radius: 12px;
    }

    #modalDelete .modal-header {
        border-radius: 12px 12px 0 0;
    }
</style>

<div class="container my-4">
    <h4 class="page-title">🗂️ Master Kegiatan</h4>

    <div class="form-section card shadow-sm p-3 mb-4">
        <h5 class="mb-3 text-primary">
            <i class="bi bi-clipboard-plus me-2"></i> Tambah Kegiatan
        </h5>

        <form action="<?= base_url('/pantau/tambah-kegiatan') ?>" method="post" class="row g-3">
            <?= csrf_field() ?>
            <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Kegiatan</label>
                <input name="nama_kegiatan" class="form-control" placeholder="Contoh (Nama + Periode + Tahun): Sakernas Agustus Tahun 2025" required>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">Tim</label>
                <select name="tim" class="form-select" required>
                    <option value="">Pilih Tim</option>
                    <option value="Distribusi">Distribusi</option>
                    <option value="Humas">Humas</option>
                    <option value="IPDS">IPDS</option>
                    <option value="Neraca">Neraca</option>
                    <option value="Produksi">Produksi</option>
                    <option value="Sektoral">Sektoral</option>
                    <option value="Sosial">Sosial</option>
                    <option value="Umum">Umum</option>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label fw-semibold">Satuan Beban Kerja</label>
                <select id="satuanSelect" name="satuan" class="form-select" required>
                    <option value="">Pilih Satuan</option>
                    <option value="SLS">SLS</option>
                    <option value="BS">BS</option>
                    <option value="Desa">Desa</option>
                    <option value="Kecamatan">Kecamatan</option>
                    <option value="Dokumen">Dokumen</option>
                    <option value="Publikasi">Publikasi</option>
                    <option value="lainnya">Lainnya...</option>
                </select>
            </div>

            <div class="col-md-2 d-none" id="satuanLainContainer">
                <label class="form-label fw-semibold">Isi Satuan Lainnya</label>
                <input type="text" name="satuan_lain" id="satuanLainInput" class="form-control" placeholder="Tulis satuan lain">
            </div>

            <div class="col-md-12">
                <div class="auto-fill-section p-3 rounded mb-3">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Mulai Pengerjaan</label>
                            <input id="awalPengerjaan" name="awal_pengerjaan" type="date" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Tahun Pelaksanaan (Awal)</label>
                            <select id="tahunSelect" name="tahun" class="form-select" readonly>
                                <option value="">— Otomatis dari tanggal —</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Bulan Pelaksanaan (Awal)</label>
                            <select id="bulanSelect" name="bulan" class="form-select" readonly>
                                <option value="">— Otomatis dari tanggal —</option>
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
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">Deadline</label>
                <input name="deadline" type="date" class="form-control">
            </div>

            <div class="col-8">
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

    <div class="form-section card shadow-sm p-3 mb-4">
        <h5 class="mb-3 text-primary">
            <i class="bi bi-clipboard-plus me-2"></i> Daftar Kegiatan
        </h5>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tabelKegiatan" class="table table-striped table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Tim</th>
                                <th>Tahun</th>
                                <th>Bulan</th>
                                <th>Awal</th>
                                <th>Deadline</th>
                                <th>Creator</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($kegiatan as $k): ?>
                                <tr>
                                    <?php
                                    $rand = (strlen($i) == 1)
                                        ? rand(10, 99)       // 2 digit random
                                        : rand(0, 9);        // 1 digit random
                                    ?>
                                    <td><?= 'wrk' . $i++ . $rand ?></td>
                                    <td><?= esc($k['nama_kegiatan']) ?></td>
                                    <td><?= esc($k['tim']) ?></td>
                                    <td><?= esc($k['tahun']) ?></td>
                                    <td><?= esc($k['bulan']) ?></td>
                                    <td><?= esc($k['awal_pengerjaan']) ?></td>
                                    <td><?= esc($k['deadline']) ?></td>
                                    <td><?= esc($k['created_by_name']) ?></td>
                                    <td class="text-center">
                                        <div class="btn-group aksi-btn-group" role="group">

                                            <a href="<?= base_url('/pantau/detail/' . $k['id']) ?>"
                                                class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="tooltip" title="Detail">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <a href="<?= base_url('/pantau/edit/' . $k['id']) ?>"
                                                class="btn btn-sm btn-outline-warning"
                                                data-bs-toggle="tooltip" title="Edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <a href="<?= base_url('/pantau/delete/' . $k['id']) ?>"
                                                class="btn btn-sm btn-outline-danger"
                                                data-bs-toggle="modal"
                                                data-id="<?= $k['id'] ?>"
                                                data-nama="<?= esc($k['nama_kegiatan']) ?>"
                                                data-bs-target="#modalDelete"
                                                title="Hapus">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> Konfirmasi Hapus
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p class="mb-1 text-muted">Anda akan menghapus kegiatan:</p>
                <h5 class="fw-semibold text-danger" id="deleteNama"></h5>
                <p class="mt-3">Apakah Anda yakin? Tindakan ini tidak dapat dibatalkan.</p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark me-1"></i> Batal
                </button>

                <a href="#" id="btnDeleteKonfirmasi" class="btn btn-danger">
                    <i class="fa-solid fa-trash me-1"></i> Hapus Permanen
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("click", function(e) {
        if (e.target.closest("[data-bs-target='#modalDelete']")) {

            let btn = e.target.closest("[data-bs-target='#modalDelete']");
            let id = btn.getAttribute("data-id");
            let nama = btn.getAttribute("data-nama");

            // isi teks nama kegiatan
            document.getElementById("deleteNama").textContent = nama;

            // set URL delete yang benar
            document.getElementById("btnDeleteKonfirmasi").href =
                "/pantau/delete/" + id;
        }
    });
</script>

<script>
    document.getElementById('satuanSelectEdit').addEventListener('change', function() {
        const container = document.getElementById('satuanLainContainerEdit');
        const input = document.getElementById('satuanLainInputEdit');

        if (this.value === 'lainnya') {
            container.classList.remove('d-none');
            input.required = true;
        } else {
            container.classList.add('d-none');
            input.required = false;
            input.value = '';
        }
    });

    // Saat submit → paksa select bernilai input
    document.querySelector('form').addEventListener('submit', function() {
        const select = document.getElementById('satuanSelectEdit');
        const input = document.getElementById('satuanLainInputEdit');

        if (select.value === 'lainnya' && input.value.trim() !== "") {
            select.value = input.value; // yang dikirim ke server
        }
    });
</script>

<script>
    document.getElementById('satuanSelect').addEventListener('change', function() {
        const lainnya = document.getElementById('satuanLainContainer');

        if (this.value === 'lainnya') {
            lainnya.classList.remove('d-none');
            document.getElementById('satuanLainInput').setAttribute('required', true);
        } else {
            lainnya.classList.add('d-none');
            document.getElementById('satuanLainInput').removeAttribute('required');
            document.getElementById('satuanLainInput').value = '';
        }
    });
</script>

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
                    //     targets: 0,
                    //     className: 'text-center fw-semibold text-muted'
                    // },
                    // {
                    targets: [2, 3, 4, 5, 6],
                    className: 'text-center'
                },
                {
                    targets: 8,
                    orderable: false,
                    searchable: false,
                    className: 'text-center'
                } // kolom aksi
            ]

        });
    });
</script>

<script>
    // Aktifkan semua tooltip Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

<script>
    document.getElementById('awalPengerjaan').addEventListener('change', function() {
        const tanggal = this.value; // format: YYYY-MM-DD
        if (!tanggal) return;

        const dateObj = new Date(tanggal);

        const tahun = dateObj.getFullYear();
        const bulanIndex = dateObj.getMonth(); // 0 = Jan

        const namaBulan = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        // Set Tahun
        document.getElementById('tahunSelect').value = tahun;

        // Set Bulan
        document.getElementById('bulanSelect').value = namaBulan[bulanIndex];
    });
</script>

<?= $this->include('templates/footer'); ?>