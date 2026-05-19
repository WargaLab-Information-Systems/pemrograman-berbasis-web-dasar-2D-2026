<?php
function prosesFramework($input) {
    return explode(",", $input);
}

function validasi($data) {
    foreach ($data as $d) {
        if (empty($d)) return false;
    }
    return true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Profil Developer</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-8">

<div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow">

<h2 class="text-2xl font-bold mb-4 text-center">Profil Interaktif Developer</h2>

<form method="POST" class="space-y-4">

<input class="w-full border p-2 rounded" type="text" name="nama" placeholder="Nama">
<input class="w-full border p-2 rounded" type="text" name="id" placeholder="ID Developer">
<input class="w-full border p-2 rounded" type="text" name="ttl" placeholder="Kota / Tgl Lahir">
<input class="w-full border p-2 rounded" type="email" name="email" placeholder="Email">
<input class="w-full border p-2 rounded" type="text" name="wa" placeholder="WhatsApp">

<input class="w-full border p-2 rounded" type="text" name="tools" placeholder="Framework (pisahkan dengan koma)">

<textarea class="w-full border p-2 rounded" name="pengalaman" placeholder="Pengalaman"></textarea>

<div>
<label class="font-semibold">Tools Pendukung:</label><br>
<label><input type="checkbox" name="support[]" value="VS Code"> VS Code</label>
<label><input type="checkbox" name="support[]" value="GitHub"> GitHub</label>
<label><input type="checkbox" name="support[]" value="Figma"> Figma</label>
<label><input type="checkbox" name="support[]" value="Postman"> Postman</label>
</div>

<div>
<label class="font-semibold">Minat:</label><br>
<label><input type="radio" name="minat" value="Frontend"> Frontend</label>
<label><input type="radio" name="minat" value="Backend"> Backend</label>
<label><input type="radio" name="minat" value="Fullstack"> Fullstack</label>
</div>

<select class="w-full border p-2 rounded" name="skill">
<option>Dasar</option>
<option>Cukup</option>
<option>Profesional</option>
</select>

<button class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600" name="submit">
Submit
</button>

</form>

<?php
if (isset($_POST['submit'])) {
    if (!validasi($_POST)) {
        echo "<p class='text-red-500 mt-4'>Semua data wajib diisi!</p>";
    } else {

        $framework = prosesFramework($_POST['tools']);

        echo "<div class='mt-6'>";
        echo "<table class='w-full border'>";
        echo "<tr class='bg-gray-200'><th class='p-2'>Field</th><th>Data</th></tr>";
        echo "<tr><td class='p-2'>Nama</td><td>{$_POST['nama']}</td></tr>";
        echo "<tr><td class='p-2'>ID</td><td>{$_POST['id']}</td></tr>";
        echo "<tr><td class='p-2'>TTL</td><td>{$_POST['ttl']}</td></tr>";
        echo "<tr><td class='p-2'>Email</td><td>{$_POST['email']}</td></tr>";
        echo "<tr><td class='p-2'>WA</td><td>{$_POST['wa']}</td></tr>";
        echo "<tr><td class='p-2'>Minat</td><td>{$_POST['minat']}</td></tr>";
        echo "<tr><td class='p-2'>Skill</td><td>{$_POST['skill']}</td></tr>";
        echo "</table>";

        echo "<p class='mt-2'><b>Framework:</b> " . implode(", ", $framework) . "</p>";

        if (count($framework) > 2) {
            echo "<p class='text-green-600 font-semibold'>Skill Anda cukup luas di bidang development!</p>";
        }

        echo "<p class='mt-2'><b>Pengalaman:</b><br>{$_POST['pengalaman']}</p>";
        echo "</div>";
    }
}
?>

<div class="mt-6 text-center">
<a class="text-blue-500" href="timeline.php">Timeline</a> |
<a class="text-blue-500" href="blog.php">Blog</a>
</div>

</div>
</body>
</html>