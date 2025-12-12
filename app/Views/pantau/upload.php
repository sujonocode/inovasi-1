<?= $this->include('templates/header'); ?>
<div class="container my-4">
    <h4 class="page-title">🎯 Beban Kerja</h4>

    <div class="form-section card shadow-sm p-3 mb-4">
        <h5 class="mb-3 text-primary">
            <i class="bi bi-clipboard-plus me-2"></i> Template Upload
        </h5>
        <div class="mt-0">
            <a class="btn btn-info btn-sm text-white shadow-sm"
                href="<?= base_url('/assets/templates/20251209_template_beban_kerja.xlsx') ?>">
                <i class="bi bi-download"></i> Download Template Excel
            </a>

            <div class="mt-3 p-3 border rounded bg-light">
                <h6 class="fw-semibold mb-2">Pedoman Penggunaan Template</h6>

                <ul class="small text-muted mb-0">
                    <li>Kolom header pada baris pertama (sheet <strong>BebanKerja</strong>):
                        <strong>No | Nama Pegawai | Peran | Target</strong>
                    </li>
                    <li>Isi baris di bawahnya sesuai kebutuhan.</li>
                    <li><strong>No</strong>: Isi dengan urutan 1, 2, 3, dan seterusnya.</li>
                    <li><strong>Nama Pegawai</strong>: Pilih dari dropdown berdasarkan sheet <strong>Master</strong>.</li>
                    <li><strong>Peran</strong>: Contoh: PML, PPL, etc.</li>
                    <li><strong>Target</strong>: Isi angka (1, 2, 3, ...).</li>
                    <!-- <li><strong>Satuan</strong>: Contoh: SLS, BS, Kecamatan, etc.</li> -->
                </ul>
            </div>
        </div>

    </div>

    <div class="form-section card shadow-sm p-3 mb-4">
        <h5 class="mb-3 text-primary">
            <i class="bi bi-clipboard-plus me-2"></i> Upload Beban Kerja per Kegiatan
        </h5>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('/pantau/upload/save') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <?php
            // dd($kegiatan); 
            $timList = array_unique(array_column($kegiatan, 'tim'));
            ?>

            <div class="mb-3">
                <label>Pilih Tim</label>
                <select name="tim" id="timSelect" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <?php foreach ($timList as $t): ?>
                        <option value="<?= esc($t) ?>"><?= esc($t) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label>Pilih Kegiatan</label>
                <select name="id_kegiatan" id="kegiatanSelect" class="form-select" required>
                    <option value="">-- Pilih --</option>
                </select>
            </div>

            <div class="mb-3">
                <label>File Excel (format: No | Nama Pegawai | Peran | Target)</label>
                <input type="file" name="file_excel" class="form-control" accept=".xlsx,.xls" required>
            </div>

            <button class="btn btn-primary">Unggah</button>
        </form>
    </div>
</div>

<style>
    .page-title {
        font-weight: 600;
        color: #0d47a1;
        margin-bottom: 1rem;
        /* border-left: 4px solid #0d47a1;
        padding-left: 10px; */
    }

    .form-section {
        background-color: #f8faff;
        border: 1px solid #dbe7ff;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }

    .form-section input::placeholder {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .form-section button {
        width: 100%;
        height: 100%;
    }

    .table thead th {
        background-color: #e3f2fd;
        color: #0d47a1;
        font-weight: 600;
        border-bottom: 2px solid #90caf9;
    }

    .table-hover tbody tr:hover {
        background-color: #f5f9ff;
    }

    .dataTables_wrapper .dataTables_paginate {
        margin-top: 1rem !important;
        display: flex;
        justify-content: center;
    }

    .dataTables_wrapper .dataTables_paginate .page-item .page-link {
        border-radius: 8px;
        color: #0d47a1;
    }

    .dataTables_wrapper .dataTables_paginate .page-item.active .page-link {
        background-color: #0d47a1;
        border-color: #0d47a1;
        color: #fff;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 0.5rem;
    }

    .form-section {
        border-radius: 10px;
        background-color: #f8fbff;
    }

    .form-label {
        font-size: 0.875rem;
        color: #0d6efd;
    }

    button[type="submit"] {
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    .form-section {
        border-radius: 10px;
        background-color: #f8fbff;
    }

    .form-label {
        font-size: 0.875rem;
        color: #0d6efd;
    }
</style>

<script>
    const semuaKegiatan = <?= json_encode($kegiatan) ?>;

    document.getElementById('timSelect').addEventListener('change', function() {
        const timDipilih = this.value;
        const dropdownKegiatan = document.getElementById('kegiatanSelect');

        dropdownKegiatan.innerHTML = '<option value="">-- Pilih --</option>';

        if (!timDipilih) return;

        const hasil = semuaKegiatan.filter(k => k.tim === timDipilih);

        hasil.forEach(k => {
            const opt = document.createElement('option');
            opt.value = k.id;
            opt.textContent = k.nama_kegiatan;
            dropdownKegiatan.appendChild(opt);
        });
    });
</script>

<?= $this->include('templates/footer'); ?>