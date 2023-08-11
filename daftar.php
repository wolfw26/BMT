<?php
@session_start();
$db = mysqli_connect("localhost", "root", "", "bmt");
?>

<!doctype html>
<html class="no-js" lang="en">


<!-- Mirrored from htmldemo.net/adda/adda/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Jul 2022 23:09:27 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Halaman Pendafataran</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="bawaslulogo.png"">

    <!-- CSS
	============================================ -->
    <!-- google fonts -->
    <link href=" https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="dist/css/vendor/bootstrap.min.css">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="dist/css/vendor/bicon.min.css">
    <!-- Flat Icon CSS -->
    <link rel="stylesheet" href="dist/css/vendor/flaticon.css">
    <!-- audio & video player CSS -->
    <link rel="stylesheet" href="dist/css/plugins/plyr.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="dist/css/plugins/slick.min.css">
    <!-- nice-select CSS -->
    <link rel="stylesheet" href="dist/css/plugins/nice-select.css">
    <!-- perfect scrollbar css -->
    <link rel="stylesheet" href="dist/css/plugins/perfect-scrollbar.css">
    <!-- light gallery css -->
    <link rel="stylesheet" href="dist/css/plugins/lightgallery.min.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="dist/css/style.css">

</head>

<body class="bg-transparent">

    <main>


        <div class="signup-form-wrapper">
            <?php if (@$_GET['page'] == '') { ?>
                <div class="signup-inner text-center">
                    <h3 class="title">Halaman Pendaftaran Akun</h3>
                    <form class="signup-inner--form" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="single-field" placeholder="Masukan NIK" name="nik" autofocus required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="single-field" placeholder="Masukan Nama Lengkap" name="nama_lengkap" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="single-field" placeholder="Masukan Tempat Lahir" name="tempat_lahir" required>
                            </div>
                            <div class="col-md-6">
                                <input type="date" class="single-field" placeholder="Masukan Tanggal Lahir" name="tgl_lahir" required>
                            </div>
                            <div class="col-md-6">
                                <select name="jenis_kelamin" class="single-field" required>
                                    <option value="">- Pilih Jenis Kelamin -</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="agama" class="single-field" required>
                                    <option value="">- Pilih Agama -</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katholik">Katholik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="single-field" placeholder="Masukan Nomor Telp" name="no_telp" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="single-field" placeholder="Masukan Email" name="email" required>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="single-field" placeholder="Masukan Alamat" name="alamat" required>
                            </div>
                            <div class="col-md-12">
                                <select name="ruang" class="single-field" required>
                                    <option value="">- Pilih Jabatan-</option>
                                    <?php
                                    ini_set('display_errors', 1);
                                    ini_set('display_startup_errors', 1);
                                    error_reporting(E_ALL);
                                    $sql_kelas = mysqli_query($db, "SELECT * from ruang") or die($db->error);
                                    while ($data_kelas = mysqli_fetch_array($sql_kelas)) {
                                        echo '<option value="' . $data_kelas['id_ruang'] . '">' . $data_kelas['kandidat'] . ' - ' . $data_kelas['ruangan'] . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <input type="file" class="single-field" placeholder="Upload foto" name="foto" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="single-field" placeholder="Masukan Username" name="user" required>
                            </div>
                            <div class="col-md-6">
                                <input type="password" class="single-field" placeholder="Masukan password" name="pass" required>
                            </div>


                            <div class="col-12">
                                <input type="submit" name="daftar" value="Daftar" class="submit-btn" />
                            </div>
                        </div>
                    </form>
                    <?php
                    if (@$_POST['daftar']) {
                        $nik           = @mysqli_real_escape_string($db, $_POST['nik']);
                        $nama_lengkap  = @mysqli_real_escape_string($db, $_POST['nama_lengkap']);
                        $tempat_lahir  = @mysqli_real_escape_string($db, $_POST['tempat_lahir']);
                        $tgl_lahir     = @mysqli_real_escape_string($db, $_POST['tgl_lahir']);
                        $jenis_kelamin = @mysqli_real_escape_string($db, $_POST['jenis_kelamin']);
                        $agama         = @mysqli_real_escape_string($db, $_POST['agama']);
                        $no_telp       = @mysqli_real_escape_string($db, $_POST['no_telp']);
                        $email         = @mysqli_real_escape_string($db, $_POST['email']);
                        $alamat        = @mysqli_real_escape_string($db, $_POST['alamat']);
                        $ruang         = @mysqli_real_escape_string($db, $_POST['ruang']);
                        $foto          = @$_FILES['foto']['name'];
                        $lokasi        = @$_FILES['foto']['tmp_name'];
                        move_uploaded_file($lokasi, "img/foto_peserta/" . $foto);
                        $user          = @mysqli_real_escape_string($db, $_POST['user']);
                        $pass          = @mysqli_real_escape_string($db, $_POST['pass']);

                        $sumber        = @$_FILES['foto']['tmp_name'];
                        $target        = 'img/foto_peserta/';
                        $nama_gambar   = @$_FILES['foto']['name'];

                        $sql_cek_user = mysqli_query($db, "SELECT * FROM peserta WHERE username = '$user'") or die($db->error);
                        if (mysqli_num_rows($sql_cek_user) > 0) {
                            echo "<script>alert('Username yang Anda pilih sudah ada, silahkan ganti yang lain');</script>";
                        } else {
                            if ($nama_foto != '') {
                                if (move_uploaded_file($sumber, $target . $nama_foto)) {
                                    mysqli_query($db, "INSERT INTO peserta VALUES('', '$nik', '$nama_lengkap', '$tempat_lahir', '$tgl_lahir', '$jenis_kelamin', '$agama', '$no_telp', '$email', '$alamat', '$ruang', '$nama_gambar', '$user', md5('$pass'), '$pass', 'tidak aktif')") or die($db->error);
                                    echo '<script>alert("Pendaftaran berhasil, silahkan login"); window.location="./"</script>';
                                } else {
                                    echo '<script>alert("Gagal mendaftar, foto gagal diupload, coba lagi!");</script>';
                                }
                            } else {
                                mysqli_query($db, "INSERT INTO peserta VALUES('', '$nik', '$nama_lengkap', '$tempat_lahir', '$tgl_lahir', '$jenis_kelamin', '$agama', '$no_telp', '$email', '$alamat', '$ruang', '$nama_gambar', '$user', md5('$pass'), '$pass', 'tidak aktif')") or die($db->error);
                                echo '<script>alert("Pendaftaran berhasil, tunggu akun aktif dan silahkan login"); window.location="./"</script>';
                            }
                        }
                    }
                    ?>
                </div>
        </div>
        </div>
    <?php } ?>
    </div>
    </div>
    </div>
    </div>
    </div>
    </main>

    <!-- JS
============================================ -->

    <!-- Modernizer JS -->
    <script src="dist/js/vendor/modernizr-3.6.0.min.js"></script>
    <!-- jQuery JS -->
    <script src="dist/js/vendor/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="dist/js/vendor/bootstrap.bundle.min.js"></script>
    <!-- Slick Slider JS -->
    <script src="dist/js/plugins/slick.min.js"></script>
    <!-- nice select JS -->
    <script src="dist/js/plugins/nice-select.min.js"></script>
    <!-- audio video player JS -->
    <script src="dist/js/plugins/plyr.min.js"></script>
    <!-- perfect scrollbar js -->
    <script src="dist/js/plugins/perfect-scrollbar.min.js"></script>
    <!-- light gallery js -->
    <script src="dist/js/plugins/lightgallery-all.min.js"></script>
    <!-- image loaded js -->
    <script src="dist/js/plugins/imagesloaded.pkgd.min.js"></script>
    <!-- isotope filter js -->
    <script src="dist/js/plugins/isotope.pkgd.min.js"></script>
    <!-- Main JS -->
    <script src="dist/js/main.js"></script>

</body>


<!-- Mirrored from htmldemo.net/adda/adda/signup.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Jul 2022 23:09:28 GMT -->

</html>