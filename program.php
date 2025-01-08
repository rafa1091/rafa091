<?php
session_start();
include 'koneksi.php';

// Check if the user is logged in and has the "trainee" role
if (!isset($_SESSION['trainee_username']) || $_SESSION['role'] != 'trainee') {
    header("Location: login.php");
    exit();
}
$query = "SELECT id_user, role FROM user WHERE username = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $trainee_username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$trainee = mysqli_fetch_assoc($result);


// Mendapatkan ID trainee dari session
$trainee_id = $_SESSION['id_user'];

// Fungsi untuk memperbarui status latihan
if (isset($_GET['update_status']) && isset($_GET['jenisMakan_id'])) {
    $jenisMakan_id = $_GET['jenisMakan_id'];
    $new_status = $_GET['update_status'] == 'completed' ? 'completed' : 'not_completed';

    // Query untuk memperbarui status makanan
    $update_query = "UPDATE resep_makan SET status = ? WHERE id = ? AND assignee = ?";
    $stmt_update = mysqli_prepare($koneksi, $update_query);
    mysqli_stmt_bind_param($stmt_update, "sii", $new_status, $jenisMakan_id, $trainee_id);

    if (mysqli_stmt_execute($stmt_update)) {
        // Redirect ke halaman yang sama setelah update status
        header("Location: program.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainee Dashboard</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                        <a class="nav-link" href="trainee_dashboard.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="latihan.php">Jadwal Latihan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="program.php">Program Makan</a>
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

    <!-- Tabel Data -->
    <div class="container mt-4">
        <h3><i class="fas fa-utensils me-2"></i> Program Makan</h3>
        <hr>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Makanan</th>
                    <th scope="col">Waktu Makan</th>
                    <th scope="col">Kalori (kcal)</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query data resep makan
                $query = mysqli_query($koneksi, "SELECT * FROM resep_makan WHERE assignee = '$trainee_id'");
                $no = 1;
                while ($data = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['Hari']; ?></td>
                    <td><?php echo $data['jenisMakan']; ?></td>
                    <td><?php echo $data['waktumakan']; ?></td>
                    <td><?php echo $data['kalori']; ?></td>
                    <td><img src="<?php echo $data['gambar']; ?>" alt="Gambar" style="width: 100px; height: auto;"></td>
                    <td>
                        <?php
                        if ($data['status'] == 'completed') {
                            echo '<span class="badge bg-success">Selesai</span>';
                        } else {
                            echo '<span class="badge bg-warning">Belum Selesai</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php if ($data['status'] == 'not_completed') { ?>
                            <a href="?update_status=completed&jenisMakan_id=<?php echo $data['id']; ?>" class="btn btn-success btn-sm">Selesai</a>
                        <?php } else { ?>
                            <a href="?update_status=not_completed&jenisMakan_id=<?php echo $data['id']; ?>" class="btn btn-warning btn-sm">Belum Selesai</a>
                        <?php } ?>
                    </td>
                </tr>
                <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
