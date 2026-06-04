<!DOCTYPE html>
<html>
<head>
    <title>Profil Interaktif Developer</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-blue-100 via-blue-200 to-blue-300 min-h-screen p-6">

<div class="max-w-3xl mx-auto bg-white/90 backdrop-blur p-6 rounded-2xl shadow-xl border border-blue-200">

<h1 class="text-3xl font-bold mb-6 text-center text-blue-700">
        Profil Interaktif Developer Pemula
</h1>

<table class="w-full border border-blue-200 mb-6 rounded-lg overflow-hidden">
    <tr class="bg-blue-200 text-blue-800">
        <th class="p-2">Field</th>
        <th class="p-2">Data</th>
    </tr>
    <tr class="hover:bg-blue-50"><td class="p-2">Nama</td><td class="p-2">Kaila Najwa Olivia</td></tr>
    <tr class="hover:bg-blue-50"><td class="p-2">ID Developer</td><td class="p-2">250441</td></tr>
    <tr class="hover:bg-blue-50"><td class="p-2">Kota/Tgl Lahir</td><td class="p-2">Jombang, 13 April 2007</td></tr>
    <tr class="hover:bg-blue-50"><td class="p-2">Email</td><td class="p-2">kailanajwaolivia@email.com</td></tr>
    <tr class="hover:bg-blue-50"><td class="p-2">No WhatsApp</td><td class="p-2">0895339262324</td></tr>
</table>

<form method="POST" id="formDev" class="space-y-4">

    <div>
        <label class="font-semibold text-blue-700">Framework / Tools</label>
        <input type="text" name="framework" id="framework"
            class="w-full border border-blue-300 focus:ring-2 focus:ring-blue-400 p-2 rounded mt-1 outline-none">
    </div>

    <div>
        <label class="font-semibold text-blue-700">Pengalaman</label>
        <textarea name="pengalaman" id="pengalaman"
            class="w-full border border-blue-300 focus:ring-2 focus:ring-blue-400 p-2 rounded mt-1 outline-none"></textarea>
    </div>

    <div>
        <label class="font-semibold text-blue-700">Tools Penunjang</label><br>
        <label class="mr-3"><input type="checkbox" name="tools[]" value="VS Code"> VS Code</label>
        <label class="mr-3"><input type="checkbox" name="tools[]" value="GitHub"> GitHub</label>
        <label class="mr-3"><input type="checkbox" name="tools[]" value="Figma"> My SQL</label>
        <label><input type="checkbox" name="tools[]" value="Postman"> Postman</label>
    </div>

    <div>
        <label class="font-semibold text-blue-700">Minat Bidang</label><br>
        <label class="mr-3"><input type="radio" name="minat" value="Frontend"> Frontend</label>
        <label class="mr-3"><input type="radio" name="minat" value="Backend"> Backend</label>
        <label><input type="radio" name="minat" value="Fullstack"> Fullstack</label>
    </div>

    <div>
        <label class="font-semibold text-blue-700">Tingkat Skill</label>
        <select name="skill" id="skill"
            class="w-full border border-blue-300 focus:ring-2 focus:ring-blue-400 p-2 rounded mt-1 outline-none">
            <option value="">-- Pilih --</option>
            <option value="Dasar">Dasar</option>
            <option value="Cukup">Cukup</option>
            <option value="Profesional">Profesional</option>
        </select>
 
    <div class="flex items-center justify-between mt-4">
 
    <button type="submit" name="submit"
    class="bg-green-600 text-white px-6 py-2 rounded-lg shadow-md">
        Kirim
    </button>

        <a href="timeline.php"
        class="w-28 h-12 bg-blue-600 text-white rounded-lg flex items-center justify-center shadow-md hover:bg-blue-700 transition">
            Timeline
        </a>
    </div>

</div> 

</form>

<script>
document.getElementById("formDev").addEventListener("submit", function(e){

    let framework = document.getElementById("framework").value.trim();
    let pengalaman = document.getElementById("pengalaman").value.trim();
    let skill = document.getElementById("skill").value;
    let minat = document.querySelector('input[name="minat"]:checked');
    let tools = document.querySelectorAll('input[name="tools[]"]:checked');

    if(framework === "" || pengalaman === "" || skill === "" || !minat || tools.length === 0){
        alert("Semua field wajib diisi!");
        e.preventDefault();
    }
});
</script>

<?php
function tampilData($frameworkArr, $pengalaman, $tools, $minat, $skill){

    echo "<div class='mt-6'>";
    echo "<h2 class='text-xl font-bold mb-3 text-blue-700'>Hasil Input</h2>";

    echo "<table class='w-full border border-blue-200'>";
    echo "<tr class='bg-blue-200 text-blue-800'>
            <th class='p-2'>Field</th>
            <th class='p-2'>Data</th>
          </tr>";

    echo "<tr><td class='p-2'>Framework</td>
          <td class='p-2'>".implode(", ", $frameworkArr)."</td></tr>";

    echo "<tr><td class='p-2'>Tools</td>
          <td class='p-2'>".implode(", ", $tools)."</td></tr>";

    echo "<tr><td class='p-2'>Minat</td>
          <td class='p-2'>$minat</td></tr>";

    echo "<tr><td class='p-2'>Skill</td>
          <td class='p-2'>$skill</td></tr>";

    echo "</table>";

    echo "<p class='mt-3 text-gray-700'>
            <b>Pengalaman:</b><br>" .
            htmlspecialchars($pengalaman) .
         "</p>";

    if(count($frameworkArr) > 2){
        echo "<p class='text-blue-600 font-semibold mt-2'>
                Skill Anda cukup luas di bidang development!
              </p>";
    }

    echo "</div>";
}

if(isset($_POST['submit'])){

    $framework = $_POST['framework'];
    $pengalaman = $_POST['pengalaman'];
    $tools = $_POST['tools'] ?? [];
    $minat = $_POST['minat'] ?? "";
    $skill = $_POST['skill'];

    if(empty($framework) || empty($pengalaman) || empty($tools) || empty($minat) || empty($skill)){

        echo "<p class='text-red-500 mt-4'>
                Semua field wajib diisi!
              </p>";

    } else {

        $frameworkArr = array_map('trim', explode(",", $framework));
        echo "
        <script>
            alert('Data berhasil disimpan!');
        </script>
        ";

        tampilData($frameworkArr, $pengalaman, $tools, $minat, $skill);
    }
}
?>


</div>

</body>
</html>