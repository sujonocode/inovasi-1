<?= $this->include('templates/header'); ?>

<div class="container my-4">
    <h4 class="page-title">Edit Kegiatan</h4>

    <div class="card shadow-sm p-4">
        <h5 class="text-primary mb-4"><i class="bi bi-pencil-square me-2"></i> Form Edit Kegiatan</h5>

        <form action="<?= base_url('/pantau/update/' . $kegiatan['id']) ?>" method="post" class="row g-3">
            <?= csrf_field() ?>

            <div class="col-md-6">
                <label class="form-label fw-semibold">Nama Kegiatan</label>
                <input name="nama_kegiatan" class="form-control"
                    value="<?= esc($kegiatan['nama_kegiatan']) ?>" required>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Tim</label>
                <select name="tim" class="form-select" required>
                    <?php
                    $timList = ["Distribusi", "Humas", "IPDS", "Neraca", "Produksi", "Sektoral", "Sosial", "Umum"];
                    ?>
                    <option selected><?= esc($kegiatan['tim']) ?></option>
                    <?php foreach ($timList as $t): ?>
                        <?php if ($t != $kegiatan['tim']): ?>
                            <option value="<?= $t ?>"><?= $t ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Satuan Beban Kerja</label>
                <select id="satuanSelectEdit" name="satuan" class="form-select" required>
                    <option value="<?= esc($kegiatan['satuan']) ?>" selected><?= esc($kegiatan['satuan']) ?></option>
                    <option value="SLS">SLS</option>
                    <option value="BS">BS</option>
                    <option value="Desa">Desa</option>
                    <option value="Kecamatan">Kecamatan</option>
                    <option value="Dokumen">Dokumen</option>
                    <option value="Publikasi">Publikasi</option>
                    <option value="lainnya">Lainnya...</option>
                </select>
            </div>

            <div class="col-md-3 d-none" id="satuanLainContainerEdit">
                <label class="form-label fw-semibold">Isi Satuan Lainnya</label>
                <input type="text" name="satuan_lain" id="satuanLainInputEdit" class="form-control">
            </div>



            <div class="col-md-3">
                <label class="form-label fw-semibold">Tahun</label>
                <select name="tahun" id="tahun" class="form-select" required>
                    <option selected><?= esc($kegiatan['tahun']) ?></option>
                    <?php for ($y = 2025; $y <= 2030; $y++): ?>
                        <option value="<?= $y ?>"><?= $y ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Bulan</label>
                <select name="bulan" id="bulan" class="form-select" required>
                    <option selected><?= esc($kegiatan['bulan']) ?></option>
                    <?php
                    $bulanList = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                    foreach ($bulanList as $b): ?>
                        <option value="<?= $b ?>"><?= $b ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-semibold">Awal Pengerjaan</label>
                <input name="awal_pengerjaan" id="awal_pengerjaan" type="date" class="form-control"
                    value="<?= esc($kegiatan['awal_pengerjaan']) ?>" required>
            </div>


            <div class="col-md-3">
                <label class="form-label fw-semibold">Deadline</label>
                <input name="deadline" type="date" class="form-control"
                    value="<?= esc($kegiatan['deadline']) ?>" required>
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3"><?= esc($kegiatan['keterangan']) ?></textarea>
            </div>

            <div class="col-12 text-end">
                <a href="<?= base_url('/pantau/master') ?>" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button class="btn btn-primary px-4">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

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

    document.getElementById('formEditKegiatan').addEventListener('submit', function() {
        const select = document.getElementById('satuanSelectEdit');
        const input = document.getElementById('satuanLainInputEdit');

        if (select.value === 'lainnya' && input.value.trim() !== "") {
            select.value = input.value; // ← ini yang masuk DB
        }
    });
</script>



<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputTanggal = document.getElementById("awal_pengerjaan");
        const selectTahun = document.getElementById("tahun");
        const selectBulan = document.getElementById("bulan");

        const bulanList = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        inputTanggal.addEventListener("change", function() {
            if (!this.value) return;

            const date = new Date(this.value);
            const tahun = date.getFullYear();
            const bulanIndex = date.getMonth(); // 0–11
            const namaBulan = bulanList[bulanIndex];

            // Set tahun
            selectTahun.value = tahun;

            // Set bulan
            selectBulan.value = namaBulan;
        });
    });
</script>

<?= $this->include('templates/footer'); ?>