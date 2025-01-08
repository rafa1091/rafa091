<?php
include 'koneksi.php';

$Hari = $_GET['Hari']; // Added missing semicolon

// Sanitize the input to prevent SQL injection
$Hari = mysqli_real_escape_string($koneksi, $Hari);

$result = mysqli_query($koneksi, "DELETE FROM resep_makan WHERE Hari='$Hari'"); // Corrected the query

if ($result) {
    header("Location: resepmakan.php");
} else {
    echo "Error: " . mysqli_error($koneksi); // Optional: Handle error
}
?>