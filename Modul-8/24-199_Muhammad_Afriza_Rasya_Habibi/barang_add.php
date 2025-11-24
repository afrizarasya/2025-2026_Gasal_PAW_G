<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";

$suppliers = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $harga = intval($_POST['harga']);
    $stok = intval($_POST['stok']);
    $supplier_id = intval($_POST['supplier_id']);

    mysqli_query($conn, "INSERT INTO barang (nama_barang, harga, stok, supplier_id) VALUES ('$nama', $harga, $stok, $supplier_id)");
    header("Location: barang.php");
    exit;
}
?>
<div class="container">
  <div class="header-bar">Tambah Barang</div>
  <div class="box" style="max-width:700px;">
    <form method="post">
      <div class="form-group">
        <label>Nama Barang</label>
        <input class="form-control" name="nama_barang" required>
      </div>
      <div class="form-group">
        <label>Harga (Rp)</label>
        <input class="form-control" name="harga" type="number" min="0" value="0" required>
      </div>
      <div class="form-group">
        <label>Stok</label>
        <input class="form-control" name="stok" type="number" min="0" value="0" required>
      </div>
      <div class="form-group">
        <label>Supplier</label>
        <select class="form-control" name="supplier_id" required>
          <option value="">-- Pilih Supplier --</option>
          <?php while($s = mysqli_fetch_assoc($suppliers)): ?>
            <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['nama']) ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <button class="btn btn-success">Simpan</button>
      <a class="btn btn-secondary" href="barang.php">Batal</a>
    </form>
  </div>
</div>
