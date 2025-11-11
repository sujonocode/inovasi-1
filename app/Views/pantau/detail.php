<?= $this->include('templates/header'); ?>
<div class="container my-4">
    <h4>Detail: <?= esc($kegiatan['nama_kegiatan']) ?></h4>
    <p><?= esc($kegiatan['keterangan']) ?></p>

    <table class="table table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Pegawai</th>
                <th>Peran</th>
                <th>Target</th>
                <th>Realisasi</th>
                <th>%</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($items as $it): ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= esc($it['nama_pegawai']) ?></td>
                    <td><?= esc($it['peran']) ?></td>
                    <td><?= esc($it['target']) . ' ' . $it['satuan'] ?></td>
                    <td><?= esc($it['realisasi']) ?></td>
                    <td><?= esc($it['progress_persen']) ?>%</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->include('templates/footer'); ?>