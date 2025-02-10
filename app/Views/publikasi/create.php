<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-section">
                <h2 class="text-center mb-4">Formulir Data Reminder BRS dan Publikasi</h2>
                <form onsubmit="return validateCheckboxes()" action="/publikasi/store" method="post">
                    <?= csrf_field() ?>

                    <!-- Nama Konten -->
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="nama" class="col-md-3 form-label">Judul:</label>
                        <div class="col-md-9">
                            <input id="nama" type="text" name="nama" class="form-control"
                                placeholder="Masukkan judul reminder" required>
                        </div>
                    </div>

                    <!-- Tanggal Unggah -->
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="tanggal" class="col-md-3 form-label">Tanggal Reminder:</label>
                        <div class="col-md-9">
                            <input id="tanggal" type="date" name="tanggal" class="form-control" required>
                        </div>
                    </div>

                    <!-- Waktu Unggah -->
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="waktu" class="col-md-3 form-label">Waktu Reminder:</label>
                        <div class="col-md-9">
                            <input id="waktu" type="time" name="waktu" class="form-control" step="1" value="08:00:00" required>
                        </div>
                    </div>

                    <!-- Kategori -->
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

                    <!-- Pengingat -->
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label class="col-md-3 form-label">Pengingat:</label>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="pengingat1" name="pengingat[]" value="Hari H"
                                            class="form-check-input">
                                        <label for="pengingat1" class="form-check-label">Hari H</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="pengingat2" name="pengingat[]" value="H-3"
                                            class="form-check-input">
                                        <label for="pengingat2" class="form-check-label">H-3</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="pengingat3" name="pengingat[]" value="H-7"
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
                            <select name="kontak[]" id="kontak" class="form-select" multiple required>
                                <?php foreach ($contacts as $contact): ?>
                                    <option value="<?= $contact['nomor'] ?>">
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
                                placeholder="Tambahkan catatan" required></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= base_url('publikasi/manage') ?>" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                        <!-- <button type="reset" class="btn btn-secondary"><i class="fa-solid fa-arrow-rotate-left"></i> Reset</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function validateCheckboxes() {
        const checkboxes = document.querySelectorAll('input[name="pengingat[]"]');
        const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        if (!isChecked) {
            alert('Silakan pilih minimal satu opsi pada "reminder"');
            return false;
        }
        return true;
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
        if ($.fn.select2) { // Check if Select2 is available
            $('#kontak').select2({
                placeholder: "Pilih kontak...",
                allowClear: true
            });
        } else {
            console.error("Select2 is not loaded.");
        }
    });
</script>