<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Perpustakaan</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-700 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">

            <h1 class="text-2xl font-bold">
                Sistem Perpustakaan
            </h1>

            <div class="flex gap-4">
                <a href="login.php"
                   class="bg-green-500 px-4 py-2 rounded-lg font-semibold hover:bg-green-600 transition">
                    Login
                </a>

                <a href="registrasi.php"
                   class="bg-yellow-400 text-black px-4 py-2 rounded-lg font-semibold hover:bg-yellow-500 transition">
                    Registrasi
                </a>

            </div>

        </div>
    </nav>

    <!-- Hero Section -->
    <section class="container mx-auto px-6 py-16">

        <div class="bg-white rounded-2xl shadow-lg p-10 flex flex-col md:flex-row items-center gap-10">

            <div class="flex-1">

                <h2 class="text-4xl font-bold text-blue-700 mb-4">
                    Selamat Datang di Sistem Informasi Perpustakaan
                </h2>

                <p class="text-gray-600 text-lg leading-relaxed mb-8">
                    Website ini digunakan untuk mengelola data buku dan
                    peminjaman perpustakaan secara mudah dan efisien.
                </p>

                <div class="flex flex-wrap gap-4">

                    <a href="login.php"
                       class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-xl transition">
                        Login
                    </a>

                    <a href="registrasi.php"
                       class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl transition">
                        Registrasi
                    </a>

                </div>

            </div>

            <div class="flex-1">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png"
                     alt="Perpustakaan"
                     class="w-full max-w-md mx-auto">
            </div>

        </div>

    </section>

    <footer class="bg-blue-700 text-white text-center py-4">
        <p>
            © 2026 Sistem Informasi Perpustakaan
        </p>
    </footer>

</body>
</html>