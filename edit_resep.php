<?php
include 'koneksi.php';
    $Hari= $_POST['Hari'];
    $jenisMakan= $_POST['jenisMakan'];
    $detail_makan= $_POST['detail_makan'];
    $waktumakan= $_POST['waktumakan'];
    $kalori= $_POST['kalori'];
    $result = mysqli_query($koneksi, "UPDATE resep_makan SET jenisMakan='$jenisMakan', detail_makan='$detail_makan', waktumakan='$waktumakan', kalori='$kalori' WHERE Hari='$Hari'");

header("Location: resepmakan.php");
?>