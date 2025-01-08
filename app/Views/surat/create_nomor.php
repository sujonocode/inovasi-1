<!DOCTYPE html>
<html>

<head>
    <title>Add Surat</title>
</head>

<body>
    <h1>Add Surat</h1>
    <form action="/surat/store_nomor" method="post">
        <?= csrf_field() ?> <!-- Add this line -->
        <label>Nomor:</label>
        <input type="text" name="nomor" required>
        <br>
        <label>Title:</label>
        <input type="text" name="title" required>
        <br>
        <label>Date:</label>
        <input type="date" name="date" required>
        <br>
        <label>Description:</label>
        <textarea name="description"></textarea>
        <br>
        <button type="submit">Save</button>
    </form>
</body>

</html>