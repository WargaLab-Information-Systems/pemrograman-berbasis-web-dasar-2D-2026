<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/output.css">
    <title>Profil Interaktif Developer</title>
</head>

<body>
    <div class="flex justify-center">
        <h1 class="font-bold text-3xl">Profil Interaktif Developer</h1>
    </div>
    <div class="flex justify-center py-5">
        <table class=" table-fixed border-collapse border">
            <tr class="">
                <td class="border pr-20 py-2">Nama</td>
                <td class="border pr-20">Reno Irvansyah</td>
            </tr>
            <tr>
                <td class="border pr-20 py-2">ID Developer</td>
                <td class="border pr-20">DEV-001</td>
            </tr>
            <tr>
                <td class="border pr-20 py-2">Kota/Tgl Lahir</td>
                <td class="border pr-20">Mojokerto 2005</td>
            </tr>
            <tr>
                <td class="border pr-20 py-2">Email</td>
                <td class="border pr-20">irvansyah.reno@gmail.com</td>
            </tr>
            <tr>
                <td class="border pr-20 py-2">No Whatsapp</td>
                <td class="border pr-20">085846951117</td>
            </tr>
        </table>
    </div>

    <?php
    function tampilkanData($framework, $pengalaman, $tools, $minat, $tingkat_skill)
    {

        if (empty($framework) || empty($pengalaman) || empty($tools) || empty($minat) || empty($tingkat_skill)) {
            echo "<script>alert('Semua field harus diisi!');</script>";
            return "";
        }

        $framework_pecah = implode(", ", $framework);
        $framework_array = explode(", ", $framework_pecah);

        $output = "";

        if (count($framework_array) > 2) {
            $output .= "<h3 class='text-lg font-bold text-center'>Skill Anda cukup luas di bidang development!</h3>";
        }

        $output .= "
        <div class='flex justify-center py-5 mt-10'>
        <table class=' table-fixed border-collapse border'>
            <tr class=''>
                <td class='border pr-20 py-2'>Framework/Tools</td>
                <td class='border pr-20'>$framework_pecah</td>
            </tr>
            <tr>
                <td class='border pr-20 py-2'>Tools Penunjang</td>
                <td class='border pr-20'>" . implode(", ", $tools) . "</td>
            </tr>
            <tr>
                <td class='border pr-20 py-2'>Minat Bidang</td>
                <td class='border pr-20'>$minat</td>
            </tr>
            <tr>
                <td class='border pr-20 py-2'>Tingkat Skill Coding</td>
                <td class='border pr-20'>$tingkat_skill</td>
            </tr>
        </table>
        </div>
        <p class='text-center'> Pengalaman: $pengalaman</p>
    ";

        return $output;
    }

    ?>

    <?php
    if (isset($_POST['submit'])) {
        $framework = $_POST['framework'] ?? [];
        $pengalaman = $_POST['pengalaman'] ?? '';
        $tools = $_POST['tools'] ?? [];
        $minat = $_POST['minat'] ?? '';
        $tingkat_skill = $_POST['tingkat_skill'] ?? '';

        $hasil = tampilkanData($framework, $pengalaman, $tools, $minat, $tingkat_skill);
    }
    ?>

    <div class=" flex justify-center items-center">
        <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md">

            <h2 class="text-xl font-bold mb-4 text-center">Form Data Skill</h2>

            <form class="space-y-4" action="" method="POST">

                <div>
                    <label class="block font-medium mb-1">Framework/Tools yang dikuasai</label>
                    <input type="text"
                        class="w-full border rounded-md p-2 " name="framework[]" id="framework" placeholder="Laravel, Tailwind Css, VueJS, ReactJS">
                </div>

                <div>
                    <label class="block font-medium mb-1">Pengalaman</label>
                    <textarea rows="3"
                        class="w-full border rounded-md p-2" name="pengalaman"></textarea>
                </div>

                <div>
                    <label class="block font-medium mb-1">Tools Penunjang</label>
                    <div class="space-y-1">
                        <label><input type="checkbox" name="tools[]" class="mr-2" value="VS Code"> VS Code</label><br>
                        <label><input type="checkbox" name="tools[]" class="mr-2" value="Github"> GitHub</label><br>
                        <label><input type="checkbox" name="tools[]" class="mr-2" value="Figma"> Figma</label><br>
                        <label><input type="checkbox" name="tools[]" class="mr-2" value="Postman"> Postman</label>
                    </div>
                </div>

                <div>
                    <label class="block font-medium mb-1">Minat Bidang</label>
                    <div class="space-x-3">
                        <label><input type="radio" name="minat" class="mr-1" value="Frontend"> Frontend</label>
                        <label><input type="radio" name="minat" class="mr-1" value="Backend"> Backend</label>
                        <label><input type="radio" name="minat" class="mr-1" value="Fullstack"> Fullstack</label>
                    </div>
                </div>

                <div>
                    <label class="block font-medium mb-1">Tingkat Skill Coding</label>
                    <select class="w-full border rounded-md p-2" name="tingkat_skill">
                        <option value="Dasar">Dasar</option>
                        <option value="Cukup">Cukup</option>
                        <option value="Profesional">Profesional</option>
                    </select>
                </div>

                <button type="submit" name="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition">
                    Submit
                </button>

            </form>
        </div>
    </div>

    <div class="w-full justify-center items-center mt-10">
        <?php
        if (isset($hasil)) {
            echo $hasil;
        }
        ?>
    </div>

    <div class="w-full mt-10">
        <div class="flex justify-center gap-4">
            <a href="timeline.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Menuju Timeline</a>
            <a href="blog.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Menuju Blog Developer</a>
        </div>
    </div>

</body>

</html>