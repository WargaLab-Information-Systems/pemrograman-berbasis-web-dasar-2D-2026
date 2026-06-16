<?php
$timeline_belajar = [
    "2025" => "Diterima sebagai mahasiswa Sistem Informasi di Fakultas Teknik Universitas Trunojoyo Madura melalui jalur UTBK-SNBT.",
    "2025 Akhir" => "Mendaftar sebagai mitra pengemudi Grab dan mulai beraktivitas menggunakan layanan transit feri Kamal-Ujung.",
    "2026 Awal" => "Mengembangkan skrip Lua untuk sistem interaktif (aura dan inventori) di platform Roblox.",
    "2026 April" => "Melakukan konfigurasi jaringan dan instalasi Armbian Linux pada perangkat STB hg680p untuk fungsionalitas server lokal.",
    "2026 Saat Ini" => "Mendalami web development dan manajemen basis data menggunakan PHP, SQL, GitHub, dan Laragon."
];

function formatTeksTahun($tahun) {
    if (strpos($tahun, '2026') !== false) {
        return "text-slate-900 font-bold text-lg";
    } else {
        return "text-gray-500 font-semibold text-base";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Catatan Perjalanan - Iqbal Hasan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8 font-sans text-gray-800">

    <div class="max-w-3xl mx-auto bg-white p-10 rounded-xl shadow-sm border border-gray-200">
        <h1 class="text-2xl font-bold text-slate-900 mb-10 border-b border-gray-100 pb-4">Linimasa Aktivitas & Pembelajaran</h1>

        <div class="border-l-2 border-gray-200 ml-4 pl-8 space-y-8 relative pb-4">
            
            <?php foreach ($timeline_belajar as $tahun => $kegiatan) { ?>
                <div class="relative">
                    <div class="absolute -left-[41px] top-1.5 w-4 h-4 bg-white border-2 border-slate-400 rounded-full"></div>
                    
                    <div>
                        <h3 class="<?php echo formatTeksTahun($tahun); ?> mb-2">
                            <?php echo $tahun; ?>
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            <?php echo $kegiatan; ?>
                        </p>
                    </div>
                </div>
            <?php } ?>

        </div>

        <div class="mt-12 pt-6 border-t border-gray-100 flex flex-col md:flex-row justify-between gap-4">
            <a href="index.php" class="bg-white border border-slate-300 text-slate-700 text-center font-semibold text-sm px-6 py-2.5 rounded-md hover:bg-gray-50 transition-colors">Kembali ke Profil</a>
            <a href="blog.php" class="bg-slate-900 text-white text-center font-semibold text-sm px-6 py-2.5 rounded-md hover:bg-slate-800 transition-colors">Buka Halaman Artikel</a>
        </div>
    </div>

</body>
</html>