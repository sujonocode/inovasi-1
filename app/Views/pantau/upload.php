<?= $this->include('templates/header'); ?>
<div class="container my-4">
    <h4>Upload Beban Kerja</h4>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <form action="<?= base_url('/upload/save') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label>Pilih Kegiatan</label>
            <select name="id_kegiatan" class="form-select" required>
                <option value="">-- Pilih --</option>
                <?php foreach ($kegiatan as $k): ?>
                    <option value="<?= $k['id'] ?>"><?= esc($k['nama_kegiatan']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>File Excel (format: Nama Pegawai | Peran | Target | Satuan)</label>
            <input type="file" name="file_excel" class="form-control" accept=".xlsx,.xls" required>
        </div>
        <button class="btn btn-primary">Unggah</button>
    </form>

    <div class="mt-3">
        <a class="btn btn-outline-info" href="<?= base_url('/assets/templates/template_beban_kerja.xlsx') ?>">Download Template Excel</a>
        <p class="mt-2 small text-muted">Template: kolom header di baris 1 - <strong>Nama Pegawai | Peran | Target | Satuan</strong></p>
    </div>
</div>
<?= $this->include('templates/footer'); ?>