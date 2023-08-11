<?php
@session_start();
include "../koneksi.php";

$id_tq = mysqli_real_escape_string($db, $_POST['id_tq']);

$soal = mysqli_query($db, "SELECT * FROM soal_pilgan where id_tq = '$id_tq'") or die ('7' . $db->error);
$pilganda = mysqli_num_rows($soal);

$soal_esay = mysqli_query($db, "SELECT * FROM soal_essay WHERE id_tq = '$id_tq'") or die ('10' . $db->error);
$esay = mysqli_num_rows($soal_esay);
//die();

if (!empty($pilganda) AND !empty($esay)) {

  if(!empty($_POST['soal_pilgan'])) {
      $benar = 0;
      $salah = 0;
      foreach($_POST['soal_pilgan'] as $key => $value){
        $cek = mysqli_query($db, "SELECT * FROM soal_pilgan WHERE id_pilgan = '$key'") or die ('19' . $db->error);
        while($c = mysqli_fetch_array($cek)){
            $jawaban = $c['kunci'];
        }
        if($value == $jawaban) {
            $benar++;
        } else {
            $salah++;
        }
    }
    $jumlah = $_POST['jumlahsoalpilgan'];
    $tidakjawab = $jumlah - $benar - $salah;
    $persen = $benar / $jumlah;
    $hasil = $persen * 100;
    mysqli_query($db, "INSERT INTO nilai_pilgan VALUES ('', '$id_tq', '$_SESSION[peserta]', '$benar', '$salah', '$tidakjawab', '$hasil')") or die ('33' . $db->error);
  } else if(empty($_POST['soal_pilganda'])){
      $jumlah = $_POST['jumlahsoalpilgan'];
      mysqli_query($db, "INSERT INTO nilai_pilgan VALUES ('', '$id_tq', '$_SESSION[peserta]', '0', '0', '$jumlah', '0')") or die ('36' . $db->error);
  }

  //var_dump($_POST);
  if(!empty($_POST['soal_essay'])) {
      foreach($_POST['soal_essay'] as $key2 => $value) {
        $jawaban = mysqli_real_escape_string($db, $value);
        $cek = mysqli_query($db, "SELECT * FROM soal_essay WHERE id_essay = '$key2'");
        while($data = mysqli_fetch_array($cek)) {
            mysqli_query($db, "INSERT INTO jawaban VALUES('', '$id_tq','$data[id_essay]','$_SESSION[peserta]','$jawaban')") or die ('44' . $db->error);
        }
      }
  } else if (empty($_POST['soal_esay'])){
      mysqli_query($db, "INSERT INTO jawaban VALUES('', '$id_tq','$data[id_essay]','$_SESSION[peserta]','')") or die ('48' . $db->error);
  }
  echo "<script>window.location='./../?page=ujian&action=infokerjakan&id_tq=".$id_tq."';</script>";
}

///////////

if (empty($pilganda) AND !empty($esay)) {
  if(!empty($_POST['soal_essay'])) {
    foreach($_POST['soal_essay'] as $key2 => $value){
      $jawaban = $value;
      $cek = mysqli_query($db, "SELECT * FROM soal_essay WHERE id_essay = '$key2'");
      while($data = mysqli_fetch_array($cek)) {
          mysqli_query($db, "INSERT INTO jawaban VALUES('', '$id_tq', '$data[id_essay]', '$_SESSION[peserta]', '$jawaban')") or die ('61' . $db->error);
      }
    }
  } else if(empty($_POST['soal_essay'])) {
    mysqli_query($db, "INSERT INTO jawaban VALUES('', '$id_tq', '$data[id_essay]', '$_SESSION[peserta]','')") or die ('65' . $db->error);
  }
  echo "<script>window.location='./../?page=ujian&action=infokerjakan&id_tq=".$id_tq."';</script>";
}

if (!empty($pilganda) AND empty($esay)) {
  if(!empty($_POST['soal_pilgan'])) {
      $benar = 0;
      $salah = 0;
      foreach($_POST['soal_pilgan'] as $key => $value) {
          $cek = mysqli_query($db, "SELECT * FROM soal_pilgan WHERE id_pilgan = '$key'") or die ('75' . $db->error);
          while($c = mysqli_fetch_array($cek)) {
              $jawaban = $c['kunci'];
          }
          if($value == $jawaban) {
              $benar++;
          } else {
              $salah++;
          }
      }
      $jumlah = $_POST['jumlahsoalpilgan'];
      $tidakjawab = $jumlah - $benar - $salah;
      $persen = $benar / $jumlah;
      $hasil = $persen * 100;
      mysqli_query($db, "INSERT INTO nilai_pilgan VALUES('', '$id_tq', '$_SESSION[peserta]', '$benar', '$salah', '$tidakjawab', '$hasil')") or die (' 89 ' . $db->error);

  } else if(empty($_POST['soal_pilgan'])) {
      $jumlah = $_POST['jumlahsoalpilgan'];
      mysqli_query($db, "INSERT INTO nilai_pilgan VALUES('', '$id_tq', '$_SESSION[peserta]', '0', '0', '$jumlah', '0')") or die ('93' . $db->error);
  }
  echo "<script>window.location='./../?page=ujian&action=infokerjakan&id_tq=".$id_tq."';</script>";
} ?>