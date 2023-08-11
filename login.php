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
    <title>Halaman Karyawan</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="BMT.png">

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

<body class="bg-warning">

    <main>

        </div>
        <div class="signup-form-wrapper">

            <?php if (@$_GET['page'] == '') { ?>

                <div class="signup-inner text-center">


                    <h3 class="title">Selamat Datang <br>
                        <!-- logo -->
                        <div id="logo">
                            <img src="BMT.png" width="120" alt="image">
                        </div>
                        <!-- ./ logo -->
                    </h3>

                    <?php
                    if (@$_POST['login']) {
                        $user = @mysqli_real_escape_string($db, $_POST['user']);
                        $pass = @mysqli_real_escape_string($db, $_POST['pass']);
                        $sql = mysqli_query($db, "SELECT * FROM peserta WHERE username = '$user' AND password = md5('$pass')") or die($db->error);
                        $data = mysqli_fetch_array($sql);
                        if (mysqli_num_rows($sql) > 0) {
                            if ($data['status'] == 'aktif') {
                                @$_SESSION['peserta'] = $data['id_peserta'];
                                echo "<script>window.location='./';</script>";
                            } else {
                                echo '<div class="alert alert-warning">Login gagal, akun Anda sedang tidak aktif</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger">Login gagal, username / password salah, coba lagi!</div>';
                        }
                    } ?>
                    <form class="signup-inner--form" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="single-field" placeholder="Masukan Username" name="user" autofocus required>
                            </div>
                            <div class="col-md-12">
                                <input type="password" class="single-field" placeholder="Masukan Password" name="pass" required>
                            </div>


                            <div class="col-12">
                                <input type="submit" name="login" value="Login" class="submit-btn" />
                            </div>
                            <hr>
                            <p class="text-muted">Silahkan daftar jika belum punya akun !!</p>
                            <a href="daftar.php">Daftar Sekarang</a>
                        </div>
                    </form>
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