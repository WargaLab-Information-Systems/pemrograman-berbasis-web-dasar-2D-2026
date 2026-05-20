<?php
include 'auth.php';
include 'koneksi.php';

adminOnly();

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM menu WHERE id_menu='$id'");
$row = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nama = htmlspecialchars($_POST['nama']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $harga = $_POST['harga'];
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $stok = $_POST['stok'];

    $update = mysqli_query($conn,"UPDATE menu SET
    nama_menu='$nama',
    kategori='$kategori',
    harga='$harga',
    deskripsi='$deskripsi',
    stok='$stok'
    WHERE id_menu='$id'");

    if($update){

        echo "<script>
        alert('Menu berhasil diupdate');
        window.location='dashboard.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-orange-100 m-h-screen overlow-y-auto">

<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded-2xl shadow-2xl">

    <h1 class="text-3xl font-bold text-orange-500 mb-6 text-center">
        Edit Menu
    </h1>

    <form method="POST">

        <input type="text" name="nama"
        value="<?= $row['nama_menu']; ?>"
        class="w-full border p-3 rounded-xl mb-4" required>

        <input type="text" name="kategori"
        value="<?= $row['kategori']; ?>"
        class="w-full border p-3 rounded-xl mb-4" required>

        <input type="number" name="harga"
        value="<?= $row['harga']; ?>"
        class="w-full border p-3 rounded-xl mb-4" required>

        <textarea name="deskripsi"
        class="w-full border p-3 rounded-xl mb-4" required><?= $row['deskripsi']; ?></textarea>

        <input type="number" name="stok"
        value="<?= $row['stok']; ?>"
        class="w-full border p-3 rounded-xl mb-4" required>

        <button type="submit" name="update"
        class="w-full bg-yellow-400 hover:bg-yellow-500 text-white p-3 rounded-xl">
            Update Menu
        </button>

    </form>

</div>

</body>
</html>