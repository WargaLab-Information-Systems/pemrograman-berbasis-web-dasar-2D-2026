<?php
$artikel = [
    "html" => [
        "judul" => "Belajar HTML Pertama Kali",
        "tanggal" => "26 Agustus 2022",
        "isi" => "Aku pertama kali belajar HTML dan merasa bingung dengan tag-tag yang ada. Setelah dimengerrti, ternyata HTML sedikit seru untuk dipelajari. Dengan HTML aku bisa membuat struktur dasar sebuah website.",
        "gambar" => "img/ft1.jpg",
        "referensi" => "https://youtube.com/@sandhikagalihwpu?si=Ckf1K6WkpyvWR05l"
    ],
    "error" => [
        "judul" => "Error Pertama",
        "tanggal" => "26 Agustus 2022",
        "isi" => "Waktu pertama kali mengenal error, hidupku cukup menyenangkan. Sejak saat itu aku tau bahwa error merukapan bagian dari proses belajar. Dengan error aku juga bisa belajar Troubelshooting.",
        "gambar" => "img/ft2.jpg",
        "referensi" => "https://stackoverflow.com"
    ],
    "css" => [
        "judul" => "Belajar CSS Pertama Kali",
        "tanggal" => "27 Agustus 2022",
        "isi" => "Aku belajar CSS dan merasa bahwa styling itu penting untuk membuat website yang menarik. Dengan CSS aku bisa mengatur tampilan dan layout dari halaman web.",
        "gambar" => "img/ft3.png",
        "referensi" => "https://youtube.com/@sandhikagalihwpu?si=Ckf1K6WkpyvWR05l"
    ],
    "php" => [
        "judul" => "Belajar PHP Pertama Kali",
        "tanggal" => "12 Juli 2024",
        "isi" => "Aku belajar PHP dan merasa bahwa backend itu cukup menantang. Dengan PHP aku bisa membuat website yang dinamis dan terhubung dengan database.",
        "gambar" => "img/ft4.png",
        "referensi" => "https://youtube.com/@sandhikagalihwpu?si=Ckf1K6WkpyvWR05l"
    ]
];

$key = $_GET['artikel'] ?? array_key_first($artikel);
$artikelKey = $artikel[$key];

$kutipan = [
    "Error adalah guru terbaik dalam coding.",
    "Ngoding itu bukan bakat, tapi kebiasaan.",
    "Semakin sering error, semakin sering tanya GPT.",
    "Jangan lupa titik koma, itu penting!",
];
$kutipanRandom = $kutipan[array_rand($kutipan)];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/output.css">
    <title>Blog Reflektif Developer</title>
</head>

<body>
    <div class="max-w-6xl mx-auto p-5 grid grid-cols-4 gap-5">

        <div class="col-span-1 bg-white p-4 rounded shadow">
            <h2 class="font-bold mb-3">Daftar Artikel</h2>

            <?php foreach ($artikel as $id => $isi): ?>
                <a href="?artikel=<?php echo $id; ?>"
                    class="block mb-2 text-blue-500 hover:underline">
                    - <?php echo $isi['judul']; ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="col-span-3 bg-white p-6 rounded shadow">

            <h1 class="text-2xl font-bold mb-2">
                <?php echo $artikelKey['judul']; ?>
            </h1>

            <p class="text-gray-500 mb-4">
                <?php echo $artikelKey['tanggal']; ?>
            </p>

            <img src="<?php echo $artikelKey['gambar']; ?>"
                class="w-full h-60 object-cover mb-4 rounded">

            <p class="mb-4">
                <?php echo $artikelKey['isi']; ?>
            </p>

            <div class="bg-blue-100 p-3 rounded mb-4">
                "<?php echo $kutipanRandom; ?>"
            </div>

            <p class="mb-4">
                <a href="<?php echo $artikelKey['referensi']; ?>"
                    class="text-blue-500 underline" target="_blank">
                    Referensi Tambahan
                </a>
            </p>

        </div>
        <div class="col-span-4 w-full flex justify-center gap-4">
            <a href="index.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kembali ke Profil</a>
            <a href="timeline.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Kembali ke Timeline</a>
        </div>

    </div>
</body>

</html>