<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="form-section">
                <h2 class="text-center mb-4">Formulir Data SK</h2>
                <form action="/surat/store" method="post">
                    <?= csrf_field() ?>
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
                        <label for="perihal" class="col-md-3 form-label">Perihal:</label>
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