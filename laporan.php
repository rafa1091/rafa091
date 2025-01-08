<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafik Kalori Berdasarkan Hari</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Tambahkan di akhir body -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<style>
        body {
            background: linear-gradient(to right, #eaeaea, #f4f9b6);
            font-family: 'Roboto', sans-serif; /* Menggunakan font Roboto untuk body */
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
                        <a class="nav-link" href="beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="latihanfisik.php">Latihan Fisik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="resepmakan.php">Resep Makan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="laporan.php">Laporan</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="trainee.php">Trainee</a></li>
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
    <div class="container">
        <h2 class="text-center mt-4">Grafik Kalori Latihan Fisik Dan Program Makan</h2>
        <div class="chart-container">
            <!-- Grafik Latihan Fisik -->
            <div class="chart-box">
                <canvas id="kaloriLatihanChart" width="400" height="200"></canvas>
            </div>
            <!-- Grafik Resep Makan -->
            <div class="chart-box">
                <canvas id="kaloriMakanChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <?php
    // Koneksi ke database
    $host = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "pbl"; 

    $koneksi = new mysqli($host, $username, $password, $dbname);

    // Cek koneksi
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // Query untuk data latihan_fisik
    $queryLatihan = "SELECT hari, SUM(kalori) AS total_kalori FROM latihan_fisik GROUP BY hari";
    $resultLatihan = $koneksi->query($queryLatihan);

    $hariLatihan = [];
    $kaloriLatihan = [];

    if ($resultLatihan->num_rows > 0) {
        while ($row = $resultLatihan->fetch_assoc()) {
            $hariLatihan[] = $row['hari'];
            $kaloriLatihan[] = $row['total_kalori'];
        }
    }

    // Query untuk data resep_makan
    $queryMakan = "SELECT waktumakan, SUM(kalori) AS total_kalori FROM resep_makan GROUP BY waktumakan";
    $resultMakan = $koneksi->query($queryMakan);

    $waktuMakan = [];
    $kaloriMakan = [];

    if ($resultMakan->num_rows > 0) {
        while ($row = $resultMakan->fetch_assoc()) {
            $waktuMakan[] = $row['waktumakan'];
            $kaloriMakan[] = $row['total_kalori'];
        }
    }

    $koneksi->close();
    ?>

    <script>
        // Data Latihan Fisik
        const hariLatihan = <?php echo json_encode($hariLatihan); ?>;
        const kaloriLatihan = <?php echo json_encode($kaloriLatihan); ?>;

        // Data Resep Makan
        const waktuMakan = <?php echo json_encode($waktuMakan); ?>;
        const kaloriMakan = <?php echo json_encode($kaloriMakan); ?>;

        // Grafik Latihan Fisik
        const ctxLatihan = document.getElementById('kaloriLatihanChart').getContext('2d');
        new Chart(ctxLatihan, {
            type: 'line',
            data: {
                labels: hariLatihan,
                datasets: [{
                    label: 'Kalori Terbakar (Latihan Fisik)',
                    data: kaloriLatihan,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Kalori (kcal)' }
                    },
                    x: {
                        title: { display: true, text: 'Hari' }
                    }
                }
            }
        });

        // Grafik Resep Makan
        const ctxMakan = document.getElementById('kaloriMakanChart').getContext('2d');
        new Chart(ctxMakan, {
            type: 'bar',
            data: {
                labels: waktuMakan,
                datasets: [{
                    label: 'Kalori (Resep Makan)',
                    data: kaloriMakan,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true, position: 'top' }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Kalori (kcal)' }
                    },
                    x: {
                        title: { display: true, text: 'Waktu Makan' }
                    }
                }
            }
        });
    </script>
</body>
</html>
