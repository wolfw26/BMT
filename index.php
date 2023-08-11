<?php
@session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "koneksi.php";

if (!@$_SESSION['peserta']) {
    if (@$_GET['hal'] == 'daftar') {
        include "daftar.php";
    } else {
        include "login.php";
    }
} else { ?>

    <!doctype html>
    <html class="no-js" lang="en">


    <!-- Mirrored from htmldemo.net/adda/adda/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Jul 2022 23:08:36 GMT -->

    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Halaman Peserta</title>
        <meta name="robots" content="noindex, follow" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="logoBMT.png">


        <!-- CSS
	============================================ -->
        <!-- google fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
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

    <body>

        <!-- header area start -->
        <header>
            <div class="header-top sticky bg-white d-none d-lg-block">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <!-- header top navigation start -->
                            <?php
                            $sql_log = mysqli_query($db, "SELECT * FROM peserta JOIN berkas ON peserta.id_peserta = '$_SESSION[peserta]' AND berkas.id_peserta = peserta.id_peserta") or die($db->error);
                            $data_log = mysqli_fetch_array($sql_log);
                            ?>
                            <div class="header-top-navigation">
                                <nav>
                                    <ul>
                                        <li><a <?php if (@$_GET['page'] == '') {
                                                    echo 'class="menu-top-active"';
                                                } ?> href="./">Beranda</a></li>
                                        <li><a <?php if (@$_GET['page'] == 'berkas') {
                                                    echo 'class="menu-top-active"';
                                                } ?> href="?page=berkas">Berkas Persyaratan</a></li>
                                        <?php if ($data_log['status_berkas'] == "Lanjut Ke Tes Tertulis dan Wawancara") : ?>
                                            <li><a <?php if (@$_GET['page'] == 'ujian') {
                                                        echo 'class="menu-top-active"';
                                                    } ?> href="?page=ujian">Tes Tertulis</a></li>
                                        <?php endif ?>
                                        <?php if ($data_log['status_berkas'] == "Lanjut Tahap 3") : ?>
                                            <li><a <?php if (@$_GET['page'] == 'ujian3') {
                                                        echo 'class="menu-top-active"';
                                                    } ?> href="?page=ujian3">Tes Wawancara</a></li>
                                        <?php endif ?>
                                    </ul>
                                </nav>
                            </div>
                            <!-- header top navigation start -->
                        </div>

                        <div class="col-md-2">
                            <!-- brand logo start -->
                            <div class="brand-logo text-center">
                                <a href="index-2.html">

                                </a>
                            </div>
                            <!-- brand logo end -->
                        </div>

                        <div class="col-md-5">
                            <div class="header-top-right d-flex align-items-center justify-content-end">
                                <!-- header top search start -->

                                <?php
                                $sql_terlogin = mysqli_query($db, "SELECT * FROM peserta JOIN ruang ON peserta.id_peserta = '$_SESSION[peserta]' AND ruang.id_ruang = peserta.id_ruang") or die($db->error);
                                $data_terlogin = mysqli_fetch_array($sql_terlogin);
                                ?>
                                <div class="header-top-search">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                Selamat datang, <u><?php echo ucfirst($data_terlogin['username']); ?></u>. Jangan lupa <a href="inc/logout.php?sesi=peserta" class="badge badge-danger text-dark" style="font-size: 14px;">Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- header top search end -->

                                <!-- profile picture start -->
                                <div class="profile-setting-box">
                                    <div class="profile-thumb-small">
                                        <a href="javascript:void(0)" class="profile-triger">
                                            <figure>
                                                <img src="img/foto_peserta/<?php echo $data_terlogin['foto']; ?>" class="img-rounded" />
                                            </figure>
                                        </a>
                                        <div class="profile-dropdown">
                                            <div class="profile-head">
                                                <h5 class="name"><a href="#"><?php echo ucfirst($data_terlogin['nama_lengkap']); ?></a></h5>
                                                <a class="mail" href="#"><?php echo ucfirst($data_terlogin['email']); ?></a>
                                                <a href="?hal=detailprofil" class="mail">Profil Saya</a>
                                                <a href="?hal=editprofil" class="mail">Edit Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- profile picture end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header area end -->
        <!-- header area start -->
        <header>
            <div class="mobile-header-wrapper sticky d-block d-lg-none"></div>
        </header>
        <!-- header area end -->

        <main>

            <div class="main-wrapper pt-80">
                <div class="container">
                    <?php
                    if (@$_GET['page'] == '') {
                        include "inc/beranda.php";
                    } else if (@$_GET['page'] == 'ujian') {
                        include "inc/ujian.php";
                    } else if (@$_GET['page'] == 'ujian3') {
                        include "inc/ujian3.php";
                    } else if (@$_GET['page'] == 'nilai') {
                        include "inc/nilai.php";
                    } else if (@$_GET['page'] == 'berkas') {
                        include "inc/berkas.php";
                    } else if (@$_GET['page'] == 'berita') {
                        include "inc/berita.php";
                    } ?>
                </div>
            </div>

        </main>

        <!-- Scroll to top start -->
        <div class="scroll-top not-visible">
            <i class="bi bi-finger-index"></i>
        </div>
        <!-- Scroll to Top End -->

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


    <!-- Mirrored from htmldemo.net/adda/adda/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Jul 2022 23:09:10 GMT -->

    </html>
<?php
}
?>