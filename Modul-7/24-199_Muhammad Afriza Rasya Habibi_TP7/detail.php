<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: data_transaksi.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='data_transaksi.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>

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
        .info-label {
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <div class="header-box">
        Detail Transaksi
    </div>

    <div class="content-box">

        <a href="data.php" class="btn btn-primary mb-3">← Kembali</a>

        <table class="table table-bordered">
            <tr>
                <td class="info-label">ID Transaksi</td>
                <td><?= $data['id_transaksi'] ?></td>
            </tr>
            <tr>
                <td class="info-label">Tanggal Transaksi</td>
                <td><?= $data['tanggal'] ?></td>
            </tr>
            <tr>
                <td class="info-label">Nama Pelanggan</td>
                <td><?= $data['nama_pelanggan'] ?></td>
            </tr>
            <tr>
                <td class="info-label">Keterangan</td>
                <td><?= $data['keterangan'] ?></td>
            </tr>
            <tr>
                <td class="info-label">Total Pembayaran</td>
                <td>Rp<?= number_format($data['total'], 0, ',', '.') ?></td>
            </tr>
        </table>

    </div>
</div>

</body>
</html>