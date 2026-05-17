<?php
function tampilkanData($data) {
    echo "<table class='table-auto border border-gray-400 mt-6 w-full'>";
    foreach ($data as $key => $value) {
        echo "<tr class='border'>";
        echo "<td class='p-2 font-semibold bg-gray-100'>$key</td>";
        echo "<td class='p-2'>$value</td>";
        echo "</tr>";
    }
    echo "</table>";
}

$hasil = [];
$pengalaman = "";
$pesanTambahan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $framework = $_POST['framework'] ?? "";
    $cerita = $_POST['cerita'] ?? "";
    $tools = $_POST['tools'] ?? [];
    $minat = $_POST['minat'] ?? "";
    $skill = $_POST['skill'] ?? "";

    if ($framework && $cerita && $tools && $minat && $skill) {

        $frameworkArray = explode(",", $framework);

        if (count($frameworkArray) > 2) {
            $pesanTambahan = "Skill Anda cukup luas di bidang development!";
        }

        $hasil = [
            "Framework/Tools" => implode(", ", $frameworkArray),
            "Tools Penunjang" => implode(", ", $tools),
            "Minat Bidang" => $minat,
            "Tingkat Skill" => $skill
        ];

        $pengalaman = $cerita;

    } else {
        echo "<script>alert('Semua input wajib diisi!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Developer</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-gray-100 p-10">

<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

    <h1 class="text-2xl font-bold mb-4 text-center">
        Profil Interaktif Developer Pemula
    </h1>

    <table class="table-auto border border-gray-400 w-full mb-6">
        <tr><td class="p-2 font-semibold">Nama</td><td class="p-2">Elo Presil Berfa</td></tr>
        <tr><td class="p-2 font-semibold">ID Developer</td><td class="p-2">DEV001</td></tr>
        <tr><td class="p-2 font-semibold">Kota/Tgl Lahir</td><td class="p-2">Trenggalek, 26-04-2007</td></tr>
        <tr><td class="p-2 font-semibold">Email</td><td class="p-2">elopresil026@gmail.com</td></tr>
        <tr><td class="p-2 font-semibold">No. WhatsApp</td><td class="p-2">088996633917</td></tr>
    </table>

    <form method="POST" class="space-y-4">

        <div>
            <label class="font-semibold">Framework/Tools (pisahkan dengan koma)</label>
            <input type="text" name="framework" class="w-full border p-2 rounded" placeholder="Laravel, React, Vue">
        </div>

        <div>
            <label class="font-semibold">Pengalaman</label>
            <textarea name="cerita" class="w-full border p-2 rounded"></textarea>
        </div>

        <div>
            <label class="font-semibold">Tools Penunjang</label><br>
            <input type="checkbox" name="tools[]" value="VS Code"> VS Code
            <input type="checkbox" name="tools[]" value="GitHub"> GitHub
            <input type="checkbox" name="tools[]" value="Figma"> Figma
            <input type="checkbox" name="tools[]" value="Postman"> Postman
        </div>

        <div>
            <label class="font-semibold">Minat Bidang</label><br>
            <input type="radio" name="minat" value="Frontend"> Frontend
            <input type="radio" name="minat" value="Backend"> Backend
            <input type="radio" name="minat" value="Fullstack"> Fullstack
        </div>

        <div>
            <label class="font-semibold">Tingkat Skill</label>
            <select name="skill" class="w-full border p-2 rounded">
                <option value="">-- Pilih --</option>
                <option>Dasar</option>
                <option>Cukup</option>
                <option>Profesional</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Submit
        </button>
    </form>

    <?php if (!empty($hasil)) { ?>
        <h2 class="text-xl font-bold mt-6">Hasil Input</h2>

        <?php tampilkanData($hasil); ?>

        <p class="mt-4"><strong>Pengalaman:</strong> <?= $pengalaman ?></p>

        <?php if ($pesanTambahan) { ?>
            <p class="mt-2 text-green-600 font-semibold"><?= $pesanTambahan ?></p>
        <?php } ?>
    <?php } ?>

    <div class="mt-8 flex justify-between">
        <a href="timeline.php" 
           class="bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
         ke timeline
        </a>
    </div>
</div>

</body>
</html>