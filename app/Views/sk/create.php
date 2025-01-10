<!DOCTYPE html>
<html>

<head>
    <title>SK</title>
</head>

<body>
    <h1>Tambah SK</h1>
    <form action="/sk/store" method="post">
        <?= csrf_field() ?> <!-- Add this line -->
        <label for="nomor">Nomor:</label>
        <input type="text" name="nomor" id="nomor" required>
        <br>
        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" id="tanggal" required>
        <br>
        <label for="perihal">Perihal:</label>
        <input type="text" name="perihal" id="perihal" required>
        <br>
        <label for="catatan">Catatan:</label>
        <textarea name="catatan" id="catatan" required></textarea>
        <br>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>