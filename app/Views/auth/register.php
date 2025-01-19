<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: url('https://ppid.bps.go.id/upload/img/bps-baru_1643968985122.jpg') no-repeat center center fixed;
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
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
            <h2 class="text-center mb-4">Register</h2>
            <form method="POST" action="/register">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <!-- <div class="mb-3">
                    <label for="role" class="form-label">Role (Optional, Admins only)</label>
                    <select class="form-select" id="role" name="role">
                        <option value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div> -->
                <div class="mb-3">
                    <label for="role">Role</label>
                    <select name="role" id="role" required>
                        <option value="user">User</option>
                        <?php if (session()->get('role') == 'admin'): ?>
                            <option value="admin">Admin</option>
                        <?php endif; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <div class="text-center mt-3">
                <p>Already have an account? <a href="/login">Login here</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        if (<?= session('role') ?> == )
    </script>
</body>

</html>