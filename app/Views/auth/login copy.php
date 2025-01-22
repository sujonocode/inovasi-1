<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: url(<?= base_url('/assets/image/d.jpg') ?>) no-repeat center center fixed;
            background-size: cover;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            max-height: 80px;
            margin-right: 10px;
        }

        .logo h1 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            -webkit-text-fill-color: transparent;
        }

        .vertical-divider {
            width: 1px;
            background-color: #ccc;
            height: 50px;
            margin: 0 15px;
        }

        /* .made-by {
            font-size: 14px;
            color: #666;
            flex: 1;
            white-space: normal;
            word-wrap: break-word;
            text-align: left;
        } */

        .made-by {
            font-size: 14px;
            /* Increased font size */
            font-weight: bold;
            /* Make text bold */
            color: #666;
            /* Darker color for stronger contrast */
            /* text-transform: uppercase; */
            /* Transform text to uppercase for emphasis */
            letter-spacing: 1px;
            /* Add space between letters for a stronger appearance */
            flex: 1;
            white-space: normal;
            word-wrap: break-word;
            text-align: left;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            -webkit-text-fill-color: transparent;
        }

        @media (max-width: 576px) {
            .header {
                flex-direction: column;
                text-align: center;
            }

            .vertical-divider {
                height: 1px;
                width: 80%;
                margin: 10px 0;
            }

            .made-by {
                text-align: center;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">

            <!-- Header with Logo, Vertical Line, and Made By Text -->
            <div class="header">
                <div class="logo">
                    <img src="<?= base_url('/assets/image/logo_assista.png') ?>" alt="ASSISTA Logo">
                    <h1>ASSISTA</h1>
                </div>
                <div class="vertical-divider"></div>
                <div class="made-by">Tim TI BPS Kabupaten Tanggamus</div>
            </div>

            <h2 class="text-center mb-4">Login</h2>
            <form method="POST" action="<?= base_url('/login') ?>">
                <?= csrf_field() ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger mt-3">
                        <!-- < ?= session()->getFlashdata('error') ?> -->
                        Anda harus login sebagai admin terlebih dahulu.
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>

            <div class="text-center mt-3">
                <p>Buat akun baru? <a href="<?= base_url('/register') ?>">Daftar</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>