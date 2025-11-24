<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";
$id = intval($_GET['id'] ?? 0);
$q = mysqli_query($conn, "SELECT * FROM supplier WHERE id=$id");
$r = mysqli_fetch_assoc($q);
if (!$r) { echo "Supplier tidak ditemukan"; exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    mysqli_query($conn, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat', email='$email' WHERE id=$id");
    header("Location: supplier.php"); exit;
}
?>
<div class="container">
  <div class="header-bar">Edit Supplier</div>
  <div class="box" style="max-width:700px;">
    <form method="post">
      <div class="form-group"><label>Nama</label><input class="form-control" name="nama" value="<?= htmlspecialchars($r['nama']) ?>" required></div>
      <div class="form-group"><label>Telp</label><input class="form-control" name="telp" value="<?= htmlspecialchars($r['telp']) ?>"></div>
      <div class="form-group"><label>Alamat</label><textarea class="form-control" name="alamat"><?= htmlspecialchars($r['alamat']) ?></textarea></div>
      <div class="form-group"><label>Email</label><input class="form-control" name="email" value="<?= htmlspecialchars($r['email']) ?>"></div>
      <button class="btn btn-success">Update</button>
      <a class="btn btn-secondary" href="supplier.php">Batal</a>
    </form>
  </div>
</div>
