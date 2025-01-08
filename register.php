<?php
include 'koneksi.php'; // Pastikan file koneksi.php sudah benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $password_raw = trim($_POST['password']);
    $role = mysqli_real_escape_string($koneksi, $_POST['role']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
    $umur = (int) $_POST['umur'];
    $berat_badan = (float) $_POST['berat_badan'];
    $tinggi_badan = (float) $_POST['tinggi_badan'];
    $tahun_kelahiran = (int) $_POST['tahun_kelahiran'];

    // Validasi input tidak boleh kosong
    if (empty($username) || empty($password_raw) || empty($role) || empty($nama) || 
        empty($jenis_kelamin) || empty($umur) || empty($berat_badan) || empty($tinggi_badan) || empty($tahun_kelahiran)) {
        echo "<script>alert('Harap isi semua kolom!'); window.location='register.php';</script>";
        exit();
    }

    // Validasi panjang password minimal 6 karakter
    if (strlen($password_raw) < 6) {
        echo "<script>alert('Password minimal 6 karakter!'); window.location='register.php';</script>";
        exit();
    }

    // Validasi: Cek apakah username sudah ada
    $check_user = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($koneksi, $check_user);
    if (!$result) {
        echo "<script>alert('Terjadi kesalahan saat memeriksa username: " . mysqli_error($koneksi) . "'); window.location='register.php';</script>";
        exit();
    }

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username sudah digunakan. Silakan pilih username lain!'); window.location='register.php';</script>";
        exit();
    }

    // Hash password sebelum disimpan
    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    // Proses upload foto
    $foto_profil = ''; // Default kosong
    if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['foto_profil']['tmp_name'];
        $file_name = basename($_FILES['foto_profil']['name']);
        $target_dir = "upload/";
        $target_file = $target_dir . time() . "_" . $file_name;

        // Validasi ukuran file (misalnya maksimal 2MB)
        $max_file_size = 2 * 1024 * 1024; // 2MB
        if ($_FILES['foto_profil']['size'] > $max_file_size) {
            echo "<script>alert('Ukuran file foto terlalu besar. Maksimal 2MB.'); window.location='register.php';</script>";
            exit();
        }

        // Validasi format file foto
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_ext, $allowed_types)) {
            echo "<script>alert('Format foto tidak valid! Gunakan JPG, JPEG, PNG, atau GIF.'); window.location='register.php';</script>";
            exit();
        }

        // Cek direktori upload, buat jika belum ada
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        // Pindahkan file ke folder upload
        if (move_uploaded_file($file_tmp, $target_file)) {
            $foto_profil = $target_file; // Simpan path file di database
        } else {
            echo "<script>alert('Gagal mengunggah foto profil!'); window.location='register.php';</script>";
            exit();
        }
    }

    // Insert ke database
    $query = "INSERT INTO user (username, password, role, nama, jenis_kelamin, umur, berat_badan, tinggi_badan, tahun_kelahiran, foto_profil) 
              VALUES ('$username', '$password', '$role', '$nama', '$jenis_kelamin', '$umur', '$berat_badan', '$tinggi_badan', '$tahun_kelahiran', '$foto_profil')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Registrasi berhasil. Silakan login.'); window.location='login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Terjadi kesalahan: " . mysqli_error($koneksi) . "'); window.location='register.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-info text-white text-center">
                <h4>Form Registrasi</h4>
            </div>
            <div class="card-body">
                <form action="register.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role" required>
                            <option value="trainer">Trainer</option>
                            <option value="member">Member</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="umur">Umur</label>
                        <input type="number" class="form-control" name="umur" id="umur" required>
                    </div>
                    <div class="form-group">
                        <label for="berat_badan">Berat Badan</label>
                        <input type="number" class="form-control" name="berat_badan" id="berat_badan" required>
                    </div>
                    <div class="form-group">
                        <label for="tinggi_badan">Tinggi Badan</label>
                        <input type="number" class="form-control" name="tinggi_badan" id="tinggi_badan" required>
                    </div>
                    <div class="form-group">
                        <label for="tahun_kelahiran">Tahun Kelahiran</label>
                        <input type="number" class="form-control" name="tahun_kelahiran" id="tahun_kelahiran" required>
                    </div>
                    <div class="form-group">
                        <label for="foto_profil">Foto Profil</label>
                        <input type="file" class="form-control" name="foto_profil" id="foto_profil" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
