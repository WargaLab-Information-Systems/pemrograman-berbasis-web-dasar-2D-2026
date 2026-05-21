<?php
$hasil = "";
$pesan = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $framework = $_POST['framework'] ?? '';
    $pengalaman = $_POST['pengalaman'] ?? '';
    $tools = $_POST['tools'] ?? [];
    $minat = $_POST['minat'] ?? '';
    $skill = $_POST['skill'] ?? '';
    if ($framework == "" || $pengalaman == "" || empty($tools) || $minat == "" || $skill == "") {
        $pesan = "Semua input wajib diisi!";
    } else {
        $frameworkArray = explode(",", $framework);
        if (count($frameworkArray) > 2) {
            $pesan = "Skill Anda cukup luas di bidang development!";
        }
        $toolsString = implode(", ", $tools);
        $hasil = "
        <div class='mt-6 p-4 bg-green-100 rounded-lg'>
            <h3 class='font-bold text-lg mb-2'>Hasil Input</h3>
            <table class='w-full border border-gray-300'>
                <tr class='bg-gray-200'>
                    <th class='p-2'>Field</th>
                    <th class='p-2'>Data</th>
                </tr>
                <tr>
                    <td class='p-2'>Framework</td>
                    <td class='p-2'>" . implode(", ", $frameworkArray) . "</td>
                </tr>
                <tr>
                    <td class='p-2'>Tools</td>
                    <td class='p-2'>$toolsString</td>
                </tr>
                <tr>
                    <td class='p-2'>Minat</td>
                    <td class='p-2'>$minat</td>
                </tr>
                <tr>
                    <td class='p-2'>Skill</td>
                    <td class='p-2'>$skill</td>
                </tr>
            </table>
            <h3 class='font-bold mt-4'>Pengalaman</h3>
            <p>$pengalaman</p>
        </div>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Developer</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">
        <h2 class="text-2xl font-bold mb-4 text-center">
            Profil Interaktif Developer Pemula
        </h2>
        <table class="w-full mb-6 border border-gray-300">
            <tr class="bg-gray-200">
                <td class="p-2 font-semibold">Nama</td>
                <td class="p-2">Rudi Bayu Suganda</td>
            </tr>
            <tr>
                <td class="p-2 font-semibold">ID Developer</td>
                <td class="p-2">25133</td>
            </tr>
            <tr class="bg-gray-100">
                <td class="p-2 font-semibold">Kota/Tgl Lahir</td>
                <td class="p-2">Tuban,31 Maret 2007</td>
            </tr>
            <tr>
                <td class="p-2 font-semibold">Email</td>
                <td class="p-2">rudib6929@gmail.com</td>
            </tr>
            <tr class="bg-gray-100">
                <td class="p-2 font-semibold">No WhatsApp</td>
                <td class="p-2">085952842098</td>
            </tr>
        </table>
        <form method="POST" class="space-y-4">
            <div>
                <label class="block font-semibold">Framework/Tools</label>
                <input type="text" name="framework"
                    class="w-full border p-2 rounded"
                    placeholder="Tailwind, Bootstrap, Laravel">
            </div>
            <div>
                <label class="block font-semibold">Pengalaman</label>
                <textarea name="pengalaman"
                    class="w-full border p-2 rounded"></textarea>
            </div>
            <div>
                <label class="block font-semibold">Tools Penunjang</label>
                <div class="flex gap-4">
                    <label><input type="checkbox" name="tools[]" value="VS Code"> VS Code</label>
                    <label><input type="checkbox" name="tools[]" value="GitHub"> GitHub</label>
                    <label><input type="checkbox" name="tools[]" value="Figma"> Figma</label>
                    <label><input type="checkbox" name="tools[]" value="Postman"> Postman</label>
                </div>
            </div>
            <div>
                <label class="block font-semibold">Minat</label>
                <div class="flex gap-4">
                    <label><input type="radio" name="minat" value="Frontend"> Frontend</label>
                    <label><input type="radio" name="minat" value="Backend"> Backend</label>
                    <label><input type="radio" name="minat" value="Fullstack"> Fullstack</label>
                </div>
            </div>
            <div>
                <label class="block font-semibold">Skill Coding</label>
                <select name="skill" class="w-full border p-2 rounded">
                    <option value="">-- Pilih --</option>
                    <option value="Dasar">Dasar</option>
                    <option value="Cukup">Cukup</option>
                    <option value="Profesional">Profesional</option>
                </select>
            </div>
            <button class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                Kirim
            </button>
        </form>
        <div class="mt-6 text-center">
            <a href="timeline.php"
                class="inline-block bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                Selanjutnya =>
            </a>
        </div>
        <?php if ($pesan != ""): ?>
            <div class="mt-4 p-3 bg-yellow-100 rounded">
                <?= $pesan ?>
            </div>
        <?php endif; ?>
        <?= $hasil ?>
    </div>
</body>
</html>