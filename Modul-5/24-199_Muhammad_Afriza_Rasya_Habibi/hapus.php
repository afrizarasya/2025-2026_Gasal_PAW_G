<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "store";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $check = mysqli_query($conn, "SELECT * FROM supplier WHERE id='$id'");
        if (mysqli_num_rows($check) > 0) {
            mysqli_query($conn, "DELETE FROM supplier WHERE id='$id'");
            echo "<script>alert('Data supplier berhasil dihapus!'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
        }
    } else {
        echo "<script>alert('ID tidak ditemukan!'); window.location='index.php';</script>";
    }
} else {
    echo "<p style='color:red;'>Koneksi ke database gagal: " . mysqli_connect_error() . "</p>";
}
?>
