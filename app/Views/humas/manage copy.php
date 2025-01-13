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

<a href=<?= base_url("humas/create") ?>>Tambah</a>

<div class="container my-5">
    <h1 class="text-center mb-4">Daftar Reminder Humas</h1>
    <div class="table-responsive">
        <table id="example" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Actions</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($jadwalKontens)): ?>
                    <?php foreach ($jadwalKontens as $jadwalKonten): ?>
                        <tr>
                            <td><?= $jadwalKonten['id'] ?></td>
                            <td><?= $jadwalKonten['nama'] ?></td>
                            <td><?= $jadwalKonten['tanggal'] ?></td>
                            <td><?= $jadwalKonten['waktu'] ?></td>
                            <td><?= $jadwalKonten['kategori'] ?></td>
                            <td><?= $jadwalKonten['kontak'] ?></td>
                            <!-- Decode the "Pengingat" JSON string into an array -->
                            <td>
                                <?php
                                // Decode the "pengingat" JSON string into an array
                                $pengingat = json_decode($jadwalKonten['pengingat'], true);

                                // If there are any values, display them
                                if ($pengingat) {
                                    echo implode(", ", $pengingat);
                                } else {
                                    echo "No Pengingat selected";
                                }
                                ?>
                            </td>
                            <td><?= $jadwalKonten['catatan'] ?></td>
                            <td>
                                <a href="/humas/edit/<?= $jadwalKonten['id'] ?>">Edit</a> |
                                <a href="/humas/delete/<?= $jadwalKonten['id'] ?>" onclick="return confirm('Are you sure you want to delete this jadwalKonten?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align: center; font-weight: bold;">No jadwalKontens available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- Bootstrap JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"> -->
</script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js">
</script>

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