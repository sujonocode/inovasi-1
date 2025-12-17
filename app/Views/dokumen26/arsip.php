<div class="container my-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="fw-semibold mb-3 text-primary">
                <i class="bi bi-folder2-open me-2"></i>
                Pilih Jenis Arsip Dokumen Tahun 2025
            </h5>

            <div class="row align-items-center">
                <div class="col-md-6 col-lg-4">
                    <label for="pilihDokumen" class="form-label fw-medium">
                        Jenis Dokumen
                    </label>
                    <select id="pilihDokumen" class="form-select form-select-lg">
                        <option value="" selected disabled>
                            -- Silakan pilih dokumen --
                        </option>
                        <option value="surat_keluar_2025">📤 Surat Keluar</option>
                        <option value="surat_masuk_2025">📥 Surat Masuk</option>
                        <option value="sk_2025">📄 Surat Keputusan (SK)</option>
                        <option value="kontrak_2025">📝 Kontrak</option>
                    </select>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="surat_keluar_2025" class="container my-5 d-none">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h1 class="mb-3 mb-md-0">Data Surat Keluar</h1>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="<?= base_url('surat_keluar/create') ?>"
                        class="btn btn-primary btn-sm flex-fill text-center"
                        style="min-width: 120px;"
                        title="Tambah Surat Keluar Baru">
                        <i class="fa-solid fa-plus me-1"></i> Tambah
                    </a>
                    <a href="<?= base_url('surat_keluar/export_xlsx') ?>"
                        class="btn btn-success btn-sm flex-fill text-center"
                        style="min-width: 120px;"
                        title="Download Data Surat Keluar">
                        <i class="fa-solid fa-download me-1"></i> Download
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example_surat_keluar_2025" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Alamat/Tujuan</th>
                            <th>Ringkasan Isi</th>
                            <th>Catatan</th>
                            <th>PIC</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($surats)): ?>
                            <?php foreach ($surats as $surat): ?>
                                <tr>
                                    <td><?= $surat['nomor'] ?></td>
                                    <td><?= $surat['tanggal'] ?></td>
                                    <td><?= $surat['alamat'] ?></td>
                                    <td><?= $surat['ringkasan'] ?></td>
                                    <td><?= $surat['catatan'] ?></td>
                                    <td><?= $surat['created_by'] ?></td>
                                    <td>
                                        <?php if ($surat['kategori'] === 'Surat Keluar (Internal)'): ?>
                                            <i class="fa-solid fa-flag" style="color: #28a745;" title="Surat Keluar (Internal)"></i>
                                        <?php elseif ($surat['kategori'] === 'Surat Keluar (Eksternal)'): ?>
                                            <i class="fa-solid fa-flag" style="color: #fd7e14;" title="Surat Keluar (Eksternal)"></i>
                                        <?php endif; ?>
                                        <a href="#" onclick="handleLinkClick('<?= $surat['url'] ?>'); return false;"><i class="fa-solid fa-eye" title="Lihat"></i></a>
                                        <a href="/surat_keluar/edit/<?= $surat['id'] ?>"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                                        <a href="#" onclick="openDeleteModal(<?= $surat['id'] ?>)"><i class="fa-solid fa-trash" title="Hapus"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php for ($i = 0; $i < 10; $i++): ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#example_surat_keluar_2025').DataTable({
            scrollY: '400px',
            scrollX: true,
            autoWidth: false,
            scrollCollapse: true,
            paging: true,
            fixedHeader: true,
            pageLength: 10,
            lengthMenu: [5, 10, 15, 20],
            columnDefs: [{
                    orderable: true,
                    targets: [0, 1, 2, 3, 4, 5]
                },
                {
                    orderable: false,
                    targets: [6]
                }
            ],
            order: [
                [0, 'desc']
            ],
        });
    });
</script>

