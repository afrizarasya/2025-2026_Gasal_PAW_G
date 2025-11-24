<?php
include "cek_session.php";
include "navbar.php";
?>
<link rel="stylesheet" href="../style.css">
<div class="container">
  <div class="header-bar">Dashboard</div>
  <div class="box">
    <h3>Selamat datang, <?= htmlspecialchars($_SESSION['nama']) ?></h3>
    <p>Gunakan menu untuk mengelola data.</p>
  </div>
</div>
