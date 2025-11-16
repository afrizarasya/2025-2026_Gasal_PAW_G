<?php
include "koneksi.php";

$query = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id_transaksi ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Master Transaksi</title>

    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background: #f0f0f0;
        }
        .header-bar {
            background: #0062cc;
            padding: 12px;
            color: white;
            border-radius: 5px 5px 0 0;
            font-size: 18px;
        }
        .btn-add {
            background: #28a745;
            color: white;
        }
        .btn-report {
            background: #007bff;
            color: white;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <div class="header-bar">
        Data Master Transaksi
    </div>

    <div class="mt-3 mb-3">
        <a href="report_transaksi.php" class="btn btn-report">Lihat Laporan Penjualan</a>
        <a href="tambah.php" class="btn btn-add">Tambah Transaksi</a>
    </div>

    <table class="table table-bordered table-striped text-center">

        <thead class="thead-light">
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Waktu Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Keterangan</th>
                <th>Total</th>
                <th>Tindakan</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($query)) {
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['id_transaksi']; ?></td>
                <td><?= $row['tanggal']; ?></td>
                <td><?= $row['nama_pelanggan']; ?></td>
                <td><?= $row['keterangan']; ?></td>
                <td>Rp<?= number_format($row['total'], 0, ',', '.'); ?></td>
                <td>
                    <a href="detail.php?id=<?= $row['id_transaksi']; ?>" class="btn btn-info btn-sm">Lihat Detail</a>
                    <a href="hapus.php?id=<?= $row['id_transaksi']; ?>"
                       onclick="return confirm('Yakin hapus data?');"
                       class="btn btn-danger btn-sm">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>

    </table>

</div>

</body>
</html>
