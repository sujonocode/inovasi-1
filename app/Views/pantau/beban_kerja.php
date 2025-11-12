<?= $this->include('templates/header'); ?>
<div class="container my-4">
    <h4>Daftar Beban Kerja</h4>

    <!-- Filter tambahan -->
    <div class="row mb-3">
        <div class="col-md-4">
            <label>Filter Pegawai:</label>
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
            <label>Filter Kegiatan:</label>
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

    <table id="tabelBeban" class="table table-bordered table-sm table-striped align-middle">
        <thead class="table-light">
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
                    <td><?= $i++ ?></td>
                    <td><?= esc($b['nama_pegawai']) ?></td>
                    <td><?= esc($b['nama_kegiatan']) ?></td>
                    <td><?= esc($b['peran']) ?></td>
                    <td><?= esc($b['target']) ?></td>
                    <td><?= esc($b['satuan']) ?></td>
                    <td><?= esc($b['realisasi']) ?></td>
                    <td>
                        <div class="progress" style="height:18px;">
                            <div class="progress-bar" role="progressbar"
                                style="width:<?= esc($b['progress_persen']) ?>%">
                                <?= esc($b['progress_persen']) ?>%
                            </div>
                        </div>
                    </td>
                    <td><?= esc($b['created_at']) ?></td>

                    <?php if (session()->get('role2') !== 'anggota'): ?>
                        <td>
                            <button class="btn btn-sm btn-primary"
                                data-bs-toggle="modal"
                                data-bs-target="#modalRealisasi"
                                data-id="<?= $b['id'] ?>"
                                data-nama="<?= esc($b['nama_pegawai']) ?>"
                                data-realisasi="<?= esc($b['realisasi']) ?>">
                                Update
                            </button>
                        </td>
                    <?php endif; ?>


                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        var table = $('#tabelBeban').DataTable({
            order: [
                [8, 'desc']
            ],
            pageLength: 10,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ entri",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                zeroRecords: "Tidak ditemukan data yang sesuai",
                paginate: {
                    first: "Pertama",
                    last: "Terakhir",
                    next: "Berikutnya",
                    previous: "Sebelumnya"
                }
            }
        });

        // Filter berdasarkan pegawai (exact match)
        $('#filterPegawai').on('change', function() {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column(1).search(val ? '^' + val + '$' : '', true, false).draw();
        });

        // Filter berdasarkan kegiatan (exact match)
        $('#filterKegiatan').on('change', function() {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            table.column(2).search(val ? '^' + val + '$' : '', true, false).draw();
        });
    });
</script>

<!-- Modal Update Realisasi -->
<div class="modal fade" id="modalRealisasi" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('/beban-kerja/update-realisasi') ?>" method="post" class="modal-content">
            <?= csrf_field() ?>
            <input type="hidden" name="id" id="modal_id">
            <div class="modal-header">
                <h5 class="modal-title">Update Realisasi</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2"><label>Nama</label><input id="modal_nama" class="form-control" readonly></div>
                <div class="mb-2"><label>Realisasi</label><input type="number" step="0.01" name="realisasi" id="modal_realisasi" class="form-control" required></div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button><button class="btn btn-primary" type="submit">Simpan</button></div>
        </form>
    </div>
</div>

<script>
    var modal = document.getElementById('modalRealisasi');
    modal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        document.getElementById('modal_id').value = button.getAttribute('data-id');
        document.getElementById('modal_nama').value = button.getAttribute('data-nama');
        document.getElementById('modal_realisasi').value = button.getAttribute('data-realisasi');
    });
</script>

<?= $this->include('templates/footer'); ?>