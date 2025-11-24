<?php
include "../koneksi.php";
include "cek_session.php";
include "navbar.php";

$id = intval($_GET['id'] ?? 0);
$q = mysqli_query($conn, "SELECT t.*, p.nama as pelanggan_nama, u.nama as user_nama FROM transaksi t LEFT JOIN pelanggan p ON t.pelanggan_id=p.id LEFT JOIN user u ON t.user_id=u.id_user WHERE t.id=$id");
$t = mysqli_fetch_assoc($q);
if (!$t) { echo "<div class='container'><div class='box'>Transaksi tidak ditemukan</div></div>"; exit; }

$det = mysqli_query($conn, "SELECT td.*, b.nama_barang FROM transaksi_detail td LEFT JOIN barang b ON td.barang_id=b.id WHERE td.transaksi_id=$id");
?>
<div class="container">
  <div class="header-box">Detail Transaksi</div>
  <div class="content-box">
    <a class="btn btn-back" href="data.php">← Kembali</a>
    <table class="table" style="margin-top:12px;">
      <tr><td class="info-label">ID Transaksi</td><td><?= $t['id'] ?></td></tr>
      <tr><td class="info-label">Tanggal</td><td><?= $t['waktu_transaksi'] ?></td></tr>
      <tr><td class="info-label">Pelanggan</td><td><?= htmlspecialchars($t['pelanggan_nama']) ?></td></tr>
      <tr><td class="info-label">Keterangan</td><td><?= htmlspecialchars($t['keterangan']) ?></td></tr>
      <tr><td class="info-label">User</td><td><?= htmlspecialchars($t['user_nama']) ?></td></tr>
    </table>

    <h5>Detail Item</h5>
    <table class="table table-bordered">
      <thead><tr><th>Barang</th><th>Harga</th><th>Qty</th><th>Subtotal</th></tr></thead>
      <tbody>
        <?php while($d = mysqli_fetch_assoc($det)): ?>
          <tr>
            <td><?= htmlspecialchars($d['nama_barang']) ?></td>
            <td>Rp<?= number_format($d['harga'],0,',','.') ?></td>
            <td><?= $d['qty'] ?></td>
            <td>Rp<?= number_format($d['harga'] * $d['qty'],0,',','.') ?></td>
          </tr>
        <?php endwhile; ?>
        <tr>
          <td colspan="3" style="text-align:right"><b>Total</b></td>
          <td><b>Rp<?= number_format($t['total'],0,',','.') ?></b></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
