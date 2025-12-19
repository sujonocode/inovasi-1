<?php if (session()->getFlashdata('success')): ?>
    <p style="color: green;"><?= session()->getFlashdata('success') ?></p>
<?php endif; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-section">
                <h2 class="text-center mb-4">Formulir Data Surat Keluar</h2>
                <form id="createForm" action="/surat_keluar26/store" method="post">
                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="sifat" class="col-md-3 form-label fw-semibold">
                            Sifat Surat
                        </label>
                        <div class="col-md-9">
                            <select name="sifat" id="sifat" class="form-select select2" required>
                                <option value="">-- Pilih Sifat Surat --</option>
                                <option value="B">B - Biasa</option>
                                <option value="S">S - Segera</option>
                                <option value="P">P - Penting</option>
                                <option value="R">R - Rahasia</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label class="col-md-3 form-label">Jenis penomoran:</label>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-6 col-md-3">
                                    <div class="form-check">
                                        <input type="radio" id="urut" name="jenis_penomoran"
                                            value="urut" class="form-check-input">
                                        <label for="urut" class="form-check-label">Urut</label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-check">
                                        <input type="radio" id="sisip" name="jenis_penomoran"
                                            value="sisip" class="form-check-input">
                                        <label for="sisip" class="form-check-label">Sisip</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="tanggal" class="col-md-3 form-label">Tanggal:</label>
                        <div class="col-md-9">
                            <input id="tanggal" type="date" name="tanggal" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="jenis" class="col-md-3 form-label">Arsip:</label>
                        <div class="col-md-9">
                            <select name="jenis" id="jenis" class="form-control">
                                <option value="">Pilih Jenis</option>
                                <?php foreach ($jenisOptions as $option): ?>
                                    <option value="<?= $option['jenis'] ?>"><?= $option['jenis'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="kode_1" class="col-md-3 form-label">Kode:</label>
                        <div class="col-md-9">
                            <select name="kode_1" id="kode_1" class="form-control select2">
                                <option value="">Pilih Kode</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="kode_klasifikasi" class="col-md-3 form-label">Klasifikasi:</label>
                        <div class="col-md-9">
                            <select name="kode_klasifikasi" id="kode_klasifikasi" class="form-control select2">
                                <option value="">Pilih Kode Klasifikasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="kode_arsip" class="col-md-3 form-label">Kode arsip:</label>
                        <div class="col-md-9">
                            <input id="kode_arsip" type="text" name="kode_arsip" class="form-control" required readonly
                                style="background-color: #f0f0f0; color: #555555; border: 1px solid #ccc;">
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="alamat" class="col-md-3 form-label">Alamat/tujuan:</label>
                        <div class="col-md-9">
                            <input id="alamat" type="text" name="alamat" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="ringkasan" class="col-md-3 form-label">Ringkasan isi:</label>
                        <div class="col-md-9">
                            <input id="ringkasan" type="text" name="ringkasan" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label class="col-md-3 form-label">Kategori surat:</label>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-6 col-md-3">
                                    <div class="form-check">
                                        <input type="radio" id="keluar_int" name="kategori" value="Surat Keluar (Internal)"
                                            class="form-check-input">
                                        <label for="keluar_int" class="form-check-label">Internal</label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-3">
                                    <div class="form-check">
                                        <input type="radio" id="keluar_eks" name="kategori" value="Surat Keluar (Eksternal)"
                                            class="form-check-input">
                                        <label for="keluar_eks" class="form-check-label">Eksternal</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="catatan" class="col-md-3 form-label">Catatan:</label>
                        <div class="col-md-9">
                            <textarea id="catatan" name="catatan" class="form-control" rows="3"
                                placeholder="Tambahkan catatan" required></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= base_url('surat_keluar26/manage') ?>" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#kode_klasifikasi').select2({
            theme: 'bootstrap-5',
            width: '100%', // Ensures it matches other Bootstrap inputs
            placeholder: "Pilih Kode Klasifikasi",
            allowClear: true,
            dropdownAutoWidth: false, // Prevents it from becoming too wide
            scrollAfterSelect: true
        });

        $('#kode_1').select2({
            theme: 'bootstrap-5',
            width: '100%', // Ensures it matches other Bootstrap inputs
            placeholder: "Pilih Kode",
            allowClear: true,
            dropdownAutoWidth: false, // Prevents it from becoming too wide
            scrollAfterSelect: true
        });

        // Update CSRF token dynamically after form submission
        function updateCSRFToken(xhr) {
            const newToken = xhr.getResponseHeader('X-CSRF-TOKEN');
            if (newToken) {
                $('input[name="<?= csrf_token() ?>"]').val(newToken); // Update the CSRF token field in the form
            }
        }

        // Change handler for 'jenis' dropdown
        $('#jenis').change(function() {
            const jenis = $(this).val();
            $('#kode_1').html('<option value="">Loading...</option>');
            $('#kode_klasifikasi').html('<option value="">Select Kode Klasifikasi</option>');

            $.ajax({
                url: '<?= base_url('/surat_keluar26/create/getKode1') ?>',
                method: 'POST',
                data: {
                    jenis: jenis,
                    '<?= csrf_token() ?>': $('input[name="<?= csrf_token() ?>"]').val() // Send CSRF token with request
                },
                success: function(data, status, xhr) {
                    updateCSRFToken(xhr); // Update CSRF token from response headers
                    let options = '<option value="">Select Kode 1</option>';
                    data.forEach(item => {
                        options += `<option value="${item.kode_1}">${item.kode_1}</option>`;
                    });
                    $('#kode_1').html(options);
                },
                error: function() {
                    alert('Error fetching Kode 1 options.');
                }
            });
        });

        // Change handler for 'kode_1' dropdown
        $('#kode_1').change(function() {
            const kode1 = $(this).val();
            $('#kode_klasifikasi').html('<option value="">Loading...</option>');

            $.ajax({
                url: '<?= base_url('/surat_keluar26/create/getKodeKlasifikasi') ?>',
                method: 'POST',
                data: {
                    kode_1: kode1,
                    '<?= csrf_token() ?>': $('input[name="<?= csrf_token() ?>"]').val() // Send CSRF token
                },
                success: function(data, status, xhr) {
                    updateCSRFToken(xhr); // Update CSRF token from response headers
                    let options = '<option value="">Select Kode Klasifikasi</option>';
                    data.forEach(item => {
                        options += `<option value="${item.kode_klasifikasi}">${item.kode_klasifikasi}</option>`;
                    });
                    $('#kode_klasifikasi').html(options);
                },
                error: function() {
                    alert('Error fetching Kode Klasifikasi options.');
                }
            });
        });

        // Change handler for 'kode_klasifikasi' dropdown
        $('#kode_klasifikasi').change(function() {
            const kodeKlasifikasi = $(this).val();
            if (kodeKlasifikasi) {
                $.ajax({
                    url: '<?= base_url('/surat_keluar26/create/getKodeArsip') ?>',
                    method: 'POST',
                    data: {
                        kode_klasifikasi: kodeKlasifikasi,
                        '<?= csrf_token() ?>': $('input[name="<?= csrf_token() ?>"]').val() // Send CSRF token
                    },
                    success: function(data, status, xhr) {
                        updateCSRFToken(xhr); // Update CSRF token from response headers
                        if (data) {
                            $('#kode_arsip').val(data.kode_arsip); // Populate kode_arsip field
                        } else {
                            $('#kode_arsip').val(''); // Clear field if no data
                        }
                    },
                    error: function() {
                        alert('Error fetching Kode Arsip.');
                    }
                });
            } else {
                $('#kode_arsip').val(''); // Clear field if no kode_klasifikasi selected
            }
        });
    });
</script>