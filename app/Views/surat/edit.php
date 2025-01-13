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

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-section">
                <h2 class="text-center mb-4">Formulir Edit Jadwal Reminder Humas</h2>
                <?php if (isset($surat)): ?>
                    <form onsubmit="return validateCheckboxes()" action="<?= base_url('surat/update/' . $surat['id']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="tanggal" class="col-md-3 form-label">Tanggal</label>
                            <div class="col-md-9">
                                <input id="tanggal" type="date" name="tanggal" class="form-control" value="<?= $surat['tanggal'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="alamat" class="col-md-3 form-label">Alamat/tujuan:</label>
                            <div class="col-md-9">
                                <input id="alamat" type="text" name="alamat" class="form-control"
                                    value="<?= $surat['alamat'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="ringkasan" class="col-md-3 form-label">Ringkasan isi:</label>
                            <div class="col-md-9">
                                <input id="ringkasan" type="text" name="ringkasan" class="form-control"
                                    value="<?= $surat['ringkasan'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="pert_dahulu" class="col-md-3 form-label">Pertalian dengan nomor (terdahulu):</label>
                            <div class="col-md-9">
                                <input id="pert_dahulu" type="text" name="pert_dahulu" class="form-control"
                                    value="<?= $surat['pert_dahulu'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="pert_berikut" class="col-md-3 form-label">Pertalian dengan nomor (berikut):</label>
                            <div class="col-md-9">
                                <input id="pert_berikut" type="text" name="pert_berikut" class="form-control"
                                    value="<?= $surat['pert_berikut'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="catatan" class="col-md-3 form-label">Catatan:</label>
                            <div class="col-md-9">
                                <textarea id="catatan" name="catatan" class="form-control" rows="3"
                                    required> <?= $surat['catatan'] ?></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Automatically show the modal when the page loads if an error is passed
    window.onload = function() {
        <?php if (isset($error)): ?>
            var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        <?php endif; ?>
    }
</script>