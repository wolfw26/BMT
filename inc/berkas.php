<?php
$sql_siswa = mysqli_query($db, "SELECT * FROM peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE id_peserta = '$_SESSION[peserta]'") or die ($db->error);
$data = mysqli_fetch_array($sql_siswa);

if(@$_GET['action'] == '') { ?>

<div class="row">
    <div class="col-lg-7 order-1 order-lg-2">  

        <div class="card">
            <div class="card-header">
                <h5>Detail Profil</h5>
            </div>
            <div class="post-content">
                <table class="table">
                    <tr>
                        <td>NIk</td>
                        <td>:</td>
                        <td><?php echo $data['nik']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td><?php echo $data['nama_lengkap']; ?></td>
                    </tr>
                    <tr>
                        <td>Tempat Tanggal Lahir</td>
                        <td>:</td>
                        <td><?php echo $data['tempat_lahir'].", ".tgl_indo($data['tgl_lahir']); ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?php echo $data['jenis_kelamin']; ?></td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>:</td>
                        <td><?php echo $data['agama']; ?></td>
                    </tr>  
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>:</td>
                        <td><?php echo $data['no_telp']; ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><?php echo $data['email']; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $data['alamat']; ?></td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td>
                        <td>:</td>
                        <td><?php echo $data['kandidat']; ?></td>
                    </tr> 
                    <tr>
                        <td>Foto</td>
                        <td>:</td>
                        <td><img src="./img/foto_peserta/<?php echo $data['foto']; ?>" width="200px" /></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><?php echo $data['username']; ?></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><?php echo $data['pass']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
    <div class="col-lg-5 order-1 order-lg-2">  

        <div class="card">
            <div class="card-header">
                <h5>Berkas Persyaratan | <a href="?page=berkas&action=upberkas&id=<?php echo $data['id_peserta']; ?>" > Berkas Persyaratan</a> </h5>
            </div>
            <div class="post-content">
                <?php 
                $sql_per_id = mysqli_query($db, "SELECT * FROM peserta NATURAL JOIN berkas WHERE id_peserta = '$_SESSION[peserta]'") or die ($db->error);
                $data = mysqli_fetch_array($sql_per_id);
                ?>
                <table class="table">
                    <tr>
                        <td>Fotocopy KTP</td>
                        <td>:</td> 
                        <td><img src="./img/berkas/<?php echo $data['ktp']; ?>" width="200px" /></td>
                    </tr>
                    <tr>
                        <td>Daftar Riwayat Hidup</td>
                        <td>:</td>
                        <td><img src="./img/berkas/<?php echo $data['riwayat_hidup']; ?>" width="200px" /></td>
                    </tr>
                    <tr>
                        <td>Vaksin 3</td>
                        <td>:</td>
                        <td><img src="./img/berkas/<?php echo $data['vaksin']; ?>" width="200px" /></td>
                    </tr>
                    <tr>
                        <td>Ijazah Terakhir</td>
                        <td>:</td>
                        <td><img src="./img/berkas/<?php echo $data['ijazah_terakhir']; ?>" width="200px" /></td>
                    </tr>
                    <tr>
                        <td>Fotocopy KK</td>
                        <td>:</td>
                        <td><img src="./img/berkas/<?php echo $data['kk']; ?>" width="200px" /></td>
                    </tr>   
                    <?php if ($data_log['status_berkas']==""): ?>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>Lengkapi Berkas Anda</td>
                    </tr> 
                    <?php endif ?>
                    <?php if ($data_log['status_berkas']=="Pending"): ?>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>Berkas berhasil diupload, tunggu verifikasi penguji</td>
                    </tr> 
                    <?php endif ?>
                    <?php if ($data_log['status_berkas']=="Lanjut Ke Tahap Tes Tertulis dan Wawancara"): ?>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>Anda Lulus Ke Tahap Tertulis dan Wawancara</td>
                    </tr> 
                    <?php endif ?>
                </table>
            </div>
        </div>

    </div>
</div>  

    <?php } else if(@$_GET['action'] == 'upberkas') { ?>

    <div class="row">
        <div class="col-lg-12 order-1 order-lg-2">  

            <div class="card">
                <div class="card-header">
                    <h5>Upload Berkas Persyaratan</h5>
                </div>
                <div class="card-body">
                    <form method="post" class="signup-inner--form" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                                <input hidden name="id_peserta" value="<?php echo $data['id_peserta']; ?>" class="single-field" required />
                                <input type="text" value="<?php echo $data['nik']; ?>" class="single-field" required readonly />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo $data['nama_lengkap']; ?>" class="single-field" required readonly />
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fotocopy KTP</label>
                            <div class="col-sm-10">  
                                <input type="file" name="ktp" class="single-field" />
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Riwayat Hidup</label>
                            <div class="col-sm-10">  
                                <input type="file" name="riwayat_hidup" class="single-field" />
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Vaksin 3</label>
                            <div class="col-sm-10">  
                                <input type="file" name="vaksin" class="single-field" />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Ijazah Terakhir</label>
                            <div class="col-sm-10">  
                                <input type="file" name="ijazah_terakhir" class="single-field" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fotocopy KK</label>
                            <div class="col-sm-10">  
                                <input type="file" name="kk" class="single-field" />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">&nbsp;</label>
                            <div class="col-sm-10">
                                <input type="submit" name="simpan" value="Simpan" class="submit-btn" />  
                            </div>
                        </div>    
                        
                    </form>
                    <?php
                    if(@$_POST['simpan']) {
                        $id_peserta = @mysqli_real_escape_string($db, $_POST['id_peserta']);
                        $ktp       = @$_FILES['ktp']['name'];
                        $lokasi         = @$_FILES['ktp']['tmp_name'];
                        move_uploaded_file($lokasi, "img/berkas/".$ktp);
                        $riwayat_hidup       = @$_FILES['riwayat_hidup']['name'];
                        $lokasi         = @$_FILES['riwayat_hidup']['tmp_name'];
                        move_uploaded_file($lokasi, "img/berkas/".$riwayat_hidup);
                        $vaksin       = @$_FILES['vaksin']['name'];
                        $lokasi         = @$_FILES['vaksin']['tmp_name'];
                        move_uploaded_file($lokasi, "img/berkas/".$vaksin);
                        $ijazah_terakhir       = @$_FILES['ijazah_terakhir']['name'];
                        $lokasi         = @$_FILES['ijazah_terakhir']['tmp_name'];
                        move_uploaded_file($lokasi, "img/berkas/".$ijazah_terakhir);
                        $kk       = @$_FILES['kk']['name'];
                        $lokasi         = @$_FILES['kk']['tmp_name'];
                        move_uploaded_file($lokasi, "img/berkas/".$kk);

                        {
                            $db->query("INSERT INTO berkas
                                (id_peserta,ktp,riwayat_hidup,vaksin,ijazah_terakhir,kk,status_berkas)
                                VALUES ('$id_peserta','$ktp','$riwayat_hidup','$vaksin','$ijazah_terakhir','$kk','Pending') ");

                            echo "<script>alert('Data berhasil ditambahkan.');</script>";
                            echo "<script>location='?page=berkas';</script>";
                        }
                    }
                    ?>
                </div>
            </div>

        </div>
    </div> 
<?php
} ?>