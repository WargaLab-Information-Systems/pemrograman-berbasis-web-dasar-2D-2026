<!-- Halaman 1: Profil Interaktif Developer (index.php) -->

<?php
$framework = "";
$cerita = "";
$tools = array();
$minat = "";
$skill = "";

if (isset($_POST['submit'])) {
    $framework = trim($_POST['framework']);
    $cerita = trim($_POST['cerita']);
    $tools = isset($_POST['tools']) ? $_POST['tools'] : array();
    $minat = isset($_POST['minat']) ? $_POST['minat'] : "";
    $skill = $_POST['skill'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Interaktif Developer Pemula</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Verdana;
            background: linear-gradient(135deg, #DFD9D8, #FC8F8F, #DFD9D8);
            color: #64242F;
            padding: 30px;
        }

        .container {
            max-width: 1050px;
            margin: auto;
        }

        h1 {
            text-align: center;
            font-size: 34px;
            margin-bottom: 30px;
            color: #64242F;
            letter-spacing: 1px;
        }

        h2 {
            color: #64242F;
            margin-bottom: 15px;
            font-size: 24px;
            font-weight: bold;
        }

        .intro {
            background: #64242F;
            padding: 18px 22px;
            border-radius: 16px;
            margin-bottom: 24px;
            border: 2px solid white;
            color: white;
            line-height: 1.8;
            text-align: justify;
            font-size: 15px;
            box-shadow: 0 10px 24px rgba(100, 36, 47, 0.08);
            transition: 0.3s ease;
        }

        .intro:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 38px rgba(100, 36, 47, 0.18);
        }

        .intro b {
            color: white;
            font-size: 16px;
        }

        .card {
            background: white;
            padding: 28px;
            border-radius: 20px;
            margin-bottom: 28px;
            border: 2px solid #f3b6b7;
            box-shadow: 0 12px 30px rgba(100, 36, 47, 0.10);
            transition: 0.3s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 38px rgba(100, 36, 47, 0.18);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th {
            background: #64242F;
            color: white;
            padding: 13px;
            text-align: left;
        }

        td {
            border: 1px solid #f1d2d2;
            padding: 13px;
            background: #ffffff;
            color: #64242F;
        }

        tr:hover td {
            background: #fff7f7;
        }

        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 8px;
            font-weight: bold;
            color: #64242F;
        }

        input[type=text],
        textarea,
        select {
            width: 100%;
            padding: 14px;
            border: 1.8px solid #e7b3b3;
            border-radius: 12px;
            font-size: 15px;
            background: #fffdfd;
            color: #64242F;
            box-sizing: border-box;
            margin-top: 6px;
            margin-bottom: 8px;
            transition: 0.3s;
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg fill='%2364242F' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 15px center;
            padding-right: 45px;
        }

        input[type=text]:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border: 2px solid #B44446;
            box-shadow: 0 0 12px rgba(180, 68, 70, 0.18);
        }

        textarea {
            height: 130px;
            resize: none;
        }

        .option {
            margin-top: 8px;
            color: #64242F;
        }

        input[type=checkbox],
        input[type=radio] {
            margin-right: 8px;
        }

        button {
            margin-top: 24px;
            background: linear-gradient(135deg, #64242F, #B44446);
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 12px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 18px rgba(100, 36, 47, 0.20);
        }

        .success {
            background: #fff6f6;
            color: #64242F;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            border: 1px solid #FC8F8F;
        }

        .error {
            background: #fff0f0;
            color: #B44446;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            border: 1px solid #FC8F8F;
        }

        .nav {
            text-align: right;
            margin-top: 25px;
        }

        .nav a {
            text-decoration: none;
            background: linear-gradient(135deg, #B44446, #64242F);
            color: white;
            padding: 13px 20px;
            border-radius: 12px;
            margin-left: 10px;
            display: inline-block;
            font-weight: bold;
            transition: 0.3s;
        }

        .nav a:hover {
            opacity: 0.9;
            transform: translateY(-3px);
            box-shadow: 0 10px 18px rgba(100, 36, 47, 0.20);
        }

        .keterangan {
            font-size: 14px;
            color: #B44446;
            margin-top: 5px;
        }

        .link-kontak {
            color: #B44446;
            text-decoration: none;
            transition: 0.3s;
        }

        .link-kontak:hover {
            color: #64242F;
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Profil Interaktif Developer Pemula</h1>

        <div class="intro">
            <b>Selamat Datang di Profil Interaktif Developer !</b><br>
            Halaman ini berisi informasi profil pribadi saya sebagai mahasiswa Sistem Informasi yang sedang belajar dan
            berkembang di dunia teknologi. Di dalamnya terdapat data profil, kemampuan dasar yang sedang dipelajari,
            serta form interaktif untuk menampilkan minat dan pengalaman saya dalam bidang coding. Melalui halaman ini,
            saya ingin menunjukkan proses belajar saya sebagai developer pemula yang terus berkembang dari waktu ke
            waktu.
        </div>

        <div class="card">
            <h2>Data Profil Developer</h2>

            <table>
                <tr>
                    <th>Data</th>
                    <th>Keterangan</th>
                </tr>

                <tr>
                    <td>Nama Lengkap</td>
                    <td>Mitha Aulia Nisrina</td>
                </tr>

                <tr>
                    <td>ID Developer</td>
                    <td>DEV250441100011</td>
                </tr>

                <tr>
                    <td>Kota / Tanggal Lahir</td>
                    <td>Bangkalan, 30 November 2006</td>
                </tr>

                <tr>
                    <td>Email Aktif</td>
                    <td>
                        <a href="mailto:mithaaulianisrina@gmail.com" class="link-kontak">
                            mithaaulianisrina@gmail.com
                        </a>
                    </td>
                </tr>

                <tr>
                    <td>No. WhatsApp</td>
                    <td>
                        <a href="https://wa.me/6282220004944" target="_blank" class="link-kontak">
                            082220004944
                        </a>
                    </td>
                </tr>

            </table>
        </div>

        <div class="card">
            <h2>Form Isian Dinamis Developer</h2>

            <form method="post">

                <label>Framework / Tools yang Dikuasai</label>
                <input type="text" name="framework"
                    placeholder="Contoh: Python, HTML, CSS, PHP, JavaScript, Laravel, Bootstrap, MySQL"
                    value="<?php echo $framework; ?>">
                <div class="keterangan">Pisahkan setiap skill menggunakan tanda koma (,)</div>

                <label>Cerita Singkat Pengalaman Membuat Aplikasi / Website</label>
                <textarea name="cerita"
                    placeholder="Tuliskan pengalaman membuat website, tugas kuliah, project pribadi, desain aplikasi, atau pengalaman belajar coding lainnya..."><?php echo $cerita; ?></textarea>

                <label>Tools Penunjang yang Pernah Digunakan</label>

                <div class="option"><input type="checkbox" name="tools[]" value="VS Code" <?php if (in_array("VS Code", $tools))
                    echo "checked"; ?>>VS Code</div>
                <div class="option"><input type="checkbox" name="tools[]" value="GitHub" <?php if (in_array("GitHub", $tools))
                    echo "checked"; ?>>GitHub</div>
                <div class="option"><input type="checkbox" name="tools[]" value="Figma" <?php if (in_array("Figma", $tools))
                    echo "checked"; ?>>Figma</div>
                <div class="option"><input type="checkbox" name="tools[]" value="Postman" <?php if (in_array("Postman", $tools))
                    echo "checked"; ?>>Postman</div>
                <div class="option"><input type="checkbox" name="tools[]" value="Canva" <?php if (in_array("Canva", $tools))
                    echo "checked"; ?>>Canva</div>
                <div class="option"><input type="checkbox" name="tools[]" value="XAMPP" <?php if (in_array("XAMPP", $tools))
                    echo "checked"; ?>>XAMPP</div>
                <div class="option"><input type="checkbox" name="tools[]" value="NetBeans" <?php if (in_array("NetBeans", $tools))
                    echo "checked"; ?>>NetBeans</div>

                <label>Minat Bidang Pengembangan</label>

                <div class="option"><input type="radio" name="minat" value="Frontend Developer" <?php if ($minat == "Frontend Developer")
                    echo "checked"; ?>>Frontend Developer</div>
                <div class="option"><input type="radio" name="minat" value="Backend Developer" <?php if ($minat == "Backend Developer")
                    echo "checked"; ?>>Backend Developer</div>
                <div class="option"><input type="radio" name="minat" value="Fullstack Developer" <?php if ($minat == "Fullstack Developer")
                    echo "checked"; ?>>Fullstack Developer</div>
                <div class="option"><input type="radio" name="minat" value="UI/UX Designer" <?php if ($minat == "UI/UX Designer")
                    echo "checked"; ?>>UI/UX Designer</div>
                <div class="option"><input type="radio" name="minat" value="Mobile Developer" <?php if ($minat == "Mobile Developer")
                    echo "checked"; ?>>Mobile Developer</div>

                <label>Tingkat Skill Coding</label>

                <select name="skill">
                    <option value="">-- Pilih Tingkat Skill Coding --</option>
                    <option value="Dasar" <?php if ($skill == "Dasar")
                        echo "selected"; ?>>Dasar</option>
                    <option value="Cukup" <?php if ($skill == "Cukup")
                        echo "selected"; ?>>Cukup</option>
                    <option value="Menengah" <?php if ($skill == "Menengah")
                        echo "selected"; ?>>Menengah</option>
                    <option value="Mahir" <?php if ($skill == "Mahir")
                        echo "selected"; ?>>Mahir</option>
                    <option value="Profesional" <?php if ($skill == "Profesional")
                        echo "selected"; ?>>Profesional
                    </option>
                </select>

                <button type="submit" name="submit">Proses Data Developer</button>

            </form>
        </div>

        <?php

        function tampilkanData($frameworkArray, $cerita, $tools, $minat, $skill)
        {

            echo "<div class='card'>";
            echo "<h2>Hasil Input Data Developer</h2>";

            echo "<table>";

            echo "<tr>
<th>Jenis Data</th>
<th>Hasil Input</th>
</tr>";

            echo "<tr>
<td>Framework / Tools yang Dikuasai</td>
<td>" . implode(", ", $frameworkArray) . "</td>
</tr>";

            echo "<tr>
<td>Tools Penunjang</td>
<td>" . implode(", ", $tools) . "</td>
</tr>";

            echo "<tr>
<td>Minat Bidang</td>
<td>$minat</td>
</tr>";

            echo "<tr>
<td>Tingkat Skill Coding</td>
<td>$skill</td>
</tr>";

            echo "</table>";

            echo "<div style='margin-top:20px; line-height:1.8;'>";
            echo "<b style='font-size:18px; color:#64242F;'>Cerita Pengalaman :</b>";
            echo "<p style='margin-top:12px; text-align:justify;'>$cerita</p>";
            echo "</div>";

            echo "</div>";
        }

        if (isset($_POST['submit'])) {

            echo "<div class='card'>";

            if (
                $framework == "" &&
                $cerita == "" &&
                empty($tools) &&
                $minat == "" &&
                $skill == ""
            ) {

                echo "<div class='error'>Semua data wajib diisi lengkap. Silahkan periksa kembali form yang masih kosong.</div>";

            } else if ($framework == "") {
                echo "<div class='error'>Framework / Tools wajib diisi.</div>";

            } else if ($cerita == "") {
                echo "<div class='error'>Cerita pengalaman wajib diisi.</div>";

            } else if (empty($tools)) {
                echo "<div class='error'>Pilih minimal satu tools penunjang.</div>";

            } else if ($minat == "") {
                echo "<div class='error'>Pilih minat bidang pengembangan.</div>";

            } else if ($skill == "") {
                echo "<div class='error'>Pilih tingkat skill coding.</div>";

            } else {

                $frameworkArray = explode(",", $framework);

                echo "<div class='success'>Data berhasil diproses dengan baik.</div>";

                if (count($frameworkArray) > 2) {
                    echo "<div class='success'>Skill Anda cukup luas di bidang development!</div>";
                }

                tampilkanData($frameworkArray, $cerita, $tools, $minat, $skill);

            }

            echo "</div>";
        }

        ?>

        <div class="nav">
            <a href="timeline.php">Menuju Timeline Belajar Coding</a>
            <a href="blog.php">Menuju Blog Reflektif Developer</a>
        </div>

    </div>

</body>

</html>