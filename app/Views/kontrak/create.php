<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-section">
                <h2 class="text-center mb-4">Formulir Data Kontrak</h2>
                <form action="/surat/store" method="post">
                    <?= csrf_field() ?>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="kode_arsip" class="col-md-3 form-label">Kode arsip:</label>
                        <div class="col-md-9">
                            <input id="kode_arsip" type="text" name="kode_arsip" class="form-control" required>
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
                        <label for="catatan" class="col-md-3 form-label">Catatan:</label>
                        <div class="col-md-9">
                            <textarea id="catatan" name="catatan" class="form-control" rows="3"
                                placeholder="Tambahkan catatan" required></textarea>
                        </div>
                    </div>
                    <div class="row form-group align-items-center flex-column flex-md-row">
                        <label for="url" class="col-md-3 form-label">Link:</label>
                        <div class="col-md-9">
                            <input id="url" type="text" name="url" class="form-control">
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