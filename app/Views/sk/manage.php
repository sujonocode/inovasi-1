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

<a href="/sk/create">Tambah SK</a>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nomor</th>
            <th>Tanggal</th>
            <th>Perihal</th>
            <th>Catatan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($sks)): ?>
            <?php foreach ($sks as $sk): ?>
                <tr>
                    <td><?= $sk['id'] ?></td>
                    <td><?= $sk['nomor'] ?></td>
                    <td><?= $sk['tanggal'] ?></td>
                    <td><?= $sk['perihal'] ?></td>
                    <td><?= $sk['catatan'] ?></td>
                    <td>
                        <a href="/sk/edit/<?= $sk['id'] ?>">Edit</a> |
                        <a href="/sk/delete/<?= $sk['id'] ?>" onclick="return confirm('Are you sure you want to delete this sk_nomor?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" style="text-align: center; font-weight: bold;">No sk_nomor available.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

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

<!-- sampai sini aja -->
<br>
<br>

<div class="container my-4">
    <h2 class="text-center mb-4">Searchable Table</h2>

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
    <div class="mb-3">
        <button class="btn btn-success" id="checkAllButton">Check All</button>
        <button class="btn btn-danger" id="uncheckAllButton">Uncheck All</button>
    </div>

    <!-- Table -->
    <table class="table table-bordered table-hover" style="text-align: center;">
        <thead class="table-dark">
            <tr>
                <th>Checklist</th> <!-- Header checkbox -->
                <th>ID</th>
                <th>Nomor</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Download</i></th>
            </tr>
        </thead>
        <tbody id="tableBody">
            <tr>
                <td><input type="checkbox" class="rowCheckbox"></td>
                <td>0001</td>
                <td>B-1768/18020/KP.320/2024</td>
                <td>Ahmad Faisal</td>
                <td>Sk Tugas</td>
                <td><a href="<?= site_url('generate-report') ?>"><i class="fa-solid fa-download"></i></a>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" class="rowCheckbox"></td>
                <td>0002</td>
                <td>B-1769/18020/KP.320/2024</td>
                <td>John Dalton</td>
                <td>Sk Cuti</td>
                <td><a href="<?= site_url('generate-report') ?>"><i class="fa-solid fa-download"></i></a>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" class="rowCheckbox"></td>
                <td>0003</td>
                <td>B-1770/18020/KP.320/2024</td>
                <td>John Doe</td>
                <td>Sk Cuti</td>
                <td><a href="<?= site_url('generate-report') ?>"><i class="fa-solid fa-download"></i></a>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" class="rowCheckbox"></td>
                <td>0004</td>
                <td>B-1768/18020/KP.320/2024</td>
                <td>Ahmad Faisal</td>
                <td>Sk Tugas</td>
                <td><a href="<?= site_url('generate-report') ?>"><i class="fa-solid fa-download"></i></a>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" class="rowCheckbox"></td>
                <td>0005</td>
                <td>B-1769/18020/KP.320/2024</td>
                <td>John Dalton</td>
                <td>Sk Cuti</td>
                <td><a href="<?= site_url('generate-report') ?>"><i class="fa-solid fa-download"></i></a>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" class="rowCheckbox"></td>
                <td>0006</td>
                <td>B-1770/18020/KP.320/2024</td>
                <td>John Doe</td>
                <td>Sk Cuti</td>
                <td><a href="<?= site_url('generate-report') ?>"><i class="fa-solid fa-download"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
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
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>