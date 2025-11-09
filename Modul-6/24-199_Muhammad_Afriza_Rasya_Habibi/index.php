<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Master & Detail Transaksi</title>
    <style>
        body {font-family: Arial; background: #f2f2f2; margin: 20px;}
        h2 {color: #2c3e50;}
        table {width: 90%; border-collapse: collapse; margin-bottom: 25px;}
        th, td {border: 1px solid #bbb; padding: 8px;}
        th {background: lightslategray; color: #fff;}
        tr:nth-child(even){background:#f9f9f9;}
        a.btn {background: blue; color:white; padding:5px 10px; text-decoration:none; border-radius:5px;}
        a.btn:hover {background:#219150;}
    </style>
</head>
<body>
    <h1>PENGELOLAAN DATA MASTER</h1>
    <h2>Data Barang</h2>
    <table>
        <tr><th>ID</th><th>Nama Barang</th><th>Harga</th><th>Stok</th><th>Supplier ID</th><th>Aksi</th></tr>
        <?php
        $barang = mysqli_query($conn, "SELECT * FROM barang");
        while($b = mysqli_fetch_assoc($barang)) {
            echo "<tr>
                <td>{$b['id']}</td>
                <td>{$b['nama_barang']}</td>
                <td>{$b['harga']}</td>
                <td>{$b['stok']}</td>
                <td>{$b['supplier_id']}</td>
                <td><a href='hapus_barang.php?id={$b['id']}' onclick=\"return confirm('Yakin ingin menghapus?')\">Hapus</a></td>
            </tr>";
        }
        ?>
    </table>

    <h2>Data Transaksi</h2>
    <table>
        <tr><th>ID</th><th>waktu_transaksi</th><th>Keterangan</th><th>Total</th><th>Pelanggan ID</th></tr>
        <?php
        $trx = mysqli_query($conn, "SELECT * FROM transaksi");
        while($t = mysqli_fetch_assoc($trx)) {
            echo "<tr>
            <td>{$t['id']}</td>
            <td>{$t['waktu_transaksi']}</td>
            <td>{$t['keterangan']}</td>
            <td>{$t['total']}</td>
            <td>{$t['pelanggan_id']}</td>
            </tr>";
        }
        ?>
    </table>
    <a href="tambah_transaksi.php" class="btn">Tambah Transaksi</a>

    <h2>Data Detail Transaksi</h2>
    <table>
        <tr><th>transaksi_id</th><th>barang_id</th><th>harga</th><th>qty</th></tr>
        <?php
        $trx = mysqli_query($conn, "SELECT * FROM transaksi_detail");
        while($t = mysqli_fetch_assoc($trx)) {
            echo "<tr>
                <td>{$t['transaksi_id']}</td>
                <td>{$t['barang_id']}</td>
                <td>{$t['harga']}</td>
                <td>{$t['qty']}</td>
            </tr>";
        }
        ?>
    </table>
    <a href="tambah_detail.php" class="btn">Tambah Detail Transaksi</a>
</body>
</html>
