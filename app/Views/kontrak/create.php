<!DOCTYPE html>
<html>

<head>
    <title>Kontrak</title>
</head>

<body>
    <h1>Tambah Kontrak</h1>
    <form action="/kontrak/store" method="post">
        <?= csrf_field() ?>
        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" required>
        <br>
        <label for="nomor">Nomor:</label>
        <input type="text" name="nomor" id="nomor" required>
        <br>
        <label for="uraian">Uraian kontrak:</label>
        <textarea name="uraian" id="uraian" required></textarea>
        <br>
        <label for="catatan">Catatan:</label>
        <textarea name="catatan" id="catatan" required></textarea>
        <br>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>