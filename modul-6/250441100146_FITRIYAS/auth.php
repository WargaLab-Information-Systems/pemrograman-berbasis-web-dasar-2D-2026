<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

function wajib_admin() {
    if ($_SESSION['role'] !== 'admin') {
        die("Akses ditolak!");
    }
}
?>
