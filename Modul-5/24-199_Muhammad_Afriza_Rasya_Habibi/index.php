<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "store";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn) {
    $result = mysqli_query($conn, "SELECT * FROM supplier");
} else {
    echo "<p style='color:red;'>Koneksi ke database gagal: " . mysqli_connect_error() . "</p>";
    $result = false;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Master Supplier</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 40px;
        }
        h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .btn-tambah {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            float: right;
            margin-bottom: 15px;
            transition: 0.2s;
        }
        .btn-tambah:hover { background-color: #218838; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
        }
        th {
            background-color: #d9edf7;
            color: #31708f;
            text-align: left;
            padding: 10px;
        }
        td {
            border-top: 1px solid #ddd;
            padding: 10px;
        }
        tr:hover { background-color: #f2f2f2; }
        .btn {
            padding: 6px 12px;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            transition: 0.2s;
        }
        .btn-edit { background-color: #f0ad4e; }
        .btn-edit:hover { background-color: #ec971f; }
        .btn-hapus { background-color: #d9534f; }
        .btn-hapus:hover { background-color: #c9302c; }
    </style>
</head>
<body>

<h2>Data Master Supplier</h2>
<a href="tambah.php" class="btn-tambah">Tambah Data</a>

<?php if ($result): ?>
<table>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Telp</th>
        <th>Alamat</th>
        <th>Tindakan</th>
    </tr>
    <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= htmlspecialchars($row['telp']) ?></td>
        <td><?= htmlspecialchars($row['alamat']) ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-edit">Edit</a>
            <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<?php else: ?>
    <p>Tidak dapat menampilkan data supplier karena koneksi gagal.</p>
<?php endif; ?>

</body>
</html>
