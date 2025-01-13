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
                <h2 class="text-center mb-4">Responsive Form</h2>
                <?php if (isset($jadwalKonten)): ?>
                    <form onsubmit="return validateCheckboxes()" action="/humas/update/<?= $jadwalKonten['id'] ?>" method="POST">
                        <?= csrf_field() ?>

                        <!-- Nama Konten -->
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="nama" class="col-md-3 form-label">Nama Konten:</label>
                            <div class="col-md-9">
                                <input id="nama" type="text" name="nama" class="form-control"
                                    value="<?= $jadwalKonten['nama'] ?>" required>
                            </div>
                        </div>

                        <!-- Tanggal Unggah -->
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="tanggal" class="col-md-3 form-label">Tanggal Unggah:</label>
                            <div class="col-md-9">
                                <input id="tanggal" type="date" name="tanggal" class="form-control" value="<?= $jadwalKonten['tanggal'] ?>" required>
                            </div>
                        </div>

                        <!-- Waktu Unggah -->
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="waktu" class="col-md-3 form-label">Waktu Unggah:</label>
                            <div class="col-md-9">
                                <input id="waktu" type="time" name="waktu" class="form-control" step="1" value="<?= $jadwalKonten['waktu'] ?>" required>
                            </div>
                        </div>

                        <!-- Kategori -->
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label class="col-md-3 form-label">Kategori:</label>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input type="radio" id="kegiatan_rutin" name="kategori"
                                                value="Kegiatan Rutin" class="form-check-input">
                                            <label for="kegiatan_rutin" class="form-check-label">Kegiatan
                                                Rutin</label>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="form-check">
                                            <input type="radio" id="dokumetasi_lapangan" name="kategori"
                                                value="Dokumentasi Lapangan" class="form-check-input">
                                            <label for="dokumetasi_lapangan" class="form-check-label">Dokumentasi</label>
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
                        </div>

                        <!-- Pengingat -->
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

                        <!-- Kontak -->
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="kontak" class="col-md-3 form-label">Kontak:</label>
                            <div class="col-md-9">
                                <input id="kontak" type="text" name="kontak" class="form-control"
                                    value="<?= $jadwalKonten['kontak'] ?>" required>
                            </div>
                        </div>

                        <!-- Catatan -->
                        <div class="row form-group align-items-center flex-column flex-md-row">
                            <label for="catatan" class="col-md-3 form-label">Catatan:</label>
                            <div class="col-md-9">
                                <textarea id="catatan" name="catatan" class="form-control" rows="3"
                                    required> <?= $jadwalKonten['catatan'] ?></textarea>
                            </div>
                        </div>

                        <!-- Buttons -->
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
</form>

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
    // Retrieve "Kategori" value from PHP
    const kategori = "<?= $jadwalKonten['kategori'] ?>";

    // Example: Set "Kategori" radio button
    const kategoriRadio = document.querySelector(`input[name="kategori"][value="${kategori}"]`);
    if (kategoriRadio) {
        kategoriRadio.checked = true;
    }

    // Retrieve the "Pengingat" string from PHP
    let pengingatString = '<?= json_encode($jadwalKonten['pengingat']) ?>';

    // If the string has extra quotes, remove them
    if (pengingatString.startsWith('"') && pengingatString.endsWith('"')) {
        pengingatString = pengingatString.slice(1, -1);
    }

    // Now safely parse the JSON string
    const pengingatArray = JSON.parse(pengingatString);

    // Log to verify the array
    console.log(pengingatArray); // ["Hari H", "H-3", "H-7"]

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
    }
</script>