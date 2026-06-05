<?php
function tampilkanData($label, $data) {
    return "<tr class='border-b'>
                <td class='py-2 font-semibold text-black-600'>$label</td>
                <td class='py-2'>$data</td>
            </tr>";
}

$hasil = "";
$pesan = "";

$framework = $_POST['framework'] ?? "";
$cerita    = $_POST['cerita'] ?? "";
$tools     = $_POST['tools'] ?? [];
$minat     = $_POST['minat'] ?? "";
$skill     = $_POST['skill'] ?? "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($framework) || empty($cerita) || count($tools) == 0 || empty($minat) || empty($skill)) {
        $pesan = "<div class='bg-red-100 text-red-800 p-3 rounded mb-3'>
                    Semua input wajib diisi!
                  </div>";
    } else {

        $arrFramework = array_map('trim', explode(",", $framework));

        $hasil .= "<div class='mt-6 bg-blue-200 rounded-xl shadow p-5'>";
        $hasil .= "<h3 class='text-lg font-bold mb-3'>Hasil Input</h3>";

        $hasil .= "<table class='w-full'>";
        $hasil .= tampilkanData("Framework", implode(", ", $arrFramework));
        $hasil .= tampilkanData("Tools", implode(", ", $tools));
        $hasil .= tampilkanData("Minat", $minat);
        $hasil .= tampilkanData("Skill", $skill);
        $hasil .= "</table>";

        $hasil .= "<p class='mt-3'><b>Pengalaman:</b><br>$cerita</p>";

        if (count($arrFramework) > 2) {
            $hasil .= "<p class='text-green-600 font-semibold mt-2'>
                        Skill Anda cukup luas di bidang development!
                      </p>";
        }

        $hasil .= "</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil Developer</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-pink-200 font-sans">

    <div class="flex min-h-screen">

        <div class="w-45 bg-pink-300 text-white p-5">

            <h2 class="text-xl font-bold mb-6">Menu</h2>

            <a href="timeline.php" 
                class="block py-2 px-3 rounded hover:bg-pink-400 mb-2">
                Timeline
            </a>

            <a href="blog.php" 
                class="block py-2 px-3 rounded hover:bg-pink-400">
                Blog
            </a>

        </div>
        

<div class="max-w-3xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-4 text-center">
        Profil Interaktif Developer Pemula
    </h2>

    <div class="bg-blue-200 rounded-xl shadow p-5 mb-6">
        <h3 class="font-bold mb-2">Profil</h3>
        <table class="w-full text-black-700">
            <tr><td class="font-semibold">Nama</td><td>Raodatul Jannah</td></tr>
            <tr><td class="font-semibold">ID Developer</td><td>DEV001</td></tr>
            <tr><td class="font-semibold">TTL</td><td>Pamekasan, 15-10-2007</td></tr>
            <tr><td class="font-semibold">Email</td><td>roudatuljannah@gmail.com</td></tr>
            <tr><td class="font-semibold">WhatsApp</td><td>08123456789</td></tr>
        </table>
    </div>

    <form method="POST" class="bg-blue-200 rounded-xl shadow p-5">

        <?= $pesan ?>

        <h3 class="font-bold mb-3">Form Input</h3>

        <label class="font-medium">Framework (pisahkan dengan koma)</label>
        <input type="text" name="framework" value="<?= $framework ?>"
            class="w-full border bg-pink-100 p-2 rounded mb-3">

        <label class="font-medium">Cerita Pengalaman</label>
        <textarea name="cerita"
            class="w-full border bg-pink-100 p-2 rounded mb-3"><?= $cerita ?></textarea>

        <label class="font-medium">Tools</label><br>
        <div class="mb-3">
            <?php
            $listTools = ["VS Code", "GitHub", "Figma", "Postman"];
            foreach ($listTools as $t) {
                $checked = in_array($t, $tools) ? "checked" : "";
                echo "<label class='mr-3'>
                        <input type='checkbox' name='tools[]' value='$t' $checked> $t
                      </label>";
            }
            ?>
        </div>

        <label class="font-medium">Minat</label><br>
        <div class="mb-3">
            <?php
            $listMinat = ["Frontend", "Backend", "Fullstack"];
            foreach ($listMinat as $m) {
                $checked = ($minat == $m) ? "checked" : "";
                echo "<label class='mr-3'>
                        <input type='radio' name='minat' value='$m' $checked> $m
                      </label>";
            }
            ?>
        </div>

        <label class="font-medium">Skill</label>
        <select name="skill" class="w-full border bg-pink-100 p-2 rounded mb-3">
            <option value="">-- Pilih --</option>
            <option <?= ($skill=="Dasar")?"selected":"" ?>>Dasar</option>
            <option <?= ($skill=="Cukup")?"selected":"" ?>>Cukup</option>
            <option <?= ($skill=="Profesional")?"selected":"" ?>>Profesional</option>
        </select>

        <button class="w-full bg-pink-500 text-white py-2 rounded hover:bg-pink-600">
        Kirim
        </button>
    </form>

    <?= $hasil ?>

</div>

</div>

</body>
</html>