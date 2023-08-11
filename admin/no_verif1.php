<?php

    include "koneksi.php";
    if(isset($_GET['id_berkas'])){

    $sql_ubah = "UPDATE berkas SET status_berkas='Tidak Lolos' WHERE id_berkas='".$_GET['id_berkas']."'";
    $query_ubah = mysqli_query($db, $sql_ubah);
    mysqli_close($db);

    if ($query_ubah) {
    
    ?>

    <script type="text/javascript">
        alert("Berhasil di verifikasi");
        window.location.href="index.php?page=ujian1";
    </script>

<?php } } ?> 
 