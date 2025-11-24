<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";

$id = intval($_GET['id'] ?? 0);
if (!$id) {
    header("Location: barang.php"); exit;
}

$q = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id");
$barang = mysqli_fetch_assoc($q);
if (!$barang) { echo "<div class='container'><div class='box'>Barang tidak ditemukan</div></div>"; exit; }

$suppliers = mysqli_query($conn, "SELECT * FROM supplier ORDER BY nama ASC");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $harga = intval($_POST['harga']);
    $stok = intval($_POST['stok']);
    $supplier_id = intval($_POST['supplier_id']);

    mysqli_query($conn, "UPDATE barang SET nama_barang='$nama', harga=$harga, stok=$stok, supplier_id=$supplier_id WHERE id=$id");
    header("Location: barang.php");
    exit;
}
?>
<div class="container">
  <div class="header-bar">Edit Barang</div>
  <div class="box" style="max-width:700px;">
    <form method="post">
      <div class="form-group">
        <label>Nama Barang</label>
        <input class="form-control" name="nama_barang" value="<?= htmlspecialchars($barang['nama_barang']) ?>" required>
      </div>
      <div class="form-group">
        <label>Harga (Rp)</label>
        <input class="form-control" name="harga" type="number" min="0" value="<?= $barang['harga'] ?>" required>
      </div>
      <div class="form-group">
        <label>Stok</label>
        <input class="form-control" name="stok" type="number" min="0" value="<?= $barang['stok'] ?>" required>
      </div>
      <div class="form-group">
        <label>Supplier</label>
        <select class="form-control" name="supplier_id" required>
          <?php while($s = mysqli_fetch_assoc($suppliers)): ?>
            <option value="<?= $s['id'] ?>" <?= $s['id'] == $barang['supplier_id'] ? 'selected' : '' ?>>
              <?= htmlspecialchars($s['nama']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <button class="btn btn-success">Update</button>
      <a class="btn btn-secondary" href="barang.php">Batal</a>
    </form>
  </div>
</div>
