<?php
include 'config/auth.php';
include 'config/koneksi.php';

if ($_SESSION['role'] != 'admin') {
    die("Akses ditolak");
}

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM buku WHERE id=?");
$stmt->bind_param("i", $id);

$stmt->execute();

header("Location: dashboard.php");
exit;
?>