<?php
session_start();

// Pseudocode untuk Menambahkan Jadwal Program Makan
// 1. Ambil data dari form (Hari, JenisMakan, detailMakan, Kalori, waktuMakan, gambar, assignee)
// 2. Gunakan prepared statement untuk memasukkan data ke dalam database
// 3. Jika data berhasil disimpan, tampilkan data berhasil di tambahkan
// 4. Jika gagal, tampilkan pesan error menambahkan
// 5. Setelah itu, tutup statement yang digunakan



// Redirect to login if the user is not logged in
if (!isset($_SESSION['trainer_username'])) {
    header("Location: login.php");
    exit();
}

// Include database connection
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet for Beginner - Resep Makanan</title>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-dumbbell"></i> DIET FOR BEGINNER
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link active" href="resepmakan.php">Resep Makan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporan.php">Laporan</a>
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

    <div class="container mt-4">
        <h3><i class="fas fa-dumbbell me-2"></i> Resep Makanan</h3>
        <hr>
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
            <i class="fas fa-plus-circle me-2"></i> Tambah Data
        </button>

        <!-- Modal for Adding Data -->
        <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahDataLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form action="tambahresepmakan.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="Hari" class="form-label">Hari</label>
                                <input type="text" class="form-control" id="Hari" name="Hari" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenisMakan" class="form-label">Makanan</label>
                                <input type="text" class="form-control" id="jenisMakan" name="jenisMakan" required>
                            </div>
                            <div class="mb-3">
                                <label for="detail_makan" class="form-label">Detail Makanan</label>
                                <input type="text" class="form-control" id="detail_makan" name="detail_makan" required>
                            </div>
                            <div class="mb-3">
                                <label for="waktumakan" class="form-label">Waktu Makan</label>
                                <input type="text" class="form-control" id="waktumakan" name="waktumakan" required>
                            </div>
                            <div class="mb-3">
                                <label for="kalori" class="form-label">Kalori</label>
                                <input type="text" class="form-control" id="kalori" name="kalori" required>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/jpg" required>
                            </div>
                            <div class="mb-3">
                                <label for="assignee" class="form-label">Assignee</label>
                                <select class="form-select" id="assignee" name="assignee" required>
                                    <option value="" disabled selected>Pilih Trainee</option>
                                    <?php
                                    $user_query = mysqli_query($koneksi, "SELECT id_user, username FROM user WHERE role = 'trainee'");
                                    while ($user_data = mysqli_fetch_assoc($user_query)) {
                                        echo "<option value='" . $user_data['id_user'] . "'>" . $user_data['username'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Data -->
        <div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDataLabel">Edit Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="edit_resep.php" method="POST">
                            <input type="hidden" id="edit-Hari" name="Hari">
                            <div class="mb-3">
                                <label for="edit-jenisMakan" class="form-label">Makanan</label>
                                <input type="text" class="form-control" id="edit-jenisMakan" name="jenisMakan" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-detail_makan" class="form-label">Detail Makanan</label>
                                <input type="text" class="form-control" id="edit-detail_makan" name="detail_makan" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-waktumakan" class="form-label">Waktu Makan</label>
                                <input type="text" class="form-control" id="edit-waktumakan" name="waktumakan" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-kalori" class="form-label">Kalori</label>
                                <input type="text" class="form-control" id="edit-kalori" name="kalori" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-assignee" class="form-label">Assignee</label>
                                <select class="form-select" id="edit-assignee" name="assignee" required>
                                    <option value="" disabled selected>Pilih Trainee</option>
                                    <?php
                                    $trainee_query = mysqli_query($koneksi, "SELECT id_user, username FROM user WHERE role = 'trainee'");
                                    while ($trainee = mysqli_fetch_assoc($trainee_query)) {
                                        echo "<option value='{$trainee['id_user']}'>{$trainee['username']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Makanan</th>
                    <th scope="col">Detail Makanan</th>
                    <th scope="col">Waktu Makan</th>
                    <th scope="col">Kalori (kcal)</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Assignee</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM resep_makan");
                $no = 1;
                while ($data = mysqli_fetch_assoc($query)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['Hari']; ?></td>
                    <td><?php echo $data['jenisMakan']; ?></td>
                    <td><?php echo $data['detail_makan']; ?></td>
                    <td><?php echo $data['waktumakan']; ?></td>
                    <td><?php echo $data['kalori']; ?></td>
                    <td><img src="<?php echo $data['gambar']; ?>" alt="Gambar" style="width: 100px; height: auto;"></td>
                    <td>
                        <?php
                        $assignee_id = $data['assignee'];
                        $assignee_query = mysqli_query($koneksi, "SELECT username FROM user WHERE id_user = '$assignee_id'");
                        $assignee_data = mysqli_fetch_assoc($assignee_query);
                        echo $assignee_data['username'];
                        ?>
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm me-1 edit-button" data-bs-toggle="modal" data-bs-target="#editDataModal" 
                            data-Hari="<?php echo $data['Hari']; ?>" 
                            data-jenisMakan="<?php echo $data['jenisMakan']; ?>" 
                            data-detail_makan="<?php echo $data['detail_makan']; ?>" 
                            data-waktumakan="<?php echo $data['waktumakan']; ?>" 
                            data-kalori="<?php echo $data['kalori']; ?>" 
                            data-assignee="<?php echo $data['assignee']; ?>">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <a href="hapus_resep.php?Hari=<?php echo $data['Hari']; ?>" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Delete
                        </a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.edit-button');
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const Hari = this.getAttribute('data-Hari');
                    const jenisMakan = this.getAttribute('data-jenisMakan');
                    const detail_makan = this.getAttribute('data-detail_makan');
                    const waktumakan = this.getAttribute('data-waktumakan');
                    const kalori = this.getAttribute('data-kalori');
                    const assignee = this.getAttribute('data-assignee');

                    document.getElementById('edit-Hari').value = Hari;
                    document.getElementById('edit-detail_makan').value = detail_makan;
                    document.getElementById('edit-jenisMakan').value = jenisMakan;
                    document.getElementById('edit-waktumakan').value = waktumakan;
                    document.getElementById('edit-kalori').value = kalori;
                    document.getElementById('edit-assignee').value = assignee;
                });
            });
        });
    </script>
</body>
</html>
