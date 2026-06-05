<?php
function tampilkanData($data){
?>
<div class="mt-6 overflow-x-auto">
    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
        <thead class="bg-indigo-600 text-white">
            <tr>
                <th class="p-3 text-left">Data</th>
                <th class="p-3 text-left">Isi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $key => $value): ?>
            <tr class="border-t hover:bg-gray-50">
                <td class="p-3 font-semibold"><?= $key ?></td>
                <td class="p-3"><?= $value ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
}

$pesan = "";
$dataHasil = null;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(
        empty($_POST['framework']) ||
        empty($_POST['pengalaman']) ||
        empty($_POST['tools']) ||
        empty($_POST['minat']) ||
        empty($_POST['skill'])
    ){
        $pesan = "error";
    } else {
        $fw = array_filter(array_map('trim', explode(",", $_POST['framework'])));
        $jumlah = count($fw);
        if($jumlah > 2){
            $pesan = "sukses";
        }
        $dataHasil = [
            "Framework" => implode(", ", $fw),
            "Tools" => implode(", ", $_POST['tools']),
            "Minat" => $_POST['minat'],
            "Skill" => $_POST['skill'],
            "Pengalaman" => $_POST['pengalaman']
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Profil Developer</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-100 via-blue-100 to-purple-100 min-h-screen p-6">

<div class="max-w-5xl mx-auto bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-2xl">

<h2 class="text-3xl font-bold text-center text-indigo-600 mb-6">
Profil Interaktif Developer Pemula
</h2>

<!-- PROFIL -->
<table class="w-full border border-gray-300 text-sm mb-6">
    <tr class="bg-gray-100">
        <td class="p-3 border font-semibold">Nama</td>
        <td class="p-3 border">Fitriyas</td>
    </tr>
    <tr>
        <td class="p-3 border font-semibold">ID</td>
        <td class="p-3 border">146</td>
    </tr>
    <tr class="bg-gray-100">
        <td class="p-3 border font-semibold">TTL</td>
        <td class="p-3 border">Jombang, 06 Juni 2008</td>
    </tr>
    <tr>
        <td class="p-3 border font-semibold">Email</td>
        <td class="p-3 border">fitriyas440@gmail.com</td>
    </tr>
    <tr class="bg-gray-100">
        <td class="p-3 border font-semibold">WhatsApp</td>
        <td class="p-3 border">085784265426</td>
    </tr>
</table>

<!-- FORM -->
<form method="POST" class="space-y-4">

<input type="text" name="framework"
placeholder="Contoh: bootstrap, tailwind"
class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400">

<textarea name="pengalaman"
placeholder="Ceritakan pengalaman coding..."
class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400"></textarea>

<div>
<p class="font-semibold mb-1">Tools:</p>
<div class="flex flex-wrap gap-4">
<label class="bg-gray-100 px-3 py-1 rounded"><input type="checkbox" name="tools[]" value="VS Code"> VS Code</label>
<label class="bg-gray-100 px-3 py-1 rounded"><input type="checkbox" name="tools[]" value="GitHub"> GitHub</label>
<label class="bg-gray-100 px-3 py-1 rounded"><input type="checkbox" name="tools[]" value="Figma"> Figma</label>
<label class="bg-gray-100 px-3 py-1 rounded"><input type="checkbox" name="tools[]" value="Postman"> Postman</label>
</div>
</div>

<div>
<p class="font-semibold mb-1">Minat:</p>
<div class="flex gap-4">
<label class="bg-gray-100 px-3 py-1 rounded"><input type="radio" name="minat" value="Frontend"> Frontend</label>
<label class="bg-gray-100 px-3 py-1 rounded"><input type="radio" name="minat" value="Backend"> Backend</label>
<label class="bg-gray-100 px-3 py-1 rounded"><input type="radio" name="minat" value="Fullstack"> Fullstack</label>
</div>
</div>

<select name="skill" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400">
<option value="">Pilih Skill</option>
<option>Dasar</option>
<option>Cukup</option>
<option>Profesional</option>
</select>

<button class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition">
Kirim Data
</button>

</form>

<!-- PESAN -->
<?php if($pesan == "error"): ?>
<div class="mt-4 bg-red-100 text-red-600 p-4 rounded-lg">
⚠ Semua field wajib diisi!
</div>
<?php endif; ?>

<?php if($pesan == "sukses"): ?>
<div class="mt-4 bg-green-100 text-green-700 p-4 rounded-lg font-semibold">
✅ Skill Anda cukup luas di bidang development!
</div>
<?php endif; ?>

<!-- OUTPUT -->
<?php if($dataHasil): ?>

<?php tampilkanData([
    "Framework" => $dataHasil["Framework"],
    "Tools" => $dataHasil["Tools"],
    "Minat" => $dataHasil["Minat"],
    "Skill" => $dataHasil["Skill"]
]); ?>

<div class="mt-6 bg-gray-50 p-4 rounded-lg">
<p class="font-semibold mb-1"> Pengalaman:</p>
<p><?= htmlspecialchars($dataHasil["Pengalaman"]); ?></p>
</a>
</div>
<?php endif; ?>
<div class="mt-8 flex justify-end">
    <a href="timeline.php"
    class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 transition">
        Lihat Timeline →
    </a>
</div>

</div>
</body>
</html>