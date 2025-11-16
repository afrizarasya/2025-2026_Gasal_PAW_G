<?php
include "koneksi.php";

$show = isset($_GET['mulai']) && isset($_GET['selesai']);

$mulai = $show ? $_GET['mulai'] : "";
$selesai = $show ? $_GET['selesai'] : "";

$data = [];
$totalPendapatan = 0;
$jumlahPelanggan = 0;

if ($show) {
    $query = mysqli_query($conn, "
        SELECT * FROM transaksi 
        WHERE tanggal BETWEEN '$mulai' AND '$selesai'
        ORDER BY tanggal ASC
    ");

    while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row;
        $totalPendapatan += $row['total'];
        $jumlahPelanggan++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rekap Laporan Penjualan</title>

    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .header-rekap {
            background: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            font-size: 18px;
        }
        .box {
            background: white;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #dcdcdc;
            margin-bottom: 20px;
        }

        @media print {

            /* Hilangkan tombol dan form */
            .btn, .form-inline, a.btn, .mb-3 {
                display: none !important;
            }

            body, html, .container {
                margin: 0 !important;
                padding: 0 !important;
                width: 100% !important;
            }

            .box {
                border: none !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            /* Chart tidak overflow */
            canvas {
                max-width: 100% !important;
                height: auto !important;
            }

            table {
                width: 100% !important;
                font-size: 12px;
            }

            * {
                box-sizing: border-box !important;
            }
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <div class="header-rekap">
        Rekap Laporan Penjualan
    </div>

    <div class="box">

        <a href="data.php" class="btn btn-primary mb-3">← Kembali</a>

        <form class="form-inline mb-4" method="GET">

            <input type="date" name="mulai" class="form-control mr-2"
                   value="<?= $mulai ?>" required>

            <input type="date" name="selesai" class="form-control mr-2"
                   value="<?= $selesai ?>" required>

            <button class="btn btn-success">Tampilkan</button>

        </form>

        <?php if ($show): ?>

            <div style="width:100%; height:350px;">
                <canvas id="grafik"></canvas>
            </div>

            <script>
            const ctx = document.getElementById('grafik');

            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode(array_column($data, 'tanggal')); ?>,
                    datasets: [{
                        label: 'Total Penjualan (Rp)',
                        data: <?= json_encode(array_column($data, 'total')); ?>,
                        borderWidth: 1,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
            </script>

            <hr>

            <h5>Rekap Penjualan</h5>
            <table class="table table-bordered text-center">
                <tr class="thead-light">
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Keterangan</th>
                    <th>Total (Rp)</th>
                </tr>

                <?php foreach ($data as $d): ?>
                <tr>
                    <td><?= $d['tanggal']; ?></td>
                    <td><?= $d['nama_pelanggan']; ?></td>
                    <td><?= $d['keterangan']; ?></td>
                    <td>Rp<?= number_format($d['total'], 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            </table>

            <h5>Total</h5>
            <table class="table table-bordered text-center">
                <tr>
                    <th>Jumlah Pelanggan</th>
                    <th>Total Pendapatan</th>
                </tr>
                <tr>
                    <td><?= $jumlahPelanggan; ?></td>
                    <td>Rp<?= number_format($totalPendapatan, 0, ',', '.'); ?></td>
                </tr>
            </table>

            <button onclick="window.print()" class="btn btn-danger">Cetak PDF</button>
            <a href="excel.php?mulai=<?= $mulai ?>&selesai=<?= $selesai ?>" class="btn btn-success">Export Excel</a>

        <?php endif; ?>

    </div>
</div>

</body>
</html>
