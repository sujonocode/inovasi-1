<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <h1>Dynamic Form</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <form action="<?= base_url('/form/submitForm') ?>" method="post">
        <?= csrf_field() ?>

        <label for="jenis">Jenis:</label>
        <select name="jenis" id="jenis">
            <option value="">Select Jenis</option>
            <?php foreach ($jenisOptions as $option): ?>
                <option value="<?= $option['jenis'] ?>"><?= $option['jenis'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="kode_1">Kode 1:</label>
        <select name="kode_1" id="kode_1">
            <option value="">Select Kode 1</option>
        </select>

        <label for="kode_klasifikasi">Kode Klasifikasi:</label>
        <select name="kode_klasifikasi" id="kode_klasifikasi">
            <option value="">Select Kode Klasifikasi</option>
        </select>

        <button type="submit">Submit</button>
    </form>

    <script>
        $(document).ready(function() {
            function updateCSRFToken(xhr) {
                const newToken = xhr.getResponseHeader('X-CSRF-TOKEN');
                if (newToken) {
                    $('input[name="<?= csrf_token() ?>"]').val(newToken); // Update hidden input token
                }
            }

            $('#jenis').change(function() {
                const jenis = $(this).val();
                $('#kode_1').html('<option value="">Loading...</option>');
                $('#kode_klasifikasi').html('<option value="">Select Kode Klasifikasi</option>');

                $.ajax({
                    url: '<?= base_url('/form/getKode1') ?>',
                    method: 'POST',
                    data: {
                        jenis: jenis,
                        '<?= csrf_token() ?>': $('input[name="<?= csrf_token() ?>"]').val()
                    },
                    success: function(data, status, xhr) {
                        updateCSRFToken(xhr); // Update CSRF token
                        console.log('CSRF Token Updated:', $('input[name="<?= csrf_token() ?>"]').val()); // Debug CSRF token
                        let options = '<option value="">Select Kode 1</option>';
                        data.forEach(item => {
                            options += `<option value="${item.kode_1}">${item.kode_1}</option>`;
                        });
                        $('#kode_1').html(options);
                    },
                    error: function() {
                        alert('An error occurred while fetching data.');
                    }
                });
            });

            $('#kode_1').change(function() {
                const kode1 = $(this).val();
                $('#kode_klasifikasi').html('<option value="">Loading...</option>');

                $.ajax({
                    url: '<?= base_url('/form/getKodeKlasifikasi') ?>',
                    method: 'POST',
                    data: {
                        kode_1: kode1,
                        '<?= csrf_token() ?>': $('input[name="<?= csrf_token() ?>"]').val()
                    },
                    success: function(data, status, xhr) {
                        updateCSRFToken(xhr); // Update CSRF token
                        console.log('CSRF Token Updated:', $('input[name="<?= csrf_token() ?>"]').val()); // Debug CSRF token
                        let options = '<option value="">Select Kode Klasifikasi</option>';
                        data.forEach(item => {
                            options += `<option value="${item.kode_klasifikasi}">${item.kode_klasifikasi}</option>`;
                        });
                        $('#kode_klasifikasi').html(options);
                    },
                    error: function() {
                        alert('An error occurred while fetching data.');
                    }
                });
            });
        });
    </script>
</body>

</html>