<div id="surat_masuk_2025" class="container my-5 d-none">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h1 class="mb-3 mb-md-0"> Data Surat Masuk </h1>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="<?= base_url('surat_masuk/create') ?>"
                        class="btn btn-primary btn-sm flex-fill text-center"
                        style="min-width: 120px;"
                        title="Tambah Surat Masuk Baru">
                        <i class="fa-solid fa-plus me-1">
                        </i> Tambah </a>
                    <a href="<?= base_url('surat_masuk/export_xlsx') ?>"
                        class="btn btn-success btn-sm flex-fill text-center"
                        style="min-width: 120px;"
                        title="Download Data Surat Masuk">
                        <i class="fa-solid fa-download me-1">
                        </i> Download </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example_surat_masuk_2025"
                    class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th> Tanggal </th>
                            <th> Nomor </th>
                            <th> Asal </th>
                            <th> Perihal </th>
                            <th> Catatan </th>
                            <th> PIC </th>
                            <th> Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($surats)): ?>
                            <?php foreach ($surats as $surat): ?>
                                <tr>
                                    <td> <?= $surat['tanggal'] ?> </td>
                                    <td> <?= $surat['nomor'] ?> </td>
                                    <td> <?= $surat['asal'] ?> </td>
                                    <td> <?= $surat['perihal'] ?> </td>
                                    <td> <?= $surat['catatan'] ?> </td>
                                    <td> <?= $surat['created_by'] ?> </td>
                                    <td>
                                        <?php if ($surat['kategori'] === 'Surat Masuk (Internal)'): ?> <i class="fa-solid fa-flag"
                                                style="color: #28a745;"
                                                title="Surat Masuk (Internal)">
                                            </i>
                                        <?php elseif ($surat['kategori'] === 'Surat Masuk (Eksternal)'): ?>
                                            <i class="fa-solid fa-flag"
                                                style="color: #fd7e14;"
                                                title="Surat Masuk (Eksternal)">
                                            </i>
                                        <?php endif; ?>
                                        <a href="#"
                                            onclick="handleLinkClick('<?= $surat['url'] ?>'); return false;">
                                            <i class="fa-solid fa-eye"
                                                title="Lihat">
                                            </i></a>
                                        <a href="/surat_masuk/edit/<?= $surat['id'] ?>">
                                            <i class="fa-solid fa-pen-to-square"
                                                title="Edit">
                                            </i></a>
                                        <a href="#"
                                            onclick="openDeleteModal(<?= $surat['id'] ?>)">
                                            <i class="fa-solid fa-trash"
                                                title="Hapus">
                                            </i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <?php for ($i = 0; $i < 10; $i++): ?>
                                <tr>
                                    <td> &nbsp; </td>
                                    <td> &nbsp; </td>
                                    <td> &nbsp; </td>
                                    <td> &nbsp; </td>
                                    <td> &nbsp; </td>
                                    <td> &nbsp; </td>
                                    <td> &nbsp; </td>
                                </tr> <?php endfor; ?> <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example_surat_masuk_2025').DataTable({
            scrollY: '400px',
            scrollX: true,
            autoWidth: false,
            scrollCollapse: true,
            paging: true,
            fixedHeader: true,
            pageLength: 10,
            lengthMenu: [5, 10, 15, 20],
            columnDefs: [{
                orderable: true,
                targets: [0, 1, 2, 3, 4, 5]
            }, {
                orderable: false,
                targets: [6]
            }],
            order: [
                [0, 'desc']
            ],
        });
    });
