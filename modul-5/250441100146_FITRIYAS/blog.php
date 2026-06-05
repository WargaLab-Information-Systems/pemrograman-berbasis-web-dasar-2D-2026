<?php
$artikel = [
    "html" => [
        "judul"   => "Belajar HTML Pertama Kali",
        "tanggal" => "Februari 2026",
        "isi"     => "Saat pertama belajar HTML, saya mulai memahami struktur dasar website seperti heading, paragraf, dan link.",
        "gambar"  => "first belajar html.png",
        "link"    => "https://developer.mozilla.org/id/docs/Web/HTML"
    ],
    "error" => [
        "judul"   => "Error Pertama",
        "tanggal" => "februari 2026",
        "isi"     => "Error pertama membuat saya sadar bahwa debugging adalah bagian penting dalam proses belajar coding.",
        "gambar"  => "error html.png",
        "link"    => "https://stackoverflow.com"
    ]
];

$quotes = [
    "Jangan menyerah, semua developer pernah error.",
    "Coding adalah proses belajar tanpa henti.",
    "Error adalah guru terbaik dalam programming.",
    "Terus mencoba sampai berhasil."
];

$quote = $quotes[array_rand($quotes)];
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Blog Developer</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-100 to-blue-200 min-h-screen p-6">

<div class="max-w-5xl mx-auto bg-white p-6 rounded-2xl shadow-xl">

<h2 class="text-2xl font-bold text-center text-indigo-600 mb-6">
Blog Reflektif Developer
</h2>

<!-- Daftar Artikel -->
<div class="mb-6">
<p class="font-semibold mb-2">Daftar Artikel:</p>

<ul class="space-y-2">
<?php foreach($artikel as $key => $a): ?>
<li>
<a href="?post=<?= $key; ?>" 
class="text-indigo-600 hover:underline">
→ <?= $a['judul']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</div>

<!-- Detail Artikel -->
<?php 
if(isset($_GET['post']) && isset($artikel[$_GET['post']])):
$data = $artikel[$_GET['post']];
?>

<div class="grid md:grid-cols-2 gap-6 border-t pt-6">

<div>
<h3 class="text-xl font-bold text-indigo-700">
<?= $data['judul']; ?>
</h3>

<p class="text-sm text-gray-500">
Tanggal: <?= $data['tanggal']; ?>
</p>

<p class="mt-3">
<?= $data['isi']; ?>
</p>

<p class="mt-4">
<a href="<?= $data['link']; ?>" target="_blank"
class="text-blue-600 underline">
Referensi Tambahan
</a>
</p>
</div>

<div>
<img src="<?= $data['gambar']; ?>" 
class="rounded-lg shadow w-full">
</div>
</div>
<?php endif; ?>

<!-- cls quotes -->
<div class="mt-6 bg-gray-50 p-4 rounded-lg text-center italic text-gray-600">
"<?= $quote; ?>"
</div>

<!-- cls navigasi -->
<div class="mt-6 flex justify-between">

<a href="index.php" 
class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300">
← Profil
</a>

<a href="timeline.php" 
class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
Timeline →
</a>
</div>
</div>
</body>
</html>