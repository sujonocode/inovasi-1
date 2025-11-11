<?= $this->include('layout/header'); ?>
<div class="container my-4">
    <h4>Daftar Beban Kerja</h4>
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pegawai</th>
                <th>Kegiatan</th>
                <th>Peran</th>
                <th>Target</th>
                <th>Satuan</th>
                <th>Realisasi</th>
                <th>%</th>
                <th>Aksi</th>
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
                    <td><?= esc($b['target']) . ' ' . $b['satuan'] ?></td>
                    <td><?= esc($b['satuan']) ?></td>
                    <td><?= esc($b['realisasi']) ?></td>
                    <td>
                        <div class="progress" style="height:18px;">
                            <div class="progress-bar" role="progressbar" style="width:<?= esc($b['progress_persen']) ?>%"><?= esc($b['progress_persen']) ?>%</div>
                        </div>
                    </td>
                    <td>
                        <!-- tombol edit realisasi; akses dibatasi di controller, tapi bisa dikontrol juga di view -->
                        <?php if (session()->get('user')['role'] !== 'kepala' || true): ?>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalRealisasi" data-id="<?= $b['id'] ?>" data-nama="<?= esc($b['nama_pegawai']) ?>" data-realisasi="<?= esc($b['realisasi']) ?>">Update</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

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

<?= $this->include('layout/footer'); ?>