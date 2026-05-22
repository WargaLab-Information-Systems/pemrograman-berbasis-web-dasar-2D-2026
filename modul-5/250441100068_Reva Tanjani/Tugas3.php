<?php
// DATA ARTIKEL
$artikel = [
    [
        "judul" => "Belajar Coding Pertama",
        "tanggal" => "2022",
        "isi" => "Mulai belajar coding saat SMA, masih bingung tapi seru.",
        "gambar" => "error.png",
        "link" => "https://developer.mozilla.org"
    ],
    [
        "judul" => "Mulai HTML & CSS",
        "tanggal" => "2023",
        "isi" => "Belajar membuat tampilan website sederhana.",
        "gambar" => "html.png",
        "link" => "https://w3schools.com"
    ],
    [
        "judul" => "Belajar PHP",
        "tanggal" => "2025",
        "isi" => "Mulai memahami backend dan form processing.",
        "gambar" => "php.png",
        "link" => "https://php.net"
    ]
];

// QUOTE RANDOM
$quotes = [
    "Coding itu proses",
    "Error itu wajar",
    "Jangan menyerah",
    "Terus belajar"
];

$quote = $quotes[array_rand($quotes)];

// AMBIL DATA GET
$id = $_GET['id'] ?? -1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Blog</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-200">

<nav class="bg-neutral-900 flex justify-center py-4 shadow-xl">
  <div class="bg-yellow-400 px-6 py-2 rounded-lg flex gap-6">
    <a href="Tugas1.php" class="text-black font-bold">Profil</a>
    <a href="Tugas2.php" class="text-black font-bold">Timeline</a>
    <a href="Tugas3.php" class="text-black font-bold underline">Blog</a>
  </div>
</nav>

<div class="max-w-4xl mx-auto mt-10 grid grid-cols-3 gap-6">

<!-- LIST ARTIKEL -->
<div class="bg-neutral-900 text-white p-4 rounded-xl">
    <h2 class="text-yellow-300 font-bold mb-3">Daftar Artikel</h2>

    <?php foreach($artikel as $i => $a){ ?>
        <a href="?id=<?= $i ?>" class="block mb-2 hover:text-yellow-400">
            • <?= $a['judul']; ?>
        </a>
    <?php } ?>
</div>

<!-- DETAIL -->
<div class="col-span-2 bg-neutral-900 text-white p-5 rounded-xl">

<?php if(isset($artikel[$id])){ 
    $data = $artikel[$id];
?>

    <h2 class="text-2xl font-bold text-yellow-300 mb-2">
        <?= $data['judul']; ?>
    </h2>

    <p class="text-sm text-gray-400 mb-4">
        <?= $data['tanggal']; ?>
    </p>

    <img src="<?= $data['gambar']; ?>" class="mb-4 rounded">

    <p class="mb-4">
        <?= $data['isi']; ?>
    </p>

    <p class="italic text-yellow-400 mb-4">
        "<?= $quote; ?>"
    </p>

    <a href="<?= $data['link']; ?>" class="text-blue-400 underline">
        Referensi
    </a>

<?php } else { ?>
    <p>Pilih artikel di sebelah kiri.</p>
<?php } ?>

</div>

</div>

</body>
</html>