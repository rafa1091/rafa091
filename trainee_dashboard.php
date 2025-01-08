<?php
session_start();

// Periksa apakah user sudah login dan memiliki role trainee
if (!isset($_SESSION['trainee_username']) || $_SESSION['role'] != 'trainee') {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
include 'koneksi.php';

// Query untuk mengambil jumlah notifikasi yang belum dibaca
$query = "SELECT COUNT(*) AS unread_count FROM notifikasi WHERE is_read = 0";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);
$unread_count = $data['unread_count'];
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

    <!-- Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Left column for Carousel -->
            <div class="col-md-6">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://www.geckoandfly.com/wp-content/uploads/2017/07/health-quotes-02.jpg" class="d-block w-100 img-fluid" alt="Slide 1">
                        </div>
                        <div class="carousel-item">
                            <img src="https://cdn3.geckoandfly.com/wp-content/uploads/2015/09/losing-weight-diet-quotes-instagram-pinterest-facebook-07-830x467.jpg" class="d-block w-100 img-fluid" alt="Slide 2">
                        </div>
                        <div class="carousel-item">
                            <img src="https://cdn3.geckoandfly.com/wp-content/uploads/2015/09/losing-weight-diet-quotes-instagram-pinterest-facebook-15.jpg" class="d-block w-100 img-fluid" alt="Slide 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <!-- Right column for welcome text -->
            <div class="col-md-6 d-flex align-items-center">
                <div class="welcome-text">
                    <p>Selamat datang di Aplikasi Web Diet For Beginners, Trainee</p>
                    <p>Di sini Anda dapat melihat jadwal latihan, mengecek progress Anda, dan mengikuti rencana diet yang sudah disusun oleh trainer Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pop-up for unread notifications -->
    <div class="modal fade" id="notifModal" tabindex="-1" aria-labelledby="notifModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notifModalLabel">Notifikasi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Anda memiliki <?= $unread_count ?> notifikasi baru.
                </div>
                <div class="modal-footer">
                    <a href="notifirecv.php" class="btn btn-primary">Lihat Notifikasi</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Display Modal if there are unread notifications -->
    <script>
        <?php if ($unread_count > 0): ?>
            var myModal = new bootstrap.Modal(document.getElementById('notifModal'), {});
            myModal.show();
        <?php endif; ?>
    </script>
</body>
</html>
