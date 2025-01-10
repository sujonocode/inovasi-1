<style>
    th {
        text-align: center;
        vertical-align: middle;
    }
</style>

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

<div class="container my-4">
    <!-- Search bar -->
    <div class="input-group mb-3">
        <input
            type="text"
            id="searchInput"
            class="form-control"
            placeholder="Search..."
            aria-label="Search"
            aria-describedby="search-button">
        <button class="btn btn-primary" type="button" id="search-button">
            Search
        </button>
    </div>

    <!-- Buttons for Check All / Uncheck All -->
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div>
            <button class="btn btn-success" id="checkAllButton">Check All</button>
            <button class="btn btn-danger" id="uncheckAllButton">Uncheck All</button>
        </div>
        <a href="/surat/create" class="btn btn-success">Tambah Surat</a>
    </div>


    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover" style="text-align: center;">
            <thead class="table-dark">
                <tr>
                    <th rowspan="2">Checklist</th>
                    <th rowspan="2">ID</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">Alamat/Tujuan</th>
                    <th rowspan="2">Ringkasan Isi</th>
                    <th colspan="2">Pertalian dengan Nomor (Terdahulu)</th>
                    <th rowspan="2">Catatan</th>
                    <th rowspan="2">Aksi</th>
                </tr>
                <tr>
                    <th>Pertalian dengan Nomor (Terdahulu)</th>
                    <th>Pertalian dengan nomor (Berikut)</th>
                </tr>
            </thead>
            <tbody id="tableBody">
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

<!-- JavaScript -->
<script>
    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const match = Array.from(cells).some(cell =>
                cell.textContent.toLowerCase().includes(filter)
            );
            row.style.display = match ? '' : 'none';
        });
    });

    // Check All / Uncheck All for filtered rows
    const rowCheckboxes = document.querySelectorAll('.rowCheckbox');
    const checkAllButton = document.getElementById('checkAllButton');
    const uncheckAllButton = document.getElementById('uncheckAllButton');

    // "Check All" button for visible rows
    checkAllButton.addEventListener('click', function() {
        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            if (row.style.display !== 'none') { // Only check visible rows
                const checkbox = row.querySelector('.rowCheckbox');
                checkbox.checked = true;
            }
        });
    });

    // "Uncheck All" button for visible rows
    uncheckAllButton.addEventListener('click', function() {
        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
            if (row.style.display !== 'none') { // Only uncheck visible rows
                const checkbox = row.querySelector('.rowCheckbox');
                checkbox.checked = false;
            }
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

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>