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
                <h2 class="text-center mb-4">Formulir Edit Data SK</h2>
                <?php if (isset($sk)): ?>
                    <form id="editForm" onsubmit="return validateCheckboxes()" action="<?= base_url('sk/update/' . $sk['id']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="nomor" class="col-md-3 form-label">Nomor</label>
                            <div class="col-md-9">
                                <input id="tanggal" type="text" name="nomor" class="form-control" value="<?= $sk['nomor'] ?>" required disabled>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="tanggal" class="col-md-3 form-label">Tanggal</label>
                            <div class="col-md-9">
                                <input id="tanggal" type="date" name="tanggal" class="form-control" value="<?= $sk['tanggal'] ?>" required disabled>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="kode_klasifikasi" class="col-md-3 form-label">Kode Klasifikasi:</label>
                            <div class="col-md-9">
                                <select name="kode_klasifikasi" id="kode_klasifikasi" class="form-control">
                                    <option value="">Select Kode Klasifikasi</option>
                                    <?php foreach ($kodeKlasifikasiOptions as $option): ?>
                                        <option value="<?= $option['kode_klasifikasi'] ?>"><?= $option['kode_klasifikasi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="kode_arsip" class="col-md-3 form-label">Kode arsip:</label>
                            <div class="col-md-9">
                                <input id="kode_arsip" type="text" name="kode_arsip" class="form-control" required readonly
                                    style="background-color: #f0f0f0; color: #555555; border: 1px solid #ccc;"
                                    value="<?= $sk['kode_arsip'] ?>">
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="tanggal" class="col-md-3 form-label">Tanggal</label>
                            <div class="col-md-9">
                                <input id="tanggal" type="date" name="tanggal" class="form-control" value="<?= $sk['tanggal'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="perihal" class="col-md-3 form-label">Perihal:</label>
                            <div class="col-md-9">
                                <input id="perihal" type="text" name="perihal" class="form-control"
                                    value="<?= $sk['perihal'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="catatan" class="col-md-3 form-label">Catatan:</label>
                            <div class="col-md-9">
                                <textarea id="catatan" name="catatan" class="form-control" rows="3"
                                    required><?= $sk['catatan'] ?></textarea>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="url" class="col-md-3 form-label">Link: <a target="_blank" href="<?= $sk['url'] ?>" title="Lihat"><i class="fa-solid fa-eye"></i></a></label>
                            <div class="col-md-9">
                                <p id="error-message" style="color: red; display: none;">Link tidak valid. Pastikan link valid atau kosongkan saja!</p>
                                <input id="url" type="text" name="url" class="form-control"
                                    value="<?= $sk['url'] ?>">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= base_url('sk/manage') ?>" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
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
    $(document).ready(function() {
        // Update CSRF token dynamically after form submission
        function updateCSRFToken(xhr) {
            const newToken = xhr.getResponseHeader('X-CSRF-TOKEN');
            if (newToken) {
                $('input[name="<?= csrf_token() ?>"]').val(newToken); // Update the CSRF token field in the form
            }
        }

        // Change handler for 'kode_klasifikasi' dropdown
        $('#kode_klasifikasi').change(function() {
            const kodeKlasifikasi = $(this).val();
            if (kodeKlasifikasi) {
                $.ajax({
                    url: '<?= base_url('/sk/create/getKodeArsip') ?>',
                    method: 'POST',
                    data: {
                        kode_klasifikasi: kodeKlasifikasi,
                        '<?= csrf_token() ?>': $('input[name="<?= csrf_token() ?>"]').val() // Send CSRF token
                    },
                    success: function(data, status, xhr) {
                        updateCSRFToken(xhr); // Update CSRF token from response headers
                        if (data) {
                            $('#kode_arsip').val(data.kode); // Populate kode_arsip field
                        } else {
                            $('#kode_arsip').val(''); // Clear field if no data
                        }
                    },
                    error: function() {
                        alert('Error fetching Kode Arsip.');
                    }
                });
            } else {
                $('#kode_arsip').val(''); // Clear field if no kode_klasifikasi selected
            }
        });
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