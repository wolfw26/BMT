<div class="page-header">
    <div>
        <h3>Manajemen Data Jabatan Pelamar</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li> 
                <li class="breadcrumb-item active" aria-current="page">Manajemen Data Pelatihan Karyawan</li>
            </ol>
        </nav>
    </div>
</div>
 
	<?php
	$id = @$_GET['id'];
	$sql_per_id = mysqli_query($db, "SELECT * FROM ruang WHERE id_ruang = '$id'") or die ($db->error);
	$data = mysqli_fetch_array($sql_per_id);

	$sql_ruangan = mysqli_query($db, "SELECT * FROM ruang") or die ($db->error);
	$no = 1;

	if(@$_SESSION['admin']) {

	echo '<div class="row">';
    
    if(@$_GET['action'] == '') { ?>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                	<div class="card-header">
                		<h5>Data Jabatan | <a href="?page=ruang&action=tambah" class="badge badge-primary">Tambah</a></h5>
                	</div>
                    <div class="card-body">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jabatan</th>
                                    <th>Penguji</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($data_ruangan = mysqli_fetch_array($sql_ruangan)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data_ruangan['kandidat']; ?></td>
                                    
                                    <?php
                                    $sql_tampil_penguji = tampil_per_id("penguji", "id_penguji = '$data_ruangan[penguji]'");
                                    $data_tampil_penguji = mysqli_fetch_array($sql_tampil_penguji);
                                    $cek_tampil_penguji = mysqli_num_rows($sql_tampil_penguji);
                                    if($cek_tampil_penguji > 0) {
                                        echo "<td>".$data_tampil_penguji['nama_lengkap']."</td>";
                                    } else {
                                        echo "<td><i>Belum diatur</i></td>";
                                    } ?>
                                    <td align="center" width="200px">
                                        <a href="?page=ruang&action=edit&id=<?php echo $data_ruangan['id_ruang']; ?>" class="badge badge-success">Edit</a>
                                        <a onclick="return confirm('Yakin akan menghapus data kecamatan?');" href="?page=ruang&action=hapus&id=<?php echo $data_ruangan['id_ruang']; ?>" class="badge badge-danger">Hapus</a>
                                        <a href="?page=peserta&IDruang=<?php echo $data_ruangan['id_ruang']; ?>&Ruang=<?php echo $data_ruangan['kandidat']; ?>" class="badge badge-info">Lihat Peserta</a>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                            </tbody>
                        </table> 
                    </div>
                </div> 
            </div>
        </div>
    </div> 
	
	<?php } else if(@$_GET['action'] == 'tambah') { ?>
	
	<div class="col-md-12">

        <div class="row">
            <div class="col-md-12"> 

                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Data Jabatan | <a href="?page=ruang" class="badge badge-warning">Kembali</a></h5>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kandidat" autofocus required>
                                </div>
                            </div>
                           
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <input type="submit" name="simpan" value="Simpan" class="btn btn-success" /> 
                                    <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Reset</button>
                                </div>
                            </div>    
                        </form>
                        <?php
					    if(@$_POST['simpan']) {
					        $nama_ruang = @mysqli_real_escape_string($db, $_POST['kandidat']);
					        $ruangan = @mysqli_real_escape_string($db, $_POST['ruangan']);
					        mysqli_query($db, "INSERT INTO ruang (kandidat, ruangan) VALUES('$kandidat', '$ruangan')") or die ($db->error);
					        echo "<script>window.location='?page=ruang';</script>";
					    }
					    ?>
                    </div>
                </div> 

            </div>
        </div>

    </div>

    <?php } else if(@$_GET['action'] == 'edit') { ?>

	<div class="col-md-12">

        <div class="row">
            <div class="col-md-12"> 

                <div class="card">
                    <div class="card-header">
                        <h5>Ubah Data Jabatan | <a href="?page=ruang" class="badge badge-warning">Kembali</a></h5>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kandidat" value="<?php echo $data['kandidat']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ruangan" value="<?php echo $data['ruangan']; ?>" required>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Penguji</label>
                                <div class="col-sm-10">
                                    <select name="penguji" class="form-control">
                                        <?php
                                        $sql2 = tampil_per_id("penguji", "id_penguji = '$data[penguji]'");
                                        $data2 = mysqli_fetch_array($sql2);
                                        if(mysqli_num_rows($sql2) > 0) { 
                                            echo '<option value="'.$data2['id_penguji'].'">'.$data2['nama_lengkap'].'</option>';
                                            echo '<option value="">- Pilih -</option>';
                                        } else {
                                            echo '<option value="">- Pilih -</option>';
                                        }
                                        
                                        $sql_guru = mysqli_query($db, "SELECT * FROM penguji") or die ($db->error);
                                        while($data_guru = mysqli_fetch_array($sql_guru)) {
                                            echo '<option value="'.$data_guru['id_penguji'].'">'.$data_guru['nama_lengkap'].'</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <input type="submit" name="simpan" value="Simpan" class="btn btn-success" /> 
                                    <button type="reset" class="btn btn-danger"> Reset</button>
                                </div>
                            </div>  
                        </form>
                        <?php
                        if(@$_POST['simpan']) {
                            $nama_ruang = @mysqli_real_escape_string($db, $_POST['kandidat']);
                            $ruangan = @mysqli_real_escape_string($db, $_POST['ruangan']);
                            $penguji = @mysqli_real_escape_string($db, $_POST['penguji']); 
                            mysqli_query($db, "UPDATE ruang SET kandidat = '$kandidat', ruangan = '$ruangan', penguji = '$penguji' WHERE id_ruang = '$id'") or die ($db->error);
                            echo "<script>window.location='?page=ruang';</script>";
                        }
                        ?>
                    </div>
                </div> 

            </div>
        </div>

    </div>

        <?php
    } else if(@$_GET['action'] == 'hapus') {
        mysqli_query($db, "DELETE FROM ruang WHERE id_ruang = '$id'") or die ($db->error);  
        echo "<script>window.location='?page=ruang';</script>"; 
    }
   

    else if(@$_GET['action'] == 'detail') {
        $id_peserta = $_GET['id_peserta'];
        $sql1 = mysqli_query($db, "SELECT * FROM berkas NATURAL JOIN peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE id_peserta ='$id_peserta'");
        $data = mysqli_fetch_array($sql1);
        ?>
    
        
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
                            <td><img src="../../img/foto_peserta/<?php echo $data['foto']; ?>" width="200px" /></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>:</td>
                            <td><?php echo $data['username']; ?></td>
                        </tr>
                       
                    </table>
                </div>
            </div>
    
        </div>
    </div> 

    
    <?php
        
    
     }

     echo "</div>";

} else if(@$_SESSION['penguji']) {

    if(@$_GET['action'] == '') { ?>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    
                    <div class="card-body">
                    <table id="example1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Jabatan</th>
                                    <th>Penguji</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($data_ruangan = mysqli_fetch_array($sql_ruangan)) { ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data_ruangan['kandidat']; ?></td>
                                    
                                    <?php
                                    $sql_tampil_penguji = tampil_per_id("penguji", "id_penguji = '$data_ruangan[penguji]'");
                                    $data_tampil_penguji = mysqli_fetch_array($sql_tampil_penguji);
                                    $cek_tampil_penguji = mysqli_num_rows($sql_tampil_penguji);
                                    if($cek_tampil_penguji > 0) {
                                        echo "<td>".$data_tampil_penguji['nama_lengkap']."</td>";
                                    } else {
                                        echo "<td><i>Belum diatur</i></td>";
                                    } ?>
                                    <td align="center" width="200px">                                       
                                        <a href="?page=peserta&IDruang=<?php echo $data_ruangan['id_ruang']; ?>&Ruang=<?php echo $data_ruangan['kandidat']; ?>" class="badge badge-info">Lihat Peserta</a>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                            </tbody>
                        </table> 
                    </div>
                </div> 
            </div>
        </div>
    </div> 

    <?php
    } else if(@$_GET['action'] == 'tambah') { ?>

    <div class="col-md-12">

        <div class="row">
            <div class="col-md-12"> 

                <div class="card">
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <select name="ruang" class="form-control" required>
                                        <option value="">- Pilih -</option>
                                        <?php
                                        while($data_kelas = mysqli_fetch_array($sql_kelas)) {
                                            echo '<option value="'.$data_kelas['id_ruang'].'">'.$data_kelas['kandidat'].'</option>';
                                        }
                                        ?>
                                    </select>s
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ket" required>
                                </div>
                            </div>   
                            <div class="form-group">
                                <input type="submit" name="simpan" value="Simpan" class="btn btn-success" /> 
                                <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Reset</button>
                            </div>
                        </form>
                        <?php
                        if(@$_POST['simpan']) {
                            $nama_ruang = @mysqli_real_escape_string($db, $_POST['kandidat']);
                            $ket = @mysqli_real_escape_string($db, $_POST['ket']);
                            $penguji = @$_SESSION['penguji'];
                            mysqli_query($db, "INSERT INTO ruang_ajar VALUES('', '$ruang', '$penguji', '$ket')") or die ($db->error);
                            echo "<script>window.location='?page=ruang';</script>";
                        }
                        ?>
                    </div>
                </div> 

            </div>
        </div>

    </div>

    <?php
    } else if(@$_GET['action'] == 'edit') { ?>


    <div class="col-md-12">

        <div class="row">
            <div class="col-md-12"> 

                <div class="card">
                    <div class="card-body">
                        <?php
                        $sql_id_ajar = mysqli_query($db, "SELECT * FROM ruang_ajar JOIN ruang ON ruang_ajar.id_ruang = ruang.id_ruang WHERE ruang_ajar.id = '$id'") or die ($db->error);
                        $data_ajar2 = mysqli_fetch_array($sql_id_ajar);
                        ?>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <select name="kelas" class="form-control" required>
                                        <option value="<?php echo $data_ajar2['id_ruang']; ?>"><?php echo $data_ajar2['nama_kelas']; ?></option>
                                        <option value="">- Pilih -</option>
                                        <?php
                                        while($data_kelas = mysqli_fetch_array($sql_kelas)) {
                                            echo '<option value="'.$data_kelas['id_ruang'].'">'.$data_kelas['nama_kelas'].'</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="ruangan" value="<?php echo $data_ajar2['keterangan']; ?>" required>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Penguji</label>
                                <div class="col-sm-10">
                                    <select name="penguji" class="form-control">
                                        <?php
                                        $sql2 = tampil_per_id("penguji", "id_penguji = '$data[penguji]'");
                                        $data2 = mysqli_fetch_array($sql2);
                                        if(mysqli_num_rows($sql2) > 0) { 
                                            echo '<option value="'.$data2['id_penguji'].'">'.$data2['nama_lengkap'].'</option>';
                                            echo '<option value="">- Pilih -</option>';
                                        } else {
                                            echo '<option value="">- Pilih -</option>';
                                        }
                                        
                                        $sql_guru = mysqli_query($db, "SELECT * FROM penguji") or die ($db->error);
                                        while($data_guru = mysqli_fetch_array($sql_guru)) {
                                            echo '<option value="'.$data_guru['id_penguji'].'">'.$data_guru['nama_lengkap'].'</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <input type="submit" name="simpan" value="Simpan" class="btn btn-success" /> 
                                    <button type="reset" class="btn btn-danger"> Reset</button>
                                </div>
                            </div>  
                        </form>
                        <?php
                        if(@$_POST['simpan']) {
                            $nama_ruang = @mysqli_real_escape_string($db, $_POST['kandidat']);
                            $ket = @mysqli_real_escape_string($db, $_POST['ket']);
                            mysqli_query($db, "UPDATE ruang_ajar SET id_ruang = '$kandidat', id_penguji = '$_SESSION[penguji]', keterangan = '$ket' WHERE id = '$id'") or die ($db->error);
                            echo "<script>window.location='?page=ruang';</script>";
                        }
                        ?>
                    </div>
                </div> 

            </div>
        </div>

    </div>

 <?php
    } else if(@$_GET['action'] == 'hapus') {
        mysqli_query($db, "DELETE FROM ruang_ajar WHERE id = '$id'") or die ($db->error);
        echo "<script>window.location='?page=ruang';</script>";
    }



 else if(@$_GET['action'] == 'detail') {
    $id_peserta = $_GET['id_peserta'];
    $sql1 = mysqli_query($db, "SELECT * FROM berkas NATURAL JOIN peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE id_peserta ='$id_peserta'");
    $data = mysqli_fetch_array($sql1);
    ?>

    
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
                        <td><img src="../../img/foto_peserta/<?php echo $data['foto']; ?>" width="200px" /></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><?php echo $data['username']; ?></td>
                    </tr>
                   
                </table>
            </div>
        </div>

    </div>
</div> 

<?php



 }
}?>





