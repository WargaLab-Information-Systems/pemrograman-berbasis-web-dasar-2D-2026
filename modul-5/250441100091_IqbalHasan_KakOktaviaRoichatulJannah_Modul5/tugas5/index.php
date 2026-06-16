<?php
date_default_timezone_set('asia/jakarta');
$jam = date('H');
$sapaan = "";

if ($jam >= 5 && $jam < 12) {
    $sapaan = "Selamat Pagi";
} elseif ($jam >= 12 && $jam < 15) {
    $sapaan = "Selamat Siang";
} elseif ($jam >= 15 && $jam < 18) {
    $sapaan = "Selamat Sore";
} else {
    $sapaan = "Selamat Malam";
}


$data_profil = [
    "Nama Lengkap" => "Iqbal Hasan",
    "NIM" => "250441100091",
    "Kota/Tgl Lahir" => "Bangkalan, 10 Januari 2006",
    "Email" => "craftkevin35@gmail.com",
    "No. WhatsApp" => "085179910158",
    "Fokus Pengembangan" => "Web & Game Development"
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Developer - Iqbal Hasan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8 font-sans text-gray-800">

    <div class="max-w-4xl mx-auto">

        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-6 border-b border-gray-100 pb-4 gap-4">
                <h2 class="text-2xl font-bold text-slate-900">Profil Developer Pemula</h2>
                <span class="text-sm font-semibold text-slate-700 bg-slate-100 px-4 py-1.5 rounded-md border border-slate-200">
                    <?php echo $sapaan; ?>, Iqbal!
                </span>
            </div>
            
            <div class="flex flex-col md:flex-row gap-8 items-center md:items-start mb-8">
                <img src="img/fotodiri.jpeg" alt="Foto Profil" class="w-32 h-40 object-cover rounded-lg border border-gray-200 shadow-sm">
                
                <table class="table-auto w-full text-left border-collapse text-gray-600">
                    <?php foreach ($data_profil as $label => $nilai) { ?>
                        <tr>
                            <th class="py-2 w-1/3 border-b border-gray-50"><?php echo $label; ?></th>
                            <td class="py-2 border-b border-gray-50">: <?php echo $nilai; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <div class="flex gap-4">
                <a href="timeline.php" class="bg-slate-900 text-white px-6 py-2.5 rounded-md font-semibold text-sm hover:bg-slate-800 transition-colors">Lihat Timeline</a>
                <a href="blog.php" class="bg-white border border-slate-300 text-slate-700 px-6 py-2.5 rounded-md font-semibold text-sm hover:bg-gray-50 transition-colors">Lihat Blog</a>
            </div>
        </div>


        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
            <h3 class="text-xl font-bold text-slate-900 mb-6">Analisis Keahlian (Input Data)</h3>
            
            <form action="proses.php" method="POST">
                <div class="mb-6">
                    <label class="block font-semibold mb-2 text-sm text-gray-700">Framework / Tools / Bahasa (Pisahkan dengan koma):</label>
                    <input type="text" name="framework" class="w-full border border-gray-300 p-3 rounded-md focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 text-sm" value="PHP, SQL, Lua, GitHub, Tailwind">
                </div>
                
                <div class="mb-6">
                    <label class="block font-semibold mb-2 text-sm text-gray-700">Deskripsi Pengalaman Pendek:</label>
                    <textarea name="pengalaman" class="w-full border border-gray-300 p-3 rounded-md focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 text-sm" rows="3">Mengembangkan sistem game di platform Roblox, serta mendalami manajemen database menggunakan Laragon dan MariaDB.</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div>
                        <label class="block font-semibold mb-3 text-sm text-gray-700">Tools Penunjang Desain & Server:</label>
                        <div class="space-y-2 text-sm text-gray-600">
                            <label class="flex items-center"><input type="checkbox" name="tools[]" value="Figma" class="mr-3 rounded text-slate-900" checked> Figma</label>
                            <label class="flex items-center"><input type="checkbox" name="tools[]" value="Canva" class="mr-3 rounded text-slate-900" checked> Canva</label>
                            <label class="flex items-center"><input type="checkbox" name="tools[]" value="Armbian Linux Server" class="mr-3 rounded text-slate-900" checked> Armbian Linux</label>
                        </div>
                    </div>
                    <div>
                        <label class="block font-semibold mb-3 text-sm text-gray-700">Konsentrasi Minat:</label>
                        <div class="space-y-2 text-sm text-gray-600">
                            <label class="flex items-center"><input type="radio" name="minat" value="Frontend Development" class="mr-3 text-slate-900"> Frontend Development</label>
                            <label class="flex items-center"><input type="radio" name="minat" value="Backend Development" class="mr-3 text-slate-900"> Backend Development</label>
                            <label class="flex items-center"><input type="radio" name="minat" value="Fullstack & System Integration" class="mr-3 text-slate-900" checked> Fullstack & System Integration</label>
                        </div>
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block font-semibold mb-2 text-sm text-gray-700">Tingkat Kemampuan Saat Ini:</label>
                    <select name="skill" class="w-full border border-gray-300 p-3 rounded-md focus:outline-none focus:border-slate-900 focus:ring-1 focus:ring-slate-900 text-sm">
                        <option value="Tingkat Dasar">Tingkat Dasar</option>
                        <option value="Menengah (Cukup)" selected>Menengah (Cukup)</option>
                        <option value="Profesional">Profesional</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-semibold text-sm px-4 py-3.5 rounded-md transition-colors">Kirim Data Analisis</button>
            </form>
        </div>
    </div>

</body>
</html>