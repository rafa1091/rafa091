<?php
session_start();
include('koneksi.php');  // Make sure you include the database connection

// Check if the user is logged in, if not, don't do anything
if (!isset($_SESSION['trainer_username'])) {
    // Handle if the trainer is not logged in
    echo "Please log in.";
    exit();
}

// Fetch the trainer's details from the database
$trainer_username = $_SESSION['trainer_username'];
$query = "SELECT id_user, role FROM user WHERE username = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "s", $trainer_username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$trainer = mysqli_fetch_assoc($result);

// Ensure the logged-in user is a trainer
if ($trainer['role'] !== 'trainer') {
    echo "You are not authorized to access this page.";
    exit();
}

$trainer_id = $trainer['id_user'];  // Get trainer's ID
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet for Beginner - Latihan Fisik</title>
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
        .welcome-text {
            font-family: 'Poppins', sans-serif;
            font-size: 32px;
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-dumbbell"></i> DIET FOR BEGINNER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="beranda.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="latihanfisik.php">Latihan Fisik</a></li>
                    <li class="nav-item"><a class="nav-link" href="resepmakan.php">Resep Makan</a></li>
                    <li class="nav-item"><a class="nav-link" href="laporan.php">Laporan</a></li>
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
        <h3><i class="fas fa-dumbbell me-2"></i> Latihan Fisik</h3>
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
                        <form action="tambah_lfisik.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="hari" class="form-label">Hari</label>
                                <input type="text" class="form-control" id="hari" name="hari" required>
                            </div>
                            <div class="mb-3">
                                <label for="latihan" class="form-label">Latihan</label>
                                <input type="text" class="form-control" id="latihan" name="latihan" required>
                            </div>
                            <div class="mb-3">
                                <label for="detail_latihan" class="form-label">Detail Latihan</label>
                                <input type="text" class="form-control" id="detail_latihan" name="detail_latihan" required>
                            </div>
                            <div class="mb-3">
                                <label for="durasi" class="form-label">Durasi</label>
                                <input type="text" class="form-control" id="durasi" name="durasi" required>
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
                            </div>
                                <?php
                                // Ambil data trainee berdasarkan username
                                $user_query = mysqli_query($koneksi, "SELECT id_user, username FROM user WHERE role = 'trainee'");
                                if (!$user_query) {
                                    die("Error fetching trainees: " . mysqli_error($koneksi));
                                }
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
<!-- Modal for Editing Data -->
<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataLabel">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="ubah_lfisik.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" id="edit-id" name="id"> <!-- Hidden field for ID -->
                    <div class="mb-3">
                        <label for="edit-hari" class="form-label">Hari</label>
                        <input type="text" class="form-control" id="edit-hari" name="hari" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-latihan" class="form-label">Latihan</label>
                        <input type="text" class="form-control" id="edit-latihan" name="latihan" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-detail_latihan" class="form-label">Detail Latihan</label>
                        <input type="text" class="form-control" id="edit-detail_latihan" name="detail_latihan" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-durasi" class="form-label">Durasi</label>
                        <input type="text" class="form-control" id="edit-durasi" name="durasi" required>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-button');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const hari = this.getAttribute('data-hari');
                const latihan = this.getAttribute('data-latihan');
                const detail_latihan = this.getAttribute('data-detail_latihan');
                const durasi = this.getAttribute('data-durasi');
                const kalori = this.getAttribute('data-kalori');
                const assignee = this.getAttribute('data-assignee');

                // Populate modal fields
                document.getElementById('edit-hari').value = hari;
                document.getElementById('edit-latihan').value = latihan;
                document.getElementById('edit-detail_latihan').value = detail_latihan;
                document.getElementById('edit-durasi').value = durasi;
                document.getElementById('edit-kalori').value = kalori;
                document.getElementById('edit-assignee').value = assignee;
            });
        });
    });
</script>

        <!-- Table -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Hari</th>
                    <th scope="col">Latihan</th>
                    <th scope="col">Detail Latihan</th>
                    <th scope="col">Durasi (Menit)</th>
                    <th scope="col">Kalori (kcal)</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Assignee</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($koneksi, "SELECT * FROM latihan_fisik");
                if (!$query) {
                    die("Error fetching exercise schedules: " . mysqli_error($koneksi));
                }
                $no = 1;
                while ($data = mysqli_fetch_assoc($query)) {
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
                            $assignee_id = $data['assignee'];
                            $assignee_query = mysqli_query($koneksi, "SELECT username FROM user WHERE id_user = '$assignee_id'");
                            if (!$assignee_query) {
                                die("Error fetching assignee: " . mysqli_error($koneksi));
                            }
                            $assignee_data = mysqli_fetch_assoc($assignee_query);
                            echo $assignee_data['username'];
                            ?>
                        </td>
                        <td>
                        <button class="btn btn-success btn-sm me-1 edit-button"
                                data-bs-toggle="modal"
                                data-bs-target="#editDataModal"
                                data-hari="<?php echo $data['hari']; ?>"
                                data-latihan="<?php echo $data['latihan']; ?>"
                                data-detail_latihan="<?php echo $data['detail_latihan']; ?>"
                                data-durasi="<?php echo $data['durasi']; ?>"
                                data-kalori="<?php echo $data['kalori']; ?>"
                                data-assignee="<?php echo $data['assignee']; ?>">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                            <a href="hapus_lfisik.php?hari=<?php echo $data['hari']; ?>" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
