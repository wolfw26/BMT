<div class="page-header">
    <div>
        <h3>Data Calon Karyawan Registrasi</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li> 
                <li class="breadcrumb-item active" aria-current="page">Calon Karyawan Registrasi</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
 
	<?php
    $no = 1;
    $id = @$_GET['id'];

    if(@$_SESSION['admin']) {

    if(@$_GET['action'] == '') { ?>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                	<div class="card-header">
                		<h4>Data Calon Karyawan Registrasi (Mendaftar)</h4>
                	</div>
                    <div class="card-body">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th> 
                                    <th>TTL</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_siswa = mysqli_query($db, "SELECT * FROM peserta WHERE status = 'tidak aktif'") or die ($db->error);
                            if(mysqli_num_rows($sql_siswa) > 0) {
                                while($data_siswa = mysqli_fetch_array($sql_siswa)) { ?>
                                    <tr>
                                        <td align="center"><?php echo $no++; ?></td>
                                        <td><?php echo $data_siswa['nik']; ?></td>
                                        <td><?php echo $data_siswa['nama_lengkap']; ?></td> 
                                        <td><?php echo $data_siswa['tempat_lahir'].", ".tgl_indo($data_siswa['tgl_lahir']); ?></td>
                                        <td><?php echo $data_siswa['alamat']; ?></td>
                                        <td><?php echo ucfirst($data_siswa['status']); ?></td>
                                        <td align="center" width="200px">
                                            <a href="?page=pesertaregistrasi&action=aktifkan&id=<?php echo $data_siswa['id_peserta']; ?>" class="badge badge-success">Aktifkan</a>
                                            <a onclick="return confirm('Yakin akan menghapus data ?');" href="?page=pesertaregistrasi&action=hapus&id=<?php echo $data_siswa['id_peserta']; ?>" class="badge badge-danger">Hapus</a>
                                             <a href="?page=peserta&action=detail&id_peserta=<?php echo $data_siswa['id_peserta']; ?>" class="badge badge-primary">Detail</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else { ?>
                                <tr>
                                    <td colspan="8" align="center">Data tidak ditemukan</td>
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
    } else if(@$_GET['action'] == 'aktifkan') {
        mysqli_query($db, "UPDATE peserta SET status = 'aktif' WHERE id_peserta = '$id'") or die ($db->error);
        echo "<script>window.location='?page=pesertaregistrasi';</script>";
    } else if(@$_GET['action'] == 'hapus') {
        mysqli_query($db, "DELETE FROM peserta WHERE id_peserta = '$id'") or die ($db->error);
        echo "<script>window.location='?page=pesertaregistrasi';</script>";
    }
    else if(@$_GET['action'] == 'detail') {
        $sql_siswa_per_id = mysqli_query($db, "SELECT * FROM peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE id_peserta = '$_GET[id_peserta]'") or die ($db->error);
        $data = mysqli_fetch_array($sql_siswa_per_id);
    }    ?>
    
    


    <?php
} ?>