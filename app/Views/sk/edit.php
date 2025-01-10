<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit sk</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1>Edit SK</h1>

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

    <!-- Check if sk data exists and render the edit form -->
    <?php if (isset($sk)): ?>
        <form action="/sk/update/<?= $sk['id'] ?>" method="POST">
            <?= csrf_field() ?> <!-- This will automatically generate the hidden CSRF token field -->
            <!-- Your form fields go here -->
            <label for="nomor">Nomor:</label>
            <input type="text" name="nomor" id="nomor" value="<?= $sk['nomor'] ?>" required><br>
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" value="<?= $sk['tanggal'] ?>" required><br>
            <label for="perihal">Perihal:</label>
            <input type="text" name="perihal" id="perihal" value="<?= $sk['perihal'] ?>" required><br>
            <label for="catatan">Catatan:</label>
            <textarea name="catatan" id="catatan" required><?= $sk['catatan'] ?></textarea><br>

            <button type="submit">Update SK</button>
        </form>

    <?php endif; ?>

    <script>
        // Automatically show the modal when the page loads if an error is passed
        window.onload = function() {
            <?php if (isset($error)): ?>
                var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            <?php endif; ?>
        }
    </script>
</body>

</html>