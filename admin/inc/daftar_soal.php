<?php 
$sql_pilgan = mysqli_query($db, "SELECT * FROM soal_pilgan WHERE id_tq = '$id'") or die ($db->error);
$sql_essay = mysqli_query($db, "SELECT * FROM soal_essay WHERE id_tq = '$id'") or die ($db->error);
?>
<div class="row"> 

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                	<div class="card-header">
						Lihat Daftar Jenis Soal : <a href="?page=ujian&action=daftarsoal&hal=pilgan&id=<?php echo $id; ?>" class="badge badge-primary">Tetulis (<?php echo mysqli_num_rows($sql_pilgan); ?> soal)</a> 
						<a href="?page=ujian&action=daftarsoal&hal=essay&id=<?php echo $id; ?>" class="badge badge-primary">Wawancara (<?php echo mysqli_num_rows($sql_essay); ?> soal)</a>
						<a href="?page=ujian" class="badge badge-danger">Kembali</a> &nbsp; 
					</div>
					<?php
					if(@$_GET['hal'] == "pilgan" || @$_GET['hal'] == "essay") { ?>
					<div class="card-body">
						<fieldset>
							<legend>Informasi Ujian</legend>
							<?php
							$sql_tq = mysqli_query($db, "SELECT * FROM topik_ujian JOIN ruang ON topik_ujian.id_ruang = ruang.id_ruang JOIN bahan_ujian ON topik_ujian.id_bahan_ujian = bahan_ujian.id WHERE id_tq = '$id'") or die ($db->error);
							$data_tq = mysqli_fetch_array($sql_tq);
							?>
							<table align="center">
								<tr>
									<td>Judul</td>
									<td align="center" width="50px">:</td>
									<td><?php echo $data_tq['judul']; ?></td>
								</tr>
								<tr>
									<td>Ruangan</td>
									<td align="center" width="50px">:</td>
									<td><?php echo $data_tq['kandidat']; ?></td>
								</tr>
								<tr>
									<td>Bahan Ujian</td>
									<td align="center" width="50px">:</td>
									<td><?php echo $data_tq['bahan_ujian']; ?></td>
								</tr>
								<tr>
									<td>Waktu Pengerjaan</td>
									<td align="center" width="50px">:</td>
									<td><?php echo $data_tq['waktu_soal'] / 60 ." menit"; ?></td>
								</tr>
							</table>
						</fieldset>
					</div>
					<?php
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$idsoal = @$_GET['idsoal'];
$k = 1;
$ke = @$_GET['ke'];

if(@$_GET['hal'] == "pilgan") { ?>
<div class="row"> 

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                	<div class="card-header">
						Soal Pilihan Ganda &nbsp; <a href="?page=ujian&action=buatsoal&hal=soalpilgan&id=<?php echo $id; ?>" class="badge badge-primary">Tambah Soal Pilihan Ganda</a>
					</div>
					<div class="card-body">
						<?php
						if(mysqli_num_rows($sql_pilgan) > 0) {
							while($data_pilgan = mysqli_fetch_array($sql_pilgan)) { ?>
							<table width="100%">
							<tr>
								<td valign="top">Soal no. ( <?php echo $no++; ?> )</td>
								<td>
									<table class="table table-hover">
										<thead>
											<tr>
												<td width="20%"><b>Pertanyaan</b></td>
												<td>:</td>
												<td width="65%"><?php echo $data_pilgan['pertanyaan']; ?></td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Gambar</td>
												<td>:</td>
												<td>
													<?php
													if($data_pilgan['gambar'] != '') {
														echo '<img src="img/gambar_soal_pilgan/'.$data_pilgan['gambar'].'" width="200px" />';
													} else {
														echo "<i>Tidak ada gambar</i>";
													} ?>
												</td>
											</tr>
											<tr>
												<td>Pilihan A</td>
												<td>:</td>
												<td><?php echo $data_pilgan['pil_a']; ?></td>
											</tr>
											<tr>
												<td>Pilihan B</td>
												<td>:</td>
												<td><?php echo $data_pilgan['pil_b']; ?></td>
											</tr>
											<tr>
												<td>Pilihan C</td>
												<td>:</td>
												<td><?php echo $data_pilgan['pil_c']; ?></td>
											</tr>
											<tr>
												<td>Pilihan D</td>
												<td>:</td>
												<td><?php echo $data_pilgan['pil_d']; ?></td>
											</tr>
											<tr>
												<td>Pilihan E</td>
												<td>:</td>
												<td><?php echo $data_pilgan['pil_e']; ?></td>
											</tr>
											<tr>
												<td>Kunci</td>
												<td>:</td>
												<td><?php echo $data_pilgan['kunci']; ?></td>
											</tr>
											<tr>
												<td>Opsi</td>
												<td>:</td>
												<td>
													<a href="?page=ujian&action=daftarsoal&hal=editsoalpilgan&id=<?php echo $id; ?>&idsoal=<?php echo $data_pilgan['id_pilgan']; ?>&ke=<?php echo $k++; ?>" class="badge badge-success">Edit</a>
													<a onclick="return confirm('Yakin akan menghapus data?');" href="?page=ujian&action=daftarsoal&hal=hapussoalpilgan&id=<?php echo $id; ?>&idsoal=<?php echo $data_pilgan['id_pilgan']; ?>" class="badge badge-danger">Hapus</a>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
						</table>
						<?php
							}
						} else { ?>
							<div class="alert alert-danger">Data soal pilihan ganda tidak ditemukan</div>
							<?php
						} ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> 
<?php
} else if(@$_GET['hal'] == "essay") { ?>
<div class="row"> 

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                	<div class="card-header">
                		Soal Essay &nbsp; <a href="?page=ujian&action=buatsoal&hal=soalessay&id=<?php echo $id; ?>" class="badge badge-primary">Tambah Soal Wawancara</a>
                	</div> 
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Pertanyaan</th> 
										<th>Tanggal Pembuatan</th>
										<th>Opsi</th>
									</tr>
								</thead>
								<tbody>
								<?php
								if(mysqli_num_rows($sql_essay) > 0) {
									while($data_essay = mysqli_fetch_array($sql_essay)) { ?>
									<tr>
										<td align="center" width="40px"><?php echo $no++; ?></td>
										<td><?php echo $data_essay['pertanyaan']; ?></td> 
										<td align="center" width="160px"><?php echo tgl_indo($data_essay['tgl_buat']); ?></td>
										<td align="center" width="120px">
											<a href="?page=ujian&action=daftarsoal&hal=editsoalessay&id=<?php echo $id; ?>&idsoal=<?php echo $data_essay['id_essay']; ?>&ke=<?php echo $k++; ?>" class="badge badge-success">Edit</a>
											<a onclick="return confirm('Yakin akan menghapus data?');" href="?page=ujian&action=daftarsoal&hal=hapussoalessay&id=<?php echo $id; ?>&idsoal=<?php echo $data_essay['id_essay']; ?>" class="badge badge-danger">Hapus</a>
										</td>
									</tr>
									<?php
									}
								} else {
									echo '<td colspan="5" align="center">Data soal essay tidak ditemukan</td>';
								} ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php
} else if(@$_GET['hal'] == "editsoalpilgan") { ?>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Edit Soal Pilihan Ganda</div>
			<div class="panel-body">
			<?php
			$sql_pilgan_id = mysqli_query($db, "SELECT * FROM soal_pilgan WHERE id_pilgan = '$idsoal'") or die ($db->error);
			$data_pilgan_id = mysqli_fetch_array($sql_pilgan_id);
			?>
				<form method="post" enctype="multipart/form-data">
					<div class="col-md-2">
						<label>Pertanyaan No. [ <?php echo $ke; ?> ]</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pertanyaan" class="form-control" rows="2" required><?php echo $data_pilgan_id['pertanyaan']; ?></textarea>
						</div>
					</div>

					<div class="col-md-2">
						<label>Gambar <sup>(Optional)</sup></label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<input type="file" name="gambar" class="form-control" />
							<?php
							if($data_pilgan_id['gambar'] != '') {
								if(@$_GET['gbr'] != 'del') { ?>
									<div style="margin-top:5px;">
										<img width="150px" src="../admin/img/gambar_soal_pilgan/<?php echo $data_pilgan_id['gambar']; ?>" />
										<br /> <small><a href="?page=ujian&action=daftarsoal&hal=editsoalpilgan&id=<?php echo $id; ?>&idsoal=<?php echo $data_pilgan_id['id_pilgan']; ?>&ke=<?php echo $ke; ?>&gbr=del">Hapus Gambar</a></small>
									</div>
								<?php }
							} ?>
						</div>
					</div>
					
					<div class="col-md-2">
						<label>Pilihan A</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilA" class="form-control" rows="1" required><?php echo $data_pilgan_id['pil_a']; ?></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Pilihan B</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilB" class="form-control" rows="1" required><?php echo $data_pilgan_id['pil_b']; ?></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Pilihan C</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilC" class="form-control" rows="1" required><?php echo $data_pilgan_id['pil_c']; ?></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Pilihan D</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilD" class="form-control" rows="1" required><?php echo $data_pilgan_id['pil_d']; ?></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Pilihan E</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pilE" class="form-control" rows="1" required><?php echo $data_pilgan_id['pil_e']; ?></textarea>
						</div>
					</div>
					<div class="col-md-2">
						<label>Kunci Jawaban</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<label class="radio-inline">
								<input type="radio" name="kunci" value="A" <?php if($data_pilgan_id['kunci'] == 'A') { echo "checked"; } ?>>A
							</label>
							<label class="radio-inline">
								<input type="radio" name="kunci" value="B" <?php if($data_pilgan_id['kunci'] == 'B') { echo "checked"; } ?>>B
							</label>
							<label class="radio-inline">
								<input type="radio" name="kunci" value="C" <?php if($data_pilgan_id['kunci'] == 'C') { echo "checked"; } ?>>C
							</label>
							<label class="radio-inline">
								<input type="radio" name="kunci" value="D" <?php if($data_pilgan_id['kunci'] == 'D') { echo "checked"; } ?>>D
							</label>
							<label class="radio-inline">
								<input type="radio" name="kunci" value="E" <?php if($data_pilgan_id['kunci'] == 'E') { echo "checked"; } ?>>E
							</label>
						</div>
						<div class="form-group">
							<input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
							<input type="reset" value="Reset" class="btn btn-danger" />
						</div>
					</div>
				</form>
				<?php
				if(@$_POST['simpan']) {
					$pertanyaan = @mysqli_real_escape_string($db, $_POST['pertanyaan']);
					$pilA = @mysqli_real_escape_string($db, $_POST['pilA']);
					$pilB = @mysqli_real_escape_string($db, $_POST['pilB']);
					$pilC = @mysqli_real_escape_string($db, $_POST['pilC']);
					$pilD = @mysqli_real_escape_string($db, $_POST['pilD']);
					$pilE = @mysqli_real_escape_string($db, $_POST['pilE']);
					$kunci = @mysqli_real_escape_string($db, $_POST['kunci']);

					$sumber = @$_FILES['gambar']['tmp_name'];
					$target = 'img/gambar_soal_pilgan/';
					$nama_gambar = @$_FILES['gambar']['name'];

					if(@$_GET['gbr'] == 'del') {
						if($nama_gambar == '') {
							mysqli_query($db, "UPDATE soal_pilgan SET pertanyaan = '$pertanyaan', gambar = '', pil_a = '$pilA', pil_b = '$pilB', pil_c = '$pilC', pil_d = '$pilD', pil_e = '$pilE', kunci = '$kunci' WHERE id_pilgan = '$idsoal'") or die ($db->error);
							// echo "gambar benar2 dihapus";
						} else {
							move_uploaded_file($sumber, $target.$nama_gambar);
							mysqli_query($db, "UPDATE soal_pilgan SET pertanyaan = '$pertanyaan', gambar = '$nama_gambar', pil_a = '$pilA', pil_b = '$pilB', pil_c = '$pilC', pil_d = '$pilD', pil_e = '$pilE', kunci = '$kunci' WHERE id_pilgan = '$idsoal'") or die ($db->error);
							// echo "gambar dihapus dan diupload baru";
						}
					} else {
						if($nama_gambar == '') {
							mysqli_query($db, "UPDATE soal_pilgan SET pertanyaan = '$pertanyaan', pil_a = '$pilA', pil_b = '$pilB', pil_c = '$pilC', pil_d = '$pilD', pil_e = '$pilE', kunci = '$kunci' WHERE id_pilgan = '$idsoal'") or die ($db->error);          
							// echo "gambar tidak dihapus dan tidak diperbarui (tetap)";
						} else {
							move_uploaded_file($sumber, $target.$nama_gambar);
							mysqli_query($db, "UPDATE soal_pilgan SET pertanyaan = '$pertanyaan', gambar = '$nama_gambar', pil_a = '$pilA', pil_b = '$pilB', pil_c = '$pilC', pil_d = '$pilD', pil_e = '$pilE', kunci = '$kunci' WHERE id_pilgan = '$idsoal'") or die ($db->error);
							// echo "gambar diperbarui dari sebelumnya";
						}
					}
					echo "<script>window.location='?page=ujian&action=daftarsoal&hal=pilgan&id=".$id."';</script>";
				} ?>

			</div>
		</div>
	</div>
	<?php
} else if(@$_GET['hal'] == "hapussoalpilgan") {
	mysqli_query($db, "DELETE FROM soal_pilgan WHERE id_pilgan = '$idsoal'") or die ($db->error);
	echo "<script>window.location='?page=ujian&action=daftarsoal&hal=pilgan&id=".$id."';</script>";
} else if(@$_GET['hal'] == "editsoalessay") { ?>
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Edit Soal Wawancara</div>
			<div class="panel-body">
			<?php
			$sql_essay_id = mysqli_query($db, "SELECT * FROM soal_essay WHERE id_essay = '$idsoal'") or die ($db->error);
			$data_essay_id = mysqli_fetch_array($sql_essay_id);
			?>
				<form method="post" enctype="multipart/form-data">
					<div class="col-md-2">
						<label>Pertanyaan No. [ <?php echo $ke; ?> ]</label>
					</div>
					<div class="col-md-10">
						<div class="form-group">
							<textarea name="pertanyaan" class="form-control" rows="3" required><?php echo $data_essay_id['pertanyaan']; ?></textarea>
						</div>
					</div> 
					<div class="col-md-10"> 
						<div class="form-group">
	                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success" />
	                        <input type="reset" value="Reset" class="btn btn-danger" />
	                    </div>
					</div>
	            </form>
	            <?php
	            if(@$_POST['simpan']) {
	            	$pertanyaan = @mysqli_real_escape_string($db, $_POST['pertanyaan']);

	            	$sumber = @$_FILES['gambar']['tmp_name'];
                    $target = 'img/gambar_soal_essay/';
                    $nama_gambar = @$_FILES['gambar']['name'];

                    if(@$_GET['gbr'] == 'del') {
						if($nama_gambar == '') {
							mysqli_query($db, "UPDATE soal_essay SET pertanyaan = '$pertanyaan', gambar = '' WHERE id_essay = '$idsoal'") or die ($db->error);
							// echo "gambar benar2 dihapus";
						} else {
							move_uploaded_file($sumber, $target.$nama_gambar);
							mysqli_query($db, "UPDATE soal_essay SET pertanyaan = '$pertanyaan', gambar = '$nama_gambar' WHERE id_essay = '$idsoal'") or die ($db->error);
							// echo "gambar dihapus dan diupload baru";
						}
					} else {
						if($nama_gambar == '') {
							mysqli_query($db, "UPDATE soal_essay SET pertanyaan = '$pertanyaan' WHERE id_essay = '$idsoal'") or die ($db->error); 
							// echo "gambar tidak dihapus dan tidak diperbarui (tetap)";
						} else {
							move_uploaded_file($sumber, $target.$nama_gambar);
							mysqli_query($db, "UPDATE soal_essay SET pertanyaan = '$pertanyaan', gambar = '$nama_gambar' WHERE id_essay = '$idsoal'") or die ($db->error);
							// echo "gambar diperbarui dari sebelumnya";
						}
					}        
                    echo '<script>window.location="?page=ujian&action=daftarsoal&hal=essay&id='.$id.'"</script>';
	            } ?>

			</div>
		</div>
	</div>
	<?php
} else if(@$_GET['hal'] == "hapussoalessay") {
	mysqli_query($db, "DELETE FROM soal_essay WHERE id_essay = '$idsoal'") or die ($db->error);
	echo "<script>window.location='?page=ujian&action=daftarsoal&hal=essay&id=".$id."';</script>";
} ?>