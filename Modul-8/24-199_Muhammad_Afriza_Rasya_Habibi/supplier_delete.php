<?php
include "koneksi.php";
include "cek_session.php";
$id = intval($_GET['id'] ?? 0);
if ($id) {
    mysqli_query($conn, "DELETE FROM supplier WHERE id=$id");
}
header("Location: supplier.php");
exit;
?>
