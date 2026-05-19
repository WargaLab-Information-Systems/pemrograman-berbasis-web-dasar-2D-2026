<?php
session_start();
if (is_null($_SESSION["login"])) {
    header("Location: auth/login.php");
    exit;
}
include_once("database/koneksi.php");

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tiket Konser</title>
    <link rel="stylesheet" href="src/output.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body class="">

    <?php
    include "partials/header.php";
    ?>

    <section class="relative bg-slate-950 text-white overflow-hidden">
        <div class="relative max-w-7xl mx-auto px-6 py-14 flex flex-col lg:flex-row items-center justify-between gap-10">
            <div class="max-w-2xl">
                <h1 class="text-5xl font-extrabold leading-tight mb-6">
                    Rasakan Pengalaman
                    <span class="text-purple-400">Konser Terbaik</span>
                    Tanpa Ribet
                </h1>
                <p class="text-gray-300 text-lg mb-8 leading-relaxed">
                    Temukan konser favoritmu, pesan tiket dengan mudah,
                    dan nikmati pengalaman event modern hanya dalam satu platform.
                </p>
                <div class="flex gap-4">
                    <a href="#concert"
                        class="bg-purple-500 hover:bg-purple-600 transition px-6 py-3 rounded-xl font-semibold shadow-lg">
                        Pesan Sekarang!
                    </a>
                </div>
            </div>

            <?php 
            $stmt = $conn->query("SELECT id, poster FROM concerts ORDER BY RAND() LIMIT 3");
            $randomId = $stmt->fetchColumn();
            $stmt->execute();
            $concerts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="relative w-125 h-162.5 overflow-hidden rounded-3xl">
                <div id="slides" class="flex transition-transform duration-700 ease-in-out">
                    <?php foreach($concerts as $concert): ?>
                    <img src="database/img/<?php echo htmlspecialchars($concert['poster']); ?>"
                        class="w-125 h-162.5 object-cover shrink-0"
                        alt="concert img">
                    <?php endforeach; ?>
                </div>
                <div class="absolute inset-0 bg-linear-to-t from-black/70 to-transparent"></div>
                <div class="absolute bottom-6 left-6 z-10">
                    <h2 class="text-3xl font-bold text-white">
                        Konser Tersedia
                    </h2>
                    <p class="text-gray-300">
                        Temukan konser favoritmu, pesan tiket dengan mudah,
                    </p>
                </div>

                <div class="absolute bottom-5 right-5 flex gap-2 z-10">
                    <span class="w-3 h-3 bg-white rounded-full"></span>
                    <span class="w-3 h-3 bg-gray-400 rounded-full"></span>
                    <span class="w-3 h-3 bg-gray-400 rounded-full"></span>
                </div>

            </div>

            <script>
                const slides = document.getElementById("slides");

                let index = 0;
                const totalSlides = 3;

                setInterval(() => {
                    index++;

                    if (index >= totalSlides) {
                        index = 0;
                    }

                    slides.style.transform = `translateX(-${index * 500}px)`;
                }, 3000);
            </script>

    </section>


    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>