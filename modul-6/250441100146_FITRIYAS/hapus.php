<?php
include 'auth.php';
include 'koneksi.php';
wajib_admin();

$id = (int)$_GET['id'];

$stmt = $conn->prepare("DELETE FROM buku WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: dashboard.php");
exit;
?>