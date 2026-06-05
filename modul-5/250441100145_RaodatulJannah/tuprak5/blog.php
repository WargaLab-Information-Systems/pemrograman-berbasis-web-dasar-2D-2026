<?php
$artikel = [
    "html" => [
        "judul" => "Belajar HTML Pertama Kali",
        "tanggal" => "10 maret 2026",
        "isi" => "Awalnya bingung dengan tag HTML, tapi lama-lama mulai paham struktur dasar website.",
        "gambar" => "fro1.jpeg",
        "link" => "https://classroom.google.com/u/0/c/ODQ3NjE1OTM0MjM1/m/ODQ3OTY2MDA5OTQw/details"
    ],
    "error" => [
        "judul" => "mau ngoding, tapi bingung mulai dari mana",
        "tanggal" => "15 april 2026",
        "isi" => "Kadang yang paling sulit bukan menulis kode, tapi memulai.",
        "gambar" => "fto2.jpeg",
        "link" => "https://www.w3schools.com/"
    ],
    "project" => [
        "judul" => "Tugas Coding yang Bikin Overthinking",
        "tanggal" => "20 Maret 2024",
        "isi" => "Kadang tugas yang diberikan terlihat sederhana, tapi saat dikerjakan ternyata cukup membingungkan.",
        "gambar" => "image.png",
        "link" => "https://classroom.google.com/u/0/c/ODQ3NjE1OTM0MjM1"
    ]
];

$key = $_GET['artikel'] ?? null;
$dataDipilih = $artikel[$key] ?? null; 

$quotes = [
    "Coding itu bukan soal pintar, tapi soal tidak menyerah.",
    "Jangan tunggu siap, karena siap datang saat mencoba",
    "Setiap developer hebat pernah jadi pemula.",
    "Practice makes perfect!"
];

$quoteRandom = $quotes[array_rand($quotes)];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-pink-200 font-sans">

<div class="max-w-5xl mx-auto p-6">

    <h1 class="text-2xl font-bold text-center mb-6">
        Blog Reflektif Developer
    </h1>

    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-blue-200 p-4 rounded-xl shadow">
            <h2 class="font-bold mb-3">Daftar Artikel</h2>

            <?php foreach ($artikel as $key => $item): ?>
                <a href="?artikel=<?= $key ?>" 
                   class="block mb-2 text-pink-500 hover:underline">
                    • <?= $item['judul'] ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="md:col-span-2 bg-blue-200 p-5 rounded-xl shadow">

            <?php if ($dataDipilih): ?>

                <h2 class="text-xl font-bold mb-2">
                    <?= $dataDipilih['judul'] ?>
                </h2>

                <p class="text-sm text-gray-500 mb-3">
                     <?= $dataDipilih['tanggal'] ?>
                </p>

                <img src="<?= $dataDipilih['gambar'] ?>" 
                     class="rounded mb-3 w-full h-48 object-cover">

                <p class="mb-3">
                    <?= $dataDipilih['isi'] ?>
                </p>

                <!-- QUOTE -->
                <div class="bg-pink-100 p-3 rounded mb-3 italic">
                    "<?= $quoteRandom ?>"
                </div>

                <!-- LINK -->
                <a href="<?= $dataDipilih['link'] ?>" 
                   target="_blank"
                   class="text-blue-500 underline">
                   🔗 Referensi Belajar
                </a>

            <?php else: ?>
                <p class="text-gray-500">
                    Pilih artikel di sebelah kiri untuk melihat detail.
                </p>
            <?php endif; ?>

        </div>

    </div>

    <div class="mt-6 flex justify-between">

        <a href="timeline.php" 
           class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
            Kembali ke Timeline
        </a>

        <a href="index.php" 
           class="bg-pink-500 text-white px-8 py-2 rounded hover:bg-pink-600">
             Profil
        </a>

    </div>

</div>

</body>
</html>