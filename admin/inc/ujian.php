<div class="page-header">
    <div>
        <h3>Manajemen Data Ujian</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Home</a>
                </li> 
                <li class="breadcrumb-item active" aria-current="page">Manajemen Ujian</li>
            </ol>
        </nav>
    </div>
</div>

<?php
$id = @$_GET['id'];
$id_tq = @$_GET['id_tq'];
$no = 1;
if(@$_SESSION['admin']) {
    $sql_topik = mysqli_query($db, "SELECT * FROM topik_ujian JOIN ruang ON topik_ujian.id_ruang = ruang.id_ruang JOIN bahan_ujian ON topik_ujian.id_bahan_ujian = bahan_ujian.id ORDER BY tgl_buat DESC") or die ($db->error);
    $pembuat = "admin";
} else if(@$_SESSION['penguji']) {
    $sql_topik = mysqli_query($db, "SELECT * FROM topik_ujian JOIN ruang ON topik_ujian.id_ruang = ruang.id_ruang JOIN bahan_ujian ON topik_ujian.id_bahan_ujian = bahan_ujian.id WHERE pembuat != 'admin' AND pembuat = '$_SESSION[penguji]' ORDER BY tgl_buat DESC") or die ($db->error);
    $pembuat = @$_SESSION['penguji'];
} 

