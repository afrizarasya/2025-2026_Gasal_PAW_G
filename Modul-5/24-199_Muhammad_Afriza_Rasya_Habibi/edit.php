<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "store";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn) {
    if (!isset($_GET['id'])) {
        echo "<script>alert('ID Supplier tidak ditemukan!'); window.location='index.php';</script>";
        exit;
    }

    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM supplier WHERE id='$id'");
    if (mysqli_num_rows($result) == 0) {
        echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
        exit;
    }

    $data = mysqli_fetch_assoc($result);
    $nama = $data['nama'];
    $telp = $data['telp'];
    $alamat = $data['alamat'];
    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = trim($_POST['nama']);
        $telp = trim($_POST['telp']);
        $alamat = trim($_POST['alamat']);

        if ($nama == "" || !preg_match("/^[a-zA-Z\s]+$/", $nama))
            $errors['nama'] = "tidak boleh kosong, hanya boleh huruf.";
        if ($telp == "" || !ctype_digit($telp))
            $errors['telp'] = "tidak boleh kosong, hanya boleh angka.";
        if ($alamat == "" || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]+$/", $alamat))
            $errors['alamat'] = "tidak boleh kosong, harus alfanumerik (huruf & angka).";

        if (empty($errors)) {
            $update = mysqli_query($conn, "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'");
            if ($update) {
                echo "<script>alert('Data supplier berhasil diperbarui!'); window.location='index.php';</script>";
                exit;
            } else {
                echo "<script>alert('Terjadi kesalahan saat menyimpan data!');</script>";
            }
        }
    }
} else {
    echo "<p style='color:red;'>Koneksi ke database gagal: " . mysqli_connect_error() . "</p>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Supplier</title>
</head>
<body>
<h2>Edit Data Supplier</h2>
<?php if ($conn): ?>
<form method="POST">
    <table>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>">
                <div style="color:red;"><?= $errors['nama'] ?? '' ?></div></td>
        </tr>
        <tr>
            <td>Telp</td>
            <td><input type="text" name="telp" value="<?= htmlspecialchars($telp) ?>">
                <div style="color:red;"><?= $errors['telp'] ?? '' ?></div></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><textarea name="alamat"><?= htmlspecialchars($alamat) ?></textarea>
                <div style="color:red;"><?= $errors['alamat'] ?? '' ?></div></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit">Simpan</button>
                <a href="index.php">Batal</a>
            </td>
        </tr>
    </table>
</form>
<?php endif; ?>
</body>
</html>