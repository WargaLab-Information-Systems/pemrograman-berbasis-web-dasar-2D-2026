<?php

include 'koneksi.php';

if(isset($_POST['pesan'])){

    $nama = $_POST['nama'];
    $menu = $_POST['menu'];
    $jumlah = $_POST['jumlah'];

    $stmt = $conn->prepare(
    "INSERT INTO pesanan(nama,menu,jumlah)
    VALUES (?,?,?)"
    );

    $stmt->bind_param(
        "ssi",
        $nama,
        $menu,
        $jumlah
    );

    $stmt->execute();

    $sukses = "Pesanan berhasil";

}

?>

<!DOCTYPE html>
<html>
<head>

<title>Pesanan</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-orange-100 py-10">

<div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg">

<h2 class="text-3xl font-bold text-center text-orange-500 mb-6">
Pesan Mie Ayam
</h2>

<?php if(isset($sukses)) : ?>

<p class="text-green-500 text-center mb-4">
<?= $sukses; ?>
</p>

<?php endif; ?>

<form method="POST">

<input
type="text"
name="nama"
placeholder="Nama"
required
class="w-full border p-2 rounded mb-4"
>

<select
name="menu"
class="w-full border p-2 rounded mb-4"
>

<option>Mie Ayam Biasa</option>
<option>Mie Ayam Bakso</option>
<option>Mie Ayam Ceker</option>

</select>

<input
type="number"
name="jumlah"
placeholder="Jumlah"
required
class="w-full border p-2 rounded mb-4"
>

<div class="flex gap-4">

<button
type="submit"
name="pesan"
class="w-full bg-orange-500 hover:bg-orange-600 text-white p-2 rounded"
>
Pesan
</button>

<a
href="utama.php"
class="w-full bg-gray-500 hover:bg-gray-600 text-white p-2 rounded text-center"
>
Kembali
</a>

</div>

</form>

</div>

</body>
</html>