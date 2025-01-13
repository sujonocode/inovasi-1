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

<a href=<?= base_url("surat/create") ?>>Tambah</a>

<div class="container my-5">
    <h1 class="text-center mb-4">Daftar Surat</h1>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Checklist</th>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Alamat/Tujuan</th>
                    <th>Ringkasan Isi</th>
                    <!-- <th>Pertalian Nomor (Terdahulu)</th>
                    <th>Pertalian Nomor (Berikut)</th> -->
                    <th>Terdahulu</th>
                    <th>Berikut</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($surats)): ?>
                    <?php foreach ($surats as $surat): ?>
                        <tr>
                            <td><input type="checkbox" class="rowCheckbox"></td>
                            <td><?= $surat['id'] ?></td>
                            <td><?= $surat['tanggal'] ?></td>
                            <td><?= $surat['alamat'] ?></td>
                            <td><?= $surat['ringkasan'] ?></td>
                            <td><?= $surat['pert_dahulu'] ?></td>
                            <td><?= $surat['pert_berikut'] ?></td>
                            <td><?= $surat['catatan'] ?></td>
                            <td>
                                <a href="/surat/edit/<?= $surat['id'] ?>" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a> |
                                <a href="/surat/delete/<?= $surat['id'] ?>" title="Hapus" onclick="return confirm('Are you sure you want to delete this surat?');">
                                    <i class="fa-solid fa-trash"></i>
                                </a> |
                                <a href="/#" title="Download">
                                    <i class="fa-solid fa-download"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; font-weight: bold;">Surat dengan nomor tersebut tidak ditemukan</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable with scrollable fixed header
        $('#example').DataTable({
            scrollY: '400px', // Set vertical scroll height
            scrollCollapse: true, // Enable collapsing for short tables
            paging: true, // Enable pagination
            fixedHeader: true, // Enable fixed header
            pageLength: 5, // Default rows per page
            lengthMenu: [5, 10, 15, 20], // Rows per page options
            // columnDefs: [{
            //     orderable: true,
            //     targets: '_all'
            // }]
            // columnDefs: [
            //     { orderable: true, targets: [0, 1, 2] },
            //     { orderable: false, targets: [3, 4] }
            // ]
        });
    });
</script>

<script>
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