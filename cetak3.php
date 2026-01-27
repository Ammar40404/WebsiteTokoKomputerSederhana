<?php
require 'function.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Cetak Laporan Transaksi</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <style>
        @media print {
            .noprint {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Laporan Transaksi</h1>
        <div class="card mb-4">
            <div class="card-header noprint">
                <button class="btn btn-primary" onclick="window.print();">Print</button>
                <a href="transaksi.php" class="btn btn-primary">Kembali</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Tanggal</th>
                                <th>Pembeli</th>
                                <th>Pegawai</th>
                                <th>Merk</th>
                                <th>Tipe</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $viewtransaksi = mysqli_query($conn, "SELECT * FROM transaksi LEFT JOIN laptop ON transaksi.id_laptop=laptop.id_laptop LEFT JOIN pegawai ON transaksi.id_pegawai=pegawai.id_pegawai LEFT JOIN pembeli ON transaksi.id_pembeli=pembeli.id_pembeli");
                            while ($data = mysqli_fetch_array($viewtransaksi)) {
                                $idtransaksi = $data['id_transaksi'];
                                $tanggal = $data['tanggal'];
                                $nama_pembeli = $data['nama'];
                                $nama_pegawai = $data['nama_pgw'];
                                $merk = $data['merk'];
                                $tipe = $data['tipe'];
                                $jumlah = $data['jumlah'];
                                $total_harga = $data['total_harga'];
                            ?>
                                <tr>
                                    <td><?= $idtransaksi; ?></td>
                                    <td><?= $tanggal; ?></td>
                                    <td><?= $nama_pembeli; ?></td>
                                    <td><?= $nama_pegawai; ?></td>
                                    <td><?= $merk; ?></td>
                                    <td><?= $tipe; ?></td>
                                    <td><?= $jumlah; ?></td>
                                    <td>Rp <?= $total_harga; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
