<?php
session_start();
include '../koneksi.php';
include '../checklogin.php';

// CEK ROLE
if ($_SESSION['role'] != 'user') {
    header("Location: ../login.php");
    exit;
}

// USER LOGIN
$idUser = $_SESSION['id_user'];

// CEK PARAMETER ID
if (!isset($_GET['id'])) {
    header("Location: bookings.php");
    exit;
}

$idBooking = $_GET['id'];

// CEK DATA BOOKING
$stmt = $conn->prepare("
    SELECT *
    FROM bookings
    WHERE id=? AND user_id=?
");

$stmt->execute([
    $idBooking,
    $idUser
]);

$data = $stmt->fetch(PDO::FETCH_ASSOC);

// JIKA DATA TIDAK ADA
if (!$data) {
    header("Location: bookings.php");
    exit;
}

// JIKA STATUS SUDAH DIPROSES ADMIN
if (
    $data['status'] == 'Diterima' ||
    $data['status'] == 'Ditolak' ||
    $data['status'] == 'Selesai'
) {
    header("Location: bookings.php?pesan=gagalhapus");
    exit;
}

// HAPUS BOOKING
$hapus = $conn->prepare("
    DELETE FROM bookings
    WHERE id=? AND user_id=?
");

$hapus->execute([
    $idBooking,
    $idUser
]);

header("Location: bookings.php?pesan=berhasilhapus");
exit;
?>