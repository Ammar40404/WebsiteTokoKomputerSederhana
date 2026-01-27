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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
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
                    <h1 class="mt-4">Data Karyawan</h1>
                     <div class="card mb-4">
                        <div class="card-header">
            
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pgwmodal">
                                Tambah Karyawan
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>No Hp</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $viewpegawai = mysqli_query($conn, "SELECT * FROM `pegawai`");
                                        while ($data = mysqli_fetch_array($viewpegawai)) {
                                            $id_pgw = $data['id_pegawai'];
                                            $nama = $data['nama_pgw'];
                                            $alamat = $data['alamat_pgw'];
                                            $no_hp = $data['telp_pgw'];
                                        ?>
                                            <tr>
                                                <td><?= $id_pgw; ?></td>
                                                <td><?= $nama; ?></td>
                                                <td><?= $alamat; ?></td>
                                                <td><?= $no_hp; ?></td>
                                                <td>
                                                    <button style="margin: 2px;" type="button" class="btn btn-warning" data-toggle="modal" data-target="#pgwmodalupdate<?= $id_pgw; ?>">update</button>
                                                    <button style="margin: 2px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#pgwmodaldelete<?= $id_pgw; ?>">delete</button>
                                                </td>
                                            </tr>

                                            <!-- update pegawai -->
                                            <div class="modal fade" id="pgwmodalupdate<?= $id_pgw; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Data Pegawai</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <input type="text" name="nama" value="<?= $nama; ?>" class="form-control">
                                                                <br />
                                                                <input type="text" name="nohp" value="<?= $no_hp; ?>" class="form-control">
                                                                <br />
                                                                <textarea type="text" class="form-control" name="alamat" rows="3"><?= $alamat; ?></textarea>
                                                                <input type="hidden" name="idpgw" value="<?= $id_pgw; ?>">
                                                                <br />
                                                                <button type="submit" name="updatepgw" class="btn btn-warning">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- update pegawai -->

                                            <!-- delete pegawai -->
                                            <div class="modal fade" id="pgwmodaldelete<?= $id_pgw; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus KB</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <fieldset disabled>
                                                                    <input type="text" name="nama" value="<?= $nama; ?>" class="form-control">
                                                                    <br />
                                                                    <input type="text" name="nohp" value="<?= $no_hp; ?>" class="form-control">
                                                                    <br />
                                                                    <textarea type="text" class="form-control" name="alamat" rows="3"><?= $alamat; ?></textarea>
                                                                    <input type="hidden" name="idtb" value="<?= $idtb; ?>">
                                                                    <br />
                                                                </fieldset>
                                                                <br />
                                                                Apakah anda ingin menghapus data pegawai ini?
                                                                <br />
                                                                <br />
                                                                <input type="hidden" name="idpgw" value="<?= $id_pgw; ?>">
                                                                <button type="submit" name="deletepgw" class="btn btn-danger">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- delete pegawai-->

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


<div class="modal fade" id="pgwmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="text" name="nama" placeholder="input nama pegawai" class="form-control">
                    <br />
                    <input type="text" name="nohp" placeholder="no hp pegawai" class="form-control">
                    <br />
                    <textarea type="text" class="form-control" name="alamat" rows="3" placeholder="alamat"></textarea>
                    <input type="hidden" name="idtb" value="<?= $idtb; ?>">
                    <br />
                    <button type="submit" name="savepgw" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>