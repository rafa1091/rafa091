<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['trainer_username'])) {
    echo "Silakan login terlebih dahulu.";
    exit();
}

$id_user = $_SESSION['id_user'];

// Ambil data lama user
$query = "SELECT foto_profil FROM user WHERE id_user = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id_user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// Tangani foto profil baru
$foto_profil = $user['foto_profil']; // Ambil foto lama jika tidak ada foto baru

if (isset($_FILES['foto_profil']) && $_FILES['foto_profil']['error'] == UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['foto_profil']['tmp_name'];
    $file_name = basename($_FILES['foto_profil']['name']);
    $target_dir = "upload/";
    $target_file = $target_dir . time() . "_" . $file_name;

    // Validasi format file
    $allowed_types = ['jpg', 'jpeg', 'png'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (in_array($file_ext, $allowed_types)) {
        if (move_uploaded_file($file_tmp, $target_file)) {
            // Update foto_profil di database
            $foto_profil = basename($target_file); // Ambil nama file
        } else {
            echo "Gagal mengunggah foto profil.";
        }
    } else {
        echo "Format foto tidak valid.";
    }
}

// Update data user
$query = "UPDATE user SET foto_profil = ?, nama = ?, username = ?, umur = ?, berat_badan = ?, tinggi_badan = ?, tahun_kelahiran = ? WHERE id_user = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "sssiidii", $foto_profil, $_POST['nama'], $_POST['username'], $_POST['umur'], $_POST['berat_badan'], $_POST['tinggi_badan'], $_POST['tahun_kelahiran'], $id_user);

if (mysqli_stmt_execute($stmt)) {
    header('Location: profiletrainer.php?success=Profil berhasil diperbarui');
} else {
    header('Location: edit_profile.php?error=Terjadi kesalahan saat mengupdate profil');
}
?>
