<!DOCTYPE html>
<html>

<head>
    <title>Surat</title>
</head>

<body>
    <h1>Tambah Surat</h1>
    <form action="/surat/store" method="post">
        <?= csrf_field() ?>
        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" required>
        <br>
        <label for="alamat">Alamat/Tujuan:</label>
        <input type="text" name="alamat" id="alamat" required>
        <br>
        <label for="ringkasan">Ringkasan isi:</label>
        <input type="text" name="ringkasan" id="ringkasan" required>
        <br>
        <label for="pert_dahulu">Pertalian dengan nomor (terdahulu):</label>
        <input type="text" name="pert_dahulu" id="pert_dahulu" required>
        <br>
        <label for="pert_berikut">Pertalian dengan nomor (berikut):</label>
        <input type="text" name="pert_berikut" id="pert_berikut" required>
        <br>
        <label for="catatan">Catatan:</label>
        <textarea name="catatan" id="catatan" required></textarea>
        <br>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>