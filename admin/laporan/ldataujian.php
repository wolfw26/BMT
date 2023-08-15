<?php
$dataUjian = isset($_GET['data']) ? json_decode(urldecode($_GET['data']), true) : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Ujian</title>
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
                    <b>LAPORAN DATA UJIAN</b>
                </p> <br>
                <?php
                if (count($dataUjian) > 0) {
                ?>
                    <table class="item_entry" width="100%" class="table display nowrap">
                        <thead>
                            <tr align="left">
                                <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">JUDUL</th>
                                <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">JABATAN</th>
                                <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">JENIS</th>
                                <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">PEMBUAT</th>
                                <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">WAKTU</th>
                                <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">DESKRIPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($dataUjian as $ujian) {
                            ?>
                                <tr>
                                    <td><?= $ujian['judul']; ?></td>
                                    <td><?= $ujian['kandidat']; ?></td>
                                    <td><?= $ujian['bahan_ujian']; ?></td>
                                    <td><?= $ujian['nama_lengkap']; ?></td>
                                    <td><?= $ujian['waktu_soal']; ?> Menit</td>
                                    <td><?= $ujian['info']; ?></td>
                                </tr>
                            <?php } ?>
                            <!-- END tag PHP -->
                            <!-- kolom table -->
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                    <br>
                <?php
                } else {
                ?>
                    <h3>Tidak ada data</h3>
                <?php } ?>


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