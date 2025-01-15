<!-- Display success or error messages in a pop-up -->
<?php if (session()->getFlashdata('error')): ?>
    <!-- Error Pop-up Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= session()->getFlashdata('error'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <!-- Success Pop-up Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= session()->getFlashdata('success'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="text-center mb-4">Daftar Surat</h1>
        <a href=<?= base_url("surat/create") ?> class="btn btn-primary btn-sm" title="Tambah Surat Baru">
            <i class="fa-solid fa-plus"></i> Tambah
        </a>
    </div>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Alamat/Tujuan</th>
                    <th>Ringkasan Isi</th>
                    <th>Pertalian Nomor Terdahulu</th>
                    <th>Pertalian Nomor Berikut</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($surats)): ?>
                    <?php foreach ($surats as $surat): ?>
                        <tr>
                            <td><?= $surat['tanggal'] ?></td>
                            <td><?= $surat['alamat'] ?></td>
                            <td><?= $surat['ringkasan'] ?></td>
                            <td><?= $surat['pert_dahulu'] ?></td>
                            <td><?= $surat['pert_berikut'] ?></td>
                            <td><?= $surat['catatan'] ?></td>
                            <td>
                                <a href=<?= $surat['url'] ?>><i class="fa-solid fa-eye" title="Lihat"></i></a>
                                <a href="/surat/edit/<?= $surat['id'] ?>"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                                <a href="/surat/delete/<?= $surat['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data surat ini?');"><i class="fa-solid fa-trash" title="Hapus"></i></a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; font-weight: bold;">Belum ada data surat.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
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
                    targets: [0, 1, 2, 3]
                },
                {
                    orderable: false,
                    targets: [4]
                }
            ],
            order: [
                [0, 'desc']
            ],
        });
    });

    // Automatically show the modal when the page loads if a flash message exists
    window.onload = function() {
        <?php if (session()->getFlashdata('error')): ?>
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        <?php endif; ?>
    }
</script>