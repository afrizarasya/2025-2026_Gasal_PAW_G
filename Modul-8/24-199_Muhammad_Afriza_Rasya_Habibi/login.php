<?php
session_start();
if (isset($_SESSION['level'])) header("Location: index.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div style="max-width:420px; margin:50px auto;">
  <div class="header-box">Login Sistem</div>
  <div class="content-box">
    <form action="login_proses.php" method="POST">
      <div style="margin-bottom:10px;">
        <label>Username</label>
        <input class="form-control" type="text" name="username" required>
      </div>
      <div style="margin-bottom:10px;">
        <label>Password</label>
        <input class="form-control" type="password" name="password" required>
      </div>
      <button class="btn btn-success" type="submit">Login</button>
    </form>
  </div>
</div>
</body>
</html>
