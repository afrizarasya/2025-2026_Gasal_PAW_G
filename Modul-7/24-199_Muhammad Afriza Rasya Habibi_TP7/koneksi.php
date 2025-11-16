<?php
$conn = mysqli_connect("localhost", "root", "", "transaksi");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
