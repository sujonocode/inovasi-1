<div class="container my-5">
    <h2 class="section-title text-center mb-4">Dashboard Admin</h2>
    <div class="row g-4 mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header text-white text-center" style="background-color: rgba(78, 121, 167, 1);">
                    <i class="fa-solid fa-users"></i> Total Akun (Admin + User)
                </div>
                <div class="card-body text-center">
                    <h5 id="card-1" class="card-title display-6 fw-bold"></h5>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header text-white text-center" style="background-color: rgba(78, 121, 167, 1);">
                    <i class="fa-solid fa-user-gear"></i> Total Admin
                </div>
                <div class="card-body text-center">
                    <h5 id="card-2" class="card-title display-6 fw-bold"></h5>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-header text-white text-center" style="background-color: rgba(78, 121, 167, 1);">
                    <i class="fa-solid fa-user"></i> Total User
                </div>
                <div class="card-body text-center">
                    <h5 id="card-3" class="card-title display-6 fw-bold"></h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="text-center mb-4">Daftar User</h1>
                <a href="<?= base_url("admin/create") ?>" class="btn btn-primary btn-sm" title="Tambah user Baru">
                    <i class="fa-solid fa-plus"></i> Tambah
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['nama'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['role'] ?></td>
                                    <td>
                                        <a href="/admin/edit/<?= $user['id'] ?>"><i class="fa-solid fa-pen-to-square" title="Edit"></i></a>
                                        <a href="#" onclick="openDeleteModal(<?= $user['id'] ?>)"><i class="fa-solid fa-trash" title="Hapus"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
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

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data user ini?
            </div>
            <div class="modal-footer">
                <!-- Cancel Button -->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <!-- Delete Button -->
                <button id="confirmDeleteBtn" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>


<script>
    const totalAkun = <?php echo json_encode($totalAkun); ?>;

    const totalAkunByRole = <?php echo json_encode($totalAkunByRole); ?>;

    function getRoleAndCount(data) {
        const countByCategory = data.reduce((acc, item) => {
            if (acc[item.role]) {
                acc[item.role] += parseInt(item.count);
            } else {
                acc[item.role] = parseInt(item.count);
            }
            return acc;
        }, {});

        const akunRole = Object.keys(countByCategory);
        const akunRoleCount = Object.values(countByCategory);

        return {
            akunRole,
            akunRoleCount
        };
    }

    const {
        akunRole,
        akunRoleCount
    } = getRoleAndCount(totalAkunByRole);
</script>

<!-- Card Chart -->
<script>
    document.getElementById('card-1').innerText = `${totalAkun}`;
    document.getElementById('card-2').innerText = `${akunRoleCount[0]}`;
    document.getElementById('card-3').innerText = `${akunRoleCount[1]}`;
</script>

<script>
    // Open the modal and set the delete URL dynamically
    function openDeleteModal(userId) {
        // Set the delete ID in a custom attribute, or store it globally
        const deleteUrl = "<?= base_url() ?>" + "admin/delete/" + userId;

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
                    targets: [4]
                }
            ],
            // order: [
            //     [0, 'desc']
            // ],
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