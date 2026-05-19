<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../auth/login.php");
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM buku WHERE id='$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (isset($_POST['edit'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];
    $update = "UPDATE buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun_terbit='$tahun', stok='$stok' WHERE id='$id'";

    mysqli_query($conn, $update);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<div class="flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-xl shadow-lg w-[500px]">
        <h1 class="text-3xl font-bold text-center mb-6">Edit Buku</h1>
        <form method="POST">
            <input
                type="text"
                name="judul"
                value="<?= $data['judul']; ?>"
                class="w-full border p-3 rounded-lg mb-4">
            <input
                type="text"
                name="penulis"
                value="<?= $data['penulis']; ?>"
                class="w-full border p-3 rounded-lg mb-4">
            <input
                type="text"
                name="penerbit"
                value="<?= $data['penerbit']; ?>"
                class="w-full border p-3 rounded-lg mb-4">
            <input
                type="number"
                name="tahun"
                value="<?= $data['tahun_terbit']; ?>"
                class="w-full border p-3 rounded-lg mb-4">
            <input
                type="number"
                name="stok"
                value="<?= $data['stok']; ?>"
                class="w-full border p-3 rounded-lg mb-4">
            <button
                type="submit"
                name="edit"
                class="w-full bg-yellow-500 text-white p-3 rounded-lg hover:bg-yellow-600 transition">
                Update Buku
            </button>
        </form>
    </div>
</div>
</body>
</html>