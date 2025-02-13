<section class="features py-5">
    <div class="container">
        <h2 class="section-title text-center mb-4"><?= $title ?></h2>
        <div class="card mb-4">
            <div class="card-header">Profil</div>
            <div class="card-body">
                <?php if (session()->getFlashdata('successProfile')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('successProfile') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('errorsProfile')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->getFlashdata('errorsProfile') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('profile/update') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profil</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">Password</div>
            <div class="card-body">
                <?php if (session()->getFlashdata('successPassword')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('successPassword') ?></div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('errorsPassword')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->getFlashdata('errorsPassword') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form action="<?= base_url('profile/change-password') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Sekarang</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <button type="submit" class="btn btn-danger">Ubah Password</button>
                </form>
            </div>
        </div>
    </div>
</section>