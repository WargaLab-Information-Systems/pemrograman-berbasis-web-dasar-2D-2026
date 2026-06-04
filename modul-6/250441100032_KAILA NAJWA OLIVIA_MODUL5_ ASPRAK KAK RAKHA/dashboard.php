<?php
include 'auth.php';
include 'koneksi.php';

$data = $conn->query("SELECT * FROM buku");

?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="container mx-auto p-10">

<div class="flex justify-between mb-6">

<h1 class="text-3xl font-bold">
Dashboard Perpustakaan
</h1>

<div>
<span class="mr-4">
<?= htmlspecialchars($_SESSION['username']) ?>
(<?= htmlspecialchars($_SESSION['role']) ?>)
</span>

<a href="logout.php"
class="bg-red-500 text-white px-4 py-2 rounded">
Logout
</a>
</div>

</div>

<?php if($_SESSION['role'] == 'admin') : ?>

<a href="tambah_buku.php"
class="bg-green-500 text-white px-4 py-2 rounded">
Tambah Buku
</a>

<?php endif; ?>

<table class="w-full mt-6 bg-white shadow rounded">

<tr class="bg-blue-500 text-white">
<th class="p-3">Judul</th>
<th>Penulis</th>
<th>Penerbit</th>
<th>Tahun</th>
<th>Stok</th>

<?php if($_SESSION['role'] == 'admin') : ?>
<th>Aksi</th>
<?php endif; ?>

</tr>

<?php while($row = $data->fetch_assoc()) : ?>

<tr class="text-center border-b">

<td class="p-3">
<?= htmlspecialchars($row['judul_buku']) ?>
</td>

<td><?= htmlspecialchars($row['penulis']) ?></td>
<td><?= htmlspecialchars($row['penerbit']) ?></td>
<td><?= htmlspecialchars($row['tahun_terbit']) ?></td>
<td>
<?php
$cek = $conn->prepare("SELECT * FROM peminjaman WHERE id_buku=? AND status='dipinjam'");
$cek->bind_param("i", $row['id_buku']);
$cek->execute();
$hasil = $cek->get_result();

if($hasil->num_rows > 0){
    echo "<span class='text-red-500 font-bold'>Dipinjam</span>";
} else {
    echo "<span class='text-green-500 font-bold'>Tersedia</span>";
}
?>
</td>
<?php if($_SESSION['role'] == 'user') : ?>

<td>

<?php
$cek = $conn->prepare("SELECT * FROM peminjaman WHERE id_buku=? AND status='dipinjam'");
$cek->bind_param("i", $row['id_buku']);
$cek->execute();
$hasil = $cek->get_result();

if($hasil->num_rows == 0) :
?>

<a href="pinjam_buku.php?id=<?= $row['id_buku'] ?>"
class="bg-blue-500 text-white px-3 py-1 rounded">
Pinjam
</a>

<?php else : ?>

<button class="bg-gray-400 text-white px-3 py-1 rounded">
Sudah Dipinjam
</button>

<?php endif; ?>

</td>

<?php endif; ?>

<?php if($_SESSION['role'] == 'admin') : ?>

<td>

<a href="edit_buku.php?id=<?= $row['id_buku'] ?>"
class="bg-yellow-400 px-3 py-1 rounded text-white">

Edit

</a>

<a href="hapus_buku.php?id=<?= $row['id_buku'] ?>"
class="bg-red-500 px-3 py-1 rounded text-white"
onclick="return confirm('Hapus data?')">

Hapus

</a>

</td>

<?php endif; ?>

</tr>

<?php endwhile; ?>

</table>

</div>

</body>
</html>