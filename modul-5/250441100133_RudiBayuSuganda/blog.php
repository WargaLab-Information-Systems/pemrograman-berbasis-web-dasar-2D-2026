<?php
$artikel = [
    "html" => [
        "judul" => "Belajar HTML ",
        "tanggal" => "01 Maret 2026",
        "isi" => "Saya mulai belajar HTML dan memahami struktur dasar website seperti heading, paragraf,tabel dan link.",
        "gambar" => "gambar/gambar1.png",
        "link" => "https://www.domainesia.com/berita/html-adalah/"
    ],
    "php" => [
        "judul" => "Belajar PHP",
        "tanggal" => "20 April 2026",
        "isi" => "Saya mulai memahami bagaimana PHP bekerja di server dan memproses data.",
        "gambar" => "gambar/gambar3.png",
        "link" => "https://www.php.net/manual/en/"
    ],
    "error" => [
        "judul" => "Error Pertama Di PHP",
        "tanggal" => "05 Maret 2026",
        "isi" => "Saya mengalami error pertama saat coding dan belajar cara membaca pesan error.",
        "gambar" => "gambar/gambar2.png",
        "link" => "https://www.codepolitan.com/blog/beberapa-jenis-error-yang-mungkin-kamu-temui-saat-menggunakan-php/"
    ]
];
$quotes = [
    "Coding itu bukan soal pintar, tapi soal konsisten.",
    "Error adalah guru terbaik dalam programming.",
    "Semakin sering mencoba, semakin cepat paham."
];
$quoteRandom = $quotes[array_rand($quotes)];
$key = $_GET['artikel'] ?? null;
$data = $artikel[$key] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Developer</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-4 text-center">
            Blog Reflektif Developer
        </h2>
        <ul class="mb-6 space-y-2">
            <?php foreach ($artikel as $keyArtikel => $a): ?>
                <li>
                    <a href="?artikel=<?= $keyArtikel ?>" class="text-blue-500 underline">
                        <?= $a['judul'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php if ($data): ?>
            <div class="mt-4">
                <h3 class="text-xl font-bold"><?= $data['judul'] ?></h3>
                <p class="text-sm text-gray-500"><?= $data['tanggal'] ?></p>
                <img src="<?= $data['gambar'] ?>" alt="gambar" class="my-4 w-full">
                <p><?= $data['isi'] ?></p>
                <p class="mt-4 italic text-green-600">
                    "<?= $quoteRandom ?>"
                </p>
                <a href="<?= $data['link'] ?>" class="text-blue-500 underline mt-2 block">
                    Referensi Tambahan
                </a>
            </div>
        <?php endif; ?>
        <div class="mt-8 flex justify-between">
            <a href="timeline.php" class="bg-blue-500 text-white px-4 py-2 rounded">
                <= Kembali
            </a>
        </div>
    </div>
</body>
</html>