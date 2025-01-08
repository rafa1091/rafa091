<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    // Validasi input tidak kosong
    if (empty($_POST['user']) || empty($_POST['pass'])) {
        $error = "Username dan password tidak boleh kosong.";
    } else {
        $username = mysqli_real_escape_string($koneksi, $_POST['user']);
        $password = $_POST['pass'];

        // Query untuk mendapatkan user berdasarkan username
        $query = "SELECT * FROM user WHERE username='$username'";
        $result = mysqli_query($koneksi, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Set sesi berdasarkan role
                if ($user['role'] === 'trainer') {
                    $_SESSION['trainer_username'] = $user['username'];
                } elseif ($user['role'] === 'trainee') {
                    $_SESSION['trainee_username'] = $user['username'];
                }

                $_SESSION['role'] = $user['role'];
                $_SESSION['id_user'] = $user['id_user'];

                // Redirect ke halaman sesuai role
                if ($user['role'] === 'trainer') {
                    header("Location: beranda.php");
                } elseif ($user['role'] === 'trainee') {
                    header("Location: trainee_dashboard.php");
                }
                exit();
            } else {
                $error = "Password salah.";
            }
        } else {
            $error = "Username tidak ditemukan.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            background: linear-gradient(to right, #eaeaea, #f4f9b6);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: black;
        }

        .login-card input {
            background: white;
            border: 1px solid #ced4da;
            color: black;
        }

        .login-card input::placeholder {
            color: #6c757d;
        }

        .login-card input:focus {
            box-shadow: none;
            background: white;
        }

        .login-card .btn-primary {
            background: #007bff;
            border: none;
        }

        .login-card .btn-primary:hover {
            background: #0056b3;
        }

        .login-card label {
            color: black;
        }
    </style>
</head>
<body>
    <!-- Login Card -->
    <div class="login-card col-10 col-md-4">
        <h3 class="text-center mb-4">Login</h3>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="user" class="form-label">Username</label>
                <input type="text" class="form-control" id="user" name="user" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password</label>
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>
        <p class="text-center mt-3">
            Belum punya akun? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal" style="color: #007bff;">Daftar</a>
        </p>
    </div>

    <!-- Modal Registrasi -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="register.php">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Registrasi Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <!-- Role -->
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="trainer">Trainer</option>
                                <option value="trainee">Trainee</option>
                            </select>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="Laki-laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>

                        <!-- Umur -->
                        <div class="mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="number" class="form-control" id="umur" name="umur" required>
                        </div>

                        <!-- Berat Badan -->
                        <div class="mb-3">
                            <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                            <input type="number" step="0.1" class="form-control" id="berat_badan" name="berat_badan" required>
                        </div>

                        <!-- Tinggi Badan -->
                        <div class="mb-3">
                            <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                            <input type="number" step="0.1" class="form-control" id="tinggi_badan" name="tinggi_badan" required>
                        </div>

                        <!-- Tahun Kelahiran -->
                        <div class="mb-3">
                            <label for="tahun_kelahiran" class="form-label">Tahun Kelahiran</label>
                            <input type="number" class="form-control" id="tahun_kelahiran" name="tahun_kelahiran" placeholder="Contoh: 1999" required>
                        </div>

                        <!-- Foto Profil -->
                        <div class="mb-3">
                            <label for="foto_profil" class="form-label">Foto Profil</label>
                            <input type="file" class="form-control" id="foto_profil" name="foto_profil" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Registrasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
