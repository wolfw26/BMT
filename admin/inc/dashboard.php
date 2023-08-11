<?php
  $sql = $db->query("SELECT COUNT(id) as tot_bahanujian  from bahan_ujian");
  while ($data= $sql->fetch_assoc()) {
    $bahanujian=$data['tot_bahanujian'];
  }
  
  $sql = $db->query("SELECT COUNT(id_penguji) as tot_penguji  from penguji");
  while ($data= $sql->fetch_assoc()) {
    $penguji=$data['tot_penguji'];
  }
  
  $sql = $db->query("SELECT COUNT(id_peserta) as tot_calon  from peserta");
  while ($data= $sql->fetch_assoc()) {
    $peserta=$data['tot_calon'];
  }
  
  $sql = $db->query("SELECT COUNT(id_ruang) as tot_jabatan  from ruang");
  while ($data= $sql->fetch_assoc()) {
    $jabatan=$data['tot_jabatan'];
  }
  
//   $sql = $koneksi->query("SELECT COUNT(id_tb) as tot_paketwisata  from tb_paketwisata");
//   while ($data= $sql->fetch_assoc()) {
//     $paketwisata=$data['tot_paketwisata'];
//   }
?>

<div class="row">
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-info">
			<div class="inner">
				<h5>
					<?php echo $bahanujian; ?>
				</h5>

				<p>Jumlah Data Ujian</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="?page=bahan_ujian" class="small-box-footer">Selengkapnya
            <i data-feather="database"></i>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-success">
			<div class="inner">
				<h5>
					<?php echo $penguji; ?>
				</h5>

				<p>Jumlah Data Penguji</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="?page=penguji" class="small-box-footer">Selengkapnya
            <i data-feather="database"></i>
			</a>
		</div>
	</div>
	
		<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-danger">
			<div class="inner">
				<h5>
					<?php echo $peserta; ?>
				</h5>

				<p>Jumlah Calon Karyawan</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="?page=peserta" class="small-box-footer">Selengkapnya
            <i data-feather="database"></i>
			</a>
		</div>
	</div>
	
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-secondary">
			<div class="inner">
				<h5>
					<?php echo $jabatan; ?>
				</h5>

				<p>Jumlah Jabatan</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="?page=ruang" class="small-box-footer">Selengkapnya
            <i data-feather="database"></i>
			</a>
		</div>
	</div>
	
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<!-- <div class="small-box bg-warning">
			<div class="inner">
				<h5>
					<?php echo $paketwisata; ?>
				</h5>

				<p>Jumlah Paket Wisata Terdaftar</p>
			</div>
			<div class="icon">
				<i class="ion ion-stats-bars"></i>
			</div>
			<a href="" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div> -->
	</div>