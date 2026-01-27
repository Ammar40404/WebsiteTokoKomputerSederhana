<?php
require 'function.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Welcome to our laptop store" />
    <meta name="author" content="Your Name" />
    <title>Komputer</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="sb-nav-fixed">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" ><strong style="font-size: 1.5rem;">SELAMAT DATANG DI TOKO KAMI</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tentang-kami.php">Tentang Kami</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kontak.php">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login Admin</a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <?php
                            $viewlaptop = mysqli_query($conn, "SELECT * FROM `laptop`");
                            while ($data = mysqli_fetch_array($viewlaptop)) {
                                $id_laptop = $data['id_laptop'];
                                $merk = $data['merk'];
                                $tipe = $data['tipe'];
                                $harga = $data['harga_laptop'];
                                $stock = $data['stock_laptop'];
                                $spek = $data['spesifikasi'];
                                $foto = $data['foto'];
                            ?>

                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="card h-100">
                                        <img src="uploads/<?= htmlspecialchars($foto); ?>" class="card-img-top" alt="<?= htmlspecialchars($merk . " " . $tipe); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title"><?= htmlspecialchars($merk . " " . $tipe); ?></h4>
                                            <p class="card-text"><?= nl2br(htmlspecialchars($spek)); ?></p>
                                            <h5><?= "Rp " . number_format($harga, 0, ',', '.'); ?></h5>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Stock: <?= htmlspecialchars($stock) ?></small>
                                            <br>
                                            <button class="btn btn-success btn-sm mt-2" onclick="composeWhatsApp('<?= htmlspecialchars($merk) ?> <?= htmlspecialchars($tipe) ?>', '<?= htmlspecialchars($harga) ?>')">Order via WhatsApp</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Modal -->
                                <div class="modal fade" id="modalorder<?= htmlspecialchars($id_laptop); ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pesan Laptop</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="order.php">
                                                <div class="modal-body">
                                                    <input type="hidden" name="id_laptop" value="<?= htmlspecialchars($id_laptop); ?>">
                                                    <input type="hidden" name="harga" value="<?= htmlspecialchars($harga); ?>">
                                                    <p>Merk: <?= htmlspecialchars($merk); ?></p>
                                                    <p>Tipe: <?= htmlspecialchars($tipe); ?></p>
                                                    <p>Harga: <?= "Rp " . number_format($harga, 0, ',', '.'); ?></p>

                                                    <div class="form-group">
                                                        <label for="jumlah">Jumlah:</label>
                                                        <input type="number" id="jumlah" name="jumlah" class="form-control" min="1" max="<?= htmlspecialchars($stock); ?>" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="nama">Nama:</label>
                                                        <input type="text" id="nama" name="nama" class="form-control" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="alamat">Alamat Pengiriman:</label>
                                                        <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="no_hp">Nomor HP:</label>
                                                        <input type="text" id="no_hp" name="no_laptop" class="form-control" required>
                                                    </div>

                                                    <button type="submit" name="order" class="btn btn-primary">Pesan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            };
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
        function composeWhatsApp(productName, productPrice) {
            var message = "Halo, saya ingin memesan " + productName + ". Harganya " + formatRupiah(productPrice) + ". Tolong konfirmasi ketersediaan.";
            var encodedMessage = encodeURIComponent(message);
            var whatsappLink = "https://api.whatsapp.com/send?phone=6285695155879&text=" + encodedMessage;
            window.open(whatsappLink, '_blank');
        }

        function formatRupiah(number) {
            return 'Rp ' + parseInt(number).toLocaleString('id-ID');
        }
    </script>
</body>
</html>
