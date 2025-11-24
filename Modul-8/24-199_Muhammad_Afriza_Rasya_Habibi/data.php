<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";

// mengambil daftar transaksi (join pelanggan & user)
$query = mysqli_query($conn, "
    SELECT t.*, p.nama AS pelanggan_nama, u.nama AS user_nama
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
    LEFT JOIN user u ON t.user_id = u.id_user
    ORDER BY t.id DESC
");
?>
<div class="container">
  <div class="header-transaksi">Manajemen Transaksi</div>
  <div class="box">
    <a class="btn btn-success" href="tambah.php">Tambah Transaksi</a>
    <table class="table table-hover" style="margin-top:12px;">
      <thead><tr><th>ID</th><th>Tanggal</th><th>Pelanggan</th><th>Keterangan</th><th>Total</th><th>User</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php while($r = mysqli_fetch_assoc($query)): ?>
        <tr>
          <td><?= $r['id'] ?></td>
          <td><?= $r['waktu_transaksi'] ?></td>
          <td><?= htmlspecialchars($r['pelanggan_nama'] ?: $r['pelanggan_id']) ?></td>
          <td><?= htmlspecialchars($r['keterangan']) ?></td>
          <td>Rp<?= number_format($r['total'],0,',','.') ?></td>
          <td><?= htmlspecialchars($r['user_nama']) ?></td>
          <td>
            <a class="btn btn-info btn-sm" href="detail.php?id=<?= $r['id'] ?>">Lihat Detail</a>
            <a class="btn btn-danger btn-sm" href="hapus.php?id=<?= $r['id'] ?>" onclick="return confirm('Hapus transaksi?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
