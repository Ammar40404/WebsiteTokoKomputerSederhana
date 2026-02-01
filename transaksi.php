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
    <title>Record Transaksi</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

    <style>
        @media print {
            .modal-footer {
                display: none;
            }
            .modal {
                position: relative;
                overflow: visible;
                height: auto;
            }
        }
    </style>

</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand">ADMIN TOKO PENJUALAN LAPTOP</a>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Beranda</a>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="dashboard.php">
                            Dashboard
                        </a>
                        <a class="nav-link" href="stok.php">
                            Stock
                        </a>
                        <a class="nav-link" href="pegawai.php">
                            Karyawan
                        </a>
                        <a class="nav-link" href="pembeli.php">
                            Pembeli
                        </a>
                        <a class="nav-link" href="transaksi.php">
                            Transaksi
                        </a>
                        <a class="nav-link" href="logout.php">
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Data Transaksi</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#transaksimodal">
                                Tambah Transaksi
                            </button> 
                            <a href="cetak3.php" target="blank" class="btn btn-primary">Print</a>
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
                                            <th>Action</th>
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
                                            $idpembeli = $data['id_pembeli'];
                                            $idpegawai = $data['id_pegawai'];
                                            $idlaptop = $data['id_laptop'];
                                            $harga = $data['harga_laptop'];
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
                                                <td>
                                                    <button style="margin: 2px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletetransaksi<?= $idtransaksi; ?>">Delete</button>
                                                    <button style="margin: 2px;" type="button" class="btn btn-success" data-toggle="modal" data-target="#invoiceModal<?= $idtransaksi; ?>">Invoice</button>
                                                </td>
                                            </tr>

                                            <!-- delete -->
                                            <div class="modal fade" id="deletetransaksi<?= $idtransaksi; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Transaksi</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <fieldset disabled>
                                                                    <input type="text" value="<?= $nama_pembeli; ?>" class="form-control">
                                                                    <br />
                                                                    <input type="text" value="<?= $merk; ?>" class="form-control">
                                                                    <br />
                                                                    <input type="text" value="<?= $tipe; ?>" class="form-control">
                                                                    <br />
                                                                    <input type="text" value="<?= $total_harga; ?>" class="form-control">
                                                                </fieldset>
                                                                <br />
                                                                Apakah anda ingin menghapus data transaksi ini?
                                                                <br />
                                                                <br />
                                                                <input type="hidden" name="id_transaksi" value="<?= $idtransaksi; ?>">
                                                                <input type="hidden" name="id_laptop" value="<?= $idlaptop; ?>">
                                                                <input type="hidden" name="jumlah" value="<?= $jumlah; ?>">
                                                                <button type="submit" name="deletetransaksi" class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- delete  -->

                                            <!-- Invoice -->
                                            <div class="modal fade" id="invoiceModal<?= $idtransaksi; ?>" tabindex="-1" aria-labelledby="invoiceModalLabel<?= $idtransaksi; ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="invoiceModalLabel<?= $idtransaksi; ?>">Invoice for Transaction <?= $idtransaksi; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Detail Transaksi</h5>
                                                            <p><strong>ID:</strong> <?= $idtransaksi; ?></p>
                                                            <p><strong>Tanggal:</strong> <?= $tanggal; ?></p>
                                                            <p><strong>Pembeli:</strong> <?= $nama_pembeli; ?></p>
                                                            <p><strong>Karyawan:</strong> <?= $nama_pegawai; ?></p>
                                                            <p><strong>Merek:</strong> <?= $merk; ?></p>
                                                            <p><strong>Tipe:</strong> <?= $tipe; ?></p>
                                                            <p><strong>Jumlah Barang:</strong> <?= $jumlah; ?></p>
                                                            <p><strong>Total Harga:</strong> Rp <?= $total_harga; ?></p>
                                                            <hr>
                                                            <h5>Ringkasan Faktur</h5>
                                                            <p><strong>Total Harga:</strong> Rp <?= $total_harga; ?></p>
                                                            <p><strong>Payment Method:</strong> Cash/Card</p>
                                                            <p><strong>Terimakasih Telah Berbelanja :)</strong></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" onclick="printInvoice('invoiceModal<?= $idtransaksi; ?>')">Print</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Invoice -->
                                        <?php
                                        };
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

<!-- Modal -->
<div class="modal fade" id="transaksimodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembeli</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <select name="pembeli" class="form-control">
                        <option selected value="">pilih pembeli</option>
                        <?php
                        $tampilanpembeli = mysqli_query($conn, "SELECT * FROM pembeli");
                        while ($fetcharray = mysqli_fetch_array($tampilanpembeli)) {
                            $nama_list = $fetcharray['nama'];
                            $idpembeli = $fetcharray['id_pembeli'];
                        ?>
                            <option value="<?= $idpembeli; ?>"><?= $nama_list; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br />
                    <select name="pgw" class="form-control">
                        <option selected value="">pilih pegawai</option>
                        <?php
                        $tampilanpegawai = mysqli_query($conn, "SELECT * FROM pegawai");
                        while ($fetcharray = mysqli_fetch_array($tampilanpegawai)) {
                            $namapegawai = $fetcharray['nama_pgw'];
                            $idpgw = $fetcharray['id_pegawai'];
                        ?>
                            <option value="<?= $idpgw; ?>"><?= $namapegawai; ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br>
                    <select name="laptop" class="form-control" id="laptop" required>
                        <option selected>pilih laptop</option>
                        <?php
                        $tampilanhp = mysqli_query($conn, "SELECT * FROM laptop");
                        while ($d = mysqli_fetch_array($tampilanhp)) {
                        ?>
                            <option value="<?php echo $d['id_laptop'] ?>_<?php echo $d['harga_laptop'] ?>"><?php echo $d['merk'] ?> <?php echo $d['tipe'] ?> <?php echo $d['harga_laptop'] ?>, <?php echo $d['stock_laptop'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br />
                    <input type="number" name="jumlah" placeholder="jumlah" id="jumlah" class="form-control">
                    <br />
                    <input type="number" name="harga" placeholder="harga" class="form-control harga">
                    <br />
                    <button type="submit" name="savetransaksi" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>

<script>
    var data = 0;
    var jumlah = 0;
    var total = 0;
    $('#laptop, #jumlah').on('change input', function() {
        var data = $('#laptop').val().split('_') || 0;
        var jumlah = $('#jumlah').val() || 0;
        var total = data[1] * jumlah;
        $('.harga').val(total);
    });

    function printInvoice(modalId) {
        var printContents = document.getElementById(modalId).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>
