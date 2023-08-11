<?php
   $id_peserta = $_GET['id_peserta'];
   $sql_siswa_mengikuti_tes = mysqli_query($db, "SELECT * FROM peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE id_peserta = $id_peserta") or die ($db->error);
   $data_siswa_mengikuti_tes = mysqli_fetch_array($sql_siswa_mengikuti_tes);
  ?>
<div class="row">
    <div class="col-md-12">
    <div class="panel panel-default">
        
        <div class="panel-heading">
            Nama Peserta : <?php echo $data_siswa_mengikuti_tes['nama_lengkap'];?> &nbsp; <a href="?page=peserta_koreksi3" class="btn btn-danger btn-sm">Kembali</a>
        </div>
        <div class="panel-body">
        <form action="" method="post">
                        <?php
                        $id_tq = @$_GET['id_tq'];
                        $sql_soal_essay = mysqli_query($db, "SELECT * FROM soal_essay WHERE id_tq = '$id_tq' ORDER BY rand()") or die ($db->error);
                        if(mysqli_num_rows($sql_soal_essay) > 0) {
                        ?>
                            <div class="panel panel-default">
                                <div class="panel-heading"><b>Soal Essay</b></div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <?php
                                        while($data_soal_essay = mysqli_fetch_array($sql_soal_essay)) { ?>
                                            <table class="table">
                                                <tr>
                                                    <td width="10%">( <?php echo $no++; ?> )</td>
                                                    <td><b><?php echo $data_soal_essay['pertanyaan']; ?></b></td>
                                                </tr>
                                                <?php if($data_soal_essay['gambar'] != '') { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <img width="500px" src="admin/img/gambar_soal_essay$data_soal_essay/<?php echo $data_soal_essay['gambar']; ?>" />
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                
                                                <tr>
                                                    <td>Jawaban</td>
                                                    <td>
                                                    <div class="col-sm-12">
                                                     <input type="text" class="form-control" name="jawaban[]" onkeyup="sum()" id="jawaban" required>
                                                  </div>                                                       
                                                    </td>
                                                </tr>
                                                
                                                    <td>Nilai</td>
                                                    <td>
                                                    <div class="col-sm-12">
                                                     <input type="number" class="form-control" name="nilai[]" id="nilai" required>
                                                  </div>                                                       
                                                    </td>
                                                </tr>
                                            </table>
                                            <input type="hidden" name="nomorsoal[]" value="<?php echo $data_soal_essay['id_essay']; ?>" />
                                        <?php
                                        } ?>
                                        
                                    </div>
                                </div>
                            </div>
                        <?php
                        }  ?>
                        
                        <input type="hidden" name="id_tq" value="<?php echo $id_tq; ?>" />

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <button type="submit" name="simpan" class="btn btn-success">Selesai</button>
                               
                            </div>
                        </div>
                    </form>
                 </div>
            </div>
       </div>
</div>

<?php
    if(isset($_POST['simpan'])){
    $total = 0;
                            
    for($jawab = 0; $jawab < count($_POST['jawaban']); $jawab++){
    $jawaban =  $_POST['jawaban'][$jawab];
    $nilai   =  $_POST['nilai'][$jawab];                                
    $total   =  $total + $nilai;
    $nomorsoal   =  $_POST['nomorsoal'][$jawab];
    mysqli_query($db, "INSERT INTO jawaban VALUES ('null','$id_tq','$nomorsoal',' $id_peserta','$jawaban','$nilai')") or die ($db->error);                                
                               
    }
    mysqli_query($db, "INSERT INTO nilai_essay VALUES ('null','$id_tq','$id_peserta','$total')") or die ($db->error);
    echo "<script>window.location='?page=ujian3&action = peserta_koreksi3';</script>";                            
                            
    }
    ?>