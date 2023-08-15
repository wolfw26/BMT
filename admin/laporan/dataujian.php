<?php
// Fungsi untuk mengambil data peserta yang lulus dengan atau tanpa filter jabatan
function getPeserta($db, $bahanFilter = null)
{
    $query = "SELECT tu.*, r.*, p.*,b.*
            FROM topik_ujian tu
            INNER JOIN ruang r ON tu.id_ruang = r.id_ruang
            INNER JOIN penguji p ON p.id_penguji = tu.pembuat 
            INNER JOIN bahan_ujian b ON b.id = tu.id_bahan_ujian";

    if ($bahanFilter != null) {
        $query .= " AND b.id = '$bahanFilter'";
    }

    $result = $db->query($query);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}
if (isset($_POST['bahanUjian'])) {
    $jabatanFilter = ($_POST['bahanUjian'] == 'all') ? null : $_POST['bahanUjian'];
    $dataUjian = getPeserta($db, $jabatanFilter);
} else {
    $dataUjian = getPeserta($db);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data Ujian</title>
</head>

<body>
    <div class="card">
        <div class="card-body shadow-lg">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-title mb-3">
                        <h3>Laporan Data Ujian</h3>
                        <p><i class="text-twitter">PT. BUMIPUTERA MAHA TERPERCAYA</i></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form method="POST">
                        <?php
                        $result = $db->query("SELECT * FROM bahan_ujian");
                        ?>
                        <!-- filter data sesuai jabatan,jika all maka menampilkan semua data -->
                        <select id="bahanUjian" name="bahanUjian" class="custom-select custom-select-sm mb-3">
                            <option selected>Filter jenis Ujian</option>
                            <option value="all">Semua</option>
                            <?php foreach ($result as $data) { ?>
                                <option value="<?= $data['id']; ?>"><?= $data['bahan_ujian']; ?></option>
                            <?php } ?>
                        </select>
                        <!-- tombol filter -->
                        <button class="btn btn-sm btn-primary" type="submit" name="filter">Filter</button>
                        <!-- mengirim data dan membuka tab baru ke halaman cetak monitoring -->
                        <a target="_blank" class="btn btn-sm btn-warning" href="laporan/ldataujian.php?data=<?= urlencode(json_encode($dataUjian)) ?>">Cetak</a>
                    </form>
                </div>
            </div>
            <div class="table-responsive mt-5"> <!-- Required for Responsive -->

                <?php
                // Panggil fungsi getPeserta dengan koneksi database yang sesuai
                if (isset($_POST['bahanUjian'])) {
                    $jabatanFilter = ($_POST['bahanUjian'] == 'all') ? null : $_POST['bahanUjian'];
                    $dataUjian = getPeserta($db, $jabatanFilter);
                } else {
                    $dataUjian = getPeserta($db);
                }
                if (count($dataUjian) > 0) {
                ?>
                    <span class=" text-black-50 font-size-13 mb-2">Total : <?= count($dataUjian); ?> </span>
                    <table class="table table-striped table-bordered align-middle">
                        <thead>
                            <tr>
                                <th>JUDUL</th>
                                <th>JABATAN</th>
                                <th>JENIS</th>
                                <th>PEMBUAT</th>
                                <th>WAKTU</th>
                                <th class=" w-25">DESKRIPSI</th>
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
                                    <td class=" w-25"><?= $ujian['info']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                <?php
                } else {
                ?>
                    <div class="card mt-5">
                        <div class="card-body bg-info">
                            <h2 class=" text-center">Not Found</h2>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("printButton").addEventListener("click", function() {
            window.print();
        });
    </script>
</body>

</html>