<?php
if (@$_SESSION['admin']) { ?>

    <div class="page-header">
        <div>
            <h3>Jadwal Pelatihan Karyawan</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Data Pelatihan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <?php
        $id = @$_GET['id'];
        $sql_per_id = mysqli_query($db, "SELECT * FROM peserta WHERE id_peserta= '$id'") or die($db->error);
        $data = mysqli_fetch_array($sql_per_id);

        if (@$_GET['action'] == '') { ?>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Data Pelatihan | <a href="?page=pelatihan&action=tambah" class="badge badge-primary">Tambah</a></h5>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Karyawan</th>
                                            <th>Total Nilai/Grade</th>
                                            <th>Status</th>
                                            <th>Tanggal Pelatihan</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $sql_pelatihan = $db->query("SELECT p.*, ps.nama_lengkap, n.* 
                                        FROM pelatihan p
                                        JOIN peserta ps ON p.id_peserta = ps.id_peserta
                                        JOIN penilaian n ON p.id_nilai = n.id_nilai");
                                        if (mysqli_num_rows($sql_pelatihan) > 0) {
                                            while ($data_pelatihan = $sql_pelatihan->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?= $data_pelatihan['nama_lengkap']; ?></td>
                                                    <td><?= $data_pelatihan['n_total']; ?> / <?= $data_pelatihan['grade']; ?></td>
                                                    <td><?= $data_pelatihan['status_nilai']; ?></td>
                                                    <td><?= date("d F Y", strtotime($data_pelatihan['tgl_mulai'])); ?></td>
                                                    <td><?= date("d F Y", strtotime($data_pelatihan['tgl_selesai'])); ?></td>
                                                    <td align="center" width="170px">
                                                        <a href="?page=pelatihan&action=edit&id=<?php echo $data_pelatihan['id']; ?>" class="badge badge-success text-white">Edit</a>
                                                        <a onclick="return confirm('Yakin akan menghapus data pelatihan?');" href="?page=pelatihan&action=hapus&id=<?php echo $data_pelatihan['id']; ?>" class="badge text-white badge-danger">Hapus</a>
                                                        <a href="?page=pelatihan&action=detail&id=<?php echo $data_pelatihan['id']; ?>" class="badge badge-info text-white">Detail</a>
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6" align="center">Data tidak ditemukan</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--<?php } else if (@$_GET['action'] == 'detail') { ?>

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
                                    <img width="150px" src="../admin/img/foto_penguji/<?php echo $data['foto']; ?>" />
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
                        		<td><?php echo $data['tempat_lahir'] . ", " . tgl_indo($data['tgl_lahir']); ?></td>
                        	</tr>
                        	<tr>
                        		<td align="right"><b>Jenis Kelamin</b></td>
                        		<td align="center">:</td>
                        		<td><?php if ($data['jenis_kelamin'] == 'L') {
                                        echo "Laki-laki";
                                    } else {
                                        echo "Perempuan";
                                    } ?></td>
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
	
	<!--<?php } else if (@$_GET['action'] == 'tambah') { ?>
	
	<div class="col-md-12">

        <div class="row">
            <div class="col-md-12"> 

                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Data Penguji | <a href="?page=penguji" class="badge badge-warning">Kembali</a></h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="?page=penguji&action=prosestambah" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nip" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_lengkap" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tempat_lahir" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tgl_lahir" required>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">- Pilih -</option>
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-10">
                                    <select name="agama" class="form-control" required>
                                        <option value="">- Pilih Agama-</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katholik">Katholik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no_telp" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jabatan" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="foto" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status Akun</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control" required>
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak aktif">Tidak Aktif</option> 
                                    </select>
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
            } else if (@$_GET['action'] == 'prosestambah') {
                $nip           = @mysqli_real_escape_string($db, $_POST['nip']);
                $nama_lengkap  = @mysqli_real_escape_string($db, $_POST['nama_lengkap']);
                $tempat_lahir  = @mysqli_real_escape_string($db, $_POST['tempat_lahir']);
                $tgl_lahir     = @mysqli_real_escape_string($db, $_POST['tgl_lahir']);
                $jenis_kelamin = @mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
                $agama         = @mysqli_real_escape_string($db, $_POST['agama']);
                $no_telp       = @mysqli_real_escape_string($db, $_POST['no_telp']);
                $email         = @mysqli_real_escape_string($db, $_POST['email']);
                $alamat        = @mysqli_real_escape_string($db, $_POST['alamat']);
                $jabatan       = @mysqli_real_escape_string($db, $_POST['jabatan']);
                $foto          = @$_FILES['foto']['name'];
                $lokasi        = @$_FILES['foto']['tmp_name'];
                move_uploaded_file($lokasi, "img/foto_penguji/" . $foto);
                $username      = @mysqli_real_escape_string($db, $_POST['username']);
                $password      = @mysqli_real_escape_string($db, $_POST['password']);
                $status        = @mysqli_real_escape_string($db, $_POST['status']);

                $sumber = @$_FILES['foto']['tmp_name'];
                $target = 'img/foto_penguji/';
                $nama_gambar = @$_FILES['foto']['name'];

                if ($nama_foto != '') {
                    if (move_uploaded_file($sumber, $target . $nama_foto)) {
                        mysqli_query($db, "INSERT INTO penguji VALUES('', '$nip', '$nama_lengkap', '$tempat_lahir', '$tgl_lahir', '$jenis_kelamin', '$agama', '$no_telp', '$email', '$alamat', '$jabatan', '$nama_gambar', '$username', md5('$password'), '$password', '$status')") or die($db->error);
                        echo '<script>window.location="?page=penguji";</script>';
                    } else {
                        echo '<script>alert("Gagal menambah data penguji, foto gagal diupload, coba lagi!"); window.location="?page=penguji";</script>';
                    }
                } else {
                    mysqli_query($db, "INSERT INTO penguji VALUES('', '$nip', '$nama_lengkap', '$tempat_lahir', '$tgl_lahir', '$jenis_kelamin', '$agama', '$no_telp', '$email', '$alamat', '$jabatan', '$nama_gambar', '$username', md5('$password'), '$password', '$status')") or die($db->error);
                    echo '<script>window.location="?page=penguji";</script>';
                }
            } else if (@$_GET['action'] == 'edit') { ?>

	<div class="col-md-12">

        <div class="row">
            <div class="col-md-12"> 

                <div class="card">
                    <div class="card-header">
                        <h5>Ubah Data Penguji | <a href="?page=penguji" class="badge badge-warning">Kembali</a></h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="?page=penguji&action=prosesedit&id=<?php echo $data['id_penguji']; ?>" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">NIP</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nip" value="<?php echo $data['nip']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama_lengkap" value="<?php echo $data['nama_lengkap']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $data['tempat_lahir']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $data['tgl_lahir']; ?>" required>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="L">Laki-laki</option>
                                        <option value="P" <?php if ($data['jenis_kelamin'] == 'P') {
                                                                echo "selected";
                                                            } ?>>Perempuan</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Agama</label>
                                <div class="col-sm-10">
                                    <select name="agama" class="form-control" required>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen" <?php if ($data['agama'] == 'Kristen') {
                                                                    echo "selected";
                                                                } ?>>Kristen</option>
                                        <option value="Katholik" <?php if ($data['agama'] == 'Katholik') {
                                                                        echo "selected";
                                                                    } ?>>Katholik</option>
                                        <option value="Hindu" <?php if ($data['agama'] == 'Hindu') {
                                                                    echo "selected";
                                                                } ?>>Hindu</option>
                                        <option value="Budha" <?php if ($data['agama'] == 'Budha') {
                                                                    echo "selected";
                                                                } ?>>Budha</option>
                                    
                                    </select>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="no_telp" value="<?php echo $data['no_telp']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="alamat" value="<?php echo $data['alamat']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jabatan" value="<?php echo $data['jabatan']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Foto</label>
                                <div class="col-sm-10">
                                    <div style="padding:0 0 5px 0;"><img width="200px" src="img/foto_penguji/<?php echo $data['foto']; ?>" /></div>
                                    <input type="file" name="foto" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="password" value="<?php echo $data['pass']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status Akun</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control" required>
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak aktif" <?php if ($data['status'] == 'tidak aktif') {
                                                                        echo "selected";
                                                                    } ?>>Tidak Aktif</option>
                                    </select>
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
            } else if (@$_GET['action'] == 'prosesedit') {
                $nip           = @mysqli_real_escape_string($db, $_POST['nip']);
                $nama_lengkap  = @mysqli_real_escape_string($db, $_POST['nama_lengkap']);
                $tempat_lahir  = @mysqli_real_escape_string($db, $_POST['tempat_lahir']);
                $tgl_lahir     = @mysqli_real_escape_string($db, $_POST['tgl_lahir']);
                $jenis_kelamin = @mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
                $agama         = @mysqli_real_escape_string($db, $_POST['agama']);
                $no_telp       = @mysqli_real_escape_string($db, $_POST['no_telp']);
                $email         = @mysqli_real_escape_string($db, $_POST['email']);
                $alamat        = @mysqli_real_escape_string($db, $_POST['alamat']);
                $jabatan       = @mysqli_real_escape_string($db, $_POST['jabatan']);
                $foto          = @$_FILES['foto']['name'];
                $lokasi        = @$_FILES['foto']['tmp_name'];
                move_uploaded_file($lokasi, "img/foto_penguji/" . $foto);
                $username      = @mysqli_real_escape_string($db, $_POST['username']);
                $password      = @mysqli_real_escape_string($db, $_POST['password']);
                $status        = @mysqli_real_escape_string($db, $_POST['status']);

                $sumber = @$_FILES['foto']['tmp_name'];
                $target = 'img/foto_penguji/';
                $nama_gambar = @$_FILES['foto']['name'];

                if ($nama_foto == '') {
                    mysqli_query($db, "UPDATE penguji SET nip = '$nip', nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', no_telp = '$no_telp', email = '$email', alamat = '$alamat', jabatan = '$jabatan',foto = '$nama_gambar', username = '$username', password = md5('$password'), pass = '$password', status = '$status' WHERE id_penguji = '$id'") or die($db->error);
                    echo '<script>window.location="?page=penguji";</script>';
                } else {
                    if (move_uploaded_file($sumber, $target . $nama_foto)) {
                        mysqli_query($db, "UPDATE penguji SET nip = '$nip', nama_lengkap = '$nama_lengkap', tempat_lahir = '$tempat_lahir', tgl_lahir = '$tgl_lahir', jenis_kelamin = '$jenis_kelamin', agama = '$agama', no_telp = '$no_telp', email = '$email', alamat = '$alamat', jabatan = '$jabatan', foto = '$nama_gambar', username = '$username', password = md5('$password'), pass = '$password', status = '$status' WHERE id_penguji = '$id'") or die($db->error);
                        echo '<script>window.location="?page=penguji";</script>';
                    } else {
                        echo '<script>alert("Gagal mengedit data penguji, foto gagal diupload, coba lagi!"); window.location="?page=penguji";</script>';
                    }
                }
            } else if (@$_GET['action'] == 'hapus') {
                mysqli_query($db, "DELETE FROM penguji WHERE id_penguji = '$id'") or die($db->error);
                echo '<script>window.location="?page=penguji";</script>';
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