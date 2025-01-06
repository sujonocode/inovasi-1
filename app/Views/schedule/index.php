<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule List</title>
</head>

<body>
    <h1>Schedule List</h1>

    <!-- Display error or success message if any -->
    <?php if (session()->getFlashdata('error')): ?>
        <div style="color: red; font-weight: bold;">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div style="color: green; font-weight: bold;">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <a href="/schedule/create">Add New Schedule</a>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($schedules)): ?>
                <?php foreach ($schedules as $schedule): ?>
                    <tr>
                        <td><?= $schedule['id'] ?></td>
                        <td><?= $schedule['title'] ?></td>
                        <td><?= $schedule['date'] ?></td>
                        <td><?= $schedule['description'] ?></td>
                        <td>
                            <a href="/schedule/edit/<?= $schedule['id'] ?>">Edit</a> |
                            <a href="/schedule/delete/<?= $schedule['id'] ?>" onclick="return confirm('Are you sure you want to delete this schedule?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center; font-weight: bold;">No schedules available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>
<!-- 
< ?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        < ?= session()->getFlashdata('error'); ?>
    </div>
< ?php endif; ?>

Your schedule list and content here -->

<!-- Display error or success message if any
    < ?php if (session()->getFlashdata('error')): ?>
        <div style="color: red; font-weight: bold;">
            < ?= session()->getFlashdata('error'); ?>
        </div>
    < ?php endif; ?>

    < ?php if (session()->getFlashdata('success')): ?>
        <div style="color: green; font-weight: bold;">
            < ?= session()->getFlashdata('success'); ?>
        </div>
    < ?php endif; ?> -->