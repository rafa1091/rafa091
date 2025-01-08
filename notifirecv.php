<?php
session_start();
include 'koneksi.php';

// Periksa apakah user sudah login sebagai trainee
if (!isset($_SESSION['trainee_username'])) {
    header("Location: login.php");
    exit();
}

// Tandai semua notifikasi sebagai sudah dibaca
$update_query = "UPDATE notifikasi SET is_read = 1 WHERE is_read = 0";
mysqli_query($koneksi, $update_query);

// Ambil notifikasi
$query = "SELECT * FROM notifikasi ORDER BY tanggal DESC";
$result = mysqli_query($koneksi, $query);
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
        .carousel-inner img {
            transition: transform 0.5s ease, opacity 0.5s ease;
        }
        .carousel-item img {
            height: 70vh;
            object-fit: cover;
        }
        .carousel-inner img:hover {
            transform: scale(1.05);
        }

        .welcome-text {
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            margin-top: 20vh;
        }

        .carousel-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media (max-width: 768px) {
            .carousel-item img {
                height: 50vh;
            }
            .welcome-text {
                font-size: 24px;
                margin-top: 10vh;
            }
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
                        <a class="nav-link active" href="trainee_dashboard.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="latihan.php">Jadwal Latihan</a>
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
    <div class="container mt-5">
        <h1>Notifikasi</h1>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <ul class="list-group">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <li class="list-group-item">
                        <strong><?= $row['judul'] ?></strong>
                        <p><?= $row['pesan'] ?></p>
                        <small class="text-muted"><?= $row['tanggal'] ?></small>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-info">Belum ada notifikasi.</div>
        <?php endif; ?>
    </div>
</body>
</html>
