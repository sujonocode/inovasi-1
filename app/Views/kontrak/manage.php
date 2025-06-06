<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <h1 class="mb-3 mb-md-0">Data Kontrak</h1>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="<?= base_url('kontrak/create') ?>"
                        class="btn btn-primary btn-sm flex-fill text-center"
                        style="min-width: 120px;"
                        title="Tambah Kontrak Baru">
                        <i class="fa-solid fa-plus me-1"></i> Tambah
                    </a>
                    <a href="<?= base_url('kontrak/export_xlsx') ?>"
                        class="btn btn-success btn-sm flex-fill text-center"
                        style="min-width: 120px;"
                        title="Download Data Kontrak">
                        <i class="fa-solid fa-download me-1"></i> Download
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Tanggal</th>
                            <th>Uraian Kontrak</th>
                            <th>Catatan</th>
                            <th>PIC</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($kontraks)): ?>
                            <?php foreach ($kontraks as $kontrak): ?>
                                <tr>
                                    <td><?= $kontrak['nomor'] ?></td>
                                    <td><?= $kontrak['tanggal'] ?></td>
                                    <td><?= $kontrak['uraian'] ?></td>
                                    <td><?= $kontrak['catatan'] ?></td>
                                    <td><?= $kontrak['created_by'] ?></td>
                                    <td>
                                        <a href="#" onclick="handleLinkClick('<?= $kontrak['url'] ?>'); return false;"><i class="fa-solid fa-eye" title="Lihat"></i></a>
                                        <a href="/kontrak/edit/<?= $kontrak['id'] ?>"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                                        <!-- <a href="/kontrak/delete/< ?= $kontrak['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data kontrak ini?');"><i class="fa-solid fa-trash" title="Hapus"></i></a> -->
                                        <a href="#" onclick="openDeleteModal(<?= $kontrak['id'] ?>)"><i class="fa-solid fa-trash" title="Hapus"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- <tr>
                                <td colspan="6" style="text-align: center; font-weight: bold;">Belum ada data kontrak</td>
                            </tr> -->
                            <?php for ($i = 0; $i < 10; $i++): ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endfor; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= session()->getFlashdata('error'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= session()->getFlashdata('success'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Notifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data kontrak ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a id="confirmDeleteBtn" class="btn btn-danger" href="#">Hapus</a>
            </div>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('limited')): ?>
    <div class="modal fade" id="limitedModal" tabindex="-1" aria-labelledby="limitedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="limitedModalLabel">Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= session()->getFlashdata('limited'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="modal fade" id="seeModal" tabindex="-1" aria-labelledby="seeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="seeModalLabel">Notifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="modal-message"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to handle the "eye" icon click event
    function handleLinkClick(url) {
        const modalMessage = document.getElementById('modal-message');
        const seeModal = new bootstrap.Modal(document.getElementById('seeModal'));

        if (!url || url.trim() === '') {
            // If URL is empty, show modal with "link empty" message
            modalMessage.innerText = 'Link masih kosong';
            seeModal.show();
        } else {
            // If URL is not empty, open it in a new tab
            window.open(url, '_blank');
        }
    }
</script>

<script>
    // Open the modal and set the delete URL dynamically
    function openDeleteModal(skId) {
        // Set the delete ID in a custom attribute, or store it globally
        const deleteUrl = "<?= base_url() ?>" + "kontrak/delete/" + skId;

        // Store the URL in the delete button as a data attribute
        document.getElementById('confirmDeleteBtn').setAttribute('data-delete-url', deleteUrl);

        // Show the modal
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }

    // Handle the delete button click
    document.getElementById('confirmDeleteBtn').addEventListener('click', function(event) {
        // Prevent the default behavior
        event.preventDefault();

        // Get the URL to be deleted from the data attribute
        const deleteUrl = this.getAttribute('data-delete-url');

        // Redirect to the delete URL (or you can use AJAX to delete data without a page reload)
        window.location.href = deleteUrl;
    });
</script>

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
                    targets: [0, 1, 2, 3, 4]
                },
                {
                    orderable: false,
                    targets: [5]
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
        <?php if (session()->getFlashdata('limited')): ?>
            var limitedModal = new bootstrap.Modal(document.getElementById('limitedModal'));
            limitedModal.show();
        <?php endif; ?>
    }
</script>