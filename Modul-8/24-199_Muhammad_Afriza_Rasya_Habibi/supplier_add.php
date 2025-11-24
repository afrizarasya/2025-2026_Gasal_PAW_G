<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    mysqli_query($conn, "INSERT INTO supplier (nama, telp, alamat, email) VALUES ('$nama','$telp','$alamat','$email')");
    header("Location: supplier.php");
    exit;
}
?>
<div class="container">
  <div class="header-bar">Tambah Supplier</div>
  <div class="box" style="max-width:700px;">
    <form method="post">
      <div class="form-group"><label>Nama</label><input class="form-control" name="nama" required></div>
      <div class="form-group"><label>Telp</label><input class="form-control" name="telp"></div>
      <div class="form-group"><label>Alamat</label><textarea class="form-control" name="alamat"></textarea></div>
      <div class="form-group"><label>Email</label><input class="form-control" name="email"></div>
      <button class="btn btn-success">Simpan</button>
      <a class="btn btn-secondary" href="supplier.php">Batal</a>
    </form>
  </div>
</div>
