<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

$query = "SELECT * FROM buku";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">
    <div class="bg-white p-6 rounded-xl shadow">
        <div class="flex justify-between mb-6">
            <h1 class="text-3xl font-bold">Data Buku</h1>
            <?php if ($_SESSION['role'] == 'admin') { ?>
            <a href="tambah_buku.php"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah Buku</a>
            <?php } ?>
        </div>
        <table class="w-full border">
            <tr>
                <th class="p-3 border">No</th>
                <th class="p-3 border">Judul</th>
                <th class="p-3 border">Penulis</th>
                <th class="p-3 border">Penerbit</th>
                <th class="p-3 border">Tahun</th>
                <th class="p-3 border">Stok</th>
                <th class="p-3 border">Aksi</th>
            </tr>
            <?php
                $no = 1;
                while ($data = mysqli_fetch_assoc($result)) {
                ?>
            <tr>
                <td class="p-3 border"> <?= $no++ ?></td>
                <td class="p-3 border"> <?= $data['judul'] ?></td>
                <td class="p-3 border"> <?= $data['penulis'] ?></td>
                <td class="p-3 border"> <?= $data['penerbit'] ?></td>
                <td class="p-3 border"> <?= $data['tahun_terbit'] ?></td>
                <td class="p-3 border"> <?= $data['stok'] ?></td>
                <td class="p-3 border">
                    <?php if ($_SESSION['role'] == 'admin') { ?>
                    <a href="edit_buku.php?id=<?= $data['id']; ?>" class="bg-yellow-500 text-white px-3 py-1 rounded"> Edit </a>
                    <a href="hapus_buku.php?id=<?= $data['id']; ?>" class="bg-red-500 text-white px-3 py-1 rounded ml-2"
                        onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini ?')"> Hapus </a>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>