<?php
$no = 1;
$id = @$_GET['id'];

if(@$_SESSION['admin']) { ?>
    <div class="page-header">
        <div>
            <h3>Manajemen Data Calon Karyawan Baru yng Aktif</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Home</a>
                    </li> 
                    <li class="breadcrumb-item active" aria-current="page">Data Calon Kryawan Baru Perjabatan</li>
                </ol>
            </nav>
        </div>
    </div>
<?php
}

if(@$_GET['action'] == '') {

    if(@$_SESSION['admin']) { ?>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning">
                    Admin tidak dapat mengedit data peserta. Admin hanya dapat mengaktifkan dan menonaktifkan serta menghapus akun peserta. Untuk mengedit data peserta yang berhak ialah peserta itu sendiri.
                </div>
            </div>
        </div>
    <?php
    } ?>
<div class="row">

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card"> 
                    <div class="card-header">
                        <?php
                        if(@$_GET['IDruang'] == '') {
                            echo 'Data Peserta yang Aktif &nbsp; <a href="./laporan/cetak.php?data=siswa" target="_blank"></a>';
                        } else if(@$_GET['IDruang'] != '') {
                            echo "Data Peserta Per Jabatan".@$_GET['ruang']." yang Aktif &nbsp; <a href='?page=ruang' class='btn btn-warning btn-sm'>Kembali</a>";
                        } ?>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th> 
                                    <th>Alamat</th>
                                    <th>Jabatan</th>
                                    <?php if(@$_SESSION['admin']) { ?>
                                        <th>Status</th>
                                    <?php } ?>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php

                            if(@$_GET['IDruang'] == '') {
                                $sql_siswa = mysqli_query($db, "SELECT * FROM peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE peserta.status = 'aktif'") or die ($db->error);
                            } else if(@$_GET['IDruang'] != '') {
                                $sql_siswa = mysqli_query($db, "SELECT * FROM peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE peserta.status = 'aktif' AND peserta.id_ruang = '$_GET[IDruang]'") or die ($db->error);
                            }
                            
                            if(mysqli_num_rows($sql_siswa) > 0) {
                                while($data_siswa = mysqli_fetch_array($sql_siswa)) { ?>
                                    <tr>
                                        <td align="center"><?php echo $no++; ?></td>
                                        <td><?php echo $data_siswa['nik']; ?></td>
                                        <td><?php echo $data_siswa['nama_lengkap']; ?></td> 
                                        <td><?php echo $data_siswa['alamat']; ?></td>
                                        <td align="center"><?php echo $data_siswa['kandidat']; ?></td>
                                        <?php if(@$_SESSION['admin']) { ?>
                                            <td><?php echo ucfirst($data_siswa['status']); ?></td>
                                        <?php } ?>
                                        <td align="center">
                                            <?php if(@$_SESSION['admin']) { ?>
                                                <a href="?page=peserta&action=nonaktifkan&id=<?php echo $data_siswa['id_peserta']; ?>" class="badge badge-warning">Non aktifkan</a>
                                                <a onclick="return confirm('Yakin akan menghapus data ?');" href="?page=peserta&action=hapus&id=<?php echo $data_siswa['id_peserta']; ?>" class="badge badge-danger">Hapus</a>
                                            <?php } ?>
                                            <a href="?page=peserta&action=detail&id_peserta=<?php echo $data_siswa['id_peserta']; ?>" class="badge badge-info">Detail</a>
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
} else if($_GET['action'] == 'nonaktifkan') {
    mysqli_query($db, "UPDATE peserta SET status = 'tidak aktif' WHERE id_peserta = '$id'") or die ($db->error);
    echo "<script>window.location='?page='peserta';</script>";
} else if(@$_GET['action'] == 'hapus') {
    mysqli_query($db, "DELETE FROM peserta WHERE id_peserta = '$id'") or die ($db->error);
    echo "<script>window.location='?page='peserta';</script>";
} else if(@$_GET['action'] == 'detail') {
    $sql_siswa_per_id = mysqli_query($db, "SELECT * FROM peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE id_peserta = '$_GET[id_peserta]'") or die ($db->error);
    $data = mysqli_fetch_array($sql_siswa_per_id);
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Detail Data Calon Karyawan</div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table width="100%">
                            <tr>
                                <td align="right" width="46%"><b>NIK</b></td>
                                <td align="center">:</td>
                                <td width="46%"><?php echo $data['nik']; ?></td>
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
                                <td><?php if($data['jenis_kelamin'] == 'Laki-laki') { echo "Laki-laki"; } else { echo "Perempuan"; } ?></td>
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
                                <td><?php echo $data['kandidat']; ?></td>
                            </tr> 
                            <tr>
                                <td align="right" valign="top"><b>Foto</b></td>
                                <td align="center" valign="top">:</td>
                                <td>
                                    <div style="padding:10px 0;"><img width="250px" src="../img/foto_peserta/<?php echo $data['foto']; ?>" /></div>
                                </td>
                            </tr>
                            <?php if(@$_SESSION['admin']) { ?>
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
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
