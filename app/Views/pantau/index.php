<?= $this->include('templates/header'); ?>

<div class="container my-4">
    <h4 class="page-title">📊 Pantau - Dashboard</h4>
    <!-- Flash messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <!-- Navigation buttons -->
    <div class="mb-3 d-flex flex-wrap gap-2">
        <?php if ($role2 !== 'anggota'): ?>
            <a href="<?= base_url('/pantau/master') ?>" class="btn btn-outline-primary">
                <i class="bi bi-folder2-open"></i> Master Kegiatan
            </a>
            <a href="<?= base_url('/pantau/upload') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-upload"></i> Upload Beban Kerja
            </a>
        <?php endif; ?>
    </div>

    <?php if ($role2 !== 'anggota'): ?>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h5 class="mb-2">Ringkasan Kegiatan</h5>
                    <!-- Filter controls -->
                    <div class="d-flex flex-wrap gap-2">
                        <select id="filterTahun" class="form-select form-select-sm" style="width: 120px;">
                            <option value="">Semua Tahun</option>
                            <?php
                            $tahunList = array_unique(array_column($kegiatan, 'tahun'));
                            sort($tahunList);
                            foreach ($tahunList as $t): ?>
                                <option value="<?= esc($t) ?>"><?= esc($t) ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select id="filterBulan" class="form-select form-select-sm" style="width: 140px;">
                            <option value="">Semua Bulan</option>
                            <?php
                            $bulanList = [
                                'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember'
                            ];
                            foreach ($bulanList as $b): ?>
                                <option value="<?= $b ?>"><?= $b ?></option>
                            <?php endforeach; ?>
                        </select>

                        <select id="filterTim" class="form-select form-select-sm" style="width: 140px;">
                            <option value="">Semua Tim</option>
                            <?php
                            $timList = [
                                "Distribusi",
                                "Humas",
                                "IPDS",
                                "Neraca",
                                "Produksi",
                                "Sektoral",
                                "Sosial",
                                "Umum"
                            ];
                            foreach ($timList as $t): ?>
                                <option value="<?= $t ?>"><?= $t ?></option>
                            <?php endforeach; ?>
                        </select>

                        <input type="text" id="searchKegiatan" class="form-control form-control-sm"
                            placeholder="Cari nama kegiatan..." style="width: 200px;">
                    </div>
                </div>

                <!-- Tabel -->
                <div class="table-responsive" style="max-height: 70vh;">
                    <table id="tabelKegiatan"
                        class="table table-striped table-hover table-bordered align-middle w-100">
                        <thead class="table-light text-center sticky-top">
                            <tr>
                                <th style="width: 40px;">#</th>
                                <th>Kegiatan</th>
                                <th>Tim</th>
                                <th style="width: 90px;">Tahun</th>
                                <th style="width: 120px;">Bulan</th>
                                <th style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($kegiatan as $k): ?>
                                <tr>
                                    <?php
                                    $rand = (strlen($i) == 1)
                                        ? rand(10, 99) // 2 digit random
                                        : rand(0, 9); // 1 digit random
                                    ?>
                                    <td><?= 'wrk' . $i++ . $rand ?></td>
                                    <td><?= esc($k['nama_kegiatan']) ?></td>
                                    <td><?= esc($k['tim']) ?></td>
                                    <td><?= esc($k['tahun']) ?></td>
                                    <td><?= esc($k['bulan']) ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('/pantau/detail/' . $k['id']) ?>"
                                            class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($kegiatan)): ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<style>
    /* ====== PENINGKATAN VISUAL TABEL ====== */

    /* Bungkus tabel agar sedikit terangkat */
    .card {
        background-color: #f9fbff;
        border: 1px solid #b8c7e0 !important;
        box-shadow: 0 2px 8px rgba(0, 64, 128, 0.08);
        border-radius: 10px;
    }

    /* Header tabel lebih kontras */
    .table thead th {
        background-color: #e1ecff !important;
        color: #003366 !important;
        border-bottom: 2px solid #b0c8f2 !important;
    }

    /* Warna baris bergantian */
    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: #f6f9ff !important;
    }

    /* Hover jelas */
    .table-hover tbody tr:hover {
        background-color: #d8e8ff !important;
        transition: background-color 0.2s ease;
    }

    /* Garis antar sel tabel */
    .table-bordered td,
    .table-bordered th {
        border-color: #bcd0f7 !important;
    }

    /* Judul dan area filter */
    h3,
    h5 {
        color: #003366;
    }

    /* Filter dropdown dan input */
    .form-select,
    .form-control {
        border-color: #aac4f2 !important;
        box-shadow: none;
    }

    .form-select:focus,
    .form-control:focus {
        border-color: #0d6efd !important;
        box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
    }

    /* Tombol tampil jelas */
    .btn {
        border-radius: 6px;
    }

    .page-title {
        font-weight: 600;
        color: #0d47a1;
        margin-bottom: 1rem;
        /* border-left: 4px solid #0d47a1; */
        /* padding-left: 10px; */
    }

    table.dataTable thead th {
        text-align: center !important;
    }

    .dataTables_length {
        margin-top: 15px !important;
    }

    .dataTables_filter {
        margin-top: 15px !important;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 0.5rem;
    }
</style>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        const table = $('#tabelKegiatan').DataTable({
            pageLength: 10,
            language: {
                search: "",
                searchPlaceholder: "Cari...",
                lengthMenu: "Tampilkan _MENU_ data per halaman",
                info: "Menampilkan _START_–_END_ dari _TOTAL_ data",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "›",
                    previous: "‹"
                }
            },
            // dom: '<"top"i>rt<"bottom"lp><"clear">',
            order: [
                [3, 'desc'],
                [4, 'asc']
            ]
        });

        // Filter berdasarkan tahun
        $('#filterTahun').on('change', function() {
            const val = $(this).val();
            table.column(3).search(val ? '^' + val + '$' : '', true, false).draw();
        });

        // Filter berdasarkan bulan
        $('#filterBulan').on('change', function() {
            const val = $(this).val();
            table.column(4).search(val ? '^' + val + '$' : '', true, false).draw();
        });

        // Filter berdasarkan bulan
        $('#filterTim').on('change', function() {
            const val = $(this).val();
            table.column(2).search(val ? '^' + val + '$' : '', true, false).draw();
        });

        // Pencarian berdasarkan nama kegiatan
        $('#searchKegiatan').on('keyup', function() {
            table.column(1).search(this.value).draw();
        });
    });
</script>

<?= $this->include('templates/footer'); ?>