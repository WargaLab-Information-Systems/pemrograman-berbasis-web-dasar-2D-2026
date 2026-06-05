<?php
$timeline = [
    ["tahun" => "2025", "kegiatan" => "Masuk kuliah jurusan Sistem Informasi"],
    ["tahun" => "2025", "kegiatan" => "Berusaha beradaptasi dengan materi di jurusan yang dipilih :)"],
    ["tahun" => "2025", "kegiatan" => "mulai belajar ngodingg (alpro)"],
    ["tahun" => "2026", "kegiatan" => "Mulai belajar WEB & Database"],
    ["tahun" => "2026", "kegiatan" => "uda pusingg ngadepin js, php, blm jg modul berikutnya"],
];

function highlightTahun($tahun, $target = "2026") {
    if ($tahun == $target) {
        return "text-pink-500 font-bold"; 
    }
    return "text-gray-700";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Timeline Belajar Coding</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-pink-200 font-sans">

<div class="max-w-2xl mx-auto p-6">

    <h2 class="text-2xl font-bold text-center mb-6">
        Timeline Perjalanan Belajar Coding
    </h2>

    <div class="relative border-l-4 border-pink-300 pl-6">

        <?php foreach ($timeline as $data): ?>
            
            <div class="mb-6 relative">
                
                <div class="absolute -left-3 top-1 w-5 h-5 bg-pink-400 rounded-full"></div>

                <div class="bg-blue-200 rounded-xl shadow p-4">
                    <p class="<?= highlightTahun($data['tahun']) ?>">
                        <?= $data['tahun'] ?>
                    </p>
                    <p class="text-gray-600">
                        <?= $data['kegiatan'] ?>
                    </p>
                </div>

            </div>

        <?php endforeach; ?>

    </div>

    <div class="mt-8 flex justify-between">

        <a href="index.php" 
           class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
            Kembali ke Profil
        </a>

        <a href="blog.php" 
           class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">
            Menuju Blog 
        </a>

    </div>

</div>

</body>
</html>