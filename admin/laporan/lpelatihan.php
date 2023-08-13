<?php
include "koneksi.php";

$sql = "SELECT * FROM pelatihan";
$result = mysqli_query($con, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pelatihan</title>
    <style type="text/css">
        .item_entry {
            border-collapse: collapse;
        }

        .item_entry th {
            border: solid 1px #000000;
            padding: 7px 7px;
        }

        .item_entry td {
            border: solid 1px #000000;
            padding: 9px 9px;
        }

        .item_entry thead {
            background-color: #7ea5fe;
            color: #ffffff;
        }

        .genap {
            background-color: #cefdff;
        }
    </style>
    <style type="text/css">
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            font: 12pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 276mm;
            min-height: 190mm;
            padding: 20mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;
            border: 5px white solid;
            height: 257mm;
            outline: 2cm white solid;
        }

        @page {
            size: A4;
            margin: 0;
            size: landscape;
        }

        @media print {

            html,
            body {
                width: 276mm;
                height: 190mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="book">

        <div class="page">
            <div class="subpage">


                <table width="100%">
                    <tbody>
                        <tr>
                            <td>
                                <a href="#">
                                    <img src="BMT.png" width="150" height="130">
                                </a>
                            </td>
                            <td align="left">
                                <strong>PT. Bumi Putera Maha Terpercaya</strong> <br>
                                <small>Mining Contractor-Pertambangan, Coal Hauling, Heavy Equipment Rent & Transportation Company</small> <br>
                                <small>Alamat Site: Sebamban Baru,Kec. Angsana,Kab.Tanah Bumbu, Provinsi Kalimantan Selatan</small><br>
                                <small>phone No : +62 247 6436440</small>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr> <br>

                <p style="font-size: 14px;" align="center">
                    <b>LAPORAN PELATIHAN</b>
                </p> <br>

                <table class="item_entry" width="100%" class="table display nowrap">
                    <thead>
                        <tr align="left">
                            <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">NAMA</th>
                            <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">NILAI / GRADE</th>
                            <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">STATUS</th>
                            <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">TOTAL NILAI</th>
                            <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">TANGGAL PELATIHAN</th>
                            <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">TANGGAL SELESAI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $sql_pelatihan = $con->query("SELECT p.*, ps.nama_lengkap, n.* 
                        FROM pelatihan p
                        JOIN peserta ps ON p.id_peserta = ps.id_peserta
                        JOIN penilaian n ON p.id_nilai = n.id_nilai");
                        while ($data_pelatihan = $sql_pelatihan->fetch_assoc()) {
                        ?>
                            <!-- END tag PHP -->
                            <!-- kolom table -->
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data_pelatihan['nama_lengkap']; ?></td>
                                <td><?= $data_pelatihan['n_total']; ?> / <?= $data_pelatihan['grade']; ?></td>
                                <td><?= $data_pelatihan['status_nilai']; ?></td>
                                <td><?= date("d F Y", strtotime($data_pelatihan['tgl_mulai'])); ?></td>
                                <td><?= date("d F Y", strtotime($data_pelatihan['tgl_selesai'])); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table> <br>


                <table align="right">
                    <tr>
                        <th style="font-size: 12px">Sebamban Baru, <br> Mengetahui </th>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                    </tr>
                    <tr>
                        <th align="center" style="font-size: 12px"><u>HUSMAWAN <br> HOD HRGA</u></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript">
    window.print();
</script>

</html>