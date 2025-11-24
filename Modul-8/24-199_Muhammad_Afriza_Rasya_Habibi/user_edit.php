<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";
if ($_SESSION['level'] != 1) { echo "Tidak punya akses"; exit; }
$id = intval($_GET['id'] ?? 0);
$q = mysqli_query($conn, "SELECT * FROM user WHERE id_user=$id");
$r = mysqli_fetch_assoc($q);
if (!$r) { echo "Tidak ditemukan"; exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $hp = mysqli_real_escape_string($conn, $_POST['hp']);
    $level = intval($_POST['level']);
    mysqli_query($conn, "UPDATE user SET username='$username', password='$password', nama='$nama', alamat='$alamat', hp='$hp', level=$level WHERE id_user=$id");
    header("Location: user.php"); exit;
}
?>
<div class="container">
  <div class="header-bar">Edit User</div>
  <div class="box" style="max-width:700px;">
    <form method="post">
      <div class="form-group"><label>Username</label><input class="form-control" name="username" value="<?= htmlspecialchars($r['username']) ?>" required></div>
      <div class="form-group"><label>Password</label><input class="form-control" name="password" value="<?= htmlspecialchars($r['password']) ?>" required></div>
      <div class="form-group"><label>Nama</label><input class="form-control" name="nama" value="<?= htmlspecialchars($r['nama']) ?>" required></div>
      <div class="form-group"><label>Alamat</label><textarea class="form-control" name="alamat"><?= htmlspecialchars($r['alamat']) ?></textarea></div>
      <div class="form-group"><label>HP</label><input class="form-control" name="hp" value="<?= htmlspecialchars($r['hp']) ?>"></div>
      <div class="form-group"><label>Level</label><input class="form-control" name="level" type="number" min="1" max="2" value="<?= $r['level'] ?>"></div>
      <button class="btn btn-success">Update</button>
      <a class="btn btn-secondary" href="user.php">Batal</a>
    </form>
  </div>
</div>
