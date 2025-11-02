<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "store";

$conn = mysqli_connect($host, $user, $pass, $db);

$nama = $telp = $alamat = "";
$errors = [];

if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = trim($_POST['nama']);
        $telp = trim($_POST['telp']);
        $alamat = trim($_POST['alamat']);

        if ($nama == "" || !preg_match("/^[a-zA-Z\s]+$/", $nama))
            $errors['nama'] = "Nama wajib diisi dan hanya huruf.";

        if ($telp == "" || !ctype_digit($telp))
            $errors['telp'] = "Telepon wajib diisi dan hanya angka.";

        if ($alamat == "" || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d\s]+$/", $alamat))
            $errors['alamat'] = "Alamat harus alfanumerik (ada huruf dan angka).";

        if (empty($errors)) {
            $sql = "INSERT INTO supplier (nama, telp, alamat) VALUES ('$nama','$telp','$alamat')";
            mysqli_query($conn, $sql);
            header("Location: index.php");
            exit;
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
    <title>Tambah Data Master Supplier Baru</title>
    <style>
        body {font-family:'Segoe UI',Arial,sans-serif;background:#f8f9fa;margin:40px;}
        form {background:white;width:500px;padding:25px;border-radius:8px;box-shadow:0 2px 5px rgba(0,0,0,0.1);}
        .error{color:red;font-size:0.9em;}
        .btn{padding:8px 15px;border-radius:4px;color:white;font-weight:bold;text-decoration:none;border:none;cursor:pointer;transition:0.2s;}
        .btn-simpan{background-color:#5cb85c;}
        .btn-batal{background-color:#d9534f;margin-left:5px;}
    </style>
</head>
<body>
<h2>Tambah Data Master Supplier Baru</h2>

<form method="POST">
    <table>
        <tr>
            <td>Nama</td>
            <td><input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>">
                <div class="error"><?= $errors['nama'] ?? '' ?></div></td>
        </tr>
        <tr>
            <td>Telp</td>
            <td><input type="text" name="telp" value="<?= htmlspecialchars($telp) ?>">
                <div class="error"><?= $errors['telp'] ?? '' ?></div></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><textarea name="alamat"><?= htmlspecialchars($alamat) ?></textarea>
                <div class="error"><?= $errors['alamat'] ?? '' ?></div></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-simpan">Simpan</button>
                <a href="index.php" class="btn btn-batal">Batal</a>
            </td>
        </tr>
    </table>
</form>
</body>
</html>