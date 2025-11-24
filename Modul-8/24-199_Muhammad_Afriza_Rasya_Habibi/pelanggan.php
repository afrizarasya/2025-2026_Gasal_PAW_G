<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";
$res = mysqli_query($conn, "SELECT * FROM pelanggan ORDER BY id ASC");
?>
<div class="container">
  <div class="header-bar">Data Pelanggan</div>
  <div class="box">
    <a class="btn btn-add" href="pelanggan_add.php">Tambah Pelanggan</a>
    <table class="table table-hover" style="margin-top:12px;">
      <thead><tr><th>ID</th><th>Nama</th><th>JK</th><th>Telp</th><th>Alamat</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php while($p = mysqli_fetch_assoc($res)): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= htmlspecialchars($p['nama']) ?></td>
          <td><?= $p['jenis_kelamin'] ?></td>
          <td><?= htmlspecialchars($p['telp']) ?></td>
          <td><?= htmlspecialchars($p['alamat']) ?></td>
          <td>
            <a class="btn btn-info btn-sm" href="pelanggan_edit.php?id=<?= $p['id'] ?>">Edit</a>
            <a class="btn btn-danger btn-sm" href="pelanggan_delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
