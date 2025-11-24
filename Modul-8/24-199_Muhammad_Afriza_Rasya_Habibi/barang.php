<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";

// ambil data barang dengan nama supplier
$q = mysqli_query($conn, "
    SELECT b.id, b.nama_barang, b.harga, b.stok, s.nama AS supplier_nama
    FROM barang b
    LEFT JOIN supplier s ON b.supplier_id = s.id
    ORDER BY b.id ASC
");
?>
<div class="container">
  <div class="header-bar">Data Barang</div>
  <div class="box">
    <div style="margin-bottom:12px;">
      <a class="btn btn-add" href="barang_add.php">+ Tambah Barang</a>
    </div>

    <table class="table table-hover" style="margin-top:12px;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama Barang</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Supplier</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php while($r = mysqli_fetch_assoc($q)): ?>
        <tr>
          <td><?= $r['id'] ?></td>
          <td><?= htmlspecialchars($r['nama_barang']) ?></td>
          <td class="text-right">Rp<?= number_format($r['harga'],0,',','.') ?></td>
          <td class="text-right"><?= $r['stok'] ?></td>
          <td><?= htmlspecialchars($r['supplier_nama']) ?></td>
          <td>
            <a class="btn btn-info btn-sm" href="barang_edit.php?id=<?= $r['id'] ?>">Edit</a>
            <a class="btn btn-danger btn-sm" href="barang_delete.php?id=<?= $r['id'] ?>"
               onclick="return confirm('Hapus barang ini?')">Hapus</a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

  </div>
</div>
