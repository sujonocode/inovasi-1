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
                <h2 class="text-center mb-4">Formulir Edit Reminder BRS dan Publikasi</h2>
                <?php if (isset($jadwalKonten)): ?>
                    <form onsubmit="return validateCheckboxes()" action="<?= base_url('publikasi/update/' . $jadwalKonten['id']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="nama" class="col-md-3 form-label">Nama:</label>
                            <div class="col-md-9">
                                <input id="nama" type="text" name="nama" class="form-control"
                                    value="<?= $jadwalKonten['nama'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="tanggal" class="col-md-3 form-label">Tanggal Reminder:</label>
                            <div class="col-md-9">
                                <input id="tanggal" type="date" name="tanggal" class="form-control" value="<?= $jadwalKonten['tanggal'] ?>" required>
                            </div>
                        </div>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="waktu" class="col-md-3 form-label">Waktu Reminder:</label>
                            <div class="col-md-9">
                                <input id="waktu" type="time" name="waktu" class="form-control" step="1" value="<?= $jadwalKonten['waktu'] ?>" required>
                            </div>
                        </div>
                        <!-- <div class="row form-group align-items-center flex-column flex-md-row">
                            <label class="col-md-3 form-label">Kategori:</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input type="radio" id="kegiatan_rutin" name="kategori"
                                                value="Kegiatan Rutin" class="form-check-input">
                                            <label for="kegiatan_rutin" class="form-check-label">Kegiatan Rutin</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input type="radio" id="dokumetasi_lapangan" name="kategori"
                                                value="Dokumentasi Lapangan" class="form-check-input">
                                            <label for="dokumetasi_lapangan" class="form-check-label">Dokumentasi Lapangan</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input type="radio" id="publikasi" name="kategori" value="Publikasi"
                                                class="form-check-input">
                                            <label for="publikasi" class="form-check-label">Publikasi</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input type="radio" id="lainnya" name="kategori" value="Lainnya"
                                                class="form-check-input">
                                            <label for="lainnya" class="form-check-label">Lainnya</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <?php $pengingatArray = explode(',', $jadwalKonten['pengingat']); ?>
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label class="col-md-3 form-label">Pengingat:</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input type="checkbox" id="pengingat1" name="pengingat[]" value="Hari H" <?= in_array('Hari H', $pengingatArray) ? 'checked' : '' ?>
                                                class="form-check-input">
                                            <label for="pengingat1" class="form-check-label">Hari H</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input type="checkbox" id="pengingat2" name="pengingat[]" value="H-3" <?= in_array('H-3', $pengingatArray) ? 'checked' : '' ?>
                                                class="form-check-input">
                                            <label for="pengingat2" class="form-check-label">H-3</label>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-check">
                                            <input type="checkbox" id="pengingat3" name="pengingat[]" value="H-7" <?= in_array('H-7', $pengingatArray) ? 'checked' : '' ?>
                                                class="form-check-input">
                                            <label for="pengingat3" class="form-check-label">H-7</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <label for="kontak" class="col-md-3 col-form-label fw-bold">Kontak:</label>
                            <div class="col-md-9">
                                <!-- <pre>< ?php print_r($jadwalKonten['kontak']); ?></pre> -->
                                <select name="kontak[]" id="kontak" class="form-select" multiple required>
                                    <?php foreach ($contacts as $contact): ?>
                                        <option value="<?= $contact['nomor'] ?>"
                                            <?php if (in_array($contact['nomor'], $jadwalKonten['kontak'])) echo 'selected'; ?>>
                                            <?= htmlspecialchars($contact['nama']) ?> (<?= $contact['nomor'] ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="catatan" class="col-md-3 form-label">Catatan:</label>
                            <div class="col-md-9">
                                <textarea id="catatan" name="catatan" class="form-control" rows="3"
                                    required> <?= $jadwalKonten['catatan'] ?></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="<?= base_url('publikasi/manage') ?>" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
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
    function validateCheckboxes() {
        const checkboxes = document.querySelectorAll('input[name="pengingat[]"]');
        const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        if (!isChecked) {
            alert('Silakan pilih minimal satu opsi pada "Pengingat".');
            return false;
        }
        return true;
    }
</script>

<script>
    // // Retrieve "Kategori" value from PHP
    // const kategori = "< ?= $jadwalKonten['kategori'] ?>";

    // // Example: Set "Kategori" radio button
    // const kategoriRadio = document.querySelector(`input[name="kategori"][value="${kategori}"]`);
    // if (kategoriRadio) {
    //     kategoriRadio.checked = true;
    // }

    // Retrieve the "Pengingat" string from PHP
    let pengingatString = '<?= json_encode($jadwalKonten['pengingat']) ?>';

    // If the string has extra quotes, remove them
    if (pengingatString.startsWith('"') && pengingatString.endsWith('"')) {
        pengingatString = pengingatString.slice(1, -1);
    }

    // Now safely parse the JSON string
    const pengingatArray = JSON.parse(pengingatString);

    // Map the "Pengingat" values to checkbox IDs
    const pengingatMapping = {
        'Hari H': 'pengingat1',
        'H-3': 'pengingat2',
        'H-7': 'pengingat3'
    };

    // Set the checkboxes based on the "Pengingat" values
    pengingatArray.forEach(value => {
        const id = pengingatMapping[value];
        const pengingatCheckbox = document.getElementById(id);
        if (pengingatCheckbox) {
            pengingatCheckbox.checked = true;
        }
    });

    // Automatically show the modal when the page loads if an error is passed
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

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (Required for Select2) -->
<!-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> -->

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('#kontak').select2();

        // If you need to set the selected values programmatically, you can do so like this:
        var selectedKontak = <?= json_encode($jadwalKonten['kontak']); ?>; // Get the selected contacts as a JavaScript array

        // Set the selected values dynamically using Select2
        $('#kontak').val(selectedKontak).trigger('change');
    });
</script>