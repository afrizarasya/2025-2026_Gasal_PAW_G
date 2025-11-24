<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";
if ($_SESSION['level'] != 1) { echo "<div class='container'><div class='box'>Anda tidak punya akses.</div></div>"; exit; }
$res = mysqli_query($conn, "SELECT * FROM user ORDER BY id_user ASC");
?>
<div class="container">
  <div class="header-bar">Data User</div>
  <div class="box">
    <a class="btn btn-add" href="user_add.php">Tambah User</a>
    <table class="table table-hover" style="margin-top:12px;">
      <thead><tr><th>ID</th><th>Username</th><th>Nama</th><th>HP</th><th>Alamat</th><th>Level</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php while($u = mysqli_fetch_assoc($res)): ?>
        <tr>
          <td><?= $u['id_user'] ?></td>
          <td><?= htmlspecialchars($u['username']) ?></td>
          <td><?= htmlspecialchars($u['nama']) ?></td>
          <td><?= htmlspecialchars($u['hp']) ?></td>
          <td><?= htmlspecialchars($u['alamat']) ?></td>
          <td><?= $u['level'] ?></td>
          <td>
            <a class="btn btn-info btn-sm" href="user_edit.php?id=<?= $u['id_user'] ?>">Edit</a>
            <a class="btn btn-danger btn-sm" href="user_delete.php?id=<?= $u['id_user'] ?>" onclick="return confirm('Hapus?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
