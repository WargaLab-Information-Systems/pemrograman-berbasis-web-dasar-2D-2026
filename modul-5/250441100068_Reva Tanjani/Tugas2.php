<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Timeline</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200">
<div class="max-w-3xl mx-auto py-10"><h1 class="text-center text-3xl font-bold mb-10">Timeline Belajar Coding</h1><div class="relative border-l-4 border-yellow-400">
<?php
$timeline = [
["tahun" => "2022", "kegiatan" => "Masuk SMA - Belajar bahasa C"],
["tahun" => "2023", "kegiatan" => "Masih belajar bahasa C"],
    ["tahun" => "2024", "kegiatan" => "Belajar bahasa C++"],
["tahun" => "2025", "kegiatan" => "Masuk kuliah - Python & project pertama"],
    ["tahun" => "2026", "kegiatan" => "HTML, PHP, CSS, JS, SQL"]
    ];

foreach($timeline as $item){
        $highlight = ($item['tahun'] == "2026") ? "text-yellow-400 font-bold" : "";
    ?><div class="mb-10 ml-6"><div class="absolute -left-3 w-6 h-6 bg-yellow-400 rounded-full border-4 border-white"></div>
<div class="bg-neutral-900 text-white p-4 rounded-lg shadow-md">
<h2 class="font-bold <?= $highlight; ?>"><?= $item['tahun']; ?></h2><p><?= $item['kegiatan']; ?></p>
</div></div>
<?php } ?>

    </div>
</div>
</body>
</html> 