<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $stok = $_POST['stok'];
    $query = "INSERT INTO buku(judul, penulis, penerbit, tahun_terbit, stok) VALUES ('$judul','$penulis','$penerbit','$tahun','$stok')";

    mysqli_query($conn, $query);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center min-h-screen">
        <div class="bg-white p-8 rounded-xl shadow-lg w-[500px]">
            <h1 class="text-3xl font-bold mb-6 text-center"> Tambah Buku </h1>
            <form method="POST">
                <input
                    type="text"
                    name="judul"
                    placeholder="Judul Buku"
                    class="w-full border p-3 rounded-lg mb-4"
                >

                <input
                    type="text"
                    name="penulis"
                    placeholder="Nama Penulis"
                    class="w-full border p-3 rounded-lg mb-4"
                >

                <input
                    type="text"
                    name="penerbit"
                    placeholder="Nama Penerbit"
                    class="w-full border p-3 rounded-lg mb-4"
                >

                <input
                    type="number"
                    name="tahun"
                    placeholder="Tahun Terbit"
                    class="w-full border p-3 rounded-lg mb-4"
                >

                <input
                    type="number"
                    name="stok"
                    placeholder="Stok Buku"
                    class="w-full border p-3 rounded-lg mb-4"
                >

                <button
                    type="submit"
                    name="tambah"
                    class="w-full bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600 transition" > Tambah Buku
                </button>
            </form>
        </div>
    </div>
</body>
</html>