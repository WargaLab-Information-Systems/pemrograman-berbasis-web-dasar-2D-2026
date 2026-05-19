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

<body class="bg-slate-950">

    <?php
    include "partials/header.php";
    ?>

    <section id="course">
        <div class="flex flex-col md:flex-row shadow-xl py-10">
            <div class="w-full">
                <div class="text-center">
                    <h2 class="text-2xl font-bold md:text-5xl text-white">LIST KONSER TERSEDIA</h2>
                </div>
                <div class="flex flex-col justify-center my-10 mx-15">
                    <div class="flex flex-wrap w-full justify-center gap-3">
                        <?php
                        $sql = "SELECT * FROM concerts";
                        $stmt = $conn->query($sql);
                        $stmt->execute();
                        $concerts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php foreach ($concerts as $concert): ?>
                            <div class="flex items-center gap-2 w-70 bg-white p-4 rounded-xl shadow-xl">
                                <div class="grid text-wrap">
                                    <img src="database/img/<?php echo htmlspecialchars($concert['poster']); ?>" alt="konser">
                                    <h3 class="text-xl font-bold my-3"><?php echo htmlspecialchars($concert['nama_konser']); ?></h3>
                                    <div class="w-full h-0.5 bg-gray-400 mb-4"></div>
                                    <div class="flex gap-2 mb-3">
                                        <p>Artis : <?php echo htmlspecialchars($concert['artis']); ?></p>
                                    </div>
                                    <div class="flex gap-2 mb-3">
                                        <p>📍: <?php echo htmlspecialchars($concert['lokasi']); ?></p>
                                    </div>
                                    <div class="flex gap-2 mb-3">
                                        <p>Harga Tiket : <?php echo "Rp" . number_format($concert['harga']); ?></p>
                                    </div>
                                    <div class="flex gap-2 mb-3">
                                        <p>Waktu Event : <?php echo htmlspecialchars($concert['tanggal']); ?></p>
                                    </div>
                                    <div class="w-full h-0.5 bg-gray-400 mb-4"></div>
                                    <div class="flex gap-2">
                                        <a href="https://wa.me/+6285846951117" target="_blank" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Beli Tiket
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
</body>

</html>