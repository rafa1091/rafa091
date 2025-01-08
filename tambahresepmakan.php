<?php
session_start();
include('koneksi.php');  // Include database connection

// Check if the trainer is logged in
if (!isset($_SESSION['trainer_username'])) {
    echo "Please log in.";
    exit();
}

// Process the form data when submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $Hari = mysqli_real_escape_string($koneksi, $_POST['Hari']);
    $jenisMakan = mysqli_real_escape_string($koneksi, $_POST['jenisMakan']);
    $detail_makan = mysqli_real_escape_string($koneksi, $_POST['detail_makan']);
    $waktumakan = mysqli_real_escape_string($koneksi, $_POST['waktumakan']);
    $kalori = mysqli_real_escape_string($koneksi, $_POST['kalori']);
    $gambar = $_FILES['gambar']['name'];
    $assignee = mysqli_real_escape_string($koneksi, $_POST['assignee']);
    
    // Handle the image upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);
    if (!move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        echo "Failed to upload the image.";
        exit();
    }
    
    // Insert data into the latihan_fisik table
    $query = "INSERT INTO resep_makan (Hari, jenisMakan, detail_makan, waktumakan, kalori, gambar, assignee) 
              VALUES ('$Hari', '$jenisMakan', '$detail_makan', '$waktumakan', '$kalori', '$target_file', '$assignee')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "Data successfully added!";
        header("Location: resepmakan.php");  // Redirect to latihanfisik.php page after success
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
