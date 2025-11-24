<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = uniqid();
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jk = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    mysqli_query($conn, "INSERT INTO pelanggan (id,nama,jenis_kelamin,telp,alamat) VALUES ('$id','$nama','$jk','$telp','$alamat')");
    header("Location: pelanggan.php"); exit;
}
?>
<div class="container">
  <div class="header-bar">Tambah Pelanggan</div>
  <div class="box" style="max-width:700px;">
    <form method="post">
      <div class="form-group"><label>Nama</label><input class="form-control" name="nama" required></div>
      <div class="form-group"><label>Jenis Kelamin</label>
        <select class="form-control" name="jenis_kelamin" required><option value="L">Laki-laki</option><option value="P">Perempuan</option></select>
      </div>
      <div class="form-group"><label>Telp</label><input class="form-control" name="telp"></div>
      <div class="form-group"><label>Alamat</label><textarea class="form-control" name="alamat"></textarea></div>
      <button class="btn btn-success">Simpan</button>
      <a class="btn btn-secondary" href="pelanggan.php">Batal</a>
    </form>
  </div>
</div>
