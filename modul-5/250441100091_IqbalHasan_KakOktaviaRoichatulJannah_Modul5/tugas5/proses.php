<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pemrosesan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-8 font-sans text-gray-800">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white p-10 rounded-xl shadow-sm border border-gray-200">
            
            <?php
            $framework  = isset($_POST['framework']) ? $_POST['framework'] : "";
            $pengalaman = isset($_POST['pengalaman']) ? $_POST['pengalaman'] : "";
            $minat      = isset($_POST['minat']) ? $_POST['minat'] : ""; 
            $skill      = isset($_POST['skill']) ? $_POST['skill'] : "";
            $tools      = isset($_POST['tools']) ? $_POST['tools'] : []; 


            function prosesData($fw, $pg, $mn, $sk, $tl) {
                $array_framework = explode(",", $fw);
                $jumlah_framework = count($array_framework);

                echo "<h2 class='text-2xl font-bold text-slate-900 mb-8 border-b border-gray-100 pb-4'>Laporan Analisis Keahlian</h2>";
                
                echo "<table class='table-auto border-collapse w-full mb-8 text-sm text-left text-gray-600'>";
                echo "<tr class='border-b border-gray-100'><th class='p-4 bg-gray-50 w-1/3'>Minat Pengembangan</th><td class='p-4 font-semibold text-slate-900'>$mn</td></tr>";
                echo "<tr class='border-b border-gray-100'><th class='p-4 bg-gray-50'>Tingkat Keahlian</th><td class='p-4'>$sk</td></tr>";
                
                echo "<tr class='border-b border-gray-100'><th class='p-4 bg-gray-50 align-top'>Tools Operasional</th><td class='p-4'>";
                echo "<ul class='list-disc ml-4 space-y-1'>";
                foreach ($tl as $t) {
                    echo "<li>$t</li>";
                }
                echo "</ul></td></tr>";

                echo "<tr><th class='p-4 bg-gray-50 align-top'>Daftar Bahasa / Framework</th><td class='p-4'>";
                echo "<div class='flex flex-wrap gap-2'>";
                foreach ($array_framework as $item) {
                    echo "<span class='bg-slate-100 border border-slate-200 text-slate-700 px-3 py-1 rounded text-xs'>" . trim($item) . "</span>";
                }
                echo "</div></td></tr>";
                echo "</table>";

                if ($jumlah_framework > 2) {
                    echo "<div class='bg-blue-50 border-l-4 border-blue-600 text-blue-900 p-4 mb-8 text-sm'>";
                    echo "Catatan Sistem: Keahlian yang Anda miliki cukup komprehensif di bidang development.";
                    echo "</div>";
                }

                echo "<div class='bg-gray-50 border border-gray-200 text-gray-700 p-6 rounded-md mb-8'>";
                echo "<h4 class='font-semibold text-slate-900 mb-2 text-sm'>Deskripsi Pengalaman:</h4>";
                echo "<p class='leading-relaxed text-sm'>\"" . htmlspecialchars($pg) . "\"</p>";
                echo "</div>";
            }

            if (empty($framework) || empty($pengalaman) || empty($minat) || empty($skill) || empty($tools)) {
                echo "<div class='bg-red-50 border-l-4 border-red-600 text-red-900 p-6 mb-8 text-sm'>";
                echo "<h2 class='font-bold mb-1'>Peringatan Sistem</h2>";
                echo "<p>Validasi gagal. Harap lengkapi semua bidang pada formulir input.</p>";
                echo "</div>";
            } else {
                prosesData($framework, $pengalaman, $minat, $skill, $tools);
            }
            ?>

            <a href='index.php' class='inline-block bg-white border border-slate-300 text-slate-700 font-semibold text-sm px-6 py-2.5 rounded-md hover:bg-gray-50 transition-colors'>Kembali ke Profil Utama</a>

        </div>
    </div>
</body>
</html>