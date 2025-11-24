<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";

$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY nama ASC");
$barang = mysqli_query($conn, "SELECT * FROM barang ORDER BY nama_barang ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pelanggan_id = mysqli_real_escape_string($conn, $_POST['pelanggan_id']);
    $user_id = $_SESSION['id_user'];
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $barang_id = intval($_POST['barang_id']);
    $qty = intval($_POST['qty']);

    // ambil harga barang
    $bq = mysqli_query($conn, "SELECT harga, stok FROM barang WHERE id=$barang_id");
    $b = mysqli_fetch_assoc($bq);
    $harga = $b['harga'] ?? 0;
    $subtotal = $harga * $qty;

    $tanggal = date('Y-m-d');

    mysqli_query($conn, "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id, user_id) VALUES ('$tanggal', '$keterangan', $subtotal, '$pelanggan_id', $user_id)");
    $trans_id = mysqli_insert_id($conn);

    mysqli_query($conn, "INSERT INTO transaksi_detail (transaksi_id, barang_id, harga, qty) VALUES ($trans_id, $barang_id, $harga, $qty)");

    // update stok
    if (isset($b['stok'])) {
        $newstok = max(0, $b['stok'] - $qty);
        mysqli_query($conn, "UPDATE barang SET stok=$newstok WHERE id=$barang_id");
    }

    echo "<script>alert('Transaksi berhasil ditambahkan'); window.location='data.php';</script>";
    exit;
}
?>
<div class="container">
  <div class="header-box">Tambah Transaksi</div>
  <div class="content-box" style="max-width:800px;">
    <a class="btn btn-back" href="data.php">← Kembali</a>
    <form method="post" style="margin-top:12px;">
      <div class="form-group">
        <label>Pelanggan</label>
        <select class="form-control" name="pelanggan_id" required>
          <?php while($p = mysqli_fetch_assoc($pelanggan)): ?>
            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nama']) ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Keterangan</label>
        <select class="form-control" name="keterangan" required>
          <option value="Self pickup">Self pickup</option>
          <option value="Delivery Order">Delivery Order</option>
        </select>
      </div>

      <div class="form-group">
        <label>Barang</label>
        <select class="form-control" name="barang_id" required>
          <?php mysqli_data_seek($barang,0); while($br = mysqli_fetch_assoc($barang)): ?>
            <option value="<?= $br['id'] ?>"><?= htmlspecialchars($br['nama_barang']) ?> - Rp<?= number_format($br['harga']) ?> (stok: <?= $br['stok'] ?>)</option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="form-group">
        <label>Qty</label>
        <input class="form-control" type="number" name="qty" value="1" min="1" required>
      </div>

      <button class="btn btn-success">Simpan Transaksi</button>
    </form>
  </div>
</div>
