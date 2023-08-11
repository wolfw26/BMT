<div class="page-header">
    <div>
        <h3>Manajemen Data Seleksi Administrasi</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li> 
                <li class="breadcrumb-item active" aria-current="page">Manajemen Administrasi</li>
            </ol>
        </nav>
    </div>
</div>
<?php if(@$_SESSION['admin']) { ?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-warning">
            Admin tidak dapat melakukan verifikasi berkas, verifikasi hanya dapat dilakukan oleh penguji.
        </div>
    </div>
</div>
<?php } ?>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Peserta Tahap Administrasi</h6>
                        <ul class="nav nav-pills mb-3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                   role="tab" aria-controls="pills-home" aria-selected="true">Administrasi(Pending)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                   role="tab" aria-controls="pills-profile" aria-selected="false">Administrasi(Tidak Lulus)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                   role="tab" aria-controls="pills-contact" aria-selected="false">Administrasi(Lanjut Tes Tertulis dan Wawancara)</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <table id="example1" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Peserta</th>
                                            <th>KTP</th>
                                            <th>R.Hidup</th>
                                            <th>Vaksin</th>
                                            <th>Ijazah</th>
                                            <th>Fotocopy KK</th>
                                            <?php if(@$_SESSION['penguji']) { ?>
                                            <th class="text-center">Opsi</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    $sql_mapel = mysqli_query($db, "SELECT * FROM peserta NATURAL JOIN berkas WHERE status_berkas='Pending'") or die ($db->error);
                                    if(mysqli_num_rows($sql_mapel) > 0) {
                                        while($data_mapel = mysqli_fetch_array($sql_mapel)) { ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><b>NIK</b> : <?php echo $data_mapel['nik']; ?> <br> <b>Nama</b> : <?php echo $data_mapel['nama_lengkap']; ?></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['ktp']; ?>" target="_blank">Lihat</a></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['riwayat_hidup']; ?>" target="_blank">Lihat</a></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['vaksin']; ?>" target="_blank">Lihat</a></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['ijazah_terakhir']; ?>" target="_blank">Lihat</a></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['kk']; ?>" target="_blank">Lihat</a></td>
                                               
                                                <?php if(@$_SESSION['penguji']) { ?>
                                                <td align="center" width="150px">
                                                    <a href="verif.php?id_berkas=<?php echo $data_mapel['id_berkas']; ?>" class="badge badge-success" >Verifikasi</a>
                                                    <a href="no_verif.php?id_berkas=<?php echo $data_mapel['id_berkas']; ?>" class="badge badge-warning" >Tidak Lulus</a>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        echo '<td colspan="9" align="center">Tidak ada data</td>';
                                    } ?>
                                    </tbody>
                                </table> 
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                <table id="example1" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Peserta</th>
                                            <th>KTP</th>
                                            <th>R.Hidup</th>
                                            <th>vaksin</th>
                                            <th>Ijazah</th>
                                            <th>Fotocopy kk</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    $sql_mapel = mysqli_query($db, "SELECT * FROM peserta NATURAL JOIN berkas WHERE status_berkas='Tidak Lulus'") or die ($db->error);
                                    if(mysqli_num_rows($sql_mapel) > 0) {
                                        while($data_mapel = mysqli_fetch_array($sql_mapel)) { ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><b>NIK</b> : <?php echo $data_mapel['nik']; ?> <br> <b>Nama</b> : <?php echo $data_mapel['nama_lengkap']; ?></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['ktp']; ?>" target="_blank">Lihat</a></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['riwayat_hidup']; ?>" target="_blank">Lihat</a></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['vaksin']; ?>" target="_blank">Lihat</a></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['ijazah_terakhir']; ?>" target="_blank">Lihat</a></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['kk']; ?>" target="_blank">Lihat</a></td>
                                                 
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        echo '<td colspan="9" align="center">Tidak ada data</td>';
                                    } ?>
                                    </tbody>
                                </table> 
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"> 
                                <table id="example1" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Peserta</th>
                                            <th>KTP</th>
                                            <th>R.Hidup</th>
                                            <th>vaksin</th>
                                            <th>Ijazah</th>
                                            <th>Fotocopy KK</th>
 
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    $sql_mapel = mysqli_query($db, "SELECT * FROM peserta NATURAL JOIN berkas WHERE status_berkas= 'LANJUT KE TES TERTULIS DAN WAWANCARA'") or die ($db->error);
                                    if(mysqli_num_rows($sql_mapel) > 0) {
                                        while($data_mapel = mysqli_fetch_array($sql_mapel)) { ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><b>NIK</b> : <?php echo $data_mapel['nik']; ?> <br> <b>Nama</b> : <?php echo $data_mapel['nama_lengkap']; ?></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['ktp']; ?>" target="_blank">Lihat</a></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['riwayat_hidup']; ?>" target="_blank">Lihat</a></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['vaksin']; ?>" target="_blank">Lihat</a></td>
                                                <td><a href="../img/berkas/<?php echo $data_mapel['ijazah_terakhir']; ?>" target="_blank">Lihat</a></td>
                                                
                                                <td><a href="../img/berkas/<?php echo $data_mapel['kk']; ?>" target="_blank">Lihat</a></td> 
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        echo '<td colspan="9" align="center">Tidak ada data</td>';
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
</div>