<?php

include 'auth.php';
include 'koneksi.php';

$cari = $_GET['cari'] ?? '';

$stmt = $conn->prepare(
    "SELECT * FROM makanan
    WHERE nama_makanan LIKE ?
    ORDER BY id DESC"
);

$keyword = "%$cari%";

$stmt->bind_param("s", $keyword);

$stmt->execute();

$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Data Makanan</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-gradient-to-br from-pink-100 to-rose-200 font-[Poppins] min-h-screen">

<!-- Navbar -->
<nav class="bg-gradient-to-r from-pink-500 to-fuchsia-500 shadow-xl p-5">

<div class="max-w-7xl mx-auto flex justify-between items-center">

<h1 class="text-3xl font-bold text-white">

<i class="fa-solid fa-bowl-food mr-2"></i>
Pinky Kitchen

</h1>

<div class="flex gap-3">

<a href="dashboard.php"
class="bg-white text-pink-500 px-5 py-2 rounded-xl font-semibold hover:bg-pink-100 transition duration-300">

Dashboard

</a>

<a href="logout.php"
class="bg-red-500 text-white px-5 py-2 rounded-xl hover:bg-red-600 transition duration-300">

Logout

</a>

</div>

</div>

</nav>

<div class="max-w-7xl mx-auto p-8">

<div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-5">

<div>

<h2 class="text-4xl font-bold text-pink-600 mb-2">

📋 Data Makanan

</h2>

</div>

<a href="tambah.php"
class="bg-pink-500 hover:bg-pink-700 text-white px-6 py-3 rounded-2xl shadow-xl transition duration-300 hover:scale-105">

<i class="fa-solid fa-plus mr-2"></i>
Tambah Menu

</a>

</div>

<!-- Search -->
<div class="mb-8">

<form method="GET">

<input
type="text"
name="cari"
value="<?= htmlspecialchars($cari) ?>"
placeholder="Cari makanan..."
class="w-full p-4 rounded-2xl border border-pink-200 focus:outline-none focus:ring-4 focus:ring-pink-300 shadow-lg"
>

<button
type="submit"
class="mt-3 bg-pink-500 text-white px-5 py-2 rounded-xl">

Cari

</button>

</form>

</div>

<?php if ($result->num_rows > 0): ?>

<!-- Table -->
<div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

<div class="overflow-x-auto">

<table class="w-full">

<thead class="bg-pink-500 text-white">

<tr>

<th class="p-5 text-left">No</th>
<th class="p-5 text-left">Nama Makanan</th>
<th class="p-5 text-left">Kategori</th>
<th class="p-5 text-left">Harga</th>
<th class="p-5 text-left">Stok</th>
<th class="p-5 text-left">Deskripsi</th>
<th class="p-5 text-center">Aksi</th>

</tr>

</thead>

<tbody>

<?php
$no = 1;

while($row = $result->fetch_assoc()):
?>

<tr class="border-b hover:bg-pink-50 transition duration-300">

<td class="p-5 font-semibold text-gray-700">

<?= $no++ ?>

</td>

<td class="p-5 font-semibold text-pink-600">

<?= htmlspecialchars($row['nama_makanan']) ?>

</td>

<td class="p-5">

<span class="bg-pink-100 text-pink-600 px-4 py-2 rounded-full text-sm font-semibold">

<?= htmlspecialchars($row['kategori']) ?>

</span>

</td>

<td class="p-5 font-semibold text-gray-700">

Rp <?= number_format($row['harga'],0,',','.') ?>

</td>

<td class="p-5">

<span class="bg-green-100 text-green-600 px-4 py-2 rounded-full font-semibold">

<?= htmlspecialchars($row['stok']) ?>

</span>

</td>

<td class="p-5 text-gray-600 max-w-xs">

<?= htmlspecialchars($row['deskripsi']) ?>

</td>

<td class="p-5">

<div class="flex justify-center gap-3">

<?php if ($_SESSION['user']['role'] == 'admin' || $_SESSION['user']['id'] == $row['user_id']): ?>

<a href="edit.php?id=<?= $row['id'] ?>"
class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl shadow-lg transition duration-300">

<i class="fa-solid fa-pen-to-square"></i>

</a>

<a href="hapus.php?id=<?= $row['id'] ?>"

onclick="return confirm('Yakin ingin hapus data ini?')"

class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl shadow-lg transition duration-300">

<i class="fa-solid fa-trash"></i>

</a>

<?php endif; ?>

</div>

</td>

</tr>

<?php endwhile; ?>

</tbody>

</table>

</div>

</div>

<?php else: ?>

<!-- Empty State -->
<div class="bg-white rounded-3xl shadow-2xl p-12 text-center">

<div class="text-8xl mb-5">
🍜
</div>

<h2 class="text-4xl font-bold text-pink-500 mb-3">

Belum Ada Menu

</h2>

<p class="text-gray-600 text-lg">

Silakan tambah menu makanan terlebih dahulu

</p>

</div>

<?php endif; ?>

<!-- Footer -->
<footer class="text-center text-pink-700 text-lg mt-10 pb-5">

© 2026 Pinky Kitchen • Made with 💖

</footer>

</div>

</body>
</html>