<?php
session_start();

include 'koneksi.php';


// Validasi apakah sesi id_user tersedia
if (!isset($_SESSION['trainer_username']) || $_SESSION['role'] != 'trainer') {
    header("Location: login.php");
    exit();
}

// Ambil id_user dari sesi
$id_user = $_SESSION['id_user'];

// Ambil data pengguna dari database dengan prepared statement
$query = "SELECT * FROM user WHERE id_user = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id_user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    // Validasi apakah pengguna adalah trainer
    if ($user['role'] !== 'trainer') {
        echo "<script>alert('Anda tidak memiliki akses ke halaman ini.'); window.location='login.php';</script>";
        exit();
    }
} else {
    echo "Data tidak ditemukan atau query gagal dijalankan: " . mysqli_error($koneksi);
    exit();
}

// Menentukan path foto profil, jika tidak ada, gunakan gambar default
$foto_profil = !empty($user['foto_profil']) ? "upload/" . $user['foto_profil'] : "upload/default-profile.jpg";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Trainer</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-info text-white text-center">
            <h4>Profil Trainer</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <!-- Foto Profil -->
                    <img src="<?php echo htmlspecialchars($foto_profil); ?>" class="img-thumbnail" width="200" alt="Foto Profil">
                </div>

                <div class="col-md-8">
                    <!-- Data Diri -->
                    <table class="table table-bordered">
                        <tr>
                            <th>ID User</th>
                            <td><?php echo htmlspecialchars($user['id_user']); ?></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td><?php echo htmlspecialchars($user['nama']); ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?php echo htmlspecialchars($user['jenis_kelamin']); ?></td>
                        </tr>
                        <tr>
                            <th>Umur</th>
                            <td><?php echo !empty($user['umur']) ? htmlspecialchars($user['umur']) . " tahun" : "Data tidak tersedia"; ?></td>
                        </tr>
                        <tr>
                            <th>Berat Badan</th>
                            <td><?php echo !empty($user['berat_badan']) ? htmlspecialchars($user['berat_badan']) . " kg" : "Data tidak tersedia"; ?></td>
                        </tr>
                        <tr>
                            <th>Tinggi Badan</th>
                            <td><?php echo !empty($user['tinggi_badan']) ? htmlspecialchars($user['tinggi_badan']) . " cm" : "Data tidak tersedia"; ?></td>
                        </tr>
                        <tr>
                            <th>Tahun Kelahiran</th>
                            <td><?php echo !empty($user['tahun_kelahiran']) ? htmlspecialchars($user['tahun_kelahiran']) : "Data tidak tersedia"; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- Tombol Edit -->
            <div class="text-center mt-3">
                <a href="edit_profil.php" class="btn btn-primary">Edit Profil</a>
                <!-- Tombol Kembali ke Beranda -->
                <a href="beranda.php" class="btn btn-secondary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
