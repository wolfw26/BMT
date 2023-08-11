<?php
@session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "koneksi.php";

$id_tq = @$_GET['id_tq'];
$no = 1;
$no2 = 1;
$sql_tq = mysqli_query($db, "SELECT * FROM topik_ujian JOIN bahan_ujian ON topik_ujian.id_bahan_ujian = bahan_ujian.id WHERE id_tq = '$id_tq'") or die ($db->error);
$data_tq = mysqli_fetch_array($sql_tq);
?>

<script>
    var waktunya;
    waktunya = <?php echo $data_tq['waktu_soal']; ?>;
    var waktu;
    var jalan = 0;
    var habis = 0;

    function init(){
        checkCookie();
        mulai();
    }
    function keluar(){
        if(habis==0){
            setCookie('waktux',waktu,365);
        }else{
            setCookie('waktux',0,-1);
        }
    }
    function mulai(){
        jam = Math.floor(waktu/3600);
        sisa = waktu%3600;
        menit = Math.floor(sisa/60);
        sisa2 = sisa%60
        detik = sisa2%60;
        if(detik<10){
            detikx = "0"+detik;
        }else{
            detikx = detik;
        }
        if(menit<10){
            menitx = "0"+menit;
        }else{
            menitx = menit;
        }
        if(jam<10){
            jamx = "0"+jam;
        }else{
            jamx = jam;
        }
        document.getElementById("divwaktu").innerHTML = jamx+" Jam : "+menitx+" Menit : "+detikx +" Detik";
        waktu --;
        if(waktu>0){
            t = setTimeout("mulai()",1000);
            jalan = 1;
        }else{
            if(jalan==1){
                clearTimeout(t);
            }
            habis = 1;
            document.getElementById("kirim").click();
        }
    }
    function selesai(){    
        if(jalan==1){
            clearTimeout(t);
        }
        habis = 1;
    }
    function getCookie(c_name){
        if (document.cookie.length>0){
            c_start=document.cookie.indexOf(c_name + "=");
            if (c_start!=-1){
                c_start=c_start + c_name.length+1;
                c_end=document.cookie.indexOf(";",c_start);
                if (c_end==-1) c_end=document.cookie.length;
                return unescape(document.cookie.substring(c_start,c_end));
            }
        }
        return "";
    }
    function setCookie(c_name,value,expiredays){
        var exdate=new Date();
        exdate.setDate(exdate.getDate()+expiredays);
        document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
    }
    function checkCookie(){
        waktuy=getCookie('waktux');
        if (waktuy!=null && waktuy!=""){
            waktu = waktuy;
        }else{
            waktu = waktunya;
            setCookie('waktux',waktunya,7);
        }
    }
    </script>
    <script type="text/javascript">
        window.history.forward();
        function noBack(){ window.history.forward(); }
    </script>

    <script src="jquery-1.11.1.js"></script>

