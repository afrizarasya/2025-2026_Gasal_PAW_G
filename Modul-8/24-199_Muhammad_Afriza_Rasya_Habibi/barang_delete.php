<?php
include "koneksi.php";
include "cek_session.php";

$id = intval($_GET['id'] ?? 0);
if ($id) {
    // jika ada constraint di transaksi_detail, hapus detail dulu (jika ada)
    mysqli_query($conn, "DELETE FROM transaksi_detail WHERE barang_id=$id");
    mysqli_query($conn, "DELETE FROM barang WHERE id=$id");
}
header("Location: barang.php");
exit;
?>