<?php
$artikel = [
    "html" => [
        "judul" => "Belajar HTML Pertama Kali",
        "tanggal" => "10 Januari 2023",
        "isi" => "Saat pertama belajar HTML, saya mulai memahami struktur dasar website seperti heading, paragraf, dan link.",
        "gambar" => "img/html.jpg",
        "link" => "https://developer.mozilla.org/id/docs/Web/HTML"
    ],
    "error" => [
        "judul" => "Error Pertama",
        "tanggal" => "15 Februari 2023",
        "isi" => "Mengalami error pertama membuat saya belajar membaca pesan error dan mencari solusi di internet.",
        "gambar" => "img/error.png",
        "link" => "https://stackoverflow.com"
    ],
    "php" => [
        "judul" => "Belajar PHP",
        "tanggal" => "20 Maret 2024",
        "isi" => "Belajar PHP membuka wawasan tentang backend dan bagaimana data diproses di server.",
        "gambar" => "img/php.png",
        "link" => "https://www.php.net"
    ]
];


$key = $_GET['artikel'] ?? null;


$kutipan = [
    "Coding itu bukan soal pintar, tapi soal konsisten.",
    "Error adalah guru terbaik programmer.",
    "Terus mencoba sampai berhasil.",
    "Belajar coding = belajar sabar.",
    "Sedikit demi sedikit lama-lama jadi pro."
];

$quote = $kutipan[array_rand($kutipan)];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-4 text-center">Blog Reflektif Developer</h2>

    <div class="mb-6 flex gap-3 flex-wrap">
        <?php foreach ($artikel as $kunci => $arrayy): ?>
            <a href="?artikel=<?= $kunci; ?>" 
               class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                <?= $arrayy['judul']; ?>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if ($key && isset($artikel[$key])): 
        $data = $artikel[$key];
    ?>
        <div class="mb-6">
            <h3 class="text-xl font-bold"><?= $data['judul']; ?></h3>
            <p class="text-sm text-gray-500"><?= $data['tanggal']; ?></p>

            <img src="<?= $data['gambar']; ?>" 
                 class="mt-3 mb-3 rounded-lg w-full max-h-64 object-cover">

            <p class="text-gray-700"><?= $data['isi']; ?></p>

            <a href="<?= $data['link']; ?>" target="_blank" 
               class="text-blue-500 underline">
               Referensi Tambahan
            </a>
        </div>

    <?php else: ?>
        <p class="text-gray-500">Silakan pilih artikel di atas.</p>
    <?php endif; ?>

    <div class="bg-yellow-100 p-4 rounded-lg italic text-center">
        "<?= $quote; ?>"
    </div>

    <div class="mt-6 flex justify-between">
        <a href="timeline.php" 
           class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-600">
           Kembali ke Timeline
        </a>

        <a href="index.php" 
           class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
           Ke Profil
        </a>
    </div>

</div>

</body>
</html>