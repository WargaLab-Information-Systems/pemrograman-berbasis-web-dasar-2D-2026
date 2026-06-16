<?php
$artikel_blog = [
    [
        "judul" => "Logika Script Lua pada Sistem Interaktif Roblox Studio",
        "tanggal" => "20 Januari 2026",
        "isi" => "Implementasi ServerMasterControl menggunakan skrip Lua di Roblox Studio membutuhkan pemahaman algoritma yang kuat. Sistem inventori dan manipulasi visual (aura) yang saya bangun mengandalkan interaksi klien-server yang efisien.",
        "gambar" => "img/Gambar4.png",
        "link" => "#"
    ],
    [
        "judul" => "Konfigurasi Server Linux",
        "tanggal" => "10 April 2026",
        "isi" => "Merombak STB untuk menjalankan OS Armbian Linux memberikan wawasan arsitektur sistem operasi. Keberhasilan proses boot terminal memungkinkan perangkat berfungsi sebagai server lokal menggunakan daya rendah (12volt).",
        "gambar" => "img/Gambar3.png",
        "link" => "https://ibaskara.my.id"
    ],
    [
        "judul" => "Manajemen Basis Data",
        "tanggal" => "18 April 2026",
        "isi" => "Mengelola lingkungan pengembangan lokal menggunakan Laragon sangat menyederhanakan konfigurasi MySQL. Eksplorasi sintaks SQL Join membantu saya memahami relasi data yang kompleks <i>(gambar foto lama error)</i>.",
        "gambar" => "img/Gambar2.png",
        "link" => "https://laragon.org/docs/"
    ]
];

function getKutipanSistem() {
    $kutipan = [
        "Integritas data berawal dari struktur logika yang solid.",
        "Optimalisasi sistem tidak hanya soal kecepatan, namun efisiensi sumber daya.",
        "Dokumentasi kode yang baik mencegah kegagalan pemeliharaan jangka panjang."
    ];
    $index_acak = array_rand($kutipan);
    return $kutipan[$index_acak];
}

$id_aktif = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!array_key_exists($id_aktif, $artikel_blog)) {
    $id_aktif = 0;
}

$tampil_artikel = $artikel_blog[$id_aktif];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Artikel - Developer Log</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8 font-sans text-gray-800">

    <div class="max-w-5xl mx-auto flex flex-col md:flex-row gap-8">
        
        <div class="w-full md:w-1/3 bg-white p-6 rounded-xl shadow-sm border border-gray-200 h-fit">
            <h3 class="text-lg font-bold text-slate-900 mb-4 border-b border-gray-100 pb-3">Katalog Artikel</h3>
            <ul class="space-y-2 mb-6">
                <?php 
                for ($i = 0; $i < count($artikel_blog); $i++) { 
                    if ($i == $id_aktif) {
                        $activeClass = "bg-slate-900 text-white font-semibold";
                    } else {
                        $activeClass = "bg-white text-gray-600 hover:bg-gray-50 border border-transparent hover:border-gray-200";
                    }
                ?>
                    <li>
                        <a href="blog.php?id=<?php echo $i; ?>" class="block px-4 py-2.5 rounded-md text-sm transition-colors <?php echo $activeClass; ?>">
                            <?php echo $artikel_blog[$i]['judul']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            
            <div class="pt-4 border-t border-gray-100">
                <a href="timeline.php" class="text-sm font-semibold text-gray-500 hover:text-slate-900 transition-colors">
                    Kembali ke Linimasa
                </a>
            </div>
        </div>


        <div class="w-full md:w-2/3 bg-white p-8 rounded-xl shadow-sm border border-gray-200">
            
            <div class="bg-gray-50 border-l-2 border-slate-900 p-4 mb-8 text-sm text-gray-600">
                Catatan Harian: "<?php echo getKutipanSistem(); ?>"
            </div>

            <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3"><?php echo $tampil_artikel['tanggal']; ?></p>
            <h1 class="text-2xl font-bold text-slate-900 mb-6"><?php echo $tampil_artikel['judul']; ?></h1>

            <img src="<?php echo $tampil_artikel['gambar']; ?>" alt="Ilustrasi Topik" class="w-full h-64 object-cover rounded-md mb-6 border border-gray-200">

            <p class="text-gray-700 text-sm leading-relaxed mb-8">
                <?php echo $tampil_artikel['isi']; ?>
            </p>

            <div class="pt-6 border-t border-gray-100">
                <a href="<?php echo $tampil_artikel['link']; ?>" target="_blank" class="inline-block bg-white border border-slate-300 text-slate-700 font-semibold text-sm px-5 py-2 rounded-md hover:bg-gray-50 transition-colors">
                    Buka Dokumentasi Hasil
                </a>
            </div>
        </div>

    </div>

</body>
</html>