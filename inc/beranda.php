<?php
$sql_siswa = mysqli_query($db, "SELECT * FROM peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE id_peserta = '$_SESSION[peserta]'") or die ($db->error);
$data = mysqli_fetch_array($sql_siswa);

if(@$_GET['hal'] == '') { ?>

<div class="row">
    <div class="col-lg-12 order-1 order-lg-2">  

        <div class="card">
            <div class="card-header">
                <h5>Beranda</h5>
            </div>
            <div class="post-content">
                <p class="post-desc pb-0">
                    <div class="alert alert-info">
                        <strong> Hai! <?php echo $data_terlogin['nama_lengkap']; ?> <br> Silahkan Lengkapi Berkas Persyaratan, Apabila lulus seleksi administrasi maka anda dapat mengikuti tes tertulis dan wawancara</strong>
                    </div>
                </p>
            </div>
        </div> 

        <div class="card">
            <div class="alert alert-info">
                <?php
                $sql1 = mysqli_query($db, "SELECT * FROM berkas NATURAL JOIN peserta WHERE id_peserta = '$_SESSION[peserta]'");
                $data = mysqli_fetch_array($sql1);
                ?>
                <strong> Selamat, <?php echo $data_terlogin['nama_lengkap']; ?>, Anda <?php echo $data['status_berkas'] ?></strong>
            </div>
            <br>
            <div class="card-header">
                <h5>Nilai Hasil Tes</h5>
            </div>
            <div class="post-content">
                <p>
                    <div>
                        <table class="item_entry" width="100%" class="table display nowrap">
                            <thead>
                                <tr align="left">
                                    <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">NO.</th>
                                    <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">NAMA</th> 
                                    <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">NILAI TERTULIS</th> 
                                    <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">NILAI WAWANCARA</th> 
                                    <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">NILAI TOTAL</th> 
                                    <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">STATUS</th> 
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no = 1;
                                $sql_siswa_mengikuti_tes = mysqli_query($db, "SELECT * FROM peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE id_peserta = '$_SESSION[peserta]'") or die ($db->error);
                                if(mysqli_num_rows($sql_siswa_mengikuti_tes) > 0) {
                                    while($data_siswa_mengikuti_tes = mysqli_fetch_array($sql_siswa_mengikuti_tes)) {
                                        ?>
                                        <tr>
                                            <td align="center" width="40px"><?php echo $no++; ?></td>
                                          
                                            <td><?php echo $data_siswa_mengikuti_tes['nama_lengkap']; ?></td>
                                            
                                            <?php
                                            $sql_pilgan = mysqli_query($db, "SELECT * FROM nilai_pilgan WHERE id_peserta = '$data_siswa_mengikuti_tes[id_peserta]'") or die ($db->error);$data_pilgan = mysqli_fetch_array($sql_pilgan);

                                            $sql_essay = mysqli_query($db, "SELECT * FROM nilai_essay WHERE id_peserta = '$data_siswa_mengikuti_tes[id_peserta]'") or die ($db->error);
                                            $data_essay = mysqli_fetch_array($sql_essay);
                                            $total = $data_pilgan['presentase'] * 0.3 + $data_essay['nilai'] * 0.7;
                                            if($total > 75 ){$status = "lulus";}
                                            else $status = "Belum Lulus";
                                            ?>
                                            <td>
                                                 <?php echo $data_pilgan['presentase']; ?> 
                                            </td> 
                                            <td>
                                                 <?php echo $data_essay['nilai']; ?> 
                                            </td> 
                                            <td>
                                                 <?php echo $total; ?> 
                                            </td> 
                                            <td>
                                                 <?php echo $status; ?> 
                                            </td> 
                                         
                                        </tr> 
                                <?php $nomor++; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </p>
            </div>
        </div>

    </div>
 
</div>
<?php
} else if(@$_GET['hal'] == 'detailprofil') { ?>
    <div class="row">
        <div class="col-lg-12 order-1 order-lg-2">  

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
                            <td>Kelas</td>
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
    </div> 
    <?php
} else if(@$_GET['hal'] == 'editprofil') { ?>

    <div class="row">
        <div class="col-lg-12 order-1 order-lg-2">  

            <div class="card">
                <div class="card-header">
                    <h5>Edit Profil</h5>
                </div>
                <div class="card-body">
                    <form method="post" class="signup-inner--form" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" name="nik" value="<?php echo $data['nik']; ?>" class="single-field" required />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>" class="single-field" required />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                            <div class="col-sm-10">
                                <input type="text" name="tempat_lahir" value="<?php echo $data['tempat_lahir']; ?>" class="single-field" required />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-sm-10">
                                <input type="date" name="tgl_lahir" value="<?php echo $data['tgl_lahir']; ?>" class="single-field" required />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jenis Kelmain</label>
                            <div class="col-sm-10">
                                <select name="jenis_kelamin" class="single-field" required>
                                    <option value="L">Laki-laki</option>
                                    <option value="P" <?php if($data['jenis_kelamin'] == 'P') { echo "selected"; } ?>>Perempuan</option>
                                </select>
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Agama</label>
                            <div class="col-sm-10">
                                <select name="agama" class="single-field" required>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen" <?php if($data['agama'] == 'Kristen') { echo "selected"; } ?>>Kristen</option>
                                    <option value="Katholik" <?php if($data['agama'] == 'Katholik') { echo "selected"; } ?>>Katholik</option>
                                    <option value="Hindu" <?php if($data['agama'] == 'Hindu') { echo "selected"; } ?>>Hindu</option>
                                    <option value="Budha" <?php if($data['agama'] == 'Budha') { echo "selected"; } ?>>Budha</option>
                                    <option value="Konghucu" <?php if($data['agama'] == 'Konghucu') { echo "selected"; } ?>>Konghucu</option>
                                </select>
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-10">
                                <input type="text" name="no_telp" value="<?php echo $data['no_telp']; ?>" class="single-field" required />
                            </div>
                        </div> 
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" value="<?php echo $data['email']; ?>" class="single-field" required />
                            </div>
                        </div>  
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" class="single-field" required />
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Jabatan</label>
                            <div class="col-sm-10">
                                <select name="ruang" class="form-control" required>
                                    <option value="<?php echo $data['id_ruang']; ?>"><?php echo $data['kandidat']; ?></option>
                                    <option value="">- Pilih -</option>
                                    <?php
                                    $sql_kelas = mysqli_query($db, "SELECT * from ruang") or die ($db->error);
                                    while($data_kelas = mysqli_fetch_array($sql_kelas)) {
                                        echo '<option value="'.$data_kelas['id_ruang'].'">'.$data_kelas['kandidat'].'</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <br />
                                <img src="./img/foto_peserta/<?php echo $data['foto']; ?>" width="150px" style="margin-bottom:5px;" />
                                <input type="file" name="gambar" class="single-field" />
                            </div>
                        </div>    
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="user" value="<?php echo $data['username']; ?>" class="single-field" required />
                            </div>
                        </div>   
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" name="pass" value="<?php echo $data['pass']; ?>" class="single-field" required />
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
                        $nik = @mysqli_real_escape_string($db, $_POST['nik']);
                        $nama_lengkap = @mysqli_real_escape_string($db, $_POST['nama_lengkap']);
                        $tempat_lahir = @mysqli_real_escape_string($db, $_POST['tempat_lahir']);
                        $tgl_lahir = @mysqli_real_escape_string($db, $_POST['tgl_lahir']);
                        $jenis_kelamin = @mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
                        $agama = @mysqli_real_escape_string($db, $_POST['agama']); 
                        $no_telp = @mysqli_real_escape_string($db, $_POST['no_telp']);
                        $email = @mysqli_real_escape_string($db, $_POST['email']);
                        $alamat = @mysqli_real_escape_string($db, $_POST['alamat']);
                        $ruang = @mysqli_real_escape_string($db, $_POST['ruang']); 
                        $user = @mysqli_real_escape_string($db, $_POST['user']);
                        $pass = @mysqli_real_escape_string($db, $_POST['pass']);

                        $sumber = @$_FILES['gambar']['tmp_name'];
                        $target = 'img/foto_peserta/';
                        $nama_gambar = @$_FILES['gambar']['name'];

                        if($nama_gambar == '') {
                            mysqli_query($db, "UPDATE peserta SET nik = '$nik', nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', no_telp = '$no_telp', email = '$email', alamat = '$alamat', id_ruang = '$ruang', username = '$user', password = md5('$pass'), pass = '$pass' WHERE id_peserta = '$_SESSION[peserta]'") or die ($db->error);          
                            echo '<script>window.location="?hal=detailprofil";</script>';
                        } else {
                            if(move_uploaded_file($sumber, $target.$nama_gambar)) {
                                mysqli_query($db, "UPDATE peserta SET nik = '$nik', nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', no_telp = '$no_telp', email = '$email', alamat = '$alamat', id_ruang = '$ruang', foto = '$nama_gambar', username = '$user', password = md5('$pass'), pass = '$pass' WHERE id_peserta = '$_SESSION[peserta]'") or die ($db->error);           
                                echo '<script>window.location="?hal=detailprofil";</script>';
                            } else {
                                echo '<script>alert("Gagal mengedit info profil, foto gagal diupload, coba lagi!");</script>';
                            }
                        }
                    }
                    ?>
                </div>
            </div>

        </div>
    </div> 
    <?php
} ?>
<?php
} ?>