<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login • ASSISTA</title>
    <link rel="shortcut icon" type="image/png" href="/assista.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at top left, #6a11cb, #2575fc);
            overflow: hidden;
        }

        /* Animated floating circles */
        .circle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.35;
            animation: float 10s infinite ease-in-out;
        }

        .circle:nth-child(1) {
            width: 300px;
            height: 300px;
            background: #ffffff;
            top: -50px;
            left: -50px;
            animation-delay: 0s;
        }

        .circle:nth-child(2) {
            width: 200px;
            height: 200px;
            background: #ffffff;
            bottom: -40px;
            right: -40px;
            animation-delay: 2s;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(25px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 35px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(18px);
            border-radius: 18px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.25);
            color: #fff;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo img {
            height: 85px;
        }

        .app-title {
            font-size: 28px;
            font-weight: 700;
            margin-top: 10px;
            background: linear-gradient(to right, #ffffff, #e0eaff);
            -webkit-text-fill-color: transparent;
            -webkit-background-clip: text;
        }

        label {
            color: #f0f0f0;
            font-weight: 500;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.25);
            border: none;
            border-radius: 10px;
            color: #fff;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.35);
            box-shadow: 0 0 5px #fff;
            color: #fff;
        }

        ::placeholder {
            color: #eaeaea;
        }

        .btn-login {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            border: none;
            border-radius: 12px;
            padding: 10px;
            font-weight: 600;
            font-size: 16px;
            transition: 0.25s;
        }

        .btn-login:hover {
            transform: scale(1.03);
            box-shadow: 0 0 12px rgba(255, 255, 255, 0.45);
        }

        .footer-text {
            font-size: 14px;
            margin-top: 18px;
            font-weight: 500;
            color: #e7e7ff;
        }
    </style>
</head>

<body>

    <!-- Floating circles -->
    <div class="circle"></div>
    <div class="circle"></div>

    <div class="login-card">
        <div class="text-center">
            <div class="logo">
                <img src="<?= base_url('/assets/image/assista.png') ?>" alt="ASSISTA Logo">
            </div>
            <div class="app-title">ASSISTA</div>
            <div class="footer-text">Tim TI BPS Kabupaten Tanggamus</div>
        </div>

        <hr style="border-color: rgba(255,255,255,0.3);">

        <form method="POST" action="<?= base_url('/login') ?>">
            <?= csrf_field() ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger py-2">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Masukkan username..." required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Masukkan password..." required>
            </div>

            <button type="submit" class="btn btn-login w-100">Masuk</button>
        </form>
    </div>

</body>

</html>