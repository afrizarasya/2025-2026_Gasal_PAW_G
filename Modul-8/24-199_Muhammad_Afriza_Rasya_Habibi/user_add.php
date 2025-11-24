<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";
if ($_SESSION['level'] != 1) { echo "Tidak punya akses"; exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // plain text as DB existing
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $hp = mysqli_real_escape_string($conn, $_POST['hp']);
    $level = intval($_POST['level']);
    mysqli_query($conn, "INSERT INTO user (username,password,nama,alamat,hp,level) VALUES ('$username','$password','$nama','$alamat','$hp',$level)");
    header("Location: user.php"); exit;
}
?>
<div class="container">
  <div class="header-bar">Tambah User</div>
  <div class="box" style="max-width:700px;">
    <form method="post">
      <div class="form-group"><label>Username</label><input class="form-control" name="username" required></div>
      <div class="form-group"><label>Password</label><input class="form-control" name="password" required></div>
      <div class="form-group"><label>Nama</label><input class="form-control" name="nama" required></div>
      <div class="form-group"><label>Alamat</label><textarea class="form-control" name="alamat"></textarea></div>
      <div class="form-group"><label>HP</label><input class="form-control" name="hp"></div>
      <div class="form-group"><label>Level (1 owner, 2 kasir)</label><input class="form-control" name="level" type="number" min="1" max="2" value="2"></div>
      <button class="btn btn-success">Simpan</button>
      <a class="btn btn-secondary" href="user.php">Batal</a>
    </form>
  </div>
</div>
