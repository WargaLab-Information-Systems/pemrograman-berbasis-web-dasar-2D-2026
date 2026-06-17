<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Analisis - Lyviana</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-zinc-100 p-6 md:p-12 font-sans text-zinc-800">
    <div class="max-w-4xl mx-auto">
        
        <?php
        $framework  = isset($_POST['framework']) ? $_POST['framework'] : "";
        $pengalaman = isset($_POST['pengalaman']) ? $_POST['pengalaman'] : "";
        $minat      = isset($_POST['minat']) ? $_POST['minat'] : ""; 
        $skill      = isset($_POST['skill']) ? $_POST['skill'] : "";
        $tools      = isset($_POST['tools']) ? $_POST['tools'] : []; 

        function cetakDashboard($fw, $pg, $mn, $sk, $tl) {
            $array_fw = explode(",", $fw);
            $jumlah_fw = count($array_fw);

            echo "<div class='bg-white p-8 rounded-2xl shadow-sm border border-zinc-200 mb-6'>";
            echo "<h2 class='text-2xl font-bold text-zinc-900 mb-2'>Laporan Keahlian</h2>";
            echo "<p class='text-zinc-500 text-sm mb-8'>Berikut adalah hasil rekapitulasi data form.</p>";
            
            // LAYOUT KARTU (GRID 2 KOLOM)
            echo "<div class='grid grid-cols-1 md:grid-cols-2 gap-6 mb-8'>";
            
            // Kartu 1
            echo "<div class='bg-indigo-50 p-6 rounded-xl border border-indigo-100'>";
            echo "<p class='text-indigo-600 font-bold text-xs uppercase mb-1'>Konsentrasi</p>";
            echo "<h3 class='text-lg font-bold text-zinc-900'>$mn</h3>";
            echo "</div>";

            // Kartu 2
            echo "<div class='bg-zinc-50 p-6 rounded-xl border border-zinc-200'>";
            echo "<p class='text-zinc-500 font-bold text-xs uppercase mb-1'>Level Keahlian</p>";
            echo "<h3 class='text-lg font-bold text-zinc-900'>$sk</h3>";
            echo "</div>";

            // Kartu 3 (Penuh)
            echo "<div class='md:col-span-2 bg-zinc-50 p-6 rounded-xl border border-zinc-200'>";
            echo "<p class='text-zinc-500 font-bold text-xs uppercase mb-3'>Aplikasi Operasional</p>";
            echo "<div class='flex flex-wrap gap-3'>";
            foreach ($tl as $t) {
                echo "<span class='bg-white px-4 py-2 rounded-lg border border-zinc-200 text-sm font-medium'>$t</span>";
            }
            echo "</div></div>";

            // Kartu 4 (Penuh)
            echo "<div class='md:col-span-2 bg-zinc-50 p-6 rounded-xl border border-zinc-200'>";
            echo "<p class='text-zinc-500 font-bold text-xs uppercase mb-3'>Daftar Bahasa / Tooling</p>";
            echo "<div class='flex flex-wrap gap-2'>";
            foreach ($array_fw as $item) {
                echo "<span class='bg-zinc-800 text-white px-3 py-1.5 rounded-md text-xs font-semibold'>" . trim($item) . "</span>";
            }
            echo "</div></div>";

            echo "</div>"; // End Grid

            if ($jumlah_fw > 2) {
                echo "<div class='bg-green-50 border border-green-200 text-green-800 p-5 rounded-xl text-sm font-bold mb-8'>";
                echo "Sistem mendeteksi bahwa skill Anda cukup luas di bidang development!";
                echo "</div>";
            }

            echo "<div class='border-t border-zinc-100 pt-6'>";
            echo "<p class='font-bold text-zinc-900 mb-2'>Jurnal Pengalaman:</p>";
            echo "<p class='text-zinc-600 leading-relaxed bg-white p-4 rounded-xl border border-zinc-200'>\"" . htmlspecialchars($pg) . "\"</p>";
            echo "</div>";
            
            echo "</div>"; // End Container
        }

        if (empty($framework) || empty($pengalaman) || empty($minat) || empty($skill) || empty($tools)) {
            echo "<div class='bg-white p-8 rounded-2xl border-2 border-red-200 text-center'>";
            echo "<h3 class='font-bold text-red-600 text-xl mb-2'>Proses Dihentikan</h3>";
            echo "<p class='text-zinc-600 mb-6'>Pastikan seluruh form terisi dengan benar.</p>";
        } else {
            cetakDashboard($framework, $pengalaman, $minat, $skill, $tools);
        }
        ?>

        <a href='index.php' class='inline-block bg-zinc-900 text-white text-sm font-bold px-6 py-3 rounded-xl hover:bg-zinc-800 transition-colors'>Kembali ke Halaman Profil</a>

    </div>
</body>