<?php
$sejarah_belajar = [
    "2025 Awal" => "Diterima sebagai mahasiswa Sistem Informasi di Universitas Trunojoyo Madura.",
    "2025 Tengah" => "Mulai fokus mempelajari antarmuka pengguna (UI) dan menggunakan Figma.",
    "2025 Akhir" => "Mempelajari fundamental HTML dan CSS untuk merealisasikan desain website.",
    "2026 Awal" => "Berlatih memotong desain (slicing) menjadi struktur web responsif dengan Tailwind.",
    "2026 Kini" => "Mempelajari bahasa pemrograman PHP untuk mengelola data web secara dinamis."
];

function sorotTahun($tahun) {
    if (strpos($tahun, '2026') !== false) {
        return "text-indigo-600 font-extrabold";
    } else {
        return "text-zinc-900 font-bold";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Timeline - Lyviana</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-100 p-6 md:p-12 font-sans text-zinc-800">

    <div class="max-w-3xl mx-auto bg-white p-8 md:p-12 rounded-2xl shadow-sm border border-zinc-200">
        <h1 class="text-3xl font-extrabold text-zinc-900 mb-10">Histori Pembelajaran</h1>

        <div class="space-y-6">
            <?php foreach ($sejarah_belajar as $tahun => $kegiatan) { ?>
                
                <!-- BEDA KONSEP LAYOUT: Flexbox Kiri (Tahun) - Kanan (Teks) -->
                <div class="flex flex-col sm:flex-row gap-4 sm:gap-8 bg-zinc-50 p-6 rounded-xl border border-zinc-100 items-start">
                    
                    <div class="sm:w-1/4">
                        <h3 class="text-xl <?php echo sorotTahun($tahun); ?>">
                            <?php echo $tahun; ?>
                        </h3>
                    </div>
                    
                    <div class="sm:w-3/4">
                        <p class="text-zinc-600 leading-relaxed ">
                            <?php echo $kegiatan; ?>
                        </p>
                    </div>

                </div>

            <?php } ?>
        </div>

        <div class="mt-10 flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-zinc-100 pt-8">
            <a href="index.php" class="text-zinc-500 font-bold hover:text-zinc-900">Kembali ke Profil</a>
            <a href="blog.php" class="bg-indigo-600 text-white font-bold px-6 py-3 rounded-xl hover:bg-indigo-700">Masuk ke Blog</a>
        </div>
    </div>

</body>
</html>