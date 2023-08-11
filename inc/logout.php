<?php
@session_start();

if(@$_GET['sesi'] == 'admin') {
	@$_SESSION['admin'] = null;
	echo "<script>window.location='../admin';</script>";
} else if(@$_GET['sesi'] == 'penguji') {
	@$_SESSION['penguji'] = null;
	echo "<script>window.location='../admin';</script>";
} else if(@$_GET['sesi'] == 'peserta') {
	@$_SESSION['peserta'] = null;
	echo "<script>window.location='../';</script>";
}


?>