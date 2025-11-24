<?php
// navbar.php
if (session_status() == PHP_SESSION_NONE) session_start();
?>
<link rel="stylesheet" href="style.css">
<div class="nav-wrapper">
    <div class="brand">Sistem Penjualan</div>
    <div class="nav-right">
        <?php if(isset($_SESSION['nama'])): ?>
            <span class="small">Hai, <?= htmlspecialchars($_SESSION['nama']) ?></span>
            <a class="btn-back" href="logout.php">Logout</a>
        <?php endif; ?>
    </div>
</div>
<div class="nav">
    <a href="index.php">Home</a>
    <?php if(isset($_SESSION['level']) && $_SESSION['level']==1): ?>
        <div class="dropdown">
            <a href="#">Data Master ▾</a>
            <div class="dropdown-content">
                <a href="barang.php">Barang</a>
                <a href="supplier.php">Supplier</a>
                <a href="pelanggan.php">Pelanggan</a>
                <a href="user.php">User</a>
            </div>
        </div>
    <?php endif; ?>
    <?php if(isset($_SESSION['level'])): ?>
        <a href="data.php">Transaksi</a>
        <a href="report_transaksi.php">Laporan</a>
    <?php endif; ?>
</div>
<hr>
