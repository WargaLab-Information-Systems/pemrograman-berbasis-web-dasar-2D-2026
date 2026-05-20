<?php
include 'auth.php';
include 'koneksi.php';

$data = mysqli_query($conn,"SELECT * FROM menu");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Cafe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-orange-100 via-white to-orange-200 min-h-screen overlow-y-auto">

<div class="flex">

    <div class="w-72 bg-orange-500 min-h-screen text-white shadow-2xl p-6">

        <h1 class="text-4xl font-extrabold mb-10 text-center tracking-wide">
            ☕ Cafe App
        </h1>

        <div class="bg-white/20 rounded-2xl p-4 mb-8 backdrop-blur-md">
            <p class="text-sm opacity-80">Login sebagai</p>
            <h2 class="text-2xl font-bold mt-1">
                <?= $_SESSION['username']; ?>
            </h2>
            <p class="mt-1 capitalize bg-white text-orange-500 inline-block px-3 py-1 rounded-full text-sm font-semibold">
                <?= $_SESSION['role']; ?>
            </p>
        </div>

        <div class="space-y-4">

            <a href="dashboard.php"
            class="block bg-white text-orange-500 p-4 rounded-2xl font-bold hover:scale-105 duration-300 shadow-lg">
                🏠 Dashboard
            </a>

            <a href="pesanan.php"
            class="block bg-white/20 hover:bg-white hover:text-orange-500 p-4 rounded-2xl font-bold duration-300">
                🛒 Pesanan
            </a>

            <?php if($_SESSION['role'] == 'admin'){ ?>

            <a href="tambah_menu.php"
            class="block bg-white/20 hover:bg-white hover:text-orange-500 p-4 rounded-2xl font-bold duration-300">
                ➕ Tambah Menu
            </a>

            <a href="tambah_menu.php"
            class="block bg-white/20 hover:bg-white hover:text-orange-500 p-4 rounded-2xl font-bold duration-300">
                ** layanan
            </a>

            <?php } ?>

            <a href="logout.php"
            class="block bg-red-500 hover:bg-red-600 p-4 rounded-2xl font-bold duration-300 text-center mt-10 shadow-lg">
                Logout
            </a>

        </div>

    </div>

    <div class="flex-1 p-8">

        <div class="bg-white rounded-3xl shadow-2xl p-8 mb-8 flex justify-between items-center">

            <div>
                <h1 class="text-5xl font-extrabold text-orange-500 mb-2">
                    Dashboard Cafe
                </h1>

                <p class="text-gray-500 text-lg">
                    Kelola menu dan pesanan cafe dengan mudah 
                </p>
            </div>

            <img src="https://cdn-icons-png.flaticon.com/512/924/924514.png"
            class="w-28 h-28">

        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white rounded-3xl shadow-xl p-6 hover:scale-105 duration-300">
                <h2 class="text-gray-500 text-lg">Total Menu</h2>
                <p class="text-5xl font-extrabold text-orange-500 mt-3">
                    <?= mysqli_num_rows($data); ?>
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-xl p-6 hover:scale-105 duration-300">
                <h2 class="text-gray-500 text-lg">Status</h2>
                <p class="text-3xl font-bold text-green-500 mt-4">
                    Aktif
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-xl p-6 hover:scale-105 duration-300">
                <h2 class="text-gray-500 text-lg">Role</h2>
                <p class="text-3xl font-bold text-blue-500 mt-4 capitalize">
                    <?= $_SESSION['role']; ?>
                </p>
            </div>

        </div>

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">

            <div class="bg-orange-500 p-6 text-white">
                <h2 class="text-3xl font-bold">
                    Data Menu Cafe
                </h2>
            </div>

            <div class="overflow-x-auto">

            <table class="w-full">

                <tr class="bg-orange-100 text-orange-700 text-center">
                    <th class="p-5">No</th>
                    <th class="p-5">Nama Menu</th>
                    <th class="p-5">Kategori</th>
                    <th class="p-5">Harga</th>
                    <th class="p-5">Deskripsi</th>
                    <th class="p-5">Stok</th>

                    <?php if($_SESSION['role'] == 'admin'){ ?>
                    <th class="p-5">Aksi</th>
                    <?php } ?>
                </tr>

                <?php
                $no = 1;
                mysqli_data_seek($data,0);
                while($row = mysqli_fetch_assoc($data)){
                ?>

                <tr class="border-b hover:bg-orange-50 text-center duration-300">

                    <td class="p-5 font-bold"><?= $no++; ?></td>
                    <td class="p-5 font-semibold"><?= htmlspecialchars($row['nama_menu']); ?></td>
                    <td class="p-5"><?= htmlspecialchars($row['kategori']); ?></td>
                    <td class="p-5 text-green-600 font-bold">
                        Rp <?= number_format($row['harga']); ?>
                    </td>
                    <td class="p-5"><?= htmlspecialchars($row['deskripsi']); ?></td>
                    <td class="p-5">
                        <span class="bg-orange-500 text-white px-4 py-2 rounded-full">
                            <?= $row['stok']; ?>
                        </span>
                    </td>

                    <?php if($_SESSION['role'] == 'admin'){ ?>

                    <td class="p-5 space-x-2">

                        <a href="edit_menu.php?id=<?= $row['id_menu']; ?>"
                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-xl shadow-lg duration-300">
                            Edit
                        </a>

                        <a href="hapus_menu.php?id=<?= $row['id_menu']; ?>"
                        onclick="return confirm('Yakin hapus menu?')"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl shadow-lg duration-300">
                            Hapus
                        </a>

                    </td>

                    <?php } ?>

                </tr>

                <?php } ?>

            </table>

            </div>

        </div>

    </div>

</div>

</body>
</html>