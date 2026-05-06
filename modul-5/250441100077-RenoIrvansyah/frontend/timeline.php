<?php

$timeline = [
    "2022" => "Penasaran dengan dunia coding, mulai belajar HTML & CSS, nontonn tutorial di YouTube, dan membuat website pertama dengan HTML & CSS.",
    "2023" => "Belajar Arduino, dengan bahasa pemrograman C++. Membuat project sederhana untuk tugas sekolah.",
    "2024" => "Mempelajari bahasa pemrograman baru, yaitu PHP. Mulai mengenal konsep backend dan database. Membuat project CRUD sederhana dengan PHP dan MySQL.",
    "2025" => "Belajar framework (Laravel & React), sekaligus dengan Magang di Bootcamp Fullstack Dev.",
    "2026" => "Belajar bahasa baru, seperti Python. Mulai membuat project open source di GitHub, dan aktif di komunitas developer."
];

function tahunTertentu($tahun, $pilih)
{
    if ($tahun == $pilih) {
        return "text-blue-500 font-bold text-2xl";
    }
    return "text-white";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/output.css">
    <title>Timeline Belajar</title>
</head>

<body>

    <div class="container mx-auto px-4 py-8">
        <div class="relative wrap overflow-hidden">
            <div class="absolute border-opacity-20 border-gray-700 h-full border ml-10"></div>
            <?php foreach ($timeline as $tahun => $kegiatan) : ?>
                <div class="mb-8 flex items-center w-full">
                    <div class="order-1 w-5/12"></div>
                    <div class="z-20 flex items-center bg-gray-800 shadow-xl w-20 h-12 rounded-full">
                        <h1 class="mx-auto font-semibold <?= tahunTertentu($tahun, "2024") ?>"><?= $tahun ?></h1>
                    </div>
                    <div class="ml-10 bg-[#e3e3e3] rounded-lg shadow-xl w-5/12 px-6 py-4">
                        <p class="text-gray-700"><?= $kegiatan ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="w-full">
        <div class="flex justify-center gap-4">
            <a href="index.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kembali ke Profil</a>
            <a href="blog.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Menuju Blog Developer</a>
        </div>
    </div>



</body>

</html>