<h1>Tambah</h1>
<form onsubmit="return validateCheckboxes()" action="/humas/store" method="post">
    <?= csrf_field() ?>
    <label for="nama">Nama konten:</label>
    <input id="nama" type="text" name="nama" required>
    <br>
    <label for="tanggal">Tanggal unggah:</label>
    <input id="tanggal" type="date" name="tanggal" required>
    <br>
    <label for="waktu">Waktu unggah:</label>
    <input id="waktu" type="time" name="waktu" step="1" required><br>
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
    <input id="kontak" type="text" name="kontak" required>
    <br>
    <p>Pengingat:</p>
    <input type="checkbox" id="pengingat1" name="pengingat[]" value="Hari H">
    <label for="pengingat1">Hari H</label><br>
    <input type="checkbox" id="pengingat2" name="pengingat[]" value="H-3">
    <label for="pengingat2">H-3</label><br>
    <input type="checkbox" id="pengingat3" name="pengingat[]" value="H-7">
    <label for="pengingat3">H-7</label><br>
    <label for="catatan">Catatan:</label>
    <textarea id="catatan" name="catatan" required></textarea>
    <br>
    <button type="submit">Simpan</button>
    <!-- <button type="reset">Reset</button> -->
</form>

<script>
    function validateCheckboxes() {
        const checkboxes = document.querySelectorAll('input[name="pengingat[]"]');
        const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
        if (!isChecked) {
            alert('Please select at least one "Pengingat".');
            return false;
        }
        return true;
    }
</script>