<!DOCTYPE html>
<html>

<head>
    <title>Add Schedule</title>
</head>

<body>
    <h1>Add Schedule</h1>
    <form action="/humas/store" method="post">
        <?= csrf_field() ?> <!-- Add this line -->
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