<?php
if(@$_SESSION['peserta']) { ?>

<!doctype html>
<html class="no-js" lang="en">


<!-- Mirrored from htmldemo.net/adda/adda/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 15 Jul 2022 23:08:36 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Adda - Social Network HTML Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="dist/images/favicon.ico">

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

    <style type="text/css">
    .mrg-del {
        margin: 0;
        padding: 0;
    }
    </style> 

</head>

<body onload="init(),noBack();" onpageshow="if (event.persisted) noBack();" onunload="keluar()">>

    
    <div class="row">
        <div class="col-lg-6 order-1 order-lg-2">  
            <div class="card">
                <div class="card-header">
                    <h5>Soal Ujian Tahap Tertulis</h5>
                </div>
                <div class="post-content">
                    <h5 class="page-head-line">Judul : <u><?php echo $data_tq['judul']; ?></u><br />  Ujian : <u><?php echo $data_tq['bahan_ujian']; ?></u></h5>
                </div>
            </div> 
        </div>

        <div class="col-lg-6 order-1 order-lg-2">  
            <div class="card">
                <div class="card-header">
                    <b>Info <small>(Sisa waktu Anda)</small></b>
                </div>
                <div class="card-body">
                    <h3 align="center"><span id="divwaktu"></span></h3>
                </div>
            </div>
        </div>

    </div>

    <main>

        <div class="main-wrapper pt-80">
            <div class="container">
                <div class="col-lg-12 order-1 order-lg-2">  
            <div class="card">
                <div class="card-header">
                    <b>Info <small>(Sisa waktu Anda)</small></b>
                </div>
                <div class="card-body">
                    <form action="inc/proses_soal.php" method="post">
                        <?php
                        $sql_soal_pilgan = mysqli_query($db, "SELECT * FROM soal_pilgan WHERE id_tq = '$id_tq' ORDER BY rand()") or die ($db->error);
                        if(mysqli_num_rows($sql_soal_pilgan) > 0) {
                        ?>
                            <div class="panel panel-default">
                                <div class="panel-heading"><b>Soal Pilihan Ganda</b></div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <?php
                                        while($data_soal_pilgan = mysqli_fetch_array($sql_soal_pilgan)) { ?>
                                            <table class="table">
                                                <tr>
                                                    <td width="10%">( <?php echo $no++; ?> )</td>
                                                    <td><b><?php echo $data_soal_pilgan['pertanyaan']; ?></b></td>
                                                </tr>
                                                <?php if($data_soal_pilgan['gambar'] != '') { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <img width="500px" src="admin/img/gambar_soal_pilgan/<?php echo $data_soal_pilgan['gambar']; ?>" />
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div class="radio mrg-del">
                                                            <label>
                                                                <input type="radio" name="soal_pilgan[<?php echo $data_soal_pilgan['id_pilgan']; ?>]" value="A" /> A. <?php echo $data_soal_pilgan['pil_a']; ?>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div class="radio mrg-del">
                                                            <label>
                                                                <input type="radio" name="soal_pilgan[<?php echo $data_soal_pilgan['id_pilgan']; ?>]" value="B" /> B. <?php echo $data_soal_pilgan['pil_b']; ?>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div class="radio mrg-del">
                                                            <label>
                                                                <input type="radio" name="soal_pilgan[<?php echo $data_soal_pilgan['id_pilgan']; ?>]" value="C" /> C. <?php echo $data_soal_pilgan['pil_c']; ?>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div class="radio mrg-del">
                                                            <label>
                                                                <input type="radio" name="soal_pilgan[<?php echo $data_soal_pilgan['id_pilgan']; ?>]" value="D" /> D. <?php echo $data_soal_pilgan['pil_d']; ?>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                   
                                                </tr>
                                            </table>
                                        <?php
                                        } ?>
                                        <input type="hidden" name="jumlahsoalpilgan" value="<?php echo mysqli_num_rows($sql_soal_pilgan); ?>" />
                                    </div>
                                </div>
                            </div>
                        <?php
                        }

                        $sql_soal_essay = mysqli_query($db, "SELECT * FROM soal_essay WHERE id_tq = '$id_tq' ORDER BY rand()") or die ($db->error);
                        if(mysqli_num_rows($sql_soal_essay) > 0) {
                        ?> 

                        <?php if ($data_log['status_berkas']=="Lanjut Tahap 3"): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading"><b>Soal Essay</b></div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <?php
                                        while($data_soal_essay = mysqli_fetch_array($sql_soal_essay)) { ?>
                                            <table class="table">
                                                <tr>
                                                    <td width="10%">( <?php echo $no2++; ?> )</td>
                                                    <td><b><?php echo $data_soal_essay['pertanyaan']; ?></b></td>
                                                </tr>
                                                <?php if($data_soal_essay['gambar'] != '') { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td>
                                                            <img width="660px" src="admin/img/gambar_soal_essay/<?php echo $data_soal_essay['gambar']; ?>" />
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td>Jawab</td>
                                                    <td>
                                                        <textarea name="soal_essay[<?php echo $data_soal_essay['id_essay']; ?>]" class="form-control" rows="3"></textarea>
                                                    </td>
                                                </tr>
                                            </table>
                                        <?php
                                        } ?>
                                    </div>
                                </div>
                            </div> 
                            <?php endif ?>
                        <?php
                        } ?>
                        
                        <input type="hidden" name="id_tq" value="<?php echo $id_tq; ?>" />

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div>
                                    <a id="selesai" class="btn btn-info">Selesai</a> &nbsp;
                                    <input type="reset" value="Reset Jawaban"  />
                                </div>
                                <div id="konfirm" style="display:none; margin-top:15px;">
                                    Apakah Anda yakin sudah selesai mengerjakan soal dan akan mengirim jawaban? &nbsp; <input onclick="selesai();" type="submit" id="kirim" value="Ya" class="btn btn-info btn-sm" />
                                </div>
                                <script type="text/javascript">
                                $("#selesai").click(function() {
                                    $("#konfirm").fadeIn(1000);
                                });
                                </script>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
} else {
    echo "<script>window.location='./';</script>";
} ?>