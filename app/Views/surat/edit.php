<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit surat</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1>Edit Surat</h1>

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

    <!-- Check if surat data exists and render the edit form -->
    <?php if (isset($surat)): ?>
        <form action="/surat/update/<?= $surat['id'] ?>" method="POST">
            <?= csrf_field() ?> <!-- This will automatically generate the hidden CSRF token field -->
            <!-- Your form fields go here -->
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" id="tanggal" value="<?= $surat['tanggal'] ?>" required><br>
            <label for="alamat">Alamat/tujuan:</label>
            <input type="text" name="alamat" id="alamat" value="<?= $surat['alamat'] ?>" required><br>
            <label for="ringkasan">Ringkasan isi:</label>
            <input type="text" name="ringkasan" id="ringkasan" value="<?= $surat['ringkasan'] ?>" required><br>
            <label for="pert_dahulu">Pertalian dengan nomor (terdahulu):</label>
            <input type="text" name="pert_dahulu" id="pert_dahulu" value="<?= $surat['pert_dahulu'] ?>" required><br>
            <label for="pert_berikut">Pertalian dengan nomor (berikut):</label>
            <input type="text" name="pert_berikut" id="pert_berikut" value="<?= $surat['pert_berikut'] ?>" required><br>
            <label for="catatan">Catatan:</label>
            <textarea name="catatan" id="catatan" required><?= $surat['catatan'] ?></textarea><br>

            <button type="submit">Update Surat</button>
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