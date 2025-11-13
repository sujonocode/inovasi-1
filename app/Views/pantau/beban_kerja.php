<?= $this->include('templates/header'); ?>

<div class="container my-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-0">
            <i class="bi bi-table me-2"></i> Daftar Beban Kerja
        </h4>
    </div>

    <!-- Filter Section -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary">Filter Pegawai</label>
                    <select id="filterPegawai" class="form-select form-select-sm">
                        <option value="">Semua Pegawai</option>
                        <?php
                        $pegawaiList = array_unique(array_column($beban, 'nama_pegawai'));
                        foreach ($pegawaiList as $p): ?>
                            <option value="<?= esc($p) ?>"><?= esc($p) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold text-secondary">Filter Kegiatan</label>
                    <select id="filterKegiatan" class="form-select form-select-sm">
                        <option value="">Semua Kegiatan</option>
                        <?php
                        $kegiatanList = array_unique(array_column($beban, 'nama_kegiatan'));
                        foreach ($kegiatanList as $k): ?>
                            <option value="<?= esc($k) ?>"><?= esc($k) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTable (dengan slider + sticky header) -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <!-- <div class="table-responsive" style="max-height:70vh;"> -->
            <div class="table-responsive"> <!-- batas tinggi -->
                <table id="tabelBeban" class="table table-bordered table-striped table-hover align-middle w-100">
                    <thead class="table-primary text-center sticky-header">
                        <tr>
                            <th>#</th>
                            <th>Nama Pegawai</th>
                            <th>Kegiatan</th>
                            <th>Peran</th>
                            <th>Target</th>
                            <th>Satuan</th>
                            <th>Realisasi</th>
                            <th>%</th>
                            <th>Tanggal Ditambahkan</th>
                            <?php if (session()->get('role2') !== 'anggota'): ?>
                                <th>Aksi</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($beban as $b): ?>
                            <tr>
                                <td class="text-center"><?= $i++ ?></td>
                                <td><?= esc($b['nama_pegawai']) ?></td>
                                <td><?= esc($b['nama_kegiatan']) ?></td>
                                <td><?= esc($b['peran']) ?></td>
                                <td class="text-end"><?= esc($b['target']) ?></td>
                                <td class="text-center"><?= esc($b['satuan']) ?></td>
                                <td class="text-end"><?= esc($b['realisasi']) ?></td>
                                <td>
                                    <div class="progress" style="height:18px;">
                                        <div class="progress-bar bg-primary" role="progressbar"
                                            style="width:<?= esc($b['progress_persen']) ?>%">
                                            <?= esc($b['progress_persen']) ?>%
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center"><?= esc($b['created_at']) ?></td>

                                <?php if (session()->get('role2') !== 'anggota'): ?>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalRealisasi"
                                            data-id="<?= $b['id'] ?>"
                                            data-nama="<?= esc($b['nama_pegawai']) ?>"
                                            data-realisasi="<?= esc($b['realisasi']) ?>">
                                            <i class="bi bi-pencil-square"></i> Update
                                        </button>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div> <!-- /table-responsive -->
        </div>
    </div>
</div>

<!-- Modal Update Realisasi -->
<div class="modal fade" id="modalRealisasi" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('/beban-kerja/update-realisasi') ?>" method="post" class="modal-content">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="modal_id">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i> Update Realisasi</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Pegawai</label>
                    <input id="modal_nama" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Realisasi</label>
                    <input type="number" step="0.01" name="realisasi" id="modal_realisasi" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- jQuery & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        var table = $('#tabelBeban').DataTable({
            order: [
                [8, 'desc']
            ],
            pageLength: 10,
            scrollX: true,
            scrollY: '60vh',
            scrollCollapse: true,
            fixedHeader: true, // 👈 aktifkan sticky header bawaan DataTables
            language: {
                search: "🔍 Cari:",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data",
                zeroRecords: "Tidak ditemukan hasil yang sesuai",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            }
        });

        // Filter Pegawai
        $('#filterPegawai').on('change', function() {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column(1).search(val ? '^' + val + '$' : '', true, false).draw();
        });

        // Filter Kegiatan
        $('#filterKegiatan').on('change', function() {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column(2).search(val ? '^' + val + '$' : '', true, false).draw();
        });
    });

    // Modal event
    document.getElementById('modalRealisasi').addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        document.getElementById('modal_id').value = button.getAttribute('data-id');
        document.getElementById('modal_nama').value = button.getAttribute('data-nama');
        document.getElementById('modal_realisasi').value = button.getAttribute('data-realisasi');
    });
</script>

<style>
    /* Scrollable container + sticky header */
    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    thead.sticky-header th {
        position: sticky;
        top: 0;
        z-index: 10;
        background-color: #e9f3ff !important;
        border-bottom: 2px solid #dee2e6;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1rem;
    }

    .dataTables_wrapper .dataTables_paginate {
        margin-top: 1rem;
    }

    .dataTables_wrapper .dataTables_info {
        font-size: 0.875rem;
        color: #6c757d;
    }

    /* Tambahan agar header DataTables tidak “meloncat” saat scroll */
    table.dataTable thead th,
    table.dataTable thead td {
        white-space: nowrap;
    }
</style>

<?= $this->include('templates/footer'); ?>