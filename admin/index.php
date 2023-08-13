<?php
@session_start();
include "../koneksi.php";

if (@$_SESSION['admin'] || @$_SESSION['penguji']) {
?>

    <!doctype html>
    <html lang="en">


    <!-- Mirrored from gogi.laborasyon.com/demos/default/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Jun 2022 18:55:17 GMT -->

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php cek_session("Halaman Administrator", "Halaman Penguji"); ?></title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="../assets/media/image/BMT.png">

        <!-- Main css -->
        <link rel="stylesheet" href="../vendors/bundle.css" type="text/css">

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">

        <!-- Daterangepicker -->
        <link rel="stylesheet" href="../vendors/datepicker/daterangepicker.css" type="text/css">

        <!-- DataTable -->
        <link rel="stylesheet" href="../vendors/dataTable/datatables.min.css" type="text/css">

        <!-- Prism -->
        <link rel="stylesheet" href="../vendors/prism/prism.css" type="text/css">

        <!-- App css -->
        <link rel="stylesheet" href="../assets/css/app.min.css" type="text/css">

        <script src="jquery-1.10.2.js"></script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">



        <style type="text/css">
            .link:hover {
                cursor: pointer;
            }
        </style>

        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>

    <body class=" bg-warning">
        <div class="header-body ">
            <!-- Preloader -->
            <div class="preloader">
                <div class="preloader-icon"></div>
                <span>Loading...</span>
            </div>
            <!-- ./ Preloader -->

            <!-- Layout wrapper -->
            <div class="layout-wrapper">

                <!-- Header -->

                <div class="header d-print-none">
                    <div class="header-container">
                        <div class="header-left">
                            <div class="navigation-toggler">
                                <a href="#" data-action="navigation-toggler">
                                    <i data-feather="menu"></i>
                                </a>
                            </div>

                            <div class="header-logo">
                                <br>
                                <a href="index-2.html">
                                    <img class="logo" src="../assets/media/image/logoBMT.png" alt="logo">

                                </a>
                            </div>
                        </div>

                        <!-- DASBOARD -->

                        <div class="header-body">

                            <ul class="navbar-nav">
                                <li class="nav-item mr-3">
                                    <div class="header-search-form">
                                        <a class="navbar-brand text-white">PT. BUMIPUTERA MAHA TERPERCAYA</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown d-none d-md-block"></li>

                            </ul>
                        </div>
                        <div class="header-body">
                            <div class="header-body-left">
                                <ul class="navbar-nav">
                                    <li class="nav-item mr-3">
                                        <div class="header-search-form">
                                            <a class="navbar-brand text-white" href="./"><?php cek_session("Administrator", "Penguji"); ?></a>
                                        </div>
                                    </li>
                                    <li class="nav-item dropdown d-none d-md-block"></li>
                                    <li class="nav-item dropdown d-none d-md-block"></li>
                                </ul>
                            </div>

                            <div class="header-body-right">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link mobile-header-search-btn" title="Search">
                                            <i data-feather="search"></i>
                                        </a>
                                    </li>

                                    <li class="nav-item dropdown d-none d-md-block">
                                        <a href="#" class="nav-link" title="Fullscreen" data-toggle="fullscreen">
                                            <i class="maximize" data-feather="maximize"></i>
                                            <i class="minimize" data-feather="minimize"></i>
                                        </a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" title="User menu" data-toggle="dropdown">
                                            <?php
                                            if (@$_SESSION['admin']) {
                                                $sesi_id = @$_SESSION['admin'];
                                                $level = "admin";
                                            } else if (@$_SESSION['penguji']) {
                                                $sesi_id = @$_SESSION['penguji'];
                                                $level = "penguji";
                                            }

                                            if ($level == 'admin') {
                                                $sql_terlogin = mysqli_query($db, "SELECT * FROM admin WHERE id_admin = '$sesi_id'") or die($db->error);
                                            } else if ($level == 'penguji') {
                                                $sql_terlogin = mysqli_query($db, "SELECT * FROM penguji WHERE id_penguji = '$sesi_id'") or die($db->error);
                                            }
                                            $data_terlogin = mysqli_fetch_array($sql_terlogin);
                                            echo ucfirst($data_terlogin['username']);
                                            ?>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-big">
                                            <div class="list-group">

                                                <a href="logout.php" class="list-group-item text-danger">Sign Out!</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item header-toggler">
                                <a href="#" class="nav-link">
                                    <i data-feather="arrow-down"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ./ Header -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- begin::navigation -->
                    <div class="navigation">
                        <div class="navigation-header">
                            <span>Navigation</span>
                            <a href="#">
                                <i class="ti-close"></i>
                            </a>
                        </div>
                        <div class="navigation-menu-body">
                            <ul>
                                <li>
                                    <a class="active" href="?page=dashboard" class="<?php if (@$_GET['page'] == 'dashboard') {
                                                                                        echo 'active-menu';
                                                                                    } ?>">
                                        <span class="nav-link-icon">
                                            <!-- <i data-feather="pie-chart"></i> -->
                                        </span>
                                        <!-- <span>Dashboard</span> -->
                                    </a>
                                </li>
                                <!-- SIDEBAR MENU -->
                                <li>
                                    <a class="active" href="?page=dashboard" class="<?php if (@$_GET['page'] == 'dashboard') {
                                                                                        echo 'active-menu';
                                                                                    } ?>">
                                        <span class="nav-link-icon">
                                            <i data-feather="pie-chart"></i>
                                        </span>
                                        <span>Dashboard</span>
                                    </a>
                                </li>


                                <li>
                                    <a class="active" href="?page=tes" class="<?php if (@$_GET['page'] == 'tes') {
                                                                                    echo 'active-menu';
                                                                                } ?>">
                                        <span class="nav-link-icon">
                                            <i data-feather="user"></i>
                                        </span>
                                        <span>Grafik Karyawan</span>
                                    </a>
                                </li>


                                <?php
                                if (@$_SESSION['admin']) {
                                ?>
                                    <li>
                                        <a href="#">
                                            <span class="nav-link-icon">
                                                <i data-feather="archive"></i>
                                            </span>
                                            <span>Manajemen</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="?page=penguji" class="<?php if (@$_GET['page'] == 'penguji') {
                                                                                    echo 'active-menu';
                                                                                } ?>">Penguji</a>
                                            </li>
                                            <li>
                                                <a href="?page=peserta" class="<?php if (@$_GET['page'] == 'peserta') {
                                                                                    echo 'active-menu';
                                                                                } ?>">Calon Karyawan</a>
                                            </li>
                                            <li>
                                                <a href="?page=pesertaregistrasi" class="<?php if (@$_GET['page'] == 'pesertaregistrasi') {
                                                                                                echo 'active-menu';
                                                                                            } ?>">karyawan Registrasi</a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php
                                }
                                ?>

                                <?php
                                if (@$_SESSION['admin']) {
                                ?>
                                    <li>
                                        <a class="<?php if (@$_GET['page'] == 'bahan_ujian') {
                                                        echo 'active-menu';
                                                    } ?>" href="?page=bahan_ujian"><span class="nav-link-icon"><i data-feather="list"></i></span><span>Data Ujian</span></a>
                                    </li>
                                <?php
                                }
                                ?>

                                <li>
                                    <a class="<?php if (@$_GET['page'] == 'ruang') {
                                                    echo 'active-menu';
                                                } ?>" href="?page=ruang"><span class="nav-link-icon"><i data-feather="users"></i></span><span>Jabatan</span></a>
                                </li>
                                <li>
                                    <a class="<?php if (@$_GET['page'] == 'ujian1') {
                                                    echo 'active-menu';
                                                } ?>" href="?page=ujian1"><span class="nav-link-icon"><i data-feather="file"></i></span><span>Seleksi Berkas</span></a>
                                </li>
                                <li>
                                    <a class="<?php if (@$_GET['page'] == 'ujian2') {
                                                    echo 'active-menu';
                                                } ?>" href="?page=ujian2"><span class="nav-link-icon"><i data-feather="file"></i></span><span>Tes Tertulis</span></a>
                                </li>
                                <li>
                                    <a class="<?php if (@$_GET['page'] == 'ujian3') {
                                                    echo 'active-menu';
                                                } ?>" href="?page=ujian3"><span class="nav-link-icon"><i data-feather="file"></i></span><span>Tes Wawancara</span></a>
                                </li>
                                <li>
                                    <a class="<?php if (@$_GET['page'] == 'penilaian') {
                                                    echo 'active-menu';
                                                } ?>" href="?page=penilaian"><span class="nav-link-icon"><i data-feather="file"></i></span><span>Penilaian Ujian</span></a>
                                </li>
                                <li>
                                    <a class="<?php if (@$_GET['page'] == 'pelatihan') {
                                                    echo 'active-menu';
                                                } ?>" href="?page=pelatihan "><span class="nav-link-icon"><i data-feather="file"></i></span><span>Pelatihan Karyawan</span></a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="nav-link-icon"> <i data-feather="printer"></i> </span>
                                        <span>Laporan</span>
                                    </a>
                                    <ul>
                                        <li><a href="laporan/penguji.php" target="_blank">penguji</a></li>
                                        <li>
                                            <a href="#">Peserta</a>
                                            <ul>
                                                <li><a href="laporan/peserta.php" target="_blank">Semua Data </a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#peserta_alamat">Jabatan</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">Seleksi Berkas</a>
                                            <ul>
                                                <li><a href="laporan/ujian1.php" target="_blank">Lulus </a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#ujian1">Status </a></li>
                                            </ul>
                                        </li>
                                        <li><a href="laporan/ujian2.php" target="_blank">Tes Tertulis</a></li>
                                        <li>
                                            <a href="#">Penilain</a>
                                            <ul>
                                                <li><a href="laporan/nilai.php" target="_blank">Semua Data </a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#nilai_alamat">Jabatan</a></li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="laporan/ujian2.php" target="_blank">Tes Tertulis</a>
                                        </li>
                                        <li>
                                            <a href="laporan/lpelatihan.php" target="_blank">Pelatihan</a>
                                        </li>

                                    </ul>
                                </li>
                                <!-- END SIDEBAR MENU -->
                            </ul>
                        </div>
                    </div>

                    <?php include "modal.php" ?>
                    <!-- end::navigation -->

                    <!-- Content body -->
                    <div class="content-body">
                        <!-- Content -->
                        <div class="content ">

                            <?php
                            if (@$_GET['page'] == '') {
                                include "inc/beranda.php";
                            } else if (@$_GET['page'] == 'penguji') {
                                include "inc/penguji.php";
                            } else if (@$_GET['page'] == 'ruang') {
                                include "inc/ruang.php";
                            } else if (@$_GET['page'] == 'peserta') {
                                include "inc/peserta.php";
                            } else if (@$_GET['page'] == 'pesertaregistrasi') {
                                include "inc/pesertaregistrasi.php";
                            } else if (@$_GET['page'] == 'bahan_ujian') {
                                include "inc/bahan_ujian.php";
                            } else if (@$_GET['page'] == 'ujian1') {
                                include "inc/ujian1.php";
                            } else if (@$_GET['page'] == 'ujian2') {
                                include "inc/ujian2.php";
                            } else if (@$_GET['page'] == 'ujian3') {
                                include "inc/ujian3.php";
                            } else if (@$_GET['page'] == 'tes') {
                                include "inc/tes.php";
                            } else if (@$_GET['page'] == 'dashboard') {
                                include "inc/dashboard.php";
                            } else if (@$_GET['page'] == 'penilaian') {
                                include "inc/penilaian.php";
                            } else if (@$_GET['page'] == 'pelatihan') {
                                include "inc/pelatihan.php";
                            } else {
                                echo "<div class='col-xs-12'><div class='alert alert-danger'>[404] Halaman tidak ditemukan! Silahkan pilih menu yang ada!</div></div>";
                            } ?>

                        </div>
                        <!-- ./ Content -->

                        <!-- Footer -->
                        <footer class="content-footer">
                            <div>© 2023 PT.BMT - <a href="http://laborasyon.com/" target="_blank">PENERIMAAN KARYAWAN BARU</a></div>

                        </footer>
                        <!-- ./ Footer -->
                    </div>
                    <!-- ./ Content body -->
                </div>
                <!-- ./ Content wrapper -->
            </div>
            <!-- ./ Layout wrapper -->

            <!-- Main scripts -->
            <script src="../vendors/bundle.js"></script>

            <!-- Apex chart -->
            <script src="../vendors/charts/apex/apexcharts.min.js"></script>

            <!-- Daterangepicker -->
            <script src="../vendors/datepicker/daterangepicker.js"></script>

            <!-- DataTable -->
            <script src="../vendors/dataTable/datatables.min.js"></script>
            <script src="../assets/js/examples/datatable.js"></script>

            <!-- Prism -->
            <script src="../vendors/prism/prism.js"></script>

            <!-- Dashboard scripts -->
            <script src="../assets/js/examples/pages/dashboard.js"></script>

            <!-- App scripts -->
            <script src="../assets/js/app.min.js"></script>

    </body>

    <!-- Mirrored from gogi.laborasyon.com/demos/default/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Jun 2022 18:55:56 GMT -->

    </html>
<?php
} else {
    include "login.php";
}
?>