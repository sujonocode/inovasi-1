<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ASSISTA - BPS Kabupaten Tanggamus</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Fullscreen background */
        body {
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, #0d47a1, #002f6c);
            position: relative;
        }

        /* Floating circles background */
        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.07);
            animation: float 12s infinite ease-in-out;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) translateX(0px);
            }

            50% {
                transform: translateY(-40px) translateX(20px);
            }

            100% {
                transform: translateY(0px) translateX(0px);
            }
        }

        /* Login card */
        .login-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1.3s ease;
            position: relative;
            z-index: 2;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Input styling */
        .form-control {
            border-radius: 10px;
        }

        .btn-login {
            border-radius: 20px;
            font-weight: 600;
        }

        .header-text {
            color: white;
            text-align: center;
            margin-bottom: 25px;
        }

        .header-text h3,
        .header-text h5 {
            margin: 0;
        }
    </style>
</head>

<body>

    <!-- Floating circles background -->
    <div class="circle" style="width: 120px; height: 120px; top: 10%; left: 5%; animation-duration: 15s;"></div>
    <div class="circle" style="width: 180px; height: 180px; top: 50%; left: 80%; animation-duration: 13s;"></div>
    <div class="circle" style="width: 90px; height: 90px; top: 70%; left: 20%; animation-duration: 17s;"></div>
    <div class="circle" style="width: 140px; height: 140px; top: 30%; left: 60%; animation-duration: 19s;"></div>

    <div class="container h-100 d-flex justify-content-center align-items-center">

        <div class="w-100" style="max-width: 430px;">

            <!-- Header Logo BPS -->
            <div class="header-text mb-4">
                <img src="<?= base_url('assets/image/bps.png') ?>" width="55" class="mb-2">
                <h5>Badan Pusat Statistik</h5>
                <h5>Kabupaten Tanggamus</h5>
            </div>

            <!-- Login Card -->
            <div class="login-card">

                <!-- ASSISTA logo inside card -->
                <div class="text-center mb-3">
                    <img src="<?= base_url('assets/image/assista.png') ?>" width="55" class="mb-1">
                    <h6 class="text-white-50 fw-semibold">ASSISTA</h6>
                </div>

                <h4 class="text-center text-white mb-4">LOGIN</h4>

                <form action="<?= base_url('/auth/login') ?>" method="POST">

                    <div class="mb-3">
                        <label class="form-label text-white fw-semibold">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-white fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 btn-login">Log In</button>

                </form>
            </div>

        </div>

    </div>

    <!-- BOOTSTRAP JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>