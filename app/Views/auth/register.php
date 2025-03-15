<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="shortcut icon" type="image/png" href="/assista.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            /* background: url(< ?= base_url('/assets/image/bps_pixelcut.jpeg') ?>) no-repeat center center fixed; */
            background-size: cover;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            /* Semi-transparent background */
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        a {
            color: #0d6efd;
            text-decoration: none;
            /* Ensures all links are not underlined */
        }

        a:hover {
            text-decoration: underline;
        }

        a.btn {
            text-decoration: none;
            /* Ensures the button link is not underlined */
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
            <!-- Conditional title -->
            <h2 class="text-center mb-4">
                <?= session()->get('isLoggedIn') ? 'Daftarkan Pengguna Baru' : 'Daftar' ?>
            </h2>
            <form method="POST" action="<?= base_url('/register') ?>">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="row form-group align-items-center flex-column flex-md-row">
                    <label for="nama" class="col-md-3 form-label">Nama:</label>
                    <div class="col-md-9">
                        <input id="nama" type="text" name="nama" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="role">Role</label>
                    <select name="role" id="role" required>
                        <option value="user">User</option>
                        <?php if (session()->get('role') == 'admin'): ?>
                            <option value="admin">Admin</option>
                        <?php endif; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Daftar</button>
            </form>
            <?php if (!session()->get('isLoggedIn')): ?>
                <div class="text-center mt-3">
                    <p>Sudah mempunyai akun? <a href="<?= base_url('/login') ?>">Masuk Sekarang</a></p>
                </div>
            <?php endif; ?>
            <?php if (session()->get('isLoggedIn')): ?>
                <div class="text-center mt-4">
                    <button class="btn btn-secondary w-100" onclick="window.location.href='<?= base_url('/') ?>'">Beranda</button>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>