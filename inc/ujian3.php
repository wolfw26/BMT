<?php
$id = @$_GET['id'];
$no = 1;

if(@$_GET['action'] != 'kerjakansoal') { ?>
	<div class="row">
	    <div class="col-lg-12 order-1 order-lg-2">  

	        <div class="card">
	            <div class="card-header">
	                <h5>Ujian </h5>
	            </div> 
	        </div> 

	    </div>	 
	</div>
 
<?php
}

if(@$_GET['action'] == '') { ?>

	<div class="row">
	    <div class="col-lg-12 order-1 order-lg-2">  

	        <div class="card">
	            <div class="card-header">
	                <h5>Data Bahan Ujian</h5>
	            </div> 
	            <div class="card-body">
	            	<?php if ($data_log['status_berkas']=="Lanjut Tahap 2"): ?>
	            	<table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ujian Tahap 2 (Tertulis)</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql_mapel = mysqli_query($db, "SELECT * FROM bahan_ujian WHERE bahan_ujian='Tertulis'") or die ($db->error);
                        while($data_mapel = mysqli_fetch_array($sql_mapel)) { ?>
                            <tr>
                                <td width="40px" align="center"><?php echo $no++; ?></td>
                                <td><?php echo $data_mapel['bahan_ujian']; ?></td>
                                <td width="200px" align="center">
                                	<a href="?page=ujian3&action=daftartopik&id_bahan_ujian=<?php echo $data_mapel['id']; ?>">Lihat Quiz</a>
                                </td>
                            </tr>
                        	<?php
                        } ?>
                        </tbody>
                    </table>
                    <?php endif ?>
                    <?php if ($data_log['status_berkas']=="Lanjut Tahap 3"): ?>
	            	<table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Ujian Tahap 3 (Wawancara)</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql_mapel = mysqli_query($db, "SELECT * FROM bahan_ujian WHERE bahan_ujian='Wawancara'") or die ($db->error);
                        while($data_mapel = mysqli_fetch_array($sql_mapel)) { ?>
                            <tr>
                                <td width="40px" align="center"><?php echo $no++; ?></td>
                                <td><?php echo $data_mapel['bahan_ujian']; ?></td>
                                <td width="200px" align="center">
                                	<a href="?page=ujian3&action=daftartopik&id_bahan_ujian=2">Lihat Quiz</a>
                                </td>
                            </tr>
                        	<?php
                        } ?>
                        </tbody>
                    </table>
                    <?php endif ?>
	            </div>
	        </div> 

	    </div>	 
	</div> 

<?php
} else if(@$_GET['action'] == 'daftartopik') { ?>
	<div class="row">
	    <div class="col-lg-12 order-1 order-lg-2">  

	        <div class="card"> 
	            <div class="card-body">
	            	<div class="table-responsive">
	            		<?php
						$id_bahan_ujian = @$_GET['id_bahan_ujian'];
						$sql_tq = mysqli_query($db, "SELECT * FROM topik_ujian WHERE id_bahan_ujian = '$id_bahan_ujian' AND id_ruang = '$data_terlogin[id_ruang]' AND status = 'aktif'") or die ($db->error);
						if(mysqli_num_rows($sql_tq) > 0) {
							while($data_tq = mysqli_fetch_array($sql_tq)) { ?>
							<table width="100%">
								<tr>
									<td valign="top">No. ( <?php echo $no++; ?> )</td>
									<td>
										<table class="table">
										    <thead>
										        <tr>
										            <td width="20%"><b>Judul</b></td>
										            <td>:</td>
										            <td width="65%"><?php echo $data_tq['judul']; ?></td>
										        </tr>
										    </thead>
										    <tbody>
										        <tr>
										            <td>Tanggal Pembuatan</td>
										            <td>:</td>
										            <td><?php echo tgl_indo($data_tq['tgl_buat']); ?></td>
										        </tr>
										        <tr>
										            <td>Pembuat</td>
										            <td>:</td>
										            <td>
										            	<?php
										            	if($data_tq['pembuat'] != 'admin') {
										            		$sql_peng = mysqli_query($db, "SELECT * FROM penguji WHERE id_penguji = '$data_tq[pembuat]'") or die ($db->error);
										            		$data_peng = mysqli_fetch_array($sql_peng);
										            		echo $data_peng['nama_lengkap'];
										            	} else {
										            		echo $data_tq['pembuat'];
										            	} ?>
										            </td>
										        </tr>
										        <tr>
										            <td>Waktu Pengerjaan</td>
										            <td>:</td>
										            <td><?php echo $data_tq['waktu_soal'] / 60 ." menit"; ?></td>
										        </tr>
										        <tr>
										            <td>Info</td>
										            <td>:</td>
										            <td><?php echo $data_tq['info']; ?></td>
										        </tr>
										        <tr>
										        	<td></td>
										        	<td></td>
										        	<td>
										        		<a href="?page=ujian3&action=infokerjakan&id_tq=<?php echo $data_tq['id_tq']; ?>">Kerjakan Soal</a>
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
							<div class="alert alert-danger">Data ujian yang berada di ruangan ini dengan bahan_ujian tersebut tidak ada</div>
							<?php
						} ?>
	            	</div>
	            </div> 
	        </div>
	    </div>
	</div>


	<?php
} else if(@$_GET['action'] == 'infokerjakan') { ?>
	<div class="row">
	    <div class="col-lg-12 order-1 order-lg-2">  

	        <div class="card"> 
	        	<div class="card-header">
	        		<h5>Informasi Ujian</h5>
	        	</div>
	        	<div class="card-body"> 
						1. Pray before you start working on your paper test.<br />
						2. Read the questions and instructions carefully,<br />
						3. Ask the supervisor if you read unclear questions,<br />
						4. Cheating is highly ptohibites. If you are caught cheating, you will be send out of the classroom and will not be allowed to continue the test,<br />
						5.You are not allowed to collaborated with anyone in the test,<br/>
						6.Double check your answer sheet. Please reread your answer sheet carefully. You are expected to answer all teh quesions provided on question sheet,<br/>
						7.Submit your answer sheet by the end of the test.<br/>
						8. WARNING !!!. Don't relod Or Refresh 
	        	</div>
	        	<div class="card-footer">
	        		<?php
					if(mysqli_num_rows($sql_nilai) > 0 || mysqli_num_rows($sql_jwb) > 0) { ?>
						<a href="?page=ujian3" >Kembali</a>
						<?php
					} else {
						 
						$sql_cek_soal_essay = mysqli_query($db, "SELECT * FROM soal_essay WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
						if(mysqli_num_rows($sql_cek_soal_essay) > 0) { ?>
							<a href="soal_3.php?id_tq=<?php echo @$_GET['id_tq']; ?>" >Mulai Mengerjakan</a> &nbsp;&nbsp;&nbsp;
						<?php
						} else { ?>
							<a onclick="alert('Data soal tidak ditemukan, mungkin karena belum dibuat. Silahkan hubungi guru yang bersangkutan');" >Mulai Mengerjakan</a>
						<?php
						} ?>
						<a href="?page=ujian3" >Kembali</a>
					<?php
					} ?>
	        	</div>
	 
	<?php
} 
?>