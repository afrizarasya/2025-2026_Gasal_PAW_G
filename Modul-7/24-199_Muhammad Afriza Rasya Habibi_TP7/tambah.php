<?php
include "koneksi.php";

if (isset($_POST['tanggal'])) {

    $tanggal      = $_POST['tanggal'];
    $nama         = $_POST['nama_pelanggan'];
    $keterangan   = $_POST['keterangan'];
    $total        = $_POST['total'];

    // Query insert
    $query = mysqli_query($conn, "INSERT INTO transaksi (tanggal, nama_pelanggan, keterangan, total) VALUES ('$tanggal', '$nama', '$keterangan', '$total')"
    );

    if ($query) {
        echo "<script>
                alert('Transaksi berhasil ditambahkan!');
                window.location='data.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan transaksi!');
                window.location='tambah.php';
              </script>";
    }
}
?>

<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Transaksi</title>

    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .header-box {
            background: #007bff;
            color: white;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px 5px 0 0;
        }
        .content-box {
            background: white;
            padding: 20px;
            border: 1px solid #dcdcdc;
            border-radius: 0 0 5px 5px;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <div class="header-box">
        Tambah Transaksi
    </div>

    <div class="content-box">

        <a href="data.php" class="btn btn-primary mb-3">← Kembali</a>

        <form action="tambah.php" method="POST">

            <div class="form-group">
                <label>Tanggal Transaksi</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="form-control" placeholder="Masukkan nama pelanggan" required>
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <select name="keterangan" class="form-control" required>
                    <option value="">-- Pilih Keterangan --</option>
                    <option value="Self pickup">Self pickup</option>
                    <option value="Delivery Order">Delivery Order</option>
                </select>
            </div>

            <div class="form-group">
                <label>Total (Rp)</label>
                <input type="number" name="total" class="form-control" placeholder="Contoh: 200000" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan Transaksi</button>

        </form>

    </div>
</div>

</body>
</html>