</script>
<div id="sk_2025" class="container my-5 d-none">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h1 class="mb-3 mb-md-0">Data Surat Keputusan (SK)</h1>
                <div class="d-flex gap-2 flex-wrap"> <a href="<?= base_url('sk/create') ?>" class="btn btn-primary btn-sm flex-fill text-center" style="min-width: 120px;" title="Tambah SK Baru"> <i class="fa-solid fa-plus me-1"></i> Tambah </a> <a href="<?= base_url('sk/export_xlsx') ?>" class="btn btn-success btn-sm flex-fill text-center" style="min-width: 120px;" title="Download Data SK"> <i class="fa-solid fa-download me-1"></i> Download </a> </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example_sk_2025" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Perihal</th>
                            <th>Catatan</th>
                            <th>PIC</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody> <?php if (!empty($sks)): ?> <?php foreach ($sks as $sk): ?> <tr>
                                    <td><?= $sk['nomor'] ?></td>
                                    <td><?= $sk['tanggal'] ?></td>
                                    <td><?= $sk['perihal'] ?></td>
                                    <td><?= $sk['catatan'] ?></td>
                                    <td><?= $sk['created_by'] ?></td>
                                    <td> <a href="#" onclick="handleLinkClick('<?= $sk['url'] ?>'); return false;"><i class="fa-solid fa-eye" title="Lihat"></i></a> <a href="/sk/edit/<?= $sk['id'] ?>"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a> <a href="#" onclick="openDeleteModal(<?= $sk['id'] ?>)"><i class="fa-solid fa-trash" title="Hapus"></i></a> </td>
                                </tr> <?php endforeach; ?> <?php else: ?>
                            <?php for ($i = 0; $i < 10; $i++): ?> <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr> <?php endfor; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example_sk_2025').DataTable({
            scrollY: '400px',
            scrollX: true,
            autoWidth: false,
            scrollCollapse: true,
            paging: true,
            fixedHeader: true,
            pageLength: 10,
            lengthMenu: [5, 10, 15, 20],
            columnDefs: [{
                orderable: true,
                targets: [0, 1, 2, 3, 4]
            }, {
                orderable: false,
                targets: [5]
            }],
            order: [
                [0, 'desc']
            ],
        });
    });
</script>
<div id="kontrak_2025" class="container my-5 d-none">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h1 class="mb-3 mb-md-0">Data Kontrak</h1>
                <div class="d-flex gap-2 flex-wrap"> <a href="<?= base_url('kontrak/create') ?>" class="btn btn-primary btn-sm flex-fill text-center" style="min-width: 120px;" title="Tambah Kontrak Baru"> <i class="fa-solid fa-plus me-1"></i> Tambah </a> <a href="<?= base_url('kontrak/export_xlsx') ?>" class="btn btn-success btn-sm flex-fill text-center" style="min-width: 120px;" title="Download Data Kontrak"> <i class="fa-solid fa-download me-1"></i> Download </a> </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example_kontrak_2025" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Uraian Kontrak</th>
                            <th>Catatan</th>
                            <th>PIC</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody> <?php if (!empty($kontraks)): ?> <?php foreach ($kontraks as $kontrak): ?> <tr>
                                    <td><?= $kontrak['nomor'] ?></td>
                                    <td><?= $kontrak['tanggal'] ?></td>
                                    <td><?= $kontrak['uraian'] ?></td>
                                    <td><?= $kontrak['catatan'] ?></td>
                                    <td><?= $kontrak['created_by'] ?></td>
                                    <td> <a href="#" onclick="handleLinkClick('<?= $kontrak['url'] ?>'); return false;"><i class="fa-solid fa-eye" title="Lihat"></i></a> <a href="/kontrak/edit/<?= $kontrak['id'] ?>"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                                        <a href="#" onclick="openDeleteModal(<?= $kontrak['id'] ?>)"><i class="fa-solid fa-trash" title="Hapus"></i></a>
                                    </td>
                                </tr> <?php endforeach; ?> <?php else: ?>
                            <?php for ($i = 0; $i < 10; $i++): ?> <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr> <?php endfor; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#example_kontrak_2025').DataTable({
            scrollY: '400px',
            scrollX: true,
            autoWidth: false,
            scrollCollapse: true,
            paging: true,
            fixedHeader: true,
            pageLength: 10,
            lengthMenu: [5, 10, 15, 20],
            columnDefs: [{
                orderable: true,
                targets: [0, 1, 2, 3, 4]
            }, {
                orderable: false,
                targets: [5]
            }],
            order: [
                [0, 'desc']
            ],
        });
    });
</script>

<script>
    document.getElementById('pilihDokumen').addEventListener('change', function() {
        const sections = ['surat_keluar_2025', 'surat_masuk_2025', 'sk_2025', 'kontrak_2025'];

        sections.forEach(id => {
            document.getElementById(id).classList.add('d-none');
        });

        if (this.value) {
            document.getElementById(this.value).classList.remove('d-none');
        }
    });
</script>

<style>
    #pilihDokumen {
        transition: all .2s ease-in-out;
    }

    #pilihDokumen:focus {
        box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .25);
    }
</style>