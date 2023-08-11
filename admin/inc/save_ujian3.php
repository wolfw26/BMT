<?php
include "../../koneksi.php";

$pembuat = @mysqli_real_escape_string($db, $_POST['pembuat']);
$judul = @mysqli_real_escape_string($db, $_POST['judul']);
$ruang = @mysqli_real_escape_string($db, $_POST['ruang']);
$bahan_ujian = @mysqli_real_escape_string($db, $_POST['bahan_ujian']);
$tgl_buat = @mysqli_real_escape_string($db, $_POST['tgl_buat']);
$waktu_soal = @mysqli_real_escape_string($db, $_POST['waktu_soal']) * 60;
$info = @mysqli_real_escape_string($db, $_POST['info']);
$status = @mysqli_real_escape_string($db, $_POST['status']);

// echo $pembuat."+".$judul."+".$kelas."+".$mapel."+".$tgl_buat."+".$waktu_soal."+".$info."+".$status;
mysqli_query($db, "INSERT INTO topik_ujian VALUES('', '$judul', '$ruang', '$bahan_ujian', '$tgl_buat', '$pembuat', '$waktu_soal', '$info', '$status')") or die ($db->error);
echo "<script>window.location='?page=ujian3';</script>";
?>