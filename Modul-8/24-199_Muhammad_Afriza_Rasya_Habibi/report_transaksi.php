<?php
include "koneksi.php";
include "cek_session.php";
include "navbar.php";

$show = isset($_GET['mulai']) && isset($_GET['selesai']);
$mulai = $show ? $_GET['mulai'] : "";
$selesai = $show ? $_GET['selesai'] : "";
$data = []; $totalPendapatan = 0; $jumlahTransaksi = 0;

if ($show) {
    $q = mysqli_query($conn, "
        SELECT t.*, p.nama AS pelanggan_nama
        FROM transaksi t
        LEFT JOIN pelanggan p ON t.pelanggan_id = p.id
        WHERE t.waktu_transaksi BETWEEN '$mulai' AND '$selesai'
        ORDER BY t.waktu_transaksi ASC
    ");
    while($row = mysqli_fetch_assoc($q)) {
        $data[] = $row;
        $totalPendapatan += $row['total'];
        $jumlahTransaksi++;
    }
}
?>
<div class="container">
  <div class="header-rekap">Rekap Laporan Penjualan</div>
  <div class="box">
    <a class="btn btn-back" href="data.php">← Kembali</a>
    <form class="form-inline mb-4" method="GET" style="margin-top:12px;">
      <input type="date" name="mulai" class="form-control" value="<?= htmlspecialchars($mulai) ?>" required>
      <input type="date" name="selesai" class="form-control" value="<?= htmlspecialchars($selesai) ?>" required>
      <button class="btn btn-success">Tampilkan</button>
    </form>

    <?php if ($show): ?>
      <div style="width:100%; height:350px;">
        <canvas id="grafik"></canvas>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
        const ctx = document.getElementById('grafik');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($data, 'waktu_transaksi')); ?>,
                datasets: [{
                    label: 'Total Penjualan (Rp)',
                    data: <?= json_encode(array_column($data, 'total')); ?>,
                    borderWidth: 1,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)'
                }]
            },
            options: { responsive:true, maintainAspectRatio:false }
        });
      </script>

      <hr>
      <h5>Rekap Penjualan</h5>
      <table class="table table-bordered text-center">
        <thead><tr><th>Tanggal</th><th>Nama Pelanggan</th><th>Keterangan</th><th>Total (Rp)</th></tr></thead>
        <tbody>
          <?php foreach($data as $d): ?>
            <tr>
              <td><?= $d['waktu_transaksi'] ?></td>
              <td><?= htmlspecialchars($d['pelanggan_nama']) ?></td>
              <td><?= htmlspecialchars($d['keterangan']) ?></td>
              <td>Rp<?= number_format($d['total'],0,',','.') ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <h5>Total</h5>
      <table class="table table-bordered text-center">
        <tr><th>Jumlah Transaksi</th><th>Total Pendapatan</th></tr>
        <tr><td><?= $jumlahTransaksi ?></td><td>Rp<?= number_format($totalPendapatan,0,',','.') ?></td></tr>
      </table>

      <button onclick="window.print()" class="btn btn-danger">Cetak PDF</button>
      <a class="btn btn-success" href="excel.php?mulai=<?= $mulai ?>&selesai=<?= $selesai ?>">Export Excel</a>
    <?php endif; ?>
  </div>
</div>
