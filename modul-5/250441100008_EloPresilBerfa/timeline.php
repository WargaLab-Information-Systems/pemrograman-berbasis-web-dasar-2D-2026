<?php

$timeline = [
    ["tahun" => "2022", "kegiatan" => "Masuk SMK jurusan RPL"],
    ["tahun" => "2023", "kegiatan" => "Belajar coding pertama kali"],
    ["tahun" => "2024", "kegiatan" => "belajar html"],
    ["tahun" => "2025", "kegiatan" => "Menjadi maba Sistem Informasi UTM"],
    ["tahun" => "2026", "kegiatan" => "Kuliah Semester 2"]
];


function highlightTahun($tahun, $target = "2023") {
    return $tahun == $target ? "text-red-500 font-bold" : "text-gray-700";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Timeline Belajar Coding</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-6 text-center">
        Timeline Perjalanan Belajar Coding
    </h2>

    <div class="relative border-l-4 border-gray-300 pl-6">

        <?php foreach ($timeline as $data): ?>
            <div class="mb-6 relative">
                
                <div class="absolute -left-3 top-1 w-2 h-2 bg-blue-500 rounded-full"></div>

                <span class="<?= highlightTahun($data['tahun']); ?>">
                    <?= $data['tahun']; ?>
                </span>

                <p class="text-gray-600">
                    <?= $data['kegiatan']; ?>
                </p>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="mt-8 flex justify-between">
        <a href="index.php" 
           class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
           Kembali ke Profil
        </a>

        <a href="blog.php" 
           class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
           Menuju Blog Developer
        </a>
    </div>

</div>

</body>
</html>



