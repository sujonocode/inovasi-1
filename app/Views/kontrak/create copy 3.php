<?php if (session()->getFlashdata('success')): ?>
    <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-section">
                <h2 class="text-center mb-4">Formulir Data Kontrak</h2>
                <form action="/kontrak/store" method="post" id="contract-form">
                    <?= csrf_field() ?> <!-- CSRF Token Field -->
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label class="col-md-3 form-label">Jenis penomoran:</label>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-6 col-md-3">
                                    <div class="form-check">
                                        <input type="radio" id="urut" name="jenis_penomoran" value="urut" class="form-check-input">
                                        <label for="urut" class="form-check-label">Urut</label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-check">
                                        <input type="radio" id="sisip" name="jenis_penomoran" value="sisip" class="form-check-input">
                                        <label for="sisip" class="form-check-label">Sisip</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="jenis">Jenis:</label>
                        <select name="jenis" id="jenis">
                            <option value="">Select Jenis</option>
                            <?php foreach ($jenisOptions as $option): ?>
                                <option value="<?= $option['jenis'] ?>"><?= $option['jenis'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="kode_1">Kode 1:</label>
                        <select name="kode_1" id="kode_1">
                            <option value="">Select Kode 1</option>
                        </select>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="kode_klasifikasi">Kode Klasifikasi:</label>
                        <select name="kode_klasifikasi" id="kode_klasifikasi">
                            <option value="">Select Kode Klasifikasi</option>
                        </select>
                    </div>

                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="kode_arsip" class="col-md-3 form-label">Kode arsip:</label>
                        <div class="col-md-9">
                            <input id="kode_arsip" type="text" name="kode_arsip" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="ket" class="col-md-3 form-label">Keterangan:</label>
                        <div class="col-md-9">
                            <input id="ket" type="text" name="ket" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="tanggal" class="col-md-3 form-label">Tanggal:</label>
                        <div class="col-md-9">
                            <input id="tanggal" type="date" name="tanggal" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="perihal" class="col-md-3 form-label">Kontrak:</label>
                        <div class="col-md-9">
                            <input id="perihal" type="text" name="perihal" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="uraian" class="col-md-3 form-label">Uraian:</label>
                        <div class="col-md-9">
                            <input id="uraian" type="text" name="uraian" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="catatan" class="col-md-3 form-label">Catatan:</label>
                        <div class="col-md-9">
                            <textarea id="catatan" name="catatan" class="form-control" rows="3" placeholder="Tambahkan catatan" required></textarea>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="url" class="col-md-3 form-label">Link:</label>
                        <div class="col-md-9">
                            <input id="url" type="text" name="url" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="reset" class="btn btn-secondary"><i class="fa-solid fa-arrow-rotate-left"></i> Reset</button>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Define the CSRF token update function globally
    function updateCSRFToken(xhr) {
        const newToken = xhr.getResponseHeader('X-CSRF-TOKEN');
        if (newToken) {
            $('input[name="<?= csrf_token() ?>"]').val(newToken); // Update hidden input with the new CSRF token
        }
    }

    $(document).ready(function() {
        $('#jenis').change(function() {
            const jenis = $(this).val();
            $('#kode_1').html('<option value="">Loading...</option>');
            $('#kode_klasifikasi').html('<option value="">Select Kode Klasifikasi</option>');

            $.ajax({
                url: '<?= base_url('/kontrak/create/getKode1') ?>',
                method: 'POST',
                data: {
                    jenis: jenis,
                    '<?= csrf_token() ?>': $('input[name="<?= csrf_token() ?>"]').val()
                },
                beforeSend: function(xhr) {
                    // Add CSRF token in request headers
                    xhr.setRequestHeader('X-CSRF-TOKEN', $('input[name="<?= csrf_token() ?>"]').val());
                },
                success: function(data, status, xhr) {
                    updateCSRFToken(xhr); // Update CSRF token after successful request
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
                url: '<?= base_url('/kontrak/create/getKodeKlasifikasi') ?>',
                method: 'POST',
                data: {
                    kode_1: kode1,
                    '<?= csrf_token() ?>': $('input[name="<?= csrf_token() ?>"]').val()
                },
                beforeSend: function(xhr) {
                    // Add CSRF token in request headers
                    xhr.setRequestHeader('X-CSRF-TOKEN', $('input[name="<?= csrf_token() ?>"]').val());
                },
                success: function(data, status, xhr) {
                    updateCSRFToken(xhr); // Update CSRF token after successful request
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

        $('#kode_klasifikasi').change(function() {
            const kodeKlasifikasi = $(this).val();
            if (kodeKlasifikasi) {
                $.ajax({
                    url: '<?= base_url('/kontrak/create/getKodeArsip') ?>',
                    method: 'POST',
                    data: {
                        kode_klasifikasi: kodeKlasifikasi,
                        '<?= csrf_token() ?>': $('input[name="<?= csrf_token() ?>"]').val()
                    },
                    beforeSend: function(xhr) {
                        // Add CSRF token in request headers
                        xhr.setRequestHeader('X-CSRF-TOKEN', $('input[name="<?= csrf_token() ?>"]').val());
                    },
                    success: function(data, status, xhr) {
                        updateCSRFToken(xhr); // Update CSRF token after successful request
                        if (data) {
                            $('#kode_arsip').val(data.kode_arsip); // Populate 'kode_arsip' field
                        } else {
                            $('#kode_arsip').val(''); // If no data is found, clear the field
                        }
                    },
                    error: function() {
                        alert('An error occurred while fetching Kode Arsip.');
                    }
                });
            } else {
                $('#kode_arsip').val(''); // Clear field if no kode_klasifikasi is selected
            }
        });
    });

    $('form').submit(function() {
        // Ensure the CSRF token is up-to-date before form submission
        const csrfToken = $('input[name="<?= csrf_token() ?>"]').val();
        $('input[name="<?= csrf_token() ?>"]').val(csrfToken); // Ensure it's the latest token
    });
</script>