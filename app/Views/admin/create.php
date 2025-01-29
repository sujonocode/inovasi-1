<?php if (session()->getFlashdata('success')): ?>
    <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-section">
                <h2 class="text-center mb-4">Formulir Data Akun</h2>
                <form action="/admin/store" method="post">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="username" class="col-md-3 form-label">Username:</label>
                        <div class="col-md-9">
                            <input id="username" type="text" name="username" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="nama" class="col-md-3 form-label">Nama:</label>
                        <div class="col-md-9">
                            <input id="nama" type="text" name="nama" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="email" class="col-md-3 form-label">Email:</label>
                        <div class="col-md-9">
                            <input id="email" type="text" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="password" class="col-md-3 form-label">Password:</label>
                        <div class="col-md-9">
                            <input id="password" type="text" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="role" class="col-md-3 form-label">Role:</label>
                        <div class="col-md-9">
                            <select name="role" id="role" class="form-control">
                                <option value="">Pilih</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= base_url('admin_dashboard') ?>" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        <!-- <button type="reset" class="btn btn-secondary"><i class="fa-solid fa-arrow-rotate-left"></i> Reset</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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