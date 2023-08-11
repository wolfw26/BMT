<?php
@session_start();
if (@$_SESSION['admin'] || @$_SESSION['penguji']) {
    echo "<script>window.location='./';</script>";
} else {
?>

    <!doctype html>
    <html lang="en">

    <!-- Mirrored from gogi.laborasyon.com/demos/default/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Jun 2022 18:56:38 GMT -->

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Penerimaan Panwascam</title>

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="logoBMT.png">
        <!-- Plugin styles -->
        <link rel="stylesheet" href="../vendors/bundle.css" type="text/css">

        <!-- App styles -->
        <link rel="stylesheet" href="../assets/css/app.min.css" type="text/css">
    </head>

    <body class="form-membership bg-warning ">

        <!-- begin::preloader-->
        <div class="preloader">
            <div class="preloader-icon"></div>
        </div>
        <!-- end::preloader -->

        <div class="form-wrapper">

            <div id="logo">
                <img src="../assets/media/image/logoBMT.png" width="200" alt="image">
            </div>
            <h5>Selamat Datang <br> <small>Silahkan Login untuk melanjutkan</small>

                <!-- form -->
                <div class="login-container">
                    <div id="output"></div>
                    <div class="avatar"></div>
                    <div class="form-box">
                        <div class="form-group">
                            <input type="text" class="form-control" name="user" placeholder="Username" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="pass" placeholder="Password">
                        </div>
                        <button class="btn btn-primary btn-block login bg-warning" type="submit">Login</button>
                        <button class="btn btn-info btn-block continue" style="display:none;">Continue</button>
                    </div>
                    <!-- ./ form -->
                </div>


        </div>

        <!-- Plugin scripts -->
        <script src="../vendors/bundle.js"></script>

        <!-- App scripts -->
        <script src="../assets/js/app.min.js"></script>
        <script src="jquery-1.10.2.js"></script>
        <script type="text/javascript">
            var user = $("input[name=user]");
            var pass = $("input[name=pass]");

            function proses_login() {
                if (user.val() == "") {
                    $("#output").removeClass('alert alert-success');
                    $("#output").addClass("alert alert-danger animated fadeInUp").html("Username tidak boleh kosong");
                    user.focus();
                } else if (pass.val() == "") {
                    $("#output").removeClass('alert alert-success');
                    $("#output").addClass("alert alert-danger animated fadeInUp").html("Password tidak boleh kosong");
                    pass.focus();
                } else {
                    $.ajax({
                        url: 'inc/proses_login.php',
                        type: 'post',
                        data: 'user=' + user.val() + '&pass=' + pass.val(),
                        success: function(msg) {
                            if (msg == 'sukses') {
                                $("#output").addClass("alert alert-success animated fadeInUp").html("Selamat datang " + "<span><b><i>" + user.val() + "</i></u></span>");
                                $("#output").removeClass('alert-danger');
                                $("input").hide();
                                $('button[type="submit"]').hide();
                                $(".continue").fadeIn(1000);
                                $(".avatar").css({
                                    "background-image": "url('style/assets/img/avatar.png')"
                                });
                            } else if (msg == 'akun tidak aktif') {
                                $("#output").removeClass('alert alert-warning');
                                $("#output").addClass("alert alert-danger animated fadeInUp").html("Login gagal, akun Anda tidak aktif");
                            } else if (msg == 'gagal') {
                                $("#output").removeClass('alert alert-success');
                                $("#output").addClass("alert alert-danger animated fadeInUp").html("Login gagal, coba lagi");
                            }
                        }
                    });
                }
            }
            $('button[type="submit"]').click(function(e) {
                e.preventDefault();
                proses_login();
            });
            $(pass).keyup(function(e) {
                if (e.keyCode == 13) {
                    proses_login();
                }
            });

            $(function() {
                $(".continue").click(function() {
                    window.location = './';
                });
            });
        </script>
    </body>

    <!-- Mirrored from gogi.laborasyon.com/demos/default/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 24 Jun 2022 18:56:38 GMT -->

    </html>
<?php
}
?>