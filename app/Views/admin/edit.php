<!-- Display error pop-up if an error message is passed -->
<?php if (isset($error)): ?>
    <!-- Error Pop-up Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $error; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Display success pop-up if a success message is passed -->
<?php if (isset($success)): ?>
    <!-- Success Pop-up Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $success; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-section">
                <h2 class="text-center mb-4">Formulir Edit Data Akun</h2>
                <?php if (isset($user)): ?>
                    <form id="editForm" onsubmit="return validateCheckboxes()" action="<?= base_url('admin/update/' . $user['id']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="username" class="col-md-3 form-label">Username</label>
                            <div class="col-md-9">
                                <input id="username" type="text" name="username" class="form-control" value="<?= $user['username'] ?>" required readonly>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="nama" class="col-md-3 form-label">Nama:</label>
                            <div class="col-md-9">
                                <input id="nama" type="text" name="nama" class="form-control"
                                    value="<?= $user['nama'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="email" class="col-md-3 form-label">Email:</label>
                            <div class="col-md-9">
                                <textarea id="email" name="email" class="form-control" rows="3"
                                    required><?= $user['email'] ?></textarea>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="role" class="col-md-3 form-label">Role:</label>
                            <div class="col-md-9">
                                <select name="role" id="role" class="form-control">
                                    <option value="">Pilih</option>
                                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= base_url('admin_dashboard') ?>" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                            <!-- <button type="reset" class="btn btn-secondary"><i class="fa-solid fa-arrow-rotate-left"></i> Reset</button> -->
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to validate URL
    function validateCheckboxes() {
        return true;
    }

    document.getElementById("editForm").addEventListener("submit", function(e) {
        const urlInput = document.getElementById("url").value.trim();
        const errorMessage = document.getElementById("error-message");

        // Check if at least one of the conditions is true (submit the form if one is true)
        if (isValidUrl(urlInput) || isGoogleDriveLink(urlInput) || isBpsDriveLink(urlInput) || isEmpty(urlInput)) {
            // Proceed with form submission
            errorMessage.style.display = "none";
            return true;
        } else {
            // Prevent form submission if none of the conditions is true
            e.preventDefault();
            errorMessage.style.display = "block";
            return false;
        }
    });
</script>

<script>
    $(document).ready(function() {
        // Update CSRF token dynamically after form submission
        function updateCSRFToken(xhr) {
            const newToken = xhr.getResponseHeader('X-CSRF-TOKEN');
            if (newToken) {
                $('input[name="<?= csrf_token() ?>"]').val(newToken); // Update the CSRF token field in the form
            }
        }
    });
</script>

<script>
    window.onload = function() {
        <?php if (isset($error)): ?>
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        <?php endif; ?>
        <?php if (isset($success)): ?>
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        <?php endif; ?>
    }
</script>