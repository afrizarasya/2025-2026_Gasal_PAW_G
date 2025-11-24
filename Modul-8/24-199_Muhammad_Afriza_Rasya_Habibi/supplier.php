<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";

$res = mysqli_query($conn, "SELECT * FROM supplier ORDER BY id ASC");
?>
<div class="container">
  <div class="header-bar">Data Supplier</div>
  <div class="box">
    <div style="margin-bottom:12px;">
      <a class="btn btn-add" href="supplier_add.php">Tambah Supplier</a>
    </div>
    <table class="table table-hover">
      <thead><tr><th>ID</th><th>Nama</th><th>Telp</th><th>Alamat</th><th>Email</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php while($r = mysqli_fetch_assoc($res)): ?>
        <tr>
          <td><?= $r['id'] ?></td>
          <td><?= htmlspecialchars($r['nama']) ?></td>
          <td><?= htmlspecialchars($r['telp']) ?></td>
          <td><?= htmlspecialchars($r['alamat']) ?></td>
          <td><?= htmlspecialchars($r['email']) ?></td>
          <td>
            <a class="btn btn-info btn-sm" href="supplier_edit.php?id=<?= $r['id'] ?>">Edit</a>
            <a class="btn btn-danger btn-sm" href="supplier_delete.php?id=<?= $r['id'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
