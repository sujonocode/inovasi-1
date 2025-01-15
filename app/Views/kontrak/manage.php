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

<a href=<?= base_url("kontrak/create") ?>>Tambah</a>

<div class="container my-5">
    <h1 class="text-center mb-4">Daftar Kontrak</h1>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nomor</th>
                    <th>Uraian Kontrak</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($kontraks)): ?>
                    <?php foreach ($kontraks as $kontrak): ?>
                        <tr>
                            <td><?= $kontrak['tanggal'] ?></td>
                            <td><?= $kontrak['nomor'] ?></td>
                            <td><?= $kontrak['uraian'] ?></td>
                            <td><?= $kontrak['catatan'] ?></td>
                            <td>
                                <a href=<?= $kontrak['url'] ?>><i class="fa-solid fa-eye" title="Lihat"></i></a>
                                <a href="/kontrak/edit/<?= $kontrak['id'] ?>"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                                <a href="/kontrak/delete/<?= $kontrak['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data kontrak ini?');"><i class="fa-solid fa-trash" title="Hapus"></i></a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; font-weight: bold;">Belum ada data kontrak.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialize DataTable with scrollable fixed header
        $('#example').DataTable({
            scrollY: '400px', // Set vertical scroll height
            scrollX: true, // Enable horizontal scroll
            autoWidth: false,
            scrollCollapse: true, // Enable collapsing for short tables
            paging: true, // Enable pagination
            fixedHeader: true, // Enable fixed header
            pageLength: 10, // Default rows per page
            lengthMenu: [5, 10, 15, 20], // Rows per page options
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