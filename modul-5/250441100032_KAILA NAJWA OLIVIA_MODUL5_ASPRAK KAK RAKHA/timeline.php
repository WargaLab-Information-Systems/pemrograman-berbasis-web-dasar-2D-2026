<!DOCTYPE html>
<html>
<head>
    <title>Timeline Belajar Coding</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 via-blue-200 to-blue-300 min-h-screen p-6">

<div class="max-w-2xl mx-auto bg-white/90 backdrop-blur p-6 rounded-2xl shadow-xl border border-blue-200">

<h1 class="text-3xl font-bold text-center text-blue-700 mb-6">
        Timeline Perjalanan Belajar Coding
</h1>

<?php
$timeline = [
    ["tahun" => "2022", "kegiatan" => "Masuk kuliah jurusan Sistem Informasi"],
    ["tahun" => "2023", "kegiatan" => "Mulai belajar Python"],
    ["tahun" => "2024", "kegiatan" => "Belajar HTML & CSS"],
    ["tahun" => "2025", "kegiatan" => "Belajar Javascript Dasar"],
    ["tahun" => "2026", "kegiatan" => "Belajar PHP & MySQL"]
];

function highlightTahun($tahun, $teks){
    if($tahun == "2024"){
        return "<span class='font-bold text-blue-700'>$teks</span>";
    } else {
        return $teks;
    }
}
?>

<div class="relative border-l-4 border-blue-400 ml-4">

<?php foreach($timeline as $data): ?>
    
    <div class="mb-6 ml-6">
        
        <div class="absolute w-4 h-4 bg-blue-500 rounded-full -left-2 mt-2"></div>
    
        <div class="bg-blue-50 p-4 rounded-lg shadow hover:scale-105 transition">
            <p class="text-sm text-gray-500">
                <?= highlightTahun($data['tahun'], $data['tahun']); ?>
            </p>
            <p class="text-blue-800 font-semibold">
                <?= $data['kegiatan']; ?>
            </p>
        </div>

    </div>

<?php endforeach; ?>

</div>

<div class="mt-8 flex justify-between">

    <a href="index.php"
       class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 shadow">
       Kembali ke Profil
    </a>

    <a href="blog.php"
       class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 shadow">
       Blog Developer 
    </a>

</div>

</div>

</body>
</html>