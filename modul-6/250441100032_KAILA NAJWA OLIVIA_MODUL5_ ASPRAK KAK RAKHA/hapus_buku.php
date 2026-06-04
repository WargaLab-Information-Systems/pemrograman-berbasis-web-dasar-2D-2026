<?php
include 'auth.php';
include 'koneksi.php';

if($_SESSION['role'] != 'admin'){
    die("Akses ditolak!");
}

$id = $_GET['id'];

$hapusPinjam = $conn->prepare("
    DELETE FROM peminjaman
    WHERE id_buku=?
");

$hapusPinjam->bind_param("i",$id);
$hapusPinjam->execute();

$hapusBuku = $conn->prepare("
    DELETE FROM buku
    WHERE id_buku=?
");

$hapusBuku->bind_param("i",$id);
$hapusBuku->execute();

header("Location: dashboard.php");
?>