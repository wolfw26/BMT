<?php
// Fungsi untuk mengambil data peserta yang lulus dengan atau tanpa filter jabatan
function getPeserta($db, $jabatanFilter = null)
{
    $query = "SELECT p.*, r.*, n.*
            FROM peserta p
            INNER JOIN ruang r ON p.id_ruang = r.id_ruang
            INNER JOIN penilaian n ON p.id_peserta = n.id_peserta 
            WHERE n.status_nilai = 'Baik - Lolos'";

    if ($jabatanFilter != null) {
        $query .= " AND r.kandidat = '$jabatanFilter'";
    }

    $result = $db->query($query);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;
}
if (isset($_POST['jabatan'])) {
    $jabatanFilter = ($_POST['jabatan'] == 'all') ? null : $_POST['jabatan'];
    $dataPeserta = getPeserta($db, $jabatanFilter);
} else {
    $dataPeserta = getPeserta($db);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moitoring Karyawan</title>
</head>

<body>
    <div class="card">
        <div class="card-body shadow-lg">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card-title mb-3">
                        <h3>Monitoring Karyawan</h3>
                        <p><i class="text-twitter">PT. BUMIPUTERA MAHA TERPERCAYA</i></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form method="POST">
                        <!-- filter data sesuai jabatan,jika all maka menampilkan semua data -->
                        <select id="jabatan" name="jabatan" class="custom-select custom-select-sm mb-3">
                            <option selected>Filter Jabatan</option>
                            <option value="all">Semua</option>
                            <option value="IT">IT</option>
                            <option value="SPV">SPV</option>
                            <option value="HOD">HoD</option>
                        </select>
                        <!-- tombol filter -->
                        <button class="btn btn-sm btn-primary" type="submit" name="filter">Filter</button>
                        <!-- mengirim data dan membuka tab baru ke halaman cetak monitoring -->
                        <a target="_blank" class="btn btn-sm btn-warning" href="laporan/lmonitoring.php?data=<?= urlencode(json_encode($dataPeserta)) ?>">Cetak</a>
                    </form>
                </div>
            </div>
            <div class="table-responsive mt-5"> <!-- Required for Responsive -->
                <?php
                // Panggil fungsi getPeserta dengan koneksi database yang sesuai
                if (isset($_POST['jabatan'])) {
                    $jabatanFilter = ($_POST['jabatan'] == 'all') ? null : $_POST['jabatan'];
                    $dataPeserta = getPeserta($db, $jabatanFilter);
                } else {
                    $dataPeserta = getPeserta($db);
                }
                if (count($dataPeserta) > 0) {
                ?>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Jabatan</th>
                                <th>Grade</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($dataPeserta as $peserta) {
                            ?>
                                <tr>
                                    <td><?= $peserta['nama_lengkap']; ?></td>
                                    <td><?= $peserta['alamat']; ?></td>
                                    <td><?= $peserta['status']; ?></td>
                                    <td><?= $peserta['kandidat']; ?></td>
                                    <td><?= $peserta['grade']; ?></td>
                                    <td><?= $peserta['status_nilai']; ?></td>
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