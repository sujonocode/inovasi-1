<!DOCTYPE html>
<html>

<head>
    <title>Edit Schedule</title>
</head>

<body>
    <h1>Edit Schedule</h1>
    <form action="/schedule/update/<?= $schedule['id'] ?>" method="post">
        <?= csrf_field() ?> <!-- CSRF token added here -->
        <label>Title:</label>
        <input type="text" name="title" value="<?= $schedule['title'] ?>" required>
        <br>
        <label>Date:</label>
        <input type="date" name="date" value="<?= $schedule['date'] ?>" required>
        <br>
        <label>Description:</label>
        <textarea name="description"><?= $schedule['description'] ?></textarea>
        <br>
        <button type="submit">Update</button>
    </form>
</body>

</html>