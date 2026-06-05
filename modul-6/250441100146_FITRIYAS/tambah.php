<?php
include 'auth.php';
include 'koneksi.php';
wajib_admin();

if(isset($_POST['simpan'])) {

    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = (int)$_POST['tahun'];
    $stok = (int)$_POST['stok'];

    $stmt = $conn->prepare(
    "INSERT INTO buku(judul,penulis,penerbit,tahun_terbit,stok)
    VALUES(?,?,?,?,?)"
    );

    $stmt->bind_param(
    "sssii",
    $judul,
    $penulis,
    $penerbit,
    $tahun,
    $stok
    );

    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

<form method="POST" class="bg-white p-6 rounded shadow w-96 mx-auto">

    <h2 class="text-2xl font-bold mb-4">Tambah Buku</h2>

    <input type="text" name="judul" placeholder="Judul"
    class="w-full border p-2 mb-3" required>

    <input type="text" name="penulis" placeholder="Penulis"
    class="w-full border p-2 mb-3" required>

    <input type="text" name="penerbit" placeholder="Penerbit"
    class="w-full border p-2 mb-3" required>

    <input type="number" name="tahun" placeholder="Tahun"
    class="w-full border p-2 mb-3" required>

    <input type="number" name="stok" placeholder="Stok"
    class="w-full border p-2 mb-3" required>

    <button type="submit" name="simpan"
    class="bg-blue-500 text-white px-4 py-2 rounded w-full">
        Simpan
    </button>

</form>

</body>
</html>