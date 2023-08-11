<?php
if(@$_SESSION['penguji']) { ?>

<div class="page-header">
    <div>
        <h3>Penilaian Tes</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li> 
                <li class="breadcrumb-item active" aria-current="page">Penilaian Tes</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
	<?php
    $id = @$_GET['id'];
    $sql_per_id = mysqli_query($db, "SELECT * FROM penguji WHERE id_penguji = '$id'") or die ($db->error);
    $data = mysqli_fetch_array($sql_per_id);

    if(@$_GET['action'] == '') { ?>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                	<div class="card-header">
                		<h5>Data Penilaian | 
                        <form action="" method="post">
                                                    <select name="ruang" class="single-field" required>
                                                        <option value="">- Pilih Jabatan-</option>
                                                        <?php
                                                        ini_set('display_errors', 1);
                                                        ini_set('display_startup_errors', 1);
                                                        error_reporting(E_ALL);
                                                        $sql_kelas = mysqli_query($db, "SELECT * from ruang") or die ($db->error);
                                                        while($data_kelas = mysqli_fetch_array($sql_kelas)) {
                                                            echo '<option value="'.$data_kelas['id_ruang'].'">'.$data_kelas['kandidat'].' - '.$data_kelas['ruangan'].'</option>';
                                                        } ?>
                                                    </select>
                                                    
                                                        <button type="submit" name="pilih" class="btn btn-info">Pilih</button>

                                                    </form>
                        </h5>
                	</div>
                    <?php if(isset($_POST['pilih'])){ ?>
                        
                    <div class="card-body">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Nilai Tertulis</th>
                                    <th>Nilai Wawancara</th>
                                    <th>Nilai Total</th>
                                    <th>Status</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $id_ruang = $_POST['ruang'];
                                $sql_siswa_mengikuti_tes = mysqli_query($db, "SELECT * FROM peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE peserta.id_ruang = '$id_ruang' ") or die ($db->error);
                                if(mysqli_num_rows($sql_siswa_mengikuti_tes) > 0) {
                                    while($data_siswa_mengikuti_tes = mysqli_fetch_array($sql_siswa_mengikuti_tes)) {
                                        ?>
                                        <tr>
                                            <td align="center" width="40px"><?php echo $no++; ?></td>
                                            <td><?php echo $data_siswa_mengikuti_tes['nik']; ?></td>
                                            <td><?php echo $data_siswa_mengikuti_tes['nama_lengkap']; ?></td>
                                            <td><?php echo $data_siswa_mengikuti_tes['kandidat']; ?></td>
                                            <?php
                                            $sql_pilgan = mysqli_query($db, "SELECT * FROM nilai_pilgan WHERE id_peserta = '$data_siswa_mengikuti_tes[id_peserta]'") or die ($db->error);$data_pilgan = mysqli_fetch_array($sql_pilgan);

                                            $sql_essay = mysqli_query($db, "SELECT * FROM nilai_essay WHERE id_peserta = '$data_siswa_mengikuti_tes[id_peserta]'") or die ($db->error);
                                            $data_essay = mysqli_fetch_array($sql_essay);
                                            $total = $data_pilgan['presentase'] * 0.3 + $data_essay['nilai'] * 0.7;
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
                                    <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="6" align="center">Data tidak ditemukan</td></tr>';
                                } ?>
                            </tbody> 
                        </table> 
                    </div>
                           <?php } ?> 
                </div> 
            </div>
        </div>
    </div>

    <?php } else if(@$_GET['action'] == 'detail') { ?>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header">
                        <h5>Data Penguji | <a href="?page=penguji" class="badge badge-warning">Kembali</a></h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">  
                        	<tr>
                        		<td align="right" width="46%"><b>NIP</b></td>
                        		<td align="center">:</td>
                        		<td width="46%"><?php echo $data['nip']; ?></td>
                                <td rowspan="12">
                                    <img width="250px" src="../admin/img/foto_penguji/<?php echo $data['foto']; ?>" />
                                </td>
                        	</tr>
                        	<tr>
                        		<td align="right"><b>Nama Lengkap</b></td>
                        		<td align="center">:</td>
                        		<td><?php echo $data['nama_lengkap']; ?></td>
                        	</tr>
                        	<tr>
                        		<td align="right"><b>Tempat Tanggal Lahir</b></td>
                        		<td align="center">:</td>
                        		<td><?php echo $data['tempat_lahir'].", ".tgl_indo($data['tgl_lahir']); ?></td>
                        	</tr>
                        	<tr>
                        		<td align="right"><b>Jenis Kelamin</b></td>
                        		<td align="center">:</td>
                        		<td><?php if($data['jenis_kelamin'] == 'L') { echo "Laki-laki"; } else { echo "Perempuan"; } ?></td>
                        	</tr>
                        	<tr>
                        		<td align="right"><b>Agama</b></td>
                        		<td align="center">:</td>
                        		<td><?php echo $data['agama']; ?></td>
                        	</tr>
                        	<tr>
                        		<td align="right"><b>Nomor Telepon</b></td>
                        		<td align="center">:</td>
                        		<td><?php echo $data['no_telp']; ?></td>
                        	</tr>
                        	<tr>
                        		<td align="right"><b>Email</b></td>
                        		<td align="center">:</td>
                        		<td><?php echo $data['email']; ?></td>
                        	</tr>
                        	<tr>
                        		<td align="right"><b>Alamat</b></td>
                        		<td align="center">:</td>
                        		<td><?php echo $data['alamat']; ?></td>
                        	</tr>
                        	<tr>
                        		<td align="right"><b>Jabatan</b></td>
                        		<td align="center">:</td>
                        		<td><?php echo $data['jabatan']; ?></td>
                        	</tr> 
                        	<tr>
                        		<td align="right"><b>Username</b></td>
                        		<td align="center">:</td>
                        		<td><?php echo $data['username']; ?></td>
                        	</tr>
                        	<tr>
                        		<td align="right"><b>Password</b></td>
                        		<td align="center">:</td>
                        		<td><?php echo $data['pass']; ?></td>
                        	</tr>
                        	<tr>
                        		<td align="right"><b>Status</b></td>
                        		<td align="center">:</td>
                        		<td><?php echo ucfirst($data['status']); ?></td>
                        	</tr>
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
                        <h5>Tambah Data Penilaian | <a href="?page=penilaian" class="badge badge-warning">Kembali</a></h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="?page=penilaian&action=prosestambah" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Peserta</label>
                                <div class="col-sm-10">
                                    <select name="id_peserta" class="form-control" required>
                                        <option>Pilih</option>
										<?php
		                                $sql_kar=mysqli_query($db, "SELECT * FROM peserta ORDER BY id_peserta DESC");
		                                while ($kar=mysqli_fetch_array($sql_kar))
		                                {
		                                	echo "<option value='$kar[id_peserta]'>$kar[nik] - $kar[nama_lengkap]</option>";
		                                }
		                                ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nilai Tertulis</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="n_tertulis" onkeyup="sum()" id="n_tertulis" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nilai Wawancara</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="n_wawancara" onkeyup="sum()" id="n_wawancara" required>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <button type="submit" name="simpan" class="btn btn-success"> Simpan</button>
                                    <button type="reset" class="btn btn-danger"> Reset</button>
                                </div>
                            </div>   
                        </form>
                    </div>
                </div> 

            </div>
        </div>

    </div>

    <?php
	} else if(@$_GET['action'] == 'prosestambah') {
    $id_peserta = @mysqli_real_escape_string($db, $_POST['id_peserta']);
    $n_tertulis = @mysqli_real_escape_string($db, $_POST['n_tertulis']);
    $n_wawancara = @mysqli_real_escape_string($db, $_POST['n_wawancara']);
    $totalRata = $n_tertulis + $n_wawancara;

    $n_total = $totalRata / 2;

      if ($n_total>=90)
      $grade=("A") and $status_nilai = ("");
      else
      if ($n_total>=75)
      $grade=("B") and $status_nilai = ("");
      else 
      if ($n_total>=60)
      $grade=("C") and $status_nilai = ("");
      else
      if ($n_total>=50)
      $grade=("D") and $status_nilai = ("");
     
    {
        mysqli_query($db, "INSERT INTO penilaian VALUES('', '$id_peserta', '$n_tertulis', '$n_wawancara', '$n_total', '$status_nilai')") or die ($db->error);
        echo '<script>window.location="?page=penilaian";</script>';
    }
	} else if(@$_GET['action'] == 'edit') { ?>

	<div class="col-md-12"></div>

        <?php
    } else if(@$_GET['action'] == 'prosesedit') {
        $nip = @mysqli_real_escape_string($db, $_POST['nip']);
        $nama_lengkap = @mysqli_real_escape_string($db, $_POST['nama_lengkap']);
        $tempat_lahir = @mysqli_real_escape_string($db, $_POST['tempat_lahir']);
        $tgl_lahir = @mysqli_real_escape_string($db, $_POST['tgl_lahir']);
        $jenis_kelamin = @mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
        $agama = @mysqli_real_escape_string($db, $_POST['agama']);
        $no_telp = @mysqli_real_escape_string($db, $_POST['no_telp']);
        $email = @mysqli_real_escape_string($db, $_POST['email']);
        $alamat = @mysqli_real_escape_string($db, $_POST['alamat']);
        $jabatan = @mysqli_real_escape_string($db, $_POST['jabatan']); 
        $username = @mysqli_real_escape_string($db, $_POST['username']);
        $password = @mysqli_real_escape_string($db, $_POST['password']);
        $status = @mysqli_real_escape_string($db, $_POST['status']);

        $sumber = @$_FILES['gambar']['tmp_name'];
        $target = 'img/foto_penguji/';
        $nama_gambar = @$_FILES['gambar']['name'];

        if($nama_gambar == '') {
            mysqli_query($db, "UPDATE penguji SET nip = '$nip', nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', no_telp = '$no_telp', email = '$email', alamat = '$alamat', jabatan = '$jabatan', username = '$username', password = md5('$password'), pass = '$password', status = '$status' WHERE id_penguji = '$id'") or die ($db->error);           
            echo '<script>window.location="?page=penguji";</script>';
        } else {
            if(move_uploaded_file($sumber, $target.$nama_gambar)) {
                mysqli_query($db, "UPDATE penguji SET nip = '$nip', nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', no_telp = '$no_telp', email = '$email', alamat = '$alamat', jabatan = '$jabatan', foto = '$nama_gambar', username = '$username', password = md5('$password'), pass = '$password', status = '$status' WHERE id_penguji = '$id'") or die ($db->error);            
                echo '<script>window.location="?page=penguji";</script>';
            } else {
                echo '<script>alert("Gagal mengedit data penguji, foto gagal diupload, coba lagi!"); window.location="?page=penguji";</script>';
            }
        }
    } else if(@$_GET['action'] == 'hapus') {
        mysqli_query($db, "DELETE FROM penilaian WHERE id_nilai = '$id_nilai'") or die ($db->error);
        echo '<script>window.location="?page=penilaian";</script>';
    }
    ?>
</div>

<?php
} else { ?>
	<div class="row">
	    <div class="col-xs-12">
	        <div class="alert alert-danger">Maaf Anda tidak punya hak akses masuk halaman ini!</div>
	    </div>
	</div>
	<?php
} ?>
 