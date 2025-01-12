<h1>Edit</h1>
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

<!-- Check if schedule data exists and render the edit form -->
<?php if (isset($jadwalKonten)): ?>
    <form action="/humas/update/<?= $jadwalKonten['id'] ?>" method="POST">
        <?= csrf_field() ?>
        <!-- Your form fields go here -->
        <label for="nama">Nama konten:</label>
        <input id="nama" type="text" name="nama" value="<?= $jadwalKonten['nama'] ?>" required>
        <br>
        <label for="tanggal">Tanggal unggah:</label>
        <input id="tanggal" type="date" name="tanggal" value="<?= $jadwalKonten['tanggal'] ?>" required>
        <br>
        <label for="waktu">Waktu unggah:</label>
        <input id="waktu" type="time" name="waktu" step="1" value="<?= $jadwalKonten['waktu'] ?>" required><br>
        <br>
        <p>Kategori:</p>
        <input type="radio" id="kegiatan_rutin" name="kategori" value="Kegiatan Rutin">
        <label for="kegiatan_rutin">Kegiatan Rutin</label>
        <input type="radio" id="dokumetasi_lapangan" name="kategori" value="Dokumentasi Lapangan">
        <label for="dokumetasi_lapangan">Dokumentasi Lapangan</label><br>
        <input type="radio" id="publikasi" name="kategori" value="Publikasi">
        <label for="publikasi">Publikasi</label><br>
        <input type="radio" id="lainnya" name="kategori" value="Lainnya">
        <label for="lainnya">Lainnya</label>
        <br>
        <label for="kontak">Kontak:</label>
        <input id="kontak" type="text" name="kontak" value="<?= $jadwalKonten['kontak'] ?>" required>
        <br>
        <?php $pengingatArray = explode(',', $jadwalKonten['pengingat']); ?>
        <p>Pengingat:</p>
        <input type="checkbox" id="pengingat1" name="pengingat[]" value="Hari H" <?= in_array('Hari H', $pengingatArray) ? 'checked' : '' ?>>
        <label for="pengingat1">Hari H</label><br>
        <input type="checkbox" id="pengingat2" name="pengingat[]" value="H-3" <?= in_array('H-3', $pengingatArray) ? 'checked' : '' ?>>
        <label for="pengingat2">H-3</label><br>
        <input type="checkbox" id="pengingat3" name="pengingat[]" value="H-7" <?= in_array('H-7', $pengingatArray) ? 'checked' : '' ?>>
        <label for="pengingat3">H-7</label><br>
        <label for="catatan">Catatan:</label>
        <textarea id="catatan" name="catatan" required><?= $jadwalKonten['catatan'] ?></textarea>
        <br>
        <button type="submit">Simpan</button>
        <!-- <button type="reset">Reset</button> -->
    </form>

<?php endif; ?>

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