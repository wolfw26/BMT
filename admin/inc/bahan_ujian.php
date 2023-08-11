<div class="page-header">
    <div>
        <h3>Manajemen Data  Ujian</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li> 
                <li class="breadcrumb-item active" aria-current="page">Manajemen  Ujian</li>
            </ol>
        </nav>
    </div>
</div>
 
	<?php
    $id = @$_GET['id'];
    $no = 1;

    if(@$_SESSION['admin']) {

    echo '<div class="row">';

    if(@$_GET['action'] == '') { ?>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                	<div class="card-header">
                        <h5>Data  Ujian | <a href="?page=bahan_ujian&action=tambah" class="badge badge-primary">Tambah</a></h5>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode </th>
                                    <th> Ujian</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql_mapel = mysqli_query($db, "SELECT * FROM bahan_ujian") or die ($db->error);
                            if(mysqli_num_rows($sql_mapel) > 0) {
                                while($data_mapel = mysqli_fetch_array($sql_mapel)) { ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data_mapel['kode_bahan_ujian']; ?></td>
                                        <td><?php echo $data_mapel['bahan_ujian']; ?></td>
                                        <td align="center" width="150px">
                                            <a href="?page=bahan_ujian&action=edit&id=<?php echo $data_mapel['id']; ?>" class="badge badge-success" >Edit</a>
                                            <a onclick="return confirm('Yakin akan menghapus data?');" href="?page=bahan_ujian&action=hapus&id=<?php echo $data_mapel['id']; ?>" class="badge badge-danger">Hapus</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                echo '<td colspan="4" align="center">Tidak ada data</td>';
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
                        <h5>Tambah Data  Ujian | <a href="?page=bahan_ujian" class="badge badge-warning">Kembali</a></h5>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kode  Ujian</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kode_bahan_ujian" autofocus required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"> Ujian</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="bahan_ujian" required>
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
                            $kode_bahan_ujian = @mysqli_real_escape_string($db, $_POST['kode_bahan_ujian']);
                            $bahan_ujian = @mysqli_real_escape_string($db, $_POST['bahan_ujian']);
                            mysqli_query($db, "INSERT INTO bahan_ujian VALUES('', '$kode_bahan_ujian', '$bahan_ujian')") or die ($db->error);
                            echo "<script>window.location='?page=bahan_ujian';</script>";
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
                        <h5>Ubah Data  Ujian | <a href="?page=bahan_ujian" class="badge badge-warning">Kembali</a></h5>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <?php
                            $sql_mapel_id = mysqli_query($db, "SELECT * FROM bahan_ujian WHERE id = '$id'") or die ($db->error);
                            $data_mapel_id = mysqli_fetch_array($sql_mapel_id);
                            ?>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kode  Ujian</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="kode_bahan_ujian" value="<?php echo $data_mapel_id['kode_bahan_ujian']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"> Ujian</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="bahan_ujian" value="<?php echo $data_mapel_id['bahan_ujian']; ?>" required>
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
                            $kode_bahan_ujian = @mysqli_real_escape_string($db, $_POST['kode_bahan_ujian']);
                            $bahan_ujian = @mysqli_real_escape_string($db, $_POST['bahan_ujian']);
                            mysqli_query($db, "UPDATE bahan_ujian SET kode_bahan_ujian = '$kode_bahan_ujian', bahan_ujian = '$bahan_ujian' WHERE id = '$id'") or die ($db->error);
                            echo "<script>window.location='?page=bahan_ujian';</script>";
                        }
                        ?>
                    </div>
                </div> 

            </div>
        </div>

    </div>

    <?php
    } else if(@$_GET['action'] == 'hapus') {
        mysqli_query($db, "DELETE FROM bahan_ujian WHERE id = '$id'") or die ($db->error);  
        echo "<script>window.location='?page=bahan_ujian';</script>"; 
    }
    echo "</div>";



} ?>