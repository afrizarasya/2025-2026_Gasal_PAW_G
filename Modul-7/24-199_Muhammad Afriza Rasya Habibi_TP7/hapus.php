<?php
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $hapus = mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi = '$id'");

    if ($hapus) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location='data.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data!');
                window.location='data.php';
              </script>";
    }
} else {
    header("Location: data.php");
}
?>
