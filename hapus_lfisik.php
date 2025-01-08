<?php
include 'koneksi.php';
$hari = $_GET['hari'];
$result = mysqli_query($koneksi, "DELETE FROM latihan_fisik WHERE hari='$hari'"); 
    header("Location: latihanfisik.php");
?>