<?php
// cek_session.php
if (session_status() == PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['level'])) {
    header("Location: login.php");
    exit;
}
?>
