<?php
include 'koneksi.php';

// simpan detail transaksi
if (isset($_POST['simpan'])) {
    $transaksi_id = $_POST['transaksi_id'];
    $barang_id = $_POST['barang_id'];
    $qty = $_POST['qty'];

    // cek apakah barang sudah ada di transaksi_detail
    $cek = mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE transaksi_id='$transaksi_id' AND barang_id='$barang_id'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Barang sudah ada dalam transaksi ini!'); history.back();</script>";
        exit;
    }

    // ambil harga barang
    $barang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT harga FROM barang WHERE id='$barang_id'"));
    $harga_total = $barang['harga'] * $qty;

    // insert detail transaksi
    mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga)
                         VALUES ('$transaksi_id', '$barang_id', '$qty', '$harga_total')");

    // update total transaksi
    mysqli_query($conn, "UPDATE transaksi SET total = (
        SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id='$transaksi_id'
    ) WHERE id='$transaksi_id'");

    echo "<script>alert('Detail transaksi berhasil disimpan'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f6f7fb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .card {
            background: #fff;
            width: 340px;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 18px;
        }
        label {
            display: block;
            font-weight: 500;
            margin-bottom: 6px;
            margin-top: 12px;
            color: #444;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #007bff;
        }
        button {
            width: 100%;
            margin-top: 18px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.2s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <form method="POST">
        <div class="card">
            <h2>Tambah Detail Transaksi</h2>
            <form method="POST">
                <label>Transaksi</label>
                <select name="transaksi_id" required>
                    <option value="">Pilih ID Transaksi</option>
                    <?php
                    $trx = mysqli_query($conn, "SELECT * FROM transaksi");
                    while ($t = mysqli_fetch_assoc($trx)) {
                        echo "<option value='{$t['id']}'>ID {$t['id']} - {$t['keterangan']}</option>";
                    }
                    ?>
                </select>

                <label>Barang</label>
                <select name="barang_id" required>
                    <option value="">Pilih Barang</option>
                    <?php
                    $barang = mysqli_query($conn, "SELECT * FROM barang");
                    while ($b = mysqli_fetch_assoc($barang)) {
                        echo "<option value='{$b['id']}'>{$b['nama_barang']} (Rp{$b['harga']})</option>";
                    }
                    ?>
                </select>

                <label>Quantity</label>
                <input placeholder="Masukkan jumlah barang" type="number" name="qty" min="1" required>

                <button type="submit" name="simpan">Tambah Detail</button>
            </form>
        </div>
</body>
</html>