<?php
session_start();

// Pastikan user sudah login sebagai trainer
if (!isset($_SESSION['trainer_username'])) {
    header("Location: login.php");
    exit();
}

include 'koneksi.php'; // Pastikan file koneksi.php sudah benar

// Query untuk mengambil data trainee
$query = "SELECT id_user, username, nama, jenis_kelamin, umur, berat_badan, tinggi_badan, tahun_kelahiran FROM user WHERE role = 'trainee'";
$result = mysqli_query($koneksi, $query);
if (!$result) {
    echo "<script>alert('Gagal mengambil data trainee: " . mysqli_error($koneksi) . "'); window.location='beranda.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Trainee</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #eaeaea, #f4f9b6);
            font-family: 'Roboto', sans-serif; /* Menggunakan font Roboto untuk body */
        }
        .table-container {
            margin-top: 30px;
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
            border-radius: 5px; /* Opsional, untuk memberikan sudut melengkung */
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
            font-family: 'Poppins', sans-serif; /* Menggunakan font Poppins untuk teks sambutan */
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-dumbbell"></i> DIET FOR BEGINNER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="latihanfisik.php">Latihan Fisik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resepmakan.php">Resep Makan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan.php">Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="trainee.php">Trainee</a> 
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profiletrainer.php"><i class="fas fa-user-circle me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="notifin.php"><i class="fas fa-bell me-2"></i>Notifications</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Daftar Trainee -->
    <div class="container table-container">
        <h3>Daftar Trainee</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Jenis Kelamin</th>
                    <th>Umur</th>
                    <th>Berat Badan (kg)</th>
                    <th>Tinggi Badan (cm)</th>
                    <th>Tahun Kelahiran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data trainee
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id_user']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['jenis_kelamin']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['umur']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['berat_badan']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tinggi_badan']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tahun_kelahiran']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
