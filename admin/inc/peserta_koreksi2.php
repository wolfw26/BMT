<div class="row">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Data Peserta yang Mengikuti Ujian &nbsp; <a href="?page=peserta_koreksi3" class="btn btn-danger btn-sm">Kembali</a>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Status Hasil</th> 
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql_siswa_mengikuti_tes = mysqli_query($db, "SELECT * FROM nilai_pilgan JOIN peserta ON nilai_pilgan.id_peserta = peserta.id_peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang JOIN berkas ON berkas.id_peserta = peserta.id_peserta WHERE id_tq = '$id_tq'") or die ($db->error);
                    if(mysqli_num_rows($sql_siswa_mengikuti_tes) > 0) {
                        while($data_siswa_mengikuti_tes = mysqli_fetch_array($sql_siswa_mengikuti_tes)) {
                            ?>
                            <tr>
                                <td align="center" width="40px"><?php echo $no++; ?></td>
                                <td><?php echo $data_siswa_mengikuti_tes['nama_lengkap']; ?></td>
                                <td><?php echo $data_siswa_mengikuti_tes['kandidat']; ?> - <?php echo $data_siswa_mengikuti_tes['ruangan']; ?> </td>
                                <?php
                                $sql_pilgan = mysqli_query($db, "SELECT * FROM nilai_pilgan WHERE id_peserta = '$data_siswa_mengikuti_tes[id_peserta]' AND id_tq = '$id_tq'") or die ($db->error);
                                $data_pilgan = mysqli_fetch_array($sql_pilgan);
                                $sql_jwb = mysqli_query($db, "SELECT * FROM jawaban WHERE id_peserta = '$data_siswa_mengikuti_tes[id_peserta]' AND id_tq = '$id_tq'") or die ($db->error); 
                                ?>
                                <td>
                                    Nilai Ujian Tertulis : <?php echo $data_pilgan['presentase']; ?> 
                                </td> 
                                <td align="center" width="220px">  
                                    <a onclick="return confirm('Yakin akan menghapus siswa ini dari daftar peserta ujian?');" href="?page=ujian2&action=hapuspeserta&id_tq=<?php echo $id_tq; ?>&id_peserta=<?php echo $data_siswa_mengikuti_tes['id_peserta']; ?>" class="badge badge-danger" >Hapus Peserta dari Ujian</a>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        echo '<tr><td colspan="6" align="center">Data tidak ditemukan</td></tr>';
                    } ?>
                    </tbody>
                </table>
                <?php if(mysqli_num_rows($sql_siswa_mengikuti_tes) > 0) { ?>
                    
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
</div>