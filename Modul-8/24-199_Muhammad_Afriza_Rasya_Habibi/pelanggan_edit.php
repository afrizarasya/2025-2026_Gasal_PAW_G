<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";
$id = $_GET['id'] ?? '';
$q = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id='$id'");
$p = mysqli_fetch_assoc($q);
if (!$p) { echo "Data tidak ditemukan"; exit; }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jk = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $telp = mysqli_real_escape_string($conn, $_POST['telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    mysqli_query($conn, "UPDATE pelanggan SET nama='$nama', jenis_kelamin='$jk', telp='$telp', alamat='$alamat' WHERE id='$id'");
    header("Location: pelanggan.php"); exit;
}
?>
<div class="container">
  <div class="header-bar">Edit Pelanggan</div>
  <div class="box" style="max-width:700px;">
    <form method="post">
      <div class="form-group"><label>Nama</label><input class="form-control" name="nama" value="<?= htmlspecialchars($p['nama']) ?>" required></div>
      <div class="form-group"><label>Jenis Kelamin</label>
        <select class="form-control" name="jenis_kelamin" required>
          <option value="L" <?= $p['jenis_kelamin']=="L"?"selected":"" ?>>Laki-laki</option>
          <option value="P" <?= $p['jenis_kelamin']=="P"?"selected":"" ?>>Perempuan</option>
        </select>
      </div>
      <div class="form-group"><label>Telp</label><input class="form-control" name="telp" value="<?= htmlspecialchars($p['telp']) ?>"></div>
      <div class="form-group"><label>Alamat</label><textarea class="form-control" name="alamat"><?= htmlspecialchars($p['alamat']) ?></textarea></div>
      <button class="btn btn-success">Update</button>
      <a class="btn btn-secondary" href="pelanggan.php">Batal</a>
    </form>
  </div>
</div>
