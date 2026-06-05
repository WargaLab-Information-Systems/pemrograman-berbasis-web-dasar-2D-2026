<?php

include 'auth.php';
include 'koneksi.php';

$id = (int) $_GET['id'];

if ($_SESSION['user']['role'] != 'admin') {

    $cek = $conn->prepare(
        "SELECT * FROM makanan
        WHERE id=? AND user_id=?"
    );

    $cek->bind_param(
        "ii",
        $id,
        $_SESSION['user']['id']
    );

    $cek->execute();

    $hasil = $cek->get_result();

    if ($hasil->num_rows == 0) {
        die("Akses ditolak");
    }
}

$id = (int) $_GET['id'];

$stmt = $conn->prepare(
    "SELECT * FROM makanan WHERE id=?"
);

$stmt->bind_param("i", $id);

$stmt->execute();

$data = $stmt->get_result();

$row = $data->fetch_assoc();

if (isset($_POST['update'])) {

    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $update = $conn->prepare(
        "UPDATE makanan
        SET
        nama_makanan=?,
        kategori=?,
        harga=?,
        stok=?,
        deskripsi=?
        WHERE id=?"
    );

    $update->bind_param(
        "ssdisi",
        $nama,
        $kategori,
        $harga,
        $stok,
        $deskripsi,
        $id
    );

    $update->execute();

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Makanan</title>

<script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="bg-gradient-to-br from-pink-100 to-rose-200">

<div class="flex justify-center items-center min-h-screen">

<div class="bg-white/70 backdrop-blur-lg p-10 rounded-3xl shadow-2xl w-full max-w-lg">
<h2 class="text-3xl font-bold mb-5 text-center text-pink-500">
Edit Makanan
</h2>

<form method="POST">

<input
type="text"
name="nama"
value="<?= htmlspecialchars($row['nama_makanan']) ?>"
required
class="w-full border p-3 rounded-lg mb-4"
>

<input
type="text"
name="kategori"
value="<?= htmlspecialchars($row['kategori']) ?>"
required
class="w-full border p-3 rounded-lg mb-4"
>

<input
type="number"
name="harga"
value="<?= htmlspecialchars($row['harga']) ?>"
required
class="w-full border p-3 rounded-lg mb-4"
>

<input
type="number"
name="stok"
value="<?= htmlspecialchars($row['stok']) ?>"
required
class="w-full border p-3 rounded-lg mb-4"
>

<textarea
name="deskripsi"
class="w-full border p-3 rounded-lg mb-4"><?= htmlspecialchars($row['deskripsi']) ?></textarea>

<div class="flex gap-3">

<button
type="submit"
name="update"
class="w-1/2 bg-pink-500 hover:bg-pink-700 text-white p-3 rounded-xl transition duration-300 hover:scale-105">

Update

</button>

<a href="index.php"
class="w-1/2 bg-gray-300 hover:bg-gray-400 text-center text-gray-700 p-3 rounded-xl transition duration-300 hover:scale-105">

Batal

</a>

</div>
</form>

</div>
</div>

</body>
</html>