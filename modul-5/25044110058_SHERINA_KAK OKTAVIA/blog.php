<?php
$articles = [
    "Belajar HTML Pertama Kali" => [
        "date" => "2026-03-11",
        "content" => "Pengalaman pertama belajar HTML cukup menantang, tapi membuka wawasan tentang struktur dasar web.",
        "image" => "CV.png",
        "link" => "https://developer.mozilla.org/en-US/docs/Web/HTML"
    ],
    "Error Pertama" => [
        "date" => "2026-03-11",
        "content" => "Error pertama saat coding membuat frustasi, tapi akhirnya jadi pelajaran berharga untuk debugging.",
        "image" => "error.jpeg",
        "link" => "https://stackoverflow.com/"
    ],
    "Membuat Website Sederhana" => [
        "date" => "2026-04-08",
        "content" => "Menyelesaikan website sederhana memberi rasa puas dan motivasi untuk belajar lebih dalam.",
        "image" => "web sdrhn.png",
        "link" => "https://www.w3schools.com/"
    ]
];

$quotes = [
    "Coding itu seni, bukan sekadar logika.",
    "Setiap error adalah guru terbaik.",
    "Belajar konsisten lebih penting daripada belajar cepat.",
    "Jangan takut gagal, takutlah kalau tidak mencoba."
];

$selected = $_GET['article'] ?? null;
$randomQuote = $quotes[array_rand($quotes)];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Reflektif Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans p-10">

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">
        Blog Reflektif Developer
    </h1>

    <div class="flex flex-wrap justify-center gap-3 mb-6">
        <?php foreach ($articles as $title => $data): ?>
            <a href="?article=<?= urlencode($title) ?>"
               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow transition">
                <?= htmlspecialchars($title) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <?php if ($selected && isset($articles[$selected])): ?>
        <div class="bg-white border border-gray-200 rounded-2xl shadow-lg p-6 mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">
                <?= htmlspecialchars($selected) ?>
            </h2>
            <p class="text-sm text-gray-500 mb-4">
                <?= $articles[$selected]['date'] ?>
            </p>
            <p class="text-gray-700 mb-4">
                <?= $articles[$selected]['content'] ?>
            </p>
            <img src="<?= $articles[$selected]['image'] ?>" 
                 alt="<?= $selected ?>"
                 class="w-full max-h-60 object-cover rounded-lg mb-4">
            <a href="<?= $articles[$selected]['link'] ?>" target="_blank"
               class="text-blue-600 hover:underline font-medium">
                Baca Referensi →
            </a>
        </div>
    <?php endif; ?>

    <div class="bg-green-100 border-l-4 border-green-500 p-4 rounded-lg mb-6">
        <p class="italic text-gray-800 text-center">
            "<?= $randomQuote ?>"
        </p>
    </div>

    <div class="text-center space-x-4 border-t pt-4">
        <a href="timeline.php" class="text-blue-600 hover:underline">Timeline</a>
        <a href="index.php" class="text-blue-600 hover:underline">Profil</a>
    </div>
</div>

</body>
</html>