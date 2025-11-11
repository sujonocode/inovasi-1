<?= $this->include('layout/header'); ?>
<div class="container my-4">
    <h3>Pantau - Dashboard</h3>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <a href="<?= base_url('/pantau/master') ?>" class="btn btn-outline-primary">Master Kegiatan</a>
        <?php if (session()->get('user')['role'] !== 'anggota'): ?>
            <a href="<?= base_url('/upload') ?>" class="btn btn-outline-secondary">Upload Beban Kerja</a>
        <?php endif; ?>
        <a href="<?= base_url('/beban-kerja') ?>" class="btn btn-outline-success">Daftar Beban Kerja</a>
    </div>

    <div class="card">
        <div class="card-body">
            <h5>Ringkasan Kegiatan</h5>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kegiatan</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($kegiatan as $k): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= esc($k['nama_kegiatan']) ?></td>
                            <td><?= esc($k['tahun']) ?></td>
                            <td><a href="<?= base_url('/pantau/detail/' . $k['id']) ?>" class="btn btn-sm btn-primary">Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($kegiatan)): ?>
                        <tr>
                            <td colspan="4">Tidak ada kegiatan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->include('layout/footer'); ?>