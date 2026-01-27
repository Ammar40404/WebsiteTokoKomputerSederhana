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
    <title>Komputer</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" >ADMIN TOKO PENJUALAN LAPTOP</a>
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
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                        <a class="nav-link" href="stok.php">Stock</a>
                        <a class="nav-link" href="pegawai.php">Karyawan</a>
                        <a class="nav-link" href="pembeli.php">Pembeli</a>
                        <a class="nav-link" href="transaksi.php">Transaksi</a>
                        <a class="nav-link" href="logout.php">Logout</a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Stok Laptop</h1>
                     <div class="card mb-4">
                        <div class="card-header">
                 
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hpmodal">Tambah Stock</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Merk</th>
                                        <th>Tipe</th>
                                        <th>Harga</th>
                                        <th>Stock</th>
                                        <th>Spek</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $viewhandphone = mysqli_query($conn, "SELECT * FROM `laptop`");
                                    while ($data = mysqli_fetch_array($viewhandphone)) {
                                        $id_laptop = $data['id_laptop'];
                                        $merk = $data['merk'];
                                        $tipe = $data['tipe'];
                                        $harga = $data['harga_laptop'];
                                        $stock = $data['stock_laptop'];
                                        $spek = $data['spesifikasi'];
                                        $foto = $data['foto'];
                                    ?>
                                        <tr>
                                            <td><?= $id_laptop; ?></td>
                                            <td><?= $merk; ?></td>
                                            <td><?= $tipe; ?></td>
                                            <td><?= "Rp " . $harga; ?></td>
                                            <td><?= $stock ?></td>
                                            <td><?= $spek; ?></td>
                                            <td><img src="uploads/<?= $foto; ?>" alt="Foto <?= $merk; ?>" width="100"></td>
                                            <td>
                                                <button style="margin: 2px;" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalupdate<?= $id_laptop; ?>">Update</button>
                                                <button style="margin: 2px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modaldelete<?= $id_laptop; ?>">Delete</button>
                                            </td>
                                        </tr>
<!-- update -->
<div class="modal fade" id="modalupdate<?= $id_laptop; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Laptop</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="text" name="merk" value="<?= $merk; ?>" class="form-control" required>
                    <br />
                    <input type="text" name="tipe" value="<?= $tipe; ?>" class="form-control" required>
                    <br />
                    <input type="number" name="harga" value="<?= $harga; ?>" class="form-control" required>
                    <br />
                    <input type="number" name="stock" value="<?= $stock; ?>" class="form-control" required>
                    <br />
                    <textarea type="text" class="form-control" name="spek" rows="3" required><?= $spek; ?></textarea>
                    <br />
                    <input type="file" name="foto_laptop" class="form-control">
                    <br />
                    <input type="hidden" name="idhp" value="<?= $id_laptop; ?>">
                    <br />
                    <button type="submit" name="updatehp" class="btn btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- update-->



                                        <!-- delete -->
                                        <div class="modal fade" id="modaldelete<?= $id_laptop; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete Laptop</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST">
                                                        <div class="modal-body">
                                                            Apakah anda yakin ingin menghapus laptop ini?
                                                            <input type="hidden" name="idhp" value="<?= $id_laptop; ?>">
                                                            <br />
                                                            <br />
                                                            <button type="submit" name="deletehp" class="btn btn-danger">Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- delete -->
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- tambah -->
    <div class="modal fade" id="hpmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="text" name="merk_laptop" placeholder="merk" class="form-control" required>
                        <br />
                        <input type="text" name="tipe_laptop" placeholder="tipe" class="form-control" required>
                        <br />
                        <input type="number" name="harga_laptop" placeholder="harga" class="form-control" required>
                        <br />
                        <input type="number" name="stock_laptop" placeholder="stock" class="form-control" required>
                        <br />
                        <textarea type="text" placeholder="spesifikasi Laptop" class="form-control" name="spek" rows="3" required></textarea>
                        <br />
                        <input type="file" name="foto_laptop" class="form-control" required>
                        <br />
                        <button type="submit" name="inserthp" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>
