<?php
include 'auth.php';
include 'koneksi.php';

if($_SESSION['role'] != 'user') {
    die("Hanya user yang bisa meminjam!");
}

if(!isset($_GET['id'])) {
    die("ID buku tidak ada!");
}

$id_buku = (int)$_GET['id'];
$id_user = $_SESSION['user_id'];

$cek = $conn->prepare(
"SELECT * FROM buku WHERE id=?"
);

$cek->bind_param("i", $id_buku);
$cek->execute();

$result = $cek->get_result();

if($result->num_rows == 0) {
    die("Buku tidak ditemukan!");
}

$buku = $result->fetch_assoc();

if($buku['stok'] <= 0) {
    die("Stok buku habis!");
}

$pinjam = $conn->prepare(
"INSERT INTO peminjaman
(id_user, id_buku, tanggal_pinjam, status)
VALUES(?,?,CURDATE(),'dipinjam')"
);


$pinjam->bind_param(
"ii",
$id_user,
$id_buku
);


$update = $conn->prepare(
"UPDATE buku
SET stok = stok - 1
WHERE id=?"
);

$update->bind_param(
"i",
$id_buku
);

$update->execute();

header("Location: dashboard.php");
exit;
?>