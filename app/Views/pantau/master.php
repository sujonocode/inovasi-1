<?= $this->include('templates/header'); ?>
<div class="container my-4">
    <h4>Master Kegiatan</h4>
    <form action="<?= base_url('/pantau/tambah-kegiatan') ?>" method="post" class="mb-3">
        <?= csrf_field() ?>
        <div class="row g-2">
            <div class="col-md-4"><input name="nama_kegiatan" class="form-control" placeholder="Nama kegiatan" required></div>
            <div class="col-md-2"><input name="tahun" class="form-control" placeholder="Tahun"></div>
            <div class="col-md-2"><input name="awal_pengerjaan" type="date" class="form-control"></div>
            <div class="col-md-2"><input name="deadline" type="date" class="form-control"></div>
            <div class="col-md-2"><button class="btn btn-primary" type="submit">Tambah</button></div>
        </div>
        <div class="mt-2"><input name="keterangan" class="form-control" placeholder="Keterangan (opsional)"></div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Tahun</th>
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
                    <td><?= esc($k['awal_pengerjaan']) ?></td>
                    <td><?= esc($k['deadline']) ?></td>
                    <td><?= esc($k['created_by_name']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->include('templates/footer'); ?>