<!-- Display error pop-up if an error message is passed -->
<?php if (isset($error)): ?>
    <!-- Error Pop-up Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $error; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
                    <h5 class="modal-title" id="successModalLabel">Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= $success; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-section">
                <h2 class="text-center mb-4">Formulir Edit Data Surat</h2>
                <?php if (isset($surat)): ?>
                    <form id="editForm" onsubmit="return validateCheckboxes()" action="<?= base_url('surat_masuk/update/' . $surat['id']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="tanggal" class="col-md-3 form-label">Tanggal</label>
                            <div class="col-md-9">
                                <input id="tanggal" type="date" name="tanggal" class="form-control" value="<?= $surat['tanggal'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="nomor" class="col-md-3 form-label">Nomor</label>
                            <div class="col-md-9">
                                <input id="nomor" type="text" name="nomor" class="form-control" value="<?= $surat['nomor'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="asal" class="col-md-3 form-label">Asal:</label>
                            <div class="col-md-9">
                                <input id="asal" type="text" name="asal" class="form-control"
                                    value="<?= $surat['asal'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="perihal" class="col-md-3 form-label">Perihal:</label>
                            <div class="col-md-9">
                                <input id="perihal" type="text" name="perihal" class="form-control"
                                    value="<?= $surat['perihal'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label class="col-md-3 form-label">Kategori:</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input type="radio" id="masuk_int" name="kategori" value="Surat Masuk (Internal)"
                                                class="form-check-input">
                                            <label for="masuk_int" class="form-check-label">Internal</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input type="radio" id="masuk_eks" name="kategori" value="Surat Masuk (Eksternal)"
                                                class="form-check-input">
                                            <label for="masuk_eks" class="form-check-label">Eksternal</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="catatan" class="col-md-3 form-label">Catatan:</label>
                            <div class="col-md-9">
                                <textarea id="catatan" name="catatan" class="form-control" rows="3"
                                    required> <?= $surat['catatan'] ?></textarea>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="url" class="col-md-3 form-label">Link: <a target="_blank" href="<?= $surat['url'] ?>" title="Lihat"><i class="fa-solid fa-eye"></i></a></label>
                            <div class="col-md-9">
                                <p id="error-message" style="color: red; display: none;">Link tidak valid. Pastikan link valid atau kosongkan saja!</p>
                                <input id="url" type="text" name="url" class="form-control"
                                    value="<?= $surat['url'] ?>">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= base_url('surat_masuk/manage') ?>" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
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

    // Function to validate URL
    function isValidUrl(url) {
        try {
            const parsedUrl = new URL(url); // Check if it's a valid URL format
            return true;
        } catch (e) {
            return false;
        }
    }

    // Function to check if it's a valid Google Drive link (optional, customize as needed)
    function isGoogleDriveLink(url) {
        return url.includes("drive.google.com");
    }

    // Function to check if it's a valid BPS Drive link (optional, customize as needed)
    function isBpsDriveLink(url) {
        return url.includes("drive.bps.go.id");
    }

    function isEmpty(url) {
        return url == '';
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
    // Retrieve "Kategori" value from PHP
    const kategori = "<?= $surat['kategori'] ?>";

    // Example: Set "Kategori" radio button
    const kategoriRadio = document.querySelector(`input[name="kategori"][value="${kategori}"]`);
    if (kategoriRadio) {
        kategoriRadio.checked = true;
    }
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