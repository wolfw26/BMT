<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    include "koneksi.php";
    include "tanggal.php";
    $bln = getBulan($periode); 
    {
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="shortcut icon" href="BMT.png"/>
		<title>LAPORAN Data Tes Wawancara</title>
	</head>
	<style type="text/css">
        .item_entry
        {
            border-collapse:collapse;
        }
        .item_entry th
        {
            border: solid 1px #000000;
            padding: 7px 7px;
        }
        .item_entry td
        {
            border: solid 1px #000000;
            padding: 9px 9px;
        }
        .item_entry thead  {
            background-color: #7ea5fe;
            color: #ffffff;
        }
        .genap
        {
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
	        html, body {
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
	<?php include "style.css"; ?>
	<body>
	<div class="book">

	    <div class="page">
	        <div class="subpage">


	        	<table width="100%">
			        <tbody>
			            <tr>
			                <td>
                                <a href="#">
                                    <img src="BMT.png" width="150" height="130" style="vertical-align: middle;">
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
			    </table> <hr> <br>

			    <p style="font-size: 14px;" align="center">
			    	<b>LAPORAN TES Wawancara</b>
			    </p> <br>

			    <table class="item_entry" width="100%" class="table display nowrap">
					<thead>
						<tr align="left">
                            <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">No</th>
                            <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">NAMA</th>
							<th style="font-size: 12px; vertical-align: middle; color: black;" align="center">NIK</th>
                            <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">RUANGAN</th>
                            <th style="font-size: 12px; vertical-align: middle; color: black;" align="center">NILAI</th> 
                        </tr>
					</thead>
					<tbody>
						<?php $nomor=1; ?>
                        <?php $ambil=$con->query("SELECT * FROM nilai_pilgan natural join peserta natural join topik_ujian natural join ruang ORDER BY nama_lengkap ASC"); ?>
                        <?php while ($pecah = $ambil->fetch_assoc()) { 
                        	$tgl1 = tgl_indo($pecah['tgl_lahir']); ?>
                        <tr>
                            <td style="font-size: 12px;" align="center"><?php echo $nomor; ?></td>
							<td style="font-size: 12px;"><?php echo $pecah['nama_lengkap']; ?></td>
                            <td style="font-size: 12px;"><?php echo $pecah['nik']; ?></td>
                            <td style="font-size: 12px;"><?php echo $pecah['kandidat']; ?> - <?php echo $pecah['ruangan']; ?></td>
                            <td style="font-size: 12px;"><?php echo $pecah['presentase']; ?></td> 
                        </tr>
                        <?php $nomor++; ?>
                        <?php } ?>
                    </tbody>
	    		</table> <br>


	    		<table align="right">
	                <tr>
		                <th style="font-size: 12px">Sebamban Baru, <?php echo tgl_indo(date('Y-m-d')); ?> <br> Mengetahui</th>
		            </tr>
		            <tr>
		                <th>&nbsp;</th>
		            </tr>
		            <tr>
		                <th>&nbsp;</th>
		            </tr> 
		            <tr>
					<th align="center" style="font-size: 12px"><u>Husmawan <br>HOD HRGA</u></th>
		            </tr> 
	            </table>
	          
	              
	        </div>    
	    </div> 

	</div>
	</body>
</html> 
<script type="text/javascript">window.print();</script>
<?php } ?>