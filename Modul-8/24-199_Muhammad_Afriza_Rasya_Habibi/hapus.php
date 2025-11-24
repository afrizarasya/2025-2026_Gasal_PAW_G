<?php
include "koneksi.php";
include "cek_session.php";
$id = intval($_GET['id'] ?? 0);
if ($id) {
    // optionally delete details first
    mysqli_query($conn, "DELETE FROM transaksi_detail WHERE transaksi_id=$id");
    mysqli_query($conn, "DELETE FROM transaksi WHERE id=$id");
}
header("Location: data.php"); exit;
?>
