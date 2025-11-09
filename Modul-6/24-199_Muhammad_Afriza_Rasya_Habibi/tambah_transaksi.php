<?php
include 'koneksi.php';

if (isset($_POST['simpan'])) {
    $tanggal = $_POST['waktu_transaksi'];
    $keterangan = $_POST['keterangan'];
    $pelanggan_id = $_POST['pelanggan_id'];
    $user_id = 1;

    if ($tanggal < date('Y-m-d')) {
        echo "<script>alert('Tanggal tidak boleh kurang dari hari ini'); history.back();</script>";
        exit;
    }

    if (strlen($keterangan) < 3) {
        echo "<script>alert('Keterangan minimal 3 karakter'); history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id)
            VALUES ('$tanggal', '$keterangan', 0, '$pelanggan_id', '$user_id')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Transaksi berhasil disimpan'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
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
        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #007bff;
        }
        textarea {
            resize: none;
            height: 70px;
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
    <div class="card">
    <h2>Tambah Data Transaksi</h2>
    <form method="POST">
        <label>Waktu Transaksi</label>
        <input type="date" name="waktu_transaksi" required>

        <label>Keterangan</label>
        <textarea name="keterangan" placeholder="Masukkan keterangan transaksi" required></textarea>

        <label>Total</label>
        <input type="text" value="0" disabled>

        <label>Pelanggan</label>
        <select name="pelanggan_id" required>
            <option value="">Pilih Pelanggan</option>
            <?php
            $pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
            while ($p = mysqli_fetch_assoc($pelanggan)) {
                echo "<option value='{$p['id']}'>{$p['nama']}</option>";
            }
            ?>
        </select>

        <button type="submit" name="simpan">Tambah Transaksi</button>
    </form>
</div>
</body>
</html>