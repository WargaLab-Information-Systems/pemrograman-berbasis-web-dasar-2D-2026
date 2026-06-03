<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Profil Interaktif Developer Pemula</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans p-6">
  <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">

    <h2 class="text-2xl font-bold text-center mb-6 text-blue-600">
      Profil Interaktif Developer Pemula
    </h2>

<div class="overflow-x-auto">
  <table class="w-full border border-gray-300 text-sm">

    <tbody>

      <tr class="border-b">
        <th class="text-left p-3 bg-gray-100 w-1/3">Nama</th>
        <td class="p-3">Sherina</td>
      </tr>

      <tr class="border-b">
        <th class="text-left p-3 bg-gray-100">ID Developer</th>
        <td class="p-3">DEV001</td>
      </tr>

      <tr class="border-b">
        <th class="text-left p-3 bg-gray-100">Kota / Tgl Lahir</th>
        <td class="p-3">Bangkalan, 05-12-2006</td>
      </tr>

      <tr class="border-b">
        <th class="text-left p-3 bg-gray-100">Email</th>
        <td class="p-3">sherina052006@gmail.com</td>
      </tr>

      <tr>
        <th class="text-left p-3 bg-gray-100">No. WhatsApp</th>
        <td class="p-3">+62 819-364-46278</td>
      </tr>

    </tbody>
  </table>
</div>

    <hr class="my-6">

    <form method="POST" class="space-y-4">

      <div>
        <label class="font-semibold">Framework/Tools yang dikuasai:</label>
        <input type="text" name="framework"
          class="w-full border p-2 rounded mt-1">
      </div>

      <div>
        <label class="font-semibold">Cerita singkat pengalaman:</label>
        <textarea name="pengalaman" rows="4"
          class="w-full border p-2 rounded mt-1"></textarea>
      </div>

      <div>
        <label class="font-semibold">Tools Penunjang:</label><br>
        <div class="space-x-3 mt-1">
          <label><input type="checkbox" name="tools[]" value="VS Code"> VS Code</label>
          <label><input type="checkbox" name="tools[]" value="GitHub"> GitHub</label>
          <label><input type="checkbox" name="tools[]" value="Figma"> Figma</label>
          <label><input type="checkbox" name="tools[]" value="Postman"> Postman</label>
        </div>
      </div>

      <div>
        <label class="font-semibold">Minat Bidang:</label><br>
        <div class="space-x-3 mt-1">
          <label><input type="radio" name="minat" value="Frontend"> Frontend</label>
          <label><input type="radio" name="minat" value="Backend"> Backend</label>
          <label><input type="radio" name="minat" value="Fullstack"> Fullstack</label>
        </div>
      </div>

      <div>
        <label class="font-semibold">Tingkat Skill Coding:</label><br>
        <div class="space-x-3 mt-1">
          <label><input type="radio" name="skill" value="Dasar"> Dasar</label>
          <label><input type="radio" name="skill" value="Cukup"> Cukup</label>
          <label><input type="radio" name="skill" value="Profesional"> Profesional</label>
        </div>
      </div>

      <button type="submit" name="submit"
        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Kirim
      </button>

    </form>

    <hr class="my-6">

    <?php

    function tampilkanData($frameworks, $pengalaman, $tools, $minat, $skill) {
        echo "<h2 class='text-xl font-bold mb-3 text-green-600'>Hasil Input</h2>";

        echo "<table class='w-full border text-sm mb-3'>
                <tr class='bg-gray-200'>
                  <th class='p-2 border'>Framework/Tools</th>
                  <th class='p-2 border'>Tools Penunjang</th>
                  <th class='p-2 border'>Minat</th>
                  <th class='p-2 border'>Skill</th>
                </tr>
                <tr>
                  <td class='p-2 border'>".implode(", ", $frameworks)."</td>
                  <td class='p-2 border'>".implode(", ", $tools)."</td>
                  <td class='p-2 border'>$minat</td>
                  <td class='p-2 border'>$skill</td>
                </tr>
              </table>";

        echo "<p><b>Pengalaman:</b> $pengalaman</p>";
    }

    if (isset($_POST['submit'])) {
        $frameworkInput = trim($_POST['framework']);
        $pengalaman = trim($_POST['pengalaman']);
        $tools = isset($_POST['tools']) ? $_POST['tools'] : [];
        $minat = isset($_POST['minat']) ? $_POST['minat'] : "";
                $skill = isset($_POST['skill']) ? $_POST['skill'] : "";

        if ($frameworkInput == "" || $pengalaman == "" || empty($tools) || $minat == "" || $skill == "") {
            echo "<p class='text-red-500 font-semibold'>Semua input wajib diisi!</p>";
        } else {

            $frameworks = explode(",", $frameworkInput);

            if (count($frameworks) > 2) {
                echo "<p class='text-blue-500'>Skill Anda cukup luas di bidang development!</p>";
            }

            tampilkanData($frameworks, $pengalaman, $tools, $minat, $skill);
        }
    }
    ?>

    <div class="mt-6 text-center space-x-4">
      <a href="timeline.php" class="text-blue-600 hover:underline">Belajar Developer</a>
      <a href="blog.php" class="text-blue-600 hover:underline">Blog Developer</a>
    </div>

  </div>

</body>
</html>
