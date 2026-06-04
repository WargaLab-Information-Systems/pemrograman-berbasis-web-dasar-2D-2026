<?php

include 'auth.php';
include 'koneksi.php';

if (isset($_POST['simpan'])) {

    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $user_id = $_SESSION['user']['id'];

    $stmt = $conn->prepare(
        "INSERT INTO makanan
        (nama_makanan,kategori,harga,stok,deskripsi,user_id)
        VALUES(?,?,?,?,?,?)"
    );

    $stmt->bind_param(
        "ssdisi",
        $nama,
        $kategori,
        $harga,
        $stok,
        $deskripsi,
        $user_id
    );

    $stmt->execute();

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Tambah Makanan</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gradient-to-br from-pink-100 to-rose-200">

<div class="flex justify-center items-center min-h-screen">

<div class="bg-white/70 backdrop-blur-lg p-10 rounded-3xl shadow-2xl w-full max-w-lg">

<h2 class="text-3xl font-bold mb-5 text-center text-pink-500">

Tambah Makanan

</h2>

<form method="POST">

<input
type="text"
name="nama"
placeholder="Nama Makanan"
required
class="w-full border border-pink-200 p-3 rounded-xl mb-4 bg-pink-50 focus:outline-none focus:ring-4 focus:ring-pink-300"
>

<input
type="text"
name="kategori"
placeholder="Kategori"
required
class="w-full border border-pink-200 p-3 rounded-xl mb-4 bg-pink-50 focus:outline-none focus:ring-4 focus:ring-pink-300"
>

<input
type="number"
name="harga"
placeholder="Harga"
required
min="0"
class="w-full border border-pink-200 p-3 rounded-xl mb-4 bg-pink-50 focus:outline-none focus:ring-4 focus:ring-pink-300"
>

<input
type="number"
name="stok"
placeholder="Stok"
required
min="0"
class="w-full border border-pink-200 p-3 rounded-xl mb-4 bg-pink-50 focus:outline-none focus:ring-4 focus:ring-pink-300"
>

<textarea
name="deskripsi"
placeholder="Deskripsi"
class="w-full border border-pink-200 p-3 rounded-xl mb-4 bg-pink-50 focus:outline-none focus:ring-4 focus:ring-pink-300"></textarea>

<button
type="submit"
name="simpan"
class="w-1/2 bg-pink-500 hover:bg-pink-700 text-white p-3 rounded-xl transition duration-300 hover:scale-105">

Simpan

</button>

</form>

</div>
</div>

</body>
</html>