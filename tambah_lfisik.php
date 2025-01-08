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
    $hari = mysqli_real_escape_string($koneksi, $_POST['hari']);
    $latihan = mysqli_real_escape_string($koneksi, $_POST['latihan']);
    $detail_latihan = mysqli_real_escape_string($koneksi, $_POST['detail_latihan']);
    $durasi = mysqli_real_escape_string($koneksi, $_POST['durasi']);
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
    $query = "INSERT INTO latihan_fisik (hari, latihan, detail_latihan, durasi, kalori, gambar, assignee) 
              VALUES ('$hari', '$latihan', '$detail_latihan', '$durasi', '$kalori', '$target_file', '$assignee')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "Data successfully added!";
        header("Location: latihanfisik.php");  // Redirect to latihanfisik.php page after success
        exit();
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
