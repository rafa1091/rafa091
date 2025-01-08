<?php 
session_start();

if (!isset($_SESSION['trainee_username'])) {
    // Handle if the trainer is not logged in
    echo "Please log in.";
    exit();
}

include "koneksi.php";

$id_user = $_SESSION['id_user'];

// Ambil data user berdasarkan sesi
$query = "SELECT * FROM user WHERE id_user = ?";
$stmt = mysqli_prepare($koneksi, $query);
if ($stmt === false) {
    die('MySQL prepare error: ' . mysqli_error($koneksi));
}

mysqli_stmt_bind_param($stmt, "i", $id_user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    header("Location: profile.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .w-450 {
            width: 450px;
        }
        .vh-100 {
            min-height: 100vh;
        }
        .profile-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form class="shadow w-450 p-3" 
              action="editp.php" 
              method="post"
              enctype="multipart/form-data">

            <h4 class="display-4 fs-1">Edit Profile</h4><br>

            <!-- Error -->
            <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
            <?php } ?>
            
            <!-- Success -->
            <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
            <?php } ?>

            <!-- Full Name -->
            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" 
                       class="form-control"
                       name="nama"
                       value="<?php echo htmlspecialchars($user['nama']); ?>"
                       required>
            </div>

            <!-- Username -->
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" 
                       class="form-control"
                       name="username"
                       value="<?php echo htmlspecialchars($user['username']); ?>"
                       required>
            </div>
            <!-- Umur -->
            <div class="mb-3">
                <label class="form-label">Umur</label>
                <input type="number" 
                       class="form-control"
                       name="umur"
                       value="<?php echo htmlspecialchars($user['umur']); ?>"
                       required>
            </div>
            <!-- Berat Badan -->
            <div class="mb-3">
                <label class="form-label">Berat Badan (kg)</label>
                <input type="number" 
                       class="form-control"
                       name="berat_badan"
                       value="<?php echo htmlspecialchars($user['berat_badan']); ?>"
                       required>
            </div>
            <!-- Tinggi Badan -->
            <div class="mb-3">
                <label class="form-label">Tinggi Badan (cm)</label>
                <input type="number" 
                       class="form-control"
                       name="tinggi_badan"
                       value="<?php echo htmlspecialchars($user['tinggi_badan']); ?>"
                       required>
            </div>
            <!-- Tahun Kelahiran -->
            <div class="mb-3">
                <label class="form-label">Tahun Kelahiran</label>
                <input type="number" 
                       class="form-control"
                       name="tahun_kelahiran"
                       value="<?php echo htmlspecialchars($user['tahun_kelahiran']); ?>"
                       required>
            </div>

            <!-- Profile Picture -->
            <div class="mb-3">
                <label class="form-label">Profile Picture</label>
                <input type="file" 
                       class="form-control"
                       name="foto_profil"
                       accept=".jpg,.jpeg,.png">
                <div class="mt-2">
                    <?php if (!empty($user['foto_profil'])) { ?>
                        <img src="upload/<?php echo htmlspecialchars($user['foto_profil']); ?>" class="profile-img">
                    <?php } ?>
                </div>
                <input type="hidden" 
                       name="old_foto_profil" 
                       value="<?php echo htmlspecialchars($user['foto_profil']); ?>">
            </div>

            <!-- Submit -->
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="profile.php" class="btn btn-link">Kembali</a>
        </form>
    </div>
</body>
</html>