if(@$_GET['action'] == '') { ?>

<div class="row"> 

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                	<div class="card-header">
                        <h5>Data Ujian | <a href="?page=ujian&action=tambah" class="badge badge-primary">Tambah</a></h5>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Jabatan</th>
                                    <th>Bahan Ujian</th>
                                    <th>Tanggal Pembuatan</th>
                                    <?php
                                    if(@$_SESSION['admin']) {
                                        echo "<th>Pembuat</th>";
                                    } ?>
                                    <th>Waktu</th>
                                    <th>Info</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(mysqli_num_rows($sql_topik) > 0) {
                                while($data_topik = mysqli_fetch_array($sql_topik)) { ?>
                                    <tr>
                                        <td align="center"><?php echo $no++; ?></td>
                                        <td><?php echo $data_topik['judul']; ?></td>
                                        <td align="center"><?php echo $data_topik['kandidat']; ?></td>
                                        <td><?php echo $data_topik['bahan_ujian']; ?></td>
                                        <td><?php echo tgl_indo($data_topik['tgl_buat']); ?></td>
                                        <?php
                                        if(@$_SESSION['admin']) {
                                            if($data_topik['pembuat'] == 'admin') {
                                                echo "<td>Admin</td>";
                                            } else {
                                                $sql1 = mysqli_query($db, "SELECT * FROM penguji WHERE id_penguji = '$data_topik[pembuat]'") or die($db->error);
                                                $data1 = mysqli_fetch_array($sql1);
                                                echo "<td>".$data1['nama_lengkap']."</td>";
                                            }
                                        } ?>
                                        <td><?php echo $data_topik['waktu_soal'] / 60 ." menit"; ?></td>
                                        <td><?php echo $data_topik['info']; ?></td>
                                        <td align="center"><?php echo ucfirst($data_topik['status']); ?></td>
                                        <td align="center">
                                            <a href="?page=ujian&action=edit&id=<?php echo $data_topik['id_tq']; ?>" class="badge badge-success" >Edit</a>
                                            <a onclick="return confirm('Hati-hati saat menghapus ujian karena Anda akan menghapus semua data yang berhubungan dengan ujian ini, termasuk data soal dan nilai. Apakah Anda tetap yakin akan menghapus ujian ini?');" href="?page=ujian&action=hapus&id_tq=<?php echo $data_topik['id_tq']; ?>" class="badge badge-danger">Hapus</a>
                                            <a href="?page=ujian&action=buatsoal&id=<?php echo $data_topik['id_tq']; ?>" class="badge badge-warning">Buat Soal</a>
                                            <a href="?page=ujian&action=daftarsoal&id=<?php echo $data_topik['id_tq']; ?>" class="badge badge-warning">Daftar Soal</a>
                                            <a href="?page=ujian&action=pesertakoreksi&id_tq=<?php echo $data_topik['id_tq']; ?>" class="badge badge-warning">Peserta & Koreksi</a>
                                            <a href="?page=ujian&action=pesertakoreksi1&id_tq=<?php echo $data_topik['id_tq']; ?>" class="badge badge-warning">Peserta & Koreksi Wawancara</a>
                                        </td>
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
	
	<?php } else if(@$_GET['action'] == 'tambah') { ?>
	
	<div class="col-md-12">

        <div class="row">
            <div class="col-md-12"> 

                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Data Ujian | <a href="?page=ujian" class="badge badge-warning">Kembali</a></h5>
                    </div>
                    <div class="card-body">
                        <form method="post"  enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="judul" name="judul" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10 wadah_kelas"> 
                                    <div id="ke-1">
                                    <select name="ruang" class="form-control x">
                                        <option value="">- Pilih -</option>
                                        <?php
                                        $sql_kelas = mysqli_query($db, "SELECT * FROM ruang") or die ($db->error);
                                        while($data_kelas = mysqli_fetch_array($sql_kelas)) {
                                            echo '<option value="'.$data_kelas['id_ruang'].'">'.$data_kelas['kandidat'].' - '.$data_kelas['ruangan'].'</option>';
                                        } ?>
                                    </select>
                                    </div>
                                    <a class="tambah_kelas badge badge-info">Tambah Jabatan Lain</a> <small><i>(Klik button untuk menambahkan ruang lain, max. 10 ruang)</i></small> 
                                    <a href="" style="margin:2px 0; display:none;" class="del-kls badge badge-danger">Delete Jabatan Lain</a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Bahan Ujian</label>
                                <div class="col-sm-10">
                                    <select id="bahan_ujian" name="bahan_ujian" class="form-control" required>
                                        <option value="">- Pilih -</option>
                                        <?php
                                        $sql_mapel = mysqli_query($db, "SELECT * FROM bahan_ujian") or die ($db->error);
                                        while($data_mapel = mysqli_fetch_array($sql_mapel)) {
                                            echo '<option value="'.$data_mapel['id'].'">'.$data_mapel['bahan_ujian'].'</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Pembuatan</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="tgl_buat" name="tgl_buat" value="<?php echo date('Y-m-d'); ?>" required>
                                </div>
                            </div>   
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Waktu Soal <sub>(dalam menit)</sub></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="waktu_soal" name="waktu_soal" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Info</label>
                                <div class="col-sm-10">
                                    <textarea name="info" id="info" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" id="status" class="form-control">
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <div class="col-sm-10">
                                    <a class="save btn btn-success">Simpan</a> 
                                    <button type="reset" class="btn btn-danger"> Reset</button>
                                </div>
                            </div>   
                        </form>
                        <div id="hasil"></div>
                        <?php
                        $isikelas = null;
                        $sql_kelas = mysqli_query($db, "SELECT * FROM ruang") or die ($db->error);
                        while($data_kelas = mysqli_fetch_array($sql_kelas)) {
                            $isikelas .= '<option value="'.$data_kelas['id_ruang'].'">'.$data_kelas['kandidat'].'</option>';;
                        }
                        $isikelas2 = $isikelas;
                        ?>
                        <script type="text/javascript">
                        $(document).ready(function() {
                            var ke =  1;
                            var x = 1;
                            $(".tambah_kelas").click(function(e){ //on add input button click
                                e.preventDefault();
                                if(x < 10){ //max input box allowed
                                    x++;
                                    ke++;
                                    $(".wadah_kelas").append('<div id="ke-'+ke+'"><select style="margin-bottom:2px;" name="ruang" class="form-control x"><option value="">- Pilih -</option><?php echo $isikelas2; ?></select> <div>'); //add input box
                                }
                                $(".del-kls").fadeIn();
                            });
                            
                            $(".wadah_kelas").on("click",".del", function(e){ //user click on remove text
                                e.preventDefault(); $(this).parent('div').remove(); x--;
                            });
                        });

                        $(".save").click(function() {
                            var judul = $("#judul").val();
                            var bahan_ujian = $("#bahan_ujian").val();
                            var tgl_buat = $("#tgl_buat").val();
                            var waktu_soal = $("#waktu_soal").val();
                            var info = $("#info").val();
                            var status = $("#status").val();
                            var pembuat = "<?php echo $pembuat; ?>";
                            var ke =  $('.wadah_kelas > div > select').length;
                            for(var i = 1; i <= ke; i++) {
                                var ruang = $("#ke-"+i+" > select.x").val();
                                $.ajax({
                                    url : 'inc/save_ujian.php',
                                    type : 'post',
                                    data : 'judul='+judul+'&bahan_ujian='+bahan_ujian+'&tgl_buat='+tgl_buat+'&waktu_soal='+waktu_soal+'&info='+info+'&status='+status+'&pembuat='+pembuat+'&ruang='+ruang,
                                    success : function(msg) {
                                        $("#hasil").html(msg);
                                    }
                                });
                            }
                        });
                        </script>
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
                        <h5>Ubah Data Ujian | <a href="?page=ujian" class="badge badge-warning">Kembali</a></h5>
                    </div>
                    <div class="card-body">
                        <?php
                        $sql_topik_id = mysqli_query($db, "SELECT * FROM topik_ujian JOIN ruang ON topik_ujian.id_ruang = ruang.id_ruang JOIN bahan_ujian ON topik_ujian.id_bahan_ujian = bahan_ujian.id WHERE id_tq = '$id'") or die ($db->error);
                        $data_topik_id = mysqli_fetch_array($sql_topik_id);
                        ?>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $data_topik_id['judul']; ?>" name="judul" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ruang</label>
                                <div class="col-sm-10">
                                    <select name="ruang" class="form-control" required>
                                        <option value="<?php echo $data_topik_id['id_ruang']; ?>"><?php echo $data_topik_id['kandidat']; ?></option>
                                        <option value="">- Pilih -</option>
                                        <?php
                                        $sql_kelas = mysqli_query($db, "SELECT * FROM ruang") or die ($db->error);
                                        while($data_kelas = mysqli_fetch_array($sql_kelas)) {
                                            echo '<option value="'.$data_kelas['id_ruang'].'">'.$data_kelas['kandidat'].'</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Bahan Ujian</label>
                                <div class="col-sm-10">
                                    <select name="bahan_ujian" class="form-control" required>
                                        <option value="<?php echo $data_topik_id['id_bahan_ujian']; ?>"><?php echo $data_topik_id['bahan_ujian']; ?></option>
                                        <option value="">- Pilih -</option>
                                        <?php
                                        $sql_mapel = mysqli_query($db, "SELECT * FROM bahan_ujian") or die ($db->error);
                                        while($data_mapel = mysqli_fetch_array($sql_mapel)) {
                                            echo '<option value="'.$data_mapel['id'].'">'.$data_mapel['bahan_ujian'].'</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tanggal Pembuatan</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" value="<?php echo $data_topik_id['tgl_buat']; ?>" name="tgl_buat" required>
                                </div>
                            </div>   
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Waktu Soal <sub>(dalam menit)</sub></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo $data_topik_id['waktu_soal'] / 60; ?>" name="waktu_soal" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Info</label>
                                <div class="col-sm-10">
                                    <textarea name="info" class="form-control" rows="3"><?php echo $data_topik_id['info']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control">
                                        <option value="aktif">Aktif</option>
                                        <option value="tidak aktif" <?php if($data_topik_id['status'] == 'tidak aktif') { echo "selected"; } ?>>Tidak Aktif</option>
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
                        <?php
                        if(@$_POST['simpan']) {
                            $judul = @mysqli_real_escape_string($db, $_POST['judul']);
                            $ruang = @mysqli_real_escape_string($db, $_POST['ruang']);
                            $bahan_ujian = @mysqli_real_escape_string($db, $_POST['bahan_ujian']);
                            $tgl_buat = @mysqli_real_escape_string($db, $_POST['tgl_buat']);
                            $waktu_soal = @mysqli_real_escape_string($db, $_POST['waktu_soal']) * 60;
                            $info = @mysqli_real_escape_string($db, $_POST['info']);
                            $status = @mysqli_real_escape_string($db, $_POST['status']);
                            mysqli_query($db, "UPDATE topik_ujian SET judul = '$judul', id_ruang = '$ruang', id_bahan_ujian = '$bahan_ujian', tgl_buat = '$tgl_buat', pembuat = '$pembuat', waktu_soal = '$waktu_soal', info = '$info', status = '$status' WHERE id_tq = '$id'") or die ($db->error);
                            echo "<script>window.location='?page=ujian';</script>";
                        }
                        ?>
                    </div>
                </div> 

            </div>
        </div>

    </div>

        <?php
} else if(@$_GET['action'] == 'hapus') {
    mysqli_query($db, "DELETE FROM topik_ujian WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
    mysqli_query($db, "DELETE FROM soal_pilgan WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
    mysqli_query($db, "DELETE FROM soal_essay WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
    mysqli_query($db, "DELETE FROM jawaban WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
    mysqli_query($db, "DELETE FROM nilai_pilgan WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
    mysqli_query($db, "DELETE FROM nilai_essay WHERE id_tq = '$_GET[id_tq]'") or die ($db->error);
    echo "<script>window.location='?page=ujian';</script>";
} else if(@$_GET['action'] == 'buatsoal') {
    include "buat_soal.php";
} else if(@$_GET['action'] == 'buatsoal') {
    include "buat_soal.php";
} else if(@$_GET['action'] == 'daftarsoal') {
    include "daftar_soal.php";
} else if(@$_GET['action'] == 'pesertakoreksi') {
    include "peserta_koreksi.php";
} else if(@$_GET['action'] == 'pesertakoreksi1') {
    include "peserta_koreksi1.php";
} else if(@$_GET['action'] == 'koreksi') {
    include "koreksi.php";
} else if(@$_GET['action'] == 'hapuspeserta') {
    mysqli_query($db, "DELETE FROM jawaban WHERE id_tq = '$_GET[id_tq]' AND id_siswa = '$_GET[id_siswa]'") or die ($db->error);
    mysqli_query($db, "DELETE FROM nilai_pilgan WHERE id_tq = '$_GET[id_tq]' AND id_siswa = '$_GET[id_siswa]'") or die ($db->error);
    mysqli_query($db, "DELETE FROM nilai_essay WHERE id_tq = '$_GET[id_tq]' AND id_siswa = '$_GET[id_siswa]'") or die ($db->error);
    echo "<script>window.location='?page=ujian&action=pesertakoreksi&id_tq=".@$_GET['id_tq']."';</script>";
} ?>