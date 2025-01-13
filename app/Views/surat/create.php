<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-section">
                <h2 class="text-center mb-4">Formulir Data Surat</h2>
                <form action="/surat/store" method="post">
                    <?= csrf_field() ?>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="tanggal" class="col-md-3 form-label">Tanggal Unggah:</label>
                        <div class="col-md-9">
                            <input id="tanggal" type="date" name="tanggal" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="alamat" class="col-md-3 form-label">Alamat/Tujuan:</label>
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
                        <label for="pert_dahulu" class="col-md-3 form-label">Pertalian dengan nomor (terdahulu):</label>
                        <div class="col-md-9">
                            <input id="pert_dahulu" type="text" name="pert_dahulu" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="pert_berikut" class="col-md-3 form-label">Pertalian dengan nomor (berikut):</label>
                        <div class="col-md-9">
                            <input id="pert_berikut" type="text" name="pert_berikut" class="form-control" required>
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
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>