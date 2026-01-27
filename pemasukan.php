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
    <title>Pemasukan</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand">ADMIN TOKO PENJUALAN LAPTOP</a>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
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
                    <h1 class="mt-4">Pemasukan</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            Total Pemasukan
                        </div>
                        <div class="card-body">
                            <?php
                            $result = mysqli_query($conn, "SELECT SUM(total_harga) AS total_pemasukan FROM transaksi");
                            $row = mysqli_fetch_assoc($result);
                            $total_pemasukan = $row['total_pemasukan'];
                            ?>
                            <h2>Rp <?= number_format($total_pemasukan, 0, ',', '.'); ?></h2>
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
