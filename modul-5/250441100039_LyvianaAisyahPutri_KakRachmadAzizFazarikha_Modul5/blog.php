<?php
$jurnal = [
    [
        "judul" => "Pentingnya UI/UX di Era Modern",
        "tanggal" => "14 Februari 2026",
        "isi" => "Sebuah website tidak hanya dinilai dari seberapa rumit kodenya, tetapi dari seberapa mudah pengguna berinteraksi dengannya. Wireframing dan prototyping sangat membantu memvisualisasikan ide sebelum proses coding.",
        "gambar" => "img/figma.png",
        "link" => "#"
    ],
    [
        "judul" => "Menerjemahkan Desain ke Tailwind",
        "tanggal" => "28 Maret 2026",
        "isi" => "Menerjemahkan desain visual menjadi kode terkadang menantang. Tailwind CSS sangat mempermudah proses styling langsung di HTML tanpa perlu membuat file CSS eksternal yang panjang.",
        "gambar" => "img/tailwind.png",
        "link" => "https://tailwindcss.com/"
    ],
    [
        "judul" => "Belajar Menghubungkan Form & PHP",
        "tanggal" => "20 April 2026",
        "isi" => "Setelah antarmuka selesai, langkah selanjutnya adalah membuatnya dinamis. Menangani input form menggunakan metode POST di PHP memberikan pemahaman tentang pertukaran data di server.",
        "gambar" => "img/formphp.png",
        "link" => "https://www.php.net/manual/en/tutorial.forms.php"
    ]
];

function kutipanMotivasi() {
    $kutipan = [
        "Desain yang baik memecahkan masalah tanpa terlihat rumit.",
        "Kode yang terstruktur adalah pondasi website yang stabil.",
        "Eksplorasi adalah kunci dari setiap karya digital."
    ];
    return $kutipan[array_rand($kutipan)];
}

$id_artikel = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!array_key_exists($id_artikel, $jurnal)) {
    $id_artikel = 0;
}

$artikel_aktif = $jurnal[$id_artikel];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Jurnal - Lyviana</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-100 p-4 md:p-10 font-sans text-zinc-800">

    <div class="max-w-4xl mx-auto">
        
        <div class="flex justify-between items-end mb-6">
            <h2 class="text-3xl font-extrabold text-zinc-900">Jurnal Artikel</h2>
            <a href="timeline.php" class="text-sm font-bold text-zinc-500 hover:text-zinc-900 mb-1">Kembali</a>
        </div>

        <!-- BEDA KONSEP LAYOUT: NAVIGASI HORIZONTAL DI ATAS -->
        <div class="flex flex-wrap gap-3 mb-8 pb-4 border-b border-zinc-200">
            <?php for ($i = 0; $i < count($jurnal); $i++) { 
                $aktif = ($i == $id_artikel) ? "bg-zinc-900 text-white" : "bg-white text-zinc-600 border border-zinc-200 hover:bg-zinc-50";
            ?>
                <!-- Link GET diletakkan menyamping seperti Tab Menu -->
                <a href="blog.php?id=<?php echo $i; ?>" class="px-5 py-2.5 rounded-full text-sm font-bold transition-colors <?php echo $aktif; ?>">
                    <?php echo $jurnal[$i]['judul']; ?>
                </a>
            <?php } ?>
        </div>

        <!-- KONTEN DI BAWAH NAVIGASI -->
        <div class="bg-white p-8 md:p-12 rounded-2xl shadow-sm border border-zinc-200">
            
            <p class="text-xs font-extrabold text-indigo-500 uppercase tracking-widest mb-3"><?php echo $artikel_aktif['tanggal']; ?></p>
            <h1 class="text-3xl md:text-4xl font-black text-zinc-900 mb-8 leading-tight"><?php echo $artikel_aktif['judul']; ?></h1>
            
            <img src="<?php echo $artikel_aktif['gambar']; ?>" alt="Cover Artikel" class="w-full h-full object-cover rounded-xl border border-zinc-100 mb-8 shadow-sm">

            <div class="bg-indigo-50 text-indigo-700 p-5 rounded-xl mb-8 text-sm font-medium border border-indigo-100">
                Tip: <?php echo kutipanMotivasi(); ?>
            </div>

            <p class="text-zinc-700 text-lg leading-relaxed mb-8">
                <?php echo $artikel_aktif['isi']; ?>
            </p>

            <div class="pt-6 border-t border-zinc-100">
                <a href="<?php echo $artikel_aktif['link']; ?>" target="_blank" class="inline-block bg-zinc-100 text-zinc-700 font-bold px-6 py-3 rounded-xl hover:bg-zinc-200 transition-colors">
                    Pelajari Referensi Eksternal
                </a>
            </div>
        </div>

    </div>

</body>
</html>