<?php
include 'auth.php';
include 'koneksi.php';

adminOnly();

if(isset($_POST['simpan'])){

    $nama = htmlspecialchars($_POST['nama']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $harga = $_POST['harga'];
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $stok = $_POST['stok'];

    $query = mysqli_query($conn,"INSERT INTO menu VALUES(
    NULL,
    '$nama',
    '$kategori',
    '$harga',
    '$deskripsi',
    '$stok')");

    if($query){

        echo "<script>
        alert('Menu berhasil ditambahkan');
        window.location='dashboard.php';
        </script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Menu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-orange-500 via-orange-300 to-yellow-100 overflow-y-auto">

<div class="absolute top-0 left-0 w-80 h-80 bg-white/20 rounded-full blur-3xl"></div>
<div class="absolute bottom-0 right-0 w-96 h-96 bg-orange-900/10 rounded-full blur-3xl"></div>

<div class="flex justify-center items-center min-h-screen relative z-10 p-6">

    <div class="bg-white/30 backdrop-blur-2xl rounded-[40px] shadow-2xl overflow-hidden max-w-3xl w-full border border-white/40">

        <div class="bg-gradient-to-r from-orange-500 to-orange-700 p-10 text-white text-center relative overflow-hidden">

            <div class="absolute -top-10 -right-10 w-52 h-52 bg-white/10 rounded-full"></div>

            <div class="w-24 h-24 bg-white text-orange-500 rounded-3xl flex items-center justify-center text-5xl mx-auto shadow-2xl mb-5 relative z-10">
                🍔
            </div>

            <h1 class="text-5xl font-black relative z-10">
                Tambah Menu
            </h1>

            <p class="mt-3 text-orange-100 text-lg relative z-10">
                Tambahkan menu cafe baru ke dashboard
            </p>

        </div>

        <div class="bg-white p-10">

            <form method="POST" class="space-y-6">

                <div>
                    <label class="font-bold text-gray-700">Nama Menu</label>
                    <input type="text"
                    name="nama"
                    placeholder="Contoh: Cappuccino"
                    class="w-full mt-2 bg-orange-50 border-2 border-orange-100 focus:border-orange-500 outline-none p-4 rounded-2xl"
                    required>
                </div>

                <div>
                    <label class="font-bold text-gray-700">Kategori</label>
                    <input type="text"
                    name="kategori"
                    placeholder="Contoh: Minuman"
                    class="w-full mt-2 bg-orange-50 border-2 border-orange-100 focus:border-orange-500 outline-none p-4 rounded-2xl"
                    required>
                </div>

                <div>
                    <label class="font-bold text-gray-700">Harga</label>
                    <input type="number"
                    name="harga"
                    placeholder="Masukkan harga"
                    class="w-full mt-2 bg-orange-50 border-2 border-orange-100 focus:border-orange-500 outline-none p-4 rounded-2xl"
                    required>
                </div>

                <div>
                    <label class="font-bold text-gray-700">Deskripsi</label>
                    <textarea
                    name="deskripsi"
                    placeholder="Deskripsi menu"
                    class="w-full mt-2 bg-orange-50 border-2 border-orange-100 focus:border-orange-500 outline-none p-4 rounded-2xl h-32"
                    required></textarea>
                </div>

                <div>
                    <label class="font-bold text-gray-700">Stok</label>
                    <input type="number"
                    name="stok"
                    placeholder="Jumlah stok"
                    class="w-full mt-2 bg-orange-50 border-2 border-orange-100 focus:border-orange-500 outline-none p-4 rounded-2xl"
                    required>
                </div>

                <button type="submit"
                name="simpan"
                class="w-full bg-gradient-to-r from-orange-500 to-orange-700 hover:scale-105 duration-300 text-white font-black p-4 rounded-2xl shadow-2xl text-lg">
                    Simpan Menu
                </button>

            </form>

            <a href="dashboard.php"
            class="block text-center mt-6 text-orange-500 font-bold hover:underline">
                ← Kembali ke Dashboard
            </a>

        </div>

    </div>

</div>

</body>
</html>