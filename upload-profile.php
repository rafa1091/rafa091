<?php
session_start();
require_once 'koneksi.php'; // Include koneksi.php untuk koneksi database

// Cek jika file di-upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $username = $_SESSION['username']; // Ambil username pengguna dari session
    $target_dir = "uploads/"; // Folder tempat menyimpan file
    $file_name = basename($_FILES["profile_picture"]["name"]);
    
    // Pastikan nama file unik dengan menambahkan timestamp untuk menghindari duplikat
    $new_file_name = time() . "_" . $file_name;
    
    // Menyusun path target
    $target_file = $target_dir . $new_file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi apakah file adalah gambar
    if (getimagesize($_FILES["profile_picture"]["tmp_name"])) {
        // Validasi ekstensi file (Hanya gambar JPEG, PNG, JPG)
        if ($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "png") {
            // Pastikan folder uploads sudah ada dan dapat menulis file
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true); // Membuat folder jika belum ada
            }

            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                // Update nama file gambar di database (pastikan sudah ada kolom 'profile_picture' di tabel pengguna)
                $query = "UPDATE user SET profile_picture = '$new_file_name' WHERE username = '$username'";
                if (mysqli_query($conn, $query)) {
                    echo "Foto profil berhasil diubah!";
                    header("Location: profile.php"); // Redirect ke halaman profil
                    exit();
                } else {
                    echo "Terjadi kesalahan saat memperbarui foto profil di database.";
                }
            } else {
                echo "Terjadi kesalahan saat meng-upload file.";
            }
        } else {
            echo "Hanya gambar dengan ekstensi JPG, JPEG, atau PNG yang diperbolehkan.";
        }
    } else {
        echo "File yang Anda upload bukan gambar.";
    }
} else {
    echo "Tidak ada file yang di-upload.";
}
?>
