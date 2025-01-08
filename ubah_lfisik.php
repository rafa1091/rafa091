<?php
include 'koneksi.php';
    $hari= $_POST['hari'];
    $latihan= $_POST['latihan'];
    $detail_latihan= $_POST['detail_latihan'];
    $durasi= $_POST['durasi'];
    $kalori= $_POST['kalori'];
    $assignee = $_POST['assignee'];
    $result = mysqli_query($koneksi, "UPDATE latihan_fisik SET latihan='$latihan', detail_latihan='$detail_latihan', durasi='$durasi', kalori='$kalori', assignee='$assignee' WHERE hari='$hari'");

header("Location: latihanfisik.php");
?>