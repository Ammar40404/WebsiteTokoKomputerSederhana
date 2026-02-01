<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "toko_komputer_uas");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// tambah stok
if (isset($_POST['inserthp'])) {
    $merk = mysqli_real_escape_string($conn, $_POST['merk_laptop']);
    $tipe = mysqli_real_escape_string($conn, $_POST['tipe_laptop']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga_laptop']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock_laptop']);
    $spek = mysqli_real_escape_string($conn, $_POST['spek']);

    $foto = $_FILES['foto_laptop']['name'];
    $tmp_name = $_FILES['foto_laptop']['tmp_name'];
    $target_dir = "uploads/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

   
    if (move_uploaded_file($tmp_name, $target_dir . $foto)) {
        $insert = mysqli_query($conn, "INSERT INTO laptop (merk, tipe, harga_laptop, stock_laptop, spesifikasi, foto) VALUES ('$merk', '$tipe', '$harga', '$stock', '$spek', '$foto')");
        if ($insert) {
            echo "Data berhasil ditambahkan.";
        } else {
            echo "Gagal menambahkan data: " . mysqli_error($conn);
        }
    } else {
        echo "Gagal mengupload foto.";
    }
}

// update stok
if (isset($_POST['updatehp'])) {
    $id_laptop = mysqli_real_escape_string($conn, $_POST['idhp']);
    $merk = mysqli_real_escape_string($conn, $_POST['merk']);
    $tipe = mysqli_real_escape_string($conn, $_POST['tipe']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);
    $spek = mysqli_real_escape_string($conn, $_POST['spek']);

    if (!empty($_FILES['foto_laptop']['name'])) {
        $foto = $_FILES['foto_laptop']['name'];
        $tmp_name = $_FILES['foto_laptop']['tmp_name'];
        $target_dir = "uploads/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        if (move_uploaded_file($tmp_name, $target_dir . $foto)) {
            $update = mysqli_query($conn, "UPDATE laptop SET merk='$merk', tipe='$tipe', harga_laptop='$harga', stock_laptop='$stock', spesifikasi='$spek', foto='$foto' WHERE id_laptop='$id_laptop'");
        } else {
            echo "Gagal mengupload foto: " . $_FILES['foto_laptop']['error'];
        }
    } else {
        $update = mysqli_query($conn, "UPDATE laptop SET merk='$merk', tipe='$tipe', harga_laptop='$harga', stock_laptop='$stock', spesifikasi='$spek' WHERE id_laptop='$id_laptop'");
    }

    if ($update) {
        echo "Data berhasil diupdate.";
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
}




// delete stok
if (isset($_POST['deletehp'])) {
    $id_laptop = mysqli_real_escape_string($conn, $_POST['idhp']);

    $deletehp = mysqli_query($conn, "DELETE FROM laptop WHERE id_laptop='$id_laptop'");
    if ($deletehp) {
        header('Location: stok.php');
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
        header('Location: stok.php');
    }
}

// tambah pegawai
if (isset($_POST['savepgw'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['nohp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    $tambahpgw = mysqli_query($conn, "INSERT INTO pegawai (nama_pgw, alamat_pgw, telp_pgw) VALUES ('$nama', '$alamat', '$no_hp')");
    if ($tambahpgw) {
        header('Location: pegawai.php');
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($conn);
        header('Location: pegawai.php');
    }
}

// update pegawai
if (isset($_POST['updatepgw'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['nohp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $id_pgw = mysqli_real_escape_string($conn, $_POST['idpgw']);

    $updatepgw = mysqli_query($conn, "UPDATE pegawai SET nama_pgw='$nama', alamat_pgw='$alamat', telp_pgw='$no_hp' WHERE id_pegawai='$id_pgw'");
    if ($updatepgw) {
        header('Location: pegawai.php');
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
        header('Location: pegawai.php');
    }
}

// delete pegawai
if (isset($_POST['deletepgw'])) {
    $id_pgw = mysqli_real_escape_string($conn, $_POST['idpgw']);

    $deletepgw = mysqli_query($conn, "DELETE FROM pegawai WHERE id_pegawai='$id_pgw'");
    if ($deletepgw) {
        header('Location: pegawai.php');
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
        header('Location: pegawai.php');
    }
}

// tambah pembeli
if (isset($_POST['savepembeli'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['nohp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    $tambahpembeli = mysqli_query($conn, "INSERT INTO pembeli (nama, alamat, no_hp) VALUES ('$nama', '$alamat', '$no_hp')");
    if ($tambahpembeli) {
        header('Location: pembeli.php');
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($conn);
        header('Location: pembeli.php');
    }
}

// update pembeli
if (isset($_POST['updatepembeli'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $no_hp = mysqli_real_escape_string($conn, $_POST['nohp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $idpembeli = mysqli_real_escape_string($conn, $_POST['id_pembeli']);

    $updatepembeli = mysqli_query($conn, "UPDATE pembeli SET nama='$nama', alamat='$alamat', no_hp='$no_hp' WHERE id_pembeli='$idpembeli'");
    if ($updatepembeli) {
        header('Location: pembeli.php');
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
        header('Location: pembeli.php');
    }
}

// delete pembeli
if (isset($_POST['deletepembeli'])) {
    $idpembeli = mysqli_real_escape_string($conn, $_POST['id_pembeli']);

    $deletepembeli = mysqli_query($conn, "DELETE FROM pembeli WHERE id_pembeli='$idpembeli'");
    if ($deletepembeli) {
        header('Location: pembeli.php');
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
        header('Location: pembeli.php');
    }
}


// tambah transaksi
if (isset($_POST['savetransaksi'])) {
    $pembeli = $_POST['pembeli'];
    $pegawai = $_POST['pgw'];
    $laptop = explode('_', $_POST['laptop']); 
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];

    $lihatstock = mysqli_query($conn, "select * from laptop where id_laptop='$laptop[0]'");
    $stocknya = mysqli_fetch_array($lihatstock); 
    $stockskrg = $stocknya['stock_laptop'];

    if ($jumlah <= $stockskrg) {
        $stockupdate = $stockskrg - $jumlah;
        $updatestock = mysqli_query($conn, "update laptop set stock_laptop='$stockupdate' where id_laptop='$laptop[0]'");
        $tambahtransaksi = mysqli_query($conn, "insert into transaksi (id_pembeli, id_pegawai, id_laptop, total_harga, jumlah) values ('$pembeli', '$pegawai', '$laptop[0]', '$harga', '$jumlah')");
        header('location:transaksi.php');
    } else {
        echo "gagal";
        header('location:transaksi.php');
    }
}


// delete transaksi
if (isset($_POST['deletetransaksi'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $id_laptop = $_POST['id_laptop'];
    $jumlah = $_POST['jumlah'];

    $lihatstock = mysqli_query($conn, "select * from laptop where id_laptop='$id_laptop'");
    $stocknya = mysqli_fetch_array($lihatstock); 
    $stockskrg = $stocknya['stock_laptop'];

    $stockupdate = $stockskrg + $jumlah;
    $updatestock = mysqli_query($conn, "update laptop set stock_laptop='$stockupdate' where id_laptop='$id_laptop'");
    $tambahtransaksi = mysqli_query($conn, "delete from transaksi where id_transaksi='$id_transaksi'");

    header('location:transaksi.php');
}
?>
