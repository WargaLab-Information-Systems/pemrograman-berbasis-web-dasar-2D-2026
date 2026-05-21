<?php
$timeline = [
    "2025" => "Belajar Python",
    "2026 (Modul 1)" => "Mulai belajar HTML",
    "2026 (Modul 2)" => "Mulai belajar CSS",
    "2026 (Modul 3)" => "Mulai belajar FRAMEWORK",
    "2026 (Modul 4)" => "Mulai belajar JAVASCRIPT",
    "2026 (Modul 5)" => "Mulai belajar PHP"
];
function highlight($tahun)
{
    if (strpos($tahun, "2025") !== false) {
        return "font-bold text-blue-500";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Timeline Belajar Coding</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">
            Timeline Perjalanan Belajar Coding
        </h2>
        <div class="border-l-4 border-blue-500 pl-6 space-y-8">
            <?php foreach ($timeline as $tahun => $kegiatan): ?>
                <div class="relative group">
                    <div class="absolute -left-[26px] top-1 w-5 h-5 bg-blue-500 rounded-full border-4 border-white shadow"></div>
                    <h3 class="text-lg font-bold <?= highlight($tahun) ?>">
                        <?php echo $tahun; ?>
                    </h3>
                    <p class="text-gray-600 group-hover:text-black transition">
                        <?= $kegiatan ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="mt-10 flex justify-between">
            <a href="index.php"
                class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                <= Kembali
            </a>
            <a href="blog.php"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                Selanjutnya =>
            </a>
        </div>
    </div>
</body>
</html>