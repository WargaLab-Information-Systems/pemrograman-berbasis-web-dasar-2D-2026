<?php
session_start();
include '../koneksi.php';
include '../checklogin.php';

// CEK ROLE
if ($_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

// AMBIL USER LOGIN
$idUser = $_SESSION['id_user'];

// CEK PARAMETER ID
if (!isset($_GET['id'])) {

    header("Location: cats.php");
    exit;

}

$idKucing = $_GET['id'];

// CEK DATA KUCING
$stmt = $conn->prepare("
    SELECT *
    FROM cats
    WHERE id=? AND user_id=?
");

$stmt->execute([$idKucing, $idUser]);

$kucing = $stmt->fetch(PDO::FETCH_ASSOC);

// JIKA TIDAK ADA
if (!$kucing) {

    header("Location: cats.php");
    exit;

}

// HAPUS DATA BOOKING TERKAIT
$hapusBooking = $conn->prepare("
    DELETE FROM bookings
    WHERE cat_id=? AND user_id=?
");

$hapusBooking->execute([$idKucing, $idUser]);

// HAPUS DATA KUCING
$hapusKucing = $conn->prepare("
    DELETE FROM cats
    WHERE id=? AND user_id=?
");

$hapusKucing->execute([$idKucing, $idUser]);

header("Location: cats.php");
exit;
?>