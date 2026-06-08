<?php
date_default_timezone_set('Asia/Jakarta');
$waktu = date('H');
$sapaan = "Selamat Malam";

if ($waktu >= 5 && $waktu < 12) {
    $sapaan = "Selamat Pagi";
} elseif ($waktu >= 12 && $waktu < 15) {
    $sapaan = "Selamat Siang";
} elseif ($waktu >= 15 && $waktu < 18) {
    $sapaan = "Selamat Sore";
}

$profil_lyvi = [
    "NIM" => "250441100039",
    "Prodi" => "Sistem Informasi",
    "Fokus" => "UI/UX & Web Design",
    "Email" => "lyvianaaisyah@gmail.com"
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Portofolio - Lyviana</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-100 text-zinc-800 font-sans p-4 md:p-10">

    <!-- PEMBAGIAN LAYOUT KIRI DAN KANAN -->
    <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- KOLOM KIRI (Profil Kartu Vertikal) -->
        <div class="md:col-span-1">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-zinc-200 sticky top-10">
                <img src="img/fotodiri.jpeg" alt="Foto Lyviana" class="w-full h-full object-cover rounded-xl mb-6 shadow-sm">
                <p class="text-indigo-600 font-semibold text-sm mb-1"><?php echo $sapaan; ?>!</p>                
                <h1 class="text-2xl font-bold text-zinc-900 mb-6">Lyviana Aisyah Putri</h1>

                
                <div class="space-y-4 text-sm">
                    <?php foreach ($profil_lyvi as $kategori => $isi) { ?>
                        <div>
                            <p class="text-zinc-500 text-xs uppercase tracking-wider font-bold"><?php echo $kategori; ?></p>
                            <p class="font-medium text-zinc-800"><?php echo $isi; ?></p>
                        </div>
                    <?php } ?>
                </div>

                <div class="mt-8 flex flex-col gap-3">
                    <a href="timeline.php" class="bg-zinc-900 text-white text-center py-3 rounded-lg text-sm font-semibold hover:bg-zinc-800">Lihat Timeline</a>
                    <a href="blog.php" class="bg-indigo-50 text-indigo-700 text-center py-3 rounded-lg text-sm font-semibold hover:bg-indigo-100">Buka Halaman Artikel</a>
                </div>
            </div>
        </div>

        <!-- KOLOM KANAN (Form Input) -->
        <div class="md:col-span-2">
            <div class="bg-white p-8 md:p-10 rounded-2xl shadow-sm border border-zinc-200">
                <h2 class="text-2xl font-bold text-zinc-900 mb-8 border-b border-zinc-100 pb-4">Data Keterampilan Teknis</h2>
                
                <form action="proses.php" method="POST" class="space-y-6">
                    <div>
                        <label class="block font-bold text-zinc-700 mb-2">Bahasa / Framework Terkuasai:</label>
                        <p class="text-xs text-zinc-500 mb-2">Pisahkan menggunakan tanda koma (,)</p>
                        <input type="text" name="framework" class="w-full border-2 border-zinc-200 p-3 rounded-xl focus:outline-none focus:border-indigo-500" value="Figma, Canva, HTML, CSS, Tailwind">
                    </div>
                    
                    <div>
                        <label class="block font-bold text-zinc-700 mb-2">Deskripsi Pengalaman Praktis:</label>
                        <textarea name="pengalaman" class="w-full border-2 border-zinc-200 p-3 rounded-xl focus:outline-none focus:border-indigo-500" rows="4">Fokus pada pembuatan antarmuka (UI) yang ramah pengguna menggunakan Figma dan melakukan slicing desain ke HTML & CSS.</textarea>
                    </div>

                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="flex-1">
                            <label class="block font-bold text-zinc-700 mb-3">Aplikasi Penunjang:</label>
                            <div class="bg-zinc-50 p-4 rounded-xl border border-zinc-100 space-y-2">
                                <label class="flex items-center text-sm"><input type="checkbox" name="tools[]" value="Figma" class="mr-3 w-4 h-4 accent-indigo-600" checked> Figma</label>
                                <label class="flex items-center text-sm"><input type="checkbox" name="tools[]" value="Canva" class="mr-3 w-4 h-4 accent-indigo-600" checked> Canva</label>
                                <label class="flex items-center text-sm"><input type="checkbox" name="tools[]" value="VS Code" class="mr-3 w-4 h-4 accent-indigo-600" checked> VS Code</label>
                            </div>
                        </div>
                        <div class="flex-1">
                            <label class="block font-bold text-zinc-700 mb-3">Minat Utama:</label>
                            <div class="bg-zinc-50 p-4 rounded-xl border border-zinc-100 space-y-2">
                                <label class="flex items-center text-sm"><input type="radio" name="minat" value="UI/UX Research" class="mr-3 w-4 h-4 accent-indigo-600"> UI/UX Research</label>
                                <label class="flex items-center text-sm"><input type="radio" name="minat" value="Frontend Development" class="mr-3 w-4 h-4 accent-indigo-600" checked> Frontend</label>
                                <label class="flex items-center text-sm"><input type="radio" name="minat" value="Graphic Design" class="mr-3 w-4 h-4 accent-indigo-600"> Graphic Design</label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-zinc-700 mb-2">Tingkat Penguasaan Saat Ini:</label>
                        <select name="skill" class="w-full border-2 border-zinc-200 p-3 rounded-xl focus:outline-none focus:border-indigo-500">
                            <option value="Tingkat Pemula">Tingkat Pemula</option>
                            <option value="Tingkat Menengah" selected>Tingkat Menengah</option>
                            <option value="Tingkat Lanjut">Tingkat Lanjut</option>
                        </select>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition-colors">Simpan & Proses Data</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</body>
</html>