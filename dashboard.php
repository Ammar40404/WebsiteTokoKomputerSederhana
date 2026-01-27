<?php
require 'function.php';


// pemasukan
$resultIncome = mysqli_query($conn, "SELECT SUM(total_harga) AS total_pemasukan FROM transaksi");
$rowIncome = mysqli_fetch_assoc($resultIncome);
$total_pemasukan = $rowIncome['total_pemasukan'];

// pengeluaran
$resultExpenses = mysqli_query($conn, "SELECT SUM(harga_laptop * stock_laptop) AS total_pengeluaran FROM laptop");
$rowExpenses = mysqli_fetch_assoc($resultExpenses);
$total_pengeluaran = $rowExpenses['total_pengeluaran'];


// Transaksi
$resultTransaksi = mysqli_query($conn, "SELECT COUNT(*) AS total_transaksi FROM transaksi");
$rowTransaksi = mysqli_fetch_assoc($resultTransaksi);
$total_transaksi = $rowTransaksi['total_transaksi'];

// pembeli
$resultPembeli = mysqli_query($conn, "SELECT COUNT(*) AS total_pembeli FROM pembeli");
$rowPembeli = mysqli_fetch_assoc($resultPembeli);
$total_pembeli = $rowPembeli['total_pembeli'];

// karyawan
$resultPegawai = mysqli_query($conn, "SELECT COUNT(*) AS total_pegawai FROM pegawai");
$rowPegawai = mysqli_fetch_assoc($resultPegawai);
$total_pegawai = $rowPegawai['total_pegawai'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
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
                    <h1 class="mt-4">Dashboard</h1>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <h4>Total Pemasukan</h4>
                                    <h2>Rp <?= number_format($total_pemasukan, 0, ',', '.'); ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">
                                    <h4>Total Transaksi</h4>
                                    <h2><?= $total_transaksi; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <h4>Total Pembeli</h4>
                                    <h2><?= $total_pembeli; ?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">
                                    <h4>Total Karyawan</h4>
                                    <h2><?= $total_pegawai; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">
                                    <h4> Total Pengeluaran</h4>
                                <h2> Rp <?= number_format($total_pengeluaran, 0, ',', '.'); ?></h2>
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
</html>
