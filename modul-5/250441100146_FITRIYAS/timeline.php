<?php
function highlight($tahun){
    return $tahun == "februari 2026"
        ? "bg-indigo-100 border-l-4 border-indigo-600 font-semibold"
        : "bg-white";
}

$timeline = [
    ["tahun"=>"Agustus 2025", "kegiatan"=>"Masuk Kuliah"],
    ["tahun"=>"Semester 1", "kegiatan"=>"Belajar bahasa pemrograman python"],
    ["tahun"=>"semester 2", "kegiatan"=>"Belajar membuat web melalui html"],
    ["tahun"=>"februari 2026", "kegiatan"=>"Membuat Website Pertama"],
    ["tahun"=>"april 2026", "kegiatan"=>"membuat website dengan menggunakan php"]
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Timeline Coding</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-100 to-blue-200 min-h-screen p-6">

<div class="max-w-2xl mx-auto bg-white p-6 rounded-2xl shadow-xl">

<h2 class="text-2xl font-bold text-center text-indigo-600 mb-6">
Timeline Perjalanan Belajar Coding
</h2>

<!-- TIMELINE -->
<div class="relative border-l-4 border-indigo-300 pl-6 space-y-6">

<?php foreach($timeline as $item): ?>
<div class="p-4 rounded-lg shadow <?= highlight($item['tahun']); ?>">

    <div class="text-indigo-600 font-bold text-lg">
        <?= $item['tahun']; ?>
    </div>

    <div class="text-gray-700">
        <?= $item['kegiatan']; ?>
    </div>

</div>
<?php endforeach; ?>

</div>

<!-- NAVIGASI -->
<div class="mt-8 flex justify-between">

<a href="index.php"
class="bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300">
← Kembali ke Profil
</a>

<a href="blog.php"
class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
Menuju Blog →
</a>

</div>

</div>
</body>
</html>