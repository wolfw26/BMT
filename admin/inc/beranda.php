<div class="page-header d-md-flex justify-content-between">
<body background = "assets/media/image/logoBMT.png" >
    <div>
        <h3>Selamat Datang</h3>
    </div>
    <div class="mt-3 mt-md-0">
        <a href="#" class="btn btn-primary ml-0 ml-md-2 mt-2 mt-md-0 ">
            <script type='text/javascript'>
            //-->
                var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                var date = new Date();
                var day = date.getDate();
                var month = date.getMonth();
                var thisDay = date.getDay(),
                    thisDay = myDays[thisDay];
                var yy = date.getYear();
                var year = (yy < 1000) ? yy + 1900 : yy;
                document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
            //-->
            </script> | 
            <span id="clock1"></span>
            <script type="text/javascript"> 
                function showTime() {
                   var a_p = "";
                    var today = new Date();
                    var curr_hour = today.getHours();
                    var curr_minute = today.getMinutes();
                    var curr_second = today.getSeconds();
                    if (curr_hour < 12) {
                        a_p = "AM";
                    } else {
                        a_p = "PM";
                    }
                    if (curr_hour == 0) {
                        curr_hour = 12;
                    }
                    if (curr_hour > 12) {
                        curr_hour = curr_hour - 12;
                    }
                    curr_hour = checkTime(curr_hour);
                    curr_minute = checkTime(curr_minute);
                    curr_second = checkTime(curr_second);
                   document.getElementById('clock1').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
                }
        
                function checkTime(i) {
                    if (i < 10) {
                        i = "0" + i;
                    }
                    return i;
                }
                setInterval(showTime, 500); 
            </script>
        </a>
    </div>
</div>
<?php
if(@$_SESSION['penguji']) {
?> 
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <div class="card-header">
                        <h5>Data Kelengkapan Berkas Pelamar </h5>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Peserta</th>
                                    <th>KTP</th>
                                    <th>R.Hidup</th>
                                    <th>S.Pernyataan</th>
                                    <th>Ijazah</th>
                                    <th>SK.Sehat</th>
                                    <th>Izin Atasan</th>
                                    <th class="text-center">Opsi</th>
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
                                        
                                        <td align="center" width="150px">
                                            <a href="verif.php?id_berkas=<?php echo $data_mapel['id_berkas']; ?>" class="badge badge-success" >Verifikasi</a>
                                            <a href="no_verif.php?id_berkas=<?php echo $data_mapel['id_berkas']; ?>" class="badge badge-warning" >Tidak Lolos</a>
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
</div>
<?php } ?>