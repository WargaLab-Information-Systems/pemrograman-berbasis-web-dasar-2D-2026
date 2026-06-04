<!DOCTYPE html>
<html>
<head>
    <title>Blog Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 via-blue-200 to-blue-300 min-h-screen p-6">

<div class="max-w-5xl mx-auto bg-white/90 backdrop-blur p-6 rounded-2xl shadow-xl border border-blue-200">

<h1 class="text-3xl font-bold text-blue-700 mb-6 text-center">
     Blog Perjalanan Coding
</h1>

<?php 
$artikel = [
    "Python" => [
        "judul" => "Belajar Python Pertama Kali",
        "bulan" => "September 2025",
        "isi" => "Awalnya saya bingung dengan struktur Python, tapi setelah mencoba membuat project Python, saya mulai memahami konsep dasar Pyhon.",
        "gambar" => "gambar/python..jpg"
    ],
    "HTML" => [
        "judul" => "Belajar HTML Pertama Kali",
        "bulan" => "September 2025",
        "isi" => "Awalnya saya bingung dengan struktur Dasar HTML, tapi setelah mencoba membuat project Website, saya mulai memahami konsep dasar Web .",
        "gambar" => "gambar/HTML.png"
    ],    
    "error" => [
        "judul" => "Error Pertama dalam Coding",
        "bulan" => "Februari 2023",
        "isi" => "Saat pertama kali menemukan error, saya panik. Tapi dari situ saya belajar membaca error message dan memperbaiki kode.",
        "gambar" => "gambar/error.jpg",
    ],
    "project" => [
        "judul" => "Membuat Project Website",
        "bulan" => "Maret 2024",
        "isi" => "Saya berhasil membuat website pertama saya. Walaupun sederhana, ini menjadi pengalaman berharga.",
        "gambar" => "gambar/project.jpg"
    ]
];

$quotes = [
    "Coding itu bukan tentang pintar, tapi tentang konsisten.",
    "Error adalah guru terbaik dalam programming.",
    "Terus belajar walau pelan.",
    "Setiap developer pernah jadi pemula."
];

$randomQuote = $quotes[array_rand($quotes)];
?>

<div class="mb-6">
    <h2 class="text-xl font-semibold text-blue-700 mb-2">Daftar Artikel</h2>
    <ul class="list-disc ml-6 text-blue-600">
        <?php foreach($artikel as $key => $data): ?>
            <li>
                <a href="?post=<?= $key ?>" class="hover:underline">
                    <?= $data['judul']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php
if(isset($_GET['post']) && isset($artikel[$_GET['post']])){

    $data = $artikel[$_GET['post']];
?>
    <div class="bg-blue-50 p-6 rounded-lg shadow">
        
        <h2 class="text-2xl font-bold text-blue-700">
            <?= $data['judul']; ?>
        </h2>

        <p class="text-sm text-gray-500 mb-3">
            <?= $data['bulan']; ?>
        </p>

        <img src="<?= $data['gambar']; ?>" 
             class="w-full max-h-64 object-cover rounded mb-4">

        <p class="text-gray-700 mb-4">
            <?= $data['isi']; ?>
        </p>

        <p class="italic text-blue-600 mb-4">
            "<?= $randomQuote; ?>"
        </p>

    </div>
<?php
}
?>

<div class="mt-8 flex justify-between">

    <a href="timeline.php"
       class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 shadow">
       Kembali ke Timeline
    </a>

    <a href="index.php"
       class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 shadow">
       Kembali ke Profil
    </a>

</div>

</div>

</body>
</html>
