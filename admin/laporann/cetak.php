<?php
@session_start();
include "../../koneksi.php";
include "fpdf.php";

$pdf = new FPDF('L','mm','A4');
$pdf->SetMargins(15,20,15);
$pdf->AddPage();

$pdf->Image('../../style/assets/img/logo2.png',15,18,16);
$pdf->SetTitle("Cetak Data");
$pdf->SetFont('Arial','B',18);
$pdf->Cell(0,5,'SMK INDONESIA','0','1','C',false);
$pdf->SetFont('Arial','i',8);
$pdf->Cell(0,5,'Alamat : Jln. Merdeka No. 1, Jakarta, Indonesia','0','1','C',false);
$pdf->Cell(0,2,'Telp : (xxx) xxxxxx - Email : admin@smkindonesia.com','0','1','C',false);
$pdf->Ln(3);
$pdf->Cell(265,0.6,'','0','1','C',true);
$pdf->Ln(5);

if(@$_GET['data'] == "penguji") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Tenaga penguji','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,6,'No.',1,0,'C');
	$pdf->Cell(25,6,'NIP',1,0,'C');
	$pdf->Cell(40,6,'Nama Lengkap',1,0,'C');
	$pdf->Cell(40,6,'TTL',1,0,'C');
	$pdf->Cell(23,6,'Jenis Kelamin',1,0,'C');
	$pdf->Cell(20,6,'Agama',1,0,'C');
	$pdf->Cell(33,6,'Jabatan',1,0,'C');
	$pdf->Cell(52,6,'Alamat',1,0,'C');
	$pdf->Cell(22,6,'Status Akun',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	$sql = mysqli_query($db, "SELECT * FROM penguji ORDER BY id_penguji ASC") or die ($db->error);
	while($data = mysqli_fetch_array($sql)) {
		if($data['jenis_kelamin'] == 'L') { $jk = "Laki-laki"; } else { $jk = "Perempuan"; }
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,4,$no++.".",1,0,'C');
		$pdf->Cell(25,4,$data['nip'],1,0,'L');
		$pdf->Cell(40,4,$data['nama_lengkap'],1,0,'L');
		$pdf->Cell(40,4,$data['tempat_lahir'].", ".tgl_indo($data['tgl_lahir']),1,0,'L');
		$pdf->Cell(23,4,$jk,1,0,'C');
		$pdf->Cell(20,4,$data['agama'],1,0,'C');
		$pdf->Cell(33,4,$data['jabatan'],1,0,'L');
		$pdf->Cell(52,4,$data['alamat'],1,0,'L');
		$pdf->Cell(22,4,ucfirst($data['status']),1,0,'C');
	}
} else if(@$_GET['data'] == "siswa") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Siswa yang Aktif','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(7,6,'No.',1,0,'C');
	$pdf->Cell(19,6,'NIS',1,0,'C');
	$pdf->Cell(32,6,'Nama Lengkap',1,0,'C');
	$pdf->Cell(36,6,'TTL',1,0,'C');
	$pdf->Cell(12,6,'Kelamin',1,0,'C');
	$pdf->Cell(17,6,'Agama',1,0,'C');
	$pdf->Cell(20,6,'Nama Ayah',1,0,'C');
	$pdf->Cell(20,6,'Nama Ibu',1,0,'C');
	$pdf->Cell(19,6,'No. Telepon',1,0,'C');
	$pdf->Cell(35,6,'Email',1,0,'C');
	$pdf->Cell(38,6,'Alamat',1,0,'C');
	$pdf->Cell(10,6,'Kelas',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	$sql = mysqli_query($db, "SELECT * FROM peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE status = 'aktif' ORDER BY id_peserta ASC") or die ($db->error);
	while($data = mysqli_fetch_array($sql)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(7,4,$no++.".",1,0,'C');
		$pdf->Cell(19,4,$data['nis'],1,0,'L');
		$pdf->Cell(32,4,$data['nama_lengkap'],1,0,'L');
		$pdf->Cell(36,4,$data['tempat_lahir'].", ".tgl_indo($data['tgl_lahir']),1,0,'L');
		$pdf->Cell(12,4,$data['jenis_kelamin'],1,0,'C');
		$pdf->Cell(17,4,$data['agama'],1,0,'C');
		$pdf->Cell(20,4,$data['nama_ayah'],1,0,'L');
		$pdf->Cell(20,4,$data['nama_ibu'],1,0,'L');
		$pdf->Cell(19,4,$data['no_telp'],1,0,'L');
		$pdf->Cell(35,4,$data['email'],1,0,'L');
		$pdf->Cell(38,4,$data['alamat'],1,0,'L');
		$pdf->Cell(10,4,$data['kandidat'],1,0,'C');
	}
} else if(@$_GET['data'] == "siswaregistrasi") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Siswa yang Mendaftar dan Belum Dikonfirmasi','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',7);
	$pdf->Cell(7,6,'No.',1,0,'C');
	$pdf->Cell(19,6,'NIS',1,0,'C');
	$pdf->Cell(32,6,'Nama Lengkap',1,0,'C');
	$pdf->Cell(36,6,'TTL',1,0,'C');
	$pdf->Cell(12,6,'Kelamin',1,0,'C');
	$pdf->Cell(17,6,'Agama',1,0,'C');
	$pdf->Cell(20,6,'Nama Ayah',1,0,'C');
	$pdf->Cell(20,6,'Nama Ibu',1,0,'C');
	$pdf->Cell(19,6,'No. Telepon',1,0,'C');
	$pdf->Cell(35,6,'Email',1,0,'C');
	$pdf->Cell(38,6,'Alamat',1,0,'C');
	$pdf->Cell(10,6,'Kelas',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	$sql = mysqli_query($db, "SELECT * FROM peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE status = 'tidak aktif' ORDER BY id_peserta ASC") or die ($db->error);
	while($data = mysqli_fetch_array($sql)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(7,4,$no++.".",1,0,'C');
		$pdf->Cell(19,4,$data['nis'],1,0,'L');
		$pdf->Cell(32,4,$data['nama_lengkap'],1,0,'L');
		$pdf->Cell(36,4,$data['tempat_lahir'].", ".tgl_indo($data['tgl_lahir']),1,0,'L');
		$pdf->Cell(12,4,$data['jenis_kelamin'],1,0,'C');
		$pdf->Cell(17,4,$data['agama'],1,0,'C');
		$pdf->Cell(20,4,$data['nama_ayah'],1,0,'L');
		$pdf->Cell(20,4,$data['nama_ibu'],1,0,'L');
		$pdf->Cell(19,4,$data['no_telp'],1,0,'L');
		$pdf->Cell(35,4,$data['email'],1,0,'L');
		$pdf->Cell(38,4,$data['alamat'],1,0,'L');
		$pdf->Cell(10,4,$data['kandidat'],1,0,'C');
	}
} else if(@$_GET['data'] == "bahan_ujian") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Mata Pelajaran','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,6,'No.',1,0,'C');
	$pdf->Cell(40,6,'Kode Mata Pelajaran',1,0,'C');
	$pdf->Cell(60,6,'Nama Mata Pelajaran',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	$sql = mysqli_query($db, "SELECT * FROM bahan_ujian") or die ($db->error);
	while($data = mysqli_fetch_array($sql)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,4,$no++.".",1,0,'C');
		$pdf->Cell(40,4,$data['kode_bahan_ujian'],1,0,'C');
		$pdf->Cell(60,4,$data['bahan_ujian'],1,0,'L');
	}
} else if(@$_GET['data'] == "kelas") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Daftar Kelas, Letak Ruang, Wali dan Ketua Masing-masing Kelas di SMK Indonesia','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,6,'No.',1,0,'C');
	$pdf->Cell(30,6,'Nama Kelas',1,0,'C');
	$pdf->Cell(30,6,'Letak Ruang',1,0,'C');
	$pdf->Cell(50,6,'Wali Kelas',1,0,'C');
	$pdf->Cell(50,6,'Ketua Kelas',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	$sql = mysqli_query($db, "SELECT * FROM ruang") or die ($db->error);
	while($data = mysqli_fetch_array($sql)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,4,$no++.".",1,0,'C');
		$pdf->Cell(30,4,$data['kandidat'],1,0,'C');
		$pdf->Cell(30,4,$data['ruang'],1,0,'C');
		$sql_tampil_guru = tampil_per_id("penguji", "id_penguji = '$data[penguji]'");
        $data_tampil_guru = mysqli_fetch_array($sql_tampil_guru);
        $cek_tampil_guru = mysqli_num_rows($sql_tampil_guru);
        if($cek_tampil_guru > 0) {
        	$pdf->Cell(50,4,$data_tampil_guru['nama_lengkap'],1,0,'L');
        } else {
            $pdf->Cell(50,4,"Belum diatur",1,0,'L');
        }
		
		$sql_tampil_siswa = tampil_per_id("peserta", "id_peserta = '$data[ketua_kelas]'");
	    $data_tampil_siswa = mysqli_fetch_array($sql_tampil_siswa);
	    $cek_tampil_siswa = mysqli_num_rows($sql_tampil_siswa);
	    if($cek_tampil_siswa > 0) {
	    	$pdf->Cell(50,4,$data_tampil_siswa['nama_lengkap'],1,0,'L');
	    } else {
	        $pdf->Cell(50,4,"Belum diatur",1,0,'L');
	    }
	}
} else if(@$_GET['data'] == "materi") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Materi','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,6,'No.',1,0,'C');
	$pdf->Cell(45,6,'Judul',1,0,'C');
	$pdf->Cell(20,6,'Kelas',1,0,'C');
	$pdf->Cell(40,6,'bahan_ujian',1,0,'C');
	$pdf->Cell(75,6,'Nama File',1,0,'C');
	$pdf->Cell(30,6,'Tanggal Posting',1,0,'C');
	$pdf->Cell(30,6,'Pembuat',1,0,'C');
	$pdf->Cell(15,6,'Dilihat',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	if(@$_SESSION['admin']) {
        $sql_materi = mysqli_query($db, "SELECT * FROM file_materi JOIN ruang ON file_materi.id_ruang = ruang.id_ruang JOIN bahan_ujian ON file_materi.id_bahan_ujian = bahan_ujian.id") or die($db->error);
    } else if(@$_SESSION['penguji']) {
    	$sql_materi = mysqli_query($db, "SELECT * FROM file_materi JOIN ruang ON file_materi.id_ruang = ruang.id_ruang JOIN bahan_ujian ON file_materi.id_bahan_ujian = bahan_ujian.id WHERE pembuat = '$_SESSION[penguji]'") or die($db->error);
    }
	while($data = mysqli_fetch_array($sql_materi)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,4,$no++.".",1,0,'C');
		$pdf->Cell(45,4,$data['judul'],1,0,'C');
		$pdf->Cell(20,4,$data['kandidat'],1,0,'C');
		$pdf->Cell(40,4,$data['bahan_ujian'],1,0,'L');
		$pdf->Cell(75,4,$data['nama_file'],1,0,'L');
		$pdf->Cell(30,4,tgl_indo($data['tgl_posting']),1,0,'C');
		if($data['pembuat'] == 'admin') {
			$pdf->Cell(30,4,"Admin",1,0,'L');
		} else {
			$sql_pengajar = mysqli_query($db, "SELECT * FROM penguji WHERE id_penguji = '$data[pembuat]'") or die($db->error);
			$data_pengajar = mysqli_fetch_array($sql_pengajar);
			$pdf->Cell(30,4,$data_pengajar['nama_lengkap'],1,0,'L');
		}
		$pdf->Cell(15,4,$data['hits']." kali",1,0,'C');
	}
} else if(@$_GET['data'] == "topikquiz") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Topik Quiz / Tugas','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,6,'No.',1,0,'C');
	$pdf->Cell(50,6,'Judul',1,0,'C');
	$pdf->Cell(15,6,'Kelas',1,0,'C');
	$pdf->Cell(40,6,'bahan_ujian',1,0,'C');
	$pdf->Cell(27,6,'Tanggal Buat',1,0,'C');
	if(@$_SESSION['admin']) {
		$pdf->Cell(25,6,'Pembuat',1,0,'C');
	}
	$pdf->Cell(20,6,'Waktu Soal',1,0,'C');
	$pdf->Cell(60,6,'Info',1,0,'C');
	$pdf->Cell(18,6,'Status',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	if(@$_SESSION['admin']) {
	    $sql_topik = mysqli_query($db, "SELECT * FROM topik_ujian JOIN ruang ON topik_ujian.id_ruang = ruang.id_ruang JOIN bahan_ujian ON topik_ujian.id_bahan_ujian = bahan_ujian.id ORDER BY tgl_buat ASC") or die ($db->error);
	} else if(@$_SESSION['penguji']) {
	    $sql_topik = mysqli_query($db, "SELECT * FROM topik_ujian JOIN ruang ON topik_ujian.id_ruang = ruang.id_ruang JOIN bahan_ujian ON topik_ujian.id_bahan_ujian = bahan_ujian.id WHERE pembuat != 'admin' AND pembuat = '$_SESSION[penguji]' ORDER BY tgl_buat ASC") or die ($db->error);
	} 
	while($data = mysqli_fetch_array($sql_topik)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,4,$no++.".",1,0,'C');
		$pdf->Cell(50,4,$data['judul'],1,0,'L');
		$pdf->Cell(15,4,$data['kandidat'],1,0,'C');
		$pdf->Cell(40,4,$data['bahan_ujian'],1,0,'L');
		$pdf->Cell(27,4,tgl_indo($data['tgl_buat']),1,0,'C');
		if(@$_SESSION['admin']) {
            if($data['pembuat'] == 'admin') {
                $pdf->Cell(25,4,"Admin",1,0,'L');
            } else {
                $sql1 = mysqli_query($db, "SELECT * FROM penguji WHERE id_penguji = '$data[pembuat]'") or die($db->error);
                $data1 = mysqli_fetch_array($sql1);
                $pdf->Cell(25,4,$data1['nama_lengkap'],1,0,'L');
            }
        }
		$pdf->Cell(20,4,$data['waktu_soal'] / 60 ." menit",1,0,'L');
		$pdf->Cell(60,4,$data['info'],1,0,'L');
		$pdf->Cell(18,4,ucfirst($data['status']),1,0,'C');
	}
} else if(@$_GET['data'] == "berita") {
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Materi','0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,6,'No.',1,0,'C');
	$pdf->Cell(78,6,'Judul',1,0,'C');
	$pdf->Cell(108,6,'Isi',1,0,'C');
	$pdf->Cell(27,6,'Tanggal Posting',1,0,'C');
	$pdf->Cell(27,6,'Penerbit',1,0,'C');
	$pdf->Cell(15,6,'Status',1,0,'C');
	$pdf->Ln(2);
	$no = 1;
	if(@$_SESSION['admin']) {
        $sql_berita = mysqli_query($db, "SELECT * FROM berita") or die($db->error);
    } else if(@$_SESSION['penguji']) {
    	$sql_berita = mysqli_query($db, "SELECT * FROM berita WHERE penerbit = '$_SESSION[penguji]'") or die($db->error);
    }
	while($data = mysqli_fetch_array($sql_berita)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,4,$no++.".",1,0,'C');
		$pdf->Cell(78,4,$data['judul'],1,0,'L');
		$pdf->Cell(108,4,substr($data['isi'], 0, 70)." ...",1,0,'L');
		$pdf->Cell(27,4,tgl_indo($data['tgl_posting']),1,0,'C');
		if($data['penerbit'] == 'admin') {
			$pdf->Cell(27,4,'Admin',1,0,'L');
		} else {
			$sql_pengajar = mysqli_query($db, "SELECT * FROM penguji WHERE id_penguji = '$data[penerbit]'") or die($db->error);
			$data_pengajar = mysqli_fetch_array($sql_pengajar);
			$pdf->Cell(27,4,$data_pengajar['nama_lengkap'],1,0,'L');
		}
		$pdf->Cell(15,4,ucfirst($data['status']),1,0,'C');
	}
} else if(@$_GET['data'] == "quiz") {
	$id_tq = @$_GET['id_tq'];
	$sql_tq = mysqli_query($db, "SELECT * FROM topik_ujian JOIN bahan_ujian ON topik_ujian.id_bahan_ujian = bahan_ujian.id WHERE id_tq = '$id_tq'") or die($db->error);
	$data_tq = mysqli_fetch_array($sql_tq);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Siswa Beserta Nilainya yang Mengikuti Ujian','0','1','L',false);
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(50,5,'Judul : '.$data_tq['judul'],'0','1','L',false);
	$pdf->Cell(50,5,'bahan_ujian : '.$data_tq['bahan_ujian'],'0','1','L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(10,6,'No.',1,0,'C');
	$pdf->Cell(45,6,'Nama Siswa',1,0,'C');
	$pdf->Cell(15,6,'Kelas',1,0,'C');
	$pdf->Cell(130,6,'Hasil',1,0,'C');;
	$pdf->Ln(2);
	$no = 1;
	$sql_siswa_mengikuti_tes = mysqli_query($db, "SELECT * FROM nilai_pilgan JOIN peserta ON nilai_pilgan.id_peserta = peserta.id_peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE id_tq = '$id_tq'") or die ($db->error);
	while($data_siswa_mengikuti_tes = mysqli_fetch_array($sql_siswa_mengikuti_tes)) {
		$pdf->Ln(4);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(10,4,$no++.".",1,0,'C');
		$pdf->Cell(45,4,$data_siswa_mengikuti_tes['nama_lengkap'],1,0,'L');
		$pdf->Cell(15,4,$data_siswa_mengikuti_tes['nama_ruang'],1,0,'C');
			$sql_pilgan = mysqli_query($db, "SELECT * FROM nilai_pilgan WHERE id_peserta = '$data_siswa_mengikuti_tes[id_peserta]' AND id_tq = '$id_tq'") or die ($db->error);
	    	$data_pilgan = mysqli_fetch_array($sql_pilgan);
	        $sql_jwb = mysqli_query($db, "SELECT * FROM jawaban WHERE id_peserta = '$data_siswa_mengikuti_tes[id_peserta]' AND id_tq = '$id_tq'") or die ($db->error);
	    	$sql_essay = mysqli_query($db, "SELECT * FROM nilai_essay WHERE id_peserta = '$data_siswa_mengikuti_tes[id_peserta]' AND id_tq = '$id_tq'") or die ($db->error);
	    	$data_essay = mysqli_fetch_array($sql_essay);
	    	if(mysqli_num_rows($sql_jwb) > 0) {
        		if(mysqli_num_rows($sql_essay) > 0) {
        			$nilai_essay = $data_essay['nilai'];
        		} else {
        			$nilai_essay = "Belum dikoreksi";
        		}
            } else {
                $nilai_essay = "Tidak ada soal essay";
            }
            if(is_numeric($nilai_essay)) {
            	$output = "Nilai pilgan : [".$data_pilgan['presentase']."]. Nilai essay : [".$nilai_essay."]. Nilai total : [". ($data_pilgan['presentase'] + $data_essay['nilai']) / 2 ."]";
            } else if($nilai_essay == 'Belum dikoreksi') {
            	$output = "Nilai pilgan : [".$data_pilgan['presentase']."]. Nilai essay : [".$nilai_essay."]. Nilai total : [ Menunggu soal essay dikoreksi]";
            } else if($nilai_essay == 'Tidak ada soal essay') {
            	$output = "Nilai pilgan : [".$data_pilgan['presentase']."]. Nilai essay : [".$nilai_essay."]. Nilai total : [".$data_pilgan['presentase']."]";
            }
		$pdf->Cell(130,4, $output,1,0,'L');
	}
} else if(@$_GET['data'] == "nilaipersiswa") {
	$sql_siswa_login = mysqli_query($db, "SELECT * FROM peserta JOIN ruang ON peserta.id_ruang = ruang.id_ruang WHERE peserta.id_peserta = '$_SESSION[siswa]'");
	$data_siswa_login = mysqli_fetch_array($sql_siswa_login);
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(50,5,'Laporan Data Nilai Siswa','0','1','L',false);
	$pdf->Ln(5);
	$pdf->SetFont('Arial','i',10);
	$pdf->Cell(25,6,'Nama Siswa',0,0,'L',false);
	$pdf->Cell(5,6,':',0,0,'C',false);
	$pdf->Cell(40,6,$data_siswa_login['nama_lengkap'],0,0,'L',false);
	$pdf->Ln(4);
	$pdf->Cell(25,6,'Kelas',0,0,'L',false);
	$pdf->Cell(5,6,':',0,0,'C',false);
	$pdf->Cell(40,6,$data_siswa_login['nama_ruang'],0,2,'L',false);
	$pdf->Ln(3);

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(9,6,'No.',1,0,'C');
	$pdf->Cell(45,6,'bahan_ujian',1,0,'C');
	$pdf->Cell(50,6,'Judul Ujian',1,0,'C');
	$pdf->Cell(65,6,'Presentase Pilgan',1,0,'C');
	$pdf->Cell(65,6,'Presentase Essay',1,0,'C');
	$pdf->Cell(30,6,'Nilai Total',1,0,'C');
	$no = 1;
    $sql_nilai_pilgan = mysqli_query($db, "SELECT * FROM nilai_pilgan JOIN topik_ujian ON nilai_pilgan.id_tq = topik_ujian.id_tq JOIN bahan_ujian ON topik_ujian.id_bahan_ujian = bahan_ujian.id WHERE id_peserta = '$_SESSION[siswa]'") or die($db->error);
	while($data_nilai_pilgan = mysqli_fetch_array($sql_nilai_pilgan)) {
		$pdf->Ln(6);
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(9,6,$no++,1,0,'C');
		$pdf->Cell(45,6,$data_nilai_pilgan['bahan_ujian'],1,0,'C');
		$pdf->Cell(50,6,$data_nilai_pilgan['judul'],1,0,'C');
		$pdf->Cell(65,6,$data_nilai_pilgan['presentase'],1,0,'C');

		$sql_cek_jawaban = mysqli_query($db, "SELECT * FROM jawaban WHERE id_tq = '$data_nilai_pilgan[id_tq]' AND id_peserta = '$_SESSION[siswa]'") or die ($db->error);
		$data_jawaban = mysqli_fetch_array($sql_cek_jawaban);
		if(mysqli_num_rows($sql_cek_jawaban) > 0) {
			$sql_cek_nilai_essay = mysqli_query($db, "SELECT * FROM nilai_essay WHERE id_tq = '$data_nilai_pilgan[id_tq]' AND id_peserta = '$_SESSION[siswa]'") or die ($db->error);
			$data_nilai_essay = mysqli_fetch_array($sql_cek_nilai_essay);
			if(mysqli_num_rows($sql_cek_nilai_essay) > 0) {
				$pdf->Cell(65,6,$data_nilai_essay['nilai'],1,0,'C');
				$tot = 
				$pdf->Cell(30,6,(($data_nilai_pilgan['presentase'] + $data_nilai_essay['nilai']) / 2), 1,0,'C');
			} else {
				$pdf->Cell(65,6,'Soal essay belum dikoreksi',1,0,'C');
				$pdf->Cell(30,6,'Menunggu soal essay dikoreksi',1,0,'C');
			}
		} else {
			$pdf->Cell(65,6,'Ujian ini tidak ada soal essay',1,0,'C');
			$pdf->Cell(30,6,$data_nilai_pilgan['presentase'],1,0,'C');
		}
	}
}

$pdf->Ln(50);
$pdf->SetLeftMargin(230);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,0,"Indonesia, ".tgl_indo(date('Y-m-d')),0,0,'L');

$pdf->Output();
?>