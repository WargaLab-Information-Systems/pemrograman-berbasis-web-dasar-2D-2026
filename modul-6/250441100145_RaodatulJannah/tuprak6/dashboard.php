<?php

include 'auth.php';
include 'koneksi.php';

$totalMenu = $conn->query(
    "SELECT COUNT(*) as total FROM makanan"
)->fetch_assoc();

$totalStok = $conn->query(
    "SELECT SUM(stok) as total FROM makanan"
)->fetch_assoc();

$totalUser = $conn->query(
    "SELECT COUNT(*) as total FROM users"
)->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard</title>

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-gradient-to-br from-pink-100 to-pink-200 min-h-screen">

<!-- Navbar -->
<nav class="bg-gradient-to-r from-pink-500 to-fuchsia-200 p-6 shadow-xl">
    
    <div class="max-w-7xl mx-auto flex justify-between items-center">

        <h1 class="text-4xl font-bold text-white tracking-wide">
            <i class="fa-solid fa-bowl-food text-pink-200 mr-2"></i>
            PINKY KITCHEN
        </h1>

        <a href="logout.php"
        class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-2xl shadow-lg transition duration-300">

            Logout

        </a>

    </div>

</nav>

<!-- Container -->
<div class="max-w-7xl mx-auto p-8">

    <!-- Welcome Card -->
    <div class="bg-white rounded-3xl shadow-2xl p-10 mb-10">

        <div class="flex flex-col md:flex-row justify-between items-center gap-8">

            <!-- Text -->
            <div>

                <h2 class="text-5xl font-bold text-pink-600 mb-4">
                    <i class="fa-solid fa-hand text-yellow-300 mr-2"></i>
                    Halo, 
                    <?= htmlspecialchars($_SESSION['user']['nama']) ?>

                </h2>

                <p class="text-xl text-gray-700 mb-3">
                    Role :
                    <span class="font-semibold text-pink-500">
                        <?= htmlspecialchars($_SESSION['user']['role']) ?>
                    </span>
                </p>

                <p class="text-gray-600 text-lg leading-relaxed max-w-2xl">

                    Selamat datang di sistem manajemen rumah makan
                    <span class="font-semibold text-pink-600">
                        Pinky Kitchen
                    </span> 

                    Kelola data makanan, stok, dan menu restoran
                    dengan mudah, cepat, dan menyenangkan.

                </p>

            </div>

            <!-- Emoji -->
            <div class="text-8xl">
               <i class="fa-solid fa-bowl-food text-yellow-200 mr-2"></i>
            </div>

        </div>

    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">

        <!-- Card 1 -->
        <div class="bg-yellow-100 rounded-3xl p-8 shadow-xl hover:scale-105 transition duration-300">

            <h3 class="text-2xl font-bold text-pink-500 mb-3">
                <i class="fa-solid fa-utensils text-orange-300 mr-2"></i>
                Total Menu
            </h3>

            <p class="text-5xl font-bold text-gray-800">
                <?= $totalMenu['total'] ?>
            </p>

        </div>

        <!-- Card 2 -->
        <div class="bg-pink-100 rounded-3xl p-8 shadow-xl hover:scale-105 transition duration-300">

            <h3 class="text-2xl font-bold text-pink-500 mb-3">
                <i class="fa-solid fa-box-open text-amber-700 mr-2"></i>
                Total Stok
            </h3>

            <p class="text-5xl font-bold text-gray-800">
                <?= $totalStok['total'] ?>
            </p>

        </div>

        <!-- Card 3 -->
        <div class="bg-sky-100 rounded-3xl p-8 shadow-xl hover:scale-105 transition duration-300">

            <h3 class="text-2xl font-bold text-pink-500 mb-3">
                <i class="fa-solid fa-user text-indigo-900 mr-2"></i>
                Pengguna
            </h3>

            <p class="text-5xl font-bold text-gray-800">
                <?= $totalUser['total'] ?>
            </p>

        </div>

    </div>

    <!-- Quick Menu -->
    <div class="flex justify-center mb-10">

        <!-- Kelola Data -->
        <a href="index.php"
        class="bg-pink-500 hover:bg-pink-600 text-white rounded-3xl p-8 shadow-xl transition duration-300 hover:scale-105 w-full max-w-2xl">

            <h3 class="text-3xl font-bold mb-4">
                <i class="fa-solid fa-clipboard-list text-pink-300 mr-2"></i>
                Kelola Data Makanan
            </h3>

            <p class="text-lg">

                Tambah, edit, dan hapus data makanan restoran.

            </p>

        </a>

    </div>

    <!-- Banner -->
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-10">

        <img
        src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?q=80&w=1200"
        class="w-full h-80 object-cover"
        >

        <div class="p-8">

            <h3 class="text-4xl font-bold text-pink-600 mb-4">
                <i class="fa-solid fa-clover text-pink-400 mr-2"></i>
                Happy Eating at Pinky Kitchen

            </h3>

            <p class="text-gray-700 text-lg leading-relaxed">

                Sajikan pengalaman terbaik untuk pelanggan dengan menu
                makanan yang lezat, pelayanan terbaik, dan pengelolaan
                data yang rapi 

            </p>

        </div>

    </div>

    <!-- Footer -->
    <footer class="text-center text-pink-700 text-lg pb-6">

        @ 2026 Pinky Kitchen 

    </footer>

</div>

</body>
</html>