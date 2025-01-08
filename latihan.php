<?php
session_start();
include('koneksi.php');  // Pastikan koneksi ke database sudah dilakukan

// Cek apakah pengguna (trainee) sudah login
if (!isset($_SESSION['trainee_username'])) {
    echo "Silakan login terlebih dahulu.";
    exit();
}

// Ambil username trainee dari session
$trainee_username = $_SESSION['trainee_username'];

// Query untuk mendapatkan data trainee
$query = "SELECT id_user, role FROM user WHERE username = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $trainee_username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$trainee = mysqli_fetch_assoc($result);

// Pastikan bahwa yang login adalah trainee
if ($trainee['role'] !== 'trainee') {
    echo "Anda tidak memiliki akses ke halaman ini.";
    exit();
}

$trainee_id = $trainee['id_user'];  // Mendapatkan ID trainee

// Fungsi untuk memperbarui status latihan
if (isset($_GET['update_status']) && isset($_GET['latihan_id'])) {
    $latihan_id = $_GET['latihan_id'];
    $new_status = $_GET['update_status'] == 'completed' ? 'completed' : 'not_completed';
    
    // Query untuk memperbarui status latihan
    $update_query = "UPDATE latihan_fisik SET status = ? WHERE id = ? AND assignee = ?";
    $stmt_update = mysqli_prepare($koneksi, $update_query);
    mysqli_stmt_bind_param($stmt_update, "sii", $new_status, $latihan_id, $trainee_id);
    mysqli_stmt_execute($stmt_update);
    
    // Redirect ke halaman yang sama setelah update status
    header("Location: latihan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainee Dashboard - Jadwal Latihan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

    <style>
        body {
            background: linear-gradient(to right, #eaeaea, #f4f9b6);
            font-family: 'Roboto', sans-serif;
        }
        .navbar {
            background-color: #d3d3d3;
        }
        .nav-link {
            color: black;
        }
        .nav-link:hover {
            background-color: gold;
            color: black !important;
        }
        .nav-link.active {
            background-color: gold;
            color: black !important;
            border-radius: 5px;
        }
        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-dumbbell"></i> DIET FOR BEGINNER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link " href="trainee_dashboard.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="latihan.php">Jadwal Latihan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="program.php">Program Makan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan_trainee.php">Laporan</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user-circle me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="notifirecv.php"><i class="fas fa-bell me-2"></i>Notifications</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>        

    <div class="container mt-4">
        <h3><i class="fas fa-dumbbell me-2"></i> Jadwal Latihan</h3>
        <hr>

        <!-- Tabel Jadwal Latihan -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Latihan</th>
                    <th scope="col">Detail Latihan</th>
                    <th scope="col">Durasi</th>
                    <th scope="col">Kalori (kcal)</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mendapatkan jadwal latihan yang sudah diberikan oleh trainer
                $query = "SELECT * FROM latihan_fisik WHERE assignee = '$trainee_id'";  // Hanya jadwal yang diberikan kepada trainee ini
                $result = mysqli_query($koneksi, $query);

                if (mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['hari']; ?></td>
                            <td><?php echo $data['latihan']; ?></td>
                            <td><?php echo $data['detail_latihan']; ?></td>
                            <td><?php echo $data['durasi']; ?></td>
                            <td><?php echo $data['kalori']; ?></td>
                            <td><img src="<?php echo $data['gambar']; ?>" alt="Gambar" style="width: 100px; height: auto;"></td>
                            <td>
                                <?php
                                // Statusnya bisa dibuat berdasarkan apakah sudah dilihat atau belum
                                if ($data['status'] == 'completed') {
                                    echo '<span class="badge bg-success">Selesai</span>';
                                } else {
                                    echo '<span class="badge bg-warning">Belum Selesai</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($data['status'] == 'not_completed') { ?>
                                    <a href="?update_status=completed&latihan_id=<?php echo $data['id']; ?>" class="btn btn-success btn-sm">Selesai</a>
                                <?php } else { ?>
                                    <a href="?update_status=not_completed&latihan_id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">Belum Selesai</a>
                                <?php } ?>
                                
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>Tidak ada jadwal latihan yang diberikan.